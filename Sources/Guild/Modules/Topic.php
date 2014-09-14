<?php 	

	load_css('forum.css','forum');

    if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
			$titre="Voir un sujet";

			//On récupère la valeur de t
			$Topic_ID = intval(request_get('t'));
			//Nombre de pages
			$numpage = request_confirm('page') ? intval(request_get('page')) : 1;

			//A partir d'ici, on va compter le nombre de messages pour n'afficher que les 15 premiers
			$query=get_db('request_guild_topic',array('topic' => $Topic_ID , 'Guild_ID' => guild_data('Guild_ID') ));

			extract(stripslashes_r($query));

			//On ajoute 1 au nombre de visites de ce topic
			update_db('Caranille_Topics', array('Topic_ID' => $Topic_ID, 'Topic_Vu' => ($Topic_Vu+1) ));

			$Forum_ID=$Forum_ID; 


			$baseline = '<i>Vous êtes ici</i> : 
			<a href="'.get_link('Main','Guild').'">Index du forum</a> &raquo;
			<a href="'.get_link('Forum','Guild',array('f'=>$Forum_ID)).'">'.$Forum_Name.'</a> &raquo; 
			<a href="'.get_link('Topic','Guild',array('t'=>$Topic_ID)).'">'.$Topic_Titre.'</a>';
		}
	}

?>