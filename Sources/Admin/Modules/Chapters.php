<?php
	if(verif_access("Admin"))
	{
		function get_formulaire_chapter($Chapter = array())
		{
				extract(stripslashes_r($Chapter));
?>
				<form method="POST" action="<?php echo get_link("Chapters","Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> du Chapitre</h2>
    				<?php echo forumulaire_db('Caranille_Chapters',$Chapter); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php
		}
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Chapters'))// (request_confirm('Chapter_Number') && ($_POST['Chapter_Name']) && ($_POST['Chapter_Opening']) && ($_POST['Chapter_Ending']) && ($_POST['Chapter_Defeate']))
			{
				update_db('Caranille_Chapters',addslashes_r($_POST));

				$message = 'Chapitre mis à jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Chapters',addslashes_r($_POST));

			$message = 'Le chapitre a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Chapters'))// (request_confirm('Chapter_Number') && ($_POST['Chapter_Name']) && ($_POST['Chapter_Opening']) && ($_POST['Chapter_Ending']) && ($_POST['Chapter_Defeate']))
			{
				insert_db('Caranille_Chapters',addslashes_r($_POST));

				$message = 'chapitre ajouté';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
	}

?>
