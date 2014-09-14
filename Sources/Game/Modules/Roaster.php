<?php
	
	if(request_confirm('engage'))
	{
		if(verifier_token(60, get_link('Roaster','Game') ,  'roaster-engage-'.$_POST['Account_ID']))
		{
			if(user_data('Account_Roaster_ID') == 0)
			{
				$_POST['Account_Roaster_ID'] = insert_db('Caranille_Roaster',array('Roaster_Member_1' => user_data('Account_ID') ));
				
				user_set('Account_Roaster_ID',$_POST['Account_Roaster_ID']);
				user_record();
			}
			
			update_db('Caranille_Accounts',stripslashes_r($_POST));
		}
	}

?>