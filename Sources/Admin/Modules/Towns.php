<?php
	
	if(verif_access("Admin"))
	{
		load_css('map.css','map');
		
	    function get_formulaire_town($Towns = array())
		{
		    global $rayon_city , $array_landing_type , $_path ;
		    
				extract(stripslashes_r($Towns));
				
				$_Buildings = list_db('foreign_list',array(
						'table' => 'Caranille_Building' ,
						'ID' => 'Building_Town_ID',
						'value' => $Town_ID
					));
									
				 $l_Buildings = array();
				if(!empty($_Buildings))
				{
					foreach($_Buildings as $b)
					{
						$x = $b['Building_PosX'];
						$y = $b['Building_PosY'];
						
						$l_Buildings[$x][$y] = $b ;
					}
				}
?>				
				<form method="POST" action="<?php echo get_link("Towns","Admin") ?>">
				<table>
				<tr><td><?php
									echo line_db("Caranille_Towns","Town_Image",(isset( $Town_Image) ?  $Town_Image :''));
									echo line_db("Caranille_Towns","Town_Name",(isset( $Town_Name) ?  $Town_Name :''));
									echo line_db("Caranille_Towns","Town_Description",(isset( $Town_Description) ?  $Town_Description :''));
									echo line_db("Caranille_Towns","Town_Price_INN",(isset( $Town_Price_INN) ?  $Town_Price_INN :''));
									echo line_db("Caranille_Towns","Town_Chapter",(isset($Town_Chapter) ? $Town_Chapter : 0 ));
				?></td></tr>
								<tr><th colspan="2">Coordonnées de la ville</th></tr>
				<tr><td><?php
									echo line_db("Caranille_Towns","Town_PosX",(isset( $Town_PosX) ?  $Town_PosX : $_POST['PosX']));
									echo line_db("Caranille_Towns","Town_PosY",(isset( $Town_PosX) ?  $Town_PosY : $_POST['PosY']));
									echo line_db("Caranille_Towns","Town_Landing",(isset($Town_Landing) ? $Town_Landing : 0 ));
				?></td></tr>
				<tr><th colspan="2">Carte de la ville</th></tr>
				
					<tr><td colspan="2"><?php	
			if(file_exists("$_path/Sources/Admin/Modules/Towns/Map-2.php")) 
			    include_once("$_path/Sources/Admin/Modules/Towns/Map-2.php");
			else
			   echo 'carte indisponible'; ?></td></tr>
			   
		    <tr><td class="none" colspan="2">
				<input type="hidden" name="Town_ID" value="<?php echo (isset($Town_ID) ? $Town_ID: '')?>"/>
				<input type="submit" name="Back" value="Annuler" />
		        <input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer">
				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
		    </td></tr>
				</table>
				</form>		
<?php
		}
		
		
		
		if (request_confirm('End_Edit'))
		{
			if(valid_post_db('Caranille_Towns'))// (request_confirm('Town_Image') && ($_POST['Town_Name']) && ($_POST['Town_Description']) && ($_POST['Town_Chapter']))
			{
				update_db('Caranille_Towns',addslashes_r($_POST));
				
				echo 'Ville mises à jour';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Towns',addslashes_r($_POST));
			echo 'La ville a bien été supprimé';
		}
		
		if (request_confirm('End_Add'))
		{
			if(valid_post_db('Caranille_Towns'))// (request_confirm('Town_Image') && ($_POST['Town_Name']) && ($_POST['Town_Description']) && ($_POST['Town_Chapter']))
			{
				insert_db('Caranille_Towns',addslashes_r($_POST));
			
				echo 'Ville ajoutée';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
	}

?>
