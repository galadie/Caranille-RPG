<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$title ="";
	$baseline= LanguageValidation::iMsg("welcome.game.order");//"Bienvenue sur la page des ordres";
	
	if(verif_connect())
	{
		load_css('corps.css','corps');
		load_css('order.css','order');
		
		if(!has_order())
		{
			if (request_confirm('Accept'))
			{
				$Order_ID = htmlspecialchars(addslashes($_POST['Order_ID']));
				
				update_db('Caranille_Accounts',array('Account_Order'=> $Order_ID, 'Account_ID'=> $ID));
				
				$baseline = 'Vous venez de rejoindre un ordre';
				
				add_diary($baseline);
				//echo '<br /><br />'.$message;
			}
		}
	}
	
	

?>
