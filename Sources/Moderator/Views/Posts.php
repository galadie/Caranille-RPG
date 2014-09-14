<?php

		
	if(verif_access("Modo"))
	{
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des pages du MMORPG<br /><br />';
			
			list_html_db('Caranille_Posts','Posts',array('Post_Forum_ID','Post_Topic_ID','Post_Texte','Post_Time'));
			
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Post_ID = request_data('Post_ID');

			$Post_List = get_db("edit_admin",array(
				'table' => 'Caranille_Posts' ,
				'ID' => 'Post_ID',
				'value' => $Post_ID
			));
			
			formulaire($Post_List);

		}
		else
		if (request_confirm('Second_Delete'))
		{
		    			$Post_ID = request_data('Post_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Posts","Admin") ?>">
				<input type="hidden" name="Post_ID" value="<?php echo $Post_ID ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
	    else // 		if (empty($_POST['Edit']) && empty($_POST['Add']) && empty($_POST['Second_Add']) && empty($_POST['Second_Edit']) && empty($_POST['End_Edit']) && (empty($_POST['Delete'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Posts","Admin").'">';
			echo '<input type="submit" name="Edit" value="Modifier une Post">';
			echo '</form>';
		}
		
		if(isset($message) && $message !=="")
		{
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link("Posts","Admin") ?>">
			<input type="hidden" name="Post_ID" value="<?php echo $Post_ID ?>"/>
			<input type="submit" name="Second_Edit" value="modifier"/>
			<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
<?php
		}
	}