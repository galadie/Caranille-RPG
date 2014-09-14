<?php
	if(verif_access("Admin"))
	{
		function get_formulaire_Caracteristique($Caracteristique = array())
		{
				extract(stripslashes_r($Caracteristique));
?>
				<form method="POST" action="<?php echo get_link("Caracteristiques","Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> du Caracteristique</h2>
    				<?php echo forumulaire_db('Caranille_Caracteristiques',$Caracteristique); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php
		}
	
		if (request_confirm('up_rank'))
		{
			$Caracteristique_ID = htmlspecialchars(addslashes($_POST['Caracteristique_ID']));
			move_db('Caranille_Caracteristiques', $Caracteristique_ID, 'up');
			header('location:'.get_link('caracteristiques','admin',array('Edit'=>'ok')));	
			$message = 'Chapitre remonté';
		}
		
		if (request_confirm('down_rank'))
		{
			$Caracteristique_ID = htmlspecialchars(addslashes($_POST['Caracteristique_ID']));
			move_db('Caranille_Caracteristiques', $Caracteristique_ID, 'down');
			header('location:'.get_link('caracteristiques','admin',array('Edit'=>'ok')));	
			$message = 'Chapitre descendu';
		}

		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Caracteristiques'))// (request_confirm('Caracteristique_Number') && ($_POST['Caracteristique_Name']) && ($_POST['Caracteristique_Opening']) && ($_POST['Caracteristique_Ending']) && ($_POST['Caracteristique_Defeate']))
			{
				update_db('Caranille_Caracteristiques',addslashes_r($_POST));

				$message = 'Caracteristique mis à jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Caracteristiques',addslashes_r($_POST));

			$message = 'Le Caracteristique a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Caracteristiques'))// (request_confirm('Caracteristique_Number') && ($_POST['Caracteristique_Name']) && ($_POST['Caracteristique_Opening']) && ($_POST['Caracteristique_Ending']) && ($_POST['Caracteristique_Defeate']))
			{
				insert_db('Caranille_Caracteristiques',addslashes_r($_POST));

				$message = 'Caracteristique ajouté';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
	}

?>
