<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	$title ="ChatRoom";
	$baseline= LanguageValidation::iMsg("welcome.public.chat");//"Bienvenue dans le chat publique";
	
	if(verif_connect()) 
	{
		if (request_confirm('Send'))
		{
    		if(verifier_token(600, get_link('Chat','User') ,  'Chat-Send'))
	        {
			    $ID = user_data('Account_ID');
		    	$Message = htmlspecialchars(addslashes($_POST['Message']));
			
		    	insert_db('Caranille_Chat',array('Chat_Pseudo_ID' => $ID, 'Chat_Message' => $Message));
	        }
		}
		if(verif_access("Admin",true))
	    {
			if (request_confirm('Clear'))
		    {
    	    	if(verifier_token(600, get_link('Chat','User') ,  'Chat-Send'))
	            {
					delete_db('Caranille_Chat');
			    	echo 'Tous les messages ont bien été supprimé';
	            }
			}
		}
		
	}

?>
