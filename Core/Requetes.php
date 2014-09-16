<?php
	// General
	$sql['describe_t'] ="DESCRIBE [table] ;" ;
	$sql['list_t'] ="SELECT * FROM [table] ;" ;
	$sql['exclude_list_t'] ="SELECT * FROM [table] WHERE [ID] != [value];";
	$sql['order_list_t'] ="SELECT * FROM [table] ORDER BY [ordering] ASC" ;
	$sql['ref_list_t']  = "select * from [table] where [ID] in ([ref]) ORDER BY [ID] ASC;";
	$sql['foreign_val'] ="SELECT [ordering] FROM [table] where [ID]=[value] ORDER BY [ordering] ASC limit 1 ;";
	$sql['foreign_list'] ="SELECT * FROM [table] where [ID]=[value] ;";
	$sql['edit_admin'] = "SELECT * FROM [table] where [ID]=[value] limit 1";
	$sql['exists_t'] = "SHOW TABLES LIKE [table] " ;
	// Styles
	
	$sql['list_styles'] ='SELECT * FROM Caranille_Styles';

	// sanctions
	
	$sql['get_sanction_user'] = "SELECT * FROM Caranille_Sanctions WHERE Sanction_Receiver = [Account_ID] limit 1;";

	// level

	$sql['get_level_exp_req'] = "SELECT Level_Experience_Required FROM Caranille_Levels WHERE Level_Number = [Account_Level] limit 1";
	$sql['level_max'] ="SELECT * FROM Caranille_Levels order by Level_Number desc limit 1";
	
	// config
	$sql['get_config_key'] = "select * from Caranille_Configuration where Configuration_Name =[key] ORDER BY Configuration_Name limit 1";
	$sql['install_config'] = "SHOW TABLES LIKE 'Caranille_Configuration'" ;
	$sql['install_config'] = "select * from Caranille_Configuration where Configuration_Name = 'install-step' ORDER BY Configuration_Name limit 1 ;" ;
	$sql['layout_config'] = "SELECT * FROM Caranille_Configuration WHERE Configuration_Name IN('MMORPG_Access','MMORPG_Template','MMORPG_Name','MMORPG_Description','MMORPG_Presentation')ORDER BY Configuration_Name ASC;";
	$sql['image_config'] = "select * from Caranille_Configuration where Configuration_Name in ('avatar_maxsize','avatar_maxh','avatar_maxl') ORDER BY Configuration_Name ASC;" ;
	
	$sql['all_config'] = "select * from Caranille_Configuration where Configuration_Name not like 'curve-%' order by Configuration_Name;";
	
	$sql['config_curve'] = "select * from Caranille_Configuration where Configuration_Name like 'curve-%' order by Configuration_Name;";
	
	// plugins
	
	$sql['list_plugins']  = "select * from Caranille_Plugins where Plugin_Name in ([ref]);";

	// pages
	
	$sql['list_pages']  = "select * from Caranille_Pages where (Page_Guild_ID = 0 or Page_Guild_ID is null) order by Page_Order ;" ;
	
	// menus 
	
	$sql['list_menu']  = "select * from Caranille_Menus where Menu_Affiche = [Module] and Menu_Position = [position] order by Menu_Module , Menu_Position, Menu_Parent, Menu_Ordre";
	
	// News
	
	$sql['list_news'] = "SELECT * FROM Caranille_News WHERE News_Date LIKE [date] ORDER BY News_Date desc";
	$sql['limit_list_news'] = "SELECT * FROM Caranille_News ORDER BY News_Date desc limit 0,[limit]";
	$sql['request_news'] = "SELECT * FROM Caranille_News where News_ID = [News_ID] ORDER BY News_Date desc limit 1";
	$sql['list_comments'] = "SELECT * FROM Caranille_Comments where Comment_News_ID = [News_ID] ORDER BY Comment_ID desc";
	
	// newsreaders
	
	$sql['request_newsreader'] = "SELECT * FROM Caranille_Newsreaders WHERE Newsreader_Email= [Email] limit 1";
	$sql['valider_newsreader'] = "SELECT * FROM Caranille_Newsreaders WHERE Newsreader_Email= [Newsreader_Email] and Newsreader_Key = [Newsreader_Key] limit 1";

	// connected
	
	$sql['count_connected'] = "SELECT Account_ID AS Connected FROM Caranille_Accounts WHERE Account_Last_Connected > [timestamp] ORDER By Account_ID " ;
	$sql['is_connected'] = "SELECT Account_Last_Connected FROM Caranille_Accounts WHERE  Account_ID =[Account_ID] limit 1 ";	
	
	// user
	
	$sql['request_account'] = "SELECT * FROM Caranille_Accounts WHERE Account_Pseudo= [Pseudo] Limit 1"; // celle-ci est particulierement utilisé.
	$sql['count_account'] = "SELECT count(*) FROM Caranille_Accounts WHERE Account_Pseudo= [Pseudo] ORDER By Account_Pseudo ; ";
	$sql['valid_account'] = "SELECT * FROM Caranille_Accounts WHERE Account_Email=[Account_Email] and Account_Key = [Account_Key] limit 1";
	$sql['account_miroir'] = "SELECT * FROM Caranille_Accounts WHERE Account_Key = [Miroir] limit 1";
	
	$sql['list_account'] = "SELECT * FROM Caranille_Accounts ORDER BY Account_Pseudo ASC";
	
	$sql['list_account_friends'] = "SELECT a.* FROM Caranille_Accounts a
		left join Caranille_Friends df on a.Account_id = df.Friend_Request and df.Friend_Answer = [Account_ID]
		left join Caranille_Friends cf on a.Account_id = cf.Friend_Answer and cf.Friend_Request = [Account_ID]
		WHERE a.Account_Valid = 1 
		and (df.Friend_Answer is not null or cf.Friend_Request is not null)
		ORDER BY Account_Pseudo ASC";
	
	$sql['login_account'] = "SELECT a.Account_Pseudo , a.Account_Email , a.Account_Access, 
			a.Account_Last_Connection , a.Account_Last_Connected, a.Account_Last_IP , 
			a.Account_Status , a.Account_Reason, a.Account_ID
		FROM Caranille_Accounts a
		WHERE a.Account_Pseudo = [Pseudo] limit 1 " ;

	$sql['all_accounts'] = 'SELECT * FROM Caranille_Accounts';
	
	$sql['last_account'] = 'SELECT Account_Pseudo, Account_ID FROM Caranille_Accounts ORDER BY Account_ID DESC LIMIT 1';
	
	$sql['battle_account'] = "SELECT * FROM Caranille_Accounts a 
				left join Caranille_Levels l ON a.Account_Level = l.Level_Number 
				WHERE Account_ID= [Account_ID] limit 1";
		
	// avatar
	
	$sql['town_account'] = "SELECT p.Position_PosX,p.Position_PosY,a.Account_Pseudo 
		FROM Caranille_Position p
		left join Caranille_Accounts a on  a.Account_ID =p.Position_Account_ID
		WHERE Position_Town_ID = [Town_ID]; ";
	
	$sql['arround_account'] = "SELECT Account_PosX,Account_PosY,Account_Pseudo 
    FROM Caranille_Accounts 
    where (Account_PosX between [compteurX] and [finX]) 
    and (Account_PosY between [finY] and [compteurY] );	";
	
	$sql['account_work'] = "SELECT w.Work_Name,w.Work_Fabrique, c.Competence_Work_ID , c.Competence_Level,c.Competence_Experience, lu.Level_Experience_Required 
		from Caranille_Works w
		left join Caranille_Competences c on c.Competence_Work_ID = w.Work_ID 
		left join Caranille_Levels l ON c.Competence_Level = l.Level_Number 
		left join Caranille_Levels lu ON lu.Level_Number = (l.Level_Number+1)
		where c.Competence_Account_ID=[Account_ID]";
	
	$sql['account_work_competence'] = "SELECT w.Work_Name,w.Work_Fabrique, c.*
		from Caranille_Works w
		left join Caranille_Competences c on c.Competence_Work_ID = w.Work_ID 
		where c.Competence_Account_ID=[Account_ID] and c.Competence_Work_ID=[Work_ID] limit 1";
	
	$sql['coords_account'] = "SELECT Account_Pseudo FROM Caranille_Accounts WHERE Account_PosX=[newX] AND Account_PosY=[newY] limit 1 ";
	
	$sql['position_account'] = "SELECT * FROM Caranille_Position WHERE Position_Town_ID=[Town_ID] AND Position_Account_ID=[Account_ID] limit 1";
	
	$sql['perso_account'] = "SELECT
			a.Account_ID , a.Account_Pseudo , a.Account_Email , a.Account_Avatar, a.Account_Access , a.Account_Signature ,
			a.Account_Last_Connection , a.Account_Last_Connected, a.Account_Last_IP , a.Account_Sexe ,
			a.Account_Status , a.Account_Reason , 
			a.Account_PosX , a.Account_PosY ,
			a.Account_Roaster_ID , a.Account_Roaster_Accept , 
			a.Account_Guild_ID , a.Account_Guild_Accept , a.Account_Rank_ID , 
			a.Account_HP_Remaining , a.Account_HP_Bonus , 
			a.Account_MP_Remaining , a.Account_MP_Bonus , 
			a.Account_Strength_Bonus , a.Account_Magic_Bonus , a.Account_Agility_Bonus , a.Account_Defense_Bonus , 
			a.Account_Notoriety , a.Account_Golds , 
			a.Account_Experience , a.Account_Chapter , a.Account_Mission ,
			l.Level_ID, l.Level_Number, l.Level_HP, l.Level_MP, l.Level_Strength, l.Level_Magic, l.Level_Agility, l.Level_Defense , 
			o.Order_ID , o.Order_Name , o.Order_HP_Effect , o.Order_MP_Effect , o.Order_Strength_Effect , o.Order_Magic_Effect , 
			o.Order_Agility_Effect , o.Order_Defense_Effect ,
			r.Race_Name, c.Classe_Name ,
			lu.Level_Experience_Required 
		FROM Caranille_Accounts a
			left join Caranille_Levels l ON a.Account_Level = l.Level_Number
			left join Caranille_Orders o ON a.Account_Order = o.Order_ID
			left join Caranille_Races r ON a.Account_Race = r.Race_ID
			left join Caranille_Classes c ON a.Account_Classe = c.Classe_ID
			left join Caranille_Levels lu ON lu.Level_Number = (l.Level_Number+1)
		WHERE a.Account_Pseudo = [Pseudo] limit 1 " ;
		
	// diary
		
	$sql['diary_list'] = "SELECT * FROM Caranille_Diaries where Diary_Account_ID = [Account_ID] ORDER BY Diary_ID desc";
	$sql['public_diary_list'] = "SELECT * FROM Caranille_Diaries where Diary_Account_ID = [Account_ID] and Diary_Description !=''
	ORDER BY Diary_ID desc limit 0,5";

    // quest
    
	$sql['quest_log_list'] = "SELECT q.*,i.Inventory_Quest_Quantity,i.Inventory_Quest_Status FROM Caranille_Quests q
				inner join Caranille_Inventory_Quests i on q.Quest_Id = i.Inventory_Quest_Quest_ID
				where Inventory_Quest_Account_ID =[Account_ID] ;";
	
	// monster - dungeon
	
		$sql['request_monster'] =	"SELECT * FROM Caranille_Monsters  m
				left Join Caranille_Images img ON img.Image_ID = m.Monster_Image
				WHERE Monster_ID= [Monster_ID] limit 1";
	
    // monster - Story
    
	$sql['story_step_content'] = "SELECT * FROM Caranille_Monsters m
				left Join Caranille_Images img ON img.Image_ID = m.Monster_Image
				left Join Caranille_Chapters c ON c.Chapter_Monster = m.Monster_ID
				WHERE Chapter_Number = [Chapter_Number] limit 1; ";
	
	// monster - mission
	
	$sql['mission_content'] = 	"SELECT * FROM Caranille_Monsters m
				left Join Caranille_Images img ON img.Image_ID = m.Monster_Image
				left join Caranille_Missions mi ON Mission_Monster = Monster_ID
				WHERE Mission_ID = [Mission_ID]
				";
				
	// inbox
	
	$sql['request_mailbox'] = "SELECT * FROM Caranille_Private_Messages m, Caranille_Accounts a
			WHERE m.Private_Message_Receiver = [Account_Pseudo] AND  m.Private_Message_Receiver = a.Account_Pseudo
			AND a.Account_ID = [Account_ID] order by Private_Message_ID desc ";
	$sql['request_mail'] = "SELECT * FROM Caranille_Accounts WHERE Account_ID = [Private_Message_Transmitter] limit 1";

	$sql['count_mailbox'] = "SELECT * FROM Caranille_Private_Messages, Caranille_Accounts 
    	WHERE Private_Message_Receiver = [Pseudo]
    	AND Account_ID = [Account_ID] ";
	
	// races
	
	$sql['list_races'] = "SELECT * FROM Caranille_Races ";
	
	// works
	
	$sql['list_works'] = "SELECT * FROM Caranille_Works ";
	$sql['fabrique_works'] = "SELECT * FROM Caranille_Works where Work_Fabrique = [Type] limit 1";
	
	// Classe
	
	$sql['list_classes'] = "SELECT * FROM Caranille_Classes";
	
	// ordres
	
	$sql['list_ordres'] = "SELECT * FROM Caranille_Orders WHERE Order_ID != 1";
	$sql['request_ordre'] = "SELECT * FROM Caranille_Orders WHERE Order_ID = [Order_ID] limit 1";
	
	// roaster
	
	$sql['list_roaster'] =  "select * 
		from Caranille_Accounts a
			left join Caranille_Orders o on o.Order_ID = a.Account_Order
			left join Caranille_Levels l on l.Level_ID = a.Account_Level
			left join Caranille_Roaster r on r.Roaster_ID = a.Account_Roaster_ID
		where Account_Roaster_ID = [Roaster_ID] 
			and Account_Roaster_Accept = 1
			and Account_Last_Connected < [timeout] 
			and Account_ID !=[Account_ID] 
			limit 0,[limit] ";
	
	$sql['recruted_roaster'] =  "select * 
		from Caranille_Accounts a
		left join Caranille_Orders o on o.Order_ID = a.Account_Order
		left join Caranille_Levels l on l.Level_ID = a.Account_Level
		where Account_Roaster_ID = [Account_Roaster_ID] 
		and Account_Roaster_ID != 0
		and Account_ID !=[Account_ID] 
		limit 0,[limit] ;";
	
    $sql['recruted_roaster'] = "select * 
			from Caranille_Accounts a
			left join Caranille_Orders o on o.Order_ID = a.Account_Order
			left join Caranille_Levels l on l.Level_ID = a.Account_Level
			where Account_Roaster_Accept = 1 
			and Account_Roaster_ID = 0
			and Account_Last_Connected < [timeout] 
			and Account_ID !=[Account_ID] 
			";
			
			// Top
	
	$sql['active_account'] = "SELECT l.Level_Number, a.Account_Experience, a.Account_Notoriety, a.Account_ID, a.Account_Pseudo
				FROM Caranille_Accounts a
		 left join Caranille_Orders	o ON a.Account_Order = o.Order_ID
		 left join Caranille_Levels	l ON a.Account_Level = l.Level_Number
			WHERE a.Account_Valid= 1 AND a.Account_ID != [Account_ID]
				ORDER BY Account_Pseudo" ;
	
	$sql['top_list'] = "SELECT l.Level_Number, lu.Level_Experience_Required, a.Account_Experience, a.Account_Notoriety, o.Order_Name, a.Account_Pseudo, a.Account_ID
		FROM Caranille_Accounts a
		 left join Caranille_Orders	o ON a.Account_Order = o.Order_ID
		 left join Caranille_Levels	l ON a.Account_Level = l.Level_Number
		 left join Caranille_Levels	lu ON lu.Level_Number = (l.Level_Number+1)
		 WHERE Account_Valid = 1
		ORDER BY a.Account_Level DESC , a.Account_Experience DESC , a.Account_Notoriety DESC
		LIMIT 0, [top_members_limit] ;" ;
		
	// inventaire
	
	$sql['item_inventaire'] = "SELECT * FROM Caranille_Inventory inv
			left join Caranille_Items it on it.Item_ID = inv.Inventory_Item_ID
			WHERE it.Item_ID = [Item_ID]
			AND inv.Inventory_ID = [Inventory_ID]
			AND inv.Inventory_Account_ID = [Account_ID] limit 1";
			
	$sql['item_inventaire_qte'] = "SELECT * FROM Caranille_Inventory WHERE Inventory_Item_ID= [Item_ID] AND Inventory_Account_ID= [Account_ID] limit 1";
	$sql['ressource_inventaire_qte'] = "SELECT * FROM Caranille_Inventory_Ressources WHERE Inventory_Ressource_ID= [Ressource_ID] AND Inventory_Account_ID= [Account_ID] limit 1";

	$sql['request_has_item'] = "SELECT * FROM Caranille_Inventory, Caranille_Items 
					WHERE Item_Name = [Item_Choice] 
					AND Inventory_Item_ID = Item_ID
					AND Inventory_Account_ID = [ID]
					ORDER BY Item_Name ASC
					limit 1";
					
	$sql['list_equipement'] = "SELECT inv.Inventory_ID,inv.Inventory_Item_ID, it.* FROM Caranille_Items it 
		left join Caranille_Inventory inv ON inv.Inventory_Item_ID = it.Item_ID
		left join Caranille_Accounts a  ON inv.Inventory_Account_ID = a.Account_ID
    	WHERE inv.Inventory_Item_Equipped='Yes' AND a.Account_Pseudo= [Pseudo] ;" ;
	
	$sql['item_quest_inventaire'] = "SELECT * FROM Caranille_Inventory 
			WHERE Inventory_Item_ID = [Quest_Item] 
			AND Inventory_Account_ID = [Account_ID] 
			limit 1 ";
	
	// quests
	
	$sql['request_quest'] = "SELECT * FROM Caranille_Quests WHERE Quest_ID = [Quest_ID] limit 1 " ;
	
	$sql['is_requested_quest'] ="SELECT * FROM Caranille_Inventory_Quests 
      				WHERE Inventory_Quest_Quest_ID = [Quest_ID]
      				AND Inventory_Quest_Account_ID = [Account_ID] 
      				limit 1;";
	
	$sql['is_incomplete_requested_quest'] ="SELECT * FROM Caranille_Inventory_Quests 
      				WHERE Inventory_Quest_Quest_ID = [Quest_ID]
      				AND Inventory_Quest_Status ='incomplete'
      				AND Inventory_Quest_Account_ID = [Account_ID] 
					limit 1;";
	
	// Battlegrounds
	
	$sql['list_battleground'] = "SELECT l.Level_Number, lu.Level_Experience_Required, a.Account_Experience, a.Account_Notoriety, a.Account_ID, a.Account_Pseudo
				FROM Caranille_Accounts a
		 left join Caranille_Orders	o ON a.Account_Order = o.Order_ID
		 left join Caranille_Levels	l ON a.Account_Level = l.Level_Number
		 left join Caranille_Levels	lu ON lu.Level_Number = (l.Level_Number+1)
			WHERE ( a.Account_Order != 1 AND a.Account_Order != [Account_Order] )
				ORDER BY Account_Pseudo" ;

	// dungeon
	
	$sql['monster_dungeon'] = "SELECT * FROM Caranille_Monsters m
				left Join Caranille_Images img ON img.Image_ID = m.Monster_Image
				WHERE m.Monster_Town = [ville_actuel] AND m.Monster_Access = 'Dungeon' ";
				
	// chapters
	
	$sql['list_chapter'] = "SELECT * FROM Caranille_Chapters";
	$sql['chapter_account'] = "SELECT * FROM Caranille_Chapters WHERE Chapter_Number = [Chapter_Number] limit 1";
		
	//
	
	$sql['mission_account'] = "SELECT * FROM Caranille_Missions WHERE Mission_Number= [Player_Mission_Level] AND Mission_Town= [Town] limit 1";

	// item
	
	$sql['list_item'] = "SELECT * FROM Caranille_Items";
	$sql['request_item'] = "SELECT * From Caranille_Items WHERE Item_ID = [Item_ID] limit 1";
	
	
	// items - battle
	$sql['list_my_items'] =	"SELECT * FROM Caranille_Inventory, Caranille_Items
						WHERE Inventory_Item_ID = Items_ID
						AND Item_Type in ([type_list])
						AND Inventory_Account_ID = [ID]
						ORDER BY Item_Type,Item_Name ASC";
	
	
	// invocation
	
	$sql['list_invocation'] = "SELECT * FROM Caranille_Invocations";
	$sql['request_invocation'] = "SELECT * From Caranille_Invocations WHERE Invocation_ID = [Invocation_ID] limit 1";
	
	// invocation - battle
	
	$sql['list_my_chimerea'] =	"SELECT * FROM Caranille_Inventory_Invocations, Caranille_Invocations 
            						WHERE Inventory_Invocation_Invocation_ID = Invocation_ID
            						AND Inventory_Invocation_Account_ID = [ID]
            						ORDER BY Invocation_Name ASC";
	
		// magic
	
	$sql['list_magic'] = "SELECT * FROM Caranille_Magics";
	$sql['request_magic'] = "SELECT * From Caranille_Magics WHERE Magic_ID = [Magic_ID] limit 1";
	
	// magic - battle
	$sql['list_my_magic'] =	"SELECT * FROM Caranille_Inventory_Magics, Caranille_Magics 
            					WHERE Inventory_Magic_Magic_ID = Magic_ID
            					AND Inventory_Magic_Account_ID = [ID]
            					ORDER BY Magic_Name ASC";
	
	//ressources
	
	$sql['request_ressource'] = "SELECT * From Caranille_Ressources WHERE Ressource_ID = [Ressource_ID] limit 1";
	$sql['random_ressource']="select * from Caranille_Ressources where Ressource_Fabrique = [Type] Order by RAND() limit [Limit]";
	$sql['fabrique_ressource']="select * from Caranille_Ressources where Ressource_Fabrique = [Type] ";
	
	
	// town
	$sql['list_town'] = "SELECT * FROM Caranille_Towns";
	
	$sql['arround_town']  = "SELECT * 
							FROM Caranille_Towns t
							left Join Caranille_Images img ON img.Image_ID = t.Town_Image
							WHERE Town_Chapter <= [Account_Chapter]
							and (Town_PosX between [compteurX] and [finX]) 
							and (Town_PosY between [finY] and [compteurY]);      ";
							
	$sql['request_town'] = "SELECT * 
						FROM Caranille_Towns t
						left Join Caranille_Images img ON img.Image_ID = t.Town_Image
						WHERE Town_ID= [Town_ID] Limit 1 ;" ;
	// landing 

	$sql['arround_landing']  = "SELECT * 
 	FROM Caranille_Landings t
	WHERE (Landing_PosX between [compteurX] and [finX]) 
    and (Landing_PosY between [finY] and [compteurY]);      ";
	
	$sql['list_town_landing'] = "SELECT * 
		FROM Caranille_Towns t
		left Join Caranille_Images img ON img.Image_ID = t.Town_Image
		WHERE (Town_PosX between [compteurX] and [finX]) 
		and (Town_PosY between [finY] and [compteurY] );      ";
	
	// building
	
	$sql['town_building']  ="select * from Caranille_Building where Building_Town_ID = [Town_ID] order by Building_Town_ID ";
	
	//monsters
	$sql['list_monster_access']= "SELECT * FROM Caranille_Monsters WHERE Monster_Access = [Monster_Access] order by Monster_ID";
	
	//Chatroom
	
	$sql['public_chatroom']="SELECT * FROM Caranille_Chat c
		inner join Caranille_Accounts a ON c.Chat_Pseudo_ID = a.Account_ID
		where (Chat_Guild_ID = '0' or Chat_Guild_ID is null)
		ORDER BY c.Chat_Message_ID DESC
		LIMIT 0, 10";
	
	$sql['guild_chatroom']="SELECT * FROM Caranille_Chat c
		inner join Caranille_Accounts a ON c.Chat_Pseudo_ID = a.Account_ID
		where Chat_Guild_ID = [Guild_ID]
		ORDER BY c.Chat_Message_ID DESC
		LIMIT 0, 10";	
	
	
	$sql['random_fragment']="";
	$sql['random_item']="";
	
	// inventaire 
	
	$sql['list_inventaire_type']="SELECT * FROM Caranille_Inventory inv 
			left join Caranille_Items i ON inv.Inventory_Item_ID = i.Item_ID
			left Join Caranille_Images img ON img.Image_ID = i.Item_Image
			WHERE Item_Type IN ([type]) AND Inventory_Account_ID = [Account_ID] ORDER BY Item_Name";
			
	$sql['list_inventaire_magic']="SELECT m.* FROM Caranille_Magics m
			inner join Caranille_Inventory_Magics i on i.Inventory_Magic_Magic_ID = m.Magic_ID
			left Join Caranille_Images img ON img.Image_ID = m.Magic_Image
			where i.Inventory_Magic_Account_ID = [Account_ID] ORDER BY Magic_Name";
			
	$sql['list_inventaire_chimere']="SELECT * FROM Caranille_Inventory_Invocations inve 
			left join Caranille_Invocations i ON inve.Inventory_Invocation_Invocation_ID = i.Invocation_ID
			left Join Caranille_Images img ON img.Image_ID = i.Invocation_Image
			WHERE inve.Inventory_Invocation_Account_ID = [Account_ID]
			ORDER BY Invocation_Name";
			
	$sql['list_inventaire_fragment']="SELECT * FROM Caranille_Inventory_Fragments inv 
			left join Caranille_Fragments i ON inv.Inventory_Fragment_ID = i.Fragment_ID
			left Join Caranille_Images img ON img.Image_ID = i.Fragment_Image_ID
			WHERE Inventory_Account_ID = [Account_ID] ORDER BY Fragment_Name";
	
	$sql['list_inventaire_ressource']="SELECT * FROM Caranille_Inventory_Ressources inv 
			left join Caranille_Ressources i ON inv.Inventory_Ressource_ID = i.Ressource_ID
			left Join Caranille_Images img ON img.Image_ID = i.Ressource_Image_ID
			WHERE Inventory_Account_ID = [Account_ID] ORDER BY Ressource_Name";
			
	// Shop
	
    $sql['shop_request_item'] = "SELECT * 
				FROM Caranille_Items i 
				left Join Caranille_Images img ON img.Image_ID = i.Item_Image
				WHERE i.Item_Type in ([type_list])
				AND i.Item_Town = [town] ";
	
	$sql['shop_request_invocation'] =  "SELECT * 
		        FROM Caranille_Invocations i
				left Join Caranille_Images img ON img.Image_ID = i.Invocation_Image
		        WHERE Invocation_Town =  [town] ";
		
	$sql['shop_request_magic'] =  "SELECT * 
		        FROM Caranille_Magics m
				left Join Caranille_Images img ON img.Image_ID = m.Magic_Image
	        	WHERE Magic_Town =  [town] ";
	
	// craft
	
	$sql['craftable_list'] = "SELECT * FROM Caranille_Inventory_Fragments inv 
			left join Caranille_Fragments i ON inv.Inventory_Fragment_ID = i.Fragment_ID
			left Join Caranille_Images img ON img.Image_ID = i.Fragment_Image_ID
			WHERE inv.Inventory_Account_ID = [Account_ID]
			AND i.Fragment_Item_type = [Item_type]
			ORDER BY Fragment_Name";
			
			//-- left join Caranille_Craftings c on c.Crafting_Fragment_ID = i.Fragment_ID AND c.Crafting_Item_ID 
			
