<?php
	if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
			menu_guild();
		
			if(has_guild_acces('recrutement'))
			{
			
				echo '<table class="newsboard">';

				echo '<tr>';
				echo '<th>Niveau</th>';
				echo '<th>Expérience</th>';
				echo '<th>Notorieté</th>';
				echo '<th>Ordre</th>';
				echo '<th>Pseudo</th>';

				echo '</tr>';
		
				$Account_Query = list_db("candidat_guild",array(
				        'Guild_ID' =>guild_data('Guild_ID')
				    ));
				

				if(!empty($Account_Query))
				{
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
						echo '<td>';
						echo '<form method="post" action="'.get_link('Recrutement','Guild').'" >';
						echo '<input type="hidden" name="token" value="'.generer_token('guild-candidat-'.$Account['Account_ID']).'"/>';
						echo '<input type="hidden" name="Account_ID" value="'.stripslashes($Account['Account_ID']).'"/>';
						echo '<input type="hidden" name="Account_Guild_ID" value="'.user_data('Account_Guild_ID').'"/>';
						echo '<input type="hidden" name="Account_Guild_Accept" value="1"/>';
						echo '<input type="submit" name="guild-engage" value="Engager"/>';
						echo '<input type="submit" name="guild-refuse" value="Refuser"/>';
						echo '</form>';
						echo '</td>';
						echo '</tr>';
					}
				}
				echo '</table>';
			}		
		}
	}