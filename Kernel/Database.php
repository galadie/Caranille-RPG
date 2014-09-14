<?php


function connect_db()
{
	global $bdd, $dns_host, $dns_user, $dns_pswd; 
	
	if(isset($dns_host) && is_null($bdd))
    {
    	// First way - On PDO Constructor
    	$options = array(
    		PDO::ATTR_AUTOCOMMIT =>FALSE,
    		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, //PDO::ERRMODE_EXCEPTION
    		PDO::ATTR_TIMEOUT => 12000,
    		PDO::ATTR_CASE => PDO::CASE_NATURAL
    	);
    
    	try 
    	{
    		$bdd = new PDO($dns_host, $dns_user, $dns_pswd,$options);
    	} 
    	catch (PDOException $e)
    	{
    	   debug_log('Connexion échouée : ' . $e->getMessage());
    	   $bdd = false ;
    	}
    }	
}
/** 
 * execution de la requete dans une fonction independante 
 * @param requete
 * @param record
 */
function exec_db($requete, $record = false)
{
    global $bdd, $debug_sql_array , $last_insert_db , $debug_sql_error ;
    
	//execution de la requete
	if(is_null($bdd)) return false;
	if($bdd===false) return false ;
		
	// voir comment retablir la securité de PDO->prepare/execute
	$debug_sql_array[] = $requete;

    try
    {
    	if($record)
    		$bdd->exec($requete);
    	else
    		$exec = $bdd->query($requete);
    }
    catch(PDOException  $e)
    {
        debug_log("no connexion available");
    }
	// si l'execution renvoie une erreur
	if(intval($bdd->errorCode())<>0)
	{
		// on debug et on arrete le script
		$req_key = array_search($requete,$debug_sql_array,true);//count($debug_sql_array)-1;//
		
		$debug_sql_error[$req_key] = $bdd->errorInfo() ;
		
		debug_log("SQL error num ::".intval($bdd->errorCode()));
		debug_log("SQL Error :".$bdd->errorCode()." => ".print_r($bdd->errorInfo(),1));
		
		return false ;
	}
	// la requete est bien passée
	
	// si c'est une requete d'enregistrement
	if($record)
	{
		$last_insert_db = $bdd->lastInsertId();
		if($last_insert_db!=0)
			debug_log("last_insert_db(exec_db) : $last_insert_db");
		return true ;
	}	
	return $exec;
}

function get_column_def($champs,$prop)
{
	//on genere la ligne SQL avec les propriétés defini dans le champ
											$requete = "\t\t".'`'.$champs.'`'; 
											$requete .= $prop['type'];						// type du champs
			if(isset($prop['length']))		$requete .= '('.$prop['length'].')';			// longueur du champs
 			if(isset($prop['collate']))		$requete .= ' COLLATE '.$prop['collate'].' ';	// jeu de caractere
 			if(isset($prop['default']))		$requete .= ' DEFAULT '.(is_numeric($prop['default']) ? $prop['default'] : "'".$prop['default']."'" ).' '; 	// valeur par defaut
 			if(isset($prop['nullable']))	$requete .= ' '.$prop['nullable'].' ';			// si le champs peut etre null ou non
 			if(isset($prop['increment']))	$requete .= ' '.$prop['increment'].' ';			// si la valeur est numerique et s'incremente automatiquement
											$requete .= ',';							// fin de la ligne 
	return $requete ;
}

function valid_post_db($table)
{
	//le mot clé "global" permet d'ouvrir la portée des variables
	global $db_mapping;
	
	$table_mapping = $db_mapping[$table] ;
	
	// pour chaque champs defini dans la table
	foreach($table_mapping['champs'] as $champs => $t )
		if(isset($t['mandatory']) && $t['mandatory'] === true) // Si le champs est defini comme obligatoire
			if(!request_confirm($champs)) // si le champs n'es pas dans le formulaire posté
				return false ;
	"formulaire valide<br/>";
	return true ;
}
	
function get_create_req($table, $r = array())
{
			//debut de la requete
		$requete = 'CREATE TABLE `'.$table.'` ( '."\n";  

		// pour chaque champs defini dans la table
		foreach( $r['champs'] as $champs => $prop )
		{
			$requete .= get_column_def($champs,$prop)."\n";
		}
		
		$primary = "";
		// pour chaque clé defini dans la table
		foreach( $r['key'] as $champs => $prop )
		{
            if(preg_match('/PRIMARY/i',$prop['key']))//($prop['key'] === 'PRIMARY')
			{
				// la clé primaire => '$table'_ID 
				//$requete .= "\n".'PRIMARY KEY (`'.$champs.'`),' ;   
				
				// pour les table possedant des clés primaire sur champs multiples
				$primary .= ',`'.$champs.'`';

			}
			if($prop['key'] === 'UNIQUE')
			{
				$uniq = md5(uniqid());
				// les clés unique permettent d'eviter les doublons, mais aussi d'acceler l'execution de requete
				$requete .= "\n\t".'UNIQUE KEY `UNIQ_'.$uniq.'` (`'.$champs.'`),';   
				unset($uniq);
				sleep(1);
            }
            /***
			if(preg_match('/FOREIGN/i',$prop['key']))//($prop['key'] === 'FOREIGN')
			{
				$index = uniqid();
				// les clés etrangeres gerent les jointures
				$requete .= "\n".'KEY `IDX_'.$index.'` (`'.$champs.'`), CONSTRAINT `FK_'.$index.'` FOREIGN KEY (`'.$champs.'`) REFERENCES `'.strtolower($prop['table']).'` (`'.$prop['champs'].'`),'; 
			}
			**/
		}
		
		// on supprime une eventuelle virgule en trop
		$primary = ltrim($primary,',');
		
		$requete .= "\n\t".'PRIMARY KEY ('.$primary.')' ; 
		
		// on supprime une eventuelle virgule en trop
		$requete = rtrim($requete,',')."\n";
		
		// InnoDB est à ma connaissance, le seul format qui gere les clés étrangeres et permet de bien restreindre les jointures SQL
        //$requete .= ') ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;'."\n";                                 
		$requete .= ') ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;'."\n"; 
		
	return $requete;
}