/***
	
	// battle 
	
	$sql['ennemy_mission'] = "SELECT * FROM Caranille_Missions WHERE Mission_Number= [Player_Mission_Level] AND Mission_Town= [Town] limit 1";
	$sql['ennemy_arena'] = "SELECT * FROM Caranille_Accounts a left join Caranille_Levels l ON a.Account_Level = l.Level_Number WHERE Account_ID= [Account_ID] limit 1 ";
	$sql['ennemy_monster'] = "SELECT * FROM Caranille_Monsters  m left Join Caranille_Images img ON img.Image_ID = m.Monster_Image WHERE Monster_ID= [Monster_ID] limit 1";
	$sql['ennemy_chapter'] = "SELECT * FROM Caranille_Monsters m
				left Join Caranille_Images img ON img.Image_ID = m.Monster_Image
				left Join Caranille_Chapters c ON c.Chapter_Monster = m.Monster_ID
				WHERE Chapter_Number = [Chapter_Number] limit 1;";
			
**/

	// forum
	
	$sql['forum_main'] = "SELECT Cat_ID, Cat_nom, 
f.Forum_ID, Forum_Name, Forum_Desc, count(distinct cp.Post_ID) as Forum_Post, count(distinct ct.Topic_ID) as Forum_Topic, Auth_View, t.Topic_ID, 
 count( distinct rp.Post_ID) as Topic_Post, t.Topic_Locked, max(p.Post_ID) as Post_ID , max(p.Post_Time) as Post_Time, a.Account_Pseudo, 
