<?php
	
	if(verif_access("Admin"))
	{
        function get_formulaire($news = array())
		{
?>			
			<form method="POST" action="<?php echo get_link("News","Admin") ?>">
	            <?php echo forumulaire_db('Caranille_News',$news); ?>
			    <br/>
				<input type="submit" name="Back" value="Annuler" />
		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
		    </form>
<?php
		}
		
		if (request_confirm('End_Edit'))
		{
			if(valid_post_db('Caranille_News'))
			{
				update_db('Caranille_News',addslashes_r($_POST));

				echo 'News mise à jour';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_News',$_POST);
			echo 'La News à bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if(valid_post_db('Caranille_News'))
			{
				insert_db('Caranille_News',addslashes_r($_POST));

				echo 'News ajoutée';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
	}

	

?>
