<?php
	include_once($_path."Sources/Register/Modules/Register.php");

	if (request_confirm('Classe'))
	{
		if(verifier_token(600, get_link('Classe','Register') ,  'Register-step-classe'))
		{		
			extract(stripslashes_r($_POST));
		
			update_db('Caranille_Accounts',array('Account_Classe'=> $Classe_ID, 'Account_ID'=> $Account_ID, 'Account_Step' => 5));
			
			$message = 'Vous venez de rejoindre une classe';
			
			add_diary($message,$Account_ID);
			//echo '<br /><br />'.$message;
			$baseline =  'Inscription effectuée, vous allez recevoir le mail de validation';
			
			$_SESSION['Account_Register']['step'] = 5 ;
			header('location:'.get_link('Bonus','Register'));
			
			//$bonus = true ;
		}
	
	}
	else 
		$classe = true ;
?>