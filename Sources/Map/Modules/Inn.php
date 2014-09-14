<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	
	$title ="";
	
	$baseline= LanguageValidation::iMsg("welcome.map.inn");//"";
	
	if(verif_connect())
	{
		if (verif_town())//($_SESSION['Town'] == 1)
		{
			$array_town = array( 
				'Town_ID' => $_SESSION['Town_ID'] ,
				'Account_ID' => user_data('Account_ID')
			);
			
			debug_log("verif inside",false);
			
			$information_Town = get_db('request_town',$array_town);			
			
			if (request_confirm('Rest'))
			{
				if (user_data('Account_Golds') >= $information_Town['Town_Price_INN'])
				{
					$Gold = user_data('Account_Golds') - htmlspecialchars(addslashes($information_Town['Town_Price_INN']));
					$HP_Total = perso_data('HP_Total');
					$MP_Total = perso_data('MP_Total');
					
					update_db('Caranille_Accounts',array('Account_HP_Remaining'=> $HP_Total, 'Account_MP_Remaining'=> $MP_Total, 'Account_Golds'=> $Gold, 'Account_ID'=> $ID));
				}
			}
		}
	}			
	
?>
