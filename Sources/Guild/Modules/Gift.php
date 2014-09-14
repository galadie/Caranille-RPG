<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$title ="";
	//$baseline= ""

	if(verif_connect())
    {
load_css('guild.css','guild');

		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
			if(request_confirm('Golds-Send'))
            {
            	if(verifier_token(600, get_link('Gift','Guild') ,  'guild-golds-Send'))
    	        {
                    if(user_data('Account_Golds') > $_POST['golds'])
                    {
                         $ID = user_data('Account_ID');
    			        $guild_ID = guild_data('Guild_ID');
    			        
                        //print_r($_POST);

                         // retirer xp joueur
                    	update_db('Caranille_Accounts',array(
    								'Account_ID' => user_data('Account_ID'),
    								'Account_Golds'=> (user_data('Account_Golds')-$_POST['golds'])
    							));
    							
                         // ajouter xp guild
                    	update_db('Caranille_Guilds',array(
    								'Guild_ID' => guild_data('Guild_ID'),
    								'Guild_Golds'=> (guild_data('Guild_Golds')+$_POST['golds'])
    							));
    							
    				    echo "experience offerte";
                    }
    	        }
            }
            else
            if(request_confirm('xp-Send'))
            {
            	if(verifier_token(600, get_link('Gift','Guild') ,  'guild-xp-Send'))
    	        {
                    if(user_data('Account_Experience') > $_POST['experience'])
                    {
                         $ID = user_data('Account_ID');
    			        $guild_ID = guild_data('Guild_ID');
    			        
                        //print_r($_POST);

                         // retirer xp joueur
                    	update_db('Caranille_Accounts',array(
    								'Account_ID' => user_data('Account_ID'),
    								'Account_Experience'=> (user_data('Account_Experience')-$_POST['experience'])
    							));
    							
                         // ajouter xp guild
                    	update_db('Caranille_Guilds',array(
    								'Guild_ID' => guild_data('Guild_ID'),
    								'Guild_Experience'=> (guild_data('Guild_Experience')+$_POST['experience'])
    							));
    							
    				    echo "experience offerte";
                    }
    	        }
            }
            
		}
	}