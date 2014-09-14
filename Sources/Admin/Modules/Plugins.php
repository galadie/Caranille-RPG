<?php
	if(verif_access("Admin"))
	{
		if(request_confirm('plugin'))
		{
			if(request_confirm('confirm'))
			{	
				delete_db('Caranille_Plugins');
				
				foreach($_POST['plugin'] as $p => $plug)
				{
					if(isset($plug['active']) ) //&& $plug['active'] =='on')
					{
						insert_db('Caranille_Plugins', array('Plugin_Active' => 1 , 'Plugin_Name' => $plug['nom'] )) ;
					}
				}
			}
		}
	}
?>