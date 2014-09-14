<?php
	if(verif_access("Admin"))
	{
		$table = $page ;
	
		function formulaire($table = array())
		{			
?>
				<form method="POST" action="<?php echo get_link($table,"Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> de <?php echo $table ?></h2>
    				<?php echo forumulaire_db('Caranille_'.$table,$table); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php

		}
		
		if (request_confirm('up_rank'))
		{
			$table_ID = htmlspecialchars(addslashes($_POST[$table.'_ID']));
			move_db('Caranille_'.$table.'s', $table_ID, 'up');
			header('location:'.get_link($table.'s','admin',array('Edit'=>'ok')));	
			$message = $table.' remonté';
		}
		
		if (request_confirm('down_rank'))
		{
			$table_ID = htmlspecialchars(addslashes($_POST[$table.'_ID']));
			move_db('Caranille_'.$table.'s', $table_ID, 'down');
			header('location:'.get_link($table.'s','admin',array('Edit'=>'ok')));	
			$message = $table.' descendu';
		}
		
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_'.$table.'s'))// (request_confirm('$table_Number') && ($_POST['$table_Name']) && ($_POST['$table_Opening']) && ($_POST['$table_Ending']) && ($_POST['$table_Defeate']))
			{
				update_db('Caranille_'.$table.'s',addslashes_r($_POST));

				$message = $table.' mis à jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db(addslashes_r($_POST));
			$message = 'Le '.$table.' a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_'.$table.'s'))// (request_confirm('$table_Number') && ($_POST['$table_Name']) && ($_POST['$table_Opening']) && ($_POST['$table_Ending']) && ($_POST['$table_Defeate']))
			{
				insert_db('Caranille_'.$table.'s',addslashes_r($_POST));

				$message = $table.' ajouté';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
	}



?>