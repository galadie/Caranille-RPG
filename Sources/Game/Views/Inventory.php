<?php
	function inventory_menu()
	{
		global $array_accessory_type;
		
            echo '<div class="inventory-menu" >';
		    echo '<form method="POST" action="'.get_link('Inventory','Game').'">';
            foreach($array_accessory_type as $type)
    			echo '<input type="submit" name="'.$type.'" value="'.LanguageValidation::nMsg("btn.inventory.$type").'"/>'.LanguageValidation::eMsg("btn.inventory.$type");//value="'.$type.'">';
    		echo '<input type="submit" name="Weapon" value="'.LanguageValidation::nMsg("btn.inventory.weapon").'"/>'.LanguageValidation::eMsg("btn.inventory.weapon");//Armes">';
			echo '</form>';
			echo '</div>';	
			echo '<div class="inventory-list" >';
	}
	
	function inventory_weapon_menu()
	{
		global $array_weapon_type;
		
            echo '<div class="inventory-menu" >';
		    echo '<form method="POST" action="'.get_link('Inventory','Game').'">';
            foreach($array_weapon_type as $type)
    			echo '<input type="submit" name="'.$type.'" value="'.LanguageValidation::nMsg("btn.inventory.$type").'"/>'.LanguageValidation::eMsg("btn.inventory.$type");//value="'.$type.'">';
			echo '</form>';
			echo '</div>';	
			echo '<div class="inventory-list" >';
	}
	
	function inventory_menu_2()
	{
		global $array_inventory_2_type;
		
 			echo '</div>';			    
           echo '<div class="inventory-menu" >';
		    echo '<form method="POST" action="'.get_link('Inventory','Game').'">';
            foreach($array_inventory_2_type as $type)
    			echo '<input type="submit" name="'.$type.'" value="'.LanguageValidation::nMsg("btn.inventory.$type").'"/>'.LanguageValidation::eMsg("btn.inventory.$type");//value="'.$type.'">';
			echo '</form>';
			echo '</div>';			    
	}
	
	if(verif_connect())
	{
		get_ocedar();
		menu_character();
		inventory_menu();

		if (empty($_POST))//['Armor']) && empty($_POST['Boots']) && empty($_POST['Gloves']) && empty($_POST['Helmet']) && empty($_POST['Weapon']) && empty($_POST['Invocation']) && empty($_POST['Magic']) && empty($_POST['Item']) && empty($_POST['Parchment']) && empty($_POST['Item_Equip']) && empty($_POST['Item_Desequip']) && empty($_POST['Sale']))
		{
			echo LanguageValidation::iMsg("intro.game.inventory");
			echo '<br /><br />';
			echo LanguageValidation::iMsg("label.inventory.choose");
		}

		//inventory_weapon_menu()
		// affichage dans l'inventaire
		
		// d'abords, on definit quel type d'item il faut chercher.
        if (request_confirm('Armor')) {$type ='Armor'; $_type_name ="armures" ;$type_use="Item_Equip";$type_action="S'equiper";}
    elseif (request_confirm('Pants')) {$type ='Pants';$_type_name ="Cuissardes" ;$type_use="Item_Equip";$type_action="S'equiper"; }
    elseif (request_confirm('Boots')) {$type ='Boots';$_type_name ="bottes" ;$type_use="Item_Equip";$type_action="S'equiper"; }
    elseif (request_confirm('Gloves')) {$type ='Gloves';$_type_name ="gants" ;$type_use="Item_Equip";$type_action="S'equiper"; }
    elseif (request_confirm('Helmet')){$type ='Helmet'; $_type_name ="casques" ;$type_use="Item_Equip";$type_action="S'equiper";}
    elseif (request_confirm('Weapon')) {$type =implode("','",$array_weapon_type); $_type_name ="armes" ;$type_use="Item_Equip";$type_action="S'equiper";}
    elseif (request_confirm('Item')){$type =implode("','",$array_items_type); $_type_name ="objets" ;$type_use=null;$type_action=null;}
    elseif (request_confirm('Parchment')){$type ='Parchment'; $_type_name ="parchemins" ;$type_use="Use";$type_action="Utiliser";}
    else $type = null ;
    
        // Si le type n'est pas null, on n'a qu'une seule boucle au lieu de sept. le contenu est le meme sauf pour l'affichage du nom de la rubrique.

    	if (!is_null($type))
    	{
    		echo 'Voici vos '.$_type_name.'<br /><br />';
    		echo '<table class="inventory">';
    		echo '<tr>';
    
    		echo '<th>'.LanguageValidation::iMsg("label.inventory.name").'</th>';
     		echo '<th>'.LanguageValidation::iMsg("label.inventory.image").'</th>';
			echo '<th>'.LanguageValidation::iMsg("label.inventory.quantite").'</th>';
    		echo '<th>'.LanguageValidation::iMsg("label.inventory.price").'</th>';
    		echo '<th>'.LanguageValidation::iMsg("label.inventory.action").'</th>';
    
    		echo '</tr>';
			
    		$Item_Query = list_db('list_inventaire_type', array('type'=>$type, 'Account_ID' =>user_data('Account_ID') ));
			
			if(!empty($Item_Query))
			{
				foreach ($Item_Query as $Item)
				{
					extract(stripslashes_r($Item));
					
					$desc = $Item_Description."\r\n\r\n";
					
					$desc .= ''.LanguageValidation::iMsg("label.level.required").' : ' .$Item_Level_Required."\r\n\r\n";
					
					foreach($array_character_type as $char)
						$desc .= '+' .eval("if(isset(\$Item_".$char."_Effect))return \$Item_".$char."_Effect ;"). ' '.LanguageValidation::iMsg("label.".strtolower($char).".card").''."\r\n";//<br />';
/**
					$desc .= '+' .$Item_HP_Effect. ' HP'."\r\n";//<br />';
					$desc .= '+' .$Item_MP_Effect. ' MP'."\r\n";//<br />';
					$desc .= '+' .$Item_Strength_Effect. ' Force'."\r\n";//<br />';
					$desc .= '+' .$Item_Magic_Effect. ' Magie'."\r\n";//<br />';
					$desc .= '+' .$Item_Agility_Effect. ' Agilité'."\r\n";//<br />';
					$desc .= '+' .$Item_Defense_Effect. ' Defense'."\r\n";//';
**/				
					echo "<tr>";
					echo '<td>' .$Item_Name. '</td>'; // title=""
					echo "<td><a class='infobulle' href='#'>";
					echo "<img title='".$Item['Image_Name']."' height='50px' src='data:".$Item['Image_Type'].";base64,".$Item['Image_Base64']."' />";
					echo '<span>'.nl2br($desc).'</span></a>';
					echo "</td>";
					echo '<td>' .$Inventory_Item_Quantity. '</td>';
					echo '<td>' .render_money($Item_Sale_Price). '</td>';

					echo '<td>';
					echo '<form method="POST" action="'.get_link('Inventory','Game').'">';
					echo '<input type="hidden" name="'.$Item_Type.'" value="'.$Item_Type.'">';
					echo "<input type=\"hidden\" name=\"Inventory_ID\" value=\"$Inventory_ID\">";
					echo "<input type=\"hidden\" name=\"Item_ID\" value=\"$Item_ID\">";
					
					if (user_data('Level_Number') >= $Item_Level_Required)
					{
						if(!is_null($type_use)&& $type_use!='Item_Equip')
							echo '<input type="submit" name="'.$type_use.'" value="'.LanguageValidation::nMsg("btn.inventory.$type_use").'"/>'.LanguageValidation::eMsg("btn.inventory.$type_use");//'.$type_action.'">';
							
						if($type_use=='Item_Equip' && equipement($Item['Item_Type']) === $Item_Name)
							echo '<input type="submit" name="Item_Desequip" value="'.LanguageValidation::nMsg("btn.inventory.Item_retire").'"/>'.LanguageValidation::eMsg("btn.inventory.Item_retire");//Retirer">';
						else
							echo '<input type="submit" name="'.$type_use.'" value="'.LanguageValidation::nMsg("btn.inventory.$type_use").'"/>'.LanguageValidation::eMsg("btn.inventory.$type_use");//'.$type_action.'">';
					}			
					echo '<input type="submit" name="Sale" value="'.LanguageValidation::nMsg("btn.inventory.Item_sell").'"/>'.LanguageValidation::eMsg("btn.inventory.Item_sell");//Vendre"><br /><br />';
					echo '</form>';
					echo '</td>';
					echo '</tr>';
				}
			}
			echo '</table>';
		
    	}

        // à parti d'ici, on revient au script initiale.
		if (request_confirm('Magic'))
		{
    		$Magics = list_db('list_inventaire_magic', array('Account_ID' =>user_data('Account_ID') ));

			echo 'Voici vos magies<br /><br />';
			echo '<table>';
				echo '<tr>';
					echo '<th>'.LanguageValidation::iMsg("label.inventory.name").'</th>';
					echo '<th>'.LanguageValidation::iMsg("label.inventory.image").'</th>';
					echo '<th>'.LanguageValidation::iMsg("label.inventory.description").'</th>';
					echo '<th>Type</th>';
					echo '<th>Effet</th>';
				echo '</tr>';
			
			if(!empty($Magics))
			{
				foreach($Magics as $Magic)
				{
					echo '<tr>';
						echo '<td>' .$Magic['Magic_Name']. '</td>';
						echo "<td><img title='".$Magic['Image_Name']."' height='50px' src='data:".$Magic['Image_Type'].";base64,".$Magic['Image_Base64']."' /></td>";
						echo '<td>' .$Magic['Magic_Description']. '</td>';
						echo '<td>' .$Magic['Magic_Type']. '</td>';
						echo '<td>' .$Magic['Magic_Effect']. '</td>';
					echo '</tr>';
				}
			}
			echo '</table>';
		
		}
		if (request_confirm('Invocation'))
		{
			echo 'Voici vos chimères<br /><br />';
			echo '<table>';
				echo '<tr>';
					echo '<th>'.LanguageValidation::iMsg("label.inventory.name").'</th>';
					echo '<th>'.LanguageValidation::iMsg("label.inventory.image").'</th>';
					echo '<th>'.LanguageValidation::iMsg("label.inventory.description").'</th>';
					echo '<th>Effet</th>';
				echo '</tr>';
						
    		$Invocations = list_db('list_inventaire_chimere', array('Account_ID' =>user_data('Account_ID') ));
			
			if(!empty($Invocations))
			{
				foreach($Invocations as $Invocation)
				{
					echo '<tr><td>' .$Invocation['Invocation_Name']. '</td>';
						echo "<td><img title='".$Invocation['Image_Name']."' height='50px' src='data:".$Invocation['Image_Type'].";base64,".$Invocation['Image_Base64']."' /></td>";
						echo '<td>' .$Invocation['Invocation_Description']. '</td>';
						echo '<td>' .$Invocation['Invocation_Damage']. '</td>';
					echo '</tr>';
				}
			}
			echo '</table>';
		}

if(request_confirm('Ress'))
		{
    		echo 'Voici vos Fragments<br /><br />';
    		echo '<table class="inventory">';
    		echo '<tr>';
    
    		echo '<th>'.LanguageValidation::iMsg("label.inventory.name").'</th>';
     		echo '<th>'.LanguageValidation::iMsg("label.inventory.image").'</th>';
			echo '<th>'.LanguageValidation::iMsg("label.inventory.quantite").'</th>';
    		echo '<th>'.LanguageValidation::iMsg("label.inventory.price").'</th>';
    		echo '<th>'.LanguageValidation::iMsg("label.inventory.action").'</th>';
    
    		echo '</tr>';
			
    		$Ressource_Query = list_db('list_inventaire_ressource', array('Account_ID' =>user_data('Account_ID') ));
			
			
			if(!empty($Ressource_Query))
			{
				foreach ($Ressource_Query as $Ressource)
				{
					extract(stripslashes_r($Ressource));
					
					$desc = $Ressource_Description."\r\n\r\n";
					
					$desc .= ''.LanguageValidation::iMsg("label.level.required").' : ' .$Ressource_Level_Required."\r\n\r\n";
					
					foreach($array_character_type as $char)
						$desc .= '+' .eval("return \$Fragment_".$char."_Effect ;"). ' '.LanguageValidation::iMsg("label.".strtolower($char).".card").''."\r\n";//<br />';

/**					
					$desc .= '+' .$Fragment_HP_Effect. ' HP'."\r\n";//<br />';
					$desc .= '+' .$Fragment_MP_Effect. ' MP'."\r\n";//<br />';
					$desc .= '+' .$Fragment_Strength_Effect. ' Force'."\r\n";//<br />';
					$desc .= '+' .$Fragment_Magic_Effect. ' Magie'."\r\n";//<br />';
					$desc .= '+' .$Fragment_Agility_Effect. ' Agilité'."\r\n";//<br />';
					$desc .= '+' .$Fragment_Defense_Effect. ' Defense'."\r\n";//';
**/				
					echo "<tr>";
					echo '<td>' .$Ressource_Name. '</td>'; // title=""
					echo "<td><a class='infobulle' href='#'>";
					echo "<img title='".$Ressource['Image_Name']."' height='50px' src='data:".$Ressource['Image_Type'].";base64,".$Ressource['Image_Base64']."' />";
					echo '<span>'.nl2br($desc).'</span></a>';
					echo "</td>";
					echo '<td>' .$Inventory_Ressource_Quantity. '</td>';
					echo '<td>' .render_money($Ressource_Sale_Price). '</td>';

					echo '<td>';
					echo '<form method="POST" action="'.get_link('Inventory','Game').'">';
					echo "<input type=\"hidden\" name=\"Inventory_ID\" value=\"$Inventory_ID\">";
					echo "<input type=\"hidden\" name=\"Item_ID\" value=\"$Item_ID\">";		
					echo '<input type="submit" name="Sale" value="'.LanguageValidation::nMsg("btn.inventory.Item_sell").'"/>'.LanguageValidation::eMsg("btn.inventory.Item_sell");//Vendre"><br /><br />';
					echo '</form>';
					echo '</td>';
					echo '</tr>';
				}
			}
			echo '</table>';
		}

		if (request_confirm('Craft'))
    	{
    		echo 'Voici vos Fragments<br /><br />';
    		echo '<table class="inventory">';
    		echo '<tr>';
    
    		echo '<th>'.LanguageValidation::iMsg("label.inventory.name").'</th>';
     		echo '<th>'.LanguageValidation::iMsg("label.inventory.image").'</th>';
			echo '<th>'.LanguageValidation::iMsg("label.inventory.quantite").'</th>';
    		echo '<th>'.LanguageValidation::iMsg("label.inventory.price").'</th>';
    		echo '<th>'.LanguageValidation::iMsg("label.inventory.action").'</th>';
    
    		echo '</tr>';
			
    		$Fragment_Query = list_db('list_inventaire_fragment', array('Account_ID' =>user_data('Account_ID') ));
			
			
			if(!empty($Fragment_Query))
			{
				foreach ($Fragment_Query as $Fragment)
				{
					extract(stripslashes_r($Fragment));
					
					$desc = $Fragment_Description."\r\n\r\n";
					
					$desc .= ''.LanguageValidation::iMsg("label.level.required").' : ' .$Fragment_Level_Required."\r\n\r\n";
					
					foreach($array_character_type as $char)
						$desc .= '+' .eval("return \$Fragment_".$char."_Effect ;"). ' '.LanguageValidation::iMsg("label.".strtolower($char).".card").''."\r\n";//<br />';

/**					
					$desc .= '+' .$Fragment_HP_Effect. ' HP'."\r\n";//<br />';
					$desc .= '+' .$Fragment_MP_Effect. ' MP'."\r\n";//<br />';
					$desc .= '+' .$Fragment_Strength_Effect. ' Force'."\r\n";//<br />';
					$desc .= '+' .$Fragment_Magic_Effect. ' Magie'."\r\n";//<br />';
					$desc .= '+' .$Fragment_Agility_Effect. ' Agilité'."\r\n";//<br />';
					$desc .= '+' .$Fragment_Defense_Effect. ' Defense'."\r\n";//';
**/				
					echo "<tr>";
					echo '<td>' .$Fragment_Name. '</td>'; // title=""
					echo "<td><a class='infobulle' href='#'>";
					echo "<img title='".$Fragment['Image_Name']."' height='50px' src='data:".$Fragment['Image_Type'].";base64,".$Fragment['Image_Base64']."' />";
					echo '<span>'.nl2br($desc).'</span></a>';
					echo "</td>";
					echo '<td>' .$Inventory_Fragment_Quantity. '</td>';
					echo '<td>' .render_money($Fragment_Sale_Price). '</td>';

					echo '<td>';
					echo '<form method="POST" action="'.get_link('Inventory','Game').'">';
					echo "<input type=\"hidden\" name=\"Inventory_ID\" value=\"$Inventory_ID\">";
					echo "<input type=\"hidden\" name=\"Item_ID\" value=\"$Item_ID\">";		
					echo '<input type="submit" name="Sale" value="'.LanguageValidation::nMsg("btn.inventory.Item_sell").'"/>'.LanguageValidation::eMsg("btn.inventory.Item_sell");//Vendre"><br /><br />';
					echo '</form>';
					echo '</td>';
					echo '</tr>';
				}
			}
			echo '</table>';
		
    	}

		inventory_menu_2();
	}