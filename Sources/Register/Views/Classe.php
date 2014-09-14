<?php

	if(isset($classe) && $classe == true ) //( )
	{
		$classe_list = list_db('list_classes');
		$token = generer_token("Register-step-classe");
		
		if(!empty($classe_list))
		{
			foreach ($classe_list as $class )
			{
				extract(stripslashes_r($class));
				
				echo '<h2>' .$Classe_Name. '</h2>';
				echo '<p>' .nl2br($Classe_Description). '</p>';
				echo  '<form method="POST" action="'.get_link('Classe','Register').'">';
				echo  "<input type='hidden' name='Classe_ID' value='$Classe_ID' />";
				echo  "<input type='hidden' name='Account_ID' value='".$user_record['Account_ID']."' />";
				echo '<input type="hidden" name="token" value="'.$token.'"/>';
				echo '<input type="submit" name="Classe" value="'.LanguageValidation::nMsg("btn.register.classe").'"/>'.LanguageValidation::eMsg("btn.register.classe");
				echo  '</form>';
			}
			echo '<p>ATTENTION, ce choix est irréversible, choisissez donc bien</p>';
		}
		else
		{
			echo  '<form method="POST" action="'.get_link('Classe','Register').'">';
			echo  "<input type='hidden' name='Classe_ID' value='0' />";
			echo  "<input type='hidden' name='Account_ID' value='".$user_record['Account_ID']."' />";
			//echo '<input type="submit" name="Confirm" value="Rejoindre" />';
			echo '<input type="hidden" name="token" value="'.$token.'"/>';
			echo '<input type="submit" name="Race" value="'.LanguageValidation::nMsg("btn.register.pass").'"/>'.LanguageValidation::eMsg("btn.register.pass");
			echo  '</form>';
		}
	}
	
?>