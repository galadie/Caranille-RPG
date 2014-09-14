<?php
	load_css('forum.css','forum');	

$titre="Poster";

//Qu'est ce qu'on veut faire ? poster, répondre ou éditer ?
$action = request_confirm('action')? request_get('action'):'';

//Il faut être connecté pour poster !
//if (user_data('Account_ID')==0) erreur(ERR_IS_CO);

//Si on veut poster un nouveau topic, la variable f se trouve dans l'url,
//On récupère certaines valeurs
if (request_confirm('f'))
{
    $forum = intval(request_get('f'));
	$r = "SELECT Forum_Name, Auth_View, Auth_Post, Auth_Topic, Auth_Annonce, Auth_Modo
    FROM Caranille_Forums WHERE Forum_ID ='$forum' limit 1; ";
    $query= get_db($r);
	//echo $r ;
	extract(stripslashes_r($query));
	
    $baseline = '<p><i>Vous êtes ici</i> : 
	<a href="'.get_link('Main','Forum').'">Index du forum</a> &raquo;
    <a href="'.get_link('Forum','Forum',array('f'=>$forum)).'">'.$Forum_Name.'</a> &raquo; Nouveau topic</p>';

 
}
 
//Sinon c'est un nouveau message, on a la variable t et
//On récupère f grâce à une requête
elseif (request_confirm('t'))
{
    $topic = intval(request_get('t'));
	$r = "SELECT Topic_Titre, f.Forum_ID,
    Forum_Name, Auth_View, Auth_Post, Auth_Topic, Auth_Annonce, Auth_Modo
    FROM Caranille_Topics t
    LEFT JOIN Caranille_Forums f ON f.Forum_ID = t.Topic_Forum_id
    WHERE Topic_ID ='$topic' limit 1; ";
    $query=get_db($r);
	//echo $r ;
	extract(stripslashes_r($query));
    $forum = $Forum_ID;  

    $baseline = '<p><i>Vous êtes ici</i> : 
	<a href="'.get_link('Main','Forum').'">Index du forum</a> &rarr; 
    <a href="'.get_link('Forum','Forum',array('f'=>$forum)).'">'.$Forum_Name.'</a> &raquo; 
	<a href="'.get_link('Topic','Forum',array('t'=>$topic)).'">'.$Topic_Titre.'</a> &raquo; Répondre</p>';
}
 
//Enfin sinon c'est au sujet de la modération(on verra plus tard en détail)
//On ne connait que le post, il faut chercher le reste
elseif (request_confirm('p'))
{
    $post = intval(request_get('p'));
	$r = "SELECT Post_Createur, t.Topic_ID, Topic_Titre, f.Forum_ID, Post_Texte,
    Forum_Name, Auth_View, Auth_Post, Auth_Topic, Auth_Annonce, Auth_Modo
    FROM Caranille_Posts p
    LEFT JOIN Caranille_Topics t ON t.Topic_ID = p.Post_Topic_id
    LEFT JOIN Caranille_Forums f ON f.Forum_ID = t.Topic_Forum_id
    WHERE p.Post_id ='$post' limit 1; ";
	
	//echo $r;
	
    $query=get_db($r);

	extract(stripslashes_r($query));	
	
    $topic = $Topic_ID;
    $forum = $Forum_ID;
 
    $baseline = '<p><i>Vous êtes ici</i> : 
	<a href="'.get_link('Main','Forum').'">Index du forum</a> &raquo;
    <a href="'.get_link('Forum','Forum',array('f'=>$forum)).'">'.$Forum_Name.'</a> &raquo;
	<a href="'.get_link('Topic','Forum',array('t'=>$topic)).'">'.$Topic_Titre.'</a> &raquo; Modérer un message</p>';
}
?>