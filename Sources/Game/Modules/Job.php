<?php

	$competences = list_db('account_work',array( 'Account_ID' => logged_data('Account_ID') ));
	$jobs = list_db('list_works');
	
		
	foreach ($competences as $comp)
	{
		$next = 2 ;
		$niv = 1 ;
		
		$exp = 0 ;
		$req = 0;
		
		if($job['Work_Name'] == $comp['Work_Name'] && $job['Work_Fabrique'] == $comp['Work_Fabrique'] )
		{
			$work = $comp['Competence_Work_ID'] ;
			$niv = $comp['Competence_Level'] ;
			$req = $comp['Level_Experience_Required'] ;
			$exp = $comp['Competence_Experience'] ;
			
			if ($exp < 0) $exp = 0;
		
			$gain = 0 ;
		
			if($exp >= $req)
			{			
				while ($exp >= $req)
				{
					$Level_Data = get_db('get_level_exp_req',array('Account_Level' => ($niv+1) ) );
					
					if(!empty($Level_Data))
					{
						$req = $Level_Data['Level_Experience_Required'];
						$gain++;

						debug_log( "theorical calcul level :: (".($niv+$gain));
						
						if($exp < $req)
							break ;
					}
					else
					{
						debug_log("level max");
						break ;
					}
				}
				
				update_db('Caranille_Competences',array(
						'Competence_Level'=> ($niv+$gain) 
					,	'Competence_Experience'=> $exp
					,	'Competence_Work_ID' => $work
					,	'Competence_Account_ID'=>  user_data('Account_ID') 
				));

				debug_log("Votre personnage vient de gagner [".$gain."] niveau dans le metier {".$comp['Work_Name']."} . Il est maintenant au niveau : $niv");
			}			
		}
	}
	
	$competences = list_db('account_work',array( 'Account_ID' => logged_data('Account_ID') ));
	
?>