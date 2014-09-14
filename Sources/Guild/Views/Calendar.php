<?php if(verif_connect()) { ?>
        <?php echo LanguageValidation::iMsg("intro.guild.calendar"); ?>
	<table border='1'>
				
			<caption><h3 id="titre">
				<a id="link_precedent" href="<?php echo get_link('calendar','guild', array('m'=>$pm , 'y' => $py )) ?>">&lt;</a>
				--<?php echo "$year - ".LanguageValidation::iMsg("label.calendar.month.".$month) ?>--
				<a id="link_suivant" href="<?php echo get_link('calendar','guild', array('m'=>$nm , 'y' => $ny )) ?>">&gt;</a>
			</h3></caption>
		
			<tr>
			    <td></td>
				<td class="cell_calendrier"><?php echo LanguageValidation::iMsg("label.calendar.monday"); ?></td>
				<td class="cell_calendrier"><?php echo LanguageValidation::iMsg("label.calendar.tuesday"); ?></td>
				<td class="cell_calendrier"><?php echo LanguageValidation::iMsg("label.calendar.wednesday"); ?></td>
				<td class="cell_calendrier"><?php echo LanguageValidation::iMsg("label.calendar.thursday"); ?></td>
				<td class="cell_calendrier"><?php echo LanguageValidation::iMsg("label.calendar.friday"); ?></td>
				<td class="cell_calendrier"><?php echo LanguageValidation::iMsg("label.calendar.satursday"); ?></td>
				<td class="cell_calendrier"><?php echo LanguageValidation::iMsg("label.calendar.sunday"); ?></td>
			</tr>
							
			<tr>
<?php	
    echo "<td>".$date->format('W')."</td>";

	foreach( $calendar as $day => $week)
	{
    	$date = new DateTime($year."-".$month."-".$day);
    	
		if($day == 1 && $week != 1)
		{
			echo "\n\t\t\t"."<td colspan='".($week-1)."'></td>";
		}
		
		echo "\n\t\t\t"."<td>";
		
		if(isset($events[$day]))
		{
			if(has_guild_acces('evenement')) 
			{
				$content = '<form method="POST" action="'.get_link("Calendar","Guild", array('m'=>$month , 'y' => $year )).'">';
				$content .= '<h2>'.$events[$day]['Event_Name'].'</h2>';
				$content .= '<input type="hidden" name="Event_ID" value="'.$events[$day]['Event_ID'].'"/>';
				$content .= '<input type="hidden" name="Event_Guild_ID" value="'.user_data('Account_Guild_ID').'"/>';
				$content .= '<input type="hidden" name="Event_Date" value="'."$year-$month-$day".'"/>';
				$content .= '<table style="width:100%">';
				$content .= '<tr><td>';
				$content .= line_db("Caranille_Events","Event_Name",$events[$day]['Event_Name']);
				$content .= call_bbcode_editor("Event_Description",$events[$day]['Event_Description']);//line_db("Caranille_Events","Event_Description",$events[$day]['Event_Description']);
				$content .= '</td></tr>';
				$content .= '</table>';
				$content .= '<input type="submit" name="End_Edit_Event" value="Terminer"/>';
				$content .= '</form>';
			}			
			else
			{ 
				$content = '<h4>' .$events[$day]['Event_Name']. '</h4>';
				$content .= '<p>' .($events[$day]['Event_Description']). '</p>';
			}
			echo init_popIn('event-'.$events[$day]['Event_ID'].'-form',"Ev: ".$events[$day]['Event_Name'],$content,'event-link');
		}
		else
		{
			if(has_guild_acces('evenement')) 
			{ 
				$content = '<form method="POST" action="'.get_link("Calendar","Guild", array('m'=>$month , 'y' => $year )).'">';
				$content .= '<input type="hidden" name="Event_Guild_ID" value="'.user_data('Account_Guild_ID').'"/>';
				$content .= '<input type="hidden" name="Event_Date" value="'."$year-$month-$day".'"/>';
				$content .= '<table style="width:100%">';
				$content .= '<tr><td>';
				$content .= line_db("Caranille_Events","Event_Name");
				$content .= call_bbcode_editor("Event_Description");//line_db("Caranille_Events","Event_Description");
				$content .= '</td></tr>';
				$content .= '</table>';
				$content .= '<input type="submit" name="End_Add_Event" value="Terminer"/>';
				$content .= '</form>';
					
				echo init_popIn('event-'.$day.'-form',"Nouvel Evenement" ,$content,'event-link');
			}
		}		
		echo "<br/>$day</td>";
		
		if($day == $date->format('t') && $week < 6 )
		{
			echo "\n\t\t\t"."<td colspan='".(7-$week)."'></td>";
		}
		
		if($week == 7 && $day != $date->format('t'))
		{
			echo "\n\t\t"."</tr>";
			echo "\n\t\t"."<tr><td>".$date->format('W')."</td>";
		}
		
		unset($date);
	}
?>
			</tr>
					
	</table>
      			<?php	echo LanguageValidation::iMsg("label.guild.calendar"); ?>
<?php } ?>
