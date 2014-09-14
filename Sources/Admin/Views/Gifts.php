<?php
	if(verif_access("Admin"))
	{
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des Gifts du MMORPG<br /><br />';
			
			list_html_db('Caranille_Gifts','Gifts',array('Gift_Code','Gift_Used','Gift_Item'));
			
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Gift_ID = request_data('Gift_ID');

			$Gift_List = get_db("edit_admin",array(
				'table' => 'Caranille_Gifts' ,
				'ID' => 'Gift_ID',
				'value' => $Gift_ID
			));
			
			formulaire($Gift_List);

		}
		else
		if (request_confirm('Second_Delete'))
		{
		    			$Gift_ID = request_data('Gift_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Gifts","Admin") ?>">
				<input type="hidden" name="Gift_ID" value="<?php echo $Gift_ID ?>"/>
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
		else // if (empty($_POST['Edit']) && empty($_POST['Add']) && empty($_POST['Second_Add']) && empty($_POST['Second_Edit']) && empty($_POST['End_Edit']) && (empty($_POST['Delete'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Gifts","Admin").'">';
			echo '<input type="submit" name="Edit" value="Modifier une Gift">';
			echo '</form>';
		}
		
		if(isset($message) && $message !=="")
		{
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link("Gifts","Admin") ?>">
			<input type="hidden" name="Gift_ID" value="<?php echo $Gift_ID ?>"/>
			<input type="submit" name="Second_Edit" value="modifier"/>
			<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
<?php
		}
	}
?>