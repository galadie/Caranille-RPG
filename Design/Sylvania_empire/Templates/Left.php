<ul class="nav" id="menu" >	
<?php if(verif_access("Admin",true) && $secteur_module === 'Admin'){ ?>
        	<li><a href="<?php echo get_link('Character','Game') ?>"><span>Retour au jeu</span></a></li>
		    <li><a href="<?php echo get_link('Configuration','Admin') ?>"><span>Administration</span></a></li>
		    <li><a href="<?php echo get_link('Accounts','Admin') ?>"><span>Communauté</span></a></li>
			<li><a href="<?php echo get_link('Orders','Admin') ?>"><span>Univers</span></a></li>
			<li><a href="<?php echo get_link('Chapters','Admin') ?>"><span>Récit</span></a></li>
		    <li><a href="<?php echo get_link('Equipment','Admin') ?>"><span>Catalogue</span></a></li>
		    <li><a href="<?php echo get_link('Levels','Admin') ?>"><span>Talents</span></a></li>
		    <li><a href="<?php echo get_link('Invocations','Admin') ?>"><span>Bestiaire</span></a></li>
		    <li><a href="<?php echo get_link('Categories','Admin') ?>"><span>Forum</span></a></li>
		    <li><a href="<?php echo get_link('Design','Admin') ?>"><span>Design</span></a></li>

<?php
	} 
	elseif (verif_access("Modo",true) && $secteur_module === 'Moderator')////Si le Access est Admin, afficher le menu de l'admin
	{
?>

        	<li><a href="<?php echo get_link('Character','Game') ?>"><span>Retour au jeu</span></a></li>
			<li><a href="<?php echo get_link('Sanctions','Moderator') ?>"><span>sanctions</span></a></li>
			<li><a href="<?php echo get_link('topics','Moderator') ?>"><span>Forum</span></a></li>

<?php 
	}
	else if(verif_connect(true) && ($secteur_module !== 'Admin' && $secteur_module !== 'Moderator')) // fichier Functions.php
	{	
?>
	<li><a href="<?php echo get_link("Main","Public") ?>"><span>Actus</span></a></li>
	<li><a href="<?php echo get_link("Character","Game") ?>"><span>Avatar</span></a></li>
	<li><a href="<?php echo get_link("Guild","Guild") ?>"><span>Guilde</span></a></li>
	<li><a href="<?php echo get_link("Map","Map") ?>"><span>Carte</span></a></li>
	<li><a href="<?php echo get_link("Story","Battle") ?>"><span>Histoire</span></a></li>
	<li><a href="<?php echo get_link("Profil","User") ?>"><span>Profil</span></a></li>
<?php
	}	
	else
	{ 
?>
		<li><a href="<?php echo get_Link('Main','Public')?>"><span>Accueil</a></span></li>
		<li><a href="<?php echo get_Link('Presentation','Public')?>"><span>Présentation</a></span></li>
		<li><a href="<?php echo get_Link('Gallery','Content')?>"><span>Galerie d'images</a></span></li>
		<li><a href="<?php echo get_Link('Members','Register')?>"><span>Espace Joueurs</a></span></li>

<?php } ?>
</ul>