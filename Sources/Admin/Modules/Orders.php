<?php
	if(verif_access("Admin"))
	{
		if (request_confirm('End_Edit'))
		{
			if (request_confirm('Order_Name') && request_confirm('Order_Description'))
			{
				update_db('Caranille_Orders',addslashes_r($_POST));
				echo 'L\'ordre a été mit à jour';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
	}

	
?>
