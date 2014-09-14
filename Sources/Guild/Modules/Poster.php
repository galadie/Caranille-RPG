<?php 	load_css('forum.css','forum');

    if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
			$titre="Poster";

			//Qu'est ce qu'on veut faire ? poster, répondre ou éditer ?
			$action = (request_confirm('action'))?request_get('action'):'';

			//Il faut être connecté pour poster !
			//if (user_data('Account_ID')==0) erreur(ERR_IS_CO);

			//Si on veut poster un nouveau topic, la variable f se trouve dans l'url,
			//On récupère certaines valeurs
			if (request_confirm('f'))
			{
				$Forum_ID = intval(request_get('f'));
				$r = "SELECT Forum_Name, Auth_view, Auth_Post, Auth_Topic, Auth_annonce, Auth_modo
				FROM Caranille_forums WHERE Forum_id ='$Forum_ID' and Forum_Guild_ID = '".guild_data('Guild_ID')."'  limit 1; ";
				$query= get_db($r);
				//echo $r ;
				extract(stripslashes_r($query));
				
				$baseline = '<p><i>Vous êtes ici</i> : 
				<a href="'.get_link('Main','Guild').'">Index du forum</a> &raquo;
				<a href="'.get_link('Forum','Guild',array('f'=>$Forum_ID)).'">'.$Forum_Name.'</a> &raquo; Nouveau topic</p>';

			 
			}
			 
			//Sinon c'est un nouveau message, on a la variable t et
			//On récupère f grâce à une requête
			elseif (request_confirm('t'))
			{
				$Topic_ID = intval(request_get('t'));
				$r = "SELECT Topic_Titre, f.Forum_id,
				Forum_Name, Auth_view, Auth_Post, Auth_Topic, Auth_annonce, Auth_modo
				FROM Caranille_Topics t
				LEFT JOIN Caranille_forums f ON f.Forum_id = t.Topic_Forum_id
				left join Caranille_Guilds g on f.Forum_Guild_ID = g.Guild_ID
				WHERE Topic_id ='$Topic_ID' 
				and Forum_Guild_ID = '".guild_data('Guild_ID')."'
				limit 1; ";
				$query=get_db($r);
				//echo $r ;
				extract(stripslashes_r($query));
				$Forum_ID = $Forum_id;  

				$baseline = '<p><i>Vous êtes ici</i> : 
				<a href="'.get_link('Main','Guild').'">Index du forum</a> &rarr; 
				<a href="'.get_link('Forum','Guild',array('f'=>$Forum_ID)).'">'.$Forum_Name.'</a> &raquo; 
				<a href="'.get_link('Topic','Guild',array('t'=>$Topic_ID)).'">'.$Topic_Titre.'</a> &raquo; Répondre</p>';
			}
			 
			//Enfin sinon c'est au sujet de la modération(on verra plus tard en détail)
			//On ne connait que le post, il faut chercher le reste
			elseif (request_confirm('p'))
			{
				$post = intval(request_get('p'));
				$r = "SELECT Post_Createur, t.Topic_id, Topic_Titre, f.Forum_id, Post_texte,
				Forum_Name, Auth_view, Auth_Post, Auth_Topic, Auth_annonce, Auth_modo
				FROM Caranille_Posts p
				LEFT JOIN Caranille_Topics t ON t.Topic_id = p.Post_Topic_id
				LEFT JOIN Caranille_forums f ON f.Forum_id = t.Topic_Forum_id
				left join Caranille_Guilds g on f.Forum_Guild_ID = g.Guild_ID
				WHERE p.Post_id ='$post' 
				and Forum_Guild_ID = '".guild_data('Guild_ID')."'
				limit 1; ";
				
				//echo $r;
				
				$query=get_db($r);

				extract(stripslashes_r($query));	
				
				$Topic_ID = $Topic_id;
				$Forum_ID = $Forum_id;
			 
				$baseline = '<p><i>Vous êtes ici</i> : 
				<a href="'.get_link('Main','Guild').'">Index du forum</a> &raquo;
				<a href="'.get_link('Forum','Guild',array('f'=>$Forum_ID)).'">'.$Forum_Name.'</a> &raquo;
				<a href="'.get_link('Topic','Guild',array('t'=>$Topic_ID)).'">'.$Topic_Titre.'</a> &raquo; Modérer un message</p>';
			}
		}
	}
?>