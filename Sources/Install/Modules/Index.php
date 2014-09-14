<?php

function create_config()
{
	if (request_confirm('Create_Configuration'))
	{
		extract($_POST);
		
		/**
		 * update by Dimitri
		 */		
       	
        $way = str_replace ('index.php','',getenv('SCRIPT_FILENAME'));
        $way = str_replace ('Install/','',$way);
        $url = get_url();

		// le principe fonctionne meme s'il n'y a pas de sous dossier
		// l'interet principale est de pouvoir utiliser des chemins absolus dans les liens ou dans les inclusions de fichiers
		$p_salt = uniqid(mt_rand(), true);
		$s_salt = uniqid(mt_rand(), true);
				
		if($Open_Config = fopen("Config.php", "w"))
		{
            fwrite($Open_Config, "<?php

        		//Version du rpg de Caranille
        		\$version = \"4.8.0\";
        				
        		\$dns_host = '$Driver:host=$Server;dbname=$Database';
        		\$dns_user = '$User';
        		\$dns_pswd = '$Password';
        		
        		\$_path = \"$way\";
        		\$_url = \"$url\";
        		
        		\$prefixe_salt = \"$p_salt\";
        		\$suffixe_salt = \"$s_salt\";
        		
        		date_default_timezone_set(\"$Fuseaux\");
        		
        		setlocale(LC_ALL, \"$Locale\");
		
            ?>");
			fclose($Open_Config);
			return true ;
		}
	}				

	if(request_confirm('step') && request_get('step') === 2)
	{
		return true;
	}
}

/**
 * gerer la creation de .htacess dans les repertoire....
 * on peut alors envisager  de simuler la réecriture d'URL
 * tous les liens mene vers index.php
 * où on gere le dispatch de la requete
 * et l'affichage des modules'
 */
function create_htaccess($module="")
{
	global $_rewrite;
	
	if($_rewrite)
	{
		$dir = ($module === "" ? "" : $module."/" );
		
		$way = str_replace ('index.php','',getenv('SCRIPT_FILENAME'));
		$way = str_replace ('Install/','',$way);
		$way = str_replace (getenv('DOCUMENT_ROOT'),'',$way);

		
		if($Open_Config = fopen($dir.".htaccess", "w"))
		{
			fwrite($Open_Config, "
<IfModule mod_rewrite.c>

    Options +FollowSymLinks
    Options +Indexes
    RewriteEngine On
    
    RewriteBase /".$way.$dir."index.php 
    
    # lecture systématique vers index.php
    RewriteRule ^(.*).html$ /".$way.$dir."index.php  [L] 
    
</IfModule>

# redirection systématique vers index
ErrorDocument 404 /".$way.$dir."index.php

<IfModule mod_speling.c> 
    CheckSpelling off 
    CheckCaseOnly off
</IfModule>

            ");
			fclose($Open_Config);
			return true ;
		}
	}
}

function install_forum()
{

	insert_db('Caranille_Categories', array('Cat_ID'=> 1, 'Cat_Ordre'=>30 , 'Cat_Nom'=>'Général' ));
	insert_db('Caranille_Categories', array('Cat_ID'=> 2, 'Cat_Ordre'=>20 , 'Cat_Nom'=> 'Jeux-Vidéos' ));
	insert_db('Caranille_Categories', array('Cat_ID'=> 3, 'Cat_Ordre'=>10 , 'Cat_Nom'=> 'Autre'));

	insert_db('Caranille_Forums', array('Forum_ID'=> 1, 'Forum_Cat_ID'=> 1, 'Forum_Ordre'=> 60 , 'Forum_Name'=>'Présentation' , 'Forum_Desc'=> 'Nouveau sur le forum? Venez vous présenter ici !')); 
	insert_db('Caranille_Forums', array('Forum_ID'=> 2, 'Forum_Cat_ID'=> 1, 'Forum_Ordre'=> 50 , 'Forum_Name'=> 'Les News', 'Forum_Desc'=> 'Les news du site sont ici' ));
	insert_db('Caranille_Forums', array('Forum_ID'=> 3, 'Forum_Cat_ID'=> 1, 'Forum_Ordre'=> 40 , 'Forum_Name'=>'Discussions générales' , 'Forum_Desc'=> 'Ici on peut parler de tout sur tous les sujets')); 
	insert_db('Caranille_Forums', array('Forum_ID'=> 4, 'Forum_Cat_ID'=> 2, 'Forum_Ordre'=> 60 , 'Forum_Name'=> 'MMORPG', 'Forum_Desc'=> 'Parlez ici des MMORPG')); 
	insert_db('Caranille_Forums', array('Forum_ID'=> 5, 'Forum_Cat_ID'=> 2, 'Forum_Ordre'=> 50 , 'Forum_Name'=> 'Autres jeux', 'Forum_Desc'=> 'Forum sur les autres jeux')); 
	insert_db('Caranille_Forums', array('Forum_ID'=> 6, 'Forum_Cat_ID'=> 3, 'Forum_Ordre'=> 60 , 'Forum_Name'=> 'Loisir', 'Forum_Desc'=>'Vos loisirs')); 
	insert_db('Caranille_Forums', array('Forum_ID'=> 7, 'Forum_Cat_ID'=> 3, 'Forum_Ordre'=> 50 , 'Forum_Name'=> 'Délires', 'Forum_Desc'=> 'Décrivez ici tous vos délires les plus fous')); 
}

function config_forum()
{
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'avatar_maxsize', 'Configuration_Value' =>'10000'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'avatar_maxh', 'Configuration_Value' =>'100')); 
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'avatar_maxl', 'Configuration_Value' =>'100')); 
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'sign_maxl', 'Configuration_Value' =>'200'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'auth_bbcode_sign', 'Configuration_Value' =>'Yes'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'pseudo_maxsize', 'Configuration_Value' =>'15'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'pseudo_minsize','Configuration_Value' => '3'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'topic_par_page','Configuration_Value' => '20'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'post_par_page', 'Configuration_Value' =>'15'));
}

