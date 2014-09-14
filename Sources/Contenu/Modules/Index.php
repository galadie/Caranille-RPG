<?php

$try_content = get_db("edit_admin",array(
						'table' => 'Caranille_Pages' ,
						'ID' => 'Page_Slug',
						'value' => $page
					));
					
$description = $try_content['Page_Description'];
$keywords = $try_content['Page_Keywords'];
$title = $try_content['Page_Title'];
 
 ?>