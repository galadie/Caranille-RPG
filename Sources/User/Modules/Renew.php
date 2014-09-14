<?php
	$record = false ;
		
	if (request_confirm('Renew'))
	{
		if(verifier_token(600, get_link('Password_Renew','User') ,  'Renew'))
		{
        	extract(addslashes_r($_POST));
    		
    		if (request_confirm('Pseudo')  && request_confirm('Email'))
    		{
    			if(filter_var($Email, FILTER_VALIDATE_EMAIL) !== false)  //Validation d'une adresse de messagerie.
    			{
					$user = get_db('request_account',$_POST);
						
					if (!empty($user))
					{
						$key = uniqid();
						
                    	update_db('Caranille_Accounts',array(
							'Account_ID' => $user['Account_ID'], 
							'Account_Key' => $key
						)); 
						
						$user_record = get_db($req_pseudo);
						
					    request_renew_email($user_record);

					}
					else
					    $baseline = "compte inconnu";
    			}
    			else
    			    $baseline = "email invalide";
    		}
    		else
    		    $baseline = "formulaire incomplet";
		}
		else
		    $baseline = "formulaire invalide";
	}

    if (request_confirm('Valid'))
	{
	    $baseline = 'Restitution de votre mot de passe';
	    
	    print_r($_RESQUEST);
	    
		if(!empty($_GET))extract(addslashes_r($_GET));
		if(!empty($_POST))extract(addslashes_r($_POST));
		
		$user = get_db('valid_account',$_REQUEST);
		
    	if(!empty($user))
		{
		    $Password = password_decode($prefixe_salt.$user['Account_Salt'].$suffixe_salt, $user['Account_Password'])		;
			$filter = uniqid();
			$pswd = password_encode($prefixe_salt.$filter.$suffixe_salt, $Password)		;
			
		   
		   	update_db('Caranille_Accounts',array(
				'Account_ID' => $user['Account_ID'], 
				'Account_Password' => $pswd, 
				'Account_Salt' => $filter
			)); 
			
			$user_record = get_db('request_account',$user);
			
		   valid_renew_email($user_record);

		}
	}
?>