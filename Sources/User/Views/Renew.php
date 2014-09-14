<?php
  echo '<div id="login">';// update by Dimitri
        
	echo '<div class="important">Renouveller mon Mot de passe</div><br /><br />';

	echo '<form method="POST" action="'.get_link('Password_Renew','User').'">';
	echo '<label for="Pseudo">Pseudo</label><input placeholder="Pseudo" type="text" name="Pseudo"><br /><br />';
    echo '<label for="Email">Adresse e-mail</label><input placeholder="E-mail" type="text" name="Email"/><br /><br />';
    echo '<div style="display: none;">Ne pas remplir ce champ : <input type="text" name="verif" placeholder="Laisser vide."/><br/></div>';
    echo '<input type="hidden" name="token" value="'.generer_token("Renew").'"/>';
	echo '<input type="submit" name="Renew" value="Renouveller">';
	echo '</form>';
	
	echo '</div>';