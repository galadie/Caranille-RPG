
				<div class="blog">
					
						<div class="content">
							
							<ul>
								<li>
									<div class="header">
										<h3>Personnage</h3>
									</div>
									<div class="article">
										<?php include_once(path_view('Character','Game')); ?>
										<?php get_perso_card();//include_once("perso.php"); ?>
									</div>
									<div class="header">
										<h3>Ordre</h3>
									</div>
									<div class="article">
									<?php include_once(path_view('Order','Game')); ?>
									</div>
									<div class="header">
										<h3>Inventaire</h3>
									</div>
									<div class="article">
										<?php include_once(path_view('Inventory','Game')); ?>
									</div>
									
								</li>
								
							</ul>
						</div>
						
						<div class="sidebar">
							<h3>Journal</h3>
							<ul>
								<li><?php include_once(path_view('Diary','Game')); ?></li>
							</ul>
							
							<h3>Chat</h3>
							<ul>
								<li><?php include_once(path_view('Chat','User')); ?></li>
							</ul>

							<h3>Atelier</h3>
							<ul>
								<li><?php include_once(path_view('Craft','Game')); ?></li>
							</ul>
						</div>	
						
					</div>

										
					
					<div class="media">
						<div>
							<div>
								<h3>Guilde</h3>
								<ul><?php include_once(path_view('guild','guild')); ?></ul>
							</div>
							<?php if(has_guild()) { ?>	
							<div>
								<h3>Autel</h3>
								<ul><?php include_once(path_view('gift','guild')); ?></ul>
							</div>
							<?php } ?>
						</div>
					</div>								
				
				
				
					<div class="games">

						<div class="content">
							<h3>Carte</h3>
							<ul>
								<li><?php if(isset($racine) && $racine !="") include_once(path_view('Index','Shop')); ?></li>								
								<li><?php include_once(path_view( (verif_town() ? 'Town' : 'World' ),'Map')); ?></li>
								<li><?php include_once(path_view('Accessory','Shop')); ?></li>
							</ul>
						</div>

						<div class="aside">
							<h3>Auberge</h3>
							<ul>
								<?php include_once(path_view('Inn','Map')); ?>
							</ul>
							<h3>Quetes</h3>
							<ul>
								<li><?php include_once(path_view('QuestLogs','Game')); ?></li>
								<li><?php include_once(path_view('QuestBoard','Game')); ?></li>
							</ul>
						</div>
								
					</div>

						