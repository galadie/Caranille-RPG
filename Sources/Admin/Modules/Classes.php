<?php
	if(verif_access("Admin"))
	{
	
		function formulaire($Classe = array())
		{			
?>
				<form method="POST" action="<?php echo get_link("Classes","Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> de Classe</h2>
    				<?php echo forumulaire_db('Caranille_Classes',$Classe); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php

		}
		
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Classes'))// (request_confirm('Classe_Number') && ($_POST['Classe_Name']) && ($_POST['Classe_Opening']) && ($_POST['Classe_Ending']) && ($_POST['Classe_Defeate']))
			{
				update_db('Caranille_Classes',addslashes_r($_POST));

				$message = 'Classe mis � jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas �t� remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Classes',$_POST);

			$message = 'Le page a bien �t� supprim�e';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Classes'))// (request_confirm('Classeegory_Number') && ($_POST['Classe_Name']) && ($_POST['Classe_Opening']) && ($_POST['Classe_Ending']) && ($_POST['Classe_Defeate']))
			{
				insert_db('Caranille_Classes',addslashes_r($_POST));

				$message = 'page ajout�';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas �t� remplis';
			}	
		}
		
		
	}

?>