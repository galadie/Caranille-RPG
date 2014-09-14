<?php

if(verif_access("Admin"))
	{

	
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des Guilds du mmorpg<br /><br />';
			list_html_db('Caranille_Guilds','Guilds',array('Guild_Name','Guild_Description'));

		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Guild_ID = request_data('Guild_ID');
			
			$Guilds = get_db("edit_admin",array(
				'table' => 'Caranille_Guilds' ,
				'ID' => 'Guild_ID',
				'value' => $Guild_ID
			));
						
			formulaire($Guilds);

		}
		else
		//if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && (empty($_POST['Delete'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Guilds","Admin").'">';
			echo '<input type="submit" name="Edit" value="Modifier une guilde">';
			echo '</form>';
		}
		
	}