<?php
	if(verif_access("Admin"))
	{
		echo '<form method="POST" action="'.get_link("Design","Admin").'">';
		echo '<input type="submit" name="Second_Edit" value="Design"/>';
		echo '<input type="submit" name="Second_Edit" value="Header"/>';
		echo '<input type="submit" name="Second_Edit" value="Footer"/>';
		echo '<input type="submit" name="Second_Edit" value="Sub"/>';
		echo '<input type="submit" name="Second_Edit" value="Left"/>';
		echo '<input type="submit" name="Second_Edit" value="Right"/>';
		//echo '<input type="submit" name="Second_Edit" value="Constants"/>';
		echo '</form>';
			
		if (request_confirm('Second_Edit'))
		{			
			echo '<form method="POST" action="'.get_link("Design","Admin").'">';
			
			switch($_POST['Second_Edit'])
			{
				/**
				case 'Constants': 
					$Constants = file_get_contents($_path."/Core/Constants.php");
					echo "Code CSS de votre MMORPG: <br /><textarea name=\"Constants\" ID=\"message\" rows=\"14\" cols=\"75\">$Constants</textarea><br/>";
				break;
				**/
				
				case 'Design': 
					$Design = file_get_contents($_path."/Design/".$MMORPG_Template."/Design.css");
					echo "Code CSS de votre MMORPG: <br /><textarea name=\"Design\" ID=\"message\" rows=\"14\" cols=\"75\">$Design</textarea><br/>";
				break;
				
				case 'Header': 
					$Header = file_get_contents($_path."Design/".$MMORPG_Template."/Templates/Head.php");
					echo "En tête du MMORPG: <br /><textarea name=\"Header\" ID=\"message\" rows=\"14\" cols=\"75\">$Header</textarea><br />";
				break;
					
				case 'Sub': 
					$Sub = file_get_contents($_path."Design/".$MMORPG_Template."/Templates/Sub.php");
					echo "Pied de page du MMORPG: <br /><textarea name=\"Sub\" ID=\"message\" rows=\"14\" cols=\"75\">$Sub</textarea><br />";
				break;

				case 'Footer': 
					$Footer = file_get_contents($_path."Design/".$MMORPG_Template."/HTML/Footer.php");
					echo "Pied de page du MMORPG: <br /><textarea name=\"Footer\" ID=\"message\" rows=\"14\" cols=\"75\">$Footer</textarea><br />";
				break;
					
				case 'Left': 
					$Left = file_get_contents($_path."Design/".$MMORPG_Template."/Templates/Left.php");
					echo "Colone de Gauche (Menu du MMORPG): <br /><textarea name=\"Left\" ID=\"message\" rows=\"14\" cols=\"75\">$Left</textarea><br />";
				break;
					
				case 'Right': 
					$Right = file_get_contents($_path."Design/".$MMORPG_Template."/Templates/Right.php");
					echo "Colone de droit (Statistiques): <br /><textarea name=\"Right\" ID=\"message\" rows=\"14\" cols=\"75\">$Right</textarea><br />";
				break;
			}
			echo '<input type="submit" name="End_Edit" value="Terminer">';
			echo '</form>';
		}
		if (request_confirm('End_Edit'))
		{	
			echo 'Le design vient d\'être mis à jour';
			echo '<form method="POST" action="'.get_link("Design","Admin").'">';
			echo '<input type="submit" name="Accueil" value="Continuer">';
			echo '</form>';
		}
	
	}