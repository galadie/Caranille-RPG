<?php
	if(verif_access("Admin"))
	{
		if(request_confirm('style'))
		{
			$p = $_POST['style'];// On décale les tableaux d'un rang
			
			foreach($p as $id => $s)
			{
				extract($s);
					
				if($id != 0 && request_confirm('modifier'))
				{
					update_db('Caranille_Styles', array( 'Style_Code'=> $Style_Code, 'Style_Commentaire'=> $Style_Commentaire, 'Style_ID' => $id));
				}
				elseif($id != 0 && request_confirm('supr'))
				{
					delete_db('Caranille_Styles', array( 'Style_ID' => $id));
				}
				elseif($id == 0 && request_confirm('rajout'))
				{
					insert_db('Caranille_Styles', array( 'Style_Code'=> $Style_Code, 'Style_Commentaire'=> $Style_Commentaire));
				}
			}
			
			// -------------------------------------------
			// On écrit dans le fichier
			// -------------------------------------------
			$retour = list_db("list_t",array( 'table' => "Caranille_Styles"));
			
			$fichier=fopen("$_path/Design/$MMORPG_Template/style.css","w"); // On l'ouvre en mode « w »
			$message = '';
			if(!empty($retour))
			{
				foreach ($retour as $donnees)
				{
					$message .="\n\r";// Retour à la ligne
					$message .="/** ".$donnees['Style_Commentaire']." **/";// Retour à la ligne
					$message .="\n\r";// Retour à la ligne
					$message .= $donnees['Style_Code'];
					$message .="\n\r";// Retour à la ligne
				}
			}
			fputs($fichier, $message);
			fclose($fichier);
		}
		else
		{
			$retour=list_db("list_t",array( 'table' => "Caranille_Styles"));
		}	
	}
?>