function config_game($mail_admin)
{
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_battle', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_prospection', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_prospection', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_minage', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_coupe', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_culture', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_chasse', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_taille', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_orfevrerie', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_scierie', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_distillerie', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_tannerie', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_bijouterie', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_forge', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_papeterie', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_herborisme', 'Configuration_Value' =>'1.1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_malus_couture', 'Configuration_Value' =>'1.1'));
	
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'tx_money', 'Configuration_Value' =>'1000'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'nb_money', 'Configuration_Value' =>'3'));
	
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'rayon_map', 'Configuration_Value' =>'8'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'rayon_city', 'Configuration_Value' =>'4'));
	
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'try_connect', 'Configuration_Value' =>'3'));
	
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'top_members_limit', 'Configuration_Value' =>'3'));
	
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'max_membres_roaster', 'Configuration_Value' =>'5'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'bonus_roaster', 'Configuration_Value' =>'5'));

	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'GUILD_MIN_MEMBERS', 'Configuration_Value' =>'1'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'GUILD_MIN_GOLDS', 'Configuration_Value' =>'1'));
	
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'percent_life_restore_arena', 'Configuration_Value' =>'50'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'percent_life_restore_chapter', 'Configuration_Value' =>'25'));
	
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'marge_connected', 'Configuration_Value' =>'30'));
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'ln', 'Configuration_Value' => 'fr')) ;
	insert_db('Caranille_Configuration',array ('Configuration_Name' =>'email_expediteur', 'Configuration_Value' =>$mail_admin)); 
    insert_db('Caranille_Configuration',array ('Configuration_Name' =>'email_reply', 'Configuration_Value' =>'no-reply'.$mail_admin));  
}

