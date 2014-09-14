<?php

	if(isset($bonus) && $bonus == true )// (  )
	{
		echo '<form method="POST" action="'.get_link('Bonus','Register').'">';
		
		foreach($array_character_barre as $barre)
			echo "<label>".LanguageValidation::iMsg("label.".strtolower($barre).".card")." +</label><input readonly type='text' name='Account_HP_Bonus' value='".eval('return $Account_'.$barre.'_Bonus ;')."'><br />";

		foreach($array_character_stats as $stats)
			echo "<label>".LanguageValidation::iMsg("label.".strtolower($stats).".card")." +</label><input readonly type='text' name='Account_HP_Bonus' value='".eval('return $Account_'.$stats.'_Bonus ;')."'><br />";
/**		
		echo "<label>HP +</label><input readonly type='text' name='Account_HP_Bonus' value='$Account_HP_Bonus'><br />";
		echo "<label>MP +</label><input readonly type='text' name='Account_MP_Bonus' value='$Account_MP_Bonus'><br />";
		echo "<label>Force +</label><input readonly type='text' name='Account_Strength_Bonus' value='$Account_Strength_Bonus'><br />";
		echo "<label>Magie +</label><input readonly type='text' name='Account_Magic_Bonus' value='$Account_Magic_Bonus'><br />";
		echo "<label>Agilité +</label><input readonly type='text' name='Account_Agility_Bonus' value='$Account_Agility_Bonus'><br />";
		echo "<label>Defense +</label><input readonly type='text' name='Account_Defense_Bonus' value='$Account_Defense_Bonus'><br />";
**/		
		echo "<input type='hidden' name='Account_ID' value='".$user_record['Account_ID']."'>";
	    echo '<input type="hidden" name="token" value="'.generer_token("Register-step-bonus").'"/>';
		echo '<input type="submit" name="Regene" value="'.LanguageValidation::nMsg("btn.register.regene").'"/>'.LanguageValidation::eMsg("btn.register.regene");
		echo '<input type="submit" name="Confirm" value="'.LanguageValidation::nMsg("btn.register.stats").'"/>'.LanguageValidation::eMsg("btn.register.stats");
		echo '</form>';
	}
	
?>