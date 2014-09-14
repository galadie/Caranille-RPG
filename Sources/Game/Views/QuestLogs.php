<?php

	
	if(verif_connect())
	{
		menu_character();

        $Quests = list_db('quest_log_list',array('Account_ID'=>user_data('Account_ID')));
        
        if(!empty($Quests))
        {
        	echo '<table class="newsboard quest">';
        	foreach($Quests as $quest)
        	{
        					   echo "<tr><th>".$quest['Quest_Name']."</th></tr>";
        						echo "<tr><td class='quest'>";
        						 echo $quest["Quest_Goal"]."<br/>";
        						 
        		if($quest['Inventory_Quest_Status'] === 'incomplete')
        		{
        						 echo $quest["Quest_Introduction"];
        		}
        		if($quest['Inventory_Quest_Status'] === 'complete')
        		{
        						 echo $quest["Quest_Victory"];
        		}
        						echo '</td></tr>';
        		
        	}
            echo '</table>';
        }			
	}
