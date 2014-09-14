<?php

	if(verif_access("Admin"))
	{
		
	
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des pages du MMORPG<br /><br />';
			
			list_html_db('Caranille_Forums','Forums',array('Forum_Cat_ID','Forum_Name','Forum_Guild_ID','Forum_Ordre'));
			
		}
		if (request_confirm('Second_Edit'))
		{
			$Forum_ID = request_data('Forum_ID');

			$Forum_List = get_db("edit_admin",array(
				'table' => 'Caranille_Forums' ,
				'ID' => 'Forum_ID',
				'value' => $Forum_ID
			));
			
			formulaire($Forum_List);

		}
        else
		if (request_confirm('Second_Delete'))
		{
		    			$Forum_ID = request_data('Forum_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Forums","Admin") ?>">
				<input type="hidden" name="Forum_ID" value="<?php echo $Forum_ID ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
		if (request_confirm('Add'))
		{
			formulaire();
		}	
		else //	if (empty($_POST['Edit']) && empty($_POST['Add']) && empty($_POST['Second_Add']) && empty($_POST['Second_Edit']) && empty($_POST['End_Edit']) && (empty($_POST['Delete'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Forums","Admin").'">';
			echo '<input type="submit" name="Edit" value="Modifier une Forum">';
			echo '</form>';
		}
		
		if(isset($message) && $message !=="")
		{
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link("Forums","Admin") ?>">
			<input type="hidden" name="Forum_ID" value="<?php echo $Forum_ID ?>"/>
			<input type="submit" name="Second_Edit" value="modifier"/>
			<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
<?php
		}
	}
