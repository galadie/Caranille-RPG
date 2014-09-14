<?php

 //Si le joueur est dans une ville, on regarde si il est actuellement en combat
		if (verif_battle())
		{
			if (request_confirm('End_Invocations'))
			{
				$Invocation_Choice = request_post('Invocation');
				$MP_Choice = request_post('MP_Choice');
				
				if (user_data('Account_MP_Remaining') >= $MP_Choice)
				{
					$Invocation = get_db("edit_admin",array(
						'table' => 'Caranille_Invocations' ,
						'ID' => 'Invocation_Name',
						'value' => $Invocation_Choice
					));
					
					$Invocation_Damage = $Invocation['Invocation_Damage'];
					
					$Total_Damage_Monster =	getMonsterDamage();
					
					// non utilisé ??? 
					//$Monster_MIN_Defense = htmlspecialchars(addslashes($_SESSION['Monster_Defense'])) / $bonus_malus_battle;
					//$Monster_MAX_Defense = htmlspecialchars(addslashes($_SESSION['Monster_Defense'])) * $bonus_malus_battle;

					$Invocation_Total_Damage = htmlspecialchars(addslashes($Invocation_Damage)) * htmlspecialchars(addslashes($MP_Choice));

					$_SESSION['Monster_HP'] = monster_data('HP') - htmlspecialchars(addslashes($Invocation_Total_Damage));

					$message = "$Invocation_Choice a infligé $Invocation_Total_Damage HP de dégat au " .monster_data('Name'). "<br /><br />";
					$message .= "Le " .monster_data('Name'). " vous a infligé $Total_Damage_Monster HP de dégat<br /><br />";
 
                    add_diary($message);					
				}
				else
				{
					$message = 'Vous n\'avez pas assez de MP';
				}
				
				$roaster_action = true ;
			/**	
				echo $message ;
				echo '<form method="POST" action="'.get_link('Battle','Game').'">';
				echo '<input type="submit" name="Continue" value="continuer">';
				echo '</form>';
			**/
			}
		}
?>