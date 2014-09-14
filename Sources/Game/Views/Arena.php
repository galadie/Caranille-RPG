<?php

	if(verif_connect())
	{
		menu_arena();
		get_ocedar();
		
			$Account_Query = list_db('active_account', array('Account_ID' =>user_data('Account_ID') ));

				if(!empty($Account_Query))
				{
					echo '<p>'.LanguageValidation::iMsg("intro.arena.place").'</p>';
					echo '<table class="newsboard">';

						echo '<tr>';
							echo '<th>Pseudo</th>';
							echo '<th>Notoriété</th>';
						echo '</tr>';
					foreach ($Account_Query as $Account)
					{
						if ($Account['Account_ID'] !== $ID)
						{
							$Account_ID = stripslashes($Account['Account_ID']);
						
							echo '<tr>';
			echo '<td>';
			echo '<a href="'.get_link('Account','Forum',array('m'=>$Account['Account_ID'],'action'=>'consulter')).'">';
			echo stripslashes($Account['Account_Pseudo']);
			echo '</a>';
			echo '</td>';
						//	echo '<td>'.stripslashes($Account['Level_Number']). '</td>';
							//echo '<td>'.stripslashes($Account['Account_Experience']). '</td>';
							echo '<td><div class="gain notoriety">'.stripslashes($Account['Account_Notoriety']). '</div></td>';
							echo '<td>'.(isConnected($Account)? 'connecté' : 'déconnecté').'</td>';
							echo '</tr>';
						}
					}
					echo '</table>';
				}
				else
				{
					echo "pas de joueur dans l'autre Ordre ???";
				}
		
	}