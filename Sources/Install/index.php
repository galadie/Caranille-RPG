<?php
//session_start();

// pour les premieres insert en SQL,
if(file_exists("../Config.php")) require_once("../Config.php");
 
//include_once("../Kernel/Functions.php");
//include_once("../Kernel/Database.php");

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
			fwrite($Open_Config, "
<?php

		//Version du rpg de caranille
		\$version = \"4.7.0\";
		
		\$_path = \"$way\";
		\$_url = \"$url\";
		
		\$driver = '$Driver';
		\$host = '$Server';
		\$Database ='$Database';
		
		\$dns_host = \$driver.':host='.\$host.';dbname='.\$Database.';charset=UTF8;port=3306;unix_socket='.\$_path;
		
		\$dns_user = '$User';
		\$dns_pswd = '$Password';		
		
		\$prefixe_salt = \"$p_salt\";
		\$suffixe_salt = \"$s_salt\";
			
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
 * on peut alors envisager  de similer la réecriture d'URL
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
Options +FollowSymLinks
Options +Indexes
RewriteEngine On

RewriteBase /".$way.$dir."index.php 

# lecture systématique vers index.php
RewriteRule ^(.*).html$ /".$way.$dir."index.php  [L] 

# redirection systématique vers index
ErrorDocument 404 /".$way.$dir."index.php

");
			fclose($Open_Config);
			return true ;
		}
	}
}

function install_forum()
{

	insert_db('Caranille_Categories', array('cat_id'=> 1, 'cat_ordre'=>30, 'cat_nom'=>'Général' ));
	insert_db('Caranille_Categories', array('cat_id'=> 2, 'cat_ordre'=>20, 'cat_nom'=> 'Jeux-Vidéos' ));
	insert_db('Caranille_Categories', array('cat_id'=> 3, 'cat_ordre'=>10, 'cat_nom'=> 'Autre'));

	insert_db('Caranille_Forums', array('forum_id'=> 1, 'forum_cat_id'=> 1, 'forum_ordre'=> 60, 'forum_name'=>'Présentation' , 'forum_desc'=> 'Nouveau sur le forum? Venez vous présenter ici !')); 
	insert_db('Caranille_Forums', array('forum_id'=> 2, 'forum_cat_id'=> 1, 'forum_ordre'=> 50, 'forum_name'=> 'Les News', 'forum_desc'=> 'Les news du site sont ici'  ));
	insert_db('Caranille_Forums', array('forum_id'=> 3, 'forum_cat_id'=> 1, 'forum_ordre'=> 40, 'forum_name'=>'Discussions générales' , 'forum_desc'=> 'Ici on peut parler de tout sur tous les sujets')); 
	insert_db('Caranille_Forums', array('forum_id'=> 4, 'forum_cat_id'=> 2, 'forum_ordre'=> 60, 'forum_name'=> 'MMORPG', 'forum_desc'=> 'Parlez ici des MMORPG')); 
	insert_db('Caranille_Forums', array('forum_id'=> 5, 'forum_cat_id'=> 2, 'forum_ordre'=> 50, 'forum_name'=> 'Autres jeux', 'forum_desc'=> 'Forum sur les autres jeux' )); 
	insert_db('Caranille_Forums', array('forum_id'=>6 , 'forum_cat_id'=> 3, 'forum_ordre'=> 60, 'forum_name'=> 'Loisir', 'forum_desc'=>'Vos loisirs'  )); 
	insert_db('Caranille_Forums', array('forum_id'=> 7, 'forum_cat_id'=> 3, 'forum_ordre'=> 50, 'forum_name'=> 'Délires', 'forum_desc'=> 'Décrivez ici tous vos délires les plus fous' )); 
	
	// 'forum_last_post_id'=> , 'forum_topic'=> , 'forum_post'=> , 'auth_view'=> , 'auth_post'=> , 'auth_topic`, auth_annonce, auth_modo)
	//VALUES ( 0, 0, 0, 0, 0, 0, 0, 0);
/*****/
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
/****/
}

