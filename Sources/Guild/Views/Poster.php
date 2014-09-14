<?php
    if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
			menu_guild();


switch($action)
{
case "repondre":{ //Premier cas on souhaite répondre

?>
<h1>Poster une réponse</h1>
 
<form method="post" action="<?php echo get_link('Post','Guild',array('action'=>'repondre','t'=>$Topic_ID)) ?>" name="formulaire">

	<fieldset><legend>Message</legend>
	<?php echo call_bbcode_editor("message") ?>
	<!--<textarea cols="70" rows="7" id="message" name="message"></textarea></fieldset>-->
	<input type="submit" name="submit" value="Envoyer" />
	<input type="reset" name = "Effacer" value = "Effacer"/>
	
</form>
<?php
}break;
 
case "nouveautopic":{
?>
 
<h1>Nouveau topic</h1>
<form method="post" action="<?php echo get_link('Post','Guild',array('action'=>'nouveautopic','f'=>$Forum_ID)) ?>" name="formulaire">
	 
	<fieldset><legend>Titre</legend>
	<input type="text" size="80" id="titre" name="titre" /></fieldset>
	<fieldset><legend>Message</legend>
	<?php echo call_bbcode_editor("message") ?>
	<!--<textarea cols="70" rows="7" id="message" name="message"></textarea></fieldset>-->
	<?php if (verif_access($Auth_annonce,true)) { ?>
	<label><input type="radio" name="mess" value="Annonce" />Annonce</label>
	<label><input type="radio" name="mess" value="Message" checked="checked" />Topic</label>
	<?php } else { ?>
	<input type="hidden" name="mess" value="Message" />
	<?php } ?>
	</fieldset>
	<input type="submit" name="submit" value="Envoyer" />
	<input type="reset" name = "Effacer" value = "Effacer" />
	
</form>
<?php
}break;
 
case "edit":{ //Si on veut éditer le post
  
    //Ensuite on vérifie que le membre a le droit d'être ici (soit le créateur soit un modo/admin) 
    if (verif_Access($Auth_modo,true) || $Post_Createur === user_data('Account_ID'))
    {
        //Le formulaire de postage
        ?>
		<h1>Edition</h1>
        <form method="post" action="<?php echo get_link('Post','Guild',array('action'=>'edit','p'=>$post)) ?>" name="formulaire">
 
        <fieldset><legend>Message</legend>
			<?php echo call_bbcode_editor("message", $Post_texte) ?>
	<!--<textarea cols="70" rows="7" id="message" name="message"></textarea></fieldset>-->
        </fieldset>
        <p>
        <input type="submit" name="submit" value="Editer !" />
        <input type="reset" name = "Effacer" value = "Effacer"/></p>
        </form>
        <?php
    }
}break; //Fin de ce cas :o
?>

<?php
case "delete":{ //Si on veut supprimer le post
     
    //Ensuite on vérifie que le membre a le droit d'être ici (soit le créateur soit un modo/admin) 
    if (verif_Access($Auth_modo,true) || $Post_Createur === user_data('Account_ID'))
    {
        echo'<h1>Suppression</h1>';
		echo'<p>Êtes vous certains de vouloir supprimer ce post ?</p>';
        echo'<p><a href="'.get_link('Post','Guild',array('action'=>'delete','p'=>$post)).'">Oui</a> ou <a href="'.get_link('Main','Guild').'">Non</a></p>';
    }
}break;
?>

<?php
default: //Si jamais c'est aucun de ceux là c'est qu'il y a eu un problème :o
echo'<p>Cette action est impossible</p>';
} //Fin du switch
?>

<?php
}

}