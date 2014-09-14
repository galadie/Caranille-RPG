<?php

function register_email($account)
{
	global $_url, $MMORPG_Name, $MMORPG_Description;
    //----------------------------------------------- 
     //DECLARE LES VARIABLES 
     //----------------------------------------------- 

    $sujet = "$MMORPG_Name - Validation inscription";

     $destinataire = $account['Account_Email'];//'mail_destinataire@fai.fr';
     
     $url_valid = get_link('Register','User',array(
	 
		'Valid'=>'Activer',
		'Account_Key'=>$account['Account_Key'],
		'Account_Email'=>$account['Account_Email'],
		
	 ));
	 
     $message_texte='Bonjour,'."\n\n".'utilisier ce lien dans votre navigateur pour valider votre inscription'."\n\n".$url_valid ; 
     $message_html='<html> 
     <head> 
     <title>'.$MMORPG_Name.' - valider votre inscription</title> 
     </head> 
     <body>
		'.$MMORPG_Description.'<hr/>
		Vous venez d\'effectuer l\'inscription sur le site <a href="'.$_url.'">'.$MMORPG_Name.'</a> .<br/><br/>
        Pour valider votre inscription, cliquez sur ce bouton :
        <form method="post" action="'.get_link('Register','User').'">
            <input type="hidden" name="Account_Key" value="'.$account['Account_Key'].'"/>
            <input type="hidden" name="Account_Email" value="'.$account['Account_Email'].'"/>
            <input type="submit" name="Valid" value="Activer"/>
        </form>
        
        Ou sur <a href="'.$url_valid.'">ce lien</a>
     </body> 
     </html>'; 

	debug_log($message_html,false);
	 
   send_email($account['Account_Email'],$sujet,$message_texte, $message_html);
}



	$record = false ;
		
	if (request_confirm('Register'))
	{
		if(verifier_token(600, get_link('Register','User') ,  'Register-step-1'))
		{
        	extract(addslashes_r($_POST));
    		
    		if (request_confirm('Pseudo') && request_confirm('Password') && request_confirm('Email'))
    		{
    			if(filter_var($Email, FILTER_VALIDATE_EMAIL) !== false)  //Validation d'une adresse de messagerie.
    			{
    				if ($Password == $Password_Confirm)
    				{
    					if (request_confirm('Licence'))
    					{
    						$req_pseudo = get_select_req('request_account',$_POST);
							$Pseudo_List = get_db($req_pseudo); 
									
    						if (empty($Pseudo_List))
    						{
    							$record = true ;
    							$Date = date('Y-m-d H:i:s');
    							$IP = getRealIpAddr();
    							$filter = uniqid();
    							$pswd = password_encode($prefixe_salt.$filter.$suffixe_salt, $Password)		;
    							$key = uniqid();    							
    							
    							insert_db('Caranille_Accounts',array(
    								'Account_Pseudo' => $Pseudo, 
    								'Account_Password' => $pswd, 
    								'Account_Salt' => $filter, 
    								'Account_Email' => $Email, 
    								'Account_Last_Connection' => $Date, 
    								'Account_Inscription' => $Date, 
    								'Account_Last_IP' => $IP ,
    								'Account_HP_Remaining' => 100,
    								'Account_Key' => $key,
    								'Account_valid' => 0 ,
    								'Account_Level' => 1 ,
    								'Account_Order' => 1 ,
    								'Account_Reason' => 'None',
    								'Account_Status' => "Authorized",
    								'Account_Access' => "Member",
    								'Account_Guild_ID' => 0,
    								'Account_HP_Bonus' => 0,
    								'Account_MP_Remaining' => 10,
    								'Account_MP_Bonus' => 0,
    								'Account_Strength_Bonus' => 0,
    								'Account_Magic_Bonus' => 0,
    								'Account_Agility_Bonus' => 0,
    								'Account_Defense_Bonus' => 0,
    								'Account_Experience' => 0,
    								'Account_Golds' => 0,
    								'Account_Notoriety' => 0,
    								'Account_Chapter' => 1,
    								'Account_Mission' => 1
    							));
    		
    	
    							$user_record = get_db($req_pseudo); 
								
    							if(!empty($user_record))
    							{
    							    register_email($user_record);
    							    
    								for( $i = 1 ; $i <= 5 ; $i++)
    									insert_db('Caranille_Inventory',array(
    										'Inventory_Account_ID' => $user_record['Account_ID'],
    										'Inventory_Item_ID' => $i,
    										'Inventory_Item_Quantity' => 1,
    										'Inventory_Item_Equipped' => 'Yes'
    									));
    	
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
	
	if (request_confirm('Regene') or $record)
	{
		$baseline ="Validez vos stats ou regenerez les";

		$Account_HP_Bonus = mt_rand(0, 10);
		$Account_MP_Bonus = mt_rand(0, 10);
		$Account_Strength_Bonus = mt_rand(0, 10);
		$Account_Magic_Bonus = mt_rand(0, 10);
		$Account_Agility_Bonus = mt_rand(0, 10);
		$Account_Defense_Bonus = mt_rand(0, 10);
		
		
		$Account_ID = request_confirm('Regene') ? $_POST['Account_ID']: $user_record['Account_ID'];
	}
	
	if (request_confirm('Order'))
	{
		foreach($_POST as $c => $v)
			if($c != 'Account_ID' && $c !='Order' && $c !='Regene')
				if($v > 10) 
					$_POST[$c] = 1;
					
		update_db('Caranille_Accounts',addslashes_r($_POST));
	}
	
	if (request_confirm('Classe'))
	{
		//$Order_ID = htmlspecialchars(addslashes($_POST['Order_ID']));
		//$Account_Update = $bdd->prepare("UPDATE  SET = :Order_ID WHERE  = :ID");
		//$Account_Update->execute(
		
		extract(stripslashes_r($_POST));
		
		update_db('Caranille_Accounts',array('Account_Order'=> $Order_ID, 'Account_ID'=> $Account_ID));
		
		$message = 'Vous venez de rejoindre un ordre';
		
		add_diary($message);
		//echo '<br /><br />'.$message;
		$baseline =  'Inscription effectuée, vous allez recevoir le mail de validation';

	}
	
	if (request_confirm('Confirm'))
	{
	
	}
	
	if (request_confirm('Valid'))
	{
	    $baseline = 'Validation de votre inscription';
	    
		if(!empty($_GET))extract(addslashes_r($_GET));
		if(!empty($_POST))extract(addslashes_r($_POST));
		
		$user_record = get_db(get_select_req('valid_account',$_REQUEST));
		
		$Date = date("Y-m-d H:i:s");
		
    	if(!empty($user_record))
		{
		    $r = array();
    		$r['Account_ID'] = $user_record['Account_ID'];
    		$r['Account_Key'] = uniqid();
    		$r['Account_Valid'] = 1 ;
			$r['Account_Last_Connection'] = $Date; 
    		//$r['Account_Last_Connected'] = $Date; 
    		
    		update_db('Caranille_Accounts',addslashes_r($r));
    		
    		
		}
	}
	
	if (empty($_POST) && empty($_GET))//['Register']))
	{
	    $baseline =  'Pour commencer une partie veuillez vous inscrire';
	}
	
	if (request_confirm('Valid'))
	{
	   if(isset($r)) echo 'Validation effectuée, vous pouvez vous connecter';
	}
	

	
?>
