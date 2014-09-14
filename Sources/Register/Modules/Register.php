<?php

if(isset($_SESSION['Account_Register']))
{
	debug_log("resgister-module => get user(".print_r($_SESSION['Account_Register'],1).")");

    $user_record = get_db('request_account',$_SESSION['Account_Register']); 
	
	debug_log("resgister-module => get user(".print_r($user_record,1).")");
}

function register_request()
{
    global $prefixe_salt , $suffixe_salt ;
    
    extract(addslashes_r(stripslashes_r($_POST)));
        		
    $Date = date('Y-m-d H:i:s');
	$IP = getRealIpAddr();
	$filter = uniqid();
	$pswd = password_encode($prefixe_salt.$filter.$suffixe_salt, $Password)		;
	$key = uniqid();    							
	
	insert_db('Caranille_Accounts',array(
		'Account_Pseudo' => strip_tags($Pseudo), 
		'Account_Password' => strip_tags($pswd), 
		'Account_Salt' => $filter, 
		'Account_Email' => $Email, 
		'Account_Sexe' => $Sexe ,
		//'Account_Last_Connection' => $Date, 
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
		'Account_Mission' => 1,
		'Account_Step' => 2 ,
	));


	$user_record = get_db('request_account',$_POST); 

    return $user_record ;	
}

function content_valid_mail($account)
{
	global $_url, $MMORPG_Name, $MMORPG_Description;
    //----------------------------------------------- 
     //DECLARE LES VARIABLES 
     //----------------------------------------------- 

	 $url_valid = get_link('End','Register',array(
	 
		'Valid'=>'Activer',
		'Account_Key'=>$account['Account_Key'],
		'Account_Email'=>$account['Account_Email'],
		
	 ));
	 
     $message_texte='Bonjour,'."\n\n".'utiliser ce lien dans votre navigateur pour valider votre inscription'."\n\n".$url_valid ; 
     $message_html='<html> 
     <head> 
     <title>'.$MMORPG_Name.' - valider votre inscription</title> 
     </head> 
     <body>
		'.$MMORPG_Description.'<hr/>
		Vous venez d\'effectuer l\'inscription sur le site <a href="'.$_url.'">'.$MMORPG_Name.'</a> .<br/><br/>
        Pour valider votre inscription, cliquez sur ce bouton :
        <form method="post" action="'.get_link('End','Register').'">
            <input type="hidden" name="Account_Key" value="'.$account['Account_Key'].'"/>
            <input type="hidden" name="Account_Email" value="'.$account['Account_Email'].'"/>
            <input type="submit" name="Valid" value="Activer"/>
        </form>
        
        Ou sur <a href="'.$url_valid.'">ce lien</a>
     </body> 
     </html>'; 

	debug_log($message_html,false);
	 
	return array($message_texte, $message_html);
}

function register_email($account)
{
    global $MMORPG_Name ;
	
  	debug_log("register-member-end => send mail init");
  	
	$sujet = "$MMORPG_Name - Validation inscription";

     $destinataire = $account['Account_Email'];//'mail_destinataire@fai.fr';
     
   list ($message_texte, $message_html) = content_valid_mail($account);
   send_email($account['Account_Email'],$sujet,$message_texte, $message_html);
}
	
?>