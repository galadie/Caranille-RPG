<?php

if (empty($_POST['Delete']) && empty($_POST['Second_Delete']))
	{
        echo '<div id="login">';
        
        /**
		echo '<form method="POST" action="'.get_link('Delete_Account','User').'"><br />';
		echo '<label for="Pseudo">Pseudo</label><input placeholder="Pseudo" type="text" name="Pseudo"><br /><br />';
		echo '<label for="Password">Password</label><input placeholder="Mot de passe" type="password" name="Password"><br /><br />';
		echo '<input type="submit" name="Second_Delete" value="Suppression">';
	    echo '<input type="hidden" name="token" value="'.generer_token("Delete_Account-step-1").'"/>';
		echo '</form>';
		
			**/	
		echo formulaire_input(array(
			
					text_input("label.login.pseudo","Pseudo",null,null,null,"placeholder.login.pseudo")
				,	password_input("label.login.password","Password",null,null,null,"placeholder.login.password")
				,	submit_input("Second_Delete","btn.delete.account")
			
			),"Delete_Account-step-1",get_link('Delete','User'),"post",null);

		echo '</div>';
	}
	if (request_confirm('Second_Delete'))
	{
	//	$Pseudo = htmlspecialchars(addslashes($_POST['Pseudo']));
	//	$Password = md5(htmlspecialchars(addslashes($_POST['Password'])));
		
		if(verifier_token(600, get_link('Delete_Account') ,  'Delete_Account-step-1'))
		{
			extract(addslashes_r($_POST));
			
			echo "Sans Regret ?<br />";
		/**	echo '<form method="POST" action="'.get_link('Delete','User').'">';
			echo '<input type="hidden" name="Pseudo" value="'.$Pseudo.'"/>';
			echo '<input type="hidden" name="Password" value="'.$Password.'"/>';
			echo '<input type="submit" name="Back" value="Renoncer">';
			echo '<input type="hidden" name="token" value="'.generer_token("Delete_Account-step-2").'"/>';
			echo '<input type="submit" name="Delete" value="Suppression">';
			echo '</form>';
		**/	
			echo formulaire_input(array(
					hidden_input("Pseudo",$Pseudo)
				,	hidden_input("Password",$Password)
				,	submit_input("Back","btn.back.account")
				,	submit_input("Delete","btn.delete.account")
			
			),"Delete_Account-step-2",get_link('Delete','User'),"post",null);

		}
	}
	