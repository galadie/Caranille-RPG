<?php

	if(verif_access("Modo"))
	{
		if (empty($_POST['Add']))
        {
			echo '<form method="POST" action="'.get_link('Sanctions','Moderator').'">';
			echo '<label for="Account_ID">Choix du joueur</label><br />';
			echo '<select name="Account_ID" ID="Account_ID">';
            echo get_list_option_user();
			echo '</select><br /><br />';
			echo 'Raison du banissement <br /> <input type="text" name="Account_Reason"><br /><br />';	
			echo '<input type="submit" name="Add" value="Terminer">';
			echo '</form>';
		}
	}