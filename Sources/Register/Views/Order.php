<?php

	if(isset($order) && $order == true )//(request_confirm('Order') or   )
	{
		extract($_POST);
		
		$Order_list = list_db('list_ordres');
		$token = generer_token("Register-step-order");
		if(!empty($Order_list))
		{
			foreach ($Order_list as $Order )
			{
				extract(stripslashes_r($Order));
				
				$html_order[$Order_ID] = '<h2>' .$Order_Name. '</h2>';
				$html_order[$Order_ID] .= '<p>' .nl2br($Order_Description). '</p>';
				$html_order[$Order_ID] .=  '<form method="POST" action="'.get_link('Order','Register').'">';
				$html_order[$Order_ID] .=  "<input type='hidden' name='Order_ID' value='$Order_ID' />";
				$html_order[$Order_ID] .=  "<input type='hidden' name='Account_ID' value='".$user_record['Account_ID']."' />";
				//$html_order[$Order_ID] .=  '<input type="submit" name="Confirm" value="Rejoindre" />';
				$html_order[$Order_ID] .=   '<input type="hidden" name="token" value="'.$token.'"/>';
				$html_order[$Order_ID] .=  '<input type="submit" name="Order" value="'.LanguageValidation::nMsg("btn.register.order").'"/>'.LanguageValidation::eMsg("btn.register.order");
				$html_order[$Order_ID] .=  '</form>';
			}

			echo "<div id='Ange' class='Ordre'>".$html_order[2]."</div>";
			echo "<div id='Demon' class='Ordre'>".$html_order[3]."</div>";
			echo '<p>Bienvenue sur la page des ordres</p>';
			echo '<p>Vous êtes actuellement neutre. Pour participer au PVP dans le champs de batailles vous devez choisir un odre à servir</p>';
			echo '<p>ATTENTION, ce choix est irréversible, choisissez donc bien</p>';
		}
		else
		{
			echo  '<form method="POST" action="'.get_link('Order','Register').'">';
			echo  "<input type='hidden' name='Order_ID' value='0' />";
			echo  "<input type='hidden' name='Account_ID' value='".$user_record['Account_ID']."' />";
			//echo '<input type="submit" name="Confirm" value="Rejoindre" />';
			echo '<input type="hidden" name="token" value="'.$token.'"/>';
			echo '<input type="submit" name="Race" value="'.LanguageValidation::nMsg("btn.register.pass").'"/>'.LanguageValidation::eMsg("btn.register.pass");
			echo  '</form>';
		}
		//echo '<p>Voici les deux ordres disponibles. Choisissez bien</p>';
	}
?>