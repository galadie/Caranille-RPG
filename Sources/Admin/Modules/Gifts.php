<?php
	if(verif_access("Admin"))
	{
	
		function formulaire($Gift = array())
		{			
?>
				<form method="POST" action="<?php echo get_link("Gifts","Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> de Gift</h2>
    				<?php echo forumulaire_db('Caranille_Gifts',$Gift); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php

		}
		
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Gifts'))// (request_confirm('Gift_Number') && ($_POST['Gift_Name']) && ($_POST['Gift_Opening']) && ($_POST['Gift_Ending']) && ($_POST['Gift_Defeate']))
			{
				update_db('Caranille_Gifts',addslashes_r($_POST));

				$message = 'Chapitre mis à jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db(addslashes_r($_POST));
			$message = 'Le Gift a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Gifts'))// (request_confirm('Gift_Number') && ($_POST['Gift_Name']) && ($_POST['Gift_Opening']) && ($_POST['Gift_Ending']) && ($_POST['Gift_Defeate']))
			{
				insert_db('Caranille_Gifts',addslashes_r($_POST));

				$message = 'Gift ajouté';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
	}



?>