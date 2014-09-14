					<div class="blog">
						<div class="content">
							<ul>
								<li>
									<div class="header">
										<span><a href="#"><?php echo $secteur_module ?></a><a href="#"><?php echo $page ?></a></span>
									</div>
									<div class="article">
										<p>
											<?php include_once($content) ?>
										</p>
									</div>
								</li>
							</ul>
						</div>
						<?php if(!is_null($right)) include_once($right); ?>
					</div>