<?php

	if(verif_connect())
	{
		//Si le joueur est dans une ville, on regarde si il est actuellement en combat
		if (verif_battle())
		{
		    if(!has_roaster())
			{
				get_ocedar();
		    }
			else
			{
				compo_roaster();
			}
		    if ($_SESSION['Arena_Battle'] == 0)
			{
				echo "<img title='".monster_data('Image_Name')."' height='50px' src='data:".monster_data('Image_Type').";base64,".monster_data('Image_Base64')."' /><br/>";
			}
			
			if ($_SESSION['Arena_Battle'] == 1)
			{
			    get_arena_ocedar();
			}
		    			
			if (request_confirm('Continue'))
			{
				if ($end_battle) //monster_data('HP') <= 0 || user_data('Account_HP_Remaining') <= 0)
				{	
					echo $_final;
					close_battle();					
				}
				else //Si attaquer et fuir n'ont pas été choisir on affiche le menu de combat
				{
					//Si la HP du monstre est supérieur à 0 et que la HP du personnage est supérieur à zero le combat commence ou continue
					if (monster_data('HP') > 0 && user_data('Account_HP_Remaining') > 0)
					{		
						echo "Combat de " .monster_data('Name'). " Contre " .user_data('Account_Pseudo'). "<br /><br />";
						echo "HP de " .monster_data('Name'). " " .monster_data('HP'). " HP<br />";
						echo "Vos HP: " .user_data('Account_HP_Remaining'). " HP<br /><br />";
						echo '<form method="POST" action="'.get_link('Battle','Game').'">';
						echo '<input type="submit" name="Attack" value="Attaquer"/><br />';
						echo '<input type="submit" name="Magics" value="Magies"/><br />';
						echo '<input type="submit" name="Invocations" value="Invocation"/><br />';
						echo '<input type="submit" name="Items" value="Objets"/><br />';
						echo '<input type="submit" name="Escape" value="fuir"/><br />';
						echo '</form>';
					}
				}
			}
			else
			//Si l'utilisateur à choisit la fuite
			if (request_confirm('Escape'))
			{
				echo $message.'<br />';
				echo '<form method="POST" action="'.get_link("Main","Public").'">';
				echo '<input type="submit" name="End_Battle" value="continuer">';
				echo '</form>';
			}
			else if (request_confirm('Attack') || request_confirm('End_Invocations') || request_confirm('End_Items') || request_confirm('End_Magics'))
			{
				echo '<form method="POST" action="'.get_link('Battle','Battle').'">';
				echo "$message<br/><br/>";
				echo '<input type="submit" name="Continue" value="continuer"/>';
				echo '</form>';
			}
			else
			{
				echo '<form method="POST" action="'.get_link('Battle','Battle').'">';
							
				if (request_confirm('Invocations'))
				{
						$Invocations_List = list_db('list_my_chimerea',array('ID' => $ID));

						if (!empty($Invocations_List))
						{
							echo LanguageValidation::iMsg("label.choose.chimere").'<br /><br />';
							echo '<select name="Invocation" id="Invocation">';

							foreach ($Invocations_List as $inv)
							{
								$Invocation = stripslashes($inv['Invocation_Name']);
								echo "<option value=\"$Invocation\">$Invocation</option>";
							}
							echo '</select>';
							echo '<br /><br />Combien de MP souhaitez-vous utiliser pour l\'invoquer ?<br /><br />';
							echo '<input type="text" name="MP_Choice"><br /><br />';
							echo '<input type="submit" name="End_Invocations" value="invoquer">';
							
						}
						else
						{
							echo 'Vous n\'avez aucune chimère à invoquer';
						}
				}
				
				if (request_confirm('Magics'))
				{
					$List_Magics = list_db('list_my_magic',array('ID' => $ID));
						
					if (!empty($List_Magics))
					{
						echo LanguageValidation::iMsg("label.choose.magic").'<br /><br />';
						echo '<select name="Magic" ID="Magic">';
						
						foreach ($List_Magics as $Magic)
						{
							extract($Magic);
							echo "<option value=\"$Magic_Name\">$Magic_Name ($Magic_Description, $Magic_MP_Cost MP)</option>";
						}
						
						echo '</select><br /><br />';
						echo "<input type=\"hidden\" name=\"Magic_MP_Cost\" value=\"$Magic_MP_Cost\">";
						echo '<input type="submit" name="End_Magics" value="Lancer le sort"/>';
					}
					else
					{
						echo 'Vous n\'avez aucune magie à invoquer';
					}
				}
				
				if (request_confirm('Items'))
				{
						$Items = list_db('list_my_items',array('type_list' => implode("','",$array_items_shop_type) ,'ID' => $ID));

						if (!empty($Items))
						{
							foreach($items as $it)
								$_items[ $it['Item_Type'] ][] = $it;
							
							echo '<form method="POST" action="'.get_link('Battle','Game').'">';
							echo 'Quel objet souhaitez-vous utiliser ?<br /><br />';
							echo '<select name="objet" id="objet">';
							
							foreach($_items as $group => $list)
							{
								echo '<optgroup label="'.$group.'">';
								
								foreach($list as $Item_List)
								{
									$Inventory_ID = stripslashes($Item_List['Inventory_ID']);
									$Item = stripslashes($Item_List['Item_Name']);
									$Item_Quantity = stripslashes($Item_List['Item_Quantity']);
									$Item_HP_Effect = stripslashes($Item_List['Item_HP_Effect']);
									echo "<option value=\"$Item\">$Item (+$Item_HP_Effect HP)</option>";
								}

								echo '</optgroup>';
							}
						
							echo '</select>';
										
							if ($HP_Item >= 1 || $MP_Item >= 1 || $HP_Item >= 1 || $MP_Item >= 1)
							{
								echo "<br /><br /><input type=\"hidden\" name=\"Item_Quantity\" value=\"$Item_Quantity\">"; 
								echo '<br /><br /><input type="submit" name="objets_fin_combat" value="Utiliser">';
							}
						}
						else
						{
							echo 'Vous n\'avez aucun objet à utiliser';
						}
				}				
				
				echo '<input type="submit" name="Cancel" value="Annuler"><br />';
				echo '</form>';
			}
		}
	}