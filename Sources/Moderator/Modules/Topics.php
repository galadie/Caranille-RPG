<?php
	if(verif_access("Modo"))
	{
	
		function formulaire($Topic = array())
		{			
?>
				<form method="POST" action="<?php echo get_link("Topics","Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> de Topic</h2>
    				<?php echo forumulaire_db('Caranille_Topics',$Topic); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php

		}
		
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Topics'))// (request_confirm('Topic_Number') && ($_POST['Topic_Name']) && ($_POST['Topic_Opening']) && ($_POST['Topic_Ending']) && ($_POST['Topic_Defeate']))
			{
				update_db('Caranille_Topics',addslashes_r($_POST));

				$message = 'Chapitre mis à jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Topics',addslashes_r($_POST));
			$message = 'Le page a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Topics'))// (request_confirm('Topic_Number') && ($_POST['Topic_Name']) && ($_POST['Topic_Opening']) && ($_POST['Topic_Ending']) && ($_POST['Topic_Defeate']))
			{
				insert_db('Caranille_Topics',addslashes_r($_POST));

				$message = 'page ajouté';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
		
	}


?>