a.Account_ID 
FROM Caranille_Categories c
LEFT JOIN Caranille_Forums f ON c.Cat_ID = f.Forum_Cat_ID
LEFT JOIN Caranille_Posts p ON p.Post_Forum_ID = f.Forum_ID 
LEFT JOIN Caranille_Topics t ON t.Topic_ID = p.Post_Topic_ID
LEFT JOIN Caranille_Accounts a ON a.Account_ID = p.Post_Createur
LEFT JOIN Caranille_Posts cp ON cp.Post_Forum_ID = f.Forum_ID
LEFT JOIN Caranille_Topics ct ON ct.Topic_Forum_ID = f.Forum_ID
LEFT JOIN Caranille_Posts rp ON rp.Post_Topic_ID = t.Topic_ID
WHERE c.Cat_Guild_ID = 0
AND f.Forum_Guild_ID = 0
group by c.Cat_ID , f.Forum_ID
ORDER BY Cat_Ordre, Forum_Ordre DESC";
	
	$sql['request_forum'] =  "SELECT Forum_Name, count(Topic_ID) as Forum_Topic, Auth_View, Auth_Topic 
FROM Caranille_Forums f
left join Caranille_Topics t on t.Topic_Forum_ID = f.Forum_ID
WHERE Forum_ID = [forum] limit 1;";
	
	$sql['request_forum_topic'] = "SELECT t.Topic_ID, Topic_Titre, Topic_Createur, Topic_Vu, Topic_Time, Topic_Genre,
		count(distinct cp.Post_ID) as Topic_Post,  max(mp.Post_ID) as Topic_Last_Post, max(mp.Post_Time) as Post_Time , 
		Ma.Account_Pseudo AS Account_Pseudo_Last_Posteur,
		Mb.Account_Pseudo AS Account_Pseudo_Createur, p.Post_Createur, p.Post_ID 
		FROM Caranille_Topics t
		LEFT JOIN Caranille_Accounts Mb ON Mb.Account_ID = t.Topic_Createur
		LEFT JOIN Caranille_Posts p ON p.Post_Topic_ID = t.Topic_ID
		LEFT JOIN Caranille_Posts cp ON cp.Post_Topic_ID = t.Topic_ID
		LEFT JOIN Caranille_Posts mp ON mp.Post_Topic_ID = t.Topic_ID
		LEFT JOIN Caranille_Accounts Ma ON Ma.Account_ID = mp.Post_Createur    
		WHERE t.Topic_Forum_ID = [forum]
		group by t.Topic_ID
		ORDER BY Topic_Genre ASC, Topic_Last_Post DESC";
	
	$sql['request_topic'] = "SELECT Topic_Titre, count(cp.Post_ID) as Topic_Post, f.Forum_ID, max(mp.Post_ID) as Topic_Last_Post,
		Forum_Name, Auth_View, Auth_Topic, Auth_Post , Topic_Vu
		FROM Caranille_Topics t 
		LEFT JOIN Caranille_Forums f ON t.Topic_Forum_ID = f.Forum_ID 
		LEFT JOIN Caranille_Posts mp ON t.Topic_ID = mp.Post_Topic_ID 
		LEFT JOIN Caranille_Posts cp ON t.Topic_ID = cp.Post_Topic_ID 
		WHERE Topic_ID = [topic] limit 1; ";

	$sql['request_topic_post'] = "SELECT p.Post_ID , p.Post_Createur , p.Post_Texte , p.Post_Time ,
		Account_ID, Account_Pseudo,  Account_Avatar, Account_Inscription, count(up.Post_ID) as Account_Post, Account_Signature
		FROM Caranille_Posts p
		LEFT JOIN Caranille_Accounts a ON a.Account_ID = p.Post_Createur
		LEFT JOIN Caranille_Posts up ON a.Account_ID = up.Post_Createur
		WHERE p.Post_Topic_ID =[topic]
		group by Account_ID, Post_ID
		ORDER BY p.Post_ID
		LIMIT [premierMessageAafficher], [nombreDeMessagesParPage] ; ";

	$sql['all_posts']= 'SELECT * FROM Caranille_Posts'; // tous les posts des forums y compris ceux de guildes....

	// guild
	
	$sql['list_guild'] = "SELECT * FROM Caranille_Guilds ORDER BY Guild_Name ASC";
	
	$sql['request_guild'] = "SELECT 
				g.*,
				sum(a.Account_Golds) as fortune,
				l.Level_ID, l.Level_Number, l.Level_HP, l.Level_MP, l.Level_Strength, l.Level_Magic, l.Level_Agility, l.Level_Defense, 
				lu.Level_Experience_Required 
			FROM  Caranille_Guilds g 
				left join Caranille_Accounts a ON a.Account_Guild_ID = g.Guild_ID
				left join Caranille_Levels	l ON g.Guild_Level = l.Level_Number
				left join Caranille_Levels	lu ON lu.Level_Number = (l.Level_Number+1)
			WHERE g.Guild_ID=[Account_Guild_ID] limit 1 ";
			
	$sql['members_guild'] = "select Account_Pseudo,Account_ID from Caranille_Accounts where Account_Guild_ID  = [Account_Guild_ID] order by  Account_ID";
						
	$sql['access_guild'] = "select * from Caranille_Privileges where Privilege_Rank_ID =[Account_Rank_ID] and Privilege_Access =[privilege] limit 1;";

	$sql['list_guild_pages']  = "select * from Caranille_Pages where (Page_Guild_ID = [Guild_ID] ) order by Page_Order ;" ;
	
	$sql['list_membre_guild'] = "SELECT l.Level_Number, a.Account_Experience, a.Account_Notoriety, o.Order_Name, a.Account_Pseudo, a.Account_ID
		FROM Caranille_Accounts a
		 left join Caranille_Orders	o ON a.Account_Order = o.Order_ID
		 left join Caranille_Levels	l ON a.Account_Level = l.Level_Number
		 left join Caranille_Guilds	g ON a.Account_Guild_ID = g.Guild_ID
		 where ((a.Account_Guild_ID =[Guild_ID] and a.Account_Guild_Accept = 1) or g.Guild_Owner_ID = a.Account_ID)
		ORDER BY a.Account_Level, a.Account_Experience DESC
		";

		// event 
		
		$sql['request_event'] = "SELECT * FROM Caranille_Events ev where Event_Date like [date] and Event_Guild_ID = [guild] limit 1";
		$sql['list_event'] = "SELECT * FROM Caranille_Events ev where Event_Date like [date] and Event_Guild_ID = [guild] ";

    // privilege guild
    
	$sql['guild_list_rank'] = "select * from Caranille_Rank where Rank_Guild_ID = [Guild_ID] order by Rank_Order desc, Rank_ID desc;";
    $sql['has_privilege'] =	"select * from Caranille_Privileges where Privilege_Rank_ID =[Rank_ID] and Privilege_Access =[Access] limit 1;";

    // candidat guilde
    
    $sql['candidat_guild'] ="SELECT l.Level_Number, a.Account_Experience, a.Account_Notoriety, o.Order_Name, a.Account_Pseudo, a.Account_ID
				FROM Caranille_Accounts a
				 left join Caranille_Orders	o ON a.Account_Order = o.Order_ID
				 left join Caranille_Levels	l ON a.Account_Level = l.Level_Number
				 left join Caranille_Guilds	g ON a.Account_Guild_ID = g.Guild_ID
				 where(a.Account_Guild_ID =[Guild_ID] and a.Account_Guild_Accept = 0 and g.Guild_Owner_ID != a.Account_ID ) 
				ORDER BY a.Account_Level, a.Account_Experience DESC
				";
				
	$sql['candidat_guild_confirm']= "SELECT a.Account_ID, a.Account_Pseudo
						FROM Caranille_Accounts a
						 left join Caranille_Orders	o ON a.Account_Order = o.Order_ID
						 left join Caranille_Levels	l ON a.Account_Level = l.Level_Number
						 left join Caranille_Guilds	g ON a.Account_Guild_ID = g.Guild_ID
						where(a.Account_Guild_ID = [Guild_ID]
						 and a.Account_Guild_Accept = 0 
						 and a.Account_ID = [Account_ID] 
						 and g.Guild_Owner_ID != a.Account_ID ) 
						ORDER BY a.Account_Level, a.Account_Experience DESC
						limit 1";

