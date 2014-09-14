<?php

	if(verif_connect())
	{
		if (verif_town())//($_SESSION['Town'] == 1)
		{
			menu_town();
			
			if (request_confirm('Battle'))//(verif_battle(true))//
			{
				if(!empty($monstre))
				{				    	                
					echo "<img title='".$monstre['Image_Name']."' height='50px' src='data:".$monstre['Image_Type'].";base64,".$monstre['Image_Base64']."' /><br/>";
					echo "" .$monstre['Monster_Name']. "<br />";
					echo "" .stripslashes(nl2br($monstre['Monster_Description'])). "<br />";
					echo "HP: ???<br />";
					echo "MP: ???<br />";
					echo '<form method="POST" action="'.get_link("Battle","Battle").'">';
					echo '<input type="submit" name="Continue" value="Lancer le combat"/>';
					echo '</form>';
				}
			}
			//else						
			if(empty($_POST['Battle']))//(!verif_battle(true))//
			{	
				echo '<p>'.LanguageValidation::iMsg("intro.battle.dungeon").'</p>';
				echo '<p>'.LanguageValidation::iMsg("label.choose.monster").'</p>';
			//	echo '<p>Dans ce lieu vous allez pouvoir combattre des monstres pour vous entrainer</p>';
				//echo '<p>Voici la liste des monstres:</p>';
				
				$ville_actuel = htmlspecialchars(addslashes($_SESSION['Town_ID']));

				$recherche_monstre = list_db('monster_dungeon', array('ville_actuel' => $ville_actuel) );

                if(!empty($recherche_monstre))
                {
    				foreach($recherche_monstre as $monstre )
    				{
    					$Monster_Image = stripslashes($monstre['Monster_Image']);
    					$Monster_ID = stripslashes($monstre['Monster_ID']);

						echo "<img title='".$monstre['Image_Name']."' height='50px' src='data:".$monstre['Image_Type'].";base64,".$monstre['Image_Base64']."' /><br/>";
    					echo "" .stripslashes($monstre['Monster_Name']). "<br />";
    					echo "" .stripslashes(nl2br($monstre['Monster_Description'])). "<br />";
    					//echo "HP: " .stripslashes($monstre['Monster_HP']). "<br />";
    					//echo "MP: " .stripslashes($monstre['Monster_MP']). "<br />";
    					echo '<form method="POST" action="'.get_link("Dungeon","Battle").'">';
    					echo "<input type=\"hidden\" name=\"Monster_ID\" value=\"$Monster_ID\">";
    					echo '<input type="submit" name="Battle" value="combattre">';
    					echo '</form><br />';
    				}
                }
                else
				{
					echo 'Aucun monstre ne rode dans les parages, revenez plus tard';
				}
		
			}
		
		}
		
	}
	
