<?php
if(!$installing && $secteur_module !== 'Admin' && $secteur_module !== 'Moderator') {
//update by Dimitri

	echo '<a href="'.get_link('Main','Public').'">Accueil</a> | 
        <a href="'.get_link('Presentation','Public').'">Presentation</a> | ';
	foreach( $_menu_ as $slug => $title)
		echo '<a href="'.get_link($slug,'Contenu').'">'.$title.'</a> | ';

/**
        <a href="'.get_link('Apropos','Content').'">A propos</a> | 
        <a href="'.get_link('Contact','Content').'">Contact</a> | 
        <a href="'.get_link('Mentions','Content').'">Mentions légales</a> | 
        <a href="'.get_link('Reglement','Content').'">Règlement</a> |
        <a href="'.get_link('FAQ','Content').'">FAQ</a>
**/

}
elseif($installing && isset($span_footer))
{
	echo $span_footer ;
}
?>