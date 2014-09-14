<?php

	if(verif_access("Admin"))
	{	
		
		if (request_confirm('Edit'))
		{
			$Fragments_List = list_db("list_t",array( 'table' => "Caranille_Fragments"));

			list_html(
				$Fragments_List,
				"Caranille_Fragments",
				"Fragments",
				array(
					'Fragment_Level',
					'Fragment_Name',
					//'Fragment_Type',
					'Fragment_HP_Effect',
					'Fragment_MP_Effect',
					'Fragment_Strength_Effect',
					'Fragment_Magic_Effect',
					'Fragment_Agility_Effect',
					'Fragment_Defense_Effect'
				)
			);
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Fragment_ID = request_data('Fragment_ID');
			$Fragments = get_db("edit_admin",array(
				'table' => 'Caranille_Fragments' ,
				'ID' => 'Fragment_ID',
				'value' => $Fragment_ID
			));

			formulaire($Fragments);

		}
		else
		if (request_confirm('Second_Delete'))
		{
			$Fragment_ID = request_data('Fragment_ID');
?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Fragments","Admin") ?>">
				<input type="hidden" name="Fragment_ID" value="<?php echo $Fragment_ID ?>"/>
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
		else //if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && (empty($_POST['Add'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Fragments","Admin").'">';
			echo '<input type="submit" name="Add" value="Ajouter un Fragment">';
			echo '<input type="submit" name="Edit" value="Modifier un Fragment">';
			echo '</form>';
		}
	}