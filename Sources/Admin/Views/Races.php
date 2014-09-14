
<?php
	if(verif_access("Admin"))
	{
	
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des pages du MMORPG<br /><br />';
			
			list_html_db('Caranille_Races','Races',array('Race_Description','Race_Name'));
			
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Race_ID = request_data('Race_ID');

			$Race_r = get_db("edit_admin",array(
				'table' => 'Caranille_Races' ,
				'ID' => 'Race_ID',
				'value' => $Race_ID
			));
			
			formulaire($Race_r);
		}
		else
		if (request_confirm('Second_Delete'))
		{
			$Race_ID = request_data('Race_ID');
?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Races","Admin") ?>">
				<input type="hidden" name="Race_ID" value="<?php echo $Race_ID ?>"/>
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
			echo '<form method="POST" action="'.get_link("Races","Admin").'">';
			echo '<input type="submit" name="Edit" value="Modifier une Race">';
			echo '</form>';
		}
		
		if(isset($message) && $message !=="")
		{
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link("Races","Admin") ?>">
			<input type="hidden" name="Race_ID" value="<?php echo $Race_ID ?>"/>
			<input type="submit" name="Second_Edit" value="modifier"/>
			<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
<?php
		}
	}