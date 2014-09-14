<?php

	if(verif_access("Admin"))
	{	
	
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des Invocations du mmorpg<br /><br />';
			list_html_db('Caranille_Invocations','Invocations',array('Invocation_Name','Invocation_Description'));
 		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Invocation_ID = request_data('Invocation_ID');

			$Invocations = get_db("edit_admin",array(
				'table' => 'Caranille_Invocations' ,
				'ID' => 'Invocation_ID',
				'value' => $Invocation_ID
			));
			
			get_formulaire_invocation($Invocations);
		}
		else
		if (request_confirm('Second_Delete'))
		{
		    			$Invocation_ID = request_data('Invocation_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Invocations","Admin") ?>">
				<input type="hidden" name="Invocation_ID" value="<?php echo $Invocation_ID ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
		else
		if (request_confirm('Add'))
		{
			get_formulaire_invocation($Invocations_List);
		}
		else // 	if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && empty($_POST['End_Edit']) && (empty($_POST['Add'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Invocations","Admin").'">';
			echo '<input type="submit" name="Add" value="Ajouter une invocation">';
			echo '<input type="submit" name="Edit" value="Modifier une invocation">';
			echo '</form>';
		}
	}
