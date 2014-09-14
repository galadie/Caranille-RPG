<?php
	if(verif_access("Admin"))
	{
	
		function formulaire($Race = array())
		{			
?>
				<form method="POST" action="<?php echo get_link("Races","Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> de Race</h2>
    				<?php echo forumulaire_db('Caranille_Races',$Race); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php

		}
		
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Races'))// (request_confirm('Race_Number') && ($_POST['Race_Name']) && ($_POST['Race_Opening']) && ($_POST['Race_Ending']) && ($_POST['Race_Defeate']))
			{
				update_db('Caranille_Races',addslashes_r($_POST));

				$message = 'Race mis à jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Races',addslashes_r($_POST));
			$message = 'Le page a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Races'))// (request_confirm('Raceegory_Number') && ($_POST['Race_Name']) && ($_POST['Race_Opening']) && ($_POST['Race_Ending']) && ($_POST['Race_Defeate']))
			{
				insert_db('Caranille_Races',addslashes_r($_POST));

				$message = 'page ajouté';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
		
		
	}

?>