function get_alter_req($table, $r = array())
{
	//
	if(test_db($table))
	{
	    
	    $rush = list_db("describe_t",array('table'=>$table)); 
    	
    	if(!empty($rush))
    	{
    		foreach($rush as $line)
    		{
    			preg_match('/(?P<type>\w+)($|\((?P<length>(\d+|(.*)))\))/', $line['Type'], $matches);
    			
    														$lost[$line['Field']]['type'] = $matches['type'] ;
    			if(isset($matches['length'])) 				$lost[$line['Field']]['length'] = $matches['length'];
    			if($line['Null'] === 'No') 					$lost[$line['Field']]['nullable'] = "NOT NULL";
    			if($line['Key'] === 'PRI')					$lost[$line['Field']]['key'] = 'PRIMARY';
    			if($line['Key'] === 'UNI')					$lost[$line['Field']]['key'] = 'UNIQUE'; 
    			if($line['Extra'] === 'auto_increment ')	$lost[$line['Field']]['auto_increment '] = $line['Extra'];
    			
    			if($line['Default'] !== '')					
    				$lost[$line['Field']]['default'] = $line['Default'];
    			else
    				$lost[$line['Field']]['default'] = null;
    		}
    
    		$drop ="";
    		
    		foreach($lost as $champs => $prop )
    			if(!array_key_exists($champs,$r['champs']))
    				$drop .= "\n\t DROP COLUMN `".$champs."`,";
    
    		$add ="";
    		
    		foreach( $r['champs'] as $champs => $prop )
    			if(!array_key_exists($champs,$lost))
    				$add .= "\n\t ADD COLUMN ".get_column_def($champs,$prop);
    					
    		$change ="";
    		
    		foreach( $r['champs'] as $champs => $prop )
    		{
    			$set = false ;
    			
    			foreach( $prop as $c => $v)
    				if(isset($lost[$champs][$c]))
    					if(strtolower($lost[$champs][$c]) !== strtolower($v))
    						$set = true ;
    			if($set) 
    				$change .= "\n\t CHANGE COLUMN $champs ".get_column_def($champs,$prop);
    		}				
    		
    		foreach( $r['key'] as $champs => $key )
    		{
    			if(isset($lost[$champs]['key']))
    				if(is_string($lost[$champs]['key']))
    					if(!preg_match('/'.$lost[$champs]['key'].'/i',$key['key']))//if(strtolower($lost[$champs]['key']) !== strtolower($key['key']))
    						debug_log(" edit $champs -> key ".strtolower(trim($lost[$champs]['key']))." !== ".strtolower(trim($key['key']))."--") ;
    						
    			// on ne gere pas les clé etrangere
    			if(!isset($lost[$champs]['key']))
    				if(!preg_match('/FOREIGN/i',$key['key']))//(strtolower(trim($key['key']))!=='foreign')
    					debug_log(" missing $champs -> key ".strtolower(trim($key['key']))."--") ;
    		}
    		
    		$ash ="";
    		
    		if(isset($drop)&& $drop !=="") $ash .= $drop;
    		if(isset($add) && $add !=="") $ash .= $add;
    		if(isset($change) && $change !=="") $ash .= $change;
    		
    		$request ="";
    		
    		if( isset($ash) && $ash !=="" ) $request = "ALTER TABLE `$table` \n".$ash ;
    		
    		$request = rtrim($request,',');
    		
    		if(isset($request)  && $request !=="") 
    			return $request.";\n"; 
    		else
    			return null;
    	}
	}
	else
		return get_create_req($table, $r);
}

function test_db($table)
{
	$test_install = count_db('exists_t',array('table' => str_replace('Caranille_','%',$table) ));
	
	// la base existe, mais les tables n'ont pas étés générées...
	if(!$test_install) return false ;
    
    if($test_install==0)  return false ;
	
	return true ;
}

