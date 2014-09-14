<?php
	if(verif_access("Admin"))
	{
	
		function formulaire($Page = array())
		{			
?>
				<form method="POST" action="<?php echo get_link("Pages","Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> de Page</h2>
    				<?php echo forumulaire_db('Caranille_Pages',$Page); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php

		}
		
		if (request_confirm('up_rank'))
		{
			$Page_ID = request_data('Page_ID');
			move_db('Caranille_Pages', $Page_ID, 'up');
			header('location:'.get_link('pages','admin',array('Edit'=>'ok')));	
			$message = 'Chapitre remonté';
		}
		
		if (request_confirm('down_rank'))
		{
			$Page_ID = request_data('Page_ID');
			move_db('Caranille_Pages', $Page_ID, 'down');
			header('location:'.get_link('pages','admin',array('Edit'=>'ok')));	
			$message = 'Chapitre descendu';
		}
		
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Pages'))// (request_confirm('Page_Number') && ($_POST['Page_Name']) && ($_POST['Page_Opening']) && ($_POST['Page_Ending']) && ($_POST['Page_Defeate']))
			{
				update_db('Caranille_Pages',addslashes_r($_POST));

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
			$message = 'Le page a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Pages'))// (request_confirm('Page_Number') && ($_POST['Page_Name']) && ($_POST['Page_Opening']) && ($_POST['Page_Ending']) && ($_POST['Page_Defeate']))
			{
				insert_db('Caranille_Pages',addslashes_r($_POST));

				$message = 'page ajouté';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
	}



?>