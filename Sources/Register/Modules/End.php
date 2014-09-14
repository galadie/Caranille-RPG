<?php
	include_once($_path."Sources/Register/Modules/Register.php");

	if(request_confirm('Miroir'))
	{
		$account = get_db('account_miroir',$_GET);
		list ($message_texte, $message_html) = content_valid_mail($account);
		
		die( $message_html );
		
	}
	else
	if (request_confirm('Valid'))
	{
	    $baseline = 'Validation de votre inscription';
	    
		if(!empty($_GET))extract(addslashes_r($_GET));
		if(!empty($_POST))extract(addslashes_r($_POST));
		
		$user_record = get_db('valid_account',$_REQUEST);
		
		$Date = date("Y-m-d H:i:s");
		
		$_SESSION['Account_Register']['step'] = 7 ;
			
    	if(!empty($user_record))
		{
		    $r = array();
    		$r['Account_ID'] = $user_record['Account_ID'];
    		$r['Account_Key'] = uniqid();
    		$r['Account_Valid'] = 1 ;
			$r['Account_Step'] = 6 ;
			//$r['Account_Last_Connection'] = $Date; 
    		//$r['Account_Last_Connected'] = $Date; 
    		
    		update_db('Caranille_Accounts',addslashes_r($r));    		
		}
		
		if(isset($r)) echo 'Validation effectuée, vous pouvez vous connecter';
	}
	else
	//if (empty($_POST) ) //&& empty($_GET))//['Register']))
	{
	    $baseline =  'inscription terminée';
		$ended = true ;
	}
	
