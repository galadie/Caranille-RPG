<?php if(!$installing) { ?>

	<nav>
<?php if(verif_access("Admin",true) && $secteur_module === 'Admin'){ ?>
<ul id="menu" class="admin-menu">
	<li><a href="<?php echo get_link('Main') ?>"><div class="important">Retour au MMORPG</div></a></li>
	<li><a href="#"><div class="important">Administration</div></a>
		<ul>
		    <li><a href="<?php echo get_link('Configuration','Admin') ?>">Configuration</a></li>
		    <li><a href="<?php echo get_link('Bdd','Admin') ?>">base de données</a></li>
			<li><a href="<?php echo get_link('Pages','Admin') ?>">Pages</a></li>
		    <li><a href="<?php echo get_link('Plugins','Admin') ?>">Plugins</a></li>
		</ul>
	</li>
	<li><a href="#"><div class="important">News</div></a>
		<ul>
		    <li><a href="<?php echo get_link('News','Admin') ?>">News</a></li>
		    <li><a href="<?php echo get_link('Comments','Admin') ?>">Commentaires</a></li>
		</ul>
	</li>
	<li><a href="#"><div class="important">Communauté</div></a>
		<ul>		
		    <li><a href="<?php echo get_link('Accounts','Admin') ?>">Comptes</a></li>
		    <li><a href="<?php echo get_link('Guilds','Admin') ?>">Guildes</a></li>
		</ul>
	</li>
	<li><a href="#"><div class="important">Univers</div></a>
		<ul>
			<li><a href="<?php echo get_link('Orders','Admin') ?>">Ordres</a></li>
		    <li><a href="<?php echo get_link('Towns','Admin') ?>">Villes</a></li>
		    <li><a href="<?php echo get_link('Races','Admin') ?>">Races</a></li>
		    <li><a href="<?php echo get_link('Works','Admin') ?>">Metiers</a></li>
		    <li><a href="<?php echo get_link('Classes','Admin') ?>">Classes</a></li>
		</ul>
	</li>

	<li><a href="#"><div class="important">Recit</div></a>
		<ul>
			<li><a href="<?php echo get_link('Chapters','Admin') ?>">Chapitres</a></li>
		    <li><a href="<?php echo get_link('Missions','Admin') ?>">Missions</a></li>
		    <li><a href="<?php echo get_link('Quests','Admin') ?>">Quetes</a></li>
		</ul>
	</li>
		
	<li><a href="#"><div class="important">Catalogue</div></a>
		<ul>
		    <li><a href="<?php echo get_link('Equipment','Admin') ?>">Equipements</a></li>
		    <li><a href="<?php echo get_link('Weapons','Admin') ?>">Armes</a></li>
		    <li><a href="<?php echo get_link('Items','Admin') ?>">Objets</a></li>
		    <li><a href="<?php echo get_link('Parchments','Admin') ?>">Parchemins</a></li>
		    <li><a href="<?php echo get_link('Ressources','Admin') ?>">Ressources</a></li>
	    </ul>
	</li>
			
	<li><a href="#"><div class="important">Talents</div></a>
		<ul>
		    <li><a href="<?php echo get_link('Levels','Admin') ?>">Niveaux</a></li>
		    <li><a href="<?php echo get_link('Magics','Admin') ?>">Magies</a></li>
		    <li><a href="<?php echo get_link('Caracteristiques','Admin') ?>">Caractéristiques</a></li>
	    </ul>
	</li>
	
	<li><a href="#"><div class="important">Bestiaire</div></a>
		<ul>
		    <li><a href="<?php echo get_link('Invocations','Admin') ?>">Chimères</a></li>
		    <li><a href="<?php echo get_link('Monsters','Admin') ?>">Monstres</a></li>
	    </ul>
	</li>
	
	<li><a href="#"><div class="important">Forum</div></a>
		<ul>
		    <li><a href="<?php echo get_link('Categories','Admin') ?>">categories</a></li>
		    <li><a href="<?php echo get_link('Forums','Admin') ?>">forums</a></li>
		    <li><a href="<?php echo get_link('Topics','Admin') ?>">topics</a></li>
		    <li><a href="<?php echo get_link('Posts','Admin') ?>">posts</a></li>
	    </ul>
	</li>
	
	<li><a href="#"><div class="important">Design</div></a>
		<ul>
		    <li><a href="<?php echo get_link('Design','Admin') ?>">design</a></li>
		    <li><a href="<?php echo get_link('Images','Admin') ?>">images</a></li>
	    </ul>
	</li>

</ul>
<?php } elseif(verif_access("Modo",true) && $secteur_module === 'Moderator')	{ ?>
        <ul id="menu" class="admin-menu">
        	<li><a href="<?php echo get_link('index') ?>"><div class="important">Retour au jeu</div></a></li>
        	<li><a href="#"><div class="important">Jeu</div></a>
        		<ul>
        		    <li><a href="<?php echo get_link('Sanctions','Moderator') ?>">sanctions</a></li>
        		    <li><a href="<?php echo get_link('Warnings','Moderator') ?>">Avertissements</a></li>
        	    </ul>
        	</li>
			<li><a href="#"><div class="important">Forum</div></a>
        		<ul>
        		    <li><a href="<?php echo get_link('topics','Moderator') ?>">Topic</a></li>
        		    <li><a href="<?php echo get_link('posts','Moderator') ?>">Posts</a></li>
        	    </ul>
			</li>
        </ul>
<?php } elseif($secteur_module === 'Guild' )	{ ?>

		<ul id="menu" class="admin-menu">
        	<li><a href="<?php echo get_link('index') ?>"><div class="important">Retour au jeu</div></a></li>	
			<li><a href='<?php echo get_Link('Guild','Guild') ?>'><?php echo LanguageValidation::nMsg('menu.guild') ?></a><?php echo LanguageValidation::eMsg('menu.guild') ?></li>
			<li><a href='<?php echo get_Link('Gift','Guild') ?>'><?php echo LanguageValidation::nMsg('menu.gift') ?></a><?php echo LanguageValidation::eMsg('menu.gift') ?></li>
		
		<?php if(verif_guild(true))	{ ?>
		
					<!--<li><a href='<?php echo get_Link('Chat','Guild') ?>'><?php echo LanguageValidation::nMsg('menu.chat') ?></a><?php echo LanguageValidation::eMsg('menu.chat') ?></li>-->
			
			<li><a href="#"><div class="important">Administration</div></a>
				<ul>
					<li><a href="<?php echo get_link('Configuration','Guild') ?>">Configuration</a></li>
					<li><a href="<?php echo get_link('Pages','Guild') ?>">Pages</a></li>
					<li><a href='<?php echo get_Link('Calendar','Guild') ?>'><?php echo LanguageValidation::nMsg('menu.calendar') ?></a><?php echo LanguageValidation::eMsg('menu.calendar') ?></li>
					<li><a href='<?php echo get_Link('Membres','Guild') ?>'><?php echo LanguageValidation::nMsg('menu.members') ?></a><?php echo LanguageValidation::eMsg('menu.members') ?></li>

			<?php if(has_guild_acces('rank')) { ?>
					<li><a href='<?php echo get_Link('Rank','Guild') ?>'><?php echo LanguageValidation::nMsg('menu.rank') ?></a><?php echo LanguageValidation::eMsg('menu.rank') ?></li>
			<?php  } ?>	
			
			<?php if(has_guild_acces('recrutement'))  { ?>
					<li><a href='<?php echo get_Link('Recrutement','Guild') ?>'><?php echo LanguageValidation::nMsg('menu.recrutement') ?></a><?php echo LanguageValidation::eMsg('menu.recrutement') ?></li>
			<?php  } ?>					

			<?php if(has_guild_acces('message')) { ?>
					<li><a href='<?php echo get_Link('Message','Guild') ?>'><?php echo LanguageValidation::nMsg('menu.message') ?></a><?php echo LanguageValidation::eMsg('menu.message') ?></li>
			<?php  } ?>	
			
				</ul>
			</li>
			
			<li><a href="#"><div class="important">Forum</div></a>
				<ul>
					<li><a href="<?php echo get_link('Categories','Guild') ?>">categories</a></li>
					<li><a href="<?php echo get_link('Forums','Guild') ?>">forums</a></li>
					<li><a href='<?php echo get_Link('Main','Guild') ?>'><?php echo LanguageValidation::nMsg('menu.forum') ?></a><?php echo LanguageValidation::eMsg('menu.forum') ?></li>
				</ul>
			</li>

			
			
				
			
			
			
			
		<?php  } ?>	

			
		</ul>

<?php } elseif(verif_connect(true) && $secteur_module !== 'Admin' && $secteur_module !== 'Moderator')	{//&& ($secteur_module === 'Battle'|| $secteur_module === 'Guild'|| $secteur_module === 'Game'|| $secteur_module === 'Public'|| $secteur_module === 'Forum' || $secteur_module === 'User')) {	?>

	    <div class="important" >MMORPG</div> <br/>
		<a href="<?php echo get_Link('Main','Public')?>">L'actualité</a><br />
		<a href="<?php echo get_Link('Story','Battle')?>">L'histoire</a><br />
		<a href="<?php echo get_Link('Map','Map')?>">La carte</a><br />
		<br />

		<div class="important">Mon Compte</div><br />
		<a href="<?php echo get_Link('Profil','User')?>">Profil</a><br/>
		<a href="<?php echo get_Link('Character','Game')?>">Mon personnage</a><br />
		<a href="<?php echo get_Link('Inventory','Game')?>">Mon inventaire</a><br />
		<a href="<?php echo get_Link('Order','Game')?>">Mon Ordre</a><br />
		<a href="<?php echo get_Link('Guild','Guild')?>">Ma Guilde</a><br />
		<a href="<?php echo get_Link('Diary','Game')?>">Mon Journal</a><br />
		<br/>
		
		<div class="important">La Communauté</div><br />
		<a href="<?php echo get_Link('Top','User')?>">Top 100</a><br />
		<a href="<?php echo get_Link('Battlegrounds','Battle')?>">Champs de Batailles</a><br />
		<a href="<?php echo get_Link('Mailbox','User')?>">Message privé (<?php echo count_message() ; ?>)</a><br />
		<a href="<?php echo get_Link('Chat','User')?>">Le chat</a><br />
		<a href="<?php echo get_Link('Main','Forum')?>">Forum</a><br />
		<br/>
		
		<a href="<?php echo get_Link('Logout','User')?>">Déconnexion</a><br />		

<?php } else { ?>

	<div class="important">MMORPG</div><br />
	<a href="<?php echo get_Link('Main')?>">Accueil</a><br />
	<a href="<?php echo get_Link('Presentation')?>">Présentation</a><br />
	<br />
	<a href="<?php echo get_Link('Gallery','Content')?>">Galerie d'images</a><br />
	<br />

	<div class="important">Espace Joueurs</div><br />
	<a href="<?php echo get_Link('Members','Register')?>">Inscription</a><br />
	<a href="<?php echo get_Link('Login','User')?>">Connexion</a><br />
	<br />
	<div class="important">Informations</div><br />
	<a href="<?php echo get_Link('Renew','User'); ?>">Mot de passe perdu ?</a><br />
	<a href="<?php echo get_Link('Valid','User'); ?>">Renvoyer le mail de validation</a><br />
	<br />
	<a href="<?php echo get_Link('Delete','User')?>">Supprimer mon compte</a><br />
	<br />
	
	<?php count_connect()?>

<?php } ?>
	
	</nav>
	
<?php } ?>