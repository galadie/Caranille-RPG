<?php
function news_read()
{
	global $_path ;
	
	return unserialize(file_get_contents($_path.'news.txt'));
}

function news_write($news)
{
	global $_path ;

	file_put_contents($_path.'news.txt', serialize($news));
}

function news_date($News)
{
	 $date = new DateTime($News['date']);
	 
	 return $date->format("d/m/Y à H:i");
}

function news_message($News)
{
	return stripslashes(nl2br($News['contenu']));
}

	function news_details_form($id)
	{
		if(isset($_SESSION['admin']) && $_SESSION['admin'] === true )
		{	
			return '		
			<i>
			<a href="'.get_link("news_remove",'Install').'&id='.$id.'" onclick="return confirm(\'Etes-vous s&ucirc;r de vouloir supprimer cette news ?\');">Supprimer</a>
					&nbsp;
					<a href="'.get_link("news_edit",'Install').'&id='.$id.'">Editer</a></i>
					<br /><br />
			' ;	
		}
	}


function news()
{
	global $secteur, $page , $_path ;
	
	if( $page =='news')// (request_confirm('reglements')  ) //($secteur ==='Install'||$secteur ==='install') &&
	{	
		$liste_news = news_read();
		if(!empty($liste_news)) {
				 echo '<table class="newsboard" >';
			foreach($liste_news as $id => $news) {
				$News = array_map('htmlspecialchars', $news);
				

	    // update by Dimitri
	 if(isset($_SESSION['admin']) && $_SESSION['admin'] === true )
	{   
		echo '<tr>';
		echo '<th>';
		echo LanguageValidation::iMsg("intro.news.record", news_date($News), $News['auteur']);//"News publiée le " .. " Par " .. "";
		echo '</th>';
		echo '</tr>';
	}
		echo '<tr>';
		echo '<td>';
		echo '<h4>' .$News['titre']. '</h4>';
		echo '' .news_message($News). '';
		echo '</td>';
		echo '</tr>';
		
        echo '<tr>' ;
		echo '<td>'.news_details_form($id).'</td>';
		echo '</tr>' ;
			
		//none affiche un espace vide entre les news
		echo '<tr><td class="none" ></td></tr>';
			}
	echo '</table>';	
		}
		else 
		{
			echo 'Il n\'y a aucune news pour le moment<br />';
		}
		echo '<a href="'.get_link("news_add",'Install').'">Ajouter une news</a>';
	}
}

function news_remove()
{
	global $secteur, $page ;
	
	if( $page =='news_remove')// (request_confirm('reglements')  ) //($secteur ==='Install'||$secteur ==='install') &&
	{
		if(isset($_SESSION['admin']) && $_SESSION['admin'] === true )
		{
			//Si l'id passé en paramètre dans l'url n'existe pas, c'est que le visiteur a été amenené ici par hasard
			if(!request_confirm('id')) {
				//Donc on redirige vers index.php
				header('location:'.get_link('news','Install'));
				//Puis on stoppe l'exécution du script
				exit();
			}
			//On récupère l'array des news
			$news = news_read();
			//Puis l'id passé en paramètre
			$id = intval($_GET['id']);

			//Si la news existe
			if(isset($news[$id])) {
				//On efface l'index correspondant à l'id de la news
				unset($news[$id]);
				
				//Puis on sauvegarde le tout
				news_write($news);

			}
			
			header('location:'.get_link('news','Install'));
		}
	}
}

