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
			<div class="table">
                	<div class="top">
                    </div>
                  <div class="column" style="margin-left: 50px;">
				  
                        <div class="entry">
							<div class="left">Pseudo :</div><div class="right"><?php echo user_data('Account_Pseudo'); ?></div>
                        </div>
                        <div class="entry">
							<div class="left">Guilde :</div><div class="right"><?php echo guild_data('Guild_Name'); ?></div>
                        </div>
                        <div class="entry">
							<div class="left">Ordre :</div><div class="right"><?php echo user_data('Order_Name'); ?></div>
                        </div>
                        <div class="entry">
							<div class="left">Niveau</div><div class="right"><?php echo user_data('Level_Number'); ?></div>
                        </div>
                        <div class="entry">
							<div class="left">Force</div><div class="right"><?php echo perso_data('Strength_Total'); ?></div>
                        </div>
                        <div class="entry">
							<div class="left">Magie</div><div class="right"><?php echo perso_data('Magic_Total'); ?></div>
                        </div>
                        <div class="entry">
							<div class="left">Agilité</div><div class="right"><?php echo perso_data('Agility_Total'); ?></div>
                        </div>
                        <div class="entry">
							<div class="left">Défense</div><div class="right"><?php echo perso_data('Defense_Total'); ?></div>
                        </div>
                       
					
                    </div>
                    
                    <img src="<?php echo $_url ?>Design/xakar/images/separator.png" width="28" height="201" class="separator">
                  <div class="column">
                    	<div class="entry">
                        	<div class="left">Expérience</div><div class="right"><div title='<?php echo user_data('Account_Experience')."/".user_data('Level_Experience_Required'); ?>' class='barre' id='xp' >
												<div style='width:<?php echo $xp_purcent ?>px;' >&nbsp;</div> 
												<em style='width:<?php echo (100-$xp_purcent) ?>px;' class="restant"><?php echo $Next_Level; ?></em>
											</div></div>
                        </div>
                        <div class="entry">
                        	<div class="left">Vie</div>
							<div class="right"><div title='<?php echo user_data('Account_HP_Remaining'). "/" .perso_data('HP_Total'); ?>' class='barre' id='hp' >
												<div style='width:<?php echo $hp_purcent ?>px;' ></div>
											</div></div>
                        </div>
                        <div class="entry">
                        	<div class="left">Mana</div>
							<div class="right"><div title='<?php echo user_data('Account_MP_Remaining'). "/" .perso_data('MP_Total'); ?>' class='barre' id='mp' >
												<div style='width:<?php echo $mp_purcent ?>px;' ></div>
											</div></div>
                        </div>
                        <div class="entry">
							<div class="left">Or</div> : <?php echo render_money() ?>
                        </div>
                        <div class="entry">
							<div class="left">Réputation</div> : <div class="gain notoriety"><?php echo user_data('Account_Notoriety'); ?></div>
                        </div>
                    </div>                    
                    
                    <div class="bottom"></div>
                </div>
<?php
		}
	}
}