// forum guild

$sql['request_guild_forum'] = "SELECT Cat_ID, Cat_nom, 
                                f.Forum_ID, Forum_Name, Forum_Desc, count(distinct cp.Post_ID) as Forum_Post, count(distinct ct.Topic_ID) as Forum_Topic, Auth_view, t.Topic_ID,  
                                 count( distinct rp.Post_ID) as Topic_Post, t.Topic_Locked, max(p.Post_ID) as Post_ID , max(p.Post_time) as Post_time, a.Account_Pseudo, 
                                a.Account_ID 
                                FROM Caranille_Categories c
                                LEFT JOIN Caranille_Forums f ON c.Cat_ID = f.Forum_Cat_ID
                                LEFT JOIN Caranille_Posts p ON p.Post_Forum_ID = f.Forum_ID 
                                LEFT JOIN Caranille_Topics t ON t.Topic_ID = p.Post_Topic_ID
                                LEFT JOIN Caranille_Accounts a ON a.Account_ID = p.Post_Createur
                                LEFT JOIN Caranille_Posts cp ON cp.Post_Forum_ID = f.Forum_ID
                                LEFT JOIN Caranille_Topics ct ON ct.Topic_Forum_ID = f.Forum_ID
                                LEFT JOIN Caranille_Posts rp ON rp.Post_Topic_ID = t.Topic_ID
                                	left join Caranille_Guilds g on c.Cat_Guild_ID = g.Guild_ID
                                WHERE Cat_Guild_ID = [Guild_ID]
                                group by c.Cat_ID, f.Forum_ID
                                ORDER BY Cat_ordre, Forum_ordre DESC";

