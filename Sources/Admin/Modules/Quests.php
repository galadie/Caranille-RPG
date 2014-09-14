<?php

	
	if(verif_access("Admin"))
	{
	    
	    function get_formulaire($Quest = array())
		{

?>			
			<form method="POST" action="<?php echo get_link("Quests","Admin") ?>">
	            <?php echo forumulaire_db('Caranille_Quests',$Quest); ?>
			    <br/>
				<input type="submit" name="Back" value="Annuler" />
		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
		    </form>
	
<?php
		}
		if (request_confirm('End_Edit'))
		{
			if (request_confirm('Quest_Number') && request_confirm('Quest_Name') && request_confirm('Quest_Introduction') && request_confirm('Quest_Defeate') && request_confirm('Quest_Victory') && request_confirm('Quest_Town_Origin'))
			{
				update_db('Caranille_Quests',addslashes_r($_POST));
				
				echo 'Quest mise à jour';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
				
		if (request_confirm('Delete'))
		{
			$Quest_ID = htmlspecialchars(addslashes($_POST['Quest_ID']));
			delete_db('Caranille_Quests',addslashes_r($_POST));
			echo 'La quête a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (request_confirm('Quest_Number') && request_confirm('Quest_Name') && request_confirm('Quest_Introduction') && request_confirm('Quest_Defeate') && request_confirm('Quest_Victory') && request_confirm('Quest_Town_Origin'))
			{
				insert_db('Caranille_Quests',addslashes_r($_POST));

				echo 'Quest ajoutée';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}	
		}		
	}	
	