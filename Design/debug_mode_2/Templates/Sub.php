<?php
	if(!$installing) 
	{
		//update by Dimitri

		foreach( $_menu_ as $slug => $title)
			echo '<a href="'.get_link($slug,'Contenu').'">'.$title.'</a> | ';

		/**
			echo '
				<a href="'.get_link('Main').'">Accueil</a> | 
				<a href="'.get_link('Presentation').'">Presentation</a> | 
				<a href="'.get_link('Apropos','Content').'">A propos</a> | 
				<a href="'.get_link('Contact','Content').'">Contact</a> | 
				<a href="'.get_link('Mentions','Content').'">Mentions légales</a> | 
				<a href="'.get_link('Reglement','Content').'">Règlement</a> |
				<a href="'.get_link('FAQ','Content').'">FAQ</a>
			';
		**/
	}
	//echo"<pre>".print_r(_menu("Admin","Head"),1)."</pre>";
?>