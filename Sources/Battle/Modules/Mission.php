<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	$title ="Mission";
	$baseline= "";	
	
	include_once("Battle/Index.php");
		
	
	if(verif_connect())
	{
		
		if (verif_town())//($_SESSION['Town'] == 1)
		{
			$roaster = get_roaster();
			
		    if (request_confirm('Accept'))
			{			    
				$_SESSION['Mission_ID'] = $Mission_ID = htmlspecialchars(addslashes($_POST['Mission_ID']));

				$Mission_Monster = get_db('mission_content',array('Mission_ID'=>$Mission_ID));

                if(!empty($Mission_Monster))
				{
				    init_battle('Monster',$Mission_Monster,'Mission');
				    
				}
			}
			else //	if (empty($_POST['combattre_mission']) && empty($_POST['Accept']))
			{
				// selection de la mission en cours : la mission suivant la plus recente remporté par le joueur
				$Mission = get_db('mission_account',array('Player_Mission_Level'=> user_data('Account_Mission'), 'Town' => $_SESSION['Town_ID'] ) ); 
				
				if(!empty($Mission))
				{
					$_SESSION['Mission_ID'] = stripslashes($Mission['Mission_ID']);
				}
				
			}
		}
	}
					
	
?>
