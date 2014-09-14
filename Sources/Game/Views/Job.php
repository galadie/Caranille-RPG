<?php
	if(verif_connect()) 
	{
		menu_character();

		if(!empty($jobs))
		{
			foreach($jobs as $job)
			{
				$niv = 0 ;
				
				echo $job['Work_Name']."(".$job['Work_Fabrique'].") <-> ";
				
				if(!empty($competences))
					foreach ($competences as $comp)
						if($job['Work_Name'] == $comp['Work_Name'] && $job['Work_Fabrique'] == $comp['Work_Fabrique'] )
							$niv += $comp['Competence_Level'] ;
						
				echo $niv." <br/>";
			}
		}
	}