/**
 * //PEUT TU M'EXPLIQUER CE QUE TU AS FAIT DANS LA FUNCTION CreateDB ? car je suis perdu mdr Caranillle
 * genere et execute les requetes de creation de tables
 */
function create_db()
{
	//le mot clé "global" permet d'ouvrir la portée des variables
	global $db_mapping;
	
	//var_dump($bdd);
	
	// pour chaque table defini
	foreach($db_mapping as $table => $r )
	{
		if(!test_db($table))
			$requete = get_create_req($table,$r);
		else
			$requete = get_alter_req($table,$r);
		
		//if(!exec_db("DROP TABLE IF EXISTS `$table`", true))
		//    return false ;
		
		if(!exec_db($requete,true))
			return false ;
	}
	// toutes les requetes sont bien passées
	return true ;

}

function alter_db()
{
	//le mot clé "global" permet d'ouvrir la portée des variables
	global $db_mapping, $bdd;
	
	//var_dump($bdd);
	
	// pour chaque table defini
	foreach($db_mapping as $table => $r )
	{
		$req = get_alter_req($table,$r);
		
		exec_db($req);
	}
}

function delete_db($table,$data=array())
{
	//le mot clé "global" permet d'ouvrir la portée des variables
	global $bdd, $db_mapping;
	
	//debut de la requete
	$requete = 'DELETE FROM `'.$table.'` '; 
	
	// on recupere le mapping de la table en parametres
	$table_mapping = $db_mapping[$table] ;
	
	// pour chaque champs defini dans la table
	if(!empty($data))
	{
		$where =null ;
		
		foreach($table_mapping['champs'] as $champs => $t )
			if(isset($data[$champs])) // Si le champs est defini dans le tableau de données
				$where .= "\n".'`'.$champs.'` = "'.value_db($table,$champs,isset($data[$champs]) ? $data[$champs]: null,false ).'" AND'; // le champs et la données sont ajoutés dans la requete
		
		// on supprime une eventuelle virgule en trop
		$where = rtrim($where,'AND')."\n";
		
		if(!empty($data) && !is_null($where))
			$requete .= ' WHERE '.$where ;
	}	
	
    if(!empty($data)&& ( !isset($where)|| is_null($where)  )) // pas de correspondance entre les params et la table
		return false ;
    elseif(!empty($data)&& ( isset($where)|| !is_null($where)  )) // supprime enregistrement demandé
		return exec_db($requete, true);	
    elseif(empty($data)&& ( !isset($where)|| is_null($where)  )) //supprime toute la table
		return exec_db($requete, true);
    
}

function type_db($table,$champs)
{
	//le mot clé "global" permet d'ouvrir la portée des variables
	global $db_mapping;
	
	$browser = getBrowser(); // navigateur utilisé ???

	// on recupere le mapping de la table en parametres
	$table_mapping = $db_mapping[$table] ;
	
	 if(isset($table_mapping['key'][$champs])) $key = $table_mapping['key'][$champs];
	 
	 
 	$prop = $table_mapping['champs'][$champs];
 	
		//on genere la ligne HTML avec les propriétés defini dans le champ
		switch($prop['type'])// type du champs => balise input textarea ou select
		{
		    default:
			case 'VARCHAR' :
		    case 'varchar' :
		        $balise = 'input';
		        $type = 'text';
		    break;
		    
		    case 'TEXT' :
		    case 'text' :
		        $balise = 'textarea';
		        $type='area';
	        break;
	       
	        case 'datetime' :
		    case 'DATETIME' :
		        $balise = 'input';
				
				if(preg_match('/Chrome/i',$browser['name']))
					$type='datetime-local';
				else
				if(preg_match('/Safari/i',$browser['name']) || preg_match('/Opera/i',$browser['name']))
					$type='datetime'; 
				else
					$type = 'date';	        break;
	       
		   case 'MEDIUMINT';
		   case 'mediumint';
	       case 'BIGINT': 
	       case 'bigint': 
	       case 'INT' :
	       case 'int' :
		   case 'tinyint':
		   case 'TINYINT':
	           if(isset($table_mapping['key'][$champs])  && (preg_match('/FOREIGN/i',$key['key'])))//$key['key'] === 'FOREIGN' ) 
	           {
	               $type="foreign";
				   $balise ="select";
	           }
	           else
	           if(isset($prop['increment']))
	           {
	               $balise = 'input';
		           $type = 'hidden';
	           }
	           else
	           {
		             $balise = 'input';
		             $type = 'number';
	           }
	       break ;
		}
		
		
		return array($type , $balise);
}

function label_db($table,$champs,$type=null)
{
  	//le mot clé "global" permet d'ouvrir la portée des variables
	global $db_mapping;
	
	// on recupere le mapping de la table en parametres
	$table_mapping = $db_mapping[$table] ;
	
	//$key = $table_mapping['key'][$champs];
 	$prop = $table_mapping['champs'][$champs];
 	
 	if(is_null($type))
 		list($type , $balise) = type_db($table,$champs);

 	if(!isset($prop['increment']))
        return "\t\t<label class='$type' for='$champs'>".$prop['label']."</label>\n";
}

