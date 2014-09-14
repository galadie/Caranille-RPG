<?php 	load_css('forum.css','forum');	

$titre="Poster";
//On récupère la valeur de la variable action
$action = request_confirm('action')? request_get('action'):'';

// Si le Account n'est pas connecté, il est arrivé ici par erreur
//if (user_data('Account_ID')==0) erreur(ERR_IS_CO);

if(request_confirm('t'))
{
	//ici seulement, maintenant qu'on est sur qu'elle existe, on récupère la valeur de la variable t
	$topic = intval(request_get('t'));
		
	$r = "SELECT f.Forum_ID, Auth_Modo
	FROM Caranille_Topics t
	LEFT JOIN Caranille_Forums f ON t.Topic_Forum_ID = f.Forum_ID
	WHERE Topic_ID='$topic' limit 1;";
		
	$query=get_db($r);

	extract(stripslashes_r($query));
	$forum = $Forum_ID;
}
if(request_confirm('f'))
{
    //ici seulement, maintenant qu'on est sur qu'elle existe, on récupère la valeur de la variable f
		$forum = intval(request_get('f'));

	//A partir d'ici, on va compter le nombre de messages
		//pour n'afficher que les 25 premiers
		$r = "SELECT Forum_Name, Auth_View, Auth_Topic,Auth_Annonce FROM Caranille_Forums WHERE Forum_ID = '$forum' limit 1;";
		//$return =  $r ;
		$data=get_db($r);
		extract(stripslashes_r($data));
}
if(request_confirm('p'))
{
		//On récupère la valeur de p
		$post = intval(request_get('p'));
	 
		$r = "SELECT Post_Createur, Post_Time, Post_Topic_ID, Auth_Modo, Forum_ID
		FROM Caranille_Posts p
		LEFT JOIN Caranille_Forums f ON p.Post_Forum_ID = f.Forum_ID
		WHERE Post_ID='$post' limit 1; ";
		
		//$return =  $r ;
		//Ensuite on vérifie que le membre a le droit d'être ici (soit le créateur soit un modo/admin)
		$query=get_db($r);
		
		extract(stripslashes_r($query));

		$topic = $Post_Topic_ID;
		$forum = $Forum_ID;
		$poster = $Post_Createur;
}
?>

<?php 
//print_r($_Post);
extract(stripslashes_r($_Post));
    $temps = date("Y-m-d H:i:s");

