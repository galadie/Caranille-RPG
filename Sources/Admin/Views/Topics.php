<?php
	if(verif_access("Admin"))
	{	
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des pages du MMORPG<br /><br />';
			
			list_html_db('Caranille_Topics','Topics',array('Topic_Forum_ID','Topic_Titre'));
			
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Topic_ID = request_data('Topic_ID');

			$Topic_List = get_db("edit_admin",array(
				'table' => 'Caranille_Topics' ,
				'ID' => 'Topic_ID',
				'value' => $Topic_ID
			));
			
			formulaire($Topic_List);

		}
		else
		if (request_confirm('Second_Delete'))
		{
		    			$Topic_ID = request_data('Topic_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Topics","Admin") ?>">
				<input type="hidden" name="Topic_ID" value="<?php echo $Topic_ID ?>"/>
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
		else // 		if (empty($_POST['Edit']) && empty($_POST['Add']) && empty($_POST['Second_Add']) && empty($_POST['Second_Edit']) && empty($_POST['End_Edit']) && (empty($_POST['Delete'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Topics","Admin").'">';
			echo '<input type="submit" name="Edit" value="Modifier une Topic">';
			echo '</form>';
		}

		if(isset($message) && $message !=="")
		{
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link("Topics","Admin") ?>">
			<input type="hidden" name="Topic_ID" value="<?php echo $Topic_ID ?>"/>
			<input type="submit" name="Second_Edit" value="modifier"/>
			<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
<?php
		}
	}
