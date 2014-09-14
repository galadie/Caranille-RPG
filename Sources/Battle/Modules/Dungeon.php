<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	$title ="Donjon";
	$baseline= "Bienvenue dans le donjon";
	include_once("Battle/Index.php");//path_source("Index","Battle"));
	
	if(verif_connect())
	{
		if (verif_town())//($_SESSION['Town'] == 1)
		{			
			if (request_confirm('Battle'))//(verif_battle(true))//
			{
				$ville_actuel = htmlspecialchars(addslashes($_SESSION['Town_ID']));
				$Monster_ID = htmlspecialchars(addslashes($_POST['Monster_ID']));

				$monstre = get_db('request_monster', array('Monster_ID'=>$Monster_ID));
				
				if(!empty($monstre))
				{
				    init_battle('Monster',$monstre,'Dungeon');
				    
				}
			}
			//else
		}
	}	
?>
