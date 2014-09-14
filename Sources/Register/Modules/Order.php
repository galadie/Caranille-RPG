<?php
	include_once($_path."Sources/Register/Modules/Register.php");

	if (request_confirm('Order'))
	{
		if(verifier_token(600, get_link('Order','Register') ,  'Register-step-order'))
		{					
			extract(stripslashes_r($_POST));
			
			update_db('Caranille_Accounts',array('Account_Order'=> $Order_ID, 'Account_ID'=> $Account_ID, 'Account_Step' => 3));
			
			$message = 'Vous venez de rejoindre un ordre';
			
			add_diary($message,$Account_ID);
			//echo '<br /><br />'.$message;
			$baseline =  'Inscription effectuée, vous allez recevoir le mail de validation';

			$_SESSION['Account_Register']['step'] = 3 ;
			//$classe = true ;
			header('location:'.get_link('Race','Register'));

		}
	}
	else
		$order = true ;
	