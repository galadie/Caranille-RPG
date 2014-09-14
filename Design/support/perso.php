<?php 
if(!$installing)
{ 
	if(verif_connect(true) && ($secteur_module !== 'Admin' && $secteur_module !== 'Moderator' && $secteur_module !== 'Forum' ))
	{
		if (isset($Next_Level))
		{ 
			$hp_purcent = (user_data('Account_HP_Remaining')/perso_data('HP_Total'))*100;
			$mp_purcent = (user_data('Account_MP_Remaining')/perso_data('MP_Total'))*100;
			$xp_purcent = (user_data('Account_Experience')/user_data('Level_Experience_Required'))*100;
?>
			<span class="important">Pseudo :</span> <?php echo user_data('Account_Pseudo'); ?> <br />
			<span class="important">Guilde :</span> <?php echo guild_data('Guild_Name'); ?> <br />
			<span class="important">Ordre :</span> <?php echo user_data('Order_Name'); ?> <br /><br />
			
			<span class="important">Niveau</span> : <?php echo user_data('Level_Number'); ?> <br />
			
			<span class="important">HP</span> : <div title='<?php echo user_data('Account_HP_Remaining'). "/" .perso_data('HP_Total'); ?>' class='barre' id='hp' >
												<div style='width:<?php echo $hp_purcent ?>px;' ></div>
											</div> <br />
			<span class="important">MP</span> : <div title='<?php echo user_data('Account_MP_Remaining'). "/" .perso_data('MP_Total'); ?>' class='barre' id='mp' >
												<div style='width:<?php echo $mp_purcent ?>px;' ></div>
											</div>  <br />

			<span class="important">XP</span> : <div title='<?php echo user_data('Account_Experience')."/".user_data('Level_Experience_Required'); ?>' class='barre' id='xp' >
												<div style='width:<?php echo $xp_purcent ?>px;' >&nbsp;</div> 
												<em style='width:<?php echo (100-$xp_purcent) ?>px;' class="restant"><?php echo $Next_Level; ?></em>
											</div> <br /><br />

			<span class="important">Force</span> : <?php echo perso_data('Strength_Total'); ?> <br />
			<span class="important">Magie</span> : <?php echo $_SESSION['Magic_Total']; ?> <br />
			<span class="important">Agilité</span> : <?php echo $_SESSION['Agility_Total']; ?> <br />
			<span class="important">Défense</span> : <?php echo $_SESSION['Defense_Total']; ?> <br />
			
			<br />
									
			<span class="important">PO</span> : <div class="gain gold"><?php echo user_data('Account_Golds'); ?></div><br />
			<span class="important">Notoriété</span> : <div class="gain notoriety"><?php echo user_data('Account_Notoriety'); ?></div><br /><br />

<?php
		}
	}
}
?>