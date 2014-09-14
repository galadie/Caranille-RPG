<?php

	if(verif_connect())
	{
		if (verif_town())//($_SESSION['Town'] == 1)
		{
		    menu_town();
			
		    if (request_confirm('Accept'))
			{			    
                if(!empty($Mission_Monster))
				{
					echo "<img title='".$Mission_Monster['Image_Name']."' height='50px' src='data:".$Mission_Monster['Image_Type'].";base64,".$Mission_Monster['Image_Base64']."' /><br/>";
    				echo '' .stripslashes($Mission_Monster['Monster_Name']). '<br />';
    				echo '' .stripslashes(nl2br($Mission_Monster['Monster_Description'])). '<br />';
    				echo 'HP: ???<br />';
    				echo 'MP: ???<br />';
					
					echo "<a href='".get_link('Roaster','Game')."'>Rechercher un groupe</a>";
					
    				echo '<form method="POST" action="'.get_link('Battle','Battle').'">';
    				echo '<input type="submit" name="Continue" value="Lancer le combat">';
    				echo '</form>';
				}
			}
			else //	if (empty($_POST['combattre_mission']) && empty($_POST['Accept']))
			{
				if(!empty($Mission))
				{
					echo 'N° ' .stripslashes($Mission['Mission_Number']). '';
					echo '<h3>' .stripslashes($Mission['Mission_Name']). '</h3>';
					echo '' .stripslashes(nl2br($Mission['Mission_Introduction'])). '<br />';
					
					echo '<form method="POST" action="'.get_link('Mission','Battle').'">';
					echo '<input type="hidden" name="Mission_ID" value="'.$Mission['Mission_ID'].'"/>';
					echo '<input type="submit" name="Accept" value="accepter"/>';
					echo '</form><br /><br />';
				}
				else
				{
					echo 'Il n\'y a aucune mission disponible dans cette ville, profitez-en pour vous entrainer';
				}
			}
			
			compo_roaster();
		}
	}	
