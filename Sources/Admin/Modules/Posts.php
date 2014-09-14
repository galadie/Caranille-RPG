<?php
	if(verif_access("Admin"))
	{
	
		function formulaire($Post = array())
		{			
?>
				<form method="POST" action="<?php echo get_link("Posts","Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> de Post</h2>
    				<?php echo forumulaire_db('Caranille_Posts',$Post); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php

		}
		
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Posts'))// (request_confirm('Post_Number') && ($_POST['Post_Name']) && ($_POST['Post_Opening']) && ($_POST['Post_Ending']) && ($_POST['Post_Defeate']))
			{
				update_db('Caranille_Posts',addslashes_r($_POST));

				$message = 'Chapitre mis à jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Posts',addslashes_r($_POST));
			$message = 'Le page a bien été supprimée';
		}
	}


?>