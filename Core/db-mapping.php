<?php

	// added by Dimitri : mapping de la base de données
    // les cles etrangeres mises en commentaires posaient des problemes d'integrité lors de l'installation
    // town => chapter et monster crées une boucle infini dans leur contrainte
    // les premiers enregistrements de Monster se font sans item à recuperer

	// table à ajouter...
	// enregistrement de l'exploration.... => achievements
	// forteresse de guilde
	// forteresse d'ordre...
	// 	=> prise de forteresse
	//	=> destruction d'ordre/guilde
	// monture => deplacement 3 à 4
	// pnj
	// peon
	// familier
	// maison
	
$db_mapping = array
(
	
	'Caranille_Configuration' => array (
	
		'champs' => array(
			'Configuration_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label' =>'Nom'),
			'Configuration_Value' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Valeur'),
		),
		'key' => array (
			'Configuration_Name' => array (  'key' => 'PRIMARY') 
		)
	),
	
	// enregistrements des pages institutionnelles
	'Caranille_Pages' => array(
		'champs' => array(
			'Page_ID'  => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Page_Title' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label'=>'Titre','mandatory' => true),
			'Page_Description'  => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL','label'=>'Description','mandatory' => true),
			'Page_Keywords'  => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL','label'=>'Mots-clés','mandatory' => true),
			'Page_Content'  => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL','label'=>'Contenu','mandatory' => true, 'html' => true),
			'Page_Order' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'Niveau', 'default' => 1, 'Ordering' => true), //text
			'Page_Guild_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=> 'Guilde'),
			'Page_Slug' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label'=>'lien'),
		),
		'key' => array (
			'Page_ID' => array (  'key' => 'PRIMARY') ,		
			'Page_Title' => array (  'key' => 'UNIQUE') ,
			'Page_Slug' => array (  'key' => 'UNIQUE') ,
			'Page_Guild_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Guilds' , 'champs' => 'Guild_ID', 'toString' => 'Guild_Name'  ) ,
		)	
	),
	
	
	
	'Caranille_Levels' => array
	(
		'champs' => array
		(
    		'Level_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
    		'Level_Number' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "Numero"),
    		'Level_Experience_Required' => array ( 'type' => 'bigint', 'length' =>255 ,'nullable' => 'NOT NULL', 'label' => "XP requis"),
 			'Level_Effect' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'serial' => true),
			'Level_HP' => array ( 'type' => 'bigint', 'length' =>255 ,'nullable' => 'NOT NULL', 'label' => "HP"),
    		'Level_MP' => array ( 'type' => 'bigint', 'length' =>255 ,'nullable' => 'NOT NULL', 'label' => "MP"),
    		'Level_Strength' => array ( 'type' => 'bigint', 'length' =>255 ,'nullable' => 'NOT NULL', 'label' => "Force"),
    		'Level_Magic' => array ( 'type' => 'bigint', 'length' =>255 ,'nullable' => 'NOT NULL', 'label' => "Magie"),
    		'Level_Agility' => array ( 'type' => 'bigint', 'length' =>255 ,'nullable' => 'NOT NULL', 'label' => "Agilité"),
    		'Level_Defense' => array ( 'type' => 'bigint', 'length' =>255 ,'nullable' => 'NOT NULL', 'label' => "Defense")
		),
		'key' => array (
			'Level_ID' => array (  'key' => 'PRIMARY') 		
		)
	),

	'Caranille_Items' => array 
	(
		'champs' => array
		(
			'Item_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Item_Image' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=> 'Image'),//array ( 'type' => 'varchar(255)'),	
			'Item_Type' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label'=>'Type','mandatory' => true, 'values' => $array_items_db_type ),
			'Item_Level_Required' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=> 'Niveau Requis'), //varchar(30)
			'Item_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label' => 'Nom','mandatory' => true),
			'Item_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Description','mandatory' => true, 'html' => true),
			'Item_Effect' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'serial' => true),
			'Item_HP_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'HP+'),
			'Item_MP_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=> 'MP+'),
			'Item_Strength_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Force+'),
			'Item_Magic_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Magie+'),
			'Item_Agility_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Agilité+'),
			'Item_Defense_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Defense+'),
			'Item_Town' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label'=>'Ville','mandatory' => true),
			'Item_Purchase_Price' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Prix d\'achat','mandatory' => true),
			'Item_Sale_Price' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Prix de vente','mandatory' => true)
		),
		'key' => array (
			'Item_ID' => array (  'key' => 'PRIMARY') ,
			'Item_Name' => array (  'key' => 'UNIQUE') ,
			'Item_Level_Required' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Levels' , 'champs' => 'Level_ID' , 'toString' => 'Level_Number' ) ,
			'Item_Image' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Images' , 'champs' => 'Image_ID' , 'toString' => 'Image_Name' ) ,
			'Item_Town' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Towns' , 'champs' => 'Town_ID', 'toString' => 'Town_Name' ) ,
		)
	),
	
	'Caranille_Fragments' => array(
	
		'champs' => array
		(
			'Fragment_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Fragment_Image_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=> 'Image'),//array ( 'type' => 'varchar(255)'),	
			'Fragment_Item_Type' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label'=>"Type d'item",'mandatory' => true, 'values' => $array_items_db_type ),
			'Fragment_Classe' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label'=>"classe de fragment",'mandatory' => true, 'values' => $array_craft_type ),			
			'Fragment_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label' => 'Nom','mandatory' => true),
			'Fragment_Effect' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'serial' => true),
			'Fragment_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Description','mandatory' => true, 'html' => true),
			'Fragment_Town_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label'=>'Ville','mandatory' => true),
			'Fragment_Purchase_Price' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Prix d\'achat','mandatory' => true),
			'Fragment_Sale_Price' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Prix de vente','mandatory' => true)
		),
		'key' => array (
		
			'Fragment_ID' => array (  'key' => 'PRIMARY') ,
			'Fragment_Name' => array (  'key' => 'UNIQUE') ,
			'Fragment_Image_ID' => array ( 'key' => 'FOREIGN' , 'table' => 'Image' , 'champs' => 'ID' , 'toString' => 'Name' ) ,
			'Fragment_Town_ID' => array ( 'key' => 'FOREIGN' , 'table' => 'Town' , 'champs' => 'ID', 'toString' => 'Name' ) ,
		)
	),
	
	'Caranille_Ressources'=> array 
	(
		'champs' => array
		(
			'Ressource_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Ressource_Image_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=> 'Image'),//array ( 'type' => 'varchar(255)'),	
			'Ressource_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label' => 'Nom','mandatory' => true),
			'Ressource_Effect' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'serial' => true),
			'Ressource_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Description','mandatory' => true, 'html' => true),
			'Ressource_Purchase_Price' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Prix d\'achat','mandatory' => true),
			'Ressource_Sale_Price' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Prix de vente','mandatory' => true),
			'Ressource_Fabrique' => array ( 'type' => 'varchar', 'length' =>50, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label'=> 'Type', 'values' => $array_work_class['recolte'] ), //array('ressource','fragment','item')),
		),
		'key' => array 
		( 
			'Ressource_ID' => array (  'key' => 'PRIMARY') ,
			'Ressource_Name' => array (  'key' => 'UNIQUE') ,
			'Ressource_Image_ID' => array ( 'key' => 'FOREIGN' , 'table' => 'Image' , 'champs' => 'ID' , 'toString' => 'Name' ) ,
		)
	),

	// X items à sacrifier pour fabriquer 1 item...
	// requiere l'apprentissage d'un metier(work)
	'Caranille_Craftings' => array 
	(
		'champs' => array(
			'Crafting_Fragment_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'Fragment'),
			'Crafting_Item_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "Item"),
			//'Loot_Rate' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "%"),
		),
		'key' => array ( 	
			'Crafting_Fragment_ID'=> array (  'key' => 'PRIMARY FOREIGN' , 'table' => 'Fragment' , 'champs' => 'ID', 'toString' => 'Name' ) ,
			'Crafting_Item_ID'=> array(  'key' => 'PRIMARY FOREIGN' , 'table' => 'Item' , 'champs' => 'ID' , 'toString' => 'Name' )
		)
	),
