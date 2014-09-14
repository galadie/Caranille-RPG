<?php
	if(verif_access("Admin"))
	{
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des pages du MMORPG<br /><br />';
			
			list_html_db('Caranille_Categories','Categories',array('Cat_Ordre','Cat_Nom'));
			
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Cat_ID = request_data('Cat_ID');

			$Category_List = get_db("edit_admin",array(
				'table' => 'Caranille_Categories' ,
				'ID' => 'Cat_ID',
				'value' => $Cat_ID
			));
			
			formulaire($Category_List);

		}
		else
		if (request_confirm('Second_Delete'))
		{
		    			$Cat_ID = request_data('Cat_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Categories","Admin") ?>">
				<input type="hidden" name="Cat_ID" value="<?php echo $Cat_ID ?>"/>
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
				if (empty($_POST['Edit']) && empty($_POST['Add']) && empty($_POST['Second_Add']) && empty($_POST['Second_Edit']) && empty($_POST['End_Edit']) && (empty($_POST['Delete'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Categories","Admin").'">';
			echo '<input type="submit" name="Edit" value="Modifier une Category">';
			echo '</form>';
		}

		if(isset($message) && $message !=="")
		{
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link("Categories","Admin") ?>">
			<input type="hidden" name="Cat_ID" value="<?php echo $Cat_ID ?>"/>
			<input type="submit" name="Second_Edit" value="modifier"/>
			<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
<?php
		}
	}