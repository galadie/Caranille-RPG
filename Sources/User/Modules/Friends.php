<?php	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	$title ="Amis";
	$baseline= LanguageValidation::iMsg("welcome.user.friends.list");//"";
	
	if(verif_connect()) 
	{
	    if(request_confirm('add'))
	    {
	        $Account_ID = intval(request_get('add'));
	        
	        if($Account_ID > 0)
	        {
	            insert_db('Caranille_Friends', array(
	                
	                    'Friend_Request' => logged_data('Account_ID'),
	                    'Friend_Answer' => $Account_ID
	                    
	                ));
	        }
	    }
	    
	     if(request_confirm('del'))
	    {
	        $Account_ID = intval(request_get('del'));
	        
	        if($Account_ID > 0)
	        {
	            delete_db('Caranille_Friends', array(
	                
	                    'Friend_Request' => logged_data('Account_ID'),
	                    'Friend_Answer' => $Account_ID
	                    
	                ));
	                
	            delete_db('Caranille_Friends', array(
	                
	                    'Friend_Answer' => logged_data('Account_ID'),
	                    'Friend_Request' => $Account_ID
	                    
	                ));
	        }
	    }
	    
	    $Player_List = list_db('list_account_friends',array('Account_ID'=>logged_data('Account_ID')));

	}