<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$title ="";
	//$baseline= ""

	if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
			menu_guild();
				
			if(has_guild_acces('message'))
			{
				
				echo '<form method="POST" action="'.get_link("Message","Guild").'">';
				echo 'Message de guilde <br />';
				//echo '<textarea name="Guild_Message" ID="Guild_Message" rows="10" cols="50"></textarea><br /><br />';
				echo call_bbcode_editor("Guild_Message",guild_data('Guild_Message'));
				echo '<input type="hidden" name="Guild_ID" value="'.guild_data('Guild_ID').'"/>';
				echo '<input type="hidden" name="token" value="'.generer_token("guild-message").'"/>';
				echo '<input type="submit" name="send-message" value="envoyer le message">';
				echo '</form>';	
			}
		}
	}