<?php
	if(verif_access("Admin"))
	{
	
		function formulaire($Ressource = array())
		{			
?>
				<form method="POST" action="<?php echo get_link("Ressources","Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> de Ressource</h2>
    				<?php echo forumulaire_db('Caranille_Ressources',$Ressource); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php

		}
		
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Ressources'))// (request_confirm('Ressource_Number') && ($_POST['Ressource_Name']) && ($_POST['Ressource_Opening']) && ($_POST['Ressource_Ending']) && ($_POST['Ressource_Defeate']))
			{
				update_db('Caranille_Ressources',addslashes_r($_POST));

				$message = 'Ressource mis à jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Ressources',addslashes_r($_POST));
			$message = 'Le page a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Ressources'))// (request_confirm('Ressourceegory_Number') && ($_POST['Ressource_Name']) && ($_POST['Ressource_Opening']) && ($_POST['Ressource_Ending']) && ($_POST['Ressource_Defeate']))
			{
				insert_db('Caranille_Ressources',addslashes_r($_POST));

				$message = 'page ajouté';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
		
		
	}

?>