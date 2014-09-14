<?php

	if(verif_connect())
	{
		if (verif_town())//($_SESSION['Town'] == 1)
		{
			menu_town();
			
			echo '<table class="newsboard quest">';

			//quest to reward
			$Quests = list_db('foreign_list',array(
						'table' => 'Caranille_Quests' ,
						'ID' => 'Quest_Town_Return',
						'value' => $_SESSION['Town_ID']
					));
					
			 //is this the person that is the recepiant of the quest?
    		if(!empty($Quests))
    		{
    		    $cQuest = 0 ;
    		    
    			foreach($Quests as $quest)
    			{
      				$rewarded = get_db('is_requested_quest',array(
      				    
      				    'Quest_ID' => $quest['Quest_ID'],
      				    'Account_ID' => user_data('Account_ID')
      				    
      				    ));
      				
    				// get an array for the status of the quest
    				if(empty($rewarded))// || $rewarded['Inventory_Quest_Status']!=='complete')
    				{
  			            echo "<tr><th>".$quest['Quest_Name']."</th></tr>";
    			    	echo "<tr><td class='quest'>";
    					echo $quest["Quest_Introduction"];
    					echo "<form method='post' action='".get_link('QuestBoard','Game')."'>";
    					echo "<input type='hidden' name='Quest_ID' value='".$quest['Quest_ID']."'/>";
					    echo "<input type='submit' name='accept_quest' value='Accepter' />";
                    	echo '<input type="hidden" name="token" value="'.generer_token('accept_quest-'.$quest['Quest_ID']).'" />';
    					echo "</form>";
    			    	echo '</td></tr>';
    			    	
    			    	$cQuest++;
    				 }
    			}
    			
    			if($cQuest == 0)
  			            echo "<tr><td class='none' >Aucune quete à prendre</td></tr>";

    		}
		
			//quest to accept
			$Quests = list_db('foreign_list',array(
						'table' => 'Caranille_Quests' ,
						'ID' => 'Quest_Town_Origin',
						'value' => $_SESSION['Town_ID']
					));
			// make sure this npc has a quest assigned to him/her
			if(!empty($Quests))
			{
				foreach($Quests as $quest)
				{
					$rewarded = get_db('is_incomplete_requested_quest',array(
      				    
      				    'Quest_ID' => $quest['Quest_ID'],
      				    'Account_ID' => user_data('Account_ID')
      				    
      				    ));
					
					// get an array for the status of the quest
					if(!empty($rewarded))
					{
                        echo "<tr><th>".$quest['Quest_Name']."</th></tr>";
        				echo "<tr><td class='quest'>";
        								
						echo $quest["Quest_Defeate"];
						 
						$find = get_db("edit_admin",array(
							'table' => 'Caranille_Inventory' ,
							'ID' => 'Inventory_Item_ID',
							'value' => $quest['Quest_Item']
						));
						
						if(!empty($find))
						{
							echo "<form method='post' action='".get_link('QuestBoard','Game')."'>";
							echo "<input type='hidden' name='Quest_ID' value='".$quest['Quest_ID']."'/>";
							echo "<input type='submit' name='return_quest' value='Rendre' />";
                        	echo '<input type="hidden" name="token" value="'.generer_token('return_quest-'.$quest['Quest_ID']).'" />';
							echo "</form>";
						} 
    				    echo '</td></tr>';
					}

					
				}
			}
			
			echo '</table>';
		}
	}
