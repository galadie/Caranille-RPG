<?php $try_content = list_db('list_pages')); ?>

				<?php if(!empty($try_content)){ ?>
					<div class="about">
					<?php foreach($try_content as $r => $content) { ?>
						<div class="<?php echo ($r%2 ? 'content' : 'aside') ?>">
							<ul>
								<li>
									<h3><?php echo $content['Page_Title']?></h3>
									<div><?php echo $content['Page_Content']; ?></div>
								</li>
								
							</ul>
						</div>
					<?php } ?>
					</div>
				<?php } ?>
