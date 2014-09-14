<?php 

        //Si le joueur est dans une ville, on regarde si il est actuellement en combat
		if (verif_battle())
		{
		    if (request_confirm('Attack'))
			{
				$MIN_Strength = perso_data('Strength_Total') / $bonus_malus_battle;
				$MAX_Strength = perso_data('Strength_Total') * $bonus_malus_battle;
				
				$Positive_Damage_Player = mt_rand($MIN_Strength, $MAX_Strength);
				$Negative_Damage_Player = getMonsterDefense(); //mt_rand($Monster_MIN_Defense, $Monster_MAX_Defense);
				
				$Total_Damage_Player = htmlspecialchars(addslashes($Positive_Damage_Player)) - htmlspecialchars(addslashes($Negative_Damage_Player));
								
				//Si les dégats du joueurs ou du monstre sont égal ou inférieur à zero
				if ($Total_Damage_Player <=0) $Total_Damage_Player = 0;
				
				$_SESSION['Monster_HP'] = monster_data('HP') - htmlspecialchars(addslashes($Total_Damage_Player));
				
				$Total_Damage_Monster = getMonsterDamage();
				
				$message = "Votre attaque a infligé ".$Total_Damage_Player."HP de dégat au ".monster_data('Name')."<br /><br />";
				$message .= "Le ".monster_data('Name')." vous a infligé ".$Total_Damage_Monster."HP de dégat"."<br /><br />";
				
				add_diary($message);

				$roaster_action = true ;
			}
		}
?>