<?php
	function call_menu_visitor()
	{	
		if(!verif_connect(true))
		{ 
			html_menu('MMORPG',array(
					array('Main','Public','Accueil'),
					array('Presentation','Public','Présentation'),
					array('Gallery','Content','Galerie d\'images'),
			));

			html_menu('Espace Joueurs',array(
					array('Members','Register','Inscription'),
					array('Login','User','Connexion'),
			));
			html_menu('Informations',array(
					array('Password_Renew','User','Mot de passe perdu'),
					array('Email_Valid','User','Mail de validation'),
					array('Delete_Account','User','Désinscription'),
			));
		
		}
	}
	
	function call_menu_player()
	{
		global $secteur_module , $Total_Private_Message ;
		
		if(verif_connect(true) && ($secteur_module !== 'Admin' && $secteur_module !== 'Moderator')) // fichier Functions.php
		{
			html_menu('MMORPG',array(
				array('Main','Public','L\'actualité'),
				array('Story','Battle','L\'histoire'),
				array('Map','Map','La carte'),
			));
		
			html_menu('Mon Compte',array(
				array('Profil','User','Profil'),
				array('Character','Game','Avatar'),
				array('Guild','Guild','Guilde'),
			));
		
			html_menu('La Communauté',array(
				array('Arena','Game','Arène'),
				array('Private_Message','User','Messagerie('.count_message().')'),
				array('Chat','User','Chat'),
				array('Main','Forum','Forum'),
			));
				
			html_menu('jeu',array(
				array('Logout','User','Déconnexion'),
			));
		}
	}
	
	function call_menu_modo()
	{
		global $secteur_module ;
		
		if (verif_access("Modo",true) && $secteur_module === 'Moderator')//Si le Access est Admin, afficher le menu de l'admin
		{
			html_menu('jeu',array(
				array('Character','Game','Retour'),
			));
			
			html_menu('Punitions',array(
				array('Sanctions','Moderator','Sanctions'),
        		array('Warnings','Moderator','Avertissements'),
			));
			
			html_menu('Forum',array(
				array('topics','Moderator','Topic'),
        		array('posts','Moderator','posts'),
			));
		}
	}
	
	function call_menu_admin()
	{
		global $secteur_module ;
		
		if(verif_access("Admin",true) && $secteur_module === 'Admin')//Si le Access est Admin, afficher le menu de l'admin
		{
			html_menu('jeu',array(
				array('Character','Game','Retour'),
			));
			
		    html_menu('Administration',array(
				array('Configuration','Admin','Configuration'),
				array('Bdd','Admin','base de données'),
				array('Pages','Admin','Pages'),
				array('Plugins','Admin','Plugins'),
			));
			
		    html_menu('Actualités',array(
				array('News','Admin','News'),
				array('Comments','Admin','Commentaires'),
				//array('Comments','Admin','Newsletters'),
			));
			
		      html_menu('Communauté',array(
			 
				array('Accounts','Admin','Comptes'),
				array('Guilds','Admin','Guildes'),
				array('Orders','Admin','Ordres'),
				array('Classes','Admin','Classes'),
				array('Races','Admin','Races'),
				array('Works','Admin','Metiers'),
				
			));
			
			html_menu('Géographie',array(
			
				array('Towns','Admin','Villes'),
				array('Landing','Admin','Terrains'),
			
			));
			
			html_menu('Récit',array(
				array('Chapters','Admin','Chapitres'),
				array('Missions','Admin','Missions'),
				array('Quests','Admin','Quetes'),
			));
			
		    html_menu('Catalogue',array(
				array('Fragments','Admin','Fragments'),
				array('Equipment','Admin','Equipements'),
				array('Items','Admin','Objets'),
				array('Parchments','Admin','Parchemins'),
			));
			
		    html_menu('Talents',array(
				array('Levels','Admin','Niveaux'),
				array('Caracteristiques','Admin','Caractéristiques'),
				array('Magics','Admin','Magies'),
			));
			
		    html_menu('Bestiaire',array(
				array('Invocations','Admin','Chimères'),
				array('Monsters','Admin','Monstres'),
			));
			
		    html_menu('Forum',array(
			
				array('Categories','Admin','categories'),
				array('Forums','Admin','forums'),
				array('Topics','Admin','topics'),
				array('Posts','Admin','posts'),
			));
			
		    html_menu('Design',array(
				array('Design','Admin','design'),
				array('Images','Admin','images'),
			));
        }
	}