<?php
	if(verif_access("Admin"))
	{
	
		function formulaire($Work = array())
		{			
?>
				<form method="POST" action="<?php echo get_link("Works","Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> de Work</h2>
    				<?php echo forumulaire_db('Caranille_Works',$Work); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php

		}
		
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Works'))// (request_confirm('Work_Number') && ($_POST['Work_Name']) && ($_POST['Work_Opening']) && ($_POST['Work_Ending']) && ($_POST['Work_Defeate']))
			{
				update_db('Caranille_Works',addslashes_r($_POST));

				$message = 'Work mis à jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Works',addslashes_r($_POST));
			$message = 'Le page a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Works'))// (request_confirm('Workegory_Number') && ($_POST['Work_Name']) && ($_POST['Work_Opening']) && ($_POST['Work_Ending']) && ($_POST['Work_Defeate']))
			{
				insert_db('Caranille_Works',addslashes_r($_POST));

				$message = 'page ajouté';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
		
		
	}

?>