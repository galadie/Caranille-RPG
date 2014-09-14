<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$title ="";
	//$baseline= ""

	if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
		
			//echo 'vous appartenez déjà à une guilde';
			if (request_confirm('Chat-Send'))
    		{
        		if(verifier_token(600, get_link('Chat','Guild') ,  'guild-Chat-Send'))
    	        {
    			    $ID = user_data('Account_ID');
    			    $guild_ID = guild_data('Guild_ID');
    		    	$Message = htmlspecialchars(addslashes($_POST['chat_Message']));
    			
    		    	insert_db('Caranille_Chat',array('Chat_Pseudo_ID' => $ID, 'Chat_Guild_ID' => $guild_ID, 'Chat_Message' => $Message));
    	        }
    		}
    		
    		if(verif_access("Admin",true))
    	    {
    			if (request_confirm('Clear'))
    		    {
        	    	if(verifier_token(600, get_link('Chat','Guild') ,  'guild-Chat-Send'))
    	            {
    			    	delete_db('Caranille_Chat',array('Chat_Guild_ID' => guild_data('Guild_ID') ))
						echo 'Tous les messages ont bien été supprimé';
    	            }
    			}
    		}
		}
	}