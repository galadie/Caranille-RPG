
<?php
	if(verif_access("Admin"))
	{
	
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des pages du MMORPG<br /><br />';
			
			list_html_db('Caranille_Ressources','Ressources',array('Ressource_Description','Ressource_Name'));
			
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Ressource_ID = request_data('Ressource_ID');

			$Ressource_r = get_db("edit_admin",array(
				'table' => 'Caranille_Ressources' ,
				'ID' => 'Ressource_ID',
				'value' => $Ressource_ID
			));
			
			formulaire($Ressource_r);
		}
		else
		if (request_confirm('Second_Delete'))
		{
			$Ressource_ID = request_data('Ressource_ID');
?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Ressources","Admin") ?>">
				<input type="hidden" name="Ressource_ID" value="<?php echo $Ressource_ID ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
		else
		if (request_confirm('Add'))
		{
			formulaire();
		}
		else
		//if (empty($_POST['Edit']) && empty($_POST['Add']) && empty($_POST['Second_Add']) && empty($_POST['Second_Edit']) && empty($_POST['End_Edit']) && (empty($_POST['Delete'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Ressources","Admin").'">';
			echo '<input type="submit" name="Edit" value="Modifier une Ressource">';
			echo '</form>';
		}
		
		if(isset($message) && $message !=="")
		{
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link("Ressources","Admin") ?>">
			<input type="hidden" name="Ressource_ID" value="<?php echo $Ressource_ID ?>"/>
			<input type="submit" name="Second_Edit" value="modifier"/>
			<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
<?php
		}
	}