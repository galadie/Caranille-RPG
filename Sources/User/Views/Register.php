<?php

	if(request_confirm('Race') )
	{
		$Order_list = list_db(get_select_req('list_races'));
		
		foreach ($Order_list as $Order )
		{
			echo '<h2>' .$Order_Name. '</h2>';
			echo '<p>' .nl2br($Order_Description). '</p>';
			echo  '<form method="POST" action="'.get_link('Register','User').'">';
			echo  "<input type=\"hidden\" name=\"Race_ID\" value=\"$Race_ID\" />";
			echo  "<input type=\"hidden\" name=\"Account_ID\" value=\"$Account_ID\" />";
			//echo '<input type="submit" name="Confirm" value="Rejoindre" />';
			echo '<input type="submit" name="Confirm" value="'.LanguageValidation::nMsg("btn.register.race").'"/>'.LanguageValidation::eMsg("btn.register.race");
			echo  '</form>';
		}
		echo '<p>ATTENTION, ce choix est irréversible, choisissez donc bien</p>';
	}
	
	if(request_confirm('Classe') )
	{
		$Order_list = list_db(get_select_req('list_classes'));
		
		foreach ($Order_list as $Order )
		{
			echo '<h2>' .$Order_Name. '</h2>';
			echo '<p>' .nl2br($Order_Description). '</p>';
			echo  '<form method="POST" action="'.get_link('Register','User').'">';
			echo  "<input type=\"hidden\" name=\"Race_ID\" value=\"$Race_ID\" />";
			echo  "<input type=\"hidden\" name=\"Account_ID\" value=\"$Account_ID\" />";
			//echo  '<input type="submit" name="Confirm" value="Rejoindre" />';
			echo '<input type="submit" name="Confirm" value="'.LanguageValidation::nMsg("btn.register.classe").'"/>'.LanguageValidation::eMsg("btn.register.classe");
			echo  '</form>';
		}
		echo '<p>ATTENTION, ce choix est irréversible, choisissez donc bien</p>';
	}
	
	if(request_confirm('Order') )
	{
		extract($_POST);
		
		$Order_list = list_db(get_select_req('list_ordres'));
		
		foreach ($Order_list as $Order )
		{
			extract(stripslashes_r($Order));
			
			$html_order[$Order_ID] = '<h2>' .$Order_Name. '</h2>';
			$html_order[$Order_ID] .= '<p>' .nl2br($Order_Description). '</p>';
			$html_order[$Order_ID] .=  '<form method="POST" action="'.get_link('Register','User').'">';
			$html_order[$Order_ID] .=  "<input type=\"hidden\" name=\"Order_ID\" value=\"$Order_ID\" />";
			$html_order[$Order_ID] .=  "<input type=\"hidden\" name=\"Account_ID\" value=\"$Account_ID\" />";
			//$html_order[$Order_ID] .=  '<input type="submit" name="Confirm" value="Rejoindre" />';
			$html_order[$Order_ID] .=  '<input type="submit" name="Confirm" value="'.LanguageValidation::nMsg("btn.register.order").'"/>'.LanguageValidation::eMsg("btn.register.order");
			$html_order[$Order_ID] .=  '</form>';
			
		}

		echo "<div id='Ange' class='Ordre'>".$html_order[2]."</div>";
		echo "<div id='Demon' class='Ordre'>".$html_order[3]."</div>";
		echo '<p>Bienvenue sur la page des ordres</p>';
		echo '<p>Vous êtes actuellement neutre. Pour participer au PVP dans le champs de batailles vous devez choisir un odre à servir</p>';
		echo '<p>ATTENTION, ce choix est irréversible, choisissez donc bien</p>';

		//echo '<p>Voici les deux ordres disponibles. Choisissez bien</p>';
	}
	
	if (request_confirm('Regene') or (isset($record) && $record == true) )
	{
		echo '<form method="POST" action="'.get_link('Register','User').'">';
		echo "<label>HP +</label><input readonly type=\"text\" name=\"Account_HP_Bonus\" value=\"$Account_HP_Bonus\"><br />";
		echo "<label>MP +</label><input readonly type=\"text\" name=\"Account_MP_Bonus\" value=\"$Account_MP_Bonus\"><br />";
		echo "<label>Force +</label><input readonly type=\"text\" name=\"Account_Strength_Bonus\" value=\"$Account_Strength_Bonus\"><br />";
		echo "<label>Magie +</label><input readonly type=\"text\" name=\"Account_Magic_Bonus\" value=\"$Account_Magic_Bonus\"><br />";
		echo "<label>Agilité +</label><input readonly type=\"text\" name=\"Account_Agility_Bonus\" value=\"$Account_Agility_Bonus\"><br />";
		echo "<label>Defense +</label><input readonly type=\"text\" name=\"Account_Defense_Bonus\" value=\"$Account_Defense_Bonus\"><br />";
		echo "<input type=\"hidden\" name=\"Account_ID\" value=\"$Account_ID\">";
	    echo '<input type="hidden" name="token" value="'.generer_token("Register-bonus-stats").'"/>';
		//echo '<input type="submit" name="Regene" value="Regener des Stats" />';
		echo '<input type="submit" name="Regene" value="'.LanguageValidation::nMsg("btn.register.regene").'"/>'.LanguageValidation::eMsg("btn.register.regene");
		//echo '<input type="submit" name="Order" value="Valider" />';
		echo '<input type="submit" name="Order" value="'.LanguageValidation::nMsg("btn.register.stats").'"/>'.LanguageValidation::eMsg("btn.register.stats");
		echo '</form>';
	}
	
	if (empty($_POST) ) //&& empty($_GET) )//['Register']))
	{	
        //echo '<div id="inscription">';// update by Dimitri
        
		//echo '<div class="important">Inscription</div><br /><br />';
        
        //echo '<iframe id="licence" src="'.$_url.'LICENCE.txt"></iframe><br /><br />';// update by Dimitri
		
		echo '<form method="POST" action="'.get_link('Register','User').'">';
		echo '<label for="Pseudo">'.LanguageValidation::iMsg("label.register.pseudo").'</label><input placeholder="'.LanguageValidation::nMsg("placeholder.register.pseudo").'" type="text" name="Pseudo">'.LanguageValidation::eMsg("placeholder.register.pseudo").'<br /><br />';
		echo '<label for="Password">'.LanguageValidation::iMsg("label.register.password").'</label><input placeholder="'.LanguageValidation::nMsg("placeholder.register.password").'" type="password" name="Password">'.LanguageValidation::eMsg("placeholder.register.password").'<br /><br />';
        echo '<label for="Password_Confirm">'.LanguageValidation::iMsg("label.register.confirm").'</label><input placeholder="'.LanguageValidation::nMsg("placeholder.register.confirm").'" type="password" name="Password_Confirm"/>'.LanguageValidation::eMsg("placeholder.register.confirm").'<br /><br />';
        echo '<label for="Email">'.LanguageValidation::iMsg("label.register.email").'</label><input placeholder="'.LanguageValidation::nMsg("placeholder.register.email").'" type="text" name="Email"/>'.LanguageValidation::eMsg("placeholder.register.email").'<br /><br />';
        echo '<div style="display: none;">Ne pas remplir ce champ : <input type="text" name="verif" placeholder="Laisser vide."/><br/></div>';
		echo '<input type="checkbox" name="Licence">'.LanguageValidation::iMsg("label.register.licence", init_popIn('licence',"licence",'<pre><div style="width:300px">'.file_get_contents($_path.'LICENCE.txt').'</div></pre>','licence-link') ).'<br /><br />';//href="'.$_url.'LICENCE.txt"
/**		
		echo '<div id="licence" class="parentDisable">';
		echo '<div class="popin">';
		echo '<h2 class="heading" >Licence';
		echo '<a class="closing" href="#" onClick="return hide(\'licence\')">&cross;</a>';
		echo '</h2>';
		echo '<div class="content">';
		echo '<pre><div style="width:300px">'.file_get_contents($_path.'LICENCE.txt').'</div></pre>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
**/		
	    echo '<input type="hidden" name="token" value="'.generer_token("Register-step-1").'"/>';
		//echo '<input type="submit" name="Register" value="S\'inscrire">';
		echo '<input type="submit" name="Register" value="'.LanguageValidation::nMsg("btn.register.init").'"/>'.LanguageValidation::eMsg("btn.register.init");
		echo '</form>';		
	}	