function value_db($table,$champs,$val=null,$type=null, $form=true,$show = false)
{
    	//le mot clé "global" permet d'ouvrir la portée des variables
	global $db_mapping;
	
	// on recupere le mapping de la table en parametres
	$table_mapping = $db_mapping[$table] ;
	
	if(isset($table_mapping['key'][$champs])) $key = $table_mapping['key'][$champs];
 	$prop = $table_mapping['champs'][$champs];
 	
 	if(is_null($type))
 		list($type , $balise) = type_db($table,$champs);
 		
		if($type==='date') 
		{
		    $d = new DateTime($val);
		    
		    $value = $d->format("Y-m-d".(!$form?" H:i:s":""));
		}
		else
		if(isset( $val )) // Si le champs est defini dans le tableau de données
		{
            //$value = isset($prop['html']) ? $val : strip_tags($val);
            
            if(isset($table_mapping['key'][$champs]) && preg_match('/FOREIGN/i',$key['key']) && $show)
            {
                $value = get_foreign_value_db($table,$champs,$val);
            }
            else
            {
                if(is_numeric($val))
                {
                    $value = floatval($val);
                }
                else
                {
                   $value = addslashes_r($val , (isset($prop['default']) ? $prop['default'] : "" ), ( isset($prop['html']) ? true: false ));
                }
            }  
        }
        else
    	if(isset($prop['default'])) // si le champs a une valeur par defaut
	    	$value = $prop['default'];
		else
		    $value = ""; // sionon le champs a une valeur nulle
		
		return $value ;
}

function get_foreign_value_db($table,$champs,$value)
{
    	//le mot clé "global" permet d'ouvrir la portée des variables
	global $db_mapping;
	
	//echo "args::".print_r(func_get_args(),1)."<br/>";
	
	// on recupere le mapping de la table en parametres
	$table_mapping = $db_mapping[$table] ;
	
	if(isset($table_mapping['key'][$champs]))
	{
		$key = $table_mapping['key'][$champs];
	
		if(preg_match('/FOREIGN/i',$key['key']))// $key['key'] === 'FOREIGN')
		{
			$e = get_db('foreign_val',array(
				"ordering" => $key['toString'],
				"table" => $key['table'],
				"ID" => $key['champs'],
				"value" => $value
			));
			
			$stringify = $key['toString'] ;
			
			return $e[$stringify] ;
		}
	}
}

function get_html_select_db($table,$f_champs,$stringify,$champs, $value= null)
{	
	$List = list_db("order_list_t", array(
		'table' => $table ,
		'ordering' => $f_champs
	));
												$form = "<select name='$champs' >";
												$form .= "<option>Selectionner</option>";
   if(!empty($List))	foreach($List as $val)	$form .= "<option ".($value==$val[$f_champs] ? 'selected' :'')." value='".$val[$f_champs]."'>".$val[$stringify]."</option>";
												$form .= "</select>";
												
	return $form ;
}

function input_db($table,$champs,$value=null,$type=null,$balise=null)
{
    	//le mot clé "global" permet d'ouvrir la portée des variables
	global $db_mapping;
	
	//echo "args::".print_r(func_get_args(),1)."<br/>";
	
	// on recupere le mapping de la table en parametres
	$table_mapping = $db_mapping[$table] ;
	
	if(isset($table_mapping['key'][$champs])) $key = $table_mapping['key'][$champs];
	
 	$prop = $table_mapping['champs'][$champs];
 	
  	if(is_null($type) || is_null($balise))
 		list($type , $balise) = type_db($table,$champs);

 	
 	        $form = "\t\t\t";
        if(isset($prop['values']))
        {
			$form .= "<select name='$champs' >";
			$form .= "<option>Selectionner</option>";
            foreach($prop['values'] as $k => $val) 
			{
				if(is_array($val))
				{
					$form .= "<optgroup label='$k'>";
					foreach($val as $v)
					$form .= "<option ".($value==$v ? 'selected' :'')." value='$v'>$v</option>";
					$form .= "</optgroup>";
				}
				else
				{
					$form .= "<option ".($value==$val ? 'selected' :'')." value='$val'>$val</option>";
				}
			}
            $form .= "</select>";
        }
        else
	    if(isset($table_mapping['key'][$champs]) && preg_match('/FOREIGN/i',$key['key']))//$key['key'] === 'FOREIGN')
	    {
			$f_champs = $key['champs'];
            $stringify = $key['toString'];
			$table = $key['table'];
			
			$form .= get_html_select_db($table,$f_champs,$stringify,$champs,$value);
	    }
        else
        if($balise === 'input') 
        {
            $form .= "<input type='$type' name='$champs' value ='$value' />"; //	if(isset($prop['length']))
        }
        else
        if($balise === 'textarea') 
        {
            if(isset($prop['html']) && $prop['html']=== true)
			{
				$form .= call_wysiwyg($champs,$value);
			}
			else
			{
				$form .="<textarea name='$champs'>$value</textarea>";
			}
        }
        else
        {
            $form .= "<input type='$type' name='$champs' value ='$value' />"; //	if(isset($prop['length']))
        }
        
        $form .="\n";
	
	return $form ;
}