/**	
	'Housing' => array 
	(
		'champs' => array
		(
			proprietaire
			coordonnées_x
			coordonnées_y
			ville
		),
		'key' => array 
		(
		)
	),
**/	
	
	'Caranille_Monsters' => array 
	(
		'champs' => array
		(
			'Monster_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT') ,
			'Monster_Image' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=> 'Image'),//array ( 'type' => 'varchar', 'length' =>255 ,'nullable' => 'NOT NULL', 'label' => "Image"),	
			'Monster_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label' => "Nom",'mandatory' => true),
			'Monster_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => "Description",'mandatory' => true, 'html' => true),
			'Monster_Level' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "Niveau",'mandatory' => true),
			'Monster_Effect' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'serial' => true),
			'Monster_Strength' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "Force"),
			'Monster_Defense' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "Defense"),
			'Monster_HP' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "HP"),
			'Monster_MP' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "MP"),
			'Monster_Golds' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "Or"),
			'Monster_Experience' => array ( 'type' => 'bigint', 'length' =>255 ,'nullable' => 'NOT NULL', 'label' => "XP"),
			'Monster_Town' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label' => "Ville",'mandatory' => true),
			
/**			'Monster_Item_One' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "Item 1"),
			'Monster_Item_One_Rate' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "%"),
			'Monster_Item_Two' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "Item 2"),
			'Monster_Item_Two_Rate' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "%"),
			'Monster_Item_Three' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label' => "Item 3"),
			'Monster_Item_Three_Rate' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "%"),
**/				
			'Monster_Access' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','mandatory' => true, 'label' => "Acces",'values'=>$array_battle_type)
		),
		'key' => array 
		( 
			'Monster_ID' => array (  'key' => 'PRIMARY') ,
			'Monster_Name' => array (  'key' => 'UNIQUE') ,
			'Monster_Level' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Levels' , 'champs' => 'Level_ID' , 'toString' => 'Level_Number'  ) ,
			'Monster_Image' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Images' , 'champs' => 'Image_ID' , 'toString' => 'Image_Name' ) ,
			'Monster_Town' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Towns' , 'champs' => 'Town_ID' , 'toString' => 'Town_Name') ,
			
			//implique que Caranille_Towns soit créé avant
			//1 monstre requiere 1 ville
			//1 ville requiere 1 chapitre
			//1 chapitre requiere 1 monstre
		/**	
			'Monster_Item_One' => array (   'key' => 'FOREIGN' , 'table' => 'Caranille_Items' , 'champs' => 'Item_ID' , 'toString' => 'Item_Name') ,
			'Monster_Item_Two' => array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Items' , 'champs' => 'Item_ID' , 'toString' => 'Item_Name' ) ,
			'Monster_Item_Three' => array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Items' , 'champs' => 'Item_ID' , 'toString' => 'Item_Name' ) ,
		**/	
		
		)
	),
	
	'Caranille_Monster_Loot' => array 
	( 
		'champs' => array(
			'Loot_Monster_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
			'Loot_Item_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "Item"),
			'Loot_Rate' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => "%"),
		),
		'key' => array ( 	
			'Loot_Monster_ID'=> array (  'key' => 'PRIMARY FOREIGN' , 'table' => 'Caranille_Monster' , 'champs' => 'Monster_ID', 'toString' => 'Monster_Name' ) ,
			'Loot_Item_ID'=> array(  'key' => 'PRIMARY FOREIGN' , 'table' => 'Caranille_Items' , 'champs' => 'Item_ID' , 'toString' => 'Item_Name' )
		)
	),

	'Caranille_Chapters' => array 
	( 
		'champs' => array
		(
			'Chapter_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Chapter_Number' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','mandatory' => true, 'label'=>'Numéro du chapitre', 'Ordering' => true),
			'Chapter_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','mandatory' => true, 'label'=>'Titre du chapitre'),
			'Chapter_Opening' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label'=>'Ouverture du chapitre', 'html' => true),
			'Chapter_Ending' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label'=>'Conclusion du chapitre', 'html' => true),
			'Chapter_Defeate' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label'=>'Echec du chapitre', 'html' => true),
			'Chapter_Monster' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','mandatory' => true, 'label'=>'Monstre du chapitre')
		),
		'key' => array 
		(
			'Chapter_ID' => array (  'key' => 'PRIMARY') ,
			'Chapter_Number' => array (  'key' => 'UNIQUE') ,
			'Chapter_Name' => array (  'key' => 'UNIQUE') ,
			
			//implique que Caranille_Monsters soit créé avant
			
			//1 monstre requiere 1 ville
			//1 ville requiere 1 chapitre
			//1 chapitre requiere 1 monstre
			
			'Chapter_Monster'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Monsters' , 'champs' => 'Monster_ID' , 'toString' => 'Monster_Name' ) ,
		) 
	),

	'Caranille_Landings' => array 
	(
		'champs' => array
		(
			'Landing_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Landing_PosX' => array ( 'type' => 'int', 'length' =>11 ,'label'=>"Latitude",'nullable' => 'NOT NULL'),
			'Landing_PosY' => array ( 'type' => 'int', 'length' =>11 ,'label'=>"Longitude",'nullable' => 'NOT NULL'),
			'Landing_Type' => array ( 'type' => 'varchar', 'length' =>30 ,'label'=>'terrain','nullable' => 'NOT NULL','values' => $array_landing_type),
		),
		'key' => array 
		(
			'Landing_ID' => array (  'key' => 'PRIMARY') ,
		)
	),
	
	'Caranille_Towns' => array 
	(
		'champs' => array
		(
			'Town_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Town_Image' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=> 'Image'),//array ( 'type' => 'varchar', 'length' =>255 ,'nullable' => 'NOT NULL', 'label' => 'Image (Adresse)'),		
			'Town_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','mandatory' => true,'label' =>'Nom de la ville'),
			'Town_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Description de la ville', 'html' => true),
			'Town_Price_INN' => array ( 'type' => 'int', 'length' =>10 ,'nullable' => 'NOT NULL','label'=> "Prix de l'auberge",'mandatory' => true),
			'Town_Chapter' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','label'=>"Ville accessible au chapitre",'mandatory' => true),
			'Town_PosX' => array ( 'type' => 'int', 'length' =>11 ,'label'=>"Latitude",'nullable' => 'NOT NULL'),
			'Town_PosY' => array ( 'type' => 'int', 'length' =>11 ,'label'=>"Longitude",'nullable' => 'NOT NULL'),
			'Town_Landing' => array ( 'type' => 'varchar', 'length' =>30 ,'label'=>'terrain','nullable' => 'NOT NULL','values' => $array_landing_type),
		),
		'key' => array 
		(
			'Town_ID' => array (  'key' => 'PRIMARY') ,
			'Town_Name' => array (  'key' => 'UNIQUE') ,
			
			//implique que Caranille_Chapters soit créé avant
			
			//1 monstre requiere 1 ville
			//1 ville requiere 1 chapitre
			//1 chapitre requiere 1 monstre
			'Town_Image' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Images' , 'champs' => 'Image_ID' , 'toString' => 'Image_Name' ) ,			
			'Town_Chapter' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Chapters' , 'champs' => 'Chapter_ID' , 'toString' => 'Chapter_Name' ) 
		)
	),
	
	'Caranille_Missions' => array 
	(
		'champs' => array
		(
			'Mission_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT') ,
			'Mission_Number' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label' => 'Numero', 'Ordering' => true),
			'Mission_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label' => 'Titre'),
			'Mission_Introduction' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Introduction', 'html' => true),
			'Mission_Victory' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Conclusion', 'html' => true),
			'Mission_Defeate' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Echec', 'html' => true),
			'Mission_Town' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label' => 'Ville'),
			'Mission_Monster' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label' => 'Monstre')
		),
		'key' => array 
		(
			'Mission_ID' => array (  'key' => 'PRIMARY') ,
			'Mission_Name' => array (  'key' => 'UNIQUE') ,
			'Mission_Town' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Towns' , 'champs' => 'Town_ID','toString' => 'Town_Name' ) ,
			'Mission_Monster'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Monsters' , 'champs' => 'Monster_ID' , 'toString' => 'Monster_Name' ) 
		) 
	),
	
	'Caranille_Accounts' => array 
	( 
		'champs' => array
		(
			'Account_ID' => array ( 'type' => 'INT' , 'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Account_Pseudo' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label' => 'Pseudo' , 'mandatory' => true),
			'Account_Password' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label'=> 'Mot de passe'),
			'Account_Salt' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL'),
			'Account_Email' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label' => 'Email' , 'mandatory' => true),
			'Account_Key' => array ( 'type' => 'varchar', 'length' =>255 ,'nullable' => 'NOT NULL'), // clé de validation
			'Account_Valid' => array ( 'type' => 'tinyint', 'length' =>4 ,'nullable' => 'NOT NULL','label'=> 'Validité', 'default' => '0'), // inscription validé

			//'Account_msn' => array ( 'type' => 'varchar', 'length' =>250, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL' ) ,
			//  'Account_Siteweb' => array ( 'type' => 'varchar', 'length' =>100, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label' => 'Site Web' ) ,
			  'Account_Avatar' => array ( 'type' => 'TEXT', 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL' ,'label' => 'Avatar') ,
			  'Account_Signature' => array ( 'type' => 'varchar', 'length' =>200, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label' => 'Signature' ) ,
			//  'Account_Localisation' => array ( 'type' => 'varchar', 'length' =>100, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label' => 'Localisation' ) ,
			 // 'Account_rang' => array ( 'type' => 'tinyint', 'length' =>4 , 'default' => 2),
			//  'Account_post' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' ) ,			
						
			'Account_Sexe' => array ( 'type' => 'varchar', 'length' =>30 ,'default' => 'homme' , 'nullable' => 'NOT NULL'),
			'Account_Level' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=> 'Niveau'),
			'Account_Effect' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'serial' => true),
			'Account_Bonus' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'serial' => true),
			'Account_HP_Remaining' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
			'Account_HP_Bonus' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
			'Account_MP_Remaining' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
			'Account_MP_Bonus' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
			'Account_Strength_Bonus' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
			'Account_Magic_Bonus' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
			'Account_Agility_Bonus' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
			'Account_Defense_Bonus' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
			'Account_Experience' => array ( 'type' => 'bigint', 'length' =>255 ,'nullable' => 'NOT NULL','label'=> 'Experience'),

            'Account_PosX' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'), // position sur la carte du monde
			'Account_PosY' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
			
			'Account_Step' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
			
			//'Account_Stat' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'), //mort, poison

			'Account_Order' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=> 'Ordre'),
			'Account_Race' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=> 'Race'),
			'Account_Classe' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=> 'Classe'),
			
			'Account_Roaster_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=> 'Roaster'),
			'Account_Roaster_Accept' => array ( 'type' => 'tinyint', 'length' =>4 ,'nullable' => 'NOT NULL','label'=> 'Accepté', 'default' => '0'), // inscription validé
			'Account_Guild_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=> 'Guilde'),
			'Account_Guild_Accept' => array ( 'type' => 'tinyint', 'length' =>4 ,'nullable' => 'NOT NULL','label'=> 'Accepté', 'default' => '0'), // inscription validé
			'Account_Rank_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=> 'Rang de guilde'),
			
			'Account_Notoriety' => array ( 'type' => 'bigint' , 'length' =>255 ,'nullable' => 'NOT NULL', 'label'=>'Notoriété' ),
			'Account_Golds' => array ( 'type' => 'bigint', 'length' =>255 ,'nullable' => 'NOT NULL','label'=> 'Fortune'),
		
			'Account_Chapter' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label' => 'Chapitre' ,'mandatory' => true),
			'Account_Access' => array ( 'type' => 'varchar', 'length' =>10 ,'nullable' => 'NOT NULL','label'=>'Acces', 'values' => $array_access_type ,'mandatory' => true),
			
			'Account_Mission' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' ,'label' => 'Mission' ),

			
			  'Account_Inscription' => array ( 'type' => 'DATETIME', 'nullable' => 'NOT NULL' ,'label'=> 'date inscription') ,
			'Account_Last_Connected' => array ( 'type' => 'DATETIME' ,'nullable' => 'NOT NULL','label'=> 'derniere actualisation'),
			'Account_Last_Connection' => array ( 'type' => 'DATETIME' ,'nullable' => 'NOT NULL','label'=> 'derniere connexion'),
			'Account_Last_IP' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label'=> 'derniere IP'),
			'Account_Status' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label'=> 'Status','values'=> $array_status_type),
			'Account_Reason' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL','label'=> 'Motif')
		),
		'key' => array (
		
			'Account_ID' => array (  'key' => 'PRIMARY') ,
			'Account_Pseudo' => array (  'key' => 'UNIQUE') ,
			'Account_Email' => array (  'key' => 'UNIQUE') ,
			'Account_Salt' => array (  'key' => 'UNIQUE') ,
			
			//implique que Caranille_Guilds/Orders/Chapters/Missions soit créé avant
			
			'Account_Roaster_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Roaster' , 'champs' => 'Roaster_ID', 'toString' => 'Roaster_ID'  ) ,
			'Account_Guild_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Guilds' , 'champs' => 'Guild_ID', 'toString' => 'Guild_Name'  ) ,
			'Account_Rank_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Rank' , 'champs' => 'Rank_ID', 'toString' => 'Rank_Name'  ) ,
			'Account_Order'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Orders' , 'champs' => 'Order_ID', 'toString' => 'Order_Name'  ) ,
			'Account_Race'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Races' , 'champs' => 'Race_ID', 'toString' => 'Race_Name'  ) ,
			'Account_Classe'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Classes' , 'champs' => 'Classe_ID', 'toString' => 'Classe_Name'  ) ,
			'Account_Chapter' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Chapters' , 'champs' => 'Chapter_ID', 'toString' => 'Chapter_Name'  ) ,
			'Account_Mission' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Missions' , 'champs' => 'Mission_ID' , 'toString' => 'Mission_Name'  ) ,
			
			// le compte admin n'a pas de level à la generation... 
			
			'Account_Level' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Levels' , 'champs' => 'Level_ID', 'toString' => 'Level_Number'  ) ,
		)
	),
	
	'Caranille_Diaries' => array(
	    
		'champs' => array(
			'Diary_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Diary_Account_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
			'Diary_Message' => array ( 'type' => 'varchar', 'length' =>255 ,'nullable' => 'NOT NULL'),
        	'Diary_Date' => array ( 'type' => 'DATETIME' ,'nullable' => 'NOT NULL'),
			'Diary_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL','label'=>'Description'),
			
		),
		
		'key' => array (
			'Diary_ID' => array (  'key' => 'PRIMARY') ,
			'Diary_Account_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID' , 'toString' => 'Account_Pseudo' ) 
		)
		    
	),

	'Caranille_Guilds' => array ( 
	
		'champs' => array(
		
			'Guild_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Guild_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label'=>'Nom'), //text
			'Guild_Level' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'Niveau', 'default' => 1),
			'Guild_Experience' => array ( 'type' => 'bigint', 'length' =>255 ,'nullable' => 'NOT NULL','label'=> 'Experience'),
			'Guild_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL','label'=>'Description', 'html' => true),
			'Guild_Message' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL','label'=>'Message'),
			'Guild_Golds' => array ( 'type' => 'bigint', 'length' =>255 ,'nullable' => 'NOT NULL','label'=>'Fortune'),
			'Guild_Owner_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'fondateur'),
			
		),
		
		'key' => array (
		    
			'Guild_ID' => array (  'key' => 'PRIMARY') ,
			'Guild_Name' => array (  'key' => 'UNIQUE') ,
			// 1 guild doit avoir 1 account
			// 1 account doit avoir 1 guilde
			'Guild_Level' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Levels' , 'champs' => 'Level_ID', 'toString' => 'Level_Number'  ) ,
			'Guild_Owner_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID', 'toString' => 'Account_Pseudo'  ) 
		)
	),
	
	'Caranille_Events' => array ( 
	
		'champs' => array(
		
			'Event_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Event_Date' => array ( 'type' => 'DATETIME' ,'nullable' => 'NOT NULL'),
			'Event_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label'=>'Titre'), //text
			'Event_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL','label'=>'Description', 'html' => true),
			'Event_Guild_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'Guilde'),
		),
		'key' => array (
		    
			'Event_ID' => array (  'key' => 'PRIMARY') ,
			'Event_Name' => array (  'key' => 'UNIQUE') ,
			'Event_Guild_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Guilds' , 'champs' => 'Guild_ID', 'toString' => 'Guild_Name'  ) 
		)
	),
	
	'Caranille_Rank' => array ( 
	
		'champs' => array(	
		
			'Rank_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Rank_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label'=>'Nom'), //text
			'Rank_Order' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'Niveau', 'default' => 1, 'Ordering' => true), //text
			'Rank_Guild_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'Guilde'),
		
		),
		
		'key' => array (
		
			'Rank_ID' => array (  'key' => 'PRIMARY') ,
			'Rank_Name' => array (  'key' => 'UNIQUE') ,
			'Rank_Guild_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Guilds' , 'champs' => 'Guild_ID', 'toString' => 'Guild_Name'  ) 
		
		)
	),
	
	'Caranille_Privileges' => array ( 
	
		'champs' => array(	
			'Privilege_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Privilege_Rank_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'Grades'),
			'Privilege_Access' => array ( 'type' => 'varchar', 'length' =>255 ,'nullable' => 'NOT NULL','label'=>'Acces', 'values' => $array_guild_functions ,'mandatory' => true),
		),
		
		'key' => array (
			'Privilege_ID' => array (  'key' => 'PRIMARY') ,
			'Privilege_Rank_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Guild_Rank' , 'champs' => 'Rank_ID', 'toString' => 'Rank_Name'  ) 
		
		)
	),

	'Caranille_Roaster'=> array ( 
	
		'champs' => array(	
			'Roaster_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Roaster_Member_1' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'fondateur'),
		/**	'Roaster_statut_1' => array ('type' => 'tinyint', 'length' =>4 , 'default' => 0,'label'=>'Utilisé ?'),
			'Roaster_Member_2' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'fondateur'),
			'Roaster_statut_2' => array ('type' => 'tinyint', 'length' =>4 , 'default' => 0,'label'=>'Utilisé ?'),
			'Roaster_Member_3' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'fondateur'),
			'Roaster_statut_3' => array ('type' => 'tinyint', 'length' =>4 , 'default' => 0,'label'=>'Utilisé ?'),
			'Roaster_Member_4' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'fondateur'),
			'Roaster_statut_4' => array ('type' => 'tinyint', 'length' =>4 , 'default' => 0,'label'=>'Utilisé ?'),
			'Roaster_Member_5' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'fondateur'),
			'Roaster_statut_5' => array ('type' => 'tinyint', 'length' =>4 , 'default' => 0,'label'=>'Utilisé ?'),
		**/
		),
		
		'key' => array (
			'Roaster_ID' => array (  'key' => 'PRIMARY') ,
			'Roaster_Member_1'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID', 'toString' => 'Account_Pseudo'  ),
			/**
			'Roaster_Member_2'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID', 'toString' => 'Account_Pseudo'  ) ,
			'Roaster_Member_3'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID', 'toString' => 'Account_Pseudo'  ) ,
			'Roaster_Member_4'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID', 'toString' => 'Account_Pseudo'  ) ,
			'Roaster_Member_5'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID', 'toString' => 'Account_Pseudo'  ) 
			**/
		)
	),
	
	
	'Caranille_Chat' => array (
	    
		'champs' => array(
		
			'Chat_Message_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT') ,
			'Chat_Pseudo_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL'),
			'Chat_Message' => array ( 'type' => 'varchar', 'length' =>255 ,'nullable' => 'NOT NULL'),
			'Chat_Guild_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
		
		),
		
		'key' => array 
		(
			'Chat_Message_ID' => array (  'key' => 'PRIMARY') ,
			'Chat_Guild_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Guilds' , 'champs' => 'Guild_ID', 'toString' => 'Guild_Name'  ) ,
			'Chat_Pseudo_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID', 'toString' => 'Account_Pseudo'  ) ,
		)
	),

	'Caranille_Inventory' => array (
		'champs' => array(
			'Inventory_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Inventory_Account_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL'),
			'Inventory_Item_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','label'=>'Item'),
			'Inventory_Item_Quantity' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','label'=>'Qté'),
			'Inventory_Item_Equipped' => array ( 'type' => 'varchar', 'length' =>10 ,'nullable' => 'NOT NULL','label'=>'Equipé?')
		),
		'key' => array (
			'Inventory_ID' => array (  'key' => 'PRIMARY') ,
			'Inventory_Account_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID' , 'toString' => 'Account_Pseudo' ) ,
			'Inventory_Item_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Items' , 'champs' => 'Item_ID', 'toString' => 'Item_Name'  ) ,
		)
	),
	
	'Caranille_Inventory_Ressources' => array
	(
		'champs' => array
		(
			'Inventory_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Inventory_Account_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL'),
			'Inventory_Ressource_ID'=> array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','label'=>'Ressource'), 
			'Inventory_Ressource_Quantity' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','label'=>'Qté'),
		),
		'key' => array 
		(
			'Inventory_ID' => array (  'key' => 'PRIMARY') ,
			'Inventory_Account_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID' , 'toString' => 'Account_Pseudo' ) ,
			'Inventory_Ressource_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Ressources' , 'champs' => 'Ressource_ID', 'toString' => 'Ressource_Name'  ) ,
		)
	),

	'Caranille_Inventory_Fragments' => array (
		'champs' => array(
			'Inventory_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Inventory_Account_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL'),
			'Inventory_Fragment_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','label'=>'fragment'),
			'Inventory_Fragment_Quantity' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','label'=>'Qté'),
		),
		'key' => array (
			'Inventory_ID' => array (  'key' => 'PRIMARY') ,
			'Inventory_Account_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID' , 'toString' => 'Account_Pseudo' ) ,
			'Inventory_Fragment_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Items' , 'champs' => 'Item_ID', 'toString' => 'Item_Name'  ) ,
		)
	),

	'Caranille_Invocations' => array (
		'champs' => array(
			'Invocation_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Invocation_Image' =>  array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','label'=>'Image'),//array ( 'type' => 'varchar', 'length' =>255 ,'nullable' => 'NOT NULL','label'=>'Image'),	
			'Invocation_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label'=>'Nom'),
			'Invocation_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL','label'=>'Description', 'html' => true),
			'Invocation_Damage' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'Degats'),
			'Invocation_Town' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','label'=>'Ville'),
			'Invocation_Price' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'Prix')
		),
		'key' => array (
			'Invocation_ID' => array (  'key' => 'PRIMARY') ,
			'Invocation_Name' => array (  'key' => 'UNIQUE') ,
			'Invocation_Image' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Images' , 'champs' => 'Image_ID' , 'toString' => 'Image_Name' ) ,			
			'Invocation_Town'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Towns' , 'champs' => 'Town_ID' , 'toString' => 'Town_Name' ) ,
		)
	),
	
	'Caranille_Inventory_Invocations' => array (
		'champs' => array(
			'Inventory_Invocation_Account_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL'),
			'Inventory_Invocation_Invocation_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','label'=>'Chimère')
		),
		'key' => array (
			'Inventory_Invocation_Account_ID'=> array (  'key' => 'PRIMARY FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID' ) ,
			'Inventory_Invocation_Invocation_ID'=> array(  'key' => 'PRIMARY FOREIGN' , 'table' => 'Caranille_Invocations' , 'champs' => 'Invocation_ID' , 'toString' => 'Invocation_Name' )
		)
	),

	'Caranille_Magics' => array (
		'champs' => array(
			'Magic_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Magic_Image' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','label'=>'Image'),//array ( 'type' => 'varchar', 'length' =>255 ,'nullable' => 'NOT NULL', 'label' => 'Image'),	
			'Magic_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label' => 'Name'),
			'Magic_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Description', 'html' => true),
			'Magic_Type' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label' => 'Type', 'values' => $array_magic_type),
			'Magic_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => 'Puissance Magique'),
			//'Magic_Effect' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'serial' => true),
			'Magic_MP_Cost' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => 'cout en MP'),
			'Magic_Town' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label' => 'Ville'),
			'Magic_Price' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => 'Prix d\'achat' )
		),
		'key' => array (
			'Magic_ID' => array (  'key' => 'PRIMARY') ,
			'Magic_Name' => array (  'key' => 'UNIQUE') ,
			'Magic_Image' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Images' , 'champs' => 'Image_ID' , 'toString' => 'Image_Name' ) ,			
			'Magic_Town'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Towns' , 'champs' => 'Town_ID' , 'toString' => 'Town_Name'  ) 
		)
	),
		
	
	'Caranille_Inventory_Magics' => array (
		'champs' => array(
		'Inventory_Magic_Account_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL'),
		'Inventory_Magic_Magic_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','label'=>'Sort')
		),
		'key' => array (
			'Inventory_Magic_Account_ID'=> array(  'key' => 'PRIMARY') ,// (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID' ) ,
			'Inventory_Magic_Magic_ID'=> array(  'key' => 'PRIMARY FOREIGN' , 'table' => 'Caranille_Magics' , 'champs' => 'Magic_ID' , 'toString' => 'Magic_Name')
		)
	),
					
	'Caranille_Missions_Successful' => array (
		'champs' => array(
			'Mission_Successful_Mission_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL'),// , 'increment' => 'AUTO_INCREMENT') ,
			'Mission_Successful_Account_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL')
		),
		'key' => array (
			'Mission_Successful_Mission_ID' => array(  'key' => 'PRIMARY') ,// ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Missions' , 'champs' => 'Mission_ID' ) ,
			'Mission_Successful_Account_ID'=> array(  'key' => 'PRIMARY FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID' ) ,
		)
	),

	'Caranille_Newsreaders' => array (
		'champs' => array(
			'Newsreaders_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Newsreaders_Pseudo' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label' => 'Pseudo' , 'mandatory' => true),
			'Newsreaders_Password' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label'=> 'Mot de passe'),
			'Newsreaders_Email' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label' => 'Email' , 'mandatory' => true),
			'Newsreaders_Key' => array ( 'type' => 'varchar', 'length' =>255 ,'nullable' => 'NOT NULL'), // clé de validation
			'Newsreaders_Valid' => array ( 'type' => 'tinyint', 'length' =>4 ,'nullable' => 'NOT NULL','label'=> 'Validité', 'default' => '0'), // inscription validé
			'Newsreaders_isBadMail' => array ( 'type' => 'tinyint', 'length' =>1 ,'nullable' => 'NOT NULL','label'=> 'Fonctionnell', 'default' => '0'),
		),
		'key' => array (
		
			'Newsreaders_ID' => array (  'key' => 'PRIMARY') ,
			'Newsreaders_Pseudo' => array (  'key' => 'UNIQUE') ,
			'Newsreaders_Email' => array (  'key' => 'UNIQUE') ,
			'Newsreaders_Key' => array (  'key' => 'UNIQUE') ,
		)
	),		
	
	'Caranille_News' => array (
		'champs' => array(
		'News_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
		'News_Title' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL','label'=>'Titre'),
		'News_Intro' => array ( 'type' => 'varchar', 'length' =>255 ,'nullable' => 'NOT NULL','label'=>'Intro'),
		'News_Message' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL','label'=>'Message', 'html' => true),
		'News_Account_Pseudo' => array ( 'type' => 'varchar', 'length' =>15 ,'nullable' => 'NOT NULL','label'=>'Auteur'),
		'News_Date' => array ( 'type' => 'DATETIME' ,'nullable' => 'NOT NULL','label'=>'Date')
		),
		'key' => array (
			'News_ID' => array (  'key' => 'PRIMARY') ,
			'News_Account_Pseudo'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_Pseudo', 'toString' => 'Account_Pseudo'  )
		)
	),
	
	'Caranille_Comments' => array (
		'champs' => array(
			'Comment_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Comment_Message' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL','label'=>'Comments', 'html' => true),
			'Comment_Note' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL','label'=>'Note' ) ,
			'Comment_Account_Pseudo' => array ( 'type' => 'varchar', 'length' =>15 ,'nullable' => 'NOT NULL','label'=>'Auteur'),
			'Comment_Date' => array ( 'type' => 'DATETIME' ,'nullable' => 'NOT NULL','label'=>'Date'),
			'Comment_News_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'News')
		),
		'key' => array (
			'Comment_ID' => array (  'key' => 'PRIMARY') ,
			'Comment_News_ID'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_News' , 'champs' => 'News_ID' , 'toString' => 'News_Title'),
			'Comment_Account_Pseudo'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_Pseudo', 'toString' => 'Account_Pseudo' )
		)
	),
					
	'Caranille_Orders' => array (
		'champs' => array(
			'Order_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Order_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label' => 'Nom'),
			'Order_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Description', 'html' => true),
			'Order_Effect' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Effet(concept)', 'serial' => true),

			'Order_HP_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'HP+'),
			'Order_MP_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=> 'MP+'),
			'Order_Strength_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Force+'),
			'Order_Magic_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Magie+'),
			'Order_Agility_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Agilité+'),
			'Order_Defense_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Defense+'),
		),
		'key' => array (
			'Order_ID' => array (  'key' => 'PRIMARY') ,
			'Order_Name' => array (  'key' => 'UNIQUE') 
		)
	),
		
	'Caranille_Private_Messages' => array
	(
		'champs' => array
		(
			'Private_Message_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Private_Message_Transmitter' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL'),
			'Private_Message_Receiver' => array ( 'type' => 'varchar', 'length' =>20 ,'nullable' => 'NOT NULL'),
			'Private_Message_Subject' => array ( 'type' => 'varchar', 'length' =>255 ,'nullable' => 'NOT NULL'),
			'Private_Message_Message' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL'),
			'Private_Message_Conversation' => array ( 'type' => 'INT' , 'length' =>5,'nullable' => 'NOT NULL'  ) ,			
		//	'Private_Message_Lu' => array ( 'type' => 'INT' , 'length' =>5,'nullable' => 'NOT NULL'  ) 			
		),
		'key' => array (
			'Private_Message_ID' => array (  'key' => 'PRIMARY') ,
			'Private_Message_Receiver'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_Pseudo' , 'toString' => 'Account_Pseudo'),
			'Private_Message_Conversation'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Private_Messages' , 'champs' => 'Private_Message_ID' , 'toString' => 'Private_Message_Subject')
		)
	),
				
	'Caranille_Sanctions' => array (
		'champs' => array(
		'Sanction_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
		'Sanction_Type' => array ( 'type' => 'varchar', 'length' =>15 ,'nullable' => 'NOT NULL','label'=>'Type'),
		'Sanction_Message' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL','label'=>'Message', 'html' => true),
		'Sanction_Transmitter' => array ( 'type' => 'varchar', 'length' =>50 ,'nullable' => 'NOT NULL','label'=>'Responsable'),
		'Sanction_Receiver' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'Receveur')
		),
		'key' => array (
			'Sanction_ID' => array (  'key' => 'PRIMARY') ,
			'Sanction_Receiver'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID' , 'toString' => 'Account_Pseudo')
		)
	),
	
	'Caranille_Quests' => array 
	(
		'champs' => array
		(
			'Quest_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT') ,
			'Quest_Town_Origin' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label'=>'ville d\'Origine'),
			'Quest_Town_Return' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label'=>'ville de retour'),
			'Quest_Number' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label'=>'Numero', 'Ordering' => true),
			'Quest_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label'=>'Nom'),
			'Quest_Goal' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label'=>'Objectif'),
			'Quest_Introduction' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label'=>'Introduction', 'html' => true),
			'Quest_Victory' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label'=>'Victoire', 'html' => true),
			'Quest_Defeate' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label'=>'Echec', 'html' => true),
			'Quest_Item' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label'=>'Item à trouver'),
			'Quest_Count' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label'=>'Nombre à atteindre'),
			'Quest_Monster' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label'=>'Monstre à abattre'),
			'Quest_Item_Gift' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label'=>'Item Cadeaux'),
			'Quest_Gold_Gift' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label'=>'Or Cadeaux'),
			'Quest_XP_Gift' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label'=>'Experience Cadeaux')
		),
		'key' => array 
		(
			'Quest_ID' => array (  'key' => 'PRIMARY') ,
			'Quest_Name' => array (  'key' => 'UNIQUE') ,
			'Quest_Item_Gift' => array (   'key' => 'FOREIGN' , 'table' => 'Caranille_Items' , 'champs' => 'Item_ID' , 'toString' => 'Item_Name' ) ,
			'Quest_Item' => array (   'key' => 'FOREIGN' , 'table' => 'Caranille_Items' , 'champs' => 'Item_ID'  , 'toString' => 'Item_Name') ,
			'Quest_Town_Origin' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Towns' , 'champs' => 'Town_ID' , 'toString' => 'Town_Name') ,
			'Quest_Town_Return' => array ( 'key' => 'FOREIGN' , 'table' => 'Caranille_Towns' , 'champs' => 'Town_ID' , 'toString' => 'Town_Name') ,
			'Quest_Monster'=> array (  'key' => 'FOREIGN' , 'table' => 'Caranille_Monsters' , 'champs' => 'Monster_ID', 'toString' => 'Monster_Name' ) 
		) 
	),
	
	'Caranille_Inventory_Quests' => array
	(
		'champs' => array
		(
			'Inventory_Quest_Account_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL'),
			'Inventory_Quest_Quest_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL'),
			'Inventory_Quest_Quantity' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL'),
			'Inventory_Quest_Status' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL'),
		),
		'key' => array 
		(
			'Inventory_Quest_Account_ID'=> array (  'key' => 'PRIMARY FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID' ) ,
			'Inventory_Quest_Quest_ID'=> array(  'key' => 'PRIMARY FOREIGN' , 'table' => 'Caranille_Invocations' , 'champs' => 'Invocation_ID' )
		)
	),
	
	'Caranille_Building' => array 
	(
		'champs' => array
		(
			'Building_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT') ,
			'Building_Type' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'values' => $array_building_type, 'label' => 'type'),
			'Building_Town_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL','label' => 'ville'),
			'Building_PosX' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label' => 'X'),
			'Building_PosY' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label' => 'Y'),
		),
		'key' => array 
		(
			'Building_ID'=> array(  'key' => 'PRIMARY' ), 
			'Building_Town_ID'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Towns' , 'champs' => 'Town_ID', 'toString' => 'Town_Name' )
		)
	),
	
	'Caranille_Position' => array 
	(
		'champs' => array
		(
			//'Position_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT') ,
			'Position_Account_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL'),
			'Position_Town_ID' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL'),
			'Position_PosX' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
			'Position_PosY' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL'),
		),
		'key' => array 
		(
			//'Position_ID'=> array(  'key' => 'PRIMARY') ,
			'Position_Account_ID'=> array (  'key' => 'PRIMARY FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID' ) ,
			'Position_Town_ID'=> array(  'key' => 'PRIMARY FOREIGN' , 'table' => 'Caranille_Invocations' , 'champs' => 'Invocation_ID' )
		)
	),
	
