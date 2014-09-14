<?php
	if(verif_access("Admin"))
	{
	
		function formulaire($Forum = array())
		{			
?>
				<form method="POST" action="<?php echo get_link("Forums","Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> de Forum</h2>
    				<?php echo forumulaire_db('Caranille_Forums',$Forum); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php

		}
		
		if (request_confirm('up_rank'))
		{
			$Forum_ID = htmlspecialchars(addslashes($_POST['Forum_ID']));
			move_db('Caranille_Forums', $Forum_ID, 'up');
			header('location:'.get_link('forums','admin',array('Edit'=>'ok')));	
			$message = 'Chapitre remonté';
		}
		
		if (request_confirm('down_rank'))
		{
			$Forum_ID = htmlspecialchars(addslashes($_POST['Forum_ID']));
			move_db('Caranille_Forums', $Forum_ID, 'down');
			header('location:'.get_link('forums','admin',array('Edit'=>'ok')));	
			$message = 'Chapitre descendu';
		}
		
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Forums'))// (request_confirm('Forum_Number') && ($_POST['Forum_Name']) && ($_POST['Forum_Opening']) && ($_POST['Forum_Ending']) && ($_POST['Forum_Defeate']))
			{
				update_db('Caranille_Forums',addslashes_r($_POST));

				$message = 'Chapitre mis à jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Forums',$_POST);
			$message = 'Le page a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Forums'))// (request_confirm('Forum_Number') && ($_POST['Forum_Name']) && ($_POST['Forum_Opening']) && ($_POST['Forum_Ending']) && ($_POST['Forum_Defeate']))
			{
				insert_db('Caranille_Forums',addslashes_r($_POST));

				$message = 'page ajouté';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
	}

?>