function line_db($table,$champs,$val=null)
{
  	//le mot clé "global" permet d'ouvrir la portée des variables
	global $bdd, $db_mapping;
	
    list($type , $balise) = type_db($table,$champs);
		
		$value = value_db($table,$champs,$val,$type);
		
		//echo "value::$value<br/>";
		
        $form = "\t<div class='line'>\n";
        $form .= label_db($table,$champs,$type);
        $form .= input_db($table,$champs,$value,$type,$balise);
        $form .= "\t</div>\n"; // fin de la ligne 
        
    return $form;
}

function line_show_db($table,$champs,$val=null)
{
  	//le mot clé "global" permet d'ouvrir la portée des variables
	global $bdd, $db_mapping;
	
    list($type , $balise) = type_db($table,$champs);
		
		$value = value_db($table,$champs,$val,$type,false,true);
		
		//echo "value::$value<br/>";
		
        $form = "\t<div class='line'>\n";
        $form .= label_db($table,$champs,$type);
        $form .= "<span class='reponse'>$value</span>";
        $form .= "\t</div>\n"; // fin de la ligne 
        
    return $form;
}

/**
 * genere à la volée le visu de la table en parametre
 */
function show_db($table,$data=array())
{
  	//le mot clé "global" permet d'ouvrir la portée des variables
	global $bdd, $db_mapping;
	
	//debut de la requete
    $form = "<div class='form'>";
    
 	// on recupere le mapping de la table en parametres
	$table_mapping = $db_mapping[$table] ;
   	// pour chaque champs defini dans la table
	foreach( $table_mapping['champs'] as $champs => $prop )
	{
		//if(isset($table_mapping['key'][$champs])) $key = $table_mapping['key'][$champs];
		//if(!isset($prop['increment']))
			$form .= line_show_db($table,$champs,isset($data[$champs])? $data[$champs] : null);
	//	if(isset($prop['length'])) $length = $prop['length']; 	// longueur du champs

	}
    
    $form .= "</div>";
    
    return $form ;
}

/**
 * genere à la volée le formulaire de la table en parametre
 */
function forumulaire_db($table,$data=array())
{
  	//le mot clé "global" permet d'ouvrir la portée des variables
	global $bdd, $db_mapping;
	
	//debut de la requete
    $form = "<div class='form'>";
    
 	// on recupere le mapping de la table en parametres
	$table_mapping = $db_mapping[$table] ;
   	// pour chaque champs defini dans la table
	foreach( $table_mapping['champs'] as $champs => $prop )
	{
		//if(isset($table_mapping['key'][$champs])) $key = $table_mapping['key'][$champs];
		//if(!isset($prop['increment']))
			$form .= line_db($table,$champs,isset($data[$champs])? $data[$champs] : null);
	//	if(isset($prop['length'])) $length = $prop['length']; 	// longueur du champs

	}
    
    $form .= "</div>";
    
    return $form ;
}