function news_create()
{
	global $secteur, $page , $_path;
	
	if( $page =='news_add')// (request_confirm('reglements')  ) //($secteur ==='Install'||$secteur ==='install') &&
	{
		if(isset($_SESSION['admin']) && $_SESSION['admin'] === true )
		{
			if(request_confirm('titre') && request_confirm('contenu') && request_confirm('pseudo')) 
			{
					//On définit les variables
				$titre = $_POST['titre'];
				$contenu = $_POST['contenu'];
				$pseudo = $_POST['pseudo'];

				//Puis on récupère les news qui existent déjà, et on stocke le tout dans $news
				$news = news_read();
				//On ajoute les données de la news à la suite de l'array
				$news[] = array_merge($_POST,array('date' => date('Y-m-d H:i:s')));//('titre' => $titre, 'auteur' => $pseudo, 'contenu' => $contenu);
				
				//Et pour finir, on enregistre le tout
				news_write($news);
				//echo 'La news a bien été ajoutée !';
				header('location:'.get_link('news','Install'));
				
			} 
		}
	}
}

function news_add()
{
	global $secteur, $page ;
	
	if( $page =='news_add')// (request_confirm('reglements')  ) //($secteur ==='Install'||$secteur ==='install') &&
	{
		if(isset($_SESSION['admin']) && $_SESSION['admin'] === true )
		{
			?>
				<form action="" method="post">
				<label for="pseudo">Votre pseudo :</label> <input type="text" name="pseudo" id="pseudo" /><br />
				<label for="titre">Titre de la news :</label> <input type="text" name="titre" id="titre" /><br />
				<label for="contenu">Contenu de la news :</label> <br />
				<textarea name="contenu" id="contenu" rows="20" cols="60"></textarea><br />
					 <input type="submit" value="Ajouter la news" />
				</form>
			<?php
		}
	}
}

function news_update()
{
	global $secteur, $page , $_path , $newsAmodifier ;
	
	if( $page =='news_edit')// (request_confirm('reglements')  ) //($secteur ==='Install'||$secteur ==='install') &&
	{
		if(isset($_SESSION['admin']) && $_SESSION['admin'] === true )
		{
			//Si l'id passé en paramètre dans l'url n'existe pas, c'est que le visiteur a été amenené ici par hasard
			if(!request_confirm('id')) {
				//Donc on redirige vers index.php
				header('location:'.get_link('news','Install'));
				//Puis on stoppe l'exécution du script
				exit();
			}
			//On récupère l'array des news
			$news = news_read() ;
			$newsAmodifier = (int) $_GET['id'];

			//Si le formulaire a été soumis
			if(request_confirm('titre') && request_confirm('contenu')) {
				//On modifie les infos de la news
				//$news[$newsAmodifier]['titre'] = $_POST['titre'];
				//$news[$newsAmodifier]['contenu'] = $_POST['contenu'];
				$news[$newsAmodifier] = $_POST ;//array_merge(,array('date' => date('Y-m-d H:i:s')));//
				//Puis on sauvegarde le tout
				news_write($news);
				header('location:'.get_link('news','Install'));
			} 
		}
	}
}

function news_edit()
{ //Sinon, on affiche le formulaire d'édition
	global $secteur, $page , $newsAmodifier;
	
	if( $page =='news_edit')// (request_confirm('reglements')  ) //($secteur ==='Install'||$secteur ==='install') &&
	{
		if(isset($_SESSION['admin']) && $_SESSION['admin'] === true )
		{
?>
	<form action="" method="POST">
	Auteur : <strong><?php echo $news[$newsAmodifier]['auteur'] ?></strong><br />
	<label for="titre">Titre de la news :</label> <input type="text" name="titre" id="titre" value="<?php echo $news[$newsAmodifier]['titre'] ?>" ><br />
	<label for="contenu">Contenu de la news : </label><br />
	<textarea name="contenu" id="contenu" rows="20" cols="60"><?php echo $news[$newsAmodifier]['contenu'] ?></textarea><br />
		<input type="submit" value="Appliquer les modifications" />
	</form>
	<?php
		}
	}
}

	if( $page =='news_add')// (request_confirm('reglements')  ) //($secteur ==='Install'||$secteur ==='install') &&
	{
		news_create() ;
	}
	if( $page =='news_edit')// (request_confirm('reglements')  ) //($secteur ==='Install'||$secteur ==='install') &&
	{
		news_update() ;
	}