'Caranille_Categories' => array 
( 
	'champs' => array
	(
	  'Cat_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT') ,
	  'Cat_Nom' => array ( 'type' => 'varchar', 'length' =>30, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL', 'label' => 'Nom' ) ,
	  'Cat_Guild_ID' => array ( 'type' => 'mediumint', 'length' =>8 ,'default' => '0', 'label' => 'Guilde' ) ,
	  'Cat_Ordre' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'Position', 'Ordering' => true ) 
	),
	'key' => array(
		'Cat_ID' => array(  'key' => 'PRIMARY'),
		'Cat_Guild_ID'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Guilds' , 'champs' => 'Guild_ID', 'toString' => 'Guild_Name' ),
		'Cat_Ordre' => array (  'key' => 'UNIQUE') ,
	)
),
 
'Caranille_Forums' => array 
( 
	'champs' => array
	(
	  'Forum_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT') ,
	  'Forum_Cat_ID' => array ( 'type' => 'mediumint', 'length' =>8 ,'nullable' => 'NOT NULL', 'label' => 'Categorie' ) ,
	  'Forum_Guild_ID' => array ( 'type' => 'mediumint', 'length' =>8 ,'default' => '0', 'label' => 'Guilde' ) ,
	  'Forum_Name' => array ( 'type' => 'varchar', 'length' =>30, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL', 'label' => 'Nom' ) ,
	  'Forum_Desc' => array ( 'type' => 'text' ,'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL', 'label' => 'Description' , 'html' => true) ,
	  'Forum_Ordre' => array ( 'type' => 'mediumint', 'length' =>8 ,'nullable' => 'NOT NULL' , 'label' => 'Position', 'Ordering' => true) ,
	  //'Forum_Last_Post_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => 'Dernier Post' ) ,
	  //'Forum_Topic' => array ( 'type' => 'mediumint', 'length' =>8 ,'nullable' => 'NOT NULL' , 'label' => 'Topic' ) ,
	  //'Forum_Post' => array ( 'type' => 'mediumint', 'length' =>8 ,'nullable' => 'NOT NULL' , 'label' => 'Post' ) ,
	  'Auth_View' => array ( 'type' => 'varchar', 'length' =>10 ,'nullable' => 'NOT NULL','label'=>'Acces vue ', 'default' => "Visit", 'values' => $array_access_type ,'mandatory' => true),//'type' => 'tinyint', 'length' =>4 ,'nullable' => 'NOT NULL' ) ,
	  'Auth_Post' => array ( 'type' => 'varchar', 'length' =>10 ,'nullable' => 'NOT NULL','label'=>'Acces Post ', 'default' => "Member", 'values' => $array_access_type ,'mandatory' => true),//'type' => 'tinyint', 'length' =>4 ,'nullable' => 'NOT NULL' ) ,
	  'Auth_Topic' => array ( 'type' => 'varchar', 'length' =>10 ,'nullable' => 'NOT NULL','label'=>'Acces topic ', 'default' => "Member", 'values' => $array_access_type ,'mandatory' => true),//'type' => 'tinyint', 'length' =>4 ,'nullable' => 'NOT NULL' ) ,
	  'Auth_Annonce' => array ( 'type' => 'varchar', 'length' =>10 ,'nullable' => 'NOT NULL','label'=>'Acces Annonce ', 'default' => "Modo", 'values' => $array_access_type ,'mandatory' => true),//'type' => 'tinyint', 'length' =>4 ,'nullable' => 'NOT NULL' ) ,
	  'Auth_Modo' => array ( 'type' => 'varchar', 'length' =>10 ,'nullable' => 'NOT NULL','label'=>'Acces Moderation ', 'default' => "Modo", 'values' => $array_access_type ,'mandatory' => true),//'type' => 'tinyint', 'length' =>4 ,'nullable' => 'NOT NULL' ) ,
	),
	'key' => array(
		'Forum_ID' => array(  'key' => 'PRIMARY'),
		'Forum_Guild_ID'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Guilds' , 'champs' => 'Guild_ID', 'toString' => 'Guild_Name' ),
		'Forum_Cat_ID'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Categories' , 'champs' => 'Cat_ID', 'toString' => 'Cat_Nom' ),
		//'Forum_Last_Post_ID'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Posts' , 'champs' => 'Post_ID', 'toString' => 'Post_Texte' )
	) 
),
 
