<?php
/*
    PROTOTYPE DU MODULE GUILDE
    */
    if(verif_connect())
    {
		 //Si l'utilisateur postule à une Guilde
		 if(postul_guild())
		{
				echo "<h4>".guild_data('Guild_Name')."</h4>";
				echo "Votre candidature est étudiée...<br/>";
		}
		else //Si l'utilisateur ne possède pas de Guilde
        if(!has_guild())
        {
			menu_character();
            //Si l'utiliateur n'a pas fait le choix de créer ou rejoindre une guilde
            if (empty($_POST))//['Create_Guild']) && empty($_POST['Guild']))
            {
				echo LanguageValidation::iMsg("label.guild.choose");
                echo '<ol>';
                echo '<li>';
                echo '<form method="POST" action="'.get_link("Guild","Guild").'">';
                echo '<input type="submit" name="Create_Guild" value="'.LanguageValidation::nMsg("btn.guild.create").'"/>'.LanguageValidation::eMsg("btn.guild.create");//Créer une guilde"/>';
 	            echo '<input type="hidden" name="token" value="'.generer_token("guild-init").'"/>';
               echo '</form></li>';
				
				$Guild_List = list_db('list_guild'); 

				if(!empty($Guild_List))
				{
					echo '<li>ou rejoindre une guilde existante<br/>';
					echo '<form method="POST" action="'.get_link("Guild","Guild").'">';
					echo '<input type="submit" name="Accept" value="'.LanguageValidation::nMsg("btn.guild.join").'"/>'.LanguageValidation::eMsg("btn.guild.join");//Rejoindre la guilde"/>';
					echo '<select name="Guild_ID" ID="Guilde">';
					echo "<option></option>";
					foreach ($Guild_List as $Guild)
					{
						extract(stripslashes_r($Guild));
						
						echo "<option value=\"$Guild_ID\">$Guild_Name</option>";
					}
					echo '</select>';
					echo '<input type="hidden" name="token" value="'.generer_token("guild-accept").'"/>';
					echo '</form></li>';
				}
                echo '</ol>';
            }
            
            if (request_confirm('Create_Guild'))
        	{				
	        	if(verifier_token(60, get_link('Guild','Guild') ,  'guild-init'))
        	    {
      				echo LanguageValidation::iMsg("intro.guild.create");
					echo '<form method="POST" action="'.get_link("Guild","Guild").'">';
            		echo ''.LanguageValidation::iMsg("label.guild.name").'<input placeholder="'.LanguageValidation::nMsg("placeholder.guild.name").'" type="texte" name="Guild_Name">'.LanguageValidation::eMsg("placeholder.guild.name").'<br />';
            		echo ''.LanguageValidation::iMsg("label.guild.description").'<br /><textarea placeholder="'.LanguageValidation::nMsg("placeholder.guild.description").'" name="Guild_Description" ID="Guild_Description" rows="10" cols="50"></textarea>'.LanguageValidation::eMsg("placeholder.guild.description").'<br /><br />';
    	            echo '<input type="hidden" name="token" value="'.generer_token("guild-create").'"/>';
            		echo '<input type="submit" name="Confirm" value="'.LanguageValidation::nMsg("btn.guild.init").'"/>'.LanguageValidation::eMsg("btn.guild.init");//Créer la guilde">';
            		echo '</form>';
        	    }
        	}        	
        }
        else
        {
            //echo 'vous appartenez déjà à une guilde';
			menu_guild();
			
            	echo "<div id='guild-page'>";
            					
				echo "<h4>".guild_data('Guild_Name')."</h4>";
				echo "<p>".guild_data('Guild_Description')."</p>";
				echo "<p>La guilde est au niveau ".guild_data('Guild_Level')."</p>";
			/**
				if(guild_data('Guild_Owner_ID') == user_data('Account_ID'))
					echo 'Vous êtes le fondateur de cette guilde.<br/>';
			**/	
        	if(verif_guild(true))
			{                 

				if(guild_has('Guild_Message'))
				{
					echo "<h5>Message</h5>";
					echo "<p>".bb_code(guild_data('Guild_Message'))."</p>" ;
				}
			}
				
			echo "</div>";
		}
    }