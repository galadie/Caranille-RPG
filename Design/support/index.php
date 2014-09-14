<head>
<title><?php echo $MMORPG_Name ?> - <?php if(isset($title)) echo $title ?></title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<meta name="robots" content="index, follow, archive, all" />
		
		<meta http-equiv="Content-Language" content="fr-FR" />

		<meta name="description" content="éditeur de MMORPG en PHP. <?php echo (isset($description) ? $description : "") ?>" />
		<meta name="keywords" content="<?php echo (isset($keywords) ? $keywords : "") ?>" />
		<meta name="language" content="fr-FR" />
		<meta name="Indentifier-URL" content="<?php echo $_url ?>"> 
		<?php echo $link_js ?>
							<?php echo $link_css ?>
	<link rel="stylesheet" href="<?php echo get_design('style.css') ?>" type="text/css">

</head>
<body>
	<div id="background">
		<div id="header">
			<div>
				<div>
					<a href="<?php echo get_link() ?>" class="logo"><img src="<?php echo $_url."Design/support/images/logo.png" ?>" alt=""></a>
					<ul>
						<li class="<?php echo($page == '' ? 'selected' : '')?>">
							<a href="<?php echo get_link() ?>" id="menu1">home</a>
						</li>
						
						<li>
							<a href="<?php echo get_link('Main', 'Forum') ?>" id="menu2">Forum</a>
						</li>
						
<?php if(verif_connect(true)) { ?>
						
						<li class="<?php echo (in_array($page,$array_game_page) ? 'selected' : '') ?>" >
							<a href="<?php echo get_link('Character', 'Game') ?>" id="menu3">games</a>
						</li>
<?php } else { ?>
						<li class="<?php echo (in_array($page,$array_iden_page) ? 'selected' : '') ?>" >
							<a href="<?php echo get_link('user') ?>" id="menu3">games</a>
						</li>
<?php } ?>						
						<li class="<?php echo($page =='about' ? 'selected' : '')?>">
							<a href="<?php echo get_link('about') ?>" id="menu4">about</a>
						</li>
						<li>
							<a href="<?php echo get_link('blog') ?>" id="menu5">blog</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div id="body">
			<div>
				<div>
					<?php menu_profil();
							/** lecture content **/ 
						
						if($secteur_module == 'Admin' || $secteur_module =='Moderator')
						{
							include_once('admin.php');
						}
						else
						{
							if(isset($page) && $page !='')
							{
								if(in_array($secteur_module,$array_iden_secteur))
								{
									include_once($content);
								}
							elseif(in_array($page,$array_game_page) && in_array($secteur_module,$array_game_secteur) )
								{
									include_once('game.php');
								}
							elseif(in_array($page,$array_iden_page) && $secteur_module === 'User')
								{
									include_once('user.php');
								}
							elseif(in_array($page,$array_news_page) && $secteur_module === 'Public')
								{
									include_once('blog.php');
								}
							elseif(in_array($page,$array_forum_page ) && $secteur_module === 'Forum')
								{
									include_once($content);
								}
							elseif($secteur_module == 'Battle' )
								{
									include_once('battle.php');
								}
							else//if(file_exists($page.'.php'))
								{
									include_once(strtolower($page).'.php');
								}
							}
							else
							{
								include_once('main.php');
							}
						}					
					?>
				</div>
				<?php //echo $secteur_module."-".$page ; //getenv('HTTP_HOST').getenv('REQUEST_URI'); ?>
			</div>
		</div>
		<div id="footer">
			<div>
				<ul>
					<li id="facebook">
						<a href="http://freewebsitetemplates.com/go/facebook/">facebook</a>
					</li>
					<li id="twitter">
						<a href="http://freewebsitetemplates.com/go/twitter/">twitter</a>
					</li>
					<li id="googleplus">
						<a href="http://freewebsitetemplates.com/go/googleplus/">googleplus</a>
					</li>
				</ul>
				<p>
					@ copyright 2012. all rights reserved.
				</p>
			</div>
		</div>
	</div>