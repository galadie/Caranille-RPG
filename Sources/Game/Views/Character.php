<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$title ="";
	//$baseline= ""
	
	if(verif_connect()) // (isset(user_data('Account_ID']))
	{
			menu_character();
		    get_ocedar();
?>
			<div id="stats">
				<?php echo LanguageValidation::iMsg("intro.game.character") ?><br /><br />
					
				<span class="important"><?php echo LanguageValidation::iMsg("label.profil.race") ?></span> :<?php echo user_data('Race_Name'); ?><br />
				<span class="important"><?php echo LanguageValidation::iMsg("label.profil.classe") ?></span> :<?php echo user_data('Classe_Name'); ?><br />
				<span class="important"><?php echo LanguageValidation::iMsg("label.game.chapter") ?></span> : <?php echo user_data('Account_Chapter'); ?><br />
				<span class="important"><?php echo LanguageValidation::iMsg("label.game.mission") ?></span> :<?php echo user_data('Account_Mission'); ?>
				
				<form method="post" action="<?php echo get_link("Character", "Game") ?>">
				
				<?php if(user_data('Account_Roaster_Accept')!==2 ){ ?>
				
					<?php echo LanguageValidation::iMsg("label.game.roaster") ?>
					<input type="radio" name="Roaster" value="1" <?php echo (user_data('Account_Roaster_Accept')==1 ? "checked" : ""); ?> /> <?php echo LanguageValidation::iMsg("global.yes") ?>
					<input type="radio" name="Roaster" value="0" <?php echo (user_data('Account_Roaster_Accept')==0 ? "checked" : ""); ?>/> <?php echo LanguageValidation::iMsg("global.no") ?>
					
					<input type="submit" name="chara-design" value="<?php echo LanguageValidation::nMsg("btn.roaster.accept") ?>"/><?php echo LanguageValidation::eMsg("btn.roaster.accept"); ?>
					
				<?php } else echo "<div>en groupe</div>"; ?>
				</form>
			</div>
<?php	
	}
?>
