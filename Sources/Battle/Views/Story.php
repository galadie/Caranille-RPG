<?php
	if(verif_connect())
	{	
		if (empty($_POST['Launch']))
		{			
			$Chapter_Level = get_db("chapter_account",array('Chapter_Number'=>user_data('Account_Chapter')) );
			
			if(!empty($Chapter_Level))
			{
				$Chapter_Number = stripslashes($Chapter_Level['Chapter_Number']);

				echo "<h3>" .stripslashes($Chapter_Level['Chapter_Name']). "</h3>";
				echo "" .stripslashes(nl2br($Chapter_Level['Chapter_Opening'])). "<br />";
				
				echo '<form method="POST" action="'.get_link('Story','Game').'">';
				echo "<input type=\"hidden\" name=\"Chapter_Number\" value=\"$Chapter_Number\" />";
				echo '<input type="submit" name="Launch" value="continuer" />';
		        echo '<input type="hidden" name="token" value="'.generer_token('Story').'" />';
				echo '</form><br /><br />';
			}
			else
			{
				echo 'Pour le moment il n\'y a aucune histoire, profitez-en pour vous entrainer';
			}

		}
		else
		{
			if($launch)
			{
				echo "<img title='".$Chapter_Monster['Image_Name']."' height='50px' src='data:".$Chapter_Monster['Image_Type'].";base64,".$Chapter_Monster['Image_Base64']."' /><br/>";
				echo '' .$Chapter_Monster['Monster_Name']. '<br />';
				echo '' .stripslashes(nl2br($Chapter_Monster['Monster_Description'])). '<br />';
				echo 'HP: ???<br />';
				echo 'MP: ???<br />';
				
				echo "<a href='".get_link('Roaster','Game')."'>Rechercher un groupe</a>";
				
				echo '<form method="POST" action="'.get_link('Battle','Battle').'">';
				echo '<input type="submit" name="Continue" value="Lancer le combat">';
				echo '</form>';
			}
		}
	
		compo_roaster();
	}