<?php	
	if(verif_access("Admin"))
	{
	    function get_formulaire($monster= array())
		{		    
		
			
?>			<form method="POST" action="<?php echo get_link("Monsters","Admin") ?>">
			 <?php echo forumulaire_db('Caranille_Monsters',$monster); ?>
			    <br/>
			
			<?php 
				echo line_db('Caranille_Monster_Loot','Loot_Item_ID');
				echo line_db('Caranille_Monster_Loot','Loot_Rate');
			?>
				<input type="submit" name="Back" value="Annuler" />
		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
		    </form>
			
			
			
<?php
			if(isset($monster["Monster_ID"]))
			{
				$loots = list_db('foreign_list',array(
						'table' => 'Caranille_Monster_Loot' ,
						'ID' => 'Loot_Monster_ID',
						'value' => $monster["Monster_ID"]
					));

				list_html($loots,"Caranille_Monster_Loot","Loots",array('Loot_Item_ID','Loot_Rate'),true,false);
?>

<?php
			}
		}
		
		if (request_confirm('End_Edit'))
		{
			if (request_confirm('Monster_Image') && ($_POST['Monster_Name']) && ($_POST['Monster_Description']) && ($_POST['Monster_Level']))
			{
				update_db('Caranille_Monsters',addslashes_r($_POST));
				
				if($_POST['Loot_Item_ID'] !== 0 )
				{
				   	$_POST['Loot_Monster_ID'] = $_POST['Monster_ID'];
					insert_db('Caranille_Monster_Loot',addslashes_r($_POST));
				}
                echo 'Monstre mis à jour';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			$Monster_ID = htmlspecialchars(addslashes($_POST['Monster_ID']));

			delete_db('Caranille_Monsters',$_POST);
			echo 'Le monstre a bien été supprimé';
		}
		if (request_confirm('End_Add'))
		{
			if (request_confirm('Monster_Image') && ($_POST['Monster_Name']) && ($_POST['Monster_Description']) && ($_POST['Monster_Level']))
			{
				$id = insert_db('Caranille_Monsters',addslashes_r($_POST));
				
				if($_POST['Loot_Item_ID'] !== 0 )
				{
					$_POST['Loot_Monster_ID'] = $id;
					insert_db('Caranille_Monster_Loot',addslashes_r($_POST));
				}
				echo 'Monstre ajouté';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
	}
?>
