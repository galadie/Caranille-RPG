<?php

	if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
			echo "<div id='guild-chat'>";
			echo LanguageValidation::iMsg("intro.guild.chat");
			echo '<br />';
			echo '<iframe class="chatroom-frame" src="'.get_link('guild','Chat').'"></iframe>';
			
			echo '<form method="POST" action="'.get_link("Chat","Guild").'">';
			echo '<input type="text" name="chat_Message" placeholder="'.LanguageValidation::nMsg("placeholder.chat.message").'"/>'.LanguageValidation::eMsg("placeholder.chat.message");
			echo '<input type="submit" name="Chat-Send" value="'.LanguageValidation::nMsg("btn.chat.send").'"/>'.LanguageValidation::eMsg("btn.chat.send");
		
			if(verif_access("Admin",true))
				echo '<input type="submit" name="Clear" value="'.LanguageValidation::nMsg("btn.chat.clear").'"/>'.LanguageValidation::eMsg("btn.chat.clear");
				
			echo '<input type="hidden" name="token" value="'.generer_token('guild-Chat-Send').'" />';
			echo '</form>';				
			echo "</div>";
		}
	}
?>