'Caranille_Posts' => array 
( 
	'champs' => array
	(
	  'Post_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT') ,
	  'Post_Createur' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=> 'Auteur' ) ,
	  'Post_Texte' => array ( 'type' => 'text' ,'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL', 'label' => 'Texte' , 'html' => true) ,
	  'Post_Time' => array ( 'type' => 'DATETIME', 'nullable' => 'NOT NULL','label'=> 'Date') ,
	  'Post_Guild_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'Guild') ,
	  'Post_Topic_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'Topic'  ) ,
	  'Post_Forum_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'Forum') ,
	),
	'key' => array(
		'Post_ID' => array(  'key' => 'PRIMARY'),
		'Post_Topic_ID'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Topics' , 'champs' => 'Topic_ID', 'toString' => 'Topic_Titre' ),
		'Post_Createur'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID', 'toString' => 'Account_Pseudo' ),
		'Post_Guild_ID'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Guilds' , 'champs' => 'Guild_ID', 'toString' => 'Guild_Name' ),
		'Post_Forum_ID'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Forums' , 'champs' => 'Forum_ID', 'toString' => 'Forum_Name' )
	)   
),

'Caranille_Topics' => array ( 
	'champs' => array(
	  'Topic_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT') ,
	  'Topic_Forum_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'Forum') ,
	  'Topic_Guild_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'Guild') ,
	  'Topic_Titre' => array ( 'type' => 'char', 'length' =>60, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL', 'label' => 'Nom' ) ,
	  'Topic_Createur' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=> 'Auteur' ) ,
	  'Topic_Vu' => array ( 'type' => 'mediumint', 'length' =>8 ,'nullable' => 'NOT NULL' ,'label'=>'vue') ,
	  'Topic_Time' => array ( 'type' => 'DATETIME','nullable' => 'NOT NULL' ,'label'=> 'Date' ) ,
	  'Topic_Genre' => array ( 'type' => 'varchar', 'length' =>30, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label'=> 'Genre', 'values' => $array_topic_type ) ,
	  //'Topic_Last_Post' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => 'Dernier Post' ) ,
	  //'Topic_First_Post' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label' => 'Premier Post' ) ,
	  //'Topic_Post' => array ( 'type' => 'mediumint', 'length' =>8 ,'nullable' => 'NOT NULL', 'label' => 'Post' ) ,
	  'Topic_Locked' => array ('type' => 'tinyint', 'length' =>4 , 'default' => 0)
	),
	'key' => array(
		'Topic_ID' => array(  'key' => 'PRIMARY'),
		'Topic_Last_Post'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Posts' , 'champs' => 'Post_ID', 'toString' => 'Post_Texte' ),
		'Topic_Createur'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID', 'toString' => 'Account_Pseudo' ),
		'Topic_Forum_ID'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Forums' , 'champs' => 'Forum_ID', 'toString' => 'Forum_Name' ),
		'Topic_Guild_ID'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Guilds' , 'champs' => 'Guild_ID', 'toString' => 'Guild_Name' ),
		'Topic_First_Post'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Posts' , 'champs' => 'Post_ID', 'toString' => 'Post_Texte' )
	)  
),
'Caranille_Gifts' =>array(
	'champs' => array(
		'Gift_ID'  => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT') ,
		'Gift_Code' => array ( 'type' => 'varchar', 'length' =>255, ' collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label'=>'Code'),
		'Gift_Used' => array ('type' => 'tinyint', 'length' =>4 , 'default' => 0,'label'=>'Utilisé ?'),
		'Gift_Publication' => array ( 'type' => 'DATETIME','nullable' => 'NOT NULL' ,'label'=> 'Date' ) , 
		'Gift_Item' => array ( 'type' => 'int', 'length' =>5 ,'nullable' => 'NOT NULL', 'label'=>'Item Cadeaux'),
	 
	),
	'key' => array(
		'Gift_ID' => array(  'key' => 'PRIMARY'),
		'Gift_Code' => array (  'key' => 'UNIQUE') ,
		'Gift_Item' => array (   'key' => 'FOREIGN' , 'table' => 'Caranille_Items' , 'champs' => 'Item_ID' , 'toString' => 'Item_Name' ) ,

	)  
),


