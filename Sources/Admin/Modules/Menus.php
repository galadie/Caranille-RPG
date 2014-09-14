<?php
	if(verif_access("Admin"))
	{
		function get_formulaire_Menu($Menu = array())
		{
				extract(stripslashes_r($Menu));
				
				if(isset($Menu_Module))
					set_values_db('Caranille_Menus','Menu_Link',list_menu($Menu_Module))
?>
				<form method="POST" action="<?php echo get_link("Menus","Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> du Menu</h2>
    				<?php echo forumulaire_db('Caranille_Menus',$Menu); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php
		}
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Menus'))// (request_confirm('Menu_Number') && ($_POST['Menu_Name']) && ($_POST['Menu_Opening']) && ($_POST['Menu_Ending']) && ($_POST['Menu_Defeate']))
			{
				update_db('Caranille_Menus',addslashes_r($_POST));

				$message = 'Menu mis à jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Menus',addslashes_r($_POST));

			$message = 'Le chapitre a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Menus'))// (request_confirm('Menu_Number') && ($_POST['Menu_Name']) && ($_POST['Menu_Opening']) && ($_POST['Menu_Ending']) && ($_POST['Menu_Defeate']))
			{
				insert_db('Caranille_Menus',addslashes_r($_POST));

				$message = 'chapitre ajouté';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
	}

?>