//WHERE Auth_view = '".user_data("Account_Access")."'
//-- p.Post_ID = f.Forum_Last_Post_ID
//Cette requête permet d'obtenir tout sur le forum

$sql['request_guild_get_forum'] = "SELECT Forum_Name, count(Topic_ID) as Forum_Topic, Auth_view, Auth_Topic 
                            			FROM Caranille_Forums f
                            			left join Caranille_Topics t on t.Topic_Forum_ID = f.Forum_ID
                            			left join Caranille_Guilds g on t.Topic_Guild_ID = g.Guild_ID
                            			WHERE Forum_ID = [forum]
                            			and Topic_Guild_ID = [Guild_ID]
                            			limit 1;" ;
			
$sql['request_guild_forum_topic']= "SELECT t.topic_ID, topic_titre, topic_createur, Topic_Vu, topic_time, topic_genre,
                                        count(distinct cp.Post_ID) as topic_Post,  max(mp.Post_ID) as topic_last_Post, max(mp.post_time) as post_time , 
                                        Ma.Account_pseudo AS Account_pseudo_last_Posteur,
                                        Mb.Account_pseudo AS Account_pseudo_createur, p.post_createur, p.Post_ID 
                                        FROM Caranille_Topics t
                                        LEFT JOIN Caranille_Accounts Mb ON Mb.Account_ID = t.topic_createur
                                        LEFT JOIN Caranille_Posts p ON p.Post_Topic_ID = t.Topic_ID
                                        LEFT JOIN Caranille_Posts cp ON cp.Post_Topic_ID = t.topic_ID
                                        LEFT JOIN Caranille_Posts mp ON mp.Post_Topic_ID = t.topic_ID
                                        LEFT JOIN Caranille_Accounts Ma ON Ma.Account_ID = mp.post_createur    
                                        	left join Caranille_Guilds g on t.Topic_Guild_ID = g.Guild_ID
                                        WHERE t.Topic_Forum_ID = [forum]
                                        	and Topic_Guild_ID = [Guild_ID]
                                        group by t.topic_ID
                                        ORDER BY topic_genre ASC, topic_last_Post DESC";

