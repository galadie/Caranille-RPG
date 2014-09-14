<?php
//On récupère la valeur de f
$forum = intval(request_get('f'));
//Nombre de pages
$numpage = request_confirm('page') ? intval(request_get('page')) : 1;

$titre="Voir un forum";

//A partir d'ici, on va compter le nombre de messages
//pour n'afficher que les 25 premiers

$data=get_db('request_forum',array('forum'=>$forum));


//print_r($data);

extract(stripslashes_r($data));

$baseline = '<i>Vous êtes ici</i> : <a href="'.get_link('Main','Forum').'">Index du forum</a> &raquo;
<a href="'.get_link('Forum','Forum',array('f'=>$forum)).'">'.$Forum_Name.'</a>';

	load_css('forum.css','forum');	

?>