function register_admin()
{
	global $bdd, $prefixe_salt, $suffixe_salt;
	
	extract(addslashes_r($_POST));
		
	if ($Password === $Password_Confirm)
	{
		$Date = date('Y-m-d H:i:s');
		$IP = getRealIpAddr();

		$filter = uniqid();
		sleep(1);
		$key =  uniqid();
		$pswd = password_encode($prefixe_salt.$filter.$suffixe_salt, $Password)		;
				
		$decode = password_decode($prefixe_salt.$filter.$suffixe_salt, $pswd) ;	
				
		insert_db('Caranille_Accounts',array(
			'Account_Pseudo' => $Pseudo, 
			'Account_Password' => $pswd, 
			'Account_Salt' => $filter, 
			'Account_Email' => $Email, 
			'Account_Last_Connection' => $Date, 
			'Account_Last_IP' => $IP ,
            'Account_HP_Remaining' => 100,
            'Account_Key' => $key ,
            'Account_Valid' => 1 ,
            'Account_Level' => 1 ,
			'Account_Order' => 1 ,
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
	//echo "etape en cours : $step<br/>";
	
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

	insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'MMORPG_Access',
			'Configuration_Value' => 'Yes', 
	));
	
	insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'MMORPG_Name',
			'Configuration_Value' => $MMORPG_Name, 
	));
	
	$create = insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'MMORPG_Presentation',
			'Configuration_Value' => $Presentation,
	));
	
	return $create ; 
}

