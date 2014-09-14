<?php if(!$installing) { ?>

	<nav>
<?php
/** fonction recursive

    if (verif_access("Admin",true) && $secteur_module === 'Admin')//
		$menus = _menu("Admin","Head");
	elseif (verif_access("Modo",true) && $secteur_module === 'Moderator')//
		$menus = _menu("Moderator","Left");
	elseif(verif_connect(true) && ($secteur_module === 'Game'|| $secteur_module === 'Public')) // fichier Functions.php
		$menus = _menu("Game","Left");
	else
		$menus = _menu("Public","Left");
	
	echo '<ul id="menu" class="admin-menu">';
	echo '<li><a href="'.get_link('Main').'"><div class="important">Retour au MMORPG</div></a></li>';

	foreach($menus as $id => $rub)
	{		
		if($id != "Direct_Links")
		{
			extract($rub);
			
			echo "<li><a href='#'><div class='important'>$Label</div></a>";
			echo "<ul>";
			foreach( $Links as $mention => $lien )
				echo '<li><a href="'.get_link($lien[0],$lien[1]).'">'.$mention.'</a></li>';
			echo "</ul>";
			echo "</li>";
		}
		else
		{
			//print_r($rub);
			foreach( $rub as $mention => $lien )
				echo '<li><a href="'.get_link($lien[0],$lien[1]).'">'.$mention.'</a></li>';
		}
	}
	echo "</ul>";
**/	

if(!function_exists('html_menu'))
{
	function html_menu($title="Menu",$links = array(), $infos ="" )
	{
?>
		<ul>
			<?php foreach($links as $link) { ?>
				<li><a href="<?php echo get_link($link[0],$link[1]) ?>"><?php echo $link[2] ?></a></li>
			<?php }	?>
		</ul>
<?php	
	}
}

	if (verif_access("Admin",true) && $secteur_module === 'Admin')//
	{
?>
<ul id="menu" class="admin-menu">
	<li><a href="<?php echo get_link('Main') ?>"><div class="important">Retour au MMORPG</div></a></li>
	
	<li><a href="<?php echo get_link('Configuration','Admin') ?>"><div class="important">Administration </div></a>
	<?php if(in_array(ucfirst($page),array('Configuration','Bdd','Pages','Plugins'))){ ?>
		<ul>
		    <li><a href="<?php echo get_link('Configuration','Admin') ?>">Configuration</a></li>
		    <li><a href="<?php echo get_link('Bdd','Admin') ?>">base de données</a></li>
			<li><a href="<?php echo get_link('Pages','Admin') ?>">Pages</a></li>
		    <li><a href="<?php echo get_link('Plugins','Admin') ?>">Plugins</a></li>
		</ul>
	<?php } ?>
	</li>
	<li><a href="<?php echo get_link('News','Admin') ?>"><div class="important">News </div></a>
	<?php if(in_array(ucfirst($page),array('News','Comments'))){ ?>
		<ul>
		    <li><a href="<?php echo get_link('News','Admin') ?>">News</a></li>
		    <li><a href="<?php echo get_link('Comments','Admin') ?>">Commentaires</a></li>
		</ul>
	<?php } ?>
	</li>	
	<li><a href="<?php echo get_link('Accounts','Admin') ?>"><div class="important">Communauté </div></a>
	<?php if(in_array(ucfirst($page),array('Classes','Works','Orders','Accounts','Guilds','Races'))){ ?>
		<ul>		
		    <li><a href="<?php echo get_link('Accounts','Admin') ?>">Comptes</a></li>
		    <li><a href="<?php echo get_link('Guilds','Admin') ?>">Guildes</a></li>
		    <li><a href="<?php echo get_link('Races','Admin') ?>">Races</a></li>
		    <li><a href="<?php echo get_link('Works','Admin') ?>">Metiers</a></li>
		    <li><a href="<?php echo get_link('Classes','Admin') ?>">Classes</a></li>
		    <li><a href="<?php echo get_link('Orders','Admin') ?>">Ordres</a></li>
		</ul>
	<?php } ?>
	</li>
	
	<li><a href="<?php echo get_link('Towns','Admin') ?>"><div class="important">Geographie</div></a>
	<?php if(in_array(ucfirst($page),array('Towns','Landing'))){ ?>
		<ul>
		    <li><a href="<?php echo get_link('Towns','Admin') ?>">Villes</a></li>
		    <li><a href="<?php echo get_link('Landing','Admin') ?>">Terrains</a></li>
		</ul>
	<?php } ?>
	</li>
	
	<li><a href="<?php echo get_link('Chapters','Admin') ?>"><div class="important">Recit</div></a>
	<?php if(in_array(ucfirst($page),array('Chapters','Missions','Quests'))){ ?>
		<ul>
			<li><a href="<?php echo get_link('Chapters','Admin') ?>">Chapitres</a></li>
		    <li><a href="<?php echo get_link('Missions','Admin') ?>">Missions</a></li>
		    <li><a href="<?php echo get_link('Quests','Admin') ?>">Quetes</a></li>
		</ul>
	<?php } ?>
	</li>
	<li><a href="<?php echo get_link('Equipment','Admin') ?>"><div class="important">Catalogue</div></a>
	<?php if(in_array(ucfirst($page),array('Fragments','Equipment','Items','Parchments'))){ ?>
		<ul>
		    <li><a href="<?php echo get_link('Fragments','Admin') ?>">Fragments</a></li>
		    <li><a href="<?php echo get_link('Equipment','Admin') ?>">Equipements</a></li>
		    <li><a href="<?php echo get_link('Items','Admin') ?>">Objets</a></li>
		    <li><a href="<?php echo get_link('Parchments','Admin') ?>">Parchemins</a></li>
	    </ul>
	<?php } ?>
	</li>
	
	<li><a href="<?php echo get_link('Levels','Admin') ?>"><div class="important">Talents</div></a>
	<?php if(in_array(ucfirst($page),array('Caracteristiques','Magics','Levels'))){ ?>
		<ul>
		    <li><a href="<?php echo get_link('Levels','Admin') ?>">Niveaux</a></li>
		    <li><a href="<?php echo get_link('Caracteristiques','Admin') ?>">Caractéristiques</a></li>
		    <li><a href="<?php echo get_link('Magics','Admin') ?>">Magies</a></li>
	    </ul>
	<?php } ?>
	</li>
			
	<li><a href="<?php echo get_link('Invocations','Admin') ?>"><div class="important">Bestiaire</div></a>
	<?php if(in_array(ucfirst($page),array('Invocations','Monsters'))){ ?>
		<ul>
		    <li><a href="<?php echo get_link('Invocations','Admin') ?>">Chimères</a></li>
		    <li><a href="<?php echo get_link('Monsters','Admin') ?>">Monstres</a></li>
	    </ul>
	<?php } ?>
	</li>
	
	<li><a href="<?php echo get_link('Categories','Admin') ?>"><div class="important">Forum</div></a>
	<?php if(in_array(ucfirst($page),array('Categories','Forums','Topics','Posts'))){ ?>
		<ul>
		    <li><a href="<?php echo get_link('Categories','Admin') ?>">categories</a></li>
		    <li><a href="<?php echo get_link('Forums','Admin') ?>">forums</a></li>
		    <li><a href="<?php echo get_link('Topics','Admin') ?>">topics</a></li>
		    <li><a href="<?php echo get_link('Posts','Admin') ?>">posts</a></li>
	    </ul>
	<?php } ?>
	</li>
	
	<li><a href="<?php echo get_link('Design','Admin') ?>"><div class="important">Design</div></a>
	<?php if(in_array(ucfirst($page),array('Images','Design'))){ ?>
		<ul>
		    <li><a href="<?php echo get_link('Design','Admin') ?>">design</a></li>
		    <li><a href="<?php echo get_link('Images','Admin') ?>">images</a></li>
	    </ul>
	<?php } ?>
	</li>

</ul>
<?php
	} 
	elseif (verif_access("Modo",true) && $secteur_module === 'Moderator')////Si le Access est Admin, afficher le menu de l'admin
	{
?>
        <ul id="menu" class="admin-menu">
        	<li><a href="<?php echo get_link('Main','Game') ?>"><div class="important">Retour au jeu</div></a></li>
        	<li><a href="#"><div class="important">Jeu</div></a>
        		<ul>
        		    <li><a href="<?php echo get_link('Sanctions','Moderator') ?>">sanctions</a></li>
        		    <li><a href="<?php echo get_link('Warnings','Moderator') ?>">Avertissements</a></li>
        	    </ul>
        	</li>
			<li><a href="#"><div class="important">Forum</div></a>
        		<ul>
        		    <li><a href="<?php echo get_link('topics','Moderator') ?>">Topic</a></li>
        		    <li><a href="<?php echo get_link('posts','Moderator') ?>">posts</a></li>
        	    </ul>
			</li>
        </ul>
		
<?php 
	}
	else if(verif_connect(true) && $secteur_module !== 'Moderator' && $secteur_module !== 'Admin')// && ($secteur_module === 'Game'|| $secteur_module === 'Public' || $secteur_module === 'User')) // fichier Functions.php
	{	
	?>
	    <div class="important">MMORPG</div><br />
		<a href="<?php echo get_Link('Main','Public')?>">L'actualité</a><br />
		<a href="<?php echo get_Link('Story','Battle')?>">L'histoire</a><br />
		<a href="<?php echo get_Link('Map','Map')?>">La carte</a><br />
		<br />
		
		<a href="<?php echo get_Link('Character','Game')?>">Avatar</a><br />
		<a href="<?php echo get_Link('Guild','Guild')?>">Guilde</a><br />
		<br/>
		
		<div class="important">La Communauté</div><br />
		<a href="<?php echo get_Link('Arena','Game')?>">Arène</a><br />
		<a href="<?php echo get_Link('Private_Message','User')?>">Messagerie(<?php echo count_message() ; ?>)</a><br />
		<a href="<?php echo get_Link('Chat','User')?>">Chat</a><br />
		<a href="<?php echo get_Link('Main','Forum')?>">Forum</a><br />
<?php
	}	
	else
	{ 
?>

	<div class="important">MMORPG</div><br />
	<a href="<?php echo get_Link('Main','Public')?>">Accueil</a><br />
	<a href="<?php echo get_Link('Presentation','Public')?>">Présentation</a><br />
	<br />
	<a href="<?php echo get_Link('Gallery','Content')?>">Galerie d'images</a><br />
	<br />

	<div class="important">Espace Joueurs</div><br />
	<a href="<?php echo get_Link('Members','Register')?>">Inscription</a><br />
	<a href="<?php echo get_Link('Login','User')?>">Connexion</a><br />
	<br />
	<div class="important">Informations</div><br />
	<a href="<?php echo get_Link('Password_Renew','User'); ?>">Mot de passe perdu ?</a><br />
	<a href="<?php echo get_Link('Email_Valid','User'); ?>">Renvoyer le mail de validation</a><br />
	<br />
	<a href="<?php echo get_Link('Delete_Account','User')?>">Supprimer mon compte</a><br />
	<br />
	
	<?php count_connect()?>

<?php } ?>
	
	</nav>
	
<?php } ?>