<?php

	if(verif_connect()) 
	{			
		if(isset($enter) && $enter == true) //(request_confirm('entrer_Town'))
		{
			echo '<p>'.$message.'<br/><br/>';			
			echo '<form method="POST" action="'.get_link('Map','Map').'">';
			echo '<input type="submit" name="carte" value="'.LanguageValidation::nMsg("btn.enter.town").'"/>'.LanguageValidation::eMsg("btn.enter.town");//Continuer">';
			echo '</form></p>';
		}
		else
		if (!verif_town())
		{			
			bousole("Map");
			instruction(isset($message) ? $message : "");
			
			include_once(path_source("map-2","Map","Map"));
			
			if(isset($array_work_class['recolte']))
			{
				echo "<br/>";
				echo '<p><form style="float:right;margin-right:5px;margin-top:10px" method="POST" action="'.get_link('Map','Map').'">';
				echo '<input type="hidden" name="recolte" value="ramassage-ressource" />';
				foreach($array_work_class['recolte'] as $recolte)
				{
                    $job = get_db('fabrique_works',array('Type'=>$recolte));
					$ressource = get_db('fabrique_ressource',array('Type'=>$recolte));
					
					if(isset($job) && isset($ressource))
					{									
						echo '<input type="submit" name="'.$recolte.'" value="'.LanguageValidation::nMsg("btn.map.".$recolte).'"/>'.LanguageValidation::eMsg("btn.map.".$recolte)."<br/>";//Continuer">';
					}				}
				echo '<input type="hidden" name="token" value="'.generer_token('recolte-map').'" />';
				echo '</form></p>';
			}
			if(isset($message)) echo '<p style="float:right;margin-right:5px;margin-top:10px;width:200px">'.$message.'</p>';			
		}
	}