function record_curve()
{
    insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'curve-HP',
			'Configuration_Value' => $_POST['HP_Level']
		));
	
	insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'curve-MP',
			'Configuration_Value' =>$_POST['MP_Level']
	));
	
	insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'curve-Strength',
			'Configuration_Value' => $_POST['Strength_Level']
	));
	
	insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'curve-Magic',
			'Configuration_Value' => $_POST['Magic_Level']
	));
	
	insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'curve-Agility',
			'Configuration_Value' => $_POST['Agility_Level']
	));
	
	insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'curve-Defense',
			'Configuration_Value' => $_POST['Defense_Level']
	));
	
	insert_db('Caranille_Configuration',array(
			'Configuration_Name' => 'curve-Experience',
			'Configuration_Value' => $_POST['Experience_Level']
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
	if (request_confirm('MMORPG_Name') && request_confirm('MMORPG_Presentation') && request_confirm('Pseudo') && request_confirm('Password') && request_confirm('Email'))
	{
		if( register_admin() &&  register_config() )
		{
			$Pseudo = htmlspecialchars(addslashes($_POST['Pseudo']));
			$Date = date('Y-m-d H:i:s');
			
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
			
			insert_db('Caranille_Invocations',array(
				'Invocation_ID' => 1,
				'Invocation_Name' => 'Trident', 
				'Invocation_Description' => 'Chimère qui provient du fond des océans',
				'Invocation_Damage' => 10,
				'Invocation_Town' => 1,
				'Invocation_Price' => 200
			));
						
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
			

			insert_db('Caranille_Chapters',array(
				'Chapter_ID' => 1,
				'Chapter_Number' => 1,
				'Chapter_Name' => 'Chapitre 1 - Le commencement', 
				'Chapter_Opening' => 'Bienvenue dans Indicia, une ville d\'habitude très agréable, malheureusement un monstre bloque l\'accé à la ville',
				'Chapter_Ending' => 'Vous avez sauvé la ville',
				'Chapter_Defeate' => 'Vous êtes morts en héros',
				'Chapter_Monster' => 3
			));

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
	
			insert_db('Caranille_Items' , array(
				'Item_ID' => 1 ,
				'Item_Image' => 'http://localhost',	
				'Item_Type' => 'Weapon',
				'Item_Level_Required' => 1 ,
				'Item_Name' => 'Epée de cuivre',
				'Item_Description' => 'Une petite Epée',
				'Item_Town' => 1,
				'Item_Purchase_Price' => 10,
				'Item_Sale_Price' => 5
			));
			
			insert_db('Caranille_Items' , array(
				'Item_ID' => 2 ,
				'Item_Image' => 'http://localhost',	
				'Item_Type' => 'Armor',
				'Item_Level_Required' => 1 ,
				'Item_Name' => 'Armure de cuivre',
				'Item_Description' => 'Une petite armure',
				'Item_Town' => 1,
				'Item_Purchase_Price' => 10,
				'Item_Sale_Price' => 5
			));

			insert_db('Caranille_Items' , array(
				'Item_ID' => 3 ,
				'Item_Image' => 'http://localhost',	
				'Item_Type' => 'Boots',
				'Item_Level_Required' => 1 ,
				'Item_Name' => 'Bottes de cuivre',
				'Item_Description' => 'Des petites bottes',
				'Item_Town' => 1,
				'Item_Purchase_Price' => 10,
				'Item_Sale_Price' => 5
			));
			insert_db('Caranille_Items' , array(
				'Item_ID' => 4 ,
				'Item_Image' => 'http://localhost',	
				'Item_Type' => 'Gloves',
				'Item_Level_Required' => 1 ,
				'Item_Name' => 'Gants de cuivre',
				'Item_Description' => 'Des petits gants',
				'Item_Town' => 1,
				'Item_Purchase_Price' => 10,
				'Item_Sale_Price' => 5
			));

	
			insert_db('Caranille_Items' , array(
				'Item_ID' => 5 ,
				'Item_Image' => 'http://localhost',	
				'Item_Type' => 'Helmet',
				'Item_Level_Required' => 1 ,
				'Item_Name' => 'Casque de cuivre',
				'Item_Description' => 'Un petit casque',
				'Item_Town' => 1,
				'Item_Purchase_Price' => 10,
				'Item_Sale_Price' => 5
			));
			insert_db('Caranille_Items' , array(
				'Item_ID' => 6 ,
				'Item_Image' => 'http://localhost',	
				'Item_Type' => 'Parchment',
				'Item_Level_Required' => 1 ,
				'Item_Name' => 'Parchemin vide',
				'Item_Description' => 'Un parchemin vide',
				'Item_Town' => 1,
				'Item_Purchase_Price' => 10,
				'Item_Sale_Price' => 5
			));
			insert_db('Caranille_Items' , array(
				'Item_ID' => 7 ,
				'Item_Image' => 'http://localhost',	
				'Item_Type' => 'Health',
				'Item_Level_Required' => 1 ,
				'Item_Name' => 'Potion',
				'Item_Description' => 'Redonne 50 HP',
				'Item_Town' => 1,
				'Item_Purchase_Price' => 10,
				'Item_Sale_Price' => 5
			));
			insert_db('Caranille_Items' , array(
				'Item_ID' => 8 ,
				'Item_Image' => 'http://localhost',	
				'Item_Type' => 'Magic',
				'Item_Level_Required' => 1 ,
				'Item_Name' => 'Ether',
				'Item_Description' => 'Redonne 5 MP',
				'Item_Town' => 1,
				'Item_Purchase_Price' => 10,
				'Item_Sale_Price' => 5
			));
			

			
//$bdd->exec("INSERT into Caranille_Guilds_competences VALUES('1', '1', '1', '1', '1')");
			
			for($i = 1; $i <= 5; $i++ )
				insert_db('Caranille_Inventory' , array(
					'Inventory_ID' => $i ,
					'Inventory_Account_ID' => 1,
					'Inventory_Item_ID' => $i,
					'Inventory_Item_Quantity' => 1,
					'Inventory_Item_Equipped' => 'No'
				));
			
			insert_db('Caranille_Inventory_Invocations' , array(
				'Inventory_Invocation_Account_ID' => 1,
				'Inventory_Invocation_Invocation_ID' => 1,
			));
						
			insert_db('Caranille_Inventory_Magics' , array(
				'Inventory_Magic_Account_ID' => 1,
				'Inventory_Magic_Magic_ID' => 1
			));
					
			insert_db('Caranille_News', array(
				'News_ID' => 1 ,
				'News_Title' => 'Installation de Caranille',
				'News_Intro' => 'Félicitation Caranille est bien installé,',
				'News_Message' => ' vous pouvez éditer cette news ou la supprimer',
				'News_Account_Pseudo' => $Pseudo,
				'News_Date' => $Date
			));

			return true;
		}
	}
}

function a_propos()
{
	global $secteur, $page ;
	if($secteur ==='install' && $page ==='apropos')//(request_confirm('a_propos')  )
	{
?>
<p>Voici un projet qui me tient à cœur et que j'ai commencé il y a de cela presque 3 ans : ce projet se nomme Caranille. Pourquoi un tel nom ? Caranille est la contraction de Caramel et Vanille qui sont deux animaux que j'ai perdus il y a longtemps mais que j'ai énormément adorés. </p>

<p>Pour vous présenter Caranille sachez que c'est un logiciel/programme/script qui a pour but de vous aider à bâtir rapidement et gratuitement votre propre MMORPG ( <em>massively multiplayer online role-playing game</em>, c'est-à-dire  jeu de rôle en ligne massivement multijoueur) pour votre site web personnel, pour une animation ou autres&#8230; Étant une personne qui utilise uniquement GNU/Linux et appréciant sa façon d'être (à savoir le partage des sources), j'ai décidé de mettre Caranille sous licence GNU GPL, ce qui permettra aux utilisateurs avancés de le modifier, de rajouter des modules et de les redistribuer selon la licence Creative Commons.</p>

<ul style='text-align:left'>
Condition minimale requise:
<li>Serveur HTTP (Apache 2.x)</li>
<li>PHP (5.2.X)</li>
<li>Mysql (5.5) - (Caranille fonctionne aussi avec PostgreSQL et la base de donnée Oracle)</li>
</ul>
<?php
	}
}

