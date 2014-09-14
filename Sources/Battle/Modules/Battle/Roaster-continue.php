<?php
		if (verif_battle())
		{
		    if (request_confirm('Continue'))
			{		
				if(has_roaster())
				{	
					if (monster_data('HP') <= 0)
					{	
						if ($_SESSION['Arena_Battle'] !== 1)
						{
							$recrus = get_roaster();
					
							if(!empty($recrus))
							{
								foreach ( $recrus as $Account )
								{
									$new_expe = $Account['Account_Experience']+ monster_data('Experience');
									$new_gold = $Account['Account_Golds']+ monster_data('Golds');
									
									update_db('Caranille_Accounts',array(
										'Account_Experience' => $new_expe ,
										'Account_Golds' => $new_gold ,
										'Account_ID' => $Account['Account_ID']
									));
									
									$diary_message = "Vous avez remporté le combat !!!<br />";
									$diary_message .= "Pièces d'or (PO) + ".monster_data('Golds')." <br />";
									$diary_message .= "Experience (XP) + ".monster_data('Experience')." <br />";
									
									add_diary($diary_message, $Account['Account_ID']);
								}
							}
						}
					}
				}
			}
		}