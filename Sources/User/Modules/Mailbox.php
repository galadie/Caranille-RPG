<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	$title ="Messagerie";
	$baseline= LanguageValidation::iMsg("welcome.private.message");//"";
	
	if(verif_connect()) 
	{
		//Si l'utilisateur souhaite supprimé un message
		if (request_confirm('Delete'))
		{
			$Private_Message_ID = htmlspecialchars(addslashes($_POST['Private_Message_ID']));
			
			delete_db('Caranille_Private_Messages',array('Private_Message_ID' => $Private_Message_ID));
			
			echo 'Votre message a bien été supprimé';
		}
		
		if (request_confirm('Send'))
		{
    		 if(verifier_token(600, get_link('Mailbox','User') ,  'Mailbox-Send'))
	        {
	            $Transmitter = logged_data('Account_ID');
	            
	            extract(addslashes_r($_POST));

                insert_db('Caranille_Private_Messages',array(
                    'Private_Message_Transmitter' => $Transmitter, 
                    'Private_Message_Receiver' => $Receiver, 
                    'Private_Message_Subject' => $Message_Subject, 
                    'Private_Message_Message' => $Message,
                    'Private_Message_Conversation' => (isset($Conversation) ? $Conversation : null)
                ));

    			echo 'Votre message a bien été envoyé';
	        }
		}
		
	}
	
?>