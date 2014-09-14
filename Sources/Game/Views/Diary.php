<?php

	if(verif_connect()) // fichier Refresh.php
	{
		get_ocedar();
		menu_character();
    	
    	//Search and display game Diaries
    	$Resultat = list_db('diary_list',array('Account_ID'=>user_data('Account_ID')));
        
        if(!empty($Resultat))
        {
        	echo '<table class="newsboard diary" >';
        	
        	foreach ($Resultat as $Diaries )
        	{
        		$date = new DateTime($Diaries['Diary_Date']);
        		
        		
				$content = "
		<form method='post' action='".get_link('diary','game')."' >
		Résumé : " .stripslashes(nl2br($Diaries['Diary_Message'])). "
			<input type='hidden' name='Diary_ID' value ='".$Diaries['Diary_ID']."' />
			".call_bbcode_editor("roleplay",$Diaries['Diary_Description'])."
			<input type='submit' name='edit-role-play' value ='&check;' />
	            <input type='hidden' name='token' value='".generer_token("editor-role-play-".$Diaries['Diary_ID'])."'/>
		</form>
		";
        			echo '<tr>';
        				echo '<th class="date">'.$date->format("d/m/Y à H:i"). '</th>';
        				echo '<td class="message">';
        					echo '' .stripslashes(nl2br($Diaries['Diary_Message'])). '';
        				echo '</td>';
        				
						 echo '<td>';
						echo init_popIn('roleplay-'.$Diaries['Diary_ID'].'-form',"RolePlay",$content,'roleplay-link');
        				echo '</td>';

        			echo '</tr>';
        			echo '<tr>';
        				echo '<td class="none" colspan="2" >';
        				echo '</td>';
        			echo '</tr>';
        	}
        	
		    echo '</table>';

        }
	}