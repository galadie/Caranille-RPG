<?php

	if(verif_access("Admin"))
	{	
		
		
		if (request_confirm('Edit'))
		{
            echo 'Voici la liste des Missions du MMORPG<br /><br />';
			
			list_html_db('Caranille_Missions','Missions',array('Mission_Number','Mission_Name','Mission_Description'));
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Mission_ID = request_data('Mission_ID');

			$Missions_List = get_db("edit_admin",array(
				'table' => 'Caranille_Missions' ,
				'ID' => 'Mission_ID',
				'value' => $Mission_ID
			));

			get_formulaire($Missions_List);
		}
		else
		if (request_confirm('Second_Delete'))
		{
		    			$Mission_ID = request_data('Mission_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Missions","Admin") ?>">
				<input type="hidden" name="Mission_ID" value="<?php echo $Mission_ID ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
		else
		if (request_confirm('Add'))
		{
			get_formulaire();
		}
		else
		//if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && empty($_POST['End_Edit'])&& (empty($_POST['Add'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Missions","Admin").'">';
			echo '<input type="submit" name="Add" value="Ajouter une mission">';
			echo '<input type="submit" name="Edit" value="Modifier une mission">';
			echo '</form>';
		}
	}