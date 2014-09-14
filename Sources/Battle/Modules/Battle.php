<?php
	//include_once(path_source("Index","Battle","Battle"));
	include_once("Battle/Index.php");//path_source("Index","Battle"));

	$title = "Affrontement";
        
	$ID = user_data('Account_ID');
	
	if(verif_connect())
	{
		//Si le joueur est dans une ville, on regarde si il est actuellement en combat
		if (verif_battle())
		{			
			$roaster_action = false ;
			//Si l'utilisateur à choisit la fuite
			if (request_confirm('Escape'))
			{
				$message = "Vous avez fuit le combat";
				
				if ($_SESSION['Arena_Battle'] == 1)
				{
					$message .= "Votre fuite de l'arène vous fait perdre 1 points de notorieté<br />";
					
					user_set('Account_Notoriety',(user_data('Account_Notoriety')-1));
					
					$Player_ID = monster_data('ID');
					exec_db("UPDATE Caranille_Accounts SET Account_Notoriety= Account_Notoriety + 1 WHERE Account_ID= $Player_ID;");
				}
				
				close_battle();
			}
			
			//Si l'utilisateur continue le combat on vérifie si il y a un gagnant ou un perdant
			if (request_confirm('Continue')) 
			{
				include_once("Battle/Continue.php");//include_once(path_source('Continue','Battle','Battle'));
				include_once("Battle/Roaster-continue.php");//
			}		
			//Si l'utilisateur à choisit attaquer
			
			if ( request_confirm('Attack')) include_once("Battle/Attack.php");//include_once(path_source('Attack','Battle','Battle'));
			if ( request_confirm('End_Magics'))include_once("Battle/Magics.php");//include_once(path_source('Magics','Battle','Battle'));//request_confirm('Magics') ||
			if ( request_confirm('End_Invocations'))include_once("Battle/Invocations.php");//include_once(path_source('Invocations','Battle','Battle'));//request_confirm('Invocations') ||
			if ( request_confirm('End_Items'))include_once("Battle/Items.php");//include_once(path_source('Items','Battle','Battle'));//request_confirm('Items') ||
			
			if($roaster_action) include_once("Battle/Roaster-attack.php");//
		}
	}
	
?>
