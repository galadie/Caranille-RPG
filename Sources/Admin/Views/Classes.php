<?php
	if(verif_access("Admin"))
	{
	
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des pages du MMORPG<br /><br />';
			
			list_html_db('Caranille_Classes','Classes',array('Classe_Description','Classe_Name'));
			
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Classe_ID = request_data('Classe_ID');

			$Classe_r = get_db("edit_admin",array(
				'table' => 'Caranille_Classes' ,
				'ID' => 'Classe_ID',
				'value' => $Classe_ID
			));
			
			formulaire($Classe_r);

		}
		else
		if (request_confirm('Second_Delete'))
		{
		    			$Classe_ID = request_data('Classe_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Classes","Admin") ?>">
				<input type="hidden" name="Classe_ID" value="<?php echo $Classe_ID ?>"/>
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
			echo '<form method="POST" action="'.get_link("Classes","Admin").'">';
			echo '<input type="submit" name="Edit" value="Modifier une Classe">';
			echo '</form>';
		}
		
		if(isset($message) && $message !=="")
		{
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link("Classes","Admin") ?>">
			<input type="hidden" name="Classe_ID" value="<?php echo $Classe_ID ?>"/>
			<input type="submit" name="Second_Edit" value="modifier"/>
			<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
<?php
		}
	}