<?php
	if(verif_access("Admin"))
	{
		function get_formulaire($Weapon = array())
		{
		    global $array_weapon_type ;
		    
			//extract(stripslashes_r($Weapon));
			set_values_db('Caranille_Items','Item_Type',$array_weapon_type);

?>			
			<form method="POST" action="<?php echo get_link("Weapon","Admin") ?>">
				    <h2><?php echo (request_confirm('Add') ? 'Ajout' : 'Modification') ?> d'armes</h2>
			 <?php echo forumulaire_db('Caranille_Items',$Weapon); ?>
			    <br/>
			<?php 
				echo line_db('Caranille_Craftings','Crafting_Fragment_ID');
			?>
				<input type="submit" name="Back" value="Annuler" />
		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
		    </form>
<?php

			if(isset($r["Item_ID"]))
			{
				$loots = list_db('foreign_list',array(
						'table' => 'Caranille_Craftings' ,
						'ID' => 'Crafting_Item_ID',
						'value' => $r["Item_ID"]
					));

				list_html($loots,"Caranille_Craftings","Crafts",array('Crafting_Fragment_ID'),true,false);
			}
		}
			
		if (request_confirm('End_Edit'))
		{	
			if (valid_post_db('Caranille_Items'))// (request_confirm('Item_Image') && ($_POST['Item_Name']) && ($_POST['Item_Description']) && ($_POST['Item_Town']))
			{
				update_db('Caranille_Items',addslashes_r($_POST));

				echo 'Equipement mis à jour';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Items',addslashes_r($_POST));
			echo 'L\'équipement a bien été supprimé';
		}
		
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Items'))// (request_confirm('Item_Name') && request_confirm('Item_Description') && request_confirm('Item_Type') && request_confirm('Item_Town')) //('Item_Image') &&
			{
				insert_db('Caranille_Items',addslashes_r($_POST));
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
	}
	
?>
