<?php  	if($installing) { ?>
			
				<aside>
				
					<a href="<?php echo get_link('Install').($install_step > 1 ? '&step='.$install_step : '') ?>">Installation</a> <br/><br/>
					
					<a href="<?php echo get_link('propos','Install') ?>">Propos</a> <br/>
					<a href="<?php echo get_link('reglements','Install') ?>">Fonctionnalités</a> <br/>
					<a href="<?php echo get_link('nouveautes','Install') ?>">Nouveautés</a> <br/>
					<a href="<?php echo get_link('avenir','Install') ?>">Avenir</a> <br/><br/>
					
					<a href="<?php echo get_link('mentions','Install') ?>">Mentions légales</a> <br/> <br/>
					
					<a href="<?php echo get_link('videos','Install') ?>">Vidéos</a><br/>
					<a href="<?php echo get_link('version','Install') ?>">Versions</a> <br/> <br/>
					
					<a href="<?php echo get_link('contact','Install') ?>">Contact</a> <br/>
					<a href="<?php echo get_link('faq','Install') ?>">FAQ</a><br/>
					<a href="<?php echo get_link('remerciements','Install') ?>">Remerciements</a> <br/><br/>
					<a href="<?php echo get_link('configuration','Install') ?>">Configuration</a> <br/>
					
				</aside>
<?php
				}
				elseif($secteur_module !== 'Admin'|| $secteur_module !== 'Moderator')
				{
?>				
					<p>
				<footer>
				
			<?php count_connect(); ?>

			<a class="copyright" href="http://www.caranille.com">MMORPG crée avec Caranille</a>
			<div class="admin">
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
		<a href="<?php echo get_Link()?>?setMessageEditionMode=ok"><div class="important">edition</div></a>
		<a href="<?php echo get_Link('Main','Admin')?>"><div class="important">Administration</div></a>
		<?php
	}
?>
            </div>
			
			</footer>
			</p>


<?php 				
				}
				?>