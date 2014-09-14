<?php	

	if(verif_access("Modo"))
	{
		if (request_confirm('Add'))
		{
			if (request_confirm('Account_Reason') && request_confirm('Account_ID'))
			{
			    
			    $sanction['Account_Status'] = "Banned";
				$sanction['Account_Reason'] = request_post('Account_Reason');	
				$sanction['Account_ID'] = request_post('Account_ID');

                insert_db('Caranille_Accounts',$sanction);
			
				echo 'Sanctions ajoutée';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
	}
	
?>