$sql['request_guild_topic'] = "SELECT Topic_Titre, count(cp.Post_ID) as Topic_Post, f.Forum_ID, max(mp.Post_ID) as topic_last_Post,
                                Forum_Name, Auth_view, Auth_Topic, Auth_Post , Topic_Vu
                                FROM Caranille_Topics t 
                                LEFT JOIN Caranille_forums f ON t.Topic_Forum_ID = f.Forum_ID 
                                LEFT JOIN Caranille_Posts mp ON t.Topic_ID = mp.Post_Topic_ID 
                                LEFT JOIN Caranille_Posts cp ON t.Topic_ID = cp.Post_Topic_ID 
                                	left join Caranille_Guilds g on f.Forum_Guild_ID = g.Guild_ID
                                WHERE topic_ID = [topic]
                                	and Topic_Guild_ID = [Guild_ID]
                                limit 1; ";


$sql['request_guild_topic_post'] = "SELECT p.Post_ID , p.Post_Createur , p.Post_texte , p.Post_Time ,
                                        Account_ID, Account_pseudo,  Account_Avatar, Account_Inscription, count(up.Post_ID) as Account_Post, Account_Signature
                                        FROM Caranille_Posts p
                                        LEFT JOIN Caranille_Accounts a ON a.Account_ID = p.Post_Createur
                                        LEFT JOIN Caranille_Posts up ON a.Account_ID = up.Post_Createur
                                        	left join Caranille_Guilds g on p.Post_Guild_ID = g.Guild_ID
                                        WHERE p.Post_Topic_ID =[Topic_ID]
                                        	and p.Post_Guild_ID = [Guild_ID]
                                        group by Account_ID, Post_ID
                                        ORDER BY p.Post_ID
                                        LIMIT [premierMessageAafficher], [nombreDeMessagesParPage] ; ";

	// forum profil
	
	$sql['account_forum'] = "SELECT a.*,g.*, o.*,
                                count(p.Post_ID) as Account_Post 
                               FROM Caranille_Accounts a 
                        	   left join Caranille_Posts p on p.Post_Createur = a.Account_ID
                        	   left join Caranille_guilds g on g.Guild_ID = a.Account_Guild_ID
                        	   left join Caranille_Orders o on o.Order_ID = a.Account_Order
                        	   WHERE a.Account_ID=[membre] 
                        	   group by Account_ID
                        	   limit 1" ;
	
