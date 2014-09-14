<?php
	
	if(verif_access("Modo"))
	{
		if (request_confirm('End_Add'))
		{
			if (request_confirm('Sanction_Type') && ($_POST['Sanction_Message']) && ($_POST['Sanction_Receiver']))
			{
				$warning['Sanction_Type'] = htmlspecialchars(addslashes($_POST['Sanction_Type']));	
				$warning['Sanction_Message'] = htmlspecialchars(addslashes($_POST['Sanction_Message']));
				$warning['Sanction_Receiver'] = htmlspecialchars(addslashes($_POST['Sanction_Receiver']));
				$warning['Sanction_Transmitter'] = user_data('Account_Pseudo');

                insert_db('Caranille_Sanctions',$warning);

				echo 'Avertissement ajoutée';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
	}
?>
