<?php if(!verif_connect(true)) { ?>
				
					<div class="section">
						<div>
						
							<h3>Presentation</h3>
							<div>
								<p><?php include_once(path_view('Presentation','Public')); ?></p>
							</div>
						</div>
						<div>
							<h3>Inscription</h3>
							<div>
								<?php if(isset($baseline)) echo $baseline ?><hr/>
								<?php include_once(path_view('Members','Register')); ?>
							</div>
						</div>
						<div>
							<h3>Login</h3>
							<div>
								<?php include_once(path_view('Login','User')); ?>
							</div>
						</div>
					</div>
					
				<?php } else { ?>
				
					<br/><br/><br/><br/>
					
					<div class="games">
						<div class="content">
							<h3>Presentation</h3>
							<ul>
								<p><?php include_once(path_view('Presentation','Public')); ?></p>
							</ul>
						</div>
						<div class="aside">
							<h3>Profil</h3>
							<ul>
								<?php include_once(path_view('Profil','User')); ?>
							</ul>
						</div>
					</div>
				<?php } ?>