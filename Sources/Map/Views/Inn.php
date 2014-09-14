<?php

if(verif_connect()) 
	{
		if (verif_town())
		{
			menu_town();
		    if (request_confirm('Rest'))
			{
				if (user_data('Account_Golds') >= $information_Town['Town_Price_INN'])
				{
					echo LanguageValidation::iMsg("used.map.inn");
					echo 'Vous avez récupéré toutes vos forces<br />';
					echo '<form method="POST" action="'.get_link("Map","Game").'">';
					//echo '<input type="submit" name="Inn" value="Retourner en ville">';
					echo '<input type="submit" name="Inn" value="'.LanguageValidation::nMsg("btn.inn.return").'"/>'.LanguageValidation::eMsg("btn.inn.return");
					echo '</form>';
				}
				else
				{
					echo LanguageValidation::iMsg("unusable.map.inn");
				}
			}
			else //	if (empty($_POST['Rest']))
			{
				
				$cout = render_money($information_Town['Town_Price_INN']);	
				
				echo LanguageValidation::iMsg("intro.map.inn");
				echo '<br /><br />';
				echo LanguageValidation::iMsg("label.map.inn",$cout);
				echo '<form method="POST" action="'.get_link("Inn","Game").'">';
				//echo '<input type="submit" name="Rest" value="Accepter">';
				echo '<input type="submit" name="Rest" value="'.LanguageValidation::nMsg("btn.inn.accept").'"/>'.LanguageValidation::eMsg("btn.inn.accept");
				echo '<input type="submit" name="Inn" value="'.LanguageValidation::nMsg("btn.inn.return").'"/>'.LanguageValidation::eMsg("btn.inn.return");
				echo '</form>';
			}			
		}
	}	