function contact()
{
	global $secteur, $page ;
	if(($secteur ==='Install'||$secteur ==='install') && $page ==='contact')//(request_confirm('contact')  )
	{
?>
	<p>Vous avez une idée, une suggestion voir même une question ?</p>
	<p>N'hésitez-pas écrivez moi à :<br /><a href="mailto:jeremy@caranille.com">jeremy@caranille.com</a></p>
	<p>Vous aurez une réponse dans les 24 heures suivants votre demande.</p>
	<p>Vous pouvez aussi contacter<br />
	- notre référant technique à: <a href="mailto:dimitri@caranille.com">dimitri@caranille.com</a><br />
	- notre bêta-testeur à : <a href="mailto:pilou123@caranille.com">pilou123@caranille.com</a></p>
<?php
	}
}

function faq()
{
	global $secteur, $page ;
	if(($secteur ==='Install'||$secteur ==='install') && $page ==='faq')//(request_confirm('faq')  )
	{
?>
	<p>
<strong>À qui est destiné Caranille ?</strong>
</p>

<ul><li>Caranille est destiné à toutes les personnes ou entités qui souhaitent mettre en place un MMORPG sur leur site web.</li>
</ul><p>
<strong>Pourquoi n'y a-t'il pas de 2D, voir même 3D ?</strong>
</p>

<ul><li>Simplement car les éditeurs de MMORPG actuel qui utilisent de la 2D ou 3D utilisent forcément du javascript ainsi que la technologie AJAX. Ce qui au final ne permettrait plus à Caranille de fonctionner sur tous les terminaux ce qui est l'un des principes fondamentaux de l'éditeur.</li>
</ul><p>
<strong>Quels sont les cycles de sortie des nouvelles versions ?</strong>
</p>

<ul><li>Il sort une nouvelle version en moyenne tous les 3 mois, le temps de corriger les derniers bogues de la version actuelle et de mettre en place les nouveautés de la prochaine version</li>
</ul><p>Les sources sont mises à disposition en temps réel, dès qu'une modification a lieu dans sur la version stable ou instable. Les utilisateurs peuvent télécharger à tout moment la dernière version.</p>


<?php
	}
}

function mentions()
{
	global $secteur, $page ;
	if(($secteur ==='Install'||$secteur ==='install') && $page ==='mentions')//(request_confirm('mentions')  )
	{
?>
<div>
	<a href="http://www.caranille.fr" hreflang="fr" title="http://www.caranille.fr">Site officiel</a> |
<a href="http://mmorpg.caranille.com/" hreflang="fr" title="http://mmorpg.caranille.com/">MMORPG officiel (Démonstration)</a> |
<a class="hit_counter" data-hit="86262" href="http://www.gnu.org/licenses" hreflang="fr" title="http://www.gnu.org/licenses">GNU GPL</a>

<p>
	<a rel="license" href="http://creativecommons.org/licenses/by/4.0/">
		<img alt="Licence Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by/4.0/88x31.png" /></a>
		<br />Ce(tte) &oelig; œuvre est mise &agrave; à disposition selon les termes de la <br/>
		<a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Licence Creative Commons Attribution 4.0 International</a>.
</p>
        <iframe id="licence" src="../LICENCE.txt"></iframe><br /><br />
</div>
<?php
	}
}

