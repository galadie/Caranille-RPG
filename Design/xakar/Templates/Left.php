
<?php 
if(!function_exists('html_menu'))
{
	function html_menu($title="Menu",$links = array(), $infos ="" )
	{
?>
		<div class="v_menu">
            <div class="top"><?php echo $title ?></div>
            
            <div class="middle">
				<?php if(!empty($links)) { ?>
					<ul>
						<?php foreach($links as $link) { ?>
							<li><a href="<?php echo get_link($link[0],$link[1]) ?>"><?php echo $link[2] ?></a></li>
						<?php }	?>
					</ul>
				<?php }	?>
				
				<?php if($infos!="") { ?><p><?php echo $infos ?></p><?php } ?>
            </div>
            
            <div class="bottom">
            </div>
        </div>
<?php	
	}
}
?>


<div id="h_menu"><?php echo menu_profil() ?></div>
   
    <div id="left">
    <?php
       
        if(verif_access("Admin",true) && $secteur_module === 'Admin')//Si le Access est Admin, afficher le menu de l'admin
		{
			call_menu_admin() ;
		}
		elseif (verif_access("Modo",true) && $secteur_module === 'Moderator')//Si le Access est Admin, afficher le menu de l'admin
		{
			call_menu_modo();
		}
		elseif(verif_connect(true) && ($secteur_module !== 'Admin' && $secteur_module !== 'Moderator')) // fichier Functions.php
		{
			call_menu_player();
		}
		elseif(!verif_connect(true))
		{ 
			call_menu_visitor();
		
		}
		
		if(!empty($_menu_))
		{
			$ok = array();
			
			foreach( $_menu_ as $slug => $title)
				$ok[] = array($slug,'Contenu', $title);
							
			html_menu('Informations',$ok, count_connect());
		}
	?>    
    </div>