<?php

	 if(verif_connect())
    {
		load_css('guild.css','guild');
		
		//Si l'utilisateur ne possède pas de Guilde
		
        if(has_guild())
        {
			if(has_guild_acces('rank'))
			{
				$ct = count_db('guild_list_rank',array( 'Guild_ID' =>user_data('Account_Guild_ID') ) ) ;

				if (request_confirm('create_rank'))
				{
					if(verifier_token(120, get_link('Rank','Guild') ,  'guild-rank-create'))
					{
						$ct++;
						
						insert_db('Caranille_Rank', array('Rank_Name' => request_data('new_rank'), 'Rank_Order' => $ct , 'Rank_Guild_ID' => user_data('Account_Guild_ID')));
					}
				}
			
				if (request_confirm('edit_rank'))
				{
					if(verifier_token(120, get_link('Rank','Guild') ,  'guild-rank-edit-'.request_data('rank') ))
					{					
						update_db('Caranille_Rank', array('Rank_Name' => request_data('new_rank'), 'Rank_ID' => request_data('rank') ));
					}
				}
			}
			
			if(has_guild_acces('privilege'))
			{
				if (request_confirm('priv_rank'))
				{
					if(verifier_token(120, get_link('Rank','Guild') ,  'guild-rank-priv-'.request_data('rank') ))
					{
						delete_db('Caranille_Privileges', array('Privilege_Rank_ID' => request_data('rank') ) );
						
						foreach($_POST['priv'] as $e => $priv)
						{
							insert_db('Caranille_Privileges', array('Privilege_Rank_ID' => request_data('rank') , 'Privilege_Access' => $priv ) );
						}
					}
				}
			}
			
			if (request_confirm('show_rank'))
			{
				$_rank['Rank_ID'] = request_data('rank');
			}
		}
	}