function reglements()
{

	global $secteur, $page ;
	
	if(($secteur ==='Install'||$secteur ==='install') && $page ==='reglement')// (request_confirm('reglements')  )
	{
	
?>
<div>
	<h3 id="toc_0">Possibilités</h3>

<p>Fonctionnalités JdR :</p>

<ul><li>une histoire principale pour votre jeu</li>
<li>plusieurs villes (qui peuvent être débloquées en fonction de l'avancée dans l'histoire)</li>
<li>des missions propre à chaque ville</li>
<li>des monstres et de choisir les objets qui pourront être gagnés lors de la victoire du joueur</li>
<li>des objets (armes, protection, objets de soin comme des potions etc.)</li>
<li>des chimères à invoquer lors des combats</li>
</ul><p>Fonctionnalités MMORPG :</p>

<ul><li>faire du PVP (Player Versus Player)</li>
<li>fonder sa propre guilde</li>
<li>discuter en direct avec tous les autres joueurs</li>
</ul><p>De plus pour les habitués des grands JdR de Square Enix (ou anciennement SquareSoft) le menu de combat est présenté de la même façon à savoir :</p>

<ul><li>Attaquer (porter une attaque physique)</li>
<li>Magie (lancer un sort sur ennemi)</li>
<li>Invocation (invoquer une puissante chimère)</li>
<li>Objets (utiliser un objet comme une potion)</li>
<li>Fuir (trop faible face à l&#8217;ennemi ? Fuyiez)</li>
</ul><h3 id="toc_1">Avantages</h3>

<p>Le gros avantage de Caranille est dans sa simplicité d'utilisation, celui-ci a été conçu de façon à ce qu'une personne ne connaissant rien en développement puisse l&#8217;utiliser et créer son MMORPG et sa communauté de joueurs.</p>

<p>Caranille est programmé en PHP5 et utilise MySQL pour le stockage des données ce qui vous permet de l'utiliser sur tous les hébergements mutualisés actuellement proposés ou pourquoi pas sur votre propre ordinateur avec un serveur WAMPP ou LAMPP.</p>

<p>L'un des principes fondamentaux de Caranille est de fonctionner sur tous les appareils disposant d'un navigateur internet (même des plus anciens).</p>

<p>
<strong>Cela permet pour l'utilisateur final d'y jouer sur (presque) tous les terminaux confondus à savoir :</strong>
</p>

<ul><li>Un ordinateur (Fixe ou portable)</li>
<li>Un smartphone voir même téléphone</li>
<li>Toutes les dernières consoles de jeu portables ou fixes</li>
</ul><p>En conclusion le but de Caranille est de fournir une plate-forme complète de développement de MMORPG gratuits et ces derniers pourront être joués partout comme chez vous, dans le bus pendant vos vacances via un cybercafé et même au travail, la seule condition étant de posséder un navigateur web et internet.</p>
</div>
<?php
	}
}

function step_1()
{
	if ((empty($_POST) && empty($_GET)) || (request_confirm('step') && request_get('step')=== 1 ) )
	{
		?>
		<p>
			Bienvenue dans l'assistant d'installation de Caranille<br />
			Cet assistant vous guidera tout au long de l'installation de Caranille<br />
			pour vous offrir la meilleur experience possible dans la création de votre MMORPG
		</p>
		
		Pour commencer l'installation de Caranille veuillez lire et accepter la license d'utilisation<br /><br />
		<a rel="license" href="http://creativecommons.org/licenses/by/4.0/deed.fr"><img alt="Licence Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />Ce(tte) œuvre est mise à disposition selon les termes de la <a rel="license" href="http://creativecommons.org/licenses/by/4.0/deed.fr">Licence Creative Commons Attribution 4.0 International</a>.
		<br /><br /><iframe src="LICENCE.txt">
		</iframe><br />
		<form method="POST" action="<?php echo get_link("Install")."&step=2" ?>">
		<input type="submit" name="Accept" value="J'accepte la license d'utilisation de caranille et je la respecte"/><br /><br />
		</form>
		<?php
	}
}

function step_2()
{
	if (request_confirm('Accept') || (request_confirm('step') && request_get('step')===2) )
	{
		?>
		<p>Caranille à besoins d'une base de donnée pour stocker toutes les informations de votre jeu<br />
		en passant par les données des joueurs, des objets, des monstres etc...</p>
		
		<p>Veuillez compléter le formulaire suivant avec les informations de connexion à votre base de donnée<br />
		Si vous possedez un hébergement mutualisé il vous suffit de vous connecter sur le site de votre prestataire<br />
		et de chercher les informations de votre base de donnée</p>
		
		<form method="POST" action="<?php echo get_link("Install")."&step=2" ?>">
		<label>Adresse de votre serveur SQL</label><input placeholder="Localhost" type="text" name="Server"/><br /><br />
		<label>Nom d'utilisateur</label><input placeholder="User" type="text" name="User"/><br /><br />
		<label>Mot de passe</label><input placeholder="Password" type="password" name="Password"/><br /><br />
		<label>Nom de la base</label><input placeholder="Database" type="text" name="Database"/><br /><br />
		<label>Driver</label><select placeholder="Driver" name="Driver">
			<option>Driver</option>
			<?php foreach(PDO::getAvailableDrivers() as $driver) { ?><option value="<?php echo $driver ?>" ><?php echo $driver ?></option><?php } ?>
		</select><br /><br />
		<input type="submit" name="Create_Configuration" value="Creer la configuration du MMORPG"/>
		
		</form>
		<?php
	}
}

function step_3()
{
	global $_path , $_rewrite;
	
	if (request_confirm('Create_Configuration') )
	{
		if(create_config())
		{			
		    if($_rewrite) // si l'URL_REWRITING est activé.
				create_htaccess();
		    
		    if (file_exists($_path."Config.php"))
			{
				?>
				<form method="POST" action="<?php echo get_link("Install")."&step=2" ?>">
				<p>Félicitation Le fichier de configuration à votre base de donnée à bien été crée
				Ce fichier va permettre à Caranille de communiquer à votre base de donnée.</p><br />
				<br /><br />
				<input type="submit" name="Choose_Curve" value="Continuer"/>
				</form>

				<?php
			}
			else
			{
				echo 'Le fichier de configuration n\'a pu être crée. Veuillez vérifier que PHP à bien les droits d\'écriture';
			}
		}
	}
}

function step_4()
{
	if (request_confirm('Choose_Curve'))
	{
		?>
		Veuillez choisir la courbe d'experience pour les personnages ainsi que les guildes
		
		<form method="POST" action="<?php echo get_link("Install")."&step=3" ?>">
		Gain de HP par niveau: <br /> <input type="text" name="HP_Level"><br /><br />
		Gain de MP par niveau: <br /> <input type="text" name="MP_Level"><br /><br />
		Gain de Force par niveau: <br /> <input type="text" name="Strength_Level"><br /><br />
		Gain de Magie par niveau: <br /> <input type="text" name="Magic_Level"><br /><br />
		Gain de Agilité par niveau: <br /> <input type="text" name="Agility_Level"><br /><br />  
		Gain de Defense par niveau: <br /> <input type="text" name="Defense_Level"><br /><br />                                  
		Experience demandé en plus par niveau: <br /> <input type="text" name="Experience_Level"><br /><br />
		<input type="submit" name="Start_Installation" value="Lancer l'installation">
		</form>
		<?php
	}
}

function step_5()
{
	if (request_confirm('Start_Installation') || (request_confirm('step') && request_get('step')===3) )
	{
		$access = false ;
		
		if (request_confirm('Start_Installation'))
			if(create_db())//install_bdd();
				$access = true ;
				
		if((request_confirm('step') && request_get('step')===3) )
			$access = true ;
			
		if($access)
		{
			if (request_confirm('Start_Installation'))
				install_edit_step_record(3);
			
				mmorpg_init();// creatio des levels
?>
				Installation de caranille terminée avec succès<br />
				Dans la suite de l'installation vous allez devoir configurer les bases de votre MMORPG<br />
				
				<form method="POST" action="<?php echo get_link("Install")."&step=4" ?>">
				<input type="submit" name="Configure" value="Configurer mon MMORPG"/>
				</form>
<?php
		}
	}
}

function step_6()
{
	if (request_confirm('Configure') || (request_confirm('step') && request_get('step')===4 ) )
	{
		install_edit_step_record(4);		
		?>
		Dernière étape avant de pouvoir commencer votre MMORPG<p>
		Cette étape est l'une des plus importantes pour votre jeu<br />
		C'est ici que vous allez devoir donner un nom à votre MMORPG ainsi que une courte introduction<br /><br />
		
		De plus vous allez créer votre propre compte qui sera le compte administrateur</p>
		
		<form method="POST" action="<?php echo get_link("Install") ?>">
		Nom de votre MMORPG<br /> <input type="text" name="MMORPG_Name"><br /><br />
		Présentation<br /><textarea name="Presentation" ID="Presentation" rows="10" cols="50"></textarea><br /><br />
		Pseudo<br /> <input type="text" name="Pseudo"><br /><br />
		Mot de passe<br /> <input type="password" name="Password"><br /><br />
		Confirmer le mot de passe<br /> <input type="password" name="Password_Confirm"><br /><br />
		Adresse e-mail<br /> <input type="text" name="Email"><br /><br />
		<input type="submit" name="Finish" value="Terminer">
		</form>
		<?php
	}			
}

function step_7()
{
	if (request_confirm('Finish'))
	{
		if (request_confirm('MMORPG_Name') && request_confirm('MMORPG_Presentation') && request_confirm('Pseudo') && request_confirm('Password') && request_confirm('Email'))
		{	
			if ( mmorpg_init() )
			{
		    	install_edit_step_record(5);		

?>
				Félicitation Votre MMORPG a bien été crée<p/>
				Vous allez maintenant pouvoir créer et modifier votre jeu et donner vie à une communauté de joueurs<br /><br />
				
				Par mesure de sécurité veuillez de supprimer le répertoire "Install" de votre serveur FTP<br />
				
				<form method="POST" action="<?php echo get_link("Main","game") ?>">
				<input type="submit" name="accueil" value="retourner à l'accueil">
				</form>
<?php
			}
			else
			{
?>
				ATTENTION: Les deux mots de passe entrée ne sont pas identiques
				
				<form method="POST" action="<?php echo get_link("Install") ?>">
				<input type="submit" name="Configure" value="Recommencer">
				</form>
<?php
			}
		}
		else
		{
?>
			ATTENTION: Vous n'avez pas rempli tous les champs correctement
			
			<form method="POST" action="<?php echo get_link("Install") ?>">
			<input type="submit" name="Configure" value="Recommencer">
			</form>
<?php
		}
	}				
}

if($page ==="Index" || $page ==="index" )
{
    if (empty($_POST['Accept']) && empty($_POST['Create_Configuration']) && empty($_POST['Choose_Curve']) && empty($_POST['Start_Installation']) && empty($_POST['Configure']) && empty($_POST['Finish']))
	{
		$baseline = '<span class="important">Installation de caranille - Etape 1/5 (License d\'utilisation)</span>';
		$footer = '<span class="important">Si vous n\'acceptez pas la license d\'utilisation, veuillez supprimer caranille</span>';
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

?>
<!DOCTYPE html>
<html>
		<head>
			<title>Caranille - Installation du MMORPG</title>
			<meta charset="utf-8" />
			<link rel="stylesheet" media="screen" type="text/css" title="design" href="Design/Design.css" />
		</head>

		<body class="install">
<!--
			<p>
			<img src="Design/Images/logo.png">
			</p>
-->			
			<section>
				<p class='baseline'><?php if(isset($baseline)) echo $baseline ?></p>
				<article>
<?php
			if($page ==="Index" || $page ==="index" || !isset($page))
			{
				step_1();
				step_2();
				step_3();
				step_4();
				step_5();
				step_6();
				step_7();
			}
			else
				include_once($_path."Sources/Contenu/".$page.".php");
?>
			</article>
			<?php if(isset($footer)) echo $footer ?>
		</section>
		
			<?php if(isset($right)) { ?>
				<asIDe>
					<?php echo $right ?>
				</asIDe>
			<?php } ?>
		<p>	
			<footer>
				
				<a href="<?php echo get_link('Install').'&step='.verif_install() ?>">Retour à l'installation</a> |
				<a href="<?php echo get_link('apropos','Install') ?>">A propos</a> | 
				<a href="<?php echo get_link('contact','Install') ?>">Contact</a> | 
				<a href="<?php echo get_link('mentions','Install') ?>">Mentions légales</a> | 
				<a href="<?php echo get_link('reglement','Install') ?>">Règlement</a> |
				<a href="<?php echo get_link('faq','Install') ?>">FAQ</a>
				
			</footer>
		</p>
	</body>
</html>