'Caranille_Menus' =>array(
	'champs' => array(
	  'Menu_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT') ,
	  'Menu_Affiche' => array ( 'type' => 'varchar', 'length' =>30, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label'=> 'Affiche', 'values' => list_modules() ) ,
	  'Menu_Position' => array ( 'type' => 'varchar', 'length' =>30, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label'=> 'Position', 'values' => array("Head","left","Right","Sub","Footer") ) , ///???
	  'Menu_Ordre' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'Numero' , 'Ordering' => true) ,
		'Menu_Type' => array ( 'type' => 'varchar', 'length' =>50, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label'=> 'Type', 'values' => array('Rubrique','Lien')),
		'Menu_Parent' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'default' => '0','label'=> 'Parent'),
		'Menu_Label' => array ( 'type' => 'varchar', 'length' =>50, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label'=> 'label'),
	  'Menu_Module' => array ( 'type' => 'varchar', 'length' =>30, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label'=> 'Module', 'values' => list_modules() ) ,
	  'Menu_Link' => array ( 'type' => 'varchar', 'length' =>30, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label'=> 'Lien', 'values' => array() ) ,
	),
	'key' => array(
		'Menu_ID' => array(  'key' => 'PRIMARY'),
		'Menu_Parent' => array (   'key' => 'FOREIGN' , 'table' => 'Caranille_Menus' , 'champs' => 'Menu_ID' , 'toString' => 'Menu_Label' ) ,
	)  
),

	'Caranille_Classes' => array (
		'champs' => array(
			'Classe_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Classe_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label' => 'Nom'),
			'Classe_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Description', 'html' => true),
			'Classe_Effect' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Effets(concept)', 'serial' => true),
			
	        'Classe_Armor' => array ( 'type' => 'varchar', 'length' =>10 ,'nullable' => 'NOT NULL','label'=>'Armes', 'values' => $array_armor_type ,'mandatory' => true),
	        'Classe_Weapon' => array ( 'type' => 'varchar', 'length' =>10 ,'nullable' => 'NOT NULL','label'=>'Armes', 'values' => $array_weapon_type ,'mandatory' => true),
	        'Classe_Role' => array ( 'type' => 'varchar', 'length' =>10 ,'nullable' => 'NOT NULL','label'=>'ArchÃ©type', 'values' => $_roles_classes ,'mandatory' => true),
	        
	        'Classe_Order_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'Guild') ,

			'Classe_HP_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'HP+'),
			'Classe_MP_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=> 'MP+'),
			'Classe_Strength_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Force+'),
			'Classe_Magic_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Magie+'),
			'Classe_Agility_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Agilité+'),
			'Classe_Defense_Effect' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL', 'label'=>'Defense+'),
		),
		'key' => array (
			'Classe_ID' => array (  'key' => 'PRIMARY') ,
			'Classe_Name' => array (  'key' => 'UNIQUE') ,
		    'Classe_Order_ID'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Orders' , 'champs' => 'Order_ID', 'toString' => 'Order_Name' ),
		)
	),
