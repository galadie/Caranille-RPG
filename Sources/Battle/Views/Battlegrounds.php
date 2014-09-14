<?php

	if(verif_connect()) 
	{
		if(!has_order())
		{
			echo 'Pour pouvoir participer au PVP (Player Versus Player) vous devez choisir un ordre';
		}
		else
		if(has_order())
		{
			if (empty($_POST['Launch_Battle']))
			{	
				menu_arena();
				
				echo '<p>Dans ce lieu vous allez pouvoir affronter les joueurs de l\'ordre opposé<br />';
				echo 'Chaque victoire vous apportera un point de notoriété et fera perdre un point à votre adversaire<br />';
				echo 'En cas de défaite vous perdrez un point et votre adversaire en gagnera un</p>';
				
				$Account_Query = list_db('list_battleground',array('Account_Order' => user_data('Order_ID')));

				if(!empty($Account_Query))
				{
					echo '<p>Voici la liste des joueurs prêt au combat</p>';
					echo '<table class="newsboard">';

						echo '<tr>';
							echo '<th>Pseudo</th>';
            				echo '<th>Niveau</th>';
            				echo '<th>Expérience</th>';
            				echo '<th>Notorieté</th>';
							echo '<th>Action</th>';
						echo '</tr>';
					foreach ($Account_Query as $Account)
					{
						if ($Account['Account_ID'] !== $ID)
						{
							$Account_ID = stripslashes($Account['Account_ID']);
						
							$xp_purcent = ($Account['Account_Experience']/$Account['Level_Experience_Required'])*100;
							
							echo '<tr>';
			echo '<td>';
			echo '<a href="'.get_link('Account','Forum',array('m'=>$Account['Account_ID'],'action'=>'consulter')).'">';
			echo stripslashes($Account['Account_Pseudo']);
			echo '</a>';
			echo '</td>';
							echo '<td>'.stripslashes($Account['Level_Number']). '</td>';
							echo '<td>';
							echo '<div title="'.stripslashes($Account['Account_Experience']). '/'.stripslashes($Account['Level_Experience_Required']). '" class="barre" id="xp" >';
							echo '<div style="width:'.$xp_purcent.'px;" >&nbsp;</div>';
							echo '</div>';
							echo '</td>';							
							echo '<td><div class="gain notoriety">'.stripslashes($Account['Account_Notoriety']). '</div></td>';
							echo '<td>'.(isConnected($Account)? 'connecté' : 'déconnecté').'</td>';
								echo '<td>';
									echo '<form method="POST" action="'.get_link("Battlegrounds","Battle").'">';
									echo "<input type=\"hidden\" name=\"Account_ID\" value=\"$Account_ID\">"; 
									echo '<input type="submit" name="Launch_Battle" value="combattre">';
									echo '</form>';
								echo '</td>';
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
			else
			if (request_confirm('Launch_Battle'))
			{
				if(!empty($Account))
				{
					echo 'Pseudo : ' .stripslashes($Account['Account_Pseudo']). '<br />';
					echo 'HP : '  .stripslashes($Account['Account_HP_Remaining']). '<br />';
					echo '<form method="POST" action="'.get_link("Battle","Battle").'">';
					echo '<input type="submit" name="Continue" value="Lancer le combat">';
					echo '</form>';
				}
			}
		}
	}