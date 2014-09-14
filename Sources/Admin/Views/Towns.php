<?php
	if(verif_access("Admin"))
	{
		if (request_confirm('Second_Edit'))
		{
			$Town_ID = request_data('Town_ID');

			$Towns_List = get_db("edit_admin",array(
				'table' => 'Caranille_Towns' ,
				'ID' => 'Town_ID',
				'value' => $Town_ID
			));

			get_formulaire_town($Towns_List);
		}
		else
		if (request_confirm('Add'))
		{
			get_formulaire_town();
		}
		else
		//if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && (empty($_POST['Add'])))
		{
		
			echo 'Voici la liste des villes du MMORPG<br /><br />';
			
			$Towns_List = list_db("list_t",array( 'table' => "Caranille_Towns"));
			$Landings_List = list_db("list_t",array( 'table' => "Caranille_Landings"));

			if(!empty($Towns_List))
			{
				foreach ($Towns_List as $Towns)
				{
						echo "" .stripslashes($Towns['Town_Name']). "<br />";
						$Town_ID = stripslashes($Towns['Town_ID']);

						echo '<form method="POST" action="'.get_link("Towns","Admin").'">';
						echo "<input type=\"hidden\" name=\"Town_ID\" value=\"$Town_ID\">";
						echo '<input type="submit" name="Second_Edit" value="entrer">';
						echo '</form><br />';
						
					$x = $Towns['Town_PosX'];
					$y = $Towns['Town_PosY'];
					
					$l_Twons[$x][$y] = $Towns ;
				}
			}
			
			if(!empty($Landings_List))
			{
				foreach ($Landings_List as $Landings)
				{
					$x = $Landings['Landing_PosX'];
					$y = $Landings['Landing_PosY'];
					
					$l_Landings[$x][$y] = $Landings ;
				}
			}

			if(file_exists("$_path/Sources/Admin/Modules/Towns/Map.php")) 
			    include_once("$_path/Sources/Admin/Modules/Towns/Map.php");
			else
			   echo 'carte indisponible';
		}
	}