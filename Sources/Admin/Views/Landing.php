<?php
	if(verif_access("Admin"))
	{
		if (request_confirm('Second_Edit'))
		{
			$Landing_ID = request_data('Landing_ID');

			$Landings_List = get_db("edit_admin",array(
				'table' => 'Caranille_Landings' ,
				'ID' => 'Landing_ID',
				'value' => $Landing_ID
			));
			
			get_formulaire_Landing($Landings_List);
		}
		
		if (request_confirm('Add'))
		{
			get_formulaire_Landing();
		}
		
		if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && (empty($_POST['Add'])))
		{
		
			echo 'Voici la liste des villes du MMORPG<br /><br />';
			
			$Landings_List = list_db("list_t",array( 'table' => "Caranille_Landings"));

			if(!empty($Landings_List))
			{
				foreach ($Landings_List as $Landings)
				{
					$x = $Landings['Landing_PosX'];
					$y = $Landings['Landing_PosY'];
					
					$l_Landings[$x][$y] = $Landings ;
				}
			}	
			
			if(file_exists("$_path/Sources/Admin/Modules/Towns/landing.php")) 
			    include_once("$_path/Sources/Admin/Modules/Towns/landing.php");
			else
			   echo 'carte indisponible';
		}
	}