/**
	'Caranille_Money' => array 
	(
		'champs' => array
		(
			'Money_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Money_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label' => 'Nom'),
			'Money_Ordre' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'Numero' , 'Ordering' => true) ,
		),
		'key' => array(
			'Money_ID' => array(  'key' => 'PRIMARY'),
			'Money_Name' => array (  'key' => 'UNIQUE') 
		)  
	),	
**/	
	'Caranille_Works' => array 
	(
		'champs' => array
		(
			'Work_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Work_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label' => 'Nom'),
			'Work_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Description', 'html' => true),
			'Work_Fabrique' => array ( 'type' => 'varchar', 'length' =>50, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label'=> 'Type', 'values' => $array_work_class ), //array('ressource','fragment','item')),
			//'Work_Effect' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'serial' => true),
		
		),
		'key' => array 
		(
			'Work_ID' => array (  'key' => 'PRIMARY') ,
			'Work_Name' => array (  'key' => 'UNIQUE') 
		)
	),	
	
	'Caranille_Competences' => array 
	(
		'champs' => array
		(
			'Competence_Work_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'metier'),
			'Competence_Account_ID' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'joueur'),
			'Competence_Level' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'niveau'),
			'Competence_Experience' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'Expérience'),
		),
		'key' => array(
			'Competence_Account_ID'=> array(   'key' => 'PRIMARY FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID', 'toString' => 'Account_Pseudo' ),
			'Competence_Work_ID'=> array(   'key' => 'PRIMARY FOREIGN' , 'table' => 'Caranille_Works' , 'champs' => 'Work_ID', 'toString' => 'Work_Name' ),
		)
	),
	'Caranille_Races' => array (
		'champs' => array(
			'Race_ID' => array ( 'type' => 'INT' ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT' ) ,
			'Race_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label' => 'Nom'),
			'Race_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Description', 'html' => true),
			'Race_Effect' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Effets(Concept)', 'serial' => true),
		),
		'key' => array (
			'Race_ID' => array (  'key' => 'PRIMARY') ,
			'Race_Name' => array (  'key' => 'UNIQUE') 
		)
	),	

	'Caranille_Plugins' => array(
		'champs' => array(
			//'Plugin_ID' => array ( 'type' => 'tinyint', 'length' =>4 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT'),
			'Plugin_Name' => array ( 'type' => 'varchar', 'length' =>30 ,'nullable' => 'NOT NULL', 'label' => 'Nom'),
			//'Plugin_Description' => array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Description'),
			'Plugin_Active' => array ( 'type' => 'tinyint', 'length' =>4 ,'nullable' => 'NOT NULL','label'=> 'Activé', 'default' => '0'), // inscription validé
		 ),
		'key' => array(
			//'Plugin_ID' => array(  'key' => 'UNIQUE'),
			'Plugin_Name' => array (  'key' => 'PRIMARY') 
		)
	),

	'Caranille_Styles' => array ( 
		'champs' => array(
			'Style_ID' => array ( 'type' => 'tinyint', 'length' =>4 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT'),
			'Style_Commentaire' => array ( 'type' => 'varchar', 'length' =>50, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL'),
			'Style_Code' => array ( 'type' => 'varchar', 'length' =>255, ' collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL'),
	  ),
		'key' => array(
			'Style_ID' => array(  'key' => 'PRIMARY'),
		)
	),

'Caranille_Friends' => array ( 
	'champs' => array( 
			'Friend_Request' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'Demandeur'),
			'Friend_Answer' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'Cible'),
	
	),
	'key' => array(
		'Friend_Request'=> array(   'key' => 'PRIMARY FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID', 'toString' => 'Account_Pseudo' ),
		'Friend_Answer'=> array(   'key' => 'PRIMARY FOREIGN' , 'table' => 'Caranille_Accounts' , 'champs' => 'Account_ID', 'toString' => 'Account_Pseudo' ),
	)
),

