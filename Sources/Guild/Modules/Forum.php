<?php     
	
	load_css('forum.css','forum');
	
	if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
			//On récupère la valeur de f
			$Forum_ID = intval(request_get('f'));
			//Nombre de pages
			$numpage = request_confirm('page') ? intval(request_get('page')) : 1;

			$titre="Voir un forum";

			//A partir d'ici, on va compter le nombre de messages
			//pour n'afficher que les 25 premiers

			$data = get_db('request_guild_get_forum',array('forum'=>$Forum_ID, 'Guild_ID' => guild_data('Guild_ID')));//get_db($r) ;

			//print_r($data);

			extract(stripslashes_r($data));

			$baseline = '<i>Vous êtes ici</i> : <a href="'.get_link('Main','Guild').'">Index du forum</a> &raquo;
			<a href="'.get_link('Forum','Guild',array('f'=>$Forum_ID)).'">'.$Forum_Name.'</a>';
		}
	}
?>