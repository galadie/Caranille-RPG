<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$title ="";
	//$baseline= ""

	if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
load_css('guild.css','guild');
			if(has_guild_acces('message'))
			{
				if (request_confirm('send-message'))
				{
					if(verifier_token(60, get_link('Message','Guild') ,  'guild-message'))
					{
						update_db('Caranille_Guilds',addslashes_r($_POST));
						
						echo "Message mis à jour";
					}
				}
			}
		}
	}