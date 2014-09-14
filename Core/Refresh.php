<?php

if(verif_connect(true))
{
	/**
	 * Variables Globales
	 */
	$ID = user_data('Account_ID');
	$Date = date('Y-m-d H:i:s');
	$IP = getRealIpAddr();
	$Pseudo = logged_data('Account_Pseudo');
		
	init_stat_session();
	
	clear_token(); // => trop brutal... 
	
	clear_battle();
	
	debug_log('Account_ID::'.logged_data('Account_ID'));
	debug_log('Account_Pseudo::'.logged_data('Account_Pseudo'));
	
	/**
	 * Vérification des sanctions pour l'utilisateur
	 */
	$Warning_List = get_db("get_sanction_user",array( 'Account_ID'=> logged_data('Account_ID') ));
	
	if(!empty($Warning_List))
	{
	    extract(stripslashes_r($Warning_List));
	    
		$message= "Vous avez recu un(e) $Sanction_Type de la part de $Sanction_Transmitter\\n\\n$Sanction_Message";

        delete_db('Caranille_Sanctions',array('Sanction_ID' => $Sanction_ID));
	}

	/*
	Mise à jour du compte en temps réel
	*/
	
	//get_user($Pseudo);
	
	if(verif_auth())// (user_data('Account_Status') == "Authorized")
	{
		init_equipement_session();
   	
 		get_perso($Pseudo);
		get_equipement($Pseudo);
    	get_Guild($Pseudo);
    	
    	$Next_Level = get_new_level();
		
 		updateConnected();
	}
    else
    {
 		$Reason = user_data('Account_Reason');
	    $message ="IMPOSSIBLE DE SE CONNECTER\\nVotre compte est banni pour la raison suivante :\\n : $Reason";
        session_destroy();
    }
    if(isset($message) && !empty($message))
        echo "<script type=\"text/javascript\"> alert(\"$message\"); </script>";
}
else
	logged_set('Account_Access','Visit');
	

?>
