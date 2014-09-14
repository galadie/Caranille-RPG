<?php

	if(verif_access("Admin"))
	{
	
	
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des quêtes du MMORPG<br /><br />';
			list_html_db('Caranille_Quests','Quests',array('Quest_Town_ID','Quest_Number','Quest_Name','Quest_Goal'));
			
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Quest_ID = request_data('Quest_ID');

			$Quest = get_db("edit_admin",array(
				'table' => 'Caranille_Quests' ,
				'ID' => 'Quest_ID',
				'value' => $Quest_ID
			));
			
			get_formulaire($Quest);
		}
		else
		if (request_confirm('Second_Delete'))
		{
			$Quest_ID = request_data('Quest_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Quests","Admin") ?>">
				<input type="hidden" name="Quest_ID" value="<?php echo $Quest_ID ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
		else // 	if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && empty($_POST['End_Edit'])&& (empty($_POST['Add'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Quests","Admin").'">';
			echo '<input type="submit" name="Add" value="Ajouter une quête"/>';
			echo '<input type="submit" name="Edit" value="Modifier une quête"/>';
			echo '</form>';
		}

		if (request_confirm('Add'))
		{
			get_formulaire();
		}
		
	}
	
?>