<table class="bg_image" valign="top" width="778" align="center" border="0" cellpadding="0" cellspacing="0">
	
	<tbody>
		<tr>
			<td colspan="3" class="logo_panel" valign="top" align="center">
				<a href="<?php echo get_link('presentation','public') ?>">
					<img align="center" src="<?php echo $_url."Design/xakar/images/homepage/logo.gif" ?>" alt="Game World" title="Game World" width="713" border="0" height="69">
				</a>
			</td>
		</tr>
		<tr>
			<td rowspan="2" class="left_panel" valign="top" width="30%" align="left">
				<table valign="top" width="90%" border="0" cellpadding="0" cellspacing="0">
					<tbody>
						<tr>
							<td colspan="3" valign="top" align="left">
							<!--img src="<?php echo $_url."Design/xakar/images/homepage/best-feature-title.gif" ?>" alt="best-feature-title" title="best-feature-title" class="feature_heading" width="30%" height="26"-->
							<h3>Top 3</h3>
							</td>
						</tr>
				 
					<?php
						$Account_Query = list_db("top_list",array('top_members_limit' => 3));
				
						if(!empty($Account_Query))
						{
							foreach ( $Account_Query as $x => $Account )
							{
								$place = $x+1;
								$xp_purcent = ($Account['Account_Experience']/$Account['Level_Experience_Required'])*100;
						?>	
									<tr>
										<td colspan="2" class="game_heading" valign="top" width="114" align="left">
											<?php echo $Account['Account_Pseudo'].'['.stripslashes($Account['Order_Name']). ']' ?>
										</td>
										<td class="price" valign="top" align="left">
											<?php echo $place."(".stripslashes($Account['Account_Notoriety']).")" ?>
										</td>
									</tr>
									<tr>
										<td class="buy_link_panel" valign="top" width="39" align="left">
											<a href="#" onmouseover="buy1.src='<?php echo $_url."Design/xakar/images/homepage/buy-on.gif" ?>'" onmouseout="buy1.src='<?php echo $_url."Design/xakar/images/homepage/buy.gif" ?>'" title="buy">
												<?php echo '['.stripslashes($Account['Level_Number']). ']'.stripslashes($Account['Account_Experience']). '/'.stripslashes($Account['Level_Experience_Required']) ?>
											</a>
										</td>
										<td colspan="2" class="game_panel" valign="top" align="left">
											<img src="<?php echo get_avatar($Account)/**$Account['Account_Avatar']**/ ?>" width="110" height="84"/>
											<img class="buy1" alt="<?php echo (isConnected($Account)?'On' : 'Off') ?>" width="31" border="0" height="14" />
										</td>
									</tr>
										

						<?php	
							}	
						}
					?>
					</tbody>
				</table>
			</td>
			<td class="menu_panel" valign="top" width="30%" align="left">
				<ul class="menu">
					<li><a href="<?php echo get_link('presentation','public') ?>" ><!--onmouseover="home.src='images/home-on.gif'" onmouseout="home.src='images/home.gif'"-->
						Presentation
						<!--img src="<?php echo $_url."Design/xakar/images/homepage/home.gif" ?>" name="home" alt="Home" title="Home" width="43" border="0" height="14"-->
					</a></li>
				<?php foreach( $_menu_ as $slug => $title) { ?>
					<li><a href="<?php echo get_link($slug, 'Contenu')?>" ><!--onmouseover="aboutus.src='images/aboutus-on.gif'" onmouseout="aboutus.src='images/aboutus.gif'"-->
						<?php echo $title ?><!--img src="<?php echo $_url."Design/xakar/images/homepage/aboutus.gif" ?>" name="aboutus" alt="About us" title="About us" width="63" border="0" height="14"-->
					</a></li>
				<?php } ?>
				</ul>						
			</td>
			<td class="right_panel" valign="top" width="30%" align="left" >
				<table width="90%" border="0" cellpadding="0" cellspacing="0">
					<tbody class="more_panel" >
						<tr>
							<td colspan="2" valign="top" align="left">
								<img src="<?php echo $_url."Design/xakar/images/homepage/informations.gif" ?>" alt="Informations" class="information_heading" title="Informations" width="164" height="27">
							</td>
						</tr>
						<?php
							$list_news = list_db('limit_list_news',array('limit'=>2));
							if(!empty($list_news))
							{
								foreach ($list_news as $e => $News)
								{
									$pl = $e+1;
						?>
						 <tr>
							<td valign="top" width="58" align="left">
								<img src="<?php echo $_url."Design/xakar/images/homepage/no".$pl.".gif" ?>" alt="No1" class="no_padding" title="No1" width="52" height="38"></td>
							<td valign="top" align="left"><p class="information_text">
								<?php echo "News publiée le " . news_date($News). " Par " .$News['News_Account_Pseudo']. ""; ?><br/>
								<?php echo '' .news_message($News). ''?>
								</p>
							</td>
						</tr>
						<tr>
							<td colspan="2" valign="top" align="right"><?php echo news_details_form($News) ?><!--a href="#" title="more">more</a--></td>
						</tr>
						<?php
								}
							}
						?>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="footer_panel" valign="top" align="center">
				<p>Copyright@game world 2006 info goes here</p>
				<p class="power_link">Design by <a href="http://dpsoft.taobao.com/" title="alixixi.com" target="_blank">alixixi.com</a></p>				
			</td>
		</tr>
	</tbody>
</table>
							
			
<!--Protected by Encrypt HTML Pro, MTop, Software Inc.-->