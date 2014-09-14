<?php
	if(verif_access("Admin"))
	{
	    function formulaire($r=array())
	    {
			global $array_Fragments_type;
			
			set_values_db('Caranille_Fragments','Fragment_Type',$array_Fragments_type);

?>	        
			<form method="POST" action="<?php echo get_link("Fragments","Admin") ?>">
			    <?php echo forumulaire_db('Caranille_Fragments',$r); ?>
			    <br/>
				<input type="submit" name="Back" value="Annuler" />
		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
		    </form>
<?php	        
	    }
	    if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Fragments'))// (request_confirm('Fragment_Image') && request_confirm('Fragment_Name') && request_confirm('Fragment_Description') && request_confirm('Fragment_Town'))
			{
			    update_db('Caranille_Fragments',addslashes_r($_POST));
			    
				echo 'Fragment mis à jour';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Fragments',$_POST);
			echo 'Le Fragment a bien été supprimé';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Fragments'))// (request_confirm('Fragment_Image') && request_confirm('Fragment_Name') && request_confirm('Fragment_Description') && request_confirm('Fragment_Town'))
			{
				insert_db('Caranille_Fragments',addslashes_r($_POST));

			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
	}
?>
