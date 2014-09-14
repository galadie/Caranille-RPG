<?php

if(verif_connect())
	{

		echo '<table class="newsboard">';

			echo '<tr>';
				echo '<th>'.LanguageValidation::iMsg("label.top.level").'</th>';
				echo '<th>'.LanguageValidation::iMsg("label.top.xp").'</th>';
				echo '<th>'.LanguageValidation::iMsg("label.top.notoriety").'</th>';
				echo '<th>'.LanguageValidation::iMsg("label.top.order").'</th>';
				echo '<th>'.LanguageValidation::iMsg("label.top.pseudo").'</th>';

			echo '</tr>';
	
		foreach ( $Player_List as $Account )
		{
			$xp_purcent = ($Account['Account_Experience']/$Account['Level_Experience_Required'])*100;
			
			$content_retire = "<a href='".get_link('Friends','User',array('del'=>$membre))."' >Retirer définitivement de la liste d'amis</a>";
			
			echo '<tr>';
			echo '<td>'.stripslashes($Account['Level_Number']). '</td>';
			echo '<td>';
			echo '<div title="'.stripslashes($Account['Account_Experience']). '/'.stripslashes($Account['Level_Experience_Required']). '" class="barre" id="xp" >';
			echo '<div style="width:'.$xp_purcent.'px;" >&nbsp;</div>';
			echo '</div>';
			echo '</td>';
			echo '<td><div class="gain notoriety">'.stripslashes($Account['Account_Notoriety']). '</div></td>';
			echo '<td>'.stripslashes($Account['Order_Name']). '</td>';
			echo '<td>';
			echo '<a href="'.get_link('Account','Forum',array('m'=>$Account['Account_ID'],'action'=>'consulter')).'">';
			echo stripslashes($Account['Account_Pseudo']);
			echo '</a>';
			echo '</td>';
			echo '<td>'.(isConnected($Account)? LanguageValidation::iMsg("global.logged.in") : LanguageValidation::iMsg("global.logged.out") ).'</td>';
	        echo "<td>".init_popIn('del-friend-'.$Account['Account_ID'].'-form',"Retirer de la liste d'amis",$content_retire,'del-friend-link')."</td>";
			echo '</tr>';
		}

		echo '</table>';
	}