<?php 
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$title ="";
    $baseline= "Tableaux des Quetes";
	
	if(verif_connect())
	{
		if (verif_town())//($_SESSION['Town'] == 1)
		{
			/** questboard.php => map.php/towns **/
			if(request_confirm('return_quest'))
			{
		        if(verifier_token(600, get_link('QuestBoard','Game') ,  'return_quest-'.$_POST['Quest_ID']))
		        {					
					$quest = get_db('request_quest', $_POST);
    				
    				if(!empty($quest))
    				{	    				    
    					// first we need to check if the user has the appropriate item for the quest to be completed
    					$find = get_db('item_quest_inventaire', ($quest+user_data()));
    					
    					// print_r($find);
    					
    					if(!empty($find))// quest is complete.
    					{
    						// now lets first remove the item from the inventory, give the reward, and mark the quest as completed.
							use_item($quest['Quest_Item'],$find['inventory_ID']);
    						
							if($quest['Quest_Gold_Gift'] > 0 )
    						{
    							// update with the new gold in the database
    							update_db('Caranille_Account',array(
    								'Account_ID' => user_data('Account_ID'),
    								'Account_Golds'=> (user_data('Account_Golds')+$quest['Quest_Gold_Gift'])
    							));
    						}
    						
    						if($quest['Quest_Item_Gift'] > 0 )
    						{
								gain_item($quest['Quest_Item_Gift']);
							}
    						// mark the quest as complete
    						update_db('Caranille_Inventory_Quests',array(
    							'Inventory_Quest_Account_ID'=>user_data('Account_ID'),
    							'Inventory_Quest_Quest_ID'=>$quest['Quest_ID'],
    							'Inventory_Quest_Status'=>'complete'
    						));
    						
    						add_diary("Vous avez rendu une quete : ".$quest['Quest_Name']);
    			
    					}
    				}
		        }
			}

			if(request_confirm('accept_quest'))
			{
		        if(verifier_token(600, get_link('QuestBoard','Game') ,  'accept_quest-'.$_POST['Quest_ID']))
		        {
    				// need to assign the quest					
					$quest = get_db('request_quest', $_POST);

    				insert_db('Caranille_Inventory_Quests',array(
    					'Inventory_Quest_Account_ID'=>user_data('Account_ID'),
    					'Inventory_Quest_Quest_ID'=>$quest['Quest_ID'],
    					'Inventory_Quest_Status'=>'incomplete'
    				));
    				
    				add_diary("Vous avez accepté une quete : ".$quest['Quest_Name']);
		        }
			}
			
		}
	}
	
?>
