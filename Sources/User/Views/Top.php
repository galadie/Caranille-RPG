<?php

if(verif_connect())
	{
		menu_arena();

		echo '<table class="newsboard">';

			echo '<tr>';
				echo '<th>'.LanguageValidation::iMsg("label.top.level").'</th>';
				echo '<th>'.LanguageValidation::iMsg("label.top.xp").'</th>';
				echo '<th>'.LanguageValidation::iMsg("label.top.notoriety").'</th>';
				echo '<th>'.LanguageValidation::iMsg("label.top.order").'</th>';
				echo '<th>'.LanguageValidation::iMsg("label.top.pseudo").'</th>';

			echo '</tr>';
	
		$Account_Query = list_db('top_list',array("top_members_limit"=>$top_members_limit));
		
		foreach ( $Account_Query as $Account )
		{
			$xp_purcent = ($Account['Account_Experience']/$Account['Level_Experience_Required'])*100;
			
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
			echo '</tr>';
		}

		echo '</table>';
	}