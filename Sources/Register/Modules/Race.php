<?php
	include_once($_path."Sources/Register/Modules/Register.php");

	if (request_confirm('Race'))
	{
		if(verifier_token(600, get_link('Race','Register') ,  'Register-step-race'))
		{
			extract(stripslashes_r($_POST));
			
			update_db('Caranille_Accounts',array('Account_Race' => $Race_ID, 'Account_ID'=> $Account_ID, 'Account_Step' => 4));
			
			$message = 'Vous venez de rejoindre une race';
			
			add_diary($message,$Account_ID);
			//echo '<br /><br />'.$message;
			$baseline =  'Inscription effectuée, vous allez recevoir le mail de validation';
			
			$_SESSION['Account_Register']['step'] = 4 ;
			header('location:'.get_link('Order','Register'));

		}
	}
	else
		$race = true ;
	
?>