switch($action)
{
    case "nouveautopic":{  //Premier cas : nouveau topic
   
		if (empty($message) || empty($titre))
		{
			$return = '<p>Votre message ou votre titre est vide, 
			cliquez <a href="'.get_link('Poster','Forum',array('action'=>'nouveautopic','f'=>$forum)).'">ici</a> pour recommencer</p>';
		}
		else //Si jamais le message n'est pas vide
		{
			if (isset($mess) && $mess==='Annonce')
				verif_Access($Auth_Annonce);
			else
			if (!isset($mess)|| empty($mess))
				$mess = "Message";
				
			//On entre le topic dans la base de donnée en laissant
			//le champ Topic_Last_Post à 0
			$topic = insert_db('Caranille_Topics',array(
			'Topic_Forum_ID'=>$forum, 
			'Topic_Titre'=>$titre, 
			'Topic_Createur'=>user_data('Account_ID'), 
			'Topic_Time'=> $temps,
			'Topic_Vu' => 1 ,
			'Topic_Genre'=> $mess
			));

			//Puis on entre le message
			 $nouveaupost = insert_db('Caranille_Posts',array(
				'Post_Createur'=> user_data('Account_ID'), 
				'Post_Texte'=> $message, 
				'Post_Time'=> $temps, 
				'Post_Topic_ID'=> $topic, 
				'Post_Forum_ID'=> $forum
			));  

			//Et un petit message
			$return = '<p>Votre message a bien été ajouté!<br /><br />Cliquez <a href="'.get_link('Main','Forum').'">ici</a> pour revenir à l index du forum<br />
			Cliquez <a href="'.get_link('Topic','Forum',array('t'=>$topic)).'">ici</a> pour le voir</p>';
		}
    }break; //Houra !
   
    case "repondre":{  //Deuxième cas : répondre
	
		if (empty($message))
		{
			$return = '<p>Votre message est vide, cliquez <a href="'.get_link('poster','Forum',array('action'=>'repondre','t'=>$topic)).'">ici</a> pour recommencer</p>';
		}
		else //Sinon, si le message n'est pas vide
		{

        //On récupère l'id du forum
        $data= get_db("SELECT Topic_Forum_ID, Topic_Post FROM Caranille_Topics WHERE Topic_ID = '$topic' limit 1");
        $forum = $data['Topic_Forum_ID'];

        //Puis on entre le message
		 $nouveaupost = insert_db('Caranille_Posts',array(
			'Post_Createur'=> user_data('Account_ID'), 
			'Post_Texte'=> $message, 
			'Post_Time'=> $temps, 
			'Post_Topic_ID'=> $topic, 
			'Post_Forum_ID'=> $forum
		)); 
		
        //Et un petit message
        $nombreDeMessagesParPage = 15;
        $nbr_Post = $data['Topic_Post']+1;
        $numpage = ceil($nbr_Post / $nombreDeMessagesParPage);
        $return = '<p>Votre message a bien été ajouté!<br /><br />
        Cliquez <a href="'.get_link('Main','Forum').'">ici</a> pour revenir à l index du forum<br />
        Cliquez <a href="'.get_link('Topic','Forum',array('t'=>$topic,'page'=>$numpage)).'#p_'.$nouveaupost.'">ici</a> pour le voir</p>';
		}//Fin du else
   } break;

	case "edit":{ //Si on veut éditer le post
		
		//On récupère la place du message dans le topic (pour le lien)
		$query = get_db("SELECT COUNT(*) AS nbr_Post FROM Caranille_Posts 
		WHERE Post_Topic_ID = '$topic' AND Post_Time < '$Post_Time' limit 1; ");
	   
		extract(stripslashes_r($query));

		if (verif_Access($Auth_Modo,true)|| $Post_Createur === user_data('Account_ID'))
		{			
			update_db('Caranille_Posts',array('Post_Texte'=>$message, 'Post_ID' => $post));
			$nombreDeMessagesParPage = 15;
			$nbr_Post++;
			$numpage = ceil($nbr_Post / $nombreDeMessagesParPage);
			
			$return = '<p>Votre message a bien été édité!<br /><br />
			Cliquez <a href="'.get_link('Main','Forum').'">ici</a> pour revenir à l index du forum<br />
			Cliquez <a href="'.get_link('Topic','Forum',array('t'=>$topic,'page'=>$numpage)).'#p_'.$post.'">ici</a> pour le voir</p>';
		}
	}break;

	case "delete":{ //Si on veut supprimer le post

		//$return =  "aut::".user_data('Account_ID')."==$poster<br/>";
		
		//Ensuite on vérifie que le membre a le droit d'être ici 
		//(soit le créateur soit un modo/admin)
		if (verif_Access($Auth_Modo,true) || $poster === user_data('Account_ID'))
		{
			//Ici on vérifie plusieurs choses :
			//est-ce un premier post ? Dernier post ou post classique ?
	 
			$first = get_db("SELECT Post_ID FROM Caranille_Posts WHERE Post_Topic_ID = '$topic' Order by Post_ID ASC limit 1");
			$count = count_db("SELECT Post_ID FROM Caranille_Posts WHERE Post_Topic_ID = '$topic'");

			//$return =  "count = $count<br/>";
			//$return =  $first['Post_ID']."==$post<br/>";
			
			//On distingue maintenant les cas
			if ($first['Post_ID']==$post) //Si le message est le premier
			{
				//Les autorisations ont changé !
				//Normal, seul un modo peut décider de supprimer tout un topic
				if (verif_Access($Auth_Modo, true))// || $count === 1)
				{
					//Il faut s'assurer que ce n'est pas une erreur
		 
					$return = '<p>Vous avez choisi de supprimer un post.
					Cependant ce post est le premier du topic. Voulez vous supprimer le topic ? <br />
					<a href="'.get_link('Post','Forum',array('action'=>'remove','t'=>$topic)).'">oui</a> - <a href="'.get_link('Topic','Forum',array('t'=>$topic)).'">non</a>
					</p>';
				}
			}
			else // Si c'est un post classique
			{
	 
				//On supprime le post
				delete_db('Caranille_Posts', array('Post_ID' => $post ));
						  
				//Enfin le message
				$return = '<p>Le message a bien été supprimé !<br />
				Cliquez <a href="'.get_link('Topic','Forum',array('t'=>$topic)).'">ici</a> pour retourner au topic<br />
				Cliquez <a href="'.get_link('Main','Forum').'">ici</a> pour revenir à l index du forum</p>';
			}
				   
		} //Fin du else
	} break;
	
	case "remove":{ //Si on veut supprimer le topic
		
		//Ensuite on vérifie que le membre a le droit d'être ici 
		//c'est-à-dire si c'est un modo / admin
	 
		if (verif_Access($Auth_Modo,true))
		{
			//On supprime le topic
		   delete_db('Caranille_Topics',array('Topic_ID'=>$topic));

			//Et on supprime les posts !
		   delete_db('Caranille_Posts',array('Post_Topic_ID'=>$topic));
		   
			//Enfin le message
			$return = '<p>Le topic a bien été supprimé !<br />
			Cliquez <a href="'.get_link('Main','Forum').'">ici</a> pour revenir à l index du forum</p>';

		} //Fin du else
	}break;

	case "lock":{ //Si on veut verrouiller le topic
		
		//Ensuite on vérifie que le membre a le droit d'être ici
		if (verif_Access($Auth_Modo))
		{
			//On met à jour la valeur de Topic_locked
			update_db('Caranille_Topics',array('Topic_locked' => 1, 'Topic_ID' => $topic));			

			$return = '<p>Le topic a bien été verrouillé ! <br />
			Cliquez <a href="'.get_link('Topic','Forum',array('t'=>$topic)).'">ici</a> pour retourner au topic<br />
			Cliquez <a href="'.get_link('Main','Forum').'">ici</a> pour revenir à l index du forum</p>';
		}
	}break;
	 
	case "unlock":{ //Si on veut déverrouiller le topic
	 
	 //Ensuite on vérifie que le membre a le droit d'être ici
		if (verif_Access($Auth_Modo))
		{
			//On met à jour la valeur de Topic_locked
			update_db('Caranille_Topics',array('Topic_locked' => 0, 'Topic_ID' => $topic));			
	 
			$return = '<p>Le topic a bien été déverrouillé !<br />
			Cliquez <a href="'.get_link('Topic','Forum',array('t'=>$topic)).'">ici</a> pour retourner au topic<br />
			Cliquez <a href="'.get_link('Main','Forum').'">ici</a> pour revenir à l index du forum</p>';
		}
	}break;

    default;{
    $return = '<p>Cette action est impossible</p>';
	}break;
} //Fin du Switch
?>
