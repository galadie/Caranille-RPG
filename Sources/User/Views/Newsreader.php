<?php

		if (empty($_POST['Login']))
    	{
            echo '<div id="login">';
    		echo '<form method="POST" action="'.get_link('Newsreader','User').'"><br />';
			echo '<label for="Email">Adresse e-mail</label><input placeholder="E-mail" type="email" name="Email"/><br /><br />';
			echo '<label for="Email_Confirm">Confirmation</label><input placeholder="Resaisir votre email" type="email" name="Email_Confirm"/><br /><br />';
			echo '<input type="hidden" name="token" value="'.generer_token('Newsreader').'" />';
    		echo '<input type="submit" name="Login" value="Se connecter">';
    		echo '</form>';
    		echo '</div>';
    	}
		
		if(isset($message) && $message !=='')
		{
			echo nl2br($message);
		}
?>