function register_admin()
{
	global $bdd, $prefixe_salt, $suffixe_salt;
	
	extract(addslashes_r($_POST));
		
	echo "$Password === $Password_Confirm<br/>";
		
	if ($Password === $Password_Confirm)
	{
		$Date = date('Y-m-d H:i:s');
		$IP = getRealIpAddr();

		$filter = uniqid();
		$pswd = password_encode($prefixe_salt.$filter.$suffixe_salt, $Password)		;
		
		//echo "saisie : $Password<br/>clé : ($prefixe_salt - $filter - $suffixe_salt)=>crypté : $pswd<br/>";
		
		$decode = password_decode($prefixe_salt.$filter.$suffixe_salt, $pswd) ;	
		
		//echo " ctrl :: $decode <br/>";
				
		insert_db('Caranille_Accounts',array(
			'Account_Pseudo' => $Pseudo, 
			'Account_Password' => $pswd, 
			'Account_Salt' => $filter, 
			'Account_Email' => $Email, 
			'Account_Last_Connection' => $Date, 
			'Account_Last_IP' => $IP ,
            'Account_HP_Remaining' => 100,
            'Account_Level' => 1 ,
			'Account_Order' => 1 ,
			'Account_Valid' => 1 ,
			'Account_Reason' => 'None',
			'Account_Status' => "Authorized",
			'Account_Access' => "Admin",
			'Account_ID' => 1 ,
			'Account_Guild_ID' => 0,
			'Account_HP_Bonus' => 0,
			'Account_MP_Remaining' => 10,
			'Account_MP_Bonus' => 0,
			'Account_Strength_Bonus' => 0,
			'Account_Magic_Bonus' => 0,
			'Account_Agility_Bonus' => 0,
			'Account_Defense_Bonus' => 0,
			'Account_Experience' => 0,
			'Account_Golds' => 0,
			'Account_Notoriety' => 0,
			'Account_Chapter' => 1,
			'Account_Mission' => 1
		));
		
		config_game($Email);
		
		return true ;
		
	}
	
	return false ;
}

/** 
modifie l'etape d'installation dans la base de données
en relattion avec une fonction verif_install() qui 
**/
function install_edit_step_record($step = 3)
{	
	if($step === 3)
	{
		insert_db('Caranille_Configuration' , array(
			'Configuration_Name' => 'install-step',
			'Configuration_Value' => $step
		));
	}
	else
	{
		update_db('Caranille_Configuration' , array(
			'Configuration_Name' => 'install-step',
			'Configuration_Value' => $step
		));
	}
}	

function register_config()
{
	global $bdd ;
	
	extract(addslashes_r($_POST));

	// le jeu est accessible
	insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'MMORPG_Access',
			'Configuration_Value' => 'Yes', 
	));
	
	// le graphisme par defaut
	insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'MMORPG_Template',
			'Configuration_Value' => 'Caranille_dev', 
	));
	
	// le nom du jeu
	insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'MMORPG_Name',
			'Configuration_Value' => $MMORPG_Name, 
	));
	
	insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'MMORPG_Language',
			'Configuration_Value' => 'fr', 
	));
	
	// la presentation du jeu
	$create = insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'MMORPG_Presentation',
			'Configuration_Value' => $MMORPG_Presentation,
	));
	
	return true ; 
}

function record_curve()
{
	global $array_character_type;
	
	foreach($array_character_type as $type)
		insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'curve-'.$type,
			'Configuration_Value' => $_POST[$type.'_Level']
		));

	insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'curve-Experience',
			'Configuration_Value' => $_POST['Experience_Level']
	));
	
}

function config_ville()
{
	insert_db('Caranille_Towns',array(
				'Town_ID' => 1,
				'Town_Name' => 'Indicia', 
				'Town_Description' => 'Petite ville cotière',
				'Town_Price_INN' => 10,
				'Town_Chapter' => 1,
	            'Town_PosX' => -1,
			    'Town_PosY' => 3,
			    'Town_Landing' => 'sand',
			));
			
}

function config_invocation()
{
	insert_db('Caranille_Invocations',array(
				'Invocation_ID' => 1,
				'Invocation_Name' => 'Trident', 
				'Invocation_Description' => 'Chimère qui provient du fond des océans',
				'Invocation_Damage' => 10,
				'Invocation_Town' => 1,
				'Invocation_Price' => 200
			));
	
	insert_db('Caranille_Inventory_Invocations' , array(
				'Inventory_Invocation_Account_ID' => 1,
				'Inventory_Invocation_Invocation_ID' => 1,
			));
			
}

function config_magic()
{
	insert_db('Caranille_Magics' , array(
		'Magic_ID' => 1 ,
		'Magic_Image' => 'http://localhost',	
		'Magic_Name' => 'Feu',
		'Magic_Description' => 'Petite boule de feu',
		'Magic_Type' => 'Attack',
		'Magic_Effect' => 5,
		'Magic_MP_Cost' => 10,
		'Magic_Town' => 1,
		'Magic_Price' => 50
	));
	
	insert_db('Caranille_Magics' , array(
		'Magic_ID' => 2 ,
		'Magic_Image' => 'http://localhost',	
		'Magic_Name' => 'Soin',
		'Magic_Description' => 'Un peu de HP en plus',
		'Magic_Type' => 'Health',
		'Magic_Effect' => 10,
		'Magic_MP_Cost' => 5,
		'Magic_Town' => 1,
		'Magic_Price' => 50
	));
	
	insert_db('Caranille_Inventory_Magics' , array(
		'Inventory_Magic_Account_ID' => 1,
		'Inventory_Magic_Magic_ID' => 1
	));
			
}