function list_html($List=array(),$table,$page,$header=array(),$add=true,$edit=true,$remove=true,$show=true)
{
	global $db_mapping , $secteur_module ;
// on recupere le mapping de la table en parametres
	$table_mapping = $db_mapping[$table] ;
   
   	//echo 'Voici la liste des chapitres du MMORPG<br /><br />';
	echo '<table class="Admin list">' ;
	echo '<tr>' ;
				
	foreach( $table_mapping['champs'] as $champs => $prop )
	{
	    if(in_array($champs,$header))
			echo '<th>'.$prop['label'].'</th>';
			
		if(	isset($prop['increment']))
			$primary[] = $champs;
	
		if(	isset($prop['Ordering']))
			$orderer = $champs;
	}
	
	foreach($table_mapping['key'] as $champs => $r)
		if(preg_match('/PRIMARY/i',$r['key']))//($r['key']=='PRIMARY')
			 $primary[] = $champs ;
 	   //if(isset($prop['increment']))
	
	echo '<th '.(isset($orderer) ? "colspan='3'" : "" ).'>';
	if($add)
	{
		//echo '<form method="POST" action="'.get_link($page,'Admin').'" >';
		//echo '<input type="submit" name="Add" value="&plus;"/>';
		//echo '</form>';
		
		echo '<a href="'.get_link($page,$secteur_module,array('Add'=>'one')).'">&plus;</a>';
	}
	echo '</th>';
	echo '</tr>' ;
	
	$ct = count($List) ;
	
	if(!empty($List))
	{
		foreach ($List as $Chapter)
		{
			//$Chapter_ID = stripslashes($Chapter[$primary]);
			
			$push = array();
			
			echo '<tr>' ;

			foreach( $table_mapping['champs'] as $champs => $prop )
			{
				if(in_array($champs,$header))
				{
					echo '<td>';
					
					if(isset($table_mapping['key'][$champs]))
					{
						$key = $table_mapping['key'][$champs];
	
						if(preg_match('/FOREIGN/i',$key['key']))//( $key['key'] === 'FOREIGN')
							echo get_foreign_value_db($table,$champs,$Chapter[$champs]);//'get_foreign...';
						else
							echo $Chapter[$champs];
					}
					else
					{
						echo $Chapter[$champs];
					}
					echo '</td>';
				}
			}
			
	    	foreach($primary as $_id_)
				$push[$_id_] = $Chapter[$_id_];
						
			if(	isset($orderer))//isset($prop['Ordering']))
			{
				$push[$orderer] = $Chapter[$orderer];
			  
				echo "<td>";
				if( $Chapter[$orderer] != 1)
				{
				    
					/*	echo "<form method='post' action='".get_link($page,'Admin')."'>";
					foreach($primary as $_id_)
						echo '<input type="hidden" name="'.$_id_.'" value="'.$Chapter[$_id_].'"/>';
						echo '<input type="hidden" name="'.$orderer.'" value="'.$Chapter[$orderer].'"/>';
						echo "<input type='submit' name='up_rank' value='&uArr;' />";
						echo "</form >";
					*/
					$push['up_rank'] = 'one';
						
	            	echo '<a href="'.get_link($page,$secteur_module,$push).'">&uArr;</a>';
	            	
					unset($push['up_rank']);
				}
				echo "</td>";
				echo "<td>";

				if( $Chapter[$orderer] != $ct)
				{
					/*	echo "<form method='post' action='".get_link($page,'Admin')."'>";
					foreach($primary as $_id_)
						echo '<input type="hidden" name="'.$_id_.'" value="'.$Chapter[$_id_].'"/>';
						echo '<input type="hidden" name="'.$orderer.'" value="'.$Chapter[$orderer].'"/>';
						echo "<input type='submit' name='down_rank' value='&dArr;' />";
						echo "</form>";
					*/	
						$push['down_rank'] = 'one';
						
	            	echo '<a href="'.get_link($page,$secteur_module,$push).'">&dArr;</a>';
					unset($push['down_rank']);
				}
				echo "</td>";
			}
			
			echo '<td>';
			/**
			echo '<form method="POST" action="'.get_link($page,'Admin').'">';
			
			foreach($primary as $_id_)
				echo '<input type="hidden" name="'.$_id_.'" value="'.$Chapter[$_id_].'"/>';
				
			if($edit)
				echo '<input type="submit" name="Second_Edit" value="&check;"/>';
			if($remove)
				echo '<input type="submit" name="Second_Delete" value="&cross;"/>';
				
			echo '</form>';
			**/
			if($show)
			{
					$push['Second_Show'] = 'one';
						
	            	echo '<a href="'.get_link($page,$secteur_module,$push).'">&sharp;</a>';
	            	
					unset($push['Second_Show']);
			}
			
			if($edit)
			{
					$push['Second_Edit'] = 'one';
						
	            	echo '<a href="'.get_link($page,$secteur_module,$push).'">&check;</a>';
	            	
					unset($push['Second_Edit']);
			}
			
			if($remove)
			{
				echo init_popIn('remove-'.implode($push,"-").'-form',"Suppression",confirm_remove_db($table,$page,$push[$_id_]),'remove-link');
			}
			
			echo '</td>';
			echo '</tr>' ;
		}
	}
	
	echo '<tr><td colspan="">'.$ct.' résultat(s)</td></tr>';
	echo '</table>' ;
}

function move_db($table, $ID, $dir)
{
	global $db_mapping;
// on recupere le mapping de la table en parametres
	$table_mapping = $db_mapping[$table] ;
/**   
   	foreach($table_mapping['key'] as $champs => $r)
		if(preg_match('/PRIMARY/i',$r['key']))//($r['key']=='PRIMARY')
			 $primary[] = $champs ;
**/
	foreach( $table_mapping['champs'] as $champs => $prop )
	{
		if(	isset($prop['increment']))
			$primary = $champs;
	
		if(	isset($prop['Ordering']))
			$orderer = $champs;
	}
	
		$nbSsRub = count_db('list_t',array('table'=>$table)); 
		
		$rubToOrder = get_db('edit_admin',array(
				'table' => $table
			, 	'ID'	=> $primary
			,	'value'	=> $ID
		)); 
		
		// J'update la rubrique colatérale
		if($dir=="up")
		{
			$nouvelOrdre = $rubToOrder[$orderer] - 1;
			if($nouvelOrdre < 1)$nouvelOrdre = 1;
				
			$req = "UPDATE `".$table."` SET `".$orderer."`=`".$orderer."`+1 WHERE `".$orderer."`='".$nouvelOrdre."' limit 1;";
			exec_db($req);
			$req = "UPDATE `".$table."` SET `".$orderer."`='".$nouvelOrdre."' WHERE `".$primary."`=".$ID;
			exec_db($req);
		}
		else if($dir=="down")
		{
			$nouvelOrdre = $rubToOrder[$orderer] + 1;
			if($nouvelOrdre > $nbSsRub) $nouvelOrdre = $nbSsRub ;
			
			$req = "UPDATE `".$table."` SET `".$orderer."`=`".$orderer."`-1 WHERE `".$orderer."`='".$nouvelOrdre."' limit 1;";
			exec_db($req);
			$req = "UPDATE `".$table."` SET `".$orderer."`='".$nouvelOrdre."' WHERE `".$primary."`=".$ID;
			exec_db($req);
		}
}

