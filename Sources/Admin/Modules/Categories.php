<?php
	if(verif_access("Admin"))
	{
	
		function formulaire($Category = array())
		{			
?>
				<form method="POST" action="<?php echo get_link("Categories","Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> de Category</h2>
    				<?php echo forumulaire_db('Caranille_Categories',$Category); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php

		}
		
		if (request_confirm('up_rank'))
		{
			$Cat_ID = htmlspecialchars(addslashes($_POST['Cat_ID']));
			move_db('Caranille_Categories', $Cat_ID, 'up');
			header('location:'.get_link('categories','admin',array('Edit'=>'ok')));	
			$message = 'Chapitre remonté';
		}
		
		if (request_confirm('down_rank'))
		{
			$Cat_ID = htmlspecialchars(addslashes($_POST['Cat_ID']));
			move_db('Caranille_Categories', $Cat_ID, 'down');
			header('location:'.get_link('categories','admin',array('Edit'=>'ok')));	
			$message = 'Chapitre descendu';
		}
		
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Categories'))// (request_confirm('Category_Number') && ($_POST['Category_Name']) && ($_POST['Category_Opening']) && ($_POST['Category_Ending']) && ($_POST['Category_Defeate']))
			{
				update_db('Caranille_Categories',addslashes_r($_POST));

				$message = 'Chapitre mis à jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Categories',$_POST);

			$message = 'Le page a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Categories'))// (request_confirm('Category_Number') && ($_POST['Category_Name']) && ($_POST['Category_Opening']) && ($_POST['Category_Ending']) && ($_POST['Category_Defeate']))
			{
				insert_db('Caranille_Categories',addslashes_r($_POST));

				$message = 'page ajouté';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
		
		
	}

?>