<?php
	if(verif_connect())
    {
		load_css('guild.css','guild');
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
			menu_guild();
		
			echo '<table class="newsboard">';

			echo '<tr>';
				echo '<th>Niveau</th>';
				echo '<th>Expérience</th>';
				echo '<th>Notorieté</th>';
				echo '<th>Ordre</th>';
				echo '<th>Pseudo</th>';

			echo '</tr>';
	
		$Account_Query = list_db('list_membre_guild',array('Guild_ID' => guild_data('Guild_ID') ) );
		
		foreach ( $Account_Query as $Account )
		{
			echo '<tr>';
			echo '<td>'.stripslashes($Account['Level_Number']). '</td>';
			echo '<td>'.stripslashes($Account['Account_Experience']). '</td>';
			echo '<td>'.stripslashes($Account['Account_Notoriety']). '</td>';
			echo '<td>'.stripslashes($Account['Order_Name']). '</td>';
			echo '<td>';
			echo '<a href="'.get_link('Account','Forum',array('m'=>$Account['Account_ID'],'action'=>'consulter')).'">';
			echo stripslashes($Account['Account_Pseudo']);
			echo '</a>';
			echo '</td>';
			echo '<td>'.(isConnected($Account)?'Connecté' : 'déconnecté').'</td>';
			echo '</tr>';
		}

		echo '</table>';
		
		}
	}