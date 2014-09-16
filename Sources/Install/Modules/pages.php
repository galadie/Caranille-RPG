<?php


function videos()
{
	global $secteur, $page ;
	if( $page =='videos')//(request_confirm('videos')  )$secteur ==='install' &&
	{
?>
		<div class="city-menu">
			<a href="<?php echo get_link('videos','Install',array('video' => 'playlist' ) ) ?>">playlist</a>
			<a href="<?php echo get_link('videos','Install',array('video' => 'installation' ) ) ?>">installation</a>
			<a href="<?php echo get_link('videos','Install',array('video' => 'traduction' ) ) ?>">traduction</a>
			<a href="<?php echo get_link('videos','Install',array('video' => 'debugger' ) ) ?>">debugger</a>
		</div>
<?php
		if(request_confirm('video') )
		{
?>			
			<?php if(request_get('video') == 'playlist') { ?>
			
				<iframe width="560" height="315" src="//www.youtube.com/embed/videoseries?list=PLdL4JZetrfVdd7s_ZYtCL3Z52C0xDECC-" frameborder="0" allowfullscreen></iframe>
				
			<?php }	?>
			
			<?php if(request_get('video') == 'installation') { ?>

				<iframe width="420" height="315" src="//www.youtube.com/embed/ILue3xKp5tU" frameborder="0" allowfullscreen></iframe>
				
			<?php }	?>
			
			<?php if(request_get('video') == 'traduction') { ?>

				<iframe width="560" height="315" src="//www.youtube.com/embed/JOyzN8LB18A" frameborder="0" allowfullscreen></iframe>
				
			<?php }	?>
			
			<?php if(request_get('video') == 'debugger') { ?>
			
				<iframe width="420" height="315" src="//www.youtube.com/embed/sSzWcrh957k" frameborder="0" allowfullscreen></iframe>
				
			<?php }	?>
<?php
		}
		
	}
}

function propos()
{
	global $secteur, $page ;
	
	if( $page =='propos')//(request_confirm('propos')  )$secteur ==='install' &&
	{
?>
<p>Voici un projet qui me tient à cœur et que j'ai commencé il y a de cela presque 3 ans : ce projet se nomme Caranille.</p>
<p>Conçu et developpé par des passonniés du MMORPG et de la programmation, Caranille Engine 5.0 est un logiciel consacré à la masterisation d'un jeu de role en ligne jouable par navigateur. 
Malgré une grande communauté française de roliste, et une profusion de plateforme de jeu, on s'est aperçu qu'il y avait une forte 
impulsion de créateurs, mais très peu de structures suffisement abouti pour répondre à leur demande.
outils gratuit et libre ,Que votre jeu soit axé PVP ou PVE, vous trouverez de quoi satisfaire vos attentes.
</p>

<?php
	}
}

function contact()
{
	global $secteur, $page ;
	if( $page =='contact')//(request_confirm('contact')  ) ($secteur ==='Install'||$secteur ==='install') &&
	{
?>
	<p>Vous avez une idée, une suggestion voir même une question ?</p>
	<p>N'hésitez-pas écrivez moi à :<br /><a href="mailto:jeremy@caranille.com">jeremy@caranille.com</a></p>
	<p>Vous aurez une réponse dans les 24 heures suivants votre demande.</p>
	<p>Vous pouvez aussi contacter<br />
	- notre référant technique à: <a href="mailto:dimitri@caranille.com">dimitri@caranille.com</a><br />
	- notre bêta-testeur à : <a href="mailto:pilou123@caranille.com">pilou123@caranille.com</a></p>
	<p>Nous sommes prêts à accueillir de nouveaux membres motivés et impliqués. Tout profil peut etre benefique au projet.<br/>si vous êtes interressé, n'hesitez pas</p>
<?php
	}
}

function faq()
{
	global $secteur, $page ;
	if( $page =='faq')//(request_confirm('faq')  ) ($secteur ==='Install'||$secteur ==='install') &&
	{
?>
	<p>
<strong>Pourquoi un tel nom ? </strong>
</p>

<ul><li>Caranille est la contraction de Caramel et Vanille qui sont deux animaux que j'ai perdus il y a longtemps 
mais que j'ai énormément adorés.</li>
</ul>

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
	global $secteur, $page , $_url ;
	if( $page =='mentions')//(request_confirm('mentions')  ) ($secteur ==='Install'||$secteur ==='install') &&
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
        <?php echo init_popIn('licence',"lire la licence",'<iframe id="licence" src="'.$_url.'LICENCE.txt"></iframe>','licence-link')?><br /><br />
</div>
<?php
	}
}

