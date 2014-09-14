<?php
	if(verif_access("Admin"))
	{
        function get_formulaire($news = array())
		{
			//extract(stripslashes_r($news));

			echo '<form method="POST" action="'.get_link("Comments","Admin").'">';
			echo forumulaire_db('Caranille_Comments',$news);
			echo '<input type="submit" name="Back" value="Annuler" />';
			echo '<input type="submit" name="End_Edit" value="Terminer"/>';
			if(request_confirm('Second_Edit')) echo '<input type="submit" name="Second_Delete" value="Supprimer"/>';
			echo '</form>';
		}

		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Comments'))
			{
				update_db('Caranille_Comments',addslashes_r($_POST));

				echo 'Comment mise à jour';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Comments',addslashes_r($_POST));
			echo 'La Comment à bien été supprimée';
		}
	}
?>
