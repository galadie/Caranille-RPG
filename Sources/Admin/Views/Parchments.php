<?php

	if(verif_access("Admin"))
	{
	
		if (request_confirm('Edit'))
		{
			$Parchement_List = list_db("ref_list_t",array(
				'table' => 'Caranille_Items' ,
				'ID' => 'Item_Type',
				'ref' => "Parchment"
			));
			
			list_html(
				$Parchement_List,
				"Caranille_Items",
				"Parchments",
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

			$Parchement_List_Query = get_db("edit_admin",array(
				'table' => 'Caranille_Items' ,
				'ID' => 'Item_ID',
				'value' => $Item_ID
			));

			formulaire($Parchement_List);
		}
		else
		if (request_confirm('Add'))
		{
			formulaire();
		}
		else // 	if (empty($_POST))//['Edit']) && empty($_POST['Second_Edit']) && (empty($_POST['Add'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Parchments","Admin").'">';
			echo '<input type="submit" name="Add" value="Ajouter un parchemin">';
			echo '<input type="submit" name="Edit" value="Modifier un parchemin">';
			echo '</form>';
		}
		
	}
