
<?php		

		$Messages_Q = list_db("guild_chatroom",array( 
		    'Guild_ID' => guild_data("Guild_ID")
		    ));
		

		
		echo '<base target="_parent">';
		echo '<meta http-equiv="refresh" content="5;URL='.get_link('guild','chat').'">';
		if(!empty($Messages_Q))
		{
    		echo '<table class="newsboard chatroom" >';
    		foreach ($Messages_Q as $Messages )
    		{
    
    			$Pseudo = stripslashes($Messages['Account_Pseudo']);
    			$ID_message = stripslashes($Messages['Chat_Message_ID']);
    
    			echo '<tr>';
			echo '<td>';
			echo '<a href="'.get_link('Account','Forum',array('m'=>$Account['Account_ID'],'action'=>'consulter')).'">';
			echo stripslashes($Pseudo);
			echo '</a>';
			echo '</td>';
    		
    			echo '<td class="message">';
    				 echo stripslashes($Messages['Chat_Message']); 
    			echo '</td>';
    		
    		
    			if(verif_access("Admin",true))
    			{			
    				//echo '<td>'.time().'</td>';
    				echo '<td>';
    					echo '<form method="POST" action="'.get_link('guild','chat').'">';
    					 echo "<input type=\"hidden\" name=\"ID_message\" value=\"$ID_message\">"; 
    					echo '<input type="submit" name="Delete" value="X">';
    					echo '</form>';
    				echo '</td>';
    			}
    			echo '</tr>';
    		}
    		echo '</table>';
        }
?>
