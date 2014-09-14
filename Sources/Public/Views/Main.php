<?php

	//Search and display game news
	$list_news = list_db("list_news",array(
			'date' => "$year-$month%"
		));

    echo '<table class="newsboard" >';

	foreach ($list_news as $News)
	{
	    // update by Dimitri
	    
		echo '<tr>';
		echo '<th>';
		echo LanguageValidation::iMsg("intro.news.record", news_date($News), $News['News_Account_Pseudo']);//"News publiée le " .. " Par " .. "";
		echo '</th>';
		echo '</tr>';
		
		echo '<tr>';
		echo '<td>';
		echo '<h4>' .$News['News_Title']. '</h4>';
		echo '' .news_intro($News). '';
		echo '</td>';
		echo '</tr>';
		
        echo '<tr>' ;
		echo '<td>'.news_details_form($News).'</td>';
		echo '</tr>' ;
			
		//none affiche un espace vide entre les news
		echo '<tr><td class="none" ></td></tr>';
	}
	
	echo '</table>';	

?>