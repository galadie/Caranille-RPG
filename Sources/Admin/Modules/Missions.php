<?php
	
	if(verif_access("Admin"))
	{
	    
	    function get_formulaire($mission = array())
		{
?>			
			<form method="POST" action="<?php echo get_link("Missions","Admin") ?>">
			   <?php echo forumulaire_db('Caranille_Missions',$mission); ?>
			    <br/>
				<input type="submit" name="Back" value="Annuler" />
		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
		    </form>
<?php
		}
		
		if (request_confirm('End_Edit'))
		{
			if (request_confirm('Mission_Number') && ($_POST['Mission_Name']) && ($_POST['Mission_Introduction']) && ($_POST['Mission_Defeate']) && ($_POST['Mission_Victory']) && ($_POST['Mission_Town']))
			{
				update_db('Caranille_Missions',addslashes_r($_POST));
				
				echo 'Mission mise à jour';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Missions',addslashes_r($_POST));
			echo 'La mission a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (request_confirm('Mission_Number') && ($_POST['Mission_Name']) && ($_POST['Mission_Introduction']) && ($_POST['Mission_Defeate']) && ($_POST['Mission_Victory']) && ($_POST['Mission_Town']))
			{
				insert_db('Caranille_Missions',addslashes_r($_POST));

				echo 'Mission ajoutée';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}	
		}
	}


?>
