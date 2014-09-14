<?php
	$record = false ;
		
	if (request_confirm('Valid'))
	{
		if(verifier_token(600, get_link('Email_Valid','User') ,  'Valid'))
		{
        	extract(addslashes_r($_POST));
    		
    		if (request_confirm('Pseudo') && request_confirm('Password') && request_confirm('Email'))
    		{
    			if(filter_var($Email, FILTER_VALIDATE_EMAIL) !== false)  //Validation d'une adresse de messagerie.
    			{
    				if ($Password == $Password_Confirm)
    				{
						$account = get_db('request_account',$_POST); 
						
						if (!empty($account))
						{
						    if($account['Account_Valid'] === 0)
						    {
						        $pswd = password_encode($prefixe_salt.$account['Account_Salt'].$suffixe_salt, $Password)		;
                                $restore = password_decode($prefixe_salt.$account['Account_Salt'].$suffixe_salt, $account['Account_Password'] )		;
                                
                    			if($account['Account_Password'] === $pswd && $restore === $Password)
                    			{
        							$key = uniqid();
    
        							update_db('Caranille_Accounts',array(
        								'Account_Key' => $key,
        								'Account_ID' => $account['Account_ID'],
        							));
        		
        							$user_record = get_db($req_pseudo); 
									
        							if(!empty($user_record))
        							{
        							    register_email($user_record);
        							}
                    			}
                    			else
                    			    $baseline = "mot de passe éronné";
						    }
						    else
						        $baseline ="ce compte est dejà validé";
						}
				        else
				            $baseline = "compte inconnu";
    				}
    				else
    				{
    					 $baseline =  'Les deux mots de passes entrée ne sont pas identiques';
    				}
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
	
	
	
?>