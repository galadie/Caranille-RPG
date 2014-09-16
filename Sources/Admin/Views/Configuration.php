<?php
	if(verif_access("Admin"))
	{
		if(request_confirm('End_Edit'))
		{
			echo 'Mise à jour effectuée';
			echo '<form method="POST" action="'.get_link("Configuration","Admin").'">';
			echo '<input type="submit" name="accueil_configuration" value="Continuer">';
			echo '</form>';
		}
		else //if (empty($_POST['End_Edit']))
		{
			if($dossier = opendir($_path.'/Design'))
			{
				while(false !== ($fichier = readdir($dossier)))
				{
					if($fichier != '.' && $fichier != '..' && is_dir($_path.'/Design/'.$fichier)) //( $fichier != 'index.php')
					{
						$designs[] = $fichier ;
					}
				}
				
				closedir($dossier);

			}
				
			// update by Dimitri
			echo '<form method="POST" action="'.get_link("Configuration","Admin").'">';
			echo '<div class="important">Le MMORPG '.$MMORPG_Name.' est actuellement '.($MMORPG_Access == 'No' ? 'fermé' : 'ouvert' ).' aux joueurs</div><br />';
			echo '<input '.($MMORPG_Access == 'No' ? '' : 'checked' ).' type="radio" name="MMORPG_Access" value="Yes" ID="Yes" /> <label for="Yes">Ouvrir le mmorpg aux joueurs</label><br />';
			echo '<input '.($MMORPG_Access == 'No' ? 'checked' : '' ).' type="radio" name="MMORPG_Access" value="No" ID="No" /> <label for="No">Fermer le mmorpg aux joueurs</label><br /><br />';
			echo "Langue : <input type='text' name='MMORPG_Language' value='$MMORPG_Language' /><br/>";
			echo "Description : <br /><textarea name=\"MMORPG_Description\" >$MMORPG_Description</textarea><br />";
			echo "Présentation :<br/>".call_wysiwyg('MMORPG_Presentation',$MMORPG_Presentation);
			echo 'Design : <select name="MMORPG_Template">';
			//	echo "<option>_template_</option>";
			foreach($designs as $img )
			{
				echo "<option ".($MMORPG_Template == $img ? 'selected' : '' )."  value='$img' >$img</option>";
			}
			echo '</select><br/>';
			
			echo '<div class="important">Activer la debug-barre?</div><br />';
			echo '<input '.($active_debug == 1 ? '' : 'checked' ).' type="radio" name="active_debug" value="1" ID="Yes" /> <label for="Yes">Oui</label>';
			echo '<input '.($active_debug == 0 ? 'checked' : '' ).' type="radio" name="active_debug" value="0" ID="No" /> <label for="No">Non</label><br /><br />';
		
			
			echo "<h2>Bonus</h2>";			
			echo "Bonus de degats en combat<input type='number' step='0.01' name='bonus_malus_battle' value='$bonus_malus_battle' /><br/>";
			echo "Bonus de prospection<input type='number' step='0.01' name='bonus_malus_prospection' value='$bonus_malus_prospection' /><br/>";
			echo "Bonus de minage<input type='number' step='0.01' name='bonus_malus_minage' value='$bonus_malus_minage' /><br/>";
			echo "Bonus de coupe<input type='number' step='0.01' name='bonus_malus_coupe' value='$bonus_malus_coupe' /><br/>";
			echo "Bonus de culture<input type='number' step='0.01' name='bonus_malus_culture' value='$bonus_malus_culture' /><br/>";
			echo "Bonus de chasse<input type='number' step='0.01' name='bonus_malus_chasse' value='$bonus_malus_chasse' /><br/>";
			echo "Bonus de taille<input type='number' step='0.01' name='bonus_malus_taille' value='$bonus_malus_taille' /><br/>";
			echo "Bonus de orfevrerie<input type='number' step='0.01' name='bonus_malus_orfevrerie' value='$bonus_malus_orfevrerie' /><br/>";
			echo "Bonus de scierie<input type='number' step='0.01' name='bonus_malus_scierie' value='$bonus_malus_scierie' /><br/>";
			echo "Bonus de distillerie<input type='number' step='0.01' name='bonus_malus_distillerie' value='$bonus_malus_distillerie' /><br/>";
			echo "Bonus de tannerie<input type='number' step='0.01' name='bonus_malus_tannerie' value='$bonus_malus_tannerie' /><br/>";
			echo "Bonus de bijouterie<input type='number' step='0.01' name='bonus_malus_bijouterie' value='$bonus_malus_bijouterie' /><br/>";
			echo "Bonus de forge<input type='number' step='0.01' name='bonus_malus_forge' value='$bonus_malus_forge' /><br/>";
			echo "Bonus de papeterie<input type='number' step='0.01' name='bonus_malus_papeterie' value='$bonus_malus_papeterie' /><br/>";
			echo "Bonus de herborisme<input type='number' step='0.01' name='bonus_malus_herborisme' value='$bonus_malus_herborisme' /><br/>";
			echo "Bonus de couture<input type='number' step='0.01' name='bonus_malus_couture' value='$bonus_malus_couture' /><br/>";
				
			echo "<h2>Combat : restauration</h2>";			
			echo "Restauration apres arene<input type='number' name='percent_life_restore_arena' value='$percent_life_restore_arena' /><br/>";
			echo "Restauration apres Chapitre<input type='number' name='percent_life_restore_chapter' value='$percent_life_restore_chapter' /><br/>";
						
			echo "<h2>Groupe de combat</h2>";			
			echo "Maximum de membres<input type='number' name='roaster_max_membres' value='$roaster_max_membres' /><br/>";
			echo "Bonus<input type='number' step='0.01' name='roaster_max_bonus' value='$roaster_max_bonus' /><br/>";
			
			echo "<h2>Guilde : validité</h2>";			
			echo "Minimum de membres<input type='number' name='guild_min_members' value='$guild_min_members' /><br/>";
			echo "Minimum finnancier<input type='number' name='guild_min_golds' value='$guild_min_golds' /><br/>";
			
			
			echo "<h2>Monnaie</h2>";			
			echo "taux monnaitaire <input type='number' step='0.01' name='money_tx' value='$money_tx' /><br/>";
			echo "nombre de monnaie <input type='number' step='0.01' name='money_nb' value='$money_nb' /><br/>";
			
			echo "<h2>Carte</h2>";			
			echo "rayon de la carte mondiale <input type='number' name='rayon_map' value='$rayon_map' /><br/>";
			echo "rayon de la carte de ville <input type='number' name='rayon_city' value='$rayon_city' /><br/>";
			
			echo "<h2>Connexion</h2>";
			echo "essai limit de connexion <input type='number' name='connect_try' value='$connect_try' /><br/>";
			echo "marge limit de connexion <input type='number' name='connect_marge' value='$connect_marge' /><br/>";
			
			echo "<h2>Classement</h2>";
			echo "nombre limite de membre <input type='number' name='top_members_limit' value='$top_members_limit' /><br/>";

			echo "<h2>Email</h2>";
			echo "email administrateur <input type='text' name='email_expediteur' value='$email_expediteur' /><br/>";
			echo "email no-reply <input type='text' name='email_reply' value='$email_reply' /><br/>";
			
			echo '<input type="submit" name="End_Edit" value="Terminer"/>';
			echo '</form>';
		}
	}
?>