<?php
	debug_log("exec town",false);
	
	if(verif_connect()) 
	{
		$exit = false ;
		
		if (verif_town())
		{
			$array_town = array( 
				'Town_ID' => $_SESSION['Town_ID'] ,
				'Account_ID' => user_data('Account_ID')
			);
			
			debug_log("verif inside",false);
			
			$information_Town = get_db('request_town',$array_town);

            if(request_confirm('deplacement')) 
			{
                if(verifier_token(60, get_link('Town','Map') ,  'deplacement-Town'))
    		    {
					$position = get_db('position_account',$array_town);
					
    		       list($x , $y) = explode('|', $_POST['deplacement']); 
    				// On sépare les deux valeurs du déplacement. Ici On aura $x qui contiendra la valeur du déplacement horizontalement et $y celles du déplacement vertical.
                    
                    $newX = $x + (!empty($position) ? $position['Position_PosX'] : 0 ); // On calcule les hypothétiques nouvelles coordonnées
                    $newY = $y + (!empty($position) ? $position['Position_PosY'] : 0 );
                    
					// limité à la frontiere de la ville ...
					$min = -1 * abs($rayon_city);
					$max = $rayon_city;
					
					if($newX > $max) $newX = $max ;
					if($newY > $max) $newY = $max ;
					
					if($newX < $min) $newX = $min ;
					if($newY < $min) $newY = $min ;
					
    				$positionnement = array(
						'Position_PosX'=>$newX,
						'Position_PosY'=>$newY,
						'Position_Account_ID'=> user_data('Account_ID'),
						'Position_Town_ID'=>$_SESSION['Town_ID']
					);

                    if(!empty($position)) 
                    {
                        update_db('Caranille_Position',$positionnement);
					}
					else
					{
                        insert_db('Caranille_Position',$positionnement);
					}	
					$message = '<p class="message">Tu réussis à te déplacer en '. $newX .' | '. $newY ."</p>\n";
    		    }
    		    else
    		    {
    		        $message = 'erreur token';
    		    }
			}
			
			//Si l'utilisateur décIDe de quitter la Town
			if (request_confirm('Exit_Town'))
			{
				debug_log("exit request",false);
				
				if(verifier_token(60, get_link('Town','Map') ,  'Exit_Town-'.$_SESSION['Town_ID']))
    		    {
					debug_log("truly exit",false);
					 
					$_SESSION['Town'] = 0;
                    $message = "Vous venez de quitter la ville ".$_SESSION['Town_Name'] ;
                    $exit = true;
    				add_diary($message );
    		    }
			}
			
			include_once($_path."Sources/Map/Modules/Index.php");

		}
	}