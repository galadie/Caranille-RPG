<?php


	   
       //On affiche les infos sur le membre
       echo '<p><i>Vous êtes ici</i> : <a href="./index.php">Index du forum</a> --> profil de '.$Account_Pseudo;
       echo'<h1>Profil de '.$Account_Pseudo.'</h1>';
       
       echo'<img src="'.get_avatar($query)/**$Account_Avatar**/.'" alt="Ce membre n a pas d\'avatar" title="Ce membre n a pas d\'avatar" />';
       
       echo'<p><strong>Adresse E-Mail : </strong><a href="mailto:'.$Account_Email.'">'.$Account_Email.'</a><br />';
       
       //echo'<strong>MSN Messenger : </strong>'.$Account_msn.'<br />';
       
       //echo'<strong>Site Web : </strong><a href="'.$Account_siteweb.'">'.$Account_siteweb.'</a><br /><br />';
 
       echo'Ce membre est inscrit depuis le <strong>'.$Account_Inscription.'</strong> et a posté <strong>'.$Account_Post.'</strong> messages<br /><br />';
	   
	   if(isset($Guild_Name)) echo "Guilde : ".$Guild_Name."<br/>";
	   if(isset($Order_Name)) echo "Ordre : ".$Order_Name."<br/>";
	   
      // echo'<strong>Localisation : </strong>'.$Account_localisation.'</p>';
      
	  echo "<a href='".get_link('Friends','User',array('add'=>$membre))."' >Ajouter Ã  la liste d'amis</a><br/>";

        if(!empty($Resultat))
        {
        	echo '<table class="newsboard diary" >';
        	
        	foreach ($Resultat as $Diaries )
        	{
        		$date = new DateTime($Diaries['Diary_Date']);
        		
        			echo '<tr>';
        				echo '<th class="date">'.$date->format("d/m/Y Ã  H:i"). '<br/>' .stripslashes(nl2br($Diaries['Diary_Message'])).'</th>';
		//echo LanguageValidation::iMsg("intro.diary.record", news_date($News), $News['News_Account_Pseudo']);//"News publiÃ©e le " .. " Par " .. "";
        				echo '<td class="message">';
        					echo  bb_code($Diaries['Diary_Description']);
        				echo '</td>';
        				
        			echo '</tr>';
        			echo '<tr>';
        				echo '<td class="none" colspan="2" >';
        				echo '</td>';
        			echo '</tr>';
        	}
        	
		    echo '</table>';

        }
?>