<?php

	if(verif_connect()) 
	{
		get_ocedar();
		menu_character();
		
		if(!has_order())
		{
			if (!request_confirm('Accept'))
			{
    			$Data_Order_list = list_db("list_ordres");
				
				foreach ($Data_Order_list as $Order_Data )
    			{
					extract(stripslashes_r($Order_Data));
					
					$html_order[$Order_ID] = '<h2>' .$Order_Name. '</h2>';
					$html_order[$Order_ID] .= '<p>' .nl2br($Order_Description). '</p>';
					$html_order[$Order_ID] .=  '<form method="POST" action="'.get_link('Order','Game').'">';
					$html_order[$Order_ID] .=  "<input type=\"hidden\" name=\"Order_Name\" value=\"".$Order_Name."\">";
					$html_order[$Order_ID] .=  "<input type=\"hidden\" name=\"Order_ID\" value=\"$Order_ID\">";
					$html_order[$Order_ID] .=  '<input type="submit" name="Accept" value="'.LanguageValidation::nMsg("btn.order.join").'"/>'.LanguageValidation::eMsg("btn.order.join");//Rejoindre">';
					$html_order[$Order_ID] .=  '</form>';
					
				}
	
				echo "<div id='Ange' class='Ordre'>".$html_order[2]."</div>";
				echo "<div id='Demon' class='Ordre'>".$html_order[3]."</div>";
				echo LanguageValidation::iMsg("intro.game.order");
				echo '<br /><br />';
				echo LanguageValidation::iMsg("label.order.choose");
    		}
		
		}
		else
		{
			$Order_Data = get_db("request_ordre",array('Order_ID' => user_data('Order_ID'))); 
			
			if(!empty($Order_Data))
			{
				echo "<div id='Ange' class='Ordre'>";
				echo '<h2>' .stripslashes($Order_Data['Order_Name']). '</h2>';
				echo '<p>' .stripslashes(nl2br($Order_Data['Order_Description'])). '</p>';
				echo "</div>";
			}

		}
	}	