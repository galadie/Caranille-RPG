<?php
	if(verif_access("Admin"))
	{
		load_css('map.css','map');

		function get_formulaire_Building($Building = array())
		{
?>
				<form method="POST" action="<?php echo get_link('Buildings','Admin') ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> du Batiment</h2>
    				<?php echo forumulaire_db('Caranille_Building',$Building); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php
		}
			
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Building'))// (request_confirm('Building_Type') && ($_POST['Building_Town_ID']) && ($_POST['Building_PosX']) && ($_POST['Building_PosY']) )
			{
				update_db('Caranille_Building',addslashes_r($_POST));

				$message = 'Batiment mis à jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Building',$_POST);

			$message = 'Le Batiment a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{		    
			if (valid_post_db('Caranille_Building'))// (request_confirm('Building_Type') && ($_POST['Building_Town_ID']) && ($_POST['Building_PosX']) && ($_POST['Building_PosY']) )
			{
				insert_db('Caranille_Building',addslashes_r($_POST));

				$message = 'Batiment ajouté';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
	}

?>
