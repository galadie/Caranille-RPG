<?php
	
	if(verif_access("Admin"))
	{
		load_css('map.css','map');
		if(!function_exists('get_formulaire_Landing'))
		{
			function get_formulaire_Landing($Landings = array())
			{
				global $rayon_city , $array_landing_type , $_path ;
				
					extract(stripslashes_r($Landings));
	?>				
					<form method="POST" action="<?php echo get_link("Landing","Admin") ?>">
					<table>
									<tr><th colspan="2">Coordonnées de la terrain</th></tr>
					<tr><td><?php
										echo line_db("Caranille_Landings","Landing_PosX",(isset( $Landing_PosX) ?  $Landing_PosX : $_POST['PosX']));
										echo line_db("Caranille_Landings","Landing_PosY",(isset( $Landing_PosX) ?  $Landing_PosY : $_POST['PosY']));
										echo line_db("Caranille_Landings","Landing_Type",(isset( $Landing_Type) ?  $Landing_Type : 0 ));
					?></td></tr>
					
				<tr><td class="none" colspan="2">
					<input type="hidden" name="Landing_ID" value="<?php echo (isset($Landing_ID) ? $Landing_ID: '')?>"/>
					<input type="submit" name="Back" value="Annuler" />
					<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer">
					<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
				</td></tr>
					</table>
					</form>		
	<?php
			}
		}
		
		
		if (request_confirm('End_Edit'))
		{
			if(valid_post_db('Caranille_Landings'))// (request_confirm('Landing_Image') && ($_POST['Landing_Name']) && ($_POST['Landing_Description']) && ($_POST['Landing_Chapter']))
			{
				update_db('Caranille_Landings',addslashes_r($_POST));
				
				echo 'terrain mises à jour';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Landings',$_POST);
			echo 'La terrain a bien été supprimé';
		}
		
		if (request_confirm('End_Add'))
		{
			if(valid_post_db('Caranille_Landings'))// (request_confirm('Landing_Image') && ($_POST['Landing_Name']) && ($_POST['Landing_Description']) && ($_POST['Landing_Chapter']))
			{
				insert_db('Caranille_Landings',addslashes_r($_POST));
			
				echo 'terrain ajoutée';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
	}

?>
