<?php 
 //Si le joueur est dans une ville, on regarde si il est actuellement en combat
		if (verif_battle())
		{
			if (request_confirm('End_Items'))
			{
				$Item_Choice = htmlspecialchars(addslashes($_POST['Item']));
				$Item = get_db('request_has_item',array('Item_Choice'=>$Item_Choice , 'ID' => $ID));

                extract($Item);
				
				if ($Item_Type == "Health") //Soin des HP => update by Dimitri
				{
					
					$Life_Difference = perso_data('HP_Total') - htmlspecialchars(addslashes($_SESSION['HP']));
					
					if ($Item_Effect >= $Life_Difference)
					{
						$Remaining_HP = htmlspecialchars(addslashes($_SESSION['HP'])) + htmlspecialchars(addslashes($Life_Difference));
						$Item_Effect = htmlspecialchars(addslashes($Life_Difference));
					}
					else
					{
						$Remaining_HP = htmlspecialchars(addslashes($_SESSION['HP'])) + htmlspecialchars(addslashes($Item_HP_Effect));
					}
					
					//$_SESSION['HP'] = htmlspecialchars(addslashes($_SESSION['HP'])) - htmlspecialchars(addslashes($Total_Damage_Monster));
					
					user_set('Account_HP_Remaining', $Remaining_HP );
            		user_record();

					use_item($Item_ID,$inventory_ID);

					
					$message = "$Item_Name vous a soigné de $Item_Effect <br /><br />";

                    add_diary($message);
                    
                    $used = true ;
				}
				
				if ($Item_Type == "Magic") //Soin des MP => update by Dimitri
				{
					$Magic_Difference = perso_data('MP_Total') - htmlspecialchars(addslashes($_SESSION['MP']));
					
					if ($Item_Effect >= $Magic_Difference)
					{
						$Remaining_MP = htmlspecialchars(addslashes($_SESSION['MP'])) + htmlspecialchars(addslashes($Magic_Difference));
						$Item_Effect = htmlspecialchars(addslashes($Magic_Difference));
					}
					else
					{
						$Remaining_MP = htmlspecialchars(addslashes($_SESSION['MP'])) + htmlspecialchars(addslashes($Item_MP_Effect));
					}

            		user_set('Account_MP_Remaining', $Remaining_MP );
            		user_record();

					use_item($Item_ID,$inventory_ID);
					
					$message = "$Item_Name vous a soigné de $Item_Effect <br /><br />";
					                    
                    $used = true ;
				}
				
				if ($Item_Type == "Poison") //INFLICTION D4ETAT => update by Dimitri
				{
				    monster_set('etat',$Item_Type) ;
				}
					
				if($used)use_item($Item_ID,$inventory_ID);

				
		    	$Total_Damage_Monster =	getMonsterDamage();
				$message .= "Le " .monster_data('Name'). " vous a infligé $Total_Damage_Monster HP de dégat<br /><br />";
				
                add_diary($message);
                
				$roaster_action = true ;
			}
			
		}