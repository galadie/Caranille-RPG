<?php
		include_once($_path."Sources/Map/Modules/Index.php");

	debug_log( "exec world.....");
	
	if(verif_connect()) 
	{
		$enter = false ;
		
		if (!verif_town())
		{			
			if(request_confirm('deplacement')) 
			{
                if(verifier_token(600, get_link('World','Map') ,  'deplacement-Map'))
    		    {
    		        $deplacement = explode('|', $_POST['deplacement']); 
    				// On sépare les deux valeurs du déplacement. Ici On aura $deplacement['0'] qui contiendra la valeur du déplacement horizontalement et $deplacement ['1'] celles du déplacement vertical.
                
                    $valX = $deplacement['0']; // On utilise des noms de variable plus clairs.
                    $valY = $deplacement['1'];
                    
                    $newX = $valX + user_data('Account_PosX'); // On calcule les hypothétiques nouvelles coordonnées
                    $newY = $valY + user_data('Account_PosY');
           
    				$verif = get_db('coords_account',compact($newX ,$newY )); 
    				// Recherche des personnages à la case où le joueur souhaite aller.
                                    
                    if(!empty($verif)) 
    				{ 
                            // S'il y a déjà quelqu'un sur cette case.
                            $message = 'Tu ne peux pas te déplacer en '. $newX .' | '. $newY . "<br />\n";
                            $message .= 'Cette case est occupée par '. $verif['Account_Pseudo']. "\n";
                    }
                    else 
    				{
                            //mysql_query("UPDATE Caranille_Accounts SET posx='$newX', posy='$newY' WHERE Account_Name='".user_data('Account_Pseudo')."';") ); // Et maintenant seulement on met à jour !
                             update_db('Caranille_Accounts',array(
    							'Account_PosX'=>$newX,
    							'Account_PosY'=>$newY,
    							'Account_ID'=> user_data('Account_ID')
    						));
    						
    						$message = 'Tu réussis à te déplacer en <br/>'. $newX .' | '. $newY ."\n";
                    }
    		    }
			}
			
			if(request_confirm('recolte')) 
			{
                if(verifier_token(600, get_link('World','Map') ,  'recolte-map'))
    		    {
					if(isset($array_work_class['recolte']))//if(!empty($jobs))
					{
						foreach($array_work_class['recolte'] as $recolte)//foreach($jobs as $job)
						{
							if(request_confirm($recolte))
							{		
								$activite = $recolte;
								$job = get_db('fabrique_works',array('Type'=>$activite));
								
								if(isset($job))
								{									
									$comp = get_db('account_work_competence',array( 'Account_ID' => logged_data('Account_ID'), 'Work_ID' => $job['Work_ID'] ));
									$MIN_Prospect = $comp['Competence_Level'] + $bonus_malus_prospection;
									$MAX_Prospect = $comp['Competence_Level'] - $bonus_malus_prospection;
								}
							}
						}
					
						$prospect = mt_rand($MAX_Prospect , $MIN_Prospect);
						
						debug_log("-[$prospect] = mt_rand($MAX_Prospect , $MIN_Prospect)");
						
						if($prospect > 0)
						{
							debug_log(" -> recolte");
							
							$ress = list_db('random_ressource',array('Type'=>$activite,'Limit'=>$prospect));
							
							debug_log('random_ressource=>'.print_r($ress,1));
							
							if(isset($ress) && !empty($ress))
							{
								foreach($ress as $r)
								{
									gain_ressource($r['Ressource_ID']);
									$message = "Vous avez gagné l'objet suivant: ".stripslashes($r['Ressource_Name']);
								}
								add_diary($message);
							
								if($comp['Competence_Level']>0)
								{
									debug_log( "pexing update");
									
									$comp['Competence_Experience']++;
									
									update_db('Caranille_Competences',$comp);
								}
								else
								{
									debug_log( "pexing create");
									
									insert_db('Caranille_Competences', array(
											'Competence_Work_ID' => $job['Work_ID']
										,	'Competence_Account_ID'  => logged_data('Account_ID')
										,	'Competence_Level' => 1     
										,	'Competence_Experience' => 1
									));
								}
							}
						}
					}
				}
			}
						
			if (request_confirm('entrer_Town'))
			{
				$Town_ID = htmlspecialchars(addslashes($_POST['Town_ID']));
				
				if(verifier_token(60, get_link('World','Map') ,  'entrer_Town-'.$Town_ID))
    		    {
                    debug_log( "truly enter...");
					
					$information_Town = get_db('request_town',addslashes_r($_POST));
    
    			    if(!empty($information_Town))
    				{
    					$_SESSION['Town_ID'] = intval($information_Town['Town_ID']);
						$_SESSION['Town'] = true ;
    				}
    				
    				$message = "Vous entrez dans la ville ".$information_Town['Town_Name'] ;
    				$enter = true ;
    				add_diary($message);
    		    }

			}
			
		}
	}