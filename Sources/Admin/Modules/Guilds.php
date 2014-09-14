<?php
	if(verif_access("Admin"))
	{
	    function formulaire($d= array())
	    {
?>
				<form method="POST" action="<?php echo get_link("Guilds","Admin") ?>">
 				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> de guilde</h2>
   				<?php echo forumulaire_db('Caranille_Guilds',$d); ?>
    			    <br/>
    				<input type="submit" name="Back" value="Annuler" />
    		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
    				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
    		    </form>
<?php
	    }
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Guilds'))//  ( request_confirm('Guild_Name') && request_confirm('Guild_Description'))
			{
				update_db('Caranille_Guilds',addslashes_r($_POST));
				echo "guilde mises à jour";
			}
			else
			{
				echo "Tous les champs n'ont pas été remplis";
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Guilds',$_POST);
			echo 'La guilde a bien été supprimé';
		}
	}
	
	
	
?>