function list_html_db($table,$page,$header=array())
{	
	global $db_mapping;
// on recupere le mapping de la table en parametres
	$table_mapping = $db_mapping[$table] ;
   
			
	foreach( $table_mapping['champs'] as $champs => $prop )
	{
		if(	isset($prop['increment']))
			$primary = $champs;
	
		if(	isset($prop['Ordering']))
			$orderer = $champs;
	}
   
	foreach($table_mapping['key'] as $champs => $r)
		if(preg_match('/PRIMARY/i',$r['key']))//($r['key']=='PRIMARY')
			$primary = $champs;
			
	$List = list_db("order_list_t", array(
		'table' => $table ,
		'ordering' => (isset($orderer) ? $orderer : $primary)
	));
	
	//.(isset($orderer) ? "ORDER BY `$orderer` ASC" : "ORDER BY `$primary` ASC") );
	
	list_html($List,$table,$page,$header);
}

function confirm_remove_db($table,$page,$ID)
{
	global $db_mapping , $secteur_module ;
		// on recupere le mapping de la table en parametres
	$table_mapping = $db_mapping[$table] ;
	
	$ids = null ;
	
	foreach($table_mapping['key'] as $champs => $r)
		if(preg_match('/PRIMARY/i',$r['key']))//($r['key']=='PRIMARY')
			$ids = $champs;

	return '
            <p>Supprimer definitivement ?</p>
			<form method="POST" action="'. get_link($page,$secteur_module) .'">
				<input type="hidden" name="'. $ids .'" value="'. $ID .'"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
			</form>
		';
}

function get_insert_req($table,$data=array())
{
	//le mot clé "global" permet d'ouvrir la portée des variables
	global $db_mapping;
	
	//debut de la requete
	$requete = 'INSERT INTO `'.$table.'` SET '; 
	
	// on recupere le mapping de la table en parametres
	$table_mapping = $db_mapping[$table] ;
	
	$set ="";
	
	// pour chaque champs defini dans la table
	foreach($table_mapping['champs'] as $champs => $t )
		if(isset($data[$champs])) // Si le champs est defini dans le tableau de données
			$set .= "\n\t".'`'.$champs.'` = "'.value_db($table,$champs,isset($data[$champs]) ? $data[$champs]: null,false ).'",'; // le champs et la données sont ajoutés dans la requete

	if($set !== "")
	{		
		// on supprime une eventuelle virgule en trop
		$requete .= rtrim($set,',').";\n";
		
		return $requete ;
	}
	else 
	{
		debug_log("insert_db()=> aucune valeur à enregistrer....");
	}
	return false ;
}

/**
 * genere et execute les requetes d'insertion en base de données
 */
function insert_db($table,$data=array())
{
	global $last_insert_db ;
	
	$requete = get_insert_req($table,$data);
	
    if($requete!==false)
	{
		$xec = exec_db($requete, true);
		
		debug_log("last_insert_db(insert_db) : $last_insert_db");
		
		return $last_insert_db ;//last_id_db();
	}
}

function update_db($table,$data=array())
{
	//le mot clé "global" permet d'ouvrir la portée des variables
	global $bdd, $db_mapping;
	
	//debut de la requete
	$requete = 'UPDATE `'.$table.'` SET '; 
	
	// on recupere le mapping de la table en parametres
	$table_mapping = $db_mapping[$table] ;
	
	$ids = array();
	
	foreach($table_mapping['key'] as $champs => $r)
		if(preg_match('/PRIMARY/i',$r['key']))//($r['key']=='PRIMARY')
			$ids[] = $champs;
	
	//print_r($data);
	
	$set = "" ;
	
	// pour chaque champs defini dans la table
	foreach($table_mapping['champs'] as $champs => $t )
		if(isset($data[$champs])) // Si le champs est defini dans le tableau de données
			if(!in_array($champs,$ids) )
				$set .= " \n".'`'.$champs.'` = "'.value_db($table,$champs,isset($data[$champs]) ? $data[$champs]: null,false ).'",'; // le champs et la données sont ajoutés dans la requete
	
	if($set !=="")
	{
		// on supprime une eventuelle virgule en trop
		$requete .= rtrim($set,',')."\n";

		//print_r($ids);
		
		$where_ids = "";
		
		foreach($ids as $id)
			$where_ids .=" `".$id."` = '".value_db($table,$id,isset($data[$id]) ?$data[$id]: null,false )."' AND";
		
		$where_ids = rtrim($where_ids,'AND');
		
		$requete .= " WHERE $where_ids ; ";
		
		//echo "<pre>$requete</pre><br/>";

		
		return exec_db($requete , true);
	}
	else 
	{
		debug_log("update_db()=> aucune valeur à mettre à jour....");
	}
}

