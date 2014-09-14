<?php


    echo '<table class="newsboard" >';

    // update by Dimitri
		    
	echo '<tr>';
	echo '<th>';
	echo LanguageValidation::iMsg("intro.news.record", news_date($News), $News['News_Account_Pseudo']);//"News publiée le " .. " Par " .. "";
	//echo "News publiée le " . news_date($News). " Par " .$News['News_Account_Pseudo']. "";
	echo '</th>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td>';
	echo '<h4>' .$News['News_Title']. '</h4>';
	echo '<p>' .news_intro($News). '</p>';
	echo '' .news_message($News). '';
	echo '</td>';
	echo '</tr>';
	
	//none affiche un espace vide entre les news
	echo '<tr><td class="none" ></td></tr>';
			
	if(verif_connect(true))
	{		
		echo "<tr><th>".LanguageValidation::iMsg("label.comment.content")."</th></tr>";//Message
		echo '<tr><td>'.news_comment_form($News).'</td></tr>';
		//none affiche un espace vide entre les news
		echo '<tr><td class="none" ></td></tr>';
	}
	
	if(!empty($list_comment))
	{
		foreach ($list_comment as $comment)
		{	
	
			echo '<tr>';
			echo '<th>';
			echo LanguageValidation::iMsg("intro.comment.record", news_comment_date($comment), $comment['Comment_Account_Pseudo']);//"News publiée le " .. " Par " .. "";
			//echo "Commentaires rédigé le " . news_comment_date($comment) . " Par " .$comment['Comment_Account_Pseudo']. "";
			echo '</th>';
			echo '</tr>';
			
			echo '<tr>';
			echo '<td>';
			echo '<h4>' .$News['News_Title']. '</h4>';
			echo news_comment_message($comment);
			echo '</td>';
			echo '</tr>';

			echo '<tr><td class="none" ></td></tr>';
		}
	}
	
	echo '</table>';
?>