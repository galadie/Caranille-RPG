<?php

if (empty($_POST) )//&& empty($_GET) )//['Register']))
	{	
        echo '<div id="login">';// update by Dimitri
        
		echo '<div class="important">Revalider l\'inscription</div><br /><br />';
        

		echo '<form method="POST" action="'.get_link('Email_Valid','User').'">';
		echo '<label for="Pseudo">Pseudo</label><input placeholder="Pseudo" type="text" name="Pseudo"><br /><br />';
		echo '<label for="Password">Password</label><input placeholder="Mot de passe" type="password" name="Password"><br /><br />';
        echo '<label for="Password_Confirm">Confirmation</label><input placeholder="Resaisir le mot de passe" type="password" name="Password_Confirm"/><br /><br />';
        echo '<label for="Email">Adresse e-mail</label><input placeholder="E-mail" type="text" name="Email"/><br /><br />';
        echo '<div style="display: none;">Ne pas remplir ce champ : <input type="text" name="verif" placeholder="Laisser vide."/><br/></div>';
	    echo '<input type="hidden" name="token" value="'.generer_token("Valid").'"/>';
		echo '<input type="submit" name="Valid" value="Renouveller">';
		echo '</form>';
		
		echo '</div>';
	}