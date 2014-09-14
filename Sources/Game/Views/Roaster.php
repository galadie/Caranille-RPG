<?php

    if(verif_connect())
	{
		echo '<table class="newsboard">';

		echo '<tr>';
		echo '<th>Niveau</th>';
		echo '<th>Expérience</th>';
		echo '<th>Notorieté</th>';
		echo '<th>Ordre</th>';
		echo '<th>Pseudo</th>';
		echo '</tr>';
		
		$recrus = list_db('recruted_roaster',array(
	        'Account_Roaster_ID' => user_data('Account_Roaster_ID'),
	        'Account_ID' => user_data('Account_ID'),
			'timeout' => $d ,
			'limit' => $roaster_max_membres
	    )) ;

		if(!empty($recrus))
		{
			echo '<tr><td colspan="7" class="none">Avatars Recrutés</td></tr>';
			
			foreach ( $recrus as $Account )
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
				echo '</tr>';
			}
		}

		$ct_recrus = count_db('recruted_roaster',array(
		        'Account_Roaster_ID' => user_data('Account_Roaster_ID'),
		        'Account_ID' => user_data('Account_ID'),
				'timeout' => $d ,
				'limit' => $roaster_max_membres
		    ));
		
		if($ct_recrus <= $roaster_max_membres)
		{
			$Marge = time() - $connect_marge;
				
			$d = date("Y-m-d H:i:s", $Marge);
			
			//echo $requete ;

			$candidats = list_db('dispo_roaster',array(
		        'Account_ID' => user_data('Account_ID'),
				'timeout' => $d ,
		    )) ;
			
			if(!empty($candidats))
			{
				echo '<tr><td colspan="7" class="none">Avatars Disponibles</td></tr>';
									
				foreach ( $candidats as $Account )
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
					echo '<td>';
					echo '<form method="post" action="'.get_link('Roaster','Game').'" >';
					echo '<input type="hidden" name="token" value="'.generer_token('roaster-engage-'.$Account['Account_ID']).'"/>';
					echo '<input type="hidden" name="Account_ID" value="'.stripslashes($Account['Account_ID']).'"/>';
					echo '<input type="hidden" name="Account_Roaster_ID" value="'.user_data('Account_Roaster_ID').'"/>';
					echo '<input type="submit" name="engage" value="Engager"/>';
					echo '</form>';
					echo '</td>';
					echo '</tr>';
				}
			}
		}	
		echo '</table>';
	}
?>