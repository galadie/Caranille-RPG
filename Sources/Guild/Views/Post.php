<?php    if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
			menu_guild();
?>
			<fieldset>
				<legend>Forum</legend>
				<?php echo $return ?>
			</fieldset>
<?php
		}
	}
?>