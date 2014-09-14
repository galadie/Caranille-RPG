<?php

	if(verif_connect())
	{
		menu_town();
		
		echo "<form method='post' action='".get_link('Craft','Game')."' >";
		
		if(request_confirm('end-craft'))
		{
			// c'est fini ...
		}
		elseif(request_confirm('choose-name'))
		{
			echo "<input type='text' name='item-name' Placeholder=\"Nom de l'item\" />";
			echo "<input type='submit' name='end-craft' value='nommer' />";
			// saisir un nom et valider les resultats
			// seulement si le craft contient les 5 element requis...
			// 3 pieces et 2 bonus 
			// sinon on invite à recommencer ou abandonner
		}
		elseif(request_confirm('select-frag'))
		{	
			echo 'Voici vos Fragments<br /><br />';
			if(!empty($Fragment_Query))
			{
				// selectionner les elements --> 5 etapes...
				echo '<table class="inventory">';
				echo '<tr>';
		
				echo '<th>Nom</th>';
				echo '<th>Image</th>';
				echo '<th>Quantité</th>';
				echo '<th>Prix de vente</th>';
				echo '<th>action</th>';
		
				echo '</tr>';
			
				foreach ($Fragment_Query as $Fragment)
				{
					extract(stripslashes_r($Fragment));
					
					$desc = $Fragment_Description."\r\n\r\n";
					
					$desc .= 'Niveau requis : ' .$Fragment_Level_Required."\r\n\r\n";
					
					$desc .= '+' .$Fragment_HP_Effect. ' HP'."\r\n";//<br />';
					$desc .= '+' .$Fragment_MP_Effect. ' MP'."\r\n";//<br />';
					$desc .= '+' .$Fragment_Strength_Effect. ' Force'."\r\n";//<br />';
					$desc .= '+' .$Fragment_Magic_Effect. ' Magie'."\r\n";//<br />';
					$desc .= '+' .$Fragment_Agility_Effect. ' Agilité'."\r\n";//<br />';
					$desc .= '+' .$Fragment_Defense_Effect. ' Defense'."\r\n";//';
				
					echo "<tr>";
					echo '<td>' .$Fragment_Name. '</td>'; // title=""
					echo "<td><a class='infobulle' href='#'>";
					echo "<img title='".$Fragment['Image_Name']."' height='50px' src='data:".$Fragment['Image_Type'].";base64,".$Fragment['Image_Base64']."' />";
					echo '<span>'.nl2br($desc).'</span></a>';
					echo "</td>";
					echo '<td>' .$Inventory_Fragment_Quantity. '</td>';
					echo '<td><div class="gain gold">' .$Fragment_Sale_Price. '</div></td>';

					echo '<td>';
					echo "<input type=\"hidden\" name=\"Inventory_ID\" value=\"$Inventory_ID\">";
					echo "<input type=\"checkbox\" name=\"item-frag\" value=\"$Item_ID\">";		
					echo '</td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			echo '<input type="submit" name="choose-name" value="Creer"><br /><br />';
		}	
		else
		{
			// selectionner un objet à fabriquer
			
			if(!empty($array_items_craft_type))
			{
				echo "<select name='item-type' >";
				foreach( $array_items_craft_type as $type_item)
				{
					echo "<option value='$type_item'>$type_item</option>";
				}
				echo "<input type='submit' name='select-frag' value='fragments' />";
			}
			
		}
		echo "</form>";
		
		if(isset($_SESSION['CRAFT']))
			print_r($_SESSION['CRAFT']);
	}
?>