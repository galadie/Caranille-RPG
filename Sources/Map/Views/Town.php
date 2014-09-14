<?php

	if(verif_connect()) 
	{			
		if (isset($exit) && $exit == true )
		{
			echo '<p>'.$message.'<br/><br/>';			
			echo '<form method="POST" action="'.get_link('Map','Map').'">';
			echo '<input type="submit" name="carte" value="'.LanguageValidation::nMsg("btn.return.world").'"/>'.LanguageValidation::eMsg("btn.return.world");//Retourner à la carte du monde">';
			echo '<input type="hidden" name="token" value="'.generer_token('carte').'" />';
			echo '</form></p>';
		}
		else
		if (verif_town())
		{
				$Town_Image = htmlspecialchars(addslashes($information_Town['Town_Image']));
				
				menu_town();
 				instruction(isset($message) ? $message : "");
			
				bousole("Town");
				include_once(path_source("map-1","Map","Map"));
			
				//echo '<div style="float:left; margin-left:35px">';
				
				echo "<img src=\"$Town_Image\"><br />";
				
				echo "" .$information_Town['Town_Description']. "<br /><br />";
				echo '<form method="POST" action="'.get_link('Map','Map').'">';
				echo '<input type="submit" name="Exit_Town" value="'.LanguageValidation::nMsg("btn.leave.town").'"/>'.LanguageValidation::eMsg("btn.leave.town");//Quitter la Ville">';
    		    echo '<input type="hidden" name="token" value="'.generer_token('Exit_Town-'.$information_Town['Town_ID']).'" />';
				echo '</form>';
				
				//echo '</div>';
			
		}	
		
	}