function remerciements()
{
	global $secteur, $page ;
	
	if( $page =='remerciements')// (request_confirm('reglements')  ) ($secteur ==='Install'||$secteur ==='install') &&
	{
?>
		<h1>Remerciements à nos contributeurs</h1>
		<p>
			Merci à nos membres contributeurs pour leur participations impliquée et désinteressé. 
			<ul>
				<li>Doctor Tee</li>
				<li>Drash</li>
				<li>Pilou123</li>
			</ul>
			et pour tous les autres, pour leurs motivations et leur soutiens sans limites...
		</p>
<?php	
	}
}

function nouveautes()
{
	global $secteur, $page ;
	
	if( $page =='nouveautes')// (request_confirm('reglements')  ) ($secteur ==='Install'||$secteur ==='install') &&
	{
?>
<div style="text-align:left">

	<h3>DONE_LIST</h3>
	
	Laissé en suspens dans la version précedente et traité
	
	<ul>
		<li>les Modules ont été séparés en 2 répertoires :
			<ul>
				<li>/Modules correspond à l’exécution des commandes et le traitement des données( si besoin...) . il est lancé avant d'afficher le template</li>
				<li>/Views fait uniquement l'affichage de la page HTML</li>
			</ul>
			la nouvelle structure qui suit le MVC et permet de faire des choses beaucoup plus propres mais surtout plus complexe et riche.
		</li>
		<br/>
		<li>Réorganisation des fichier en vue de creation d'une gestion des design..
			<ul>
				<li>dispatch du Kernel( dossier Kernel/ et Core/)- séparation de Kernel/ - traitement - d'avec Core/ - données -</li>
				<li>dispatch de la CSS(répertoires Styles/)=> afin de pouvoir conservé certains arrangement d'un design à l'autre. essentiellement la map et le modele d'equipement du perso( mon bonhomme ocedar).</li>
			</ul>
		</li>
		<br/>
		<li>gestion des pages institutionnelles admin/gestion/institutionnelles => la partie contenue qui tenait sur du code dur a été remplacé par des pages enregistrée en base et editable en admin.</li>
		<li>Amelioration de la fonction get_link(prise en compte de parametres)</li>
		<li>fonction access : prise en compte de la hierarchie admin-modo-membres-visiteur</li>
		<li>Module magasin : poursuite du rassemblement en 1 processus unique...</li>
		<li>Simplification des tableaux en session</li>
		<li>Purge des scripts d'inventaire</li>
	</ul>
	
	<h3>Dev finalisés</h3>
	
	disponible en version stable dans la prochaine editon
	
	<ul>
		<li>barre de deboggage</li>
		<li>systeme de traduction dynamique</li>
		<li>multi-design : admin -> configuration, il y a maintenant un menu déroulant qui liste les sous-répertoires du dossier /Design.<br/> 
			Dans ces dossiers, j'ai déplacé les répertoires /css, /images, /templates et /HTML. <br/>
			le créateur d'un design peut ainsi créer le graphisme mais aussi l'ergonomie dont il a envie.
		</li>
		
		<li>admin : gestion des ordonnancement => dans la liste des enregistrements pour les pages (mission, quêtes, chapitres et pages), s'ajoute automatiquement des colonnes avec des bouttons fleches pour remonter ou descendre la position de l'enregistrement. </li>
		<li>editeur WYSIWYG pour l'admin</li>
		<br/>

		<li>module Profil utilisateur /jeu/profil/modifier son profil
			<ul>
				<li>possibilité de saisir une signature pour le forum</li>
				<li>possibilité de télécharger un avatar( voir plus bas la gestion des images)</li>
				<li>possibilité de consulter les profils à partir des post du forum/page de joueur/liste de joueur</li>
			</ul>
		</li>
		<br/>
		<li>Rédaction de role-Play à partir des journaux... :<br/>
			une box modal ou vous pouvez saisir un petit commentaire sur votre historique</li>
		<li>sub-division de la fortune en plusieurs monnaie( selon un taux et un nombre de monnaie definissable dans la page configuration</li>
		<br/>
		<li>gestion des images : admin/design/images
			<ul>
				<li>- conversion en chaine de caractères( crypté en base64)</li>
				<li>=> pas de fichiers ni de répertoires images, tout est sauvegardé en base et facilement associables aux restes,
					<br/>( item, ville, monstre, avatar,....)</li>
				<li>=> affichage des images dans la partie public)</li>
				<li>=> saisie et gestions des limites d'image(taille/hauteur/largeur)</li>
			</ul>
		</li>
		<br/>
		<li>Forum de site</li>
		<li>Forum de site - gestion des droits - valeur par defaut</li>
		<li>gestion d'une liste d'amis</li>
		<br/>
		<li>gestion avancées des guildes : jeu/guilde
			<ul>
				<li>forum de guilde</li>
				<li>rangs & privilèges</li>
				<li>calendrier</li>
				<li>organisation d'evenement</li>
				<li>recrutement</li>
			</ul>
		</li>
		<br/>
		<li>type d'arme du personnage(espadon,épée,dague,marteau,arc,disque,baton,sceptre,...)
			<ul>
				<li>gestion separé de la gestion d'equipement</li>
				<li>design specifique</li>
			</ul>
		</li>
		<br/>
		<li>combat de groupe. /jeu/roaster
			<ul>
				<li>- possibilité à l'entré d'une mission,ou d'un chapitre de recruter avec soi des personnages de joueurs,</li>
				<li>=> le joueur n'est pas connecté et il a activé l'option permettant de recruter son perso ( jeu/character)</li>
				<li>=> chaque perso recruté lance une attaque normale en bénéficiant de sa force de niveau et de son bonus perso( choisi à l'inscription...)</li>
				<li>=> pas de bonus d’Équipement, de guilde, d'ordre, autre,...</li>
			</ul>
		</li>
		<br/>
		<li>editeur BBcode
			<ul>		
				<li>le traitrement du BBcode dans le forum et sur les messages privés.</li>
				<li>bouton aperçu du contenu saisi dans l'editeur BBcode</li>
			</ul>
		</li>
		<br/>
		<li>Inscription : module independant
		    <ul>
        		<li>choix de l'ordre à l'inscription. => si le joueur échappe à cette étape, il a toujours la possibilité de rejoindre un ordre en cours de jeu</li>
        		<li>classe de personnage</li>
        		<li>Race de personnage</li>
				<li>sexe du personnage</li>
		    </ul>
		</li>
		<br/>
		<li>systeme de metier pour la fabrication d'objet
			<ul>
			    <li>exp de metier</li>
				<li>liaison à un metier de recolte</li>
				<li>recoltes de ressources( rubrique ressources dans inventaire)</li>
			</ul>
		</li>

	</ul>

</div>
<?php
	}
}

function avenir()
{
	global $secteur, $page ;
	
	if( $page =='avenir')// (request_confirm('reglements')  ) ($secteur ==='Install'||$secteur ==='install') &&
	{
?>
<div style="text-align:left">

	<h3>TODO-LIST</h3>
	
	Laissé en suspens dans la version précedente et pas encore traité
	
	<ul>
		<li>Purge des scripts de combat</li>
	</ul>
	
	introduit avec la nouvelle version, mais pas finalisé
	
	<ul>
		<li>centralisation des requetes "select" en 1 seul fichier</li>
		<li>Placer toutes les mentions des repertoires "Sources/" en contenus éditables.</li>	
		<li>Securisation systématique des formulaires par la mise en fonction</li>
	</ul>
	
	
	<h3>Dev en cours</h3>
	
	disponible en version ALPHA dans la prochaine editon
	
	<ul>
		<li>systeme de metier pour la fabrication d'objet
			<ul>
				<li>combinaison des fragments en objet</li>
			</ul>
		</li>
		<li>gestion avancées des guildes : jeu/guilde
			<ul>
				<li>animation & gestion</li>
				<li>chatroom privé</li>
			</ul>
		</li>
	</ul>	
	
	<h3 id="toc_0">A venir</h3>
	
	dev non finalisé pour presentation
	
	<ul>
		<li>systeme de metier pour la fabrication d'objet
			<ul>
			    <li>niveau de metier</li>
				<li>conversion des ressources en fragments => liaison à un metier de transformation</li>
				<li>combinaison des fragment en objet => liaison à un metier d'assemblage</li>
			</ul>
		</li>
		<li>Role(Healer,Tank,DD)</li>
		<li>niveau armure (en tissus, légere, moyenne, lourde, massive) associé au role</li>
		<li>type arme associé au role</li>
		<li>un système multilingue dynamique (un système de fichiers de langues étant déjà present, mais seulement en langue FR).</li>
		<li>redimension automatique des images</li>
		<li>la fonction "vendre" dans l'inventaire deviendra "mettre à l’hôtel des ventes" et "jeter"
			<ul>
				<li>l’hôtel des ventes où les joueurs pourraient s’échanger les items.</li>
				<li>jeter permettant de se débarrasser d'un items sans espoir de toucher de l'argent ou de le récuperer.</li>
			</ul>
		</li>
		<li>executeur de cmd Shell</li>
	</ul>
	
	<h3 id="toc_0">En pause</h3>
	
	dev interrompu pour approfondir la reflexion
	
	<ul>	
		<li>Design : systeme de jeu "all-in-one-page"</li>
		<li>caractéristiques(force,Magie,Defense,Agilité,...) des personnages administrables</li>
		<li>Plugins</li>
		<li>code cadeaux</li>
		<li>gestion du fichier constants.php</li>
	</ul>
	
	<h3 id="toc_0">Concept</h3>
	
	idées mise en attente d'un avancement plus consequent sur les autres etapes
	
	<ul>
		<li>Purge des scripts de carte</li>
		<li>monture</li> 
		<li>pnj</li>
		<li>pouvoir/compétence de terraformation</Li>
		<li>ressource recolttable en fonction du terrain<li>
		<li>peon (assure le crafting à la place du joueur)</li>
		<li>pets (Animaux de compagnie): besoin d'équipement et en contrepartie aident pendant les combats</li>
		<li>race exclusive(ou non) à un ordre</li>
		<li>classe exclusive(ou non) à un ordre</li>
		<li>jeu bi-factions/tri-factions</li>
		<li>admin "one-file"</li>
		<li>gestion prefixes des tables</li>
		<li>sauvegarde des données en fichier(serialisation)</li>
	</ul>	
	
	<h3 id="toc_0">En etudes</h3>
	
	idées dont la faisabilité technique est le principale enjeu pour devenir des concepts.
	
	<ul>
		<li>warpzone de farming temporaire : integralement en session,<Br/>
		une carte aléatoire avec des monstre et des objets.jouable seulement pendant 1 seule et unique session
		</li>
		<li>Duel en temps réel<br/>
		à la maniere du chat, une iframe s'auto-recharge et affiche le droulement du combat-> le joueur dont le tour est disponible<br/>
		chaque joueur associé au combat a un formulaire de d'action en bas de page(attaquer - magie - objet - invocations -fuir)<br/>
		chaque tour genere un token associé. le 1Er joueur qui a le token joue puis ferme son tour<br/>
		transmettant le token au joueur suivant.<br/> 
		si un joeur tente de jouer sans avoir le token, son formulaire est invalidé<br/>
		possibilité d'avoir plus de 2 joueur par combat...'
		</li>
		<li>mission et chapitre en groupe et en temps réels :<br/>
		meme principe que precedement,<br/>
		mais 1 seule cible : le monstre en face des joeur</li>
		<li>Maison & housing : <br/> </li>
		<li>Succes</li>
		<li>fonction de guilde
			<ul>
				<li>forteresse de guilde</li>
				<li>capitale d'ordre...</li>
				<li>=> prise de forteresse</li>
				<li>=> destruction d'ordre/guilde</li>
			</ul>
		</li>
	</ul>
	
</div>
<?php
	}
}

function download()
{
	global $secteur, $page ;
	
	if( $page =='download')// (request_confirm('reglements')  ) ($secteur ==='Install'||$secteur ==='install') &&
	{	
		$version = request_get('version');

		print_r($_GET);
		
		$zipname = "http://www.caranille.fr/caranille159/Caranille_".$version.".zip";
		
		echo $zipname ;
		
		$AgetHeaders = @get_headers($zipname);
		print_r($AgetHeaders);
		if (preg_match("|200|", $AgetHeaders[0])) 
		{
			// file exists
			echo "file_exists..";
			
			if ($handle = fopen($zipname, 'r'))
			{
				echo "download...";
				header('Content-Type: application/zip');
				header('Content-disposition: attachment; filename=Caranille-'.$version.'.zip');
				header('Content-Length: ' . filesize($zipname));
				
				while(!feof($handle)) 
				{
					echo fread($handle, 4096);
					flush();
				}
				fclose ($handle);
			}
		}
		die();
	}
}

function version()
{
	global $secteur, $page ;
	
	if( $page =='version')// (request_confirm('reglements')  ) ($secteur ==='Install'||$secteur ==='install') &&
	{
		?>
		<ul style="text-align:left" >
			<li>Caranille 4.5<ul>
					<li><a href="<?php echo get_link('download','Install').'&version=4_5_1' ?>">4.5.1</a></li>
					<li><a href="http://www.caranille.fr/caranille159/Caranille_4_5_2.zip">4.5.2</a></li>
					<li><a href="http://www.caranille.fr/caranille159/Caranille_4_5_3.zip">4.5.3</a></li>
					<li><a href="http://www.caranille.fr/caranille159/Caranille_4_5_4.zip">4.5.4</a></li>
				</ul>
			</li>
			<li><a href="http://www.caranille.fr/caranille159/Caranille_4_6_0.zip">4.6.0</a></li>
			<li><a href="http://www.caranille.fr/caranille159/Caranille_4_7_0.zip">4.7.0</a></li>
			<li><a href="http://www.caranille.fr/caranille159/Caranille_5_0_ALPHA_01.zip">5.0 ALPHA 01</a></li>
		</ul>
		<?php
	}
}

function reglements()
{
	global $secteur, $page ;
	
	if( $page =='reglements')// (request_confirm('reglements')  ) //($secteur ==='Install'||$secteur ==='install') &&
	{
	
?>
<div>
	<h3 id="toc_0">Possibilités</h3>
	
	<p>Pour vous présenter Caranille sachez que c'est un logiciel/programme/script qui a pour but de vous aider à bâtir rapidement et gratuitement votre propre MMORPG ( <em>massively multiplayer online role-playing game</em>, c'est-à-dire  jeu de rôle en ligne massivement multijoueur) pour votre site web personnel, pour une animation ou autres&#8230; Étant une personne qui utilise uniquement GNU/Linux et appréciant sa façon d'être (à savoir le partage des sources), j'ai décidé de mettre Caranille sous licence GNU GPL, ce qui permettra aux utilisateurs avancés de le modifier, de rajouter des modules et de les redistribuer selon la licence Creative Commons.</p>

<p>webmastering</p>
<ul>
	<li>edition du contenu</li>
	<li>selecteur de design</li>
	<li>mise à jour automatisé de la base de données</li>
	<li>securisation des insertions utilisateurs</li>
</ul>
<p>Fonctionnalités JdR :</p>

<ul><li>une histoire principale pour votre jeu</li>
<li>plusieurs villes (qui peuvent être débloquées en fonction de l'avancée dans l'histoire)</li>
<li>des missions propre à chaque ville</li>
<li>des monstres et de choisir les objets qui pourront être gagnés lors de la victoire du joueur</li>
<li>des objets (armes, protection, objets de soin comme des potions etc.)</li>
<li>des chimères à invoquer lors des combats</li>

</ul>


<p>Fonctionnalités MMORPG :</p>

<ul><li>faire du PVP (Player Versus Player)</li>
<li>fonder sa propre guilde</li>
<li>preter serment à un ordre ( univers bi-faction )</li>
<li>discuter en direct avec tous les autres joueurs</li>
</ul>

<p>De plus pour les habitués des grands JdR de Square Enix (ou anciennement SquareSoft) le menu de combat est présenté de la même façon à savoir :</p>

<ul><li>Attaquer (porter une attaque physique)</li>
<li>Magie (lancer un sort sur ennemi)</li>
<li>Invocation (invoquer une puissante chimère)</li>
<li>Objets (utiliser un objet comme une potion)</li>
<li>Fuir (trop faible face à l&#8217;ennemi ? Fuyiez)</li>
<li>combat en groupe (rassembler des joueurs pour mener de grandes rixe)</li>
</ul>


<h3 id="toc_1">Avantages</h3>

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

function configuration()
{
	global $secteur, $page , $php_recommended_settings, $_path ;
					
	if( $page =='configuration')// (request_confirm('reglements')  ) //($secteur ==='Install'||$secteur ==='install') &&
	{
			foreach ($php_recommended_settings as $l => $phprec) 
				$setting[$l] = get_php_setting($phprec[1]) ;
					    
		$sp 		= ini_get( 'session.save_path' );
?>
<div id="ctr" align="center">
  <div class="install">
    <div class="Conteneur">
    
 <h1>Condition minimale requise:</h1>
    <ul style='text-align:left'>
<li>Serveur HTTP (Apache 2.x)</li>
<li>PHP (5.2.X)</li>
<li>Mysql (5.5) - (Caranille fonctionne aussi avec PostgreSQL et la base de donnée Oracle)</li>
</ul>
    
      <h1> Permissions des répertoires: </h1>
      <div class="install-text">
        <p> Certains répertoires doivent être accessibles en lecture et écriture. </p>
        <p> Si certains des répertoires listés co-contre sont dans l'état "Non modifiable", alors vous devrez changer les CHMOD pour les rendre "Modifiables". </p>
        <div class="clr">&nbsp;&nbsp;</div>
        <div class="ctr"></div>
      </div>
      <div class="install-form">
        <div class="form-block">
          <table class="content">
            <?php
						writableCell( '' );
						writableCell( 'Logs' );
						writableCell( 'Design' );
						//writableCell( 'configuration' );
						writableCell( 'Scripts' );
						writableCell( 'Styles' );
					//	writableCell( 'tmp' );
						//writableCell( 'modules' );
						//writableCell( 'templates' );
			?>
          </table>
        </div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
      <h1> Vérification des paramètres nécessaires: </h1>
      <div class="install-text"> 
        <p> Si certains éléments sont écrits en rouge, alors veuillez prendre les mesures nécessaires pour les corriger. </p>
        <div class="ctr"></div>
      </div>
      <div class="install-form">
        <div class="form-block">
          <table class="content">
            <tr>
              <td class="item"> PHP version >= 5 </td>
              <td align="left"><?php echo phpversion() < '5' ? '<b><font color="red">Non</font></b>' : '<b><font color="green">Oui</font></b>';?> </td>
            </tr>
            <tr>
              <td>Compression ZLIB </td>
              <td align="left"><?php echo extension_loaded('zlib') ? '<b><font color="green">Oui</font></b>' : '<b><font color="red">Non</font></b>';?> </td>
            </tr>
            <tr>
              <td>Support XML </td>
              <td align="left"><?php echo extension_loaded('xml') ? '<b><font color="green">Oui</font></b>' : '<b><font color="red">Non</font></b>';?> </td>
            </tr>
            <tr>
              <td>Support MySQL </td>
              <td align="left"><?php echo function_exists( 'mysql_connect' ) ? '<b><font color="green">Oui</font></b>' : '<b><font color="red">Non</font></b>';?> </td>
            </tr>
            <tr>
              <td valign="top" class="item"> Config.php </td>
              <td align="left"><?php
						if (@file_exists( $_path.'Config.php' ) &&  @is_writable( $_path.'Config.php' ))
						{
							echo '<b><font color="green">Modifiable</font></b>';
						}
						elseif (is_writable(  $_path ))
						{
							echo '<b><font color="green">Modifiable</font></b>';
						}
						else
						{
							echo '<b><font color="red">Non modifiable</font></b>';
							echo "<br /><span class='small'>Vous pouvez poursuivre l'installation, vous devrez toutefois copier et coller les données de configuration affichées à la fin de l'installation dans un fichier Config.php, que vous devrez ensuite uploader.</span>";
						}
						?>
              </td>
            </tr>
            
            <tr>
              <td class="item"> Session save path </td>
              <td align="left" valign="top"><?php echo is_writable( $sp ) ? '<b><font color="green">Modifiable</font></b>' : '<b><font color="red">Non modifiable</font></b>';?> </td>
            </tr>
            <tr>
              <td class="item" colspan="2"><b> <?php echo $sp ? $sp : 'Not set'; ?> </b> </td>
            </tr>
        </table>
        </div>
      </div>
      <div class="clr"></div>
      <?php
				$wrongSettingsTexts = array();
				
				if ( ini_get('magic_quotes_gpc') == '1' ) 
					$wrongSettingsTexts[] = 'Paramètre PHP magic_quotes_gpc est sur `ON` au lieu de `OFF`';

				if ( ini_get('register_globals') == '1' )
					$wrongSettingsTexts[] = 'Paramètre PHP register_globals est sur `ON` au lieu de `OFF`';

				if ( count($wrongSettingsTexts) ) 
				{
					?>
      <h1> Vérification de la sécurité: </h1>
      <div class="install-text">
        <p> Les paramètres PHP Serveur suivants ne sont pas optimum pour la <strong>Sécurité</strong> de votre site, il vous est recommandé de les modifier: </p>
      </div>
      <div class="install-form">
        <div class="form-block" style=" border: 1px solid #cc0000; background: #ffffcc;">
          <table class="content">
            <tr>
            
            
              <td class="item"><ul style="margin: 0px; padding: 0px; padding-left: 5px; text-align: left; padding-bottom: 0px; list-style: none;">
                  <?php foreach ($wrongSettingsTexts as $txt) { ?>
                  <li style="min-height: 25px; padding-bottom: 5px; padding-left: 25px; color: red; font-weight: bold;" >
                    <?php echo $txt; ?>
                  </li>
                  <?php } ?>
                </ul></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="clr"></div>
      <?php
		}
		?>
      <h1> Configuration recommandée: </h1>
      <div class="install-text">
        <p> Ces paramètres PHP sont recommandés afin d'assurer 
          une pleine compatibilité avec le script. </p>
        <p> Toutefois cela fonctionne correctement s'ils ne sont pas activés. <br />
        </p>
        <div class="ctr"></div>
      </div>
      <div class="install-form">
        <div class="form-block">
          <table class="content">
            <tr>
              <td class="toggle" width="500px"> Directive </td>
              <td class="toggle"> Recommandé </td>
              <td class="toggle"> Actuel </td>
            </tr>
              

                       <?php foreach ($php_recommended_settings as $l => $phprec) { ?>
            <tr>
            
              <td class="item"><?php echo $phprec[0]; ?></td>
              <td class="toggle"><font color="blue"><?php echo $phprec[2]; ?></font></td>
              <td>
                <strong>
          <font color="<?php echo ( $setting[$l] == $phprec[2] ? "green" : "red") ?>"><?php echo $setting[$l] ; ?></font> 
                </strong>
              </td>
            </tr>
            <?php } ?>
            
                        <tr>
              <td>Réécriture URL </td>
               <td class="toggle"><font color="blue">ON</font></td>
              <td align="left"><?php echo (function_exists('apache_get_modules') && in_array('mod_rewrite',apache_get_modules())) ? '<b><font color="green">ON</font></b>' : '<b><font color="red">OFF</font></b>';?> </td>
            </tr>
            
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
	}
}

function writableCell( $folder ) 
{
    global $_path ;
    
	$writeable 		= '<strong><font color="green">Modifiable</font></strong>';
	$unwriteable 	= '<strong><font color="red">Non-modifiable</font></strong>';
	$unknow 	= '<strong><font color="orange">Non-reconnu</font></strong>';

	echo '<tr>';
	echo '<td class="item">' .  $folder . '/</td>';
	echo '<td align="right">';
	echo is_dir( $_path.$folder) ? ( is_writable( $_path.$folder ) 	? $writeable : $unwriteable) : $unknow ;
	echo '</td>';
	echo '</tr>';
}

function get_php_setting($val) 
{
	return  (ini_get($val) == '1' ? 'ON' : 'OFF' );
}
