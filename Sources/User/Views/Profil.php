<?php
	//On commence par s'assurer que le membre est connecté
	if(verif_connect()) 
	{
		if (request_confirm('Change_Password'))
		{
			echo ''.LanguageValidation::iMsg("intro.reset.password").'<br /><br />';
			echo '<form method="POST" action="'.get_link("Profil","User").'"><br />';
			echo ''.LanguageValidation::iMsg("label.profil.password").' : <input type="password" placeholder="'.LanguageValidation::nMsg("placeholder.profil.password").'" name="New_Password"/>'.LanguageValidation::eMsg("placeholder.profil.password").'<br />';
			echo ''.LanguageValidation::iMsg("label.profil.confirm").': <input type="password" placeholder="'.LanguageValidation::nMsg("placeholder.profil.confirm").'" name="New_Password_Confirmation">'.LanguageValidation::eMsg("placeholder.profil.confirm").'<br />';
		    echo '<input type="hidden" name="token" value="'.generer_token('Character-Password').'" />';
			echo '<input type="submit" name="Finish" value="'.LanguageValidation::nMsg("btn.profil.reset").'"/>'.LanguageValidation::eMsg("btn.profil.reset");//Terminer"/>';
			echo '</form>';
		}
		else
		if(request_confirm('Edit'))
		{
?>
        <form method="post" action="<?php get_link("Profil","User") ?>" enctype="multipart/form-data">
               
        <fieldset>
			<legend><?php echo LanguageValidation::iMsg("legend.profil.title") ?></legend>
			<div style="float:left;width:49%">
				<label for="avatar"><?php echo LanguageValidation::iMsg("label.profil.avatar") ?> :</label><br/>
				<img height="150px" align="left" src="<?php echo get_avatar() ; ?>" alt="<?php echo LanguageValidation::nMsg("alt.empty.avatar") ?>"/><?php echo LanguageValidation::eMsg("alt.empty.avatar"); ?>
				<?php echo LanguageValidation::iMsg("label.profil.maxsize",round($avatar_maxsize/1024)) ?><br /><br />
				<label><input type="checkbox" name="delete" value="Delete" /><?php echo LanguageValidation::iMsg("label.avatar.remover") ?></label>
				<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $avatar_maxsize ?>" />
				<input type="file" name="avatar" id="avatar" /><br/>
			</div>
			<div style="float:left;width:49%">
				<label for="signature"><?php echo LanguageValidation::iMsg("label.profil.signature") ?> :</label>
				<?php echo call_bbcode_editor("signature",user_data('Account_Signature')) ?>
			   <!--<textarea cols="40" rows="4" name="signature" id="signature"><?php //echo user_data('Account_Signature'); ?></textarea>-->
			</div>
     
        </fieldset>
        <p>
        <input type="submit" name="sent" value="<?php echo LanguageValidation::nMsg("btn.profil.update") ?>"/><?php echo LanguageValidation::eMsg("btn.profil.update"); ?>
        </p></form>
<?php
		} 
		else
		if(isset($_return))
		{
			echo $_return ;
		}
		else
		if (empty($_POST))//['Change_Password']) && empty($_POST['Finish']))
		{
		
 ?>
		<h3><?php echo LanguageValidation::iMsg("title.profil.mod") ?></h3>
		<div class="important"><?php echo LanguageValidation::iMsg("label.profil.email") ?></div> :<?php echo user_data('Account_Email'); ?><br />
		<div class="important"><?php echo LanguageValidation::iMsg("label.profil.access") ?></div> :<?php echo user_data('Account_Access'); ?><br />
		<form method="POST" action="<?php echo get_link("Profil","User") ?>"><br />
		<input type="submit" name="Change_Password" value="<?php echo LanguageValidation::nMsg("btn.profil.password") ?>"/><?php echo LanguageValidation::eMsg("btn.profil.password"); ?><br/>
		<input type="submit" name="Edit" value="<?php echo LanguageValidation::nMsg("btn.profil.edit") ?>"/><?php echo LanguageValidation::eMsg("btn.profil.edit"); ?>
		</form>
		<form method="POST" action="<?php echo get_link("Friends","User") ?>"><br />
		<input type="submit" name="Edit" value="<?php echo LanguageValidation::nMsg("btn.profil.friends") ?>"/><?php echo LanguageValidation::eMsg("btn.profil.friends"); ?>
		</form>
		<br /><br />	
<?php
		}
	}