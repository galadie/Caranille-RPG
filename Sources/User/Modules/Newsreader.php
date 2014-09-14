<?php

function register_email($Newsreader)
{
    //----------------------------------------------- 
     //DECLARE LES VARIABLES 
     //----------------------------------------------- 

    $sujet = "Validation inscription";

     $destinataire = $Newsreader['Newsreader_Email'];//'mail_destinataire@fai.fr';
     
     $url_valid = get_link('Newsreader','User')."?Valid=Activer&Newsreader_Key=".$Newsreader['Newsreader_Key']."&Newsreader_Email=".$destinataire ;

     $message_texte='Bonjour,'."\n\n".'utilisier ce lien dans votre navigateur pour valider votre inscription'."\n\n".$url_valid ; 
     $message_html='<html> 
     <head> 
     <title>Titre</title> 
     </head> 
     <body>
        Pour valider votre inscription, cliquez sur ce bouton :
        <form method="post" action="'.get_link('Newsreader','User').'">
            <input type="hidden" name="Newsreader_Key" value="'.$Newsreader['Newsreader_Key'].'"/>
            <input type="hidden" name="Newsreader_Email" value="'.$destinataire.'"/>
            <input type="submit" name="Valid" value="Activer"/>
        </form>
        
        Ou sur <a href="'.$url_valid.'">ce lien</a>
     </body> 
     </html>'; 

   send_email($destinataire,$sujet,$message_texte, $message_html);
}

	$record = false ;
		
	if (request_confirm('Register'))
	{
		if(verifier_token(600, get_link('Members','Register') ,  'Register-step-1'))
		{
        	extract(addslashes_r($_POST));
    		
    		if (request_confirm('Email'))
    		{
    			if(filter_var($Email, FILTER_VALIDATE_EMAIL) !== false)  //Validation d'une adresse de messagerie.
    			{
    				if ($Email == $Email_Confirm)
    				{
						$Pseudo_List = get_db('request_newsreader',$_POST));
	
						if (empty($Pseudo_List))
						{
							$record = true ;
							$Date = date('Y-m-d H:i:s');
							$IP = getRealIpAddr();
							$key = uniqid();    							
							
							insert_db('Caranille_Newsreaders',array(
								'Newsreader_Email' => $Email, 
								'Newsreader_Inscription' => $Date, 
								'Newsreader_Last_IP' => $IP ,
								'Newsreader_Key' => $key,
								'Newsreader_valid' => 0 ,
							));
						}
						else
						{
							 $baseline =  'Ce Pseudo est déjà utilisé';
						}
    				}
    				else
    				{
    					 $baseline =  'Les deux emails entrée ne sont pas identiques';
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

	if (request_confirm('Valid'))
	{
	    $baseline = 'Validation de votre inscription';
	    
		if(!empty($_GET))extract(addslashes_r($_GET));
		if(!empty($_POST))extract(addslashes_r($_POST));
		
		$Newsreader_Data = get_db('valider_newsreader',($_POST+$_GET));
		
		$Date = date("Y-m-d H:i:s");
		
    	if(!empty($Newsreader_Data))
		{
		    $r = array();
    		$r['Newsreader_ID'] = $Newsreader_Data['Newsreader_ID'];
    		$r['Newsreader_Key'] = uniqid();
    		$r['Newsreader_Valid'] = 1 ;
    		
    		update_db('Caranille_Newsreaders',addslashes_r($r));    		
		}
	}
	
?>