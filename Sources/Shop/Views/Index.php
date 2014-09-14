<?php

	if(verif_connect()) 
	{
		if (verif_town())
		{
			if (request_confirm('Buy'))
			{
				echo $return;
			}
			else //if (empty($_POST['Buy']))
			{				
				menu_town();
				
				$Armor_Query = list_db($request_indice,$request_params);
										
				echo '<table class="newsboard" >';
				
				if(strtolower($page) !== "accessory" && strtolower($page) !== "item" && strtolower($page) !== "magic" ) 
				{						
						echo '<tr><td colspan="7" class="none">'.LanguageValidation::iMsg("intro.shop.".strtolower($page)).'</td></tr>';
						echo '<tr>';
						echo '<th>'.LanguageValidation::iMsg("label.shop.image").'</th>';
						echo '<th>'.LanguageValidation::iMsg("label.shop.name").'</th>';
						echo '<th>'.LanguageValidation::iMsg("label.shop.price").'</th>';					
						echo '<th>'.LanguageValidation::iMsg("label.shop.action").'</td>';
						echo '</tr>';
				}
				
				$current_type = "";
				
				foreach ($Armor_Query as $Armor)
				{
					if(strtolower($page) === "accessory" || strtolower($page) === "item" || strtolower($page) === "magic" ) 
					{
						if($current_type !== $Armor[$sell_type] )
						{
        				    echo '<tr><td colspan="7" class="none">'.LanguageValidation::iMsg("intro.shop.".$Armor[$sell_type]).'</td></tr>';
							
							echo '<tr>';
							echo '<th>'.LanguageValidation::iMsg("label.shop.image").'</th>';
							echo '<th>'.LanguageValidation::iMsg("label.shop.name").'</th>';
							echo '<th>'.LanguageValidation::iMsg("label.shop.price").'</th>';					
							echo '<th>'.LanguageValidation::iMsg("label.shop.action").'</td>';
							echo '</tr>';
							
							$current_type = $Armor[$sell_type] ;
						}
					}
					echo '<tr>';
					
						$desc = (isset($sell_description) ? stripslashes(nl2br($Armor[$sell_description])) : '');
						$desc .= '<br/><br/>';
						$desc .= ''.LanguageValidation::iMsg("label.level.required").' : ' .(isset($sell_level_requiered) ? stripslashes($Armor[$sell_level_requiered]) : 1 ).'<br/><br/>';
						$desc .= (isset($sell_HP) ? sprintf($term_HP,stripslashes($Armor[$sell_HP]), (strtolower($page) == "magic" ? ($Armor[$sell_type] =="Attack" ? "Damage" :"Soin") : null ) ) : '');
						$desc .= (isset($sell_MP) ? sprintf($term_MP,stripslashes($Armor[$sell_MP])) : '');
						$desc .= (isset($sell_strength) ? sprintf($term_strength,stripslashes($Armor[$sell_strength])) : '');
						$desc .=  (isset($sell_magic) ? sprintf($term_magic,stripslashes($Armor[$sell_magic])) : '');
						$desc .=  (isset($sell_agility) ? sprintf($term_agility,stripslashes($Armor[$sell_agility])) : '');
						$desc .=  (isset($sell_defense) ? sprintf($term_defense,stripslashes($Armor[$sell_defense])) : '');
					
						echo "<td><a class='infobulle' href='#'>";
						echo "<img title='".$Armor['Image_Name']."' height='50px' src='data:".$Armor['Image_Type'].";base64,".$Armor['Image_Base64']."' />";
						echo '<span>'.nl2br($desc).'</span></a>';
						echo "</td>";
						echo '<td>' .(isset($sell_name) ? stripslashes($Armor[$sell_name]) : '').'</td>';
						
						echo '<td>' .(isset($sell_price) ? render_money($Armor[$sell_price]) : '' ).'</td>';
					
						echo '<td>';
							echo '<form method="POST" action="'.get_link($page,'Game').'">';
							echo "<input type=\"hidden\" name=\"".$sell_id."\" value=\"".$Armor[$sell_id]."\">";
							echo "<input type=\"hidden\" name=\"".$sell_price."\" value=\"".$Armor[$sell_price]."\">";
							echo '<input type="submit" name="Buy" value="'.LanguageValidation::nMsg("btn.shop.buy").'"/>'.LanguageValidation::eMsg("btn.shop.buy");
	                        echo '<input type="hidden" name="token" value="'.generer_token("buy-".strtolower($page)."-".$Armor[$sell_id]).'"/>';
							echo '</form><br />';
						echo '</td>';
					
					echo '</tr>';
					
				}
				echo '</table></p>';
			}
			
		}
	}
	