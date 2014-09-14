<?php
	//$title ="";	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$baseline= ""

	if (request_confirm('Delete'))
	{
		if(verifier_token(600, get_link('Delete_Account','User') ,  'Delete_Account-step-2'))
		{
			extract(addslashes_r($_POST));

			$Delete_List = get_db('request_account',$_POST); 
			
			if (!empty($Delete_List))
			{
				if( $Password === password_decode($prefixe_salt.$Delete_List['Account_Salt'].$suffixe_salt, $Delete_List['Account_Password'] ) )
				{
					delete_db('Caranille_Accounts',$Delete_List);
		
					echo 'Votre compte ainsi que toute vos données personnelles ont été définitivement supprimée';
				}
				else
				{
					echo 'Mauvaise combinaison Pseudo/Mot de Passe';
				}
			}
			else
			{
				echo 'compte inconnu';
			}
		}
	}
?>
