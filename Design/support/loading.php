<?php
	//echo "page :: $page<br/>";
	
	$array_game_secteur = array('Game','Guild','Map','Shop','Battle','User');
	$array_iden_secteur = array('Register','User');
	
	$array_game_page = array('chat','craft','guild','character','order','inventory','map','town','world','questlogs','questboard','diary','weapon','accessory','item','Magic_shop','Temple');			
	$array_iden_page = array('login','logout','register');			
	$array_news_page = array('comments');
	$array_forum_page = array('forum','post','poster','topic', 'main');
	
	$already_call_menu_character = true ;
	$already_call_menu_town = true ;
	$already_call_menu_guild = true ;
	$already_call_menu_profil = true ;
	
	if($secteur_module !== 'Admin' && $secteur_module !=='Moderator')
	{
		if(isset($page) && $page !='')
		{
			if(in_array($page,$array_game_page) && in_array($secteur_module,$array_game_secteur) )
			{
				include_once($_path."Sources/Map/Modules/Index.php");
				include_once(path_module( (verif_town() ? 'Town' : 'World' ),'Map'));
				
				load_css('map.css','map');
				load_css('boussole.css','boussole');
				load_css('infobulle.css','infobulle');
			}
			
			if(in_array($page,$array_news_page) && $secteur_module === 'Public')
			{
				include_once($_path."Sources/Public/Modules/news-Index.php");
			}
		}
		
		if($page =='blog')
		{
			include_once(path_module("Main","Public"));
		}
		
		// if($page == 'logout')
			// header(get_link('Main','Public'));
	}
	
	//echo "page :: $page<br/>";