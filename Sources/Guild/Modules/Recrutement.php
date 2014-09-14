<?php
	if(verif_connect())
    {
		load_css('guild.css','guild');

        if(has_guild())
        {		
			if(has_guild_acces('recrutement'))
			{
				if(request_confirm('guild-engage') || request_confirm('guild-refuse') )
				{
					if(verifier_token(60, get_link('Recrutement','Guild') ,  'guild-candidat-'.$_POST['Account_ID']))
					{
						$Account_Query = get_db("candidat_guild_confirm",array(
						        'Guild_ID' => guild_data('Guild_ID'),
						        'Account_ID' => request_post('Account_ID')
						    ));
						
						
						if(!empty($Account_Query))
						{
							if(request_confirm('guild-engage'))
							{
								update_db('Caranille_Accounts',stripslashes_r($_POST));
								$message = "Vous avez été accepté dans la guilde ".guild_data('Guild_Name').".";
							}
							else
							{
								update_db('Caranille_Accounts',array(
									'Account_ID' => $Account_Query['Account_ID'],
									'Account_Guild_ID' => 0,
									'Account_Guild_Accept' => 0,
								) );
								$message = "Votre candidature dans la guilde ".guild_data('Guild_Name')." a été refusé.";
							}
							
							add_diary($message,$Account_Query['Account_ID']);
							
							insert_db('Caranille_Private_Messages',array(
								'Private_Message_Transmitter' => logged_data('Account_ID'), 
								'Private_Message_Receiver' => $Account_Query['Account_Pseudo'], 
								'Private_Message_Subject' => "Votre candidature dans la guilde ".guild_data('Guild_Name') , 
								'Private_Message_Message' => $message,
								'Private_Message_Conversation' => null
							));
						}
					}
				}			
			}
		}
	}
?>