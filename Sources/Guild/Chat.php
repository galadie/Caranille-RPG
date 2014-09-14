<?php

	if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
			if (request_confirm('Chat-Send'))
    		{
        		//if(verifier_token(600, get_link('Chat','Guild') ,  'guild-Chat-Send'))
    	        //{
    			    $ID = user_data('Account_ID');
    			    $guild_ID = guild_data('Guild_ID');
    		    	$Message = request_data('chat_Message');
    			
    		    	insert_db('Caranille_Chat',array('Chat_Pseudo_ID' => $ID, 'Chat_Guild_ID' => $guild_ID, 'Chat_Message' => $Message));
    	       // }
    		}
    		
    		if(verif_access("Admin",true))
    	    {
    			if (request_confirm('Chat-Clear'))
    		    {
        	    	//if(verifier_token(600, get_link('Chat','Guild') ,  'guild-Chat-Send'))
    	            //{
    			    	delete_db('Caranille_Chat',array('Chat_Guild_ID' => guild_data('Guild_ID') ));
						echo 'Tous les messages ont bien été supprimé';
    	            //}
    			}
    		}

			echo "<div id='guild-chat'>";
			echo LanguageValidation::iMsg("intro.guild.chat");
			echo '<br />';
			echo '<iframe class="chatroom-frame" src="'.get_link('guild','Chat').'"></iframe>';
			
			 echo formulaire_input(array(
			
					text_input("label.chat.message","chat_Message",null,null,null,"placeholder.chat.message")
				,	submit_input("Chat-Send","btn.chat.send")
				, 	( verif_access("Admin",true) ? submit_input("Chat-Clear","btn.chat.clear") : null)
			
			),"guild-Chat-Send",null,"post",null);

/**			
			echo '<form method="POST" action="'.get_link("Chat","Guild").'">';
			echo '<input type="text" name="chat_Message" placeholder="'.LanguageValidation::nMsg("placeholder.chat.message").'"/>'.LanguageValidation::eMsg("placeholder.chat.message");
			echo '<input type="submit" name="Chat-Send" value="'.LanguageValidation::nMsg("btn.chat.send").'"/>'.LanguageValidation::eMsg("btn.chat.send");
		
			if(verif_access("Admin",true))
				echo '<input type="submit" name="Clear" value="'.LanguageValidation::nMsg("btn.chat.clear").'"/>'.LanguageValidation::eMsg("btn.chat.clear");
				
			echo '<input type="hidden" name="token" value="'.generer_token('guild-Chat-Send').'" />';
			echo '</form>';				
**/			echo "</div>";
		}
	}
?>