function config_order()
{
	insert_db('Caranille_Orders' , array(
				'Order_ID' => 1 ,
				'Order_Name' => 'Neutre',
				'Order_Description' => 'Ordre par défaut'
			));
			
			insert_db('Caranille_Orders' , array(
				'Order_ID' => 2 ,
				'Order_Name' => 'Ange',
				'Order_Description' => 'Les anges sont des gens qui vivent pour aider les autres au prix de leur vie'
			));
			
			insert_db('Caranille_Orders' , array(
				'Order_ID' => 3 ,
				'Order_Name' => 'Demon',
				'Order_Description' => 'Les démons sont des gens peut scrupuleux et qui ont une soif de pouvoir'
			));
			
}

function config_monsters()
{
	insert_db('Caranille_Monsters' , array(
				'Monster_ID' => 1 ,
				'Monster_Image' => 'http://localhost',	
				'Monster_Name' => 'Plop',
				'Monster_Description' => 'Petit monstre vert',
				'Monster_Level' => 1,
				'Monster_Strength' => 15,
				'Monster_Defense' => 5,
				'Monster_HP' => 40,
				'Monster_MP' => 30,
				'Monster_Golds' => 5,
				'Monster_Experience' => 5,
				'Monster_Town' => 1,
				'Monster_Access' => 'Battle'
			));
			
			insert_db('Caranille_Monsters' , array(
				'Monster_ID' => 2 ,
				'Monster_Image' => 'http://localhost',	
				'Monster_Name' => 'Dragon',
				'Monster_Description' => 'Monstre qui crache du feu',
				'Monster_Level' => 1,
				'Monster_Strength' => 50,
				'Monster_Defense' => 30,
				'Monster_HP' => 1000,
				'Monster_MP' => 100,
				'Monster_Golds' => 100,
				'Monster_Experience' => 100,
				'Monster_Town' => 1,
				'Monster_Access' => 'Mission'
			));

			insert_db('Caranille_Monsters' , array(
				'Monster_ID' => 3 ,
				'Monster_Image' => 'http://localhost',	
				'Monster_Name' => 'Plop doree',
				'Monster_Description' => 'Petit monstre en or',
				'Monster_Level' => 1,
				'Monster_Strength' => 75,
				'Monster_Defense' => 10,
				'Monster_HP' => 300,
				'Monster_MP' => 30,
				'Monster_Golds' => 5,
				'Monster_Experience' => 5,
				'Monster_Town' => 1,
				'Monster_Access' => 'Chapter'
			));
			

}

function config_chapter()
{
	insert_db('Caranille_Chapters',array(
				'Chapter_ID' => 1,
				'Chapter_Number' => 1,
				'Chapter_Name' => 'Chapitre 1 - Le commencement', 
				'Chapter_Opening' => 'Bienvenue dans Indicia, une ville d\'habitude très agréable, malheureusement un monstre bloque l\'accé à la ville',
				'Chapter_Ending' => 'Vous avez sauvé la ville',
				'Chapter_Defeate' => 'Vous êtes morts en héros',
				'Chapter_Monster' => 3
			));
}

function config_mission()
{
	insert_db('Caranille_Missions' , array(
				'Mission_ID' => 1 ,
				'Mission_Town' => 1,
				'Mission_Number' => 1,
				'Mission_Name' =>  'Mission 01 - Affronter un dragon',
				'Mission_Introduction' => 'Un dragon menace le village de Indicia, aller l\'affronter pour sauver le village',
				'Mission_Victory' => 'Vous avez sauvé le village',
				'Mission_Defeate' => 'Le dragon vient de détruire le village',
				'Mission_Monster' => 2
			));
}