/**
 * gestion des select
 * retablit une preparation des requetes
 * séparer les requêtes SQL de l'exécution - on reinvente la roue.
 * pouvoir donner la possibilité - à l'installation - de choisir 
 * -- une sauvegarde en base de données ou 
 * -- une sauvegarde en fichiers( si l'utilisateur ne dispose pas d'un serveur SQL)
 * 
 * remplacer les variables key mis entre []  par leur correspondant $prop dans le array $data et trouver un $sql[indice] qui n'a pas été utilisé
 */
function get_select_req($indice='list_comments',$data=null)
{
	global $sql, $db_mapping; // on charge le tableau des requetes
	
	if(isset($sql[$indice])) // si indice correspond à une requete
	{
		$template = $sql[$indice]; // on recupere la requete à preparer
				
		if(!empty($data) && is_array($data)) // si data est bien un tableau 
		{
			foreach ($data as $key => $prop) 
			{
				debug_log( "remplacer '[$key]' par "."'($prop)'"." dans '{$template}"); // on trace la piste de la requete
				
				if(is_string($prop) && array_key_exists($prop,$db_mapping)) // si $prop correspond à une table dans le mapping
				{
					$template = str_replace( "[$key]" , "`".$prop."`" , $template);
				}
			else
				if($key === 'ordering' || $key === 'ID' ) // si $prop correspond a un champs dans le mapping
				{
					$template = str_replace( "[$key]" , "`".$prop."`" , $template);
				}
			else
				if(is_string($prop) ) // si prop est une chaine de caractere
				{
					$template = str_replace( "[$key]" , "'".$prop."'" , $template);
				}
			else
				if(is_int(intval($prop)) ) //si $prop est une valeur numérique
				{
					debug_log( "$prop est numerique non null");
					$template = str_replace( "[$key]" , $prop , $template);
				}
			else
				{
					debug_log( "$prop n'est pas numerique non null");
					$template = str_replace( "[$key]" , "'".$prop."'" , $template);
				}
			}
		}	
	/**	
		if(is_string($data))
		{
			$template = str_replace( "[$key]" , "'".$data."'" , $template);
		}
	**/	
		debug_log($template,false);
				
		return $template ; // on retourne la requete finalisée
	}
}
/**
 *  doit exister un equivalent avec lecture de fichier...
 */
function count_db($indice='list_comments',$data=null)
{
	$requete =  get_select_req($indice,$data);
	$exec = exec_db($requete);
	
	if($exec!==false)
	{
		$c_Login = $exec->rowCount();
	
		$exec->closeCursor();
		
		return $c_Login;
	}	
}

/**
 *  doit exister un equivalent avec lecture de fichier...
 */
function get_db($indice='list_comments',$data=null)
{
	$requete =  get_select_req($indice,$data);
	$exec = exec_db($requete);
	
	if($exec!==false)
	{	
		$presentation = $exec->fetch(PDO::FETCH_ASSOC);
		
		$exec->closeCursor();
		
		if(!empty($presentation))
		{
		    foreach($presentation as $r => $value)
			{
				$presentation[$r] = str_replace('<?php','-nowayman-',$value);
				$presentation[$r] = str_replace('<script>','-nowayman2-',$value);
			}
			
			return $presentation;
		}
	}	
	return null ;
}

/**
 *  doit exister un equivalent avec lecture de fichier...
 */
function list_db($indice='list_comments',$data=null)
{
	$requete =  get_select_req($indice,$data);
	$exec = exec_db($requete);
	$array = array();
	
	if($exec!==false)
	{
		//var_dump($exec);
		
		while($presentation = $exec->fetch(PDO::FETCH_ASSOC))
        {
			foreach($presentation as $r => $value)
			{
				$presentation[$r] = str_replace('<?php','-nowayman-',$value);
				$presentation[$r] = str_replace('<script>','-nowayman2-',$value);
			}
			
			$array[] = $presentation;
		}	
		$exec->closeCursor();
	}
	
	if(!empty($array))
		return $array ;
		
	return null ;
}

function dump_db() 
{
	//le mot clé "global" permet d'ouvrir la portée des variables
	global $db_mapping, $_path;
	// création d'un fichier affichant en boucle le contenu des tuples de la base :
	
	foreach($db_mapping as $table => $r )
	{
		$dumpsql[] = get_create_req($table,$r);
		
		$req_table = list_db("list_t", array("table" => $table));
		
		if(!empty($req_table))	
			foreach($req_table as $record)
				$dumpsql[] = get_insert_req($table,$record);
			
	}	
		// création du fichier de dump 
	$exec = log_files("dump","sqldump_".date("Y-m-d-h-i-s").".sql", implode("\r\r", $dumpsql) );
	
	return ($exec!==false ?  true : false) ;

}
 
function set_values_db($table,$champs,$values)
 {
	global $db_mapping;
	
	if(isset($db_mapping[$table]))
		if(isset($db_mapping[$table]['champs'][$champs]))
			if(is_array($db_mapping[$table]['champs'][$champs]['values']))
				$db_mapping[$table]['champs'][$champs]['values'] = $values ;
 }

?>