'Caranille_Images' => array(
	'champs' => array(
	
		'Image_ID'=>array ( 'type' => 'tinyint', 'length' =>4 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT'),
		'Image_Name'=>array ( 'type' => 'varchar', 'length' =>50, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL'), 
		'Image_Base64'=>array ( 'type' => 'TEXT' ,'nullable' => 'NOT NULL', 'label' => 'Description'),
		'Image_Type'=>array ( 'type' => 'varchar', 'length' =>50, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL'),
		
	),
	'key' => array(
		'Image_ID' => array(  'key' => 'PRIMARY'),
		'Image_Name' => array(  'key' => 'UNIQUE'),
	)
),

'Caranille_Caracteristiques' => array(
	'champs' => array(
	
		'Caracteristique_ID'=>array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'increment' => 'AUTO_INCREMENT'),
		'Caracteristique_Name'=>array ( 'type' => 'varchar', 'length' =>50, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label'=> 'Nom'), 
		'Caracteristique_Type' => array ( 'type' => 'varchar', 'length' =>50, 'collate' => 'utf8_general_ci' ,'nullable' => 'NOT NULL','label'=> 'Type', 'values' => array('Barre','Statistique')),
		'Caracteristique_Opposant' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL' , 'label' => 'Opposant'),
		'Caracteristique_Order' => array ( 'type' => 'int', 'length' =>11 ,'nullable' => 'NOT NULL','label'=>'Niveau', 'default' => 1, 'Ordering' => true), //text

	),
	'key' => array(
		'Caracteristique_ID' => array(  'key' => 'PRIMARY'),
		'Caracteristique_Opposant'=> array(   'key' => 'FOREIGN' , 'table' => 'Caranille_Caracteristiques' , 'champs' => 'Caracteristique_ID', 'toString' => 'Caracteristique_Name' ),
	)
)

);

?>