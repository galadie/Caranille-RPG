<?php $list_news = list_db("list_news")); ?>
					<div class="blog">
					
<?php if($page != "comments") { ?>					
						<div class="content">
							<ul>
<?php if(!empty($list_news)) { foreach ($list_news as $News) { ?>
								<li>
									<div class="header">
										<b><?php echo $News['News_Title'] ?></b><span><a href="#"><?php echo news_date($News) ?></a><a href="#"><?php echo $News['News_Account_Pseudo'] ?></a></span>
									</div>
									<div class="article">
										<a href="#" class="figure"><img src="images/blog1.jpg" alt=""></a>
										<p><?php echo news_message($News) ?>
											
											<br/>
											
											<div class="more"><?php echo news_details_form($News) ?></div>
										</p>
									</div>
								</li>
<?php } } ?>
							
							</ul>
						</div>
<?php } else { ?>
						<div class="content">
							<ul>
								<li>
									<div class="header">
										<b><?php echo $News['News_Title'] ?></b><span><a href="#"><?php echo news_date($News) ?></a><a href="#"><?php echo $News['News_Account_Pseudo'] ?></a></span>
									</div>
									<div class="article">
										<a href="#" class="figure"><img src="images/blog1.jpg" alt=""></a>
										<p><?php echo news_intro($News) ?><br/><?php echo news_message($News) ?></p>
									</div>
								</li>
<?php if(verif_connect(true)) {	?>		
								<li>
									<div class="header">
										<b><?php echo LanguageValidation::iMsg("label.comment.content")?></b><span><a href="#"><?php echo news_date($News) ?></a><a href="#"><?php echo $News['News_Account_Pseudo'] ?></a></span>
									</div>
									<div class="article">
										<?php echo news_comment_form($News)?>
									</div>
								</li>
<?php
	}
	
	if(!empty($list_comment))
	{
		foreach ($list_comment as $comment)
		{	
?>		
								<li>
									<div class="header">
										<b><?php echo LanguageValidation::iMsg("intro.comment.record", news_comment_date($comment), $comment['Comment_Account_Pseudo'])?></b><span><a href="#"><?php echo news_date($News) ?></a><a href="#"><?php echo $News['News_Account_Pseudo'] ?></a></span>
									</div>
									<div class="article">
										<?php echo '<h4>' .$News['News_Title']. '</h4>';
												echo news_comment_message($comment)?>
									</div>
								</li>
<?php
		}
	}
?>								
							</ul>
						</div>
<?php } ?>						
						
						<div class="sidebar">
							<div>
								<span><a href="#" class="selected">popular post</a></span> <span><a href="#">recent post</a></span>
							</div>
							<ul>
<?php if(!empty($list_news)) { foreach ($list_news as $News) { ?>
								<li>
									<a href="#"><?php echo $News['News_Title'] ?></a>
									<span><a href="#"><?php echo news_date($News) ?></a><?php echo news_details_form($News) ?></span>
								</li>
<?php } } ?>								
							</ul>
						</div>
					</div>
				</div>