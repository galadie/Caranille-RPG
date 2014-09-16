<?php
	if(verif_connect()) 
	{
		menu_character();

		if(!empty($jobs))
			foreach($jobs as $job)
				if(!empty($competences))
					foreach ($competences as $comp)
						if($job['Work_Name'] == $comp['Work_Name'] && $job['Work_Fabrique'] == $comp['Work_Fabrique'] )
							echo $job['Work_Name']."(".$job['Work_Fabrique'].") <-> ".$comp['Competence_Level']."{".$comp['Competence_Experience']."/".$comp['Level_Experience_Required']."} <br/>" ;
	}