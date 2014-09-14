<?php
	if(verif_access("Admin"))
	{
	    function get_formulaire($M = array())
		{
		    global $array_magic_type ;
		    
			extract(stripslashes_r($M));
?>		
		    <form method="POST" action="<?php echo get_link("Magics","Admin") ?>">
                <?php echo forumulaire_db('Caranille_Magics',$M); ?>
			    <br/>
				<input type="submit" name="Back" value="Annuler" />
		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
		    </form>
<?php
		}
		
		if (request_confirm('End_Edit'))
		{
			if (request_confirm('Magic_Image') && ($_POST['Magic_Name']) && ($_POST['Magic_Description']) && ($_POST['Magic_Type']) && ($_POST['Magic_Town']))
			{
				update_db('Caranille_Magics',addslashes_r($_POST));
				
				echo 'Magie mis à jour';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Magics',$_POST);
			echo 'La magie a bien été supprimé';
		}
	    if (request_confirm('End_Add'))
		{
			if (request_confirm('Magic_Image') && ($_POST['Magic_Name']) && ($_POST['Magic_Description']) && ($_POST['Magic_Type']) && ($_POST['Magic_Town']))
			{
				insert_db('Caranille_Magics',addslashes_r($_POST));
				
				echo 'Magie ajouté';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
	}
	
	
?>
