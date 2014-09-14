<?php /** rien à faire ici **/

load_css('corps.css','corps');

	if(verif_connect())
	{
		// action dans l'inventaire
		if (request_confirm('chara-design'))
		{
			if(request_confirm('Roaster'))
			{
				user_set('Account_Roaster_Accept',$_POST['Roaster']);
			}
			user_record();
		}
	}