<?php 
if(!$installing)
{ 
	if(verif_connect(true) && $secteur_module !== 'Moderator' && $secteur_module !== 'Admin')
	{
		if (isset($Next_Level))
		{
			$hp_purcent = (user_data('Account_HP_Remaining')/perso_data('HP_Total'))*100;
			$mp_purcent = (user_data('Account_MP_Remaining')/perso_data('MP_Total'))*100;
			$xp_purcent = (user_data('Account_Experience')/user_data('Level_Experience_Required'))*100;
?>

		<aside>
			<label class="important">Pseudo :</label> <?php echo user_data('Account_Pseudo'); ?> <br />
			<label class="important">Guilde :</label> <?php echo guild_data('Guild_Name'); ?> <br />
			<label class="important">Ordre :</label> <?php echo user_data('Order_Name'); ?> <br /><br />
			
			
			<label class="important">HP</label> : <?php echo user_data('Account_HP_Remaining'). "/" .perso_data('HP_Total'); ?><br/>
			<label class="important">MP</label> : <?php echo user_data('Account_MP_Remaining'). "/" .perso_data('MP_Total'); ?><br/>
			<label class="important">XP</label> : <?php echo user_data('Account_Experience')."/".user_data('Level_Experience_Required'); ?><br/><br/>
											

			<label class="important">Force</label> : <?php echo perso_data('Strength_Total'); ?> <br />
			<label class="important">Magie</label> : <?php echo $_SESSION['Magic_Total']; ?> <br />
			<label class="important">Agilité</label> : <?php echo $_SESSION['Agility_Total']; ?> <br />
			<label class="important">Défense</label> : <?php echo $_SESSION['Defense_Total']; ?> <br />
			
			<br />
									
			<label class="important">PO</label> : <label class="gain gold"><?php echo user_data('Account_Golds'); ?></label><br />
			<label class="important">Notoriété</label> : <label class="gain notoriety"><?php echo user_data('Account_Notoriety'); ?></label><br /><br />
			<label class="important">Niveau</label> : <?php echo user_data('Level_Number'); ?> <br />

			Caranille <?php echo "$version"; ?>
		</aside>

<?php
		}
	}
} 
?>