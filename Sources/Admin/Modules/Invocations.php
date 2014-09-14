<?php
	if(verif_access("Admin"))
	{
	    function get_formulaire_invocation($Invocations = array())
		{
				extract(stripslashes_r($Invocations));		
?>				
			<form method="POST" action="<?php echo get_link("Invocations","Admin") ?>">
 				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> d'Invocation</h2>
                <?php echo forumulaire_db('Caranille_Invocations',$Invocations); ?>
			    <br/>
				<input type="submit" name="Back" value="Annuler" />
		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"/><?php } ?>
		    </form>
<?php
		}		
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Guilds'))// (request_confirm('Invocation_Name') && request_confirm('Invocation_Description') && request_confirm('Invocation_Town')) //request_confirm('Invocation_Image') &&
			{
				update_db('Caranille_Invocations',addslashes_r($_POST));
				
				echo "Invocations mis à jour";
			}
			else
			{
				echo "Tous les champs n'ont pas été remplis";
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Invocations',addslashes_r($_POST));

			echo "L'invocation a bien été supprimé";
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Guilds'))// ( request_confirm('Invocation_Name') && request_confirm('Invocation_Description') && request_confirm('Invocation_Town'))
			{
				//request_confirm('Invocation_Image') &&
				insert_db('Caranille_Invocations',addslashes_r($_POST));
				
				echo 'Invocations ajouté';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
	}


?>
