<?php
 //Si le joueur est dans une ville, on regarde si il est actuellement en combat
		if (verif_battle())
		{
		    if (request_confirm('Continue'))
			{	
				$_final = "";
				$end_battle = false;
				if(verif_town(true))
				{
					$array_town = array( 
						'Town_ID' => $_SESSION['Town_ID'] ,
						'Account_ID' => user_data('Account_ID')
					);
					
					debug_log("verif inside",false);
					
					$information_Town = get_db('request_town',$array_town);
			
				}
				if ($_SESSION['Mission_Battle'] == 1)
				{
					// selection de la mission en cours : la mission suivant la plus recente remporté par le joueur
					$Mission = get_db('mission_account',array('Player_Mission_Level'=> user_data('Account_Mission'), 'Town' => $_SESSION['Town_ID'] )); 
				}
				if ($_SESSION['Chapter_Battle'] == 1)
				{
					$Chapter_Level = get_db("chapter_account",array('Chapter_Number'=>user_data('Account_Chapter')));
				}
				//Si la HP du monstre est inférieur ou égale à zero le joueur à gagné le combat
				if (monster_data('HP') <= 0)
				{	
					$end_battle = true;
					
					$Gold_Gained = monster_data('Golds');
					
					$_final .= "Vous avez remporté le combat !!!<br /><br />";
					$_final .= "Pièces d'or (PO) + $Gold_Gained <br /><br />";
						
					user_set('Account_Golds',(user_data('Account_Golds')+$Gold_Gained));
					
					if ($_SESSION['Arena_Battle'] !== 1)
					{
						$Experience_Gained = monster_data('Experience');
						$_final .= "Experience (XP) + $Experience_Gained <br />";
						
						user_set('Account_Experience',(user_data('Account_Experience')+$Experience_Gained));

						$loots = list_db('foreign_list',array(
							'table' => 'Caranille_Monster_Loot' ,
							'ID' => 'Loot_Monster_ID',
							'value' => monster_data("ID")
						));
											
						if(!empty($loots))
						{
							foreach($loots as $loot)
							{
								$Monster_Item_Rate = mt_rand(0, 100);
								
    							if ($Monster_Item_Rate <= $loot['Loot_Rate'])
								{
									$Item = gain_item($loot['Loot_Item_ID']);
								
									if($Item != null)
									{
										$Item_Name = stripslashes($Item['Item_Name']);
										$_final .= "Vous avez gagné l'objet suivant: $Item_Name<br />";
									}
								}
							}
						}
					}
					
					if ($_SESSION['Arena_Battle'] == 1)  // 
					{
						$message = "Votre victoire dans l'arène vous rapporte 1 points de notoriete<br />";	
						user_set('Account_Notoriety',(user_data('Account_Notoriety')+1));
						
						$Player_ID = monster_data('ID');
						exec_db("UPDATE Caranille_Accounts SET Account_Notoriety= Account_Notoriety - 1 WHERE Account_ID= $Player_ID");
					}
					
					if ($_SESSION['Chapter_Battle'] == 1)
					{	
						$message = "Votre niveau dans l'histoire augmente de 1 point<br />";								
					
						$return = get_link("Main","Game");
						
						user_set('Account_Chapter',(user_data('Account_Chapter')+1));
					}
					
					if ($_SESSION['Dungeon_Battle'] == 1)
					{
						$message = "C'est une belle victoire contre ".monster_data('Name');
						$return = get_link("Map","Map");
					}
					
					if ($_SESSION['Mission_Battle'] == 1)
					{
						user_set('Account_Mission',(user_data('Account_Mission')+1));
						
						$return = get_link("Map","Map");
					}
					
    				if(isset($message))
    				{
    				    add_diary($message);
    					$_final .= $message;
    				}
    				
    				if ($_SESSION['Chapter_Battle'] == 1) $_final .= $Chapter_Level['Chapter_Ending'];
    				if ($_SESSION['Mission_Battle'] == 1) $_final .= $Mission['Mission_Victory'];

    				$_final .= '<form method="POST" action="'.$return.'">';
					$_final .= '<input type="submit" name="End_Battle" value="continuer">';
					$_final .= '</form>';
				}
				//Si la HP du personnage et inférieur ou égale à 0 le joueur à perdu le combat et sera soigné
				if (user_data('Account_HP_Remaining') <= 0)
				{	
					$full_life = perso_data('HP_Total') ;
					$end_battle = true;
					$return = get_link("Main","Public");
					
					// echec dans un donjon ou une mission, on l'emmene à l'hopital.....
					if ($_SESSION['Dungeon_Battle'] == 1 || $_SESSION['Mission_Battle'] == 1)
					{
						$Town_Price_INN = htmlspecialchars(addslashes($information_Town['Town_Price_INN']));
					    user_set('Account_Golds',(user_data('Account_Golds')-$Town_Price_INN));						
						$HP_recup = $full_life ;
                    }
                    
					if ($_SESSION['Arena_Battle'] == 1)
					{
						$message = "Vous avez perdu le combat";
						$message .= "Votre défaite dans l'arène vous fait perdre 1 points de notorieté<br />";
						
						$HP_recup = $full_life*($percent_life_restore_arena/100);
						debug_log("HP_recup::$HP_recup = $full_life*($percent_life_restore_chapter/100)<br/>");

						user_set('Account_Notoriety',(user_data('Account_Notoriety')-1));
						
						$Player_ID = monster_data('ID');
						exec_db("UPDATE Caranille_Accounts SET Account_Notoriety= Account_Notoriety + 1 WHERE Account_ID= $Player_ID");
					}
					
					if ($_SESSION['Dungeon_Battle'] == 1)
					{
						$Town_Price_INN = htmlspecialchars(addslashes($information_Town['Town_Price_INN']));
						$message = 'Vous êtes morts...<br />Vous avez été emmené d\'urgence à l\'auberge et les soins vous ont été facturé ' .$Town_Price_INN. ' Pièce d\'or<br />';
						$HP_recup = $full_life;
  					}
					
    				if ($_SESSION['Chapter_Battle'] == 1) 
					{
						$HP_recup = $full_life*($percent_life_restore_chapter/100);
						debug_log("HP_recup::$HP_recup = $full_life*($percent_life_restore_chapter/100)");
						$_final .= $Chapter_Level['Chapter_Defeate'];
					}
					
    				if ($_SESSION['Mission_Battle'] == 1) 
					{
						$Town_Price_INN = htmlspecialchars(addslashes($information_Town['Town_Price_INN']));
						$_final .= $Mission['Mission_Defeate'];
						$_final .= '<br />Vous avez été emmené d\'urgence à l\'auberge et les soins vous ont été facturé ' .$Town_Price_INN. ' Pièce d\'or<br />';
					}
					
					if(isset($message))
    				{
    				    add_diary($message);
    					$_final .= $message;
    				}
    				
					user_set('Account_HP_Remaining',$HP_recup);	
					
					$_final .= '<br /><br /><form method="POST" action="'.$return.'">';
					$_final .= '<input type="submit" name="End" value="Continuer">';
					$_final .= '</form>';				
				}
				
				user_record(); // mise à jour en base du joueur
			}
		}