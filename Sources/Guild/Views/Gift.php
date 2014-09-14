<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$title ="";
	//$baseline= ""

    if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
			menu_guild();
			
						$xp_purcent = (guild_data('Guild_Experience')/guild_data('Level_Experience_Required'))*100;
						$next = guild_data('Level_Experience_Required')- guild_data('Guild_Experience');

                       echo "<div id='guild-autel'>";
			
			echo "<div title='".guild_data('Guild_Experience')."/".guild_data('Level_Experience_Required')."' class='barre' id='xp' >";
			echo "<div style='height:".(100-$xp_purcent)."px;' class='restant'>$next</div>";
			echo "<div style='height:".$xp_purcent."px;' >&nbsp;</div>";
			echo "</div>";
			
			echo "Experience";
			
			echo '<form method="POST" action="'.get_link("Gift","Guild").'">';
			echo '<input type="number" name="experience"/>';
			//echo '<input type="submit" name="xp-Send" value="Sacrifier"/>';
			echo '<input type="submit" name="xp-Send" value="'.LanguageValidation::nMsg("btn.guild.gift").'"/>'.LanguageValidation::eMsg("btn.guild.gift");
			echo '<input type="hidden" name="token" value="'.generer_token('guild-xp-Send').'" />';
			echo '</form>';
			
			echo "</div>";

            echo "<div id='guild-coffre'>";
			echo "<span class='gain gold'>".guild_data('Guild_Golds')."</span>";
			
			echo "Or";
			echo '<form method="POST" action="'.get_link("Gift","Guild").'">';
			echo '<input type="number" name="golds"/>';
			//echo '<input type="submit" name="Golds-Send" value="Sacrifier"/>';
			echo '<input type="submit" name="Golds-Send" value="'.LanguageValidation::nMsg("btn.guild.gift").'"/>'.LanguageValidation::eMsg("btn.guild.gift");
			echo '<input type="hidden" name="token" value="'.generer_token('guild-golds-Send').'" />';
			echo '</form>';
			
			echo "</div>";
		}
	}