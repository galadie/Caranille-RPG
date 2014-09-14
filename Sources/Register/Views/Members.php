<?php

	// update by Dimitri
		
		echo '<form method="POST" action="'.get_link('Members','Register').'">';
		echo '<label for="Pseudo">'.LanguageValidation::iMsg("label.register.pseudo").'</label><input placeholder="'.LanguageValidation::nMsg("placeholder.register.pseudo").'" type="text" name="Pseudo">'.LanguageValidation::eMsg("placeholder.register.pseudo").'<br /><br />';
		echo '<label for="Password">'.LanguageValidation::iMsg("label.register.password").'</label><input placeholder="'.LanguageValidation::nMsg("placeholder.register.password").'" type="password" name="Password">'.LanguageValidation::eMsg("placeholder.register.password").'<br /><br />';
        echo '<label for="Password_Confirm">'.LanguageValidation::iMsg("label.register.confirm").'</label><input placeholder="'.LanguageValidation::nMsg("placeholder.register.confirm").'" type="password" name="Password_Confirm"/>'.LanguageValidation::eMsg("placeholder.register.confirm").'<br /><br />';
        echo '<label for="Email">'.LanguageValidation::iMsg("label.register.email").'</label><input placeholder="'.LanguageValidation::nMsg("placeholder.register.email").'" type="text" name="Email"/>'.LanguageValidation::eMsg("placeholder.register.email").'<br /><br />';
        
        echo '<label for="Sexe">'.LanguageValidation::iMsg("label.register.sexe").'</label>';
        echo '<input type="radio" name="Sexe" value="homme" />'.LanguageValidation::iMsg("placeholder.register.sexe.homme");
        echo '<input type="radio" name="Sexe" value="femme" />'.LanguageValidation::iMsg("placeholder.register.sexe.femme");
        echo '<br /><br />';
        
        echo '<div style="display: none;">Ne pas remplir ce champ : <input type="text" name="verif" placeholder="Laisser vide."/><br/></div>';
		echo '<input type="checkbox" name="Licence">'.LanguageValidation::iMsg("label.register.licence", init_popIn('licence',"licence",'<pre><div style="width:300px">'.file_get_contents($_path.'LICENCE.txt').'</div></pre>','licence-link') ).'<br /><br />';//href="'.$_url.'LICENCE.txt"

	    echo '<input type="hidden" name="token" value="'.generer_token("Register-step-member").'"/>';
		echo '<input type="submit" name="Register" value="'.LanguageValidation::nMsg("btn.register.init").'"/>'.LanguageValidation::eMsg("btn.register.init");
		echo '</form>';		