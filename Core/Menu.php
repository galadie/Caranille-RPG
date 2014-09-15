<?php

	$menu_mapping = array(
	
		'install' => array(
		
			'MMORPG'=> array(
			
					array('Install',($install_step > 1 ? '&step='.$install_step : ''),'Installation'),
					
					array('propos','Install','Propos'),
					array('mentions','Install','Mentions légales'), 
					
					array('reglements','Install','Fonctionnalités'),
					array('nouveautes','Install','Nouveautés'),
					array('avenir','Install','Avenir'),
					
					array('faq','Install','FAQ'), 
					
					array('videos','Install','Vidéos'), 
					array('version','Install','Versions'), 
					
					array('contact','Install','Contact'),
					array('remerciements','Install','Remerciements'),
					array('configuration','Install','Configuration')
				),
			),
	
		'visitor' =>array(
		
			'MMORPG'=> array(
			
					array('Main','Public','Accueil'),
					array('Presentation','Public','Présentation'),
					array('Gallery','Content','Galerie d\'images'),
					
				),

			'Espace Joueurs'=> array(
			
					array('Members','Register','Inscription'),
					array('Login','User','Connexion'),
					
				),
				
			'Informations'=> array(
			
					array('Password_Renew','User','Mot de passe perdu'),
					array('Email_Valid','User','Mail de validation'),
					array('Delete_Account','User','Désinscription'),
					
				),
			),
			
		'player' =>array(
	
			'MMORPG'=> array(
			
					array('Main','Public','L\'actualité'),
					array('Story','Battle','L\'histoire'),
					array('Map','Map','La carte'),
					
				),
		
			'Mon Compte'=> array(
			
					array('Profil','User','Profil'),
					array('Character','Game','Avatar'),
					array('Guild','Guild','Guilde'),
					
				),
		
			 'La Communauté'=> array(
			 
					array('Arena','Game','Arène'),
					array('Private_Message','User','Messagerie('.count_message().')'),
					array('Chat','User','Chat'),
					array('Main','Forum','Forum'),
					
				),
				
			'jeu'=> array(
			
					array('Logout','User','Déconnexion'),
					
				),
			),
			
			
		'guild' => array(
		
			'jeu'=> array(
			
					array('Character','Game','Retour'), 
					array('Guild','Guild','menu.guild'),
					array('Calendar','Guild','menu.calendar'),
					array('Gift','Guild','menu.gift'),
					array('Main','Guild','menu.forum') 	,
					array('Membres','Guild','menu.members'),
					
				),
				
		
			'Administration'=> array(
			
					array('Configuration','Guild','Configuration'),
					array('Pages','Guild','Pages'),

					array('Rank','Guild','menu.rank','rank'),
			
					array('Recrutement','Guild','menu.recrutement','recrutement'),

					array('Message','Guild','menu.message','message')
				),
				
			'Forum'=> array(
			
					array('Categories','Guild','categories'),
					array('Forums','Guild','forums'),
		
				),
		),
		
		'modo' => array(
		
			'jeu'=> array(
			
					array('Character','Game','Retour'),
					
				),
			
			'Punitions'=> array(
			
					array('Sanctions','Moderator','Sanctions'),
					array('Warnings','Moderator','Avertissements'),
					
				),
			
			
			'Forum'=> array(
			
					array('topics','Moderator','Topic'),
					array('posts','Moderator','posts'),
					
				),
			),
	
		'admin' => array(
		
			'jeu'=> array(
			
					array('Character','Game','Retour'),
					
				),
			
		    'Administration'=> array(
			
					array('Configuration','Admin','Configuration'),
					array('Bdd','Admin','base de données'),
					array('Pages','Admin','Pages'),
					array('Plugins','Admin','Plugins'),
					
				),
			
		    'Actualités'=> array(
			
					array('News','Admin','News'),
					array('Comments','Admin','Commentaires'),
					//array('Comments','Admin','Newsletters'),
					
				),
			
		    'Communauté'=> array(
			 
					array('Accounts','Admin','Comptes'),
					array('Guilds','Admin','Guildes'),
					array('Orders','Admin','Ordres'),
					array('Classes','Admin','Classes'),
					array('Races','Admin','Races'),
					array('Works','Admin','Metiers'),
					
				),
			
			'Géographie'=> array(
			
					array('Towns','Admin','Villes'),
					array('Landing','Admin','Terrains'),
				
				),
			
			'Récit'=> array(
			
					array('Chapters','Admin','Chapitres'),
					array('Missions','Admin','Missions'),
					array('Quests','Admin','Quetes'),
				),
			
		    'Catalogue'=> array(
			
					array('Fragments','Admin','Fragments'),
					array('Equipment','Admin','Equipements'),
					array('Items','Admin','Objets'),
					array('Parchments','Admin','Parchemins'),
					array('Weapons','Admin','Armes'),
				),
			
		    'Talents'=> array(
			
					array('Levels','Admin','Niveaux'),
					array('Caracteristiques','Admin','Caractéristiques'),
					array('Magics','Admin','Magies'),
				),
			
		    'Bestiaire'=> array(
			
					array('Invocations','Admin','Chimères'),
					array('Monsters','Admin','Monstres'),
				),
			
		    'Forum'=> array(
			
					array('Categories','Admin','categories'),
					array('Forums','Admin','forums'),
					array('Topics','Admin','topics'),
					array('Posts','Admin','posts'),
				),
			
		    'Design'=> array(
					array('Design','Admin','design'),
					array('Images','Admin','images'),
				),
			)
		);
		
	