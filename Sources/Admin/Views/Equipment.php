<?php

if(verif_access("Admin"))
	{

		if (request_confirm('Edit'))
		{			
			$Equipment_List = list_db("ref_list_t",array(
				'table' => 'Caranille_Items' ,
				'ID' => 'Item_Type',
				'ref' => implode("','",$array_accessory_type)
			));
			
			list_html(
				$Equipment_List,
				"Caranille_Items",
				"Equipment",
				array(
					'Item_Level',
					'Item_Name',
					'Item_Type',
					'Item_HP_Effect',
					'Item_MP_Effect',
					'Item_Strength_Effect',
					'Item_Magic_Effect',
					'Item_Agility_Effect',
					'Item_Defense_Effect'
				)
			);
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Item_ID = request_data('Item_ID');

			$Equipment = get_db("edit_admin",array(
				'table' => 'Caranille_Items' ,
				'ID' => 'Item_ID',
				'value' => $Item_ID
			));
			
			get_formulaire($Equipment);
		}
		else
		if (request_confirm('Add'))
		{
			get_formulaire();
		}
		else
		if (request_confirm('Second_Delete'))
		{
		    			$Item_ID = request_data('Item_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Equipment","Admin") ?>">
				<input type="hidden" name="Item_ID" value="<?php echo $Item_ID ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
		else
		//		if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && (empty($_POST['Add'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Equipment","Admin").'">';
			echo '<input type="submit" name="Add" value="Ajouter un équipement">';
			echo '<input type="submit" name="Edit" value="Modifier un équipement">';
			echo '</form>';
		}
	}	
?>