// forum guild post

$sql['get_request_post_topic_guild'] = "SELECT f.Forum_ID, Auth_Modo
                                        	FROM Caranille_Topics t
                                        	LEFT JOIN Caranille_Forums f ON t.Topic_Forum_ID = f.Forum_ID
                                        	left join Caranille_Guilds g on t.Topic_Guild_ID = g.Guild_ID
                                        	WHERE Topic_ID=[Topic_ID] 
                                        	and Topic_Guild_ID = [Guild_ID] 
                                        	limit 1;";

$sql['get_request_post_forum_guild'] = "SELECT Forum_Name, Auth_view, Auth_Topic,Auth_annonce 
                                    		FROM Caranille_Forums WHERE Forum_ID = [Forum_ID]
                                    		and Forum_Guild_ID = [Guild_ID] 
                                    		limit 1;";
		
$sql['get_request_post_post_guild'] = "SELECT Post_Createur, Post_Time, Post_Topic_ID, Auth_modo, Forum_ID
                                		FROM Caranille_Posts p
                                		LEFT JOIN Caranille_forums f ON p.Post_Forum_ID = f.Forum_ID
                                		left join Caranille_Guilds g on p.Post_Guild_ID = g.Guild_ID
                                		WHERE Post_ID=[Post_ID] 
                                		and Post_Guild_ID = [Guild_ID] 
                                		limit 1; ";