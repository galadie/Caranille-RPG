<?php 
	load_css('forum.css','forum');	

$titre="Voir un sujet";

//On récupère la valeur de t
$topic = intval(request_get('t'));
//Nombre de pages
$numpage = request_confirm('page') ? intval(request_get('page')) : 1;

//A partir d'ici, on va compter le nombre de messages pour n'afficher que les 15 premiers
$query=get_db('request_topic',array('topic'=> $topic));

extract(stripslashes_r($query));

//On ajoute 1 au nombre de visites de ce topic
$Topic_Vu ++ ;
update_db('Caranille_Topics', array('Topic_ID' => $topic, 'Topic_Vu' => $Topic_Vu));

$forum=$Forum_ID; 

$baseline = '<i>Vous êtes ici</i> : 
<a href="'.get_link('Main','Forum').'">Index du forum</a> &raquo;
<a href="'.get_link('Forum','Forum',array('f'=>$forum)).'">'.$Forum_Name.'</a> &raquo; 
<a href="'.get_link('Topic','Forum',array('t'=>$topic)).'">'.$Topic_Titre.'</a>';
 
?>