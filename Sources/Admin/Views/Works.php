<?php
	if(verif_access("Admin"))
	{
	
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des pages du MMORPG<br /><br />';
			
			list_html_db('Caranille_Works','Works',array('Work_Description','Work_Name','Work_Fabrique'));
			
		}
		else
		if (request_confirm('Second_Edit'))
		{
		   	$Work_ID = request_data('Work_ID');

			$Work_List = get_db("edit_admin",array(
				'table' => 'Caranille_Works' ,
				'ID' => 'Work_ID',
				'value' => $Work_ID
			));

			formulaire($Work_List);

		}
		else
		if (request_confirm('Second_Delete'))
		{
		   	$Work_ID = request_data('Work_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Works","Admin") ?>">
				<input type="hidden" name="Work_ID" value="<?php echo $Work_ID ?>"/>
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
			echo '<form method="POST" action="'.get_link("Works","Admin").'">';
			echo '<input type="submit" name="Edit" value="Modifier une Work">';
			echo '</form>';
		}
		
		if(isset($message) && $message !=="")
		{
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link("Works","Admin") ?>">
			<input type="hidden" name="Work_ID" value="<?php echo $Work_ID ?>"/>
			<input type="submit" name="Second_Edit" value="modifier"/>
			<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
<?php
		}
	}