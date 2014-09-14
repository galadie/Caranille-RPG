<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$title ="";
	//

	 if(verif_connect())
    {
		load_css('guild.css','guild');
		//Si l'utilisateur ne possède pas de Guilde
        if(!has_guild())
        {
			$baseline= LanguageValidation::iMsg("welcome.guild.none");//
			if (request_confirm('Accept'))
        	{
	        	if(verifier_token(60, get_link('Guild','Guild') ,  'guild-accept'))
        	    {
            		//$Guild_ID = htmlspecialchars(addslashes($_POST['Guild_ID']));
            		//$Guild_Name = htmlspecialchars(addslashes($_POST['Guild_Name']));
            		//$Guild_Description = htmlspecialchars(addslashes($_POST['Guild_Description']));
            		
            	    extract(addslashes_r($_POST));
    
            		update_db('Caranille_Accounts',array('Account_Guild_ID'=>$Guild_ID, 'Account_ID' => $ID));
            		
            		$message = "Vous venez de rejoindre la guilde $Guild_Name";
            		
            		add_diary($message);
            		
            		$baseline =  $message ;
        	    }
        	}
        	
			if (request_confirm('Confirm'))
        	{
	        	if(verifier_token(60, get_link('Guild','Guild') ,  'guild-create'))
        	    {
            	    extract(addslashes_r($_POST));
            	    
            		insert_db('Caranille_Guilds',array('Guild_Name'=> $Guild_Name, 'Guild_Owner_ID'=> $ID, 'Guild_Description'=> $Guild_Description));
            		
            		//Pour mettre le compte de l'utilisateur à jour avec l'ID de la guild ont fait une recherche de l'id de la guild précédament crée
            		$Guild_Query = get_db("edit_admin",array(
							'table' => 'Caranille_Guilds' ,
							'ID' => 'Guild_Name',
							'value' => $Guild_Name
						));
						    
            		if(!empty($Guild_Query))
            		{
            			$Guild_ID = $Guild_Query['Guild_ID'];//last_id_db(); //
    
                        update_db('Caranille_Accounts',array('Account_Guild_ID'=>$Guild_ID, 'Account_ID' => $ID));
						
						$message = "Vous avec créer la guilde ".$Guild_Name;
						
						add_diary($message);
						
						$baseline =  $message;
    
            		}
        	    }
        	}
		 }
       
	}
	
?>
