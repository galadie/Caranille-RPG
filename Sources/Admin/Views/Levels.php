<?php
if(verif_access("Admin"))
	{
		
		if (request_confirm('Choose_Curve'))
		{
			$confs = list_db("config_curve");
			
			foreach($confs as $c)
				$curve[$c['Configuration_Name']] = $c['Configuration_Value'];
			?>
			Veuillez choisir la courbe d'experience pour les personnages ainsi que les guildes
			<form method="POST" action="<?php echo get_link("Levels","Admin") ?>">
			<?php	foreach($array_character_type as $type) { ?>
			Gain de {<?php echo $type ?>} par niveau: <br /> <input type="text" value="<?php echo $curve['curve-'.$type] ?>" name="<?php echo $type ?>_Level"><br /><br />
			<?php } ?>
			Experience demandé en plus par niveau: <br /> <input value="<?php echo $curve['curve-Experience'] ?>" type="text" name="Experience_Level"><br /><br />
			<input type="submit" name="Set_Curve" value="Modifier la courbe">
			</form>
			<?php
		}		
		else
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des niveaux du mmorpg<br /><br />';
			list_html_db('Caranille_Levels','Levels',array(
			    'Level_Number','Level_Experience_Required','Level_HP','Level_MP','Level_Strength','Level_Magic','Level_Agility','Level_Defense'
		   ));
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Level_ID = request_data('Level_ID');

			$Level = get_db("edit_admin",array(
				'table' => 'Caranille_Levels' ,
				'ID' => 'Level_ID',
				'value' => $Level_ID
			));
			
			get_formulaire_Level($Level);

		}
		else
		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Levels'))// (request_confirm('Level_Number') )
			{
				update_db('Caranille_Levels',addslashes_r($_POST));

				$message = 'niveau mis à jour';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}
		}
		else
		if (request_confirm('Second_Delete'))
		{
		    			$Level_ID = request_data('Level_ID');

?>
				<p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Levels","Admin") ?>">
				<input type="hidden" name="Level_ID" value="<?php echo $Level_ID ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
		else
		if (request_confirm('Add'))
		{
			get_formulaire_Level();
		}		
		else
		if(empty($_POST) || request_confirm('Back'))//if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && (empty($_POST['Add'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Levels","Admin").'">';
			echo '<input type="submit" name="Add" value="Ajouter un niveau">';
			echo '<input type="submit" name="Edit" value="Modifier un niveau">';
			echo '<input type="submit" name="Choose_Curve" value="Modifier la courbe">';
			echo '<br/><br/>Nouveaux levels';
			echo '<input type="number" name="count_level" value="0">';
			echo '<input type="submit" name="Auto_Add" value="Ajouter automatiquement">';
			echo '</form>';
		}
		
		if(isset($message) && $message !=="")
		{
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link("Levels","Admin") ?>">
			<input type="hidden" name="Level_ID" value="<?php echo $Level_ID ?>"/>
			<input type="submit" name="Second_Edit" value="modifier"/>
			<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
<?php
		}
	}