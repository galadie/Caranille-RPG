<?php

if(isset($race) && $race == true )//(request_confirm('Race') or  )
	{
		$Race_list = list_db('list_races');
		$token = generer_token("Register-step-race");
		
		if(!empty($Race_list))
		{
			foreach ($Race_list as $Race )
			{
				extract(stripslashes_r($Race));
				
				echo '<h2>' .$Race_Name. '</h2>';
				echo '<p>' .nl2br($Race_Description). '</p>';
				echo  '<form method="POST" action="'.get_link('Race','Register').'">';
				echo  "<input type='hidden' name='Race_ID' value='$Race_ID' />";
				echo  "<input type='hidden' name='Account_ID' value='".$user_record['Account_ID']."' />";
				echo '<input type="hidden" name="token" value="'.$token.'"/>';
				echo '<input type="submit" name="Race" value="'.LanguageValidation::nMsg("btn.register.race").'"/>'.LanguageValidation::eMsg("btn.register.race");
				echo  '</form>';
			}
			echo '<p>ATTENTION, ce choix est irréversible, choisissez donc bien</p>';
		}
		else
		{
			echo  '<form method="POST" action="'.get_link('Race','Register').'">';
			echo  "<input type='hidden' name='Race_ID' value='0' />";
			echo  "<input type='hidden' name='Account_ID' value='".$user_record['Account_ID']."' />";
			echo '<input type="hidden" name="token" value="'.$token.'"/>';
			echo '<input type="submit" name="Race" value="'.LanguageValidation::nMsg("btn.register.pass").'"/>'.LanguageValidation::eMsg("btn.register.pass");
			echo  '</form>';	
		}
	}
	