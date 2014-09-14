<?php 
if(!function_exists('html_menu'))
{
	function html_menu($title="Menu",$links = array(), $infos ="" )
	{
?>
							<div>
								<span><a href="#" class="selected"><?php echo $title ?></a></span>
							</div>
							<ul>
								<li>
								<?php if(!empty($links)) { ?>
									<?php foreach($links as $link) { ?>
										<a href="<?php echo get_link($link[0],$link[1]) ?>"><?php echo $link[2] ?></a>
									<?php }	?>
								<?php }	?>
								</li>
								
								<?php if($infos!="") { ?><p><?php echo $infos ?></p><?php } ?>
								
							</ul>
<?php	
	}
}
?>						<div class="sidebar">
							
	 <?php
       

		if(verif_access("Admin",true) && $secteur_module === 'Admin')//Si le Access est Admin, afficher le menu de l'admin
		{
			call_menu_admin() ;
		}
		elseif (verif_access("Modo",true) && $secteur_module === 'Moderator')//Si le Access est Admin, afficher le menu de l'admin
		{
			call_menu_modo();
		}
	?>    
						</div>
