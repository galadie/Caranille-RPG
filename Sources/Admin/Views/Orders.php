<?php

    if(verif_access("Admin"))
	{
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des ordres du MMORPG<br /><br />';
			$Orders_List = list_db("exclude_list_t",array(
						'table' => 'Caranille_Orders' ,
						'ID' => 'Order_Name',
						'value' => 'Neutre'

			));
						
				echo '<table class="Admin list">' ;
				echo '<tr>' ;
				echo '<th>Nom</th>';
				echo '<th>Desc</th>';
				echo '<th></th>';
				echo '</tr>' ;
				
			foreach($Orders_List as $Orders)
			{
				$Order_ID = stripslashes($Orders['Order_ID']);
				
				echo '<tr>' ;
				echo '<td>' .stripslashes($Orders['Order_Name'])."</td>";
				echo '<td>' .stripslashes($Orders['Order_Description'])."</td>";
				echo '<td><form method="POST" action="'.get_link("Orders","Admin").'">';
				echo "<input type=\"hidden\" name=\"Order_ID\" value=\"$Order_ID\">";
				echo '<input type="submit" name="Second_Edit" value="Modifier l\'Ordre">';
				//echo '<input type="submit" name="Second_Delete" value="supprimer">';
				echo '</form></td>';
				echo '</tr>' ;
			}
				echo '</table>' ;
			

		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Order_ID = $_POST['Order_ID'];
			$Order = get_db("edit_admin",array(
				'table' => 'Caranille_Orders' ,
				'ID' => 'Order_ID',
				'value' => $Order_ID
			));
			
			if(!empty($Order))
			{
    			echo '<form method="POST" action="'.get_link("Orders","Admin").'">';
    			echo forumulaire_db('Caranille_Orders',$Order);
    			echo '<input type="submit" name="End_Edit" value="Terminer"/>';
    			echo '</form>';
			}
		}
		else
		//if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && empty($_POST['Add']) && empty($_POST['End_Add']))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Orders","Admin").'">';
			echo '<input type="submit" name="Edit" value="Modifier un Ordre">';
			echo '</form>';
		}
	}