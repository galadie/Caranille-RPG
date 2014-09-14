<?php

        //Si le joueur est dans une ville, on regarde si il est actuellement en combat
		if (verif_battle())
		{
			if (request_confirm('End_Magics'))
			{
				
				if (user_data('Account_MP_Remaining') >= $Magic_MP_Cost)
				{
				    $Magic_Choice = request_post('Magic');
			    	$Magic_MP_Cost = request_post('Magic_MP_Cost');
			    	
					$Magic = get_db("edit_admin",array(
						'table' => 'Caranille_Magics' ,
						'ID' => 'Magic_Name',
						'value' => $Magic_Choice
					));
					
					extract($Magic);

					$MIN_Magic = user_data('Level_Magic') / $bonus_malus_battle;
					$MAX_Magic = user_data('Level_Magic') * $bonus_malus_battle;
			    	
					$Remaining_MP = user_data('Account_MP_Remaining') - htmlspecialchars(addslashes($Magic_MP_Cost));
						
                	user_set('Account_MP_Remaining', $Remaining_MP );
                	user_record();
                		
                	if ($Magic_Type == "Attack")
					{
						$Negative_Magic_Damage_Player = getMonsterDefense(); //mt_rand($Monster_MIN_Defense, $Monster_MAX_Defense);

						$Positive_Magic_Damage_Player = mt_rand($MIN_Magic, $MAX_Magic) + $Magic_Effect;
						$Player_Total_Magic_Damage = htmlspecialchars(addslashes($Positive_Magic_Damage_Player)) - htmlspecialchars(addslashes($Negative_Magic_Damage_Player));
						
						if ($Player_Total_Magic_Damage <=0) $Player_Total_Magic_Damage = 0;
						
                	    $_SESSION['Monster_HP'] = monster_data('HP') - htmlspecialchars(addslashes($Player_Total_Magic_Damage));
					
						$message = "$Magic_Choice a infligé $Player_Total_Magic_Damage HP de dégat au " .monster_data('Name'). "<br /><br />";

                        add_diary($message);
					}
					elseif ($Magic_Type == "Health")
					{
						
						//non utilisé ??? 
						//$Monster_MIN_Defense = htmlspecialchars(addslashes($_SESSION['Monster_Defense'])) / $bonus_malus_battle;
						//$Monster_MAX_Defense = htmlspecialchars(addslashes($_SESSION['Monster_Defense'])) * $bonus_malus_battle;

						$Player_Health = mt_rand($MIN_Magic, $MAX_Magic) + $Magic_Effect;

						$Life_Difference = perso_data('HP_Total') - htmlspecialchars(addslashes($_SESSION['HP']));
						
						if ($Player_Health >= $Life_Difference)
						{
							$_SESSION['HP'] = htmlspecialchars(addslashes($_SESSION['HP'])) + htmlspecialchars(addslashes($Life_Difference));
							$Player_Health = htmlspecialchars(addslashes($Player_Health));
						}
						else
						{
							$_SESSION['HP'] = htmlspecialchars(addslashes($_SESSION['HP'])) + htmlspecialchars(addslashes($Player_Health));
						}


						$Monster_Image = monster_data('Image');
						
						$message = "$Magic_Choice vous a soigné de $Player_Health <br /><br />";
					}

            		user_set('Account_MP_Remaining', $Remaining_MP );
            		user_record();
                		
			    	$Total_Damage_Monster = getMonsterDamage();

					$message .= "Le " .monster_data('Name'). " vous a infligé $Total_Damage_Monster HP de dégat<br /><br />";
                    add_diary($message);
				    $roaster_action = true ;
				}
				else
				{
					$message = 'Vous n\'avez pas assez de MP';
					
				}
				/**
					echo "<img src=\"$Monster_Image\"/><br />";
					echo $message ;
					echo '<form method="POST" action="'.get_link('Battle','Game').'">';
					echo '<input type="submit" name="Continue" value="continuer">';
					echo '</form>';
				**/
			}
		}	