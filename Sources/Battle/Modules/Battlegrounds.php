<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$title ="";
	$baseline= "Bienvenue dans le champ de bataille";
	include_once("Battle/Index.php");//(path_source("Index","Battle","Battle"));

	if(verif_connect())
	{
		
		if(has_order())
		{
			if (request_confirm('Launch_Battle'))
			{
				$Account = get_db("battle_account",array(
				        'Account_ID' => request_post('Account_ID')
				    ));
				
				if(!empty($Account))
				{
				    init_battle('Account',$Account,'Arena');
				}
			}
		}
	}

?>
