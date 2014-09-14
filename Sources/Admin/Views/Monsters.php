<?php
	if(verif_access("Admin"))
	{
		
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des Monsters du MMORPG<br /><br />';
			
			list_html_db('Caranille_Monsters','Monsters',array('Monster_Name','Monster_Level','Monster_Access'));
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Monster_ID = request_data('Monster_ID');

			$Monsters = get_db("edit_admin",array(
				'table' => 'Caranille_Monsters' ,
				'ID' => 'Monster_ID',
				'value' => $Monster_ID
			));
			
			get_formulaire($Monsters);
		}
		else
        if (request_confirm('Second_Delete'))
		{
		    			$Monster_ID = request_data('Monster_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Monsters","Admin") ?>">
				<input type="hidden" name="Monster_ID" value="<?php echo $Monster_ID ?>"/>
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
		//if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && (empty($_POST['Add'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Monsters","Admin").'">';
			echo '<input type="submit" name="Add" value="Ajouter un monstre">';
			echo '<input type="submit" name="Edit" value="Modifier un monstre">';
			echo '</form>';
		}
	}
