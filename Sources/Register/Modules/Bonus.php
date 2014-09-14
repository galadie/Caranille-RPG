<?php
	include_once($_path."Sources/Register/Modules/Register.php");

	if (request_confirm('Confirm'))
	{
		if(verifier_token(600, get_link('Bonus','Register') ,  'Register-step-bonus'))
		{		
			foreach($_POST as $c => $v)
				if($c != 'Account_ID' && $c !='Confirm' && $c !='Regene')
					if($v > 10) 
						$_POST[$c] = 1;
			
			$_POST['Account_Step'] = 6 ;
						
			update_db('Caranille_Accounts',addslashes_r($_POST));
			$_SESSION['Account_Register']['step'] = 6 ;
			
						header('location:'.get_link('End','Register'));
//$ended = true ;
		}
	}
	else
		$bonus = true ;
	
	if (request_confirm('Regene') or $bonus)
	{
		$baseline ="Validez vos stats ou regenerez les";

			$_SESSION['Account_Register']['step'] = 5 ;
			
		foreach($array_character_barre as $barre)
			eval("\$Account_".(strtoupper($barre))."_Bonus = mt_rand(0, 10);");
		//$Account_HP_Bonus = mt_rand(0, 10);
		//$Account_MP_Bonus = mt_rand(0, 10);
		
		foreach($array_character_stats as $stats)
			eval("\$Account_".(ucfirst($stats))."_Bonus = mt_rand(0, 10);");
		//$Account_Strength_Bonus = mt_rand(0, 10);
		//$Account_Magic_Bonus = mt_rand(0, 10);
		//$Account_Agility_Bonus = mt_rand(0, 10);
		//$Account_Defense_Bonus = mt_rand(0, 10);
		
		$bonus = true ;		
		$Account_ID = request_confirm('Regene') ? $_POST['Account_ID']: $user_record['Account_ID'];
	}
	
	