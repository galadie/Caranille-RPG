<?php
if(!function_exists('bousole'))
{
	function bousole($carte="Map")
	{
	?>
		<form class="boussole" method="post">
			<input type="submit" name="deplacement" value="-1|0" class="arrow topleft"/>
			<input type="submit" name="deplacement" value="0|1"  class="arrow up"/>
			<input type="submit" name="deplacement" value="-1|0" class="arrow left"/>
			<div id="position">
			<?php if($carte == "Map") echo user_data("Account_PosX")."-".user_data("Account_PosY") ?>
			<?php if($carte == "Town") {
				
				$recup = get_db("SELECT Position_PosX,Position_PosY FROM Caranille_Position WHERE Position_Account_ID = '".user_data('Account_ID')."' and Position_Town_ID = '".$_SESSION['Town_ID']."' limit 1") ;

				echo $recup['Position_PosX']."-".$recup['Position_PosX'];

			} ?>  		
			</div><input type="submit" name="deplacement" value="1|0"  class="arrow right"/>
			<input type="submit" name="deplacement" value="0|-1" class="arrow down"/>
			<input type="hidden" name="token" value="<?php echo generer_token('deplacement-'.$carte) ?>" />
		</form>       
	<?php
	}
}

load_css('map.css','map');
load_css('boussole.css','boussole');
	
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$title ="";
    $baseline= "Bienvenue ".   ($_SESSION['Town'] == 0 ? "dans la carte du monde" : "à " .$_SESSION['Town_Name']);
	
	if(verif_connect()) 
	{
		if ($_SESSION['Town'] == 0)
		{			
			if(request_confirm('deplacement')) 
			{
                if(verifier_token(600, get_link('Map','Map') ,  'deplacement-Map'))
    		    {
    		        $deplacement = explode('|', $_POST['deplacement']); 
    				// On sépare les deux valeurs du déplacement. Ici On aura $deplacement['0'] qui contiendra la valeur du déplacement horizontalement et $deplacement ['1'] celles du déplacement vertical.
                
                    $valX = $deplacement['0']; // On utilise des noms de variable plus clairs.
                    $valY = $deplacement['1'];
                    
                    $newX = $valX + user_data('Account_PosX'); // On calcule les hypothétiques nouvelles coordonnées
                    $newY = $valY + user_data('Account_PosY');
           
    				$verif = get_db("SELECT Account_Pseudo FROM Caranille_Accounts WHERE Account_PosX='$newX' AND Account_PosY='$newY'") ; 
    				// Recherche des personnages à la case où le joueur souhaite aller.
                                    
                    if(!empty($verif)) 
    				{ 
                            // S'il y a déjà quelqu'un sur cette case.
                            $message = '<p class="message">Tu ne peux pas te déplacer en '. $newX .' | '. $newY . "<br />\n";
                            $message .= 'Cette case est occupée par '. $verif['Account_Pseudo']. "</p>\n";
                    }
                    else 
    				{
                            //mysql_query("UPDATE Caranille_Accounts SET posx='$newX', posy='$newY' WHERE Account_Name='".user_data('Account_Pseudo')."';") ); // Et maintenant seulement on met à jour !
                             update_db('Caranille_Accounts',array(
    							'Account_PosX'=>$newX,
    							'Account_PosY'=>$newY,
    							'Account_ID'=> user_data('Account_ID')
    						));
    						
    						$message = '<p class="message">Tu réussis à te déplacer en '. $newX .' | '. $newY ."</p>\n";
                    }
    		    }
			}
						
			if (request_confirm('entrer_Town'))
			{
				$Town_ID = htmlspecialchars(addslashes($_POST['Town_ID']));
				
				if(verifier_token(60, get_link('Map','Map') ,  'entrer_Town-'.$Town_ID))
    		    {
                    $information_Town = get_db("SELECT * FROM Caranille_Towns WHERE Town_ID= $Town_ID Limit 1 ;");
    
    			    if(!empty($information_Town))
    				{
    					$_SESSION['Town_ID'] = stripslashes($information_Town['Town_ID']);
    					$_SESSION['Town_Image'] = stripslashes($information_Town['Town_Image']);	
    					$_SESSION['Town_Name'] = stripslashes($information_Town['Town_Name']);
    					$_SESSION['Town_Description'] = stripslashes(nl2br($information_Town['Town_Description']));
    					$_SESSION['Town_Price_INN'] = stripslashes($information_Town['Town_Price_INN']);
						$_SESSION['Town_Landing']= stripslashes($information_Town['Town_Landing']);
    					$_SESSION['Town'] = 1;
    				}
    				
    				$message = "Vous entrez dans la ville ".$information_Town['Town_Name'] ;
    				
    				add_diary($message);
    		    }

			}
			//else
			//
		}
		//Si la session Town contient 1, c'est que l'utilisateur a bien selectioné une Town, on affiche donc le menu
		if ($_SESSION['Town'] == 1)
		{
			$position = get_db("SELECT * FROM Caranille_Position WHERE Position_Town_ID='".$_SESSION['Town_ID']."' AND Position_Account_ID='".user_data('Account_ID')."' limit 1") ; 

            if(request_confirm('deplacement')) 
			{
                if(verifier_token(60, get_link('Map','Map') ,  'deplacement-Town'))
    		    {
    		        $deplacement = explode('|', $_POST['deplacement']); 
    				// On sépare les deux valeurs du déplacement. Ici On aura $deplacement['0'] qui contiendra la valeur du déplacement horizontalement et $deplacement ['1'] celles du déplacement vertical.
                    
                    $newX = $deplacement['0'] + (!empty($position) ? $position['Position_PosX'] : 0 ); // On calcule les hypothétiques nouvelles coordonnées
                    $newY = $deplacement['1'] + (!empty($position) ? $position['Position_PosY'] : 0 );
                    
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
    		    if(verifier_token(60, get_link('Map','Map') ,  'Exit_Town-'.$_SESSION['Town_ID']))
    		    {
    				$_SESSION['Town'] = 0;
                    $message = "Vous venez de quitter la ville ".$_SESSION['Town_Name'] ;
                    
    				add_diary($message );
    			/**	
    				echo '<p>'.$message.'<br/><br/>';			
    				echo '<form method="POST" action="'.get_link('Map','Game').'">';
    				echo '<input type="submit" name="carte" value="Retourner à la carte du monde">';
    		        echo '<input type="hidden" name="token" value="'.generer_token('carte').'" />';
    				echo '</form></p>';
				**/
    		    }
			}
			//else
		}
	}

