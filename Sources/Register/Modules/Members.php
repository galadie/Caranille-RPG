<?php
	include_once($_path."Sources/Register/Modules/Register.php");

	if (request_confirm('Register'))
	{
		if(verifier_token(600, get_link('Members','Register') ,  'Register-step-member'))
		{
    		
    		if (request_confirm('Pseudo') && request_confirm('Password') && request_confirm('Email'))
    		{
        		extract(addslashes_r(stripslashes_r($_POST)));
        		
    			if(filter_var($Email, FILTER_VALIDATE_EMAIL) !== false)  //Validation d'une adresse de messagerie.
    			{
    				if ($Password == $Password_Confirm)
    				{
    					if (request_confirm('Licence'))
    					{
							$Pseudo_List = get_db('request_account',$_POST); 
									
    						if (empty($Pseudo_List))
    						{
    							$race = true ;
    							
    							$user_record = register_request();
    							
    							if(!empty($user_record))
    							{
									register_email($user_record);
									
 									debug_log("register-member-end => equipment init");
   							    
    								for( $i = 1 ; $i <= 5 ; $i++)
    									insert_db('Caranille_Inventory',array(
    										'Inventory_Account_ID' => $user_record['Account_ID'],
    										'Inventory_Item_ID' => $i,
    										'Inventory_Item_Quantity' => 1,
    										'Inventory_Item_Equipped' => 'Yes'
    									));
										
									debug_log("register-member-end => sesioning pseudo init") ;
									
									$_SESSION['Account_Register']['Pseudo'] = $Pseudo ;
									$_SESSION['Account_Register']['step'] = 2 ;
									
									debug_log("register-member-end => redirection init");
									
									header('location:'.get_link('Order','Register'));
									
									debug_log("register-member-end => redirection failed");
    							}
    						}
    						else
    						{
    							 $baseline =  'Ce Pseudo est déjà utilisé';
    						}
    					}
    					else
    					{
    						 $baseline =  'Vous devez accepter le règlement pour vous inscrire';
    					}
    				}
    				else
    				{
    					 $baseline =  'Les deux mots de passes entrée ne sont pas identiques';
    				}
    			
    			}
    			else
    			{
    				$baseline = "le mail n'est pas au format valide";
    			}
    		}
    	
    		else
    		{
    			 $baseline =  'vous n\'avez pas rempli tous les champs correctement';
    		}
		}
	
	}
	
	$record = true ;