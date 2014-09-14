

				<tr>
					<td valign="top" align="left" colspan="2">
		<!--<h1>&Cayleys;&Lambda;&Gamma;&Delta;&aleph;&iota;&Pi;&Xi;</h1>-->
		<h1>Karhani'ye</h1>
		</td>
					<td valign="top" align="right" >
<?php if(verif_connect(true)) { ?>
		<div class="important">Mon Compte</div><br />
		<a href="<?php echo get_Link('Profil','User')?>">Profil</a><br/>
		<?php			
	if (verif_access("Modo",true) )
	{
		?>
		<a href="<?php echo get_Link('Main','Moderator')?>"><div class="important">Modération</div></a>
		<?php
	}
	if (verif_access("Admin",true))
	{
		?>
		<a href="<?php echo get_Link('Main','Admin')?>"><div class="important">Administration</div></a>
		<a href="<?php echo get_Link()?>?setMessageEditionMode=ok"><div class="important">edition</div></a>
		<?php
	}
?>
<br/>
		
		<a href="<?php echo get_Link('Logout','User')?>">Déconnexion</a><br />		
<?php } ?>

</td>
				</tr>