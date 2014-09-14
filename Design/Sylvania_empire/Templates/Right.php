		<div class="sidebar-center">
			<div class="sidebar-top">
				<div class="sidebar">				
				
					<div id="" class="">
							
<ul id="nav2_2" class="nav2">
							
							<?php if(!$installing) { ?>
<?php
    if (verif_access("Admin",true) && $secteur_module === 'Admin')//
	{
?>			
	<?php if(in_array(ucfirst($page),array('Accounts','Guilds','Comments'))){ ?>
	
		<li><a href="<?php echo get_link('Accounts','Admin') ?>">Comptes</a></li>
		<li><a href="<?php echo get_link('Guilds','Admin') ?>">Guildes</a></li>
		<li><a href="<?php echo get_link('Comments','Admin') ?>">Commentaires</a></li>
		
	<?php } ?>
	
	<?php if(in_array(ucfirst($page),array('Configuration','News','Bdd','Pages'))){ ?>
		<li><a href="<?php echo get_link('Configuration','Admin') ?>">Configuration</a></li>
		<li><a href="<?php echo get_link('News','Admin') ?>">News</a></li>
		<li><a href="<?php echo get_link('Bdd','Admin') ?>">base de données</a></li>
		<li><a href="<?php echo get_link('Pages','Admin') ?>">Pages</a></li>
	<?php } ?>

	<?php if(in_array(ucfirst($page),array('Works','Orders','Towns','Races'))){ ?>
		<li><a href="<?php echo get_link('Orders','Admin') ?>">Ordres</a></li>
		<li><a href="<?php echo get_link('Towns','Admin') ?>">Villes</a></li>
		<li><a href="<?php echo get_link('Races','Admin') ?>">Races</a></li>
		<li><a href="<?php echo get_link('Works','Admin') ?>">Metiers</a></li>
	<?php } ?>
	

	<?php if(in_array(ucfirst($page),array('Chapters','Missions','Quests'))){ ?>
		<li><a href="<?php echo get_link('Chapters','Admin') ?>">Chapitres</a></li>
		<li><a href="<?php echo get_link('Missions','Admin') ?>">Missions</a></li>
		<li><a href="<?php echo get_link('Quests','Admin') ?>">Quetes</a></li>
	<?php } ?>
		
	<?php if(in_array(ucfirst($page),array('Equipment','Items','Parchments'))){ ?>
		<li><a href="<?php echo get_link('Equipment','Admin') ?>">Equipements</a></li>
		<li><a href="<?php echo get_link('Items','Admin') ?>">Objets</a></li>
		<li><a href="<?php echo get_link('Parchments','Admin') ?>">Parchemins</a></li>
	<?php } ?>

	<?php if(in_array(ucfirst($page),array('Caracteristiques','Magics','Levels'))){ ?>
		<li><a href="<?php echo get_link('Levels','Admin') ?>">Niveaux</a></li>
		<li><a href="<?php echo get_link('Caracteristiques','Admin') ?>">Caractéristiques</a></li>
		<li><a href="<?php echo get_link('Magics','Admin') ?>">Magies</a></li>
	<?php } ?>	
	
	<?php if(in_array(ucfirst($page),array('Invocations','Monsters'))){ ?>
		<li><a href="<?php echo get_link('Invocations','Admin') ?>">Chimères</a></li>
		<li><a href="<?php echo get_link('Monsters','Admin') ?>">Monstres</a></li>
	<?php } ?>

	<?php if(in_array(ucfirst($page),array('Categories','Forums','Topics','Posts'))){ ?>
		<li><a href="<?php echo get_link('Categories','Admin') ?>">categories</a></li>
		<li><a href="<?php echo get_link('Forums','Admin') ?>">forums</a></li>
		<li><a href="<?php echo get_link('Topics','Admin') ?>">topics</a></li>
		<li><a href="<?php echo get_link('Posts','Admin') ?>">posts</a></li>
	<?php } ?>

	<?php if(in_array(ucfirst($page),array('Images','Design'))){ ?>
		<li><a href="<?php echo get_link('Design','Admin') ?>">design</a></li>
		<li><a href="<?php echo get_link('Images','Admin') ?>">images</a></li>
	<?php } ?>

<?php
	} 
	elseif (verif_access("Modo",true) && $secteur_module === 'Moderator')////Si le Access est Admin, afficher le menu de l'admin
	{
?>
        	<li><a href="<?php echo get_link('index') ?>"><li><span>Retour au jeu</div></a></li>
        	<li><span>Jeu</div></a>
        		    <li><a href="<?php echo get_link('Sanctions','Moderator') ?>">Sanctions</a></li>
        		    <li><a href="<?php echo get_link('Warnings','Moderator') ?>">Avertissements</a></li>
        	</li>
			<li><span>Forum</div></a>
        		    <li><a href="<?php echo get_link('topics','Moderator') ?>">Topic</a></li>
        		    <li><a href="<?php echo get_link('posts','Moderator') ?>">posts</a></li>
			</li>
		
<?php 
	}
	else if(verif_connect(true) && ($secteur_module !== 'Admin' && $secteur_module !== 'Moderator')) // fichier Functions.php
	{	
	?>
	    <li><span>MMORPG</span></li>
		<li><a href="<?php echo get_Link('Main','Public')?>">L'actualité</a></li>
		<li><a href="<?php echo get_Link('Story','Battle')?>">L'histoire</a></li>
		<li><a href="<?php echo get_Link('Map','Map')?>">La carte</a></li>
		
		<li><span>Mon Compte</span></li>
		<li><a href="<?php echo get_Link('Profil','User')?>">Profil</a><br/>
		<li><a href="<?php echo get_Link('Character','Game')?>">Avatar</a></li>
		<li><a href="<?php echo get_Link('Guild','Guild')?>">Guilde</a></li>
		
		<li><span>La Communauté</span></li>
		<li><a href="<?php echo get_Link('Arena','Game')?>">Arène</a></li>
		<li><a href="<?php echo get_Link('Private_Message','User')?>">Messagerie(<?php echo count_message() ; ?>)</a></li>
		<li><a href="<?php echo get_Link('Chat','User')?>">Chat</a></li>
		<li><a href="<?php echo get_Link('Main','Forum')?>">Forum</a></li>
		<br/>
		
		<li><a href="<?php echo get_Link('Logout','User')?>">Déconnexion</a></li>		
	<?php
	}	
	else
	{ 
?>

	<li><span>MMORPG</span></li>
		<li><a href="<?php echo get_Link('Main')?>">Accueil</a></li>
		<li><a href="<?php echo get_Link('Presentation')?>">Présentation</a></li>
	<br />
		<li><a href="<?php echo get_Link('Gallery','Content')?>">Galerie d'images</a></li>
	<br />

	<li><span>Espace Joueurs</span></li>
		<li><a href="<?php echo get_Link('Members','Register')?>">Inscription</a></li>
		<li><a href="<?php echo get_Link('Login','User')?>">Connexion</a></li>
	<li><span>Informations</span></li>
		<li><a href="<?php echo get_Link('Password_Renew','User'); ?>">Mot de passe perdu ?</a></li>
		<li><a href="<?php echo get_Link('Email_Valid','User'); ?>">Renvoyer le mail de validation</a></li>
	<br />
		<li><a href="<?php echo get_Link('Delete_Account','User')?>">Supprimer mon compte</a></li>
	<br />
	
	<?php count_connect()?>

<?php } ?>
		
<?php } ?>
<!--
							<li><span><?php //echo LanguageValidation::iMsg("head.menu.install")?></span></li>	
							
							<li>
								<a href="<?php //echo frameValidation::getUrl('install') ?>">
									<?php //echo LanguageValidation::nMsg('menu.install.config') ?>
								</a>
								<?php //echo LanguageValidation::eMsg('menu.install.config') ?>
							</li>
-->							
</ul>
												
					</div>	
				
				</div>
			</div>
		</div>