function config_items()
{

	global $array_accessory_type , $array_weapon_type , $_medical_functions ;
	
	$last = array("Magic", "Parchment");
	
	$i = 1;
	
	foreach( $array_accessory_type as $type)
	{
		insert_db('Caranille_Items' , array(
			'Item_ID' => $i ,
			'Item_Type' => $type,
			'Item_Level_Required' => 1 ,
			'Item_Name' => 'Leathon '.$type,
			'Item_Description' => 'smallest '.$type,
			'Item_Town' => 1,
			'Item_Purchase_Price' => 10,
			'Item_Sale_Price' => 5
		));
		
		insert_db('Caranille_Inventory' , array(
			'Inventory_Account_ID' => 1,
			'Inventory_Item_ID' => $i,
			'Inventory_Item_Quantity' => 1,
			'Inventory_Item_Equipped' => 'No'
		));
		
		$i++ ;
	}
	
	foreach( $array_weapon_type as $type)
	{
		insert_db('Caranille_Items' , array(
			'Item_ID' => $i ,
			'Item_Type' => $type,
			'Item_Level_Required' => 1 ,
			'Item_Name' => 'Leathon '.$type,
			'Item_Description' => 'fryest '.$type,
			'Item_Town' => 1,
			'Item_Purchase_Price' => 10,
			'Item_Sale_Price' => 5
		));
		
		insert_db('Caranille_Inventory' , array(
			'Inventory_Account_ID' => 1,
			'Inventory_Item_ID' => $i,
			'Inventory_Item_Quantity' => 1,
			'Inventory_Item_Equipped' => 'No'
		));

		$i++ ;
	}

	foreach( $_medical_functions as $medic)
	{
		insert_db('Caranille_Items' , array(
			'Item_ID' => $i ,
			'Item_Type' => $medic,
			'Item_Level_Required' => 1 ,
			'Item_Name' => $medic.' Potion',
			'Item_Description' => 'weakest '.$medic.' Potion',
			'Item_Town' => 1,
			'Item_Purchase_Price' => 10,
			'Item_Sale_Price' => 5
		));
		
		$i++ ;

	}
	
	foreach( $last as $un)
	{
		insert_db('Caranille_Items' , array(
			'Item_ID' => $i ,
			'Item_Type' => $un,
			'Item_Level_Required' => 1 ,
			'Item_Name' => " Unkwon ".$un.'',
			'Item_Description' => 'Mystic '.$un.'',
			'Item_Town' => 1,
			'Item_Purchase_Price' => 10,
			'Item_Sale_Price' => 5
		));
		
		$i++ ;

	}
}

function init_news($Pseudo,$Date)
{
			insert_db('Caranille_News', array(
				'News_ID' => 1 ,
				'News_Title' => 'Installation de Caranille',
				'News_Intro' => 'Félicitation Caranille est bien installé,',
				'News_Message' => ' vous pouvez éditer cette news ou la supprimer',
				'News_Account_Pseudo' => $Pseudo,
				'News_Date' => $Date
			));
}

function mmorpg_init()
{
	global $bdd;
	
	if (request_confirm('Start_Installation'))
	{
		$Level = 1;
		$Experience = 0;
		$HP = 100;
		$MP = 10;
		$Strength= 10;
		$Magic = 10;
		$Agility = 10;
		$Defense = 10;					
		
		do
		{
			insert_db('Caranille_Levels', array(
				'Level_ID' => $Level ,
				'Level_Number' => $Level,
				'Level_Experience_Required' => $Experience,
				'Level_HP' => $HP,
				'Level_MP' => $MP,
				'Level_Strength' =>$Strength,
				'Level_Magic' => $Magic,
				'Level_Agility' => $Agility,
				'Level_Defense' => $Defense
			));
			
			$HP += $_POST['HP_Level'];
			$MP += $_POST['MP_Level'];
			$Strength += $_POST['Strength_Level'];
			$Magic += $_POST['Magic_Level'];
			$Agility += $_POST['Agility_Level'];
			$Defense += $_POST['Defense_Level'];
			$Experience += $_POST['Experience_Level'];
			$Level ++;						
		}
		while ($Level < 200);
		
		record_curve();
	}
	if (request_confirm('MMORPG_Name') && ($_POST['MMORPG_Presentation']) && ($_POST['Pseudo']) && ($_POST['Password']) && ($_POST['Email']))
	{
		if( register_admin() &&  register_config() )
		{
			$Pseudo = htmlspecialchars(addslashes($_POST['Pseudo']));
			$Date = date('Y-m-d H:i:s');
			
			config_forum();	
			install_forum();
			config_ville();
			config_invocation();
			config_magic();
			config_order();
			config_monsters();
			config_chapter();
			config_mission();
			config_items();
			config_race();
			config_classe();
			init_news($Pseudo,$Date);
			
			return true;
		}
	}
}

function config_classe()
{
	insert_db('Caranille_Classes', array(
		'Classe_Name' => 'Tank',
		'Classe_Description' => 'encaise à la place des autres'
	));
	
	insert_db('Caranille_Classes', array(
		'Classe_Name' => 'Healer',
		'Classe_Description' => 'specialisé dans le soin'
	));
	
	insert_db('Caranille_Classes', array(
		'Classe_Name' => 'DDPT',
		'Classe_Description' => 'distributeur de degats par tour'
	));
}

function config_race()
{
	insert_db('Caranille_Races', array(
		'Race_Name' => 'Néphilims',
		'Race_Description' => 'croisement maudits des anges et des démons'
	));
	
	insert_db('Caranille_Races', array(
		'Race_Name' => 'Humains',
		'Race_Description' => 'Rejetés du ciel et de l\'enfer, la terre est devenu leur royaume souverain'
	));
}

include_once('login.php');
include_once('news.php');
include_once('pages.php');
include_once('temoignages.php');
include_once('step.php');

load_css('install.css','install');

	if($page == 'temoignages')
	{
		temoignages_exec();
	}
	download();

$title = "Installation";

if($page ==="Index" || $page ==="index" )
{
    if (empty($_POST['Accept']) && empty($_POST['Create_Configuration']) && empty($_POST['Choose_Curve']) && empty($_POST['Start_Installation']) && empty($_POST['Configure']) && empty($_POST['Finish']))
	{
		$baseline = '<span class="important">Installation de caranille - Etape 1/5 (License d\'utilisation)</span>';
		$span_footer = '<span class="important">Si vous n\'acceptez pas la license d\'utilisation, veuillez supprimer caranille</span>';
	}

	if (request_confirm('Accept') || request_confirm('Create_Configuration')|| request_confirm('Choose_Curve') || (request_confirm('step') && request_get('step')===2))
	{
		$baseline = '<span class="important">Installation de caranille - Etape 2/5 (Configuration de la base de donnée)</span>';
	}
	
	if (request_confirm('Start_Installation')  || (request_confirm('step') && request_get('step')===3)) // || $current_step === 3
	{
		$baseline = '<span class="important">Installation de caranille - Etape 3/5 (Création des tables dans la base de donnée)</span>';
	}
	
	if (request_confirm('Configure')|| (request_confirm('step') && request_get('step')===4) )//|| $current_step == 4 
	{
		$baseline = '<span class="important">Installation de caranille - Etape 4/5 (Préparation de la configuration de base du MMORPG)</span>';
	}
	
	if (request_confirm('Finish'))
	{
		$baseline = '<span class="important">Installation de caranille - Etape 5/5 (Installation des données de base du MMORPG)</span>';
	}
}

if( $page =='a_venir')// (request_confirm('reglements')  ) ($secteur ==='Install'||$secteur ==='install') &&
	{
		$description = "Avancées en cours et Devellopement à venir sur Caranille.";
	}

	if( $page =='mentions')//(request_confirm('mentions')  ) ($secteur ==='Install'||$secteur ==='install') &&
	{
		$description = "Licence d'acces à Caranille";
	}
	
	if( $page =='faq')//(request_confirm('faq')  ) ($secteur ==='Install'||$secteur ==='install') &&
	{
		$description = "Foire aux questions";
	}

	if( $page =='contact')//(request_confirm('contact')  ) ($secteur ==='Install'||$secteur ==='install') &&
	{
		$description = "Joignez les créateurs";
	}

	if( $page =='a_propos')//(request_confirm('a_propos')  )$secteur ==='install' &&
	{
		$description = "Decouvrez Caranille" ;
	}
	
	if( $page =='reglements')// (request_confirm('reglements')  ) //($secteur ==='Install'||$secteur ==='install') &&
	{
		$description = "Possibilités de GamePlay";
	}
	
	if( $page =='videos')//(request_confirm('videos')  )$secteur ==='install' &&
	{
		$description = "Videos de presentation";
	}
	
	if( $page =='remerciements')// (request_confirm('reglements')  ) ($secteur ==='Install'||$secteur ==='install') &&
	{
		$description = "Merci à vous tous !!!";
	}
//			echo "étape :: $install_step<br/>";
