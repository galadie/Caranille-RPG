<?php

		if (empty($_POST['Login']))
    	{
           /**
            
            //echo '<div id="login">';
    		echo '<form method="POST" action="'.get_link('Login','User').'"><br />';
    		echo '<label for="Pseudo">'.LanguageValidation::iMsg("label.login.pseudo").'</label><input placeholder="'.LanguageValidation::nMsg("placeholder.login.pseudo").'" type="text" name="Pseudo">'.LanguageValidation::eMsg("placeholder.login.pseudo").'<br /><br />';
    		echo '<label for="Password">'.LanguageValidation::iMsg("label.login.password").'</label><input placeholder="'.LanguageValidation::nMsg("placeholder.login.password").'" type="password" name="Password">'.LanguageValidation::eMsg("placeholder.login.password").'<br /><br />';
    		echo '<input type="hidden" name="token" value="'.generer_token('Login').'" />';
    		//echo '<input type="submit" name="Login" value="Se connecter">';
			echo '<input type="submit" name="Login" value="'.LanguageValidation::nMsg("btn.login.init").'"/>'.LanguageValidation::eMsg("btn.login.init");
    		echo '</form>';
    		//echo '</div>';
    		
    		**/
			
			echo formulaire_input(array(
			
					text_input("label.login.pseudo","Pseudo",null,null,null,"placeholder.login.pseudo")
				,	password_input("label.login.password","Password",null,null,null,"placeholder.login.password")
				,	submit_input("Login","btn.login.init")
			
			),"Login",get_link('Login','User'),"post",null);
    	}
		
		if(isset($message) && $message !=='')
		{
			echo nl2br($message);
		}
?>