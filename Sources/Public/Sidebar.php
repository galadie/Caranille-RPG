
<table border='1'>
				
			<caption><h3 id="titre">
				<a id="link_precedent" href="<?php echo get_link('Main','Public', array('m'=>$pm , 'y' => $py )) ?>">&lt;</a>
				--<?php echo "$year - ".LanguageValidation::iMsg("label.sidebar.month.".$month) ?>--
				<a id="link_suivant" href="<?php echo get_link('Main','Public', array('m'=>$nm , 'y' => $ny )) ?>">&gt;</a>
			</h3></caption>
		
			<tr>
			    <td></td>
				<td class="cell_calendrier"><?php echo LanguageValidation::iMsg("label.sidebar.monday"); ?></td>
				<td class="cell_calendrier"><?php echo LanguageValidation::iMsg("label.sidebar.tuesday"); ?></td>
				<td class="cell_calendrier"><?php echo LanguageValidation::iMsg("label.sidebar.wednesday"); ?></td>
				<td class="cell_calendrier"><?php echo LanguageValidation::iMsg("label.sidebar.thursday"); ?></td>
				<td class="cell_calendrier"><?php echo LanguageValidation::iMsg("label.sidebar.friday"); ?></td>
				<td class="cell_calendrier"><?php echo LanguageValidation::iMsg("label.sidebar.satursday"); ?></td>
				<td class="cell_calendrier"><?php echo LanguageValidation::iMsg("label.sidebar.sunday"); ?></td>
			</tr>
							
			<tr>
<?php	
    echo "<td></td>"; //".$period->format('W')."

	foreach( $r as $day => $week)
	{
    	$date = new DateTime($year."-".$month."-".$day);
    	
		if($day == 1 && $week != 1)
		{
			echo "\n\t\t\t"."<td colspan='".($week-1)."'></td>";
		}
		
		echo "\n\t\t\t"."<td>$day</td>";
		
		if($day == $date->format('t') && $week < 6 )
		{
			echo "\n\t\t\t"."<td colspan='".(7-$week)."'></td>";
		}
		
		if($week == 7 && $day != $date->format('t'))
		{
			echo "\n\t\t"."</tr>";
			echo "\n\t\t"."<tr><td></td>";//".$date->format('W')."
		}
		
		unset($date);
	}
?>
			</tr>
					
	</table>