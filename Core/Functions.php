<?php

if(!function_exists('count_connect'))
{
	function count_connect()
	{
		global $connect_marge ;
		//On définit à quoi correspond être "en ligne". 
		//Ici j'ai mis que tout membres ayant actualisé la page de jeu endéant 5 min est connecté.
		$Marge = time() - $connect_marge;
		
		$d = date("Y-m-d H:i:s", $Marge);
		
		//On compte maintenant le nombre de membres qui ont actualisé selon la marge.
		$Query = count_db('count_connected',array('timestamp' => $d ));

		//On affiche le résultat :
		echo "<div id='count_connected'>".LanguageValidation::iMsg('count.connect',$Query)."</div>";

	}
}

if(!function_exists('count_message'))
{
	/*
     * Vérification du nombre de message privé de l'utilisateur
     */
	function count_message()
	{
		global $Total_Private_Message , $already_count_message ;
		
		if(!$already_count_message)
		{
			$Total_Private_Message = count_db('count_mailbox',array("Pseudo" => logged_data('Account_Pseudo'), 'Account_ID' => logged_data('Account_ID') ) );
			$already_count_message = true ;
		}
		
    	return $Total_Private_Message;
	}
}

if(!function_exists('updateConnected'))
{
	function updateConnected()
	{
		user_set("Account_Last_Connected",date("Y-m-d H:i:s"));
		user_record();
	}
}

if(!function_exists('isConnected'))
{
	function isConnected($joueur)
	{
		global $connect_marge ;
		//On définit à quoi correspond être "en ligne". 
		//Ici tout membres ayant actualisé la page de jeu endéant 5 min est connecté.
		$Marge = time() - $connect_marge;
			
		//On compte maintenant si le membre est actualisé selon la marge.
		//Le champ qui correspond a la dernière actualisation s'appelle "Account_Last_Connected".
		$Query = get_db('is_connected',$joueur);

		$last = strtotime($Query['Account_Last_Connected']);
		
		return ( $last > $Marge ? true : false ) ;
	}
}

if(!function_exists('verif_town'))
{
	/** 
	 * verifie si l'utilisateur est dans une ville et affiche le menu ou refuse et interromp
	 * 
	 */
	function verif_town($menu=true)
	{
		global $path ;
		
		if(isset($_SESSION['Town']))
		{
			if (intval($_SESSION['Town']) == 1)
			{
				return true;
			}
		}
		
		if(!$menu)
		{
			echo "Vous n'êtes dans aucune ville";
			echo LanguageValidation::iMsg('not.in.town');
			//require_once($path."HTML/Footer.php");
			die();
		}
		
		return false ;
	}
}

if(!function_exists('verif_guild'))
{
	/** 
	 * verifie si l'utilisateur est dans une ville et affiche le menu ou refuse et interromp
	 * 
	 */
	function verif_guild($menu=true)
	{
		global $guild_min_members , $guild_min_golds ;
		
		// si la guile à moins de X membres, elle n'a acces à aucune fonction
		if(count(guild_data('membres')) >= $guild_min_members)
		{					
			$total_po = guild_data('fortune')+guild_data('Guild_Golds');
			
			// si la guile et ses membres a au total moins de X Golds, elle n'a acces à aucune fonction
			//if(guild_data('fortune')>=$guild_min_golds || guild_data('Guild_Golds')>=$guild_min_golds)
			if( $total_po >= $guild_min_golds )
			{   
				return true;
			}
			else
			{
				if(!$menu)
				{
					echo "Vous n'avez pas le budget suffisant pour activer la guilde<br/>";
					echo guild_data('fortune')."/$guild_min_golds de fortune personnelles<br/>";
					echo guild_data('Guild_Golds')."/$guild_min_golds en coffre de guilde<br/>";
					echo "$total_po/$guild_min_golds de fortune total<br/>";
				}
			}					
		}
		else
		{
			if(!$menu)
			{
				echo "Vous n'etes pas en nombre suffisant pour activer la guilde.<br/>" ;
				echo count(guild_data('membres'))."/$guild_min_members membres<br/>";
			}
		}
		
		if(!$menu)
		{
			//echo "Vous n'êtes dans aucune ville";
			//require_once($path."HTML/Footer.php");
			die();
		}
	}
}

if(!function_exists('_menu'))
{
	/** 
	 * fonction recursive pour l'arbo des liens 
	 */
	function _menu($Module,$position,$menus=array())
	{
		$ms = list_db('list_menu',array('Module' => $Module, 'position' =>$position ));
				
		foreach($ms as $m)
		{
			extract($m);
			
			if($Menu_Type == "Rubrique")
				if(!isset($menus[$Menu_ID]))
					$menus[$Menu_ID] = array("Label" =>  $Menu_Label , "Links"=> array());
					
			if($Menu_Type == "Lien")
			{
				//echo " Menu_Type : $Menu_Type - Menu_Parent : $Menu_Parent <br/>" ;
				
				if($Menu_Parent!= 0 )
					$menus[$Menu_Parent]["Links"][$Menu_Label] = array($Menu_Link , $Menu_Module) ;
				else	
					$menus["Direct_Links"][$Menu_Label] = array($Menu_Link , $Menu_Module) ;
				
			}
		}
		
		return $menus ;
	}
}

if(!function_exists('menu_arena'))
{
	function menu_arena()
	{
		global $top_members_limit;
		//"Top ".$top_members_limit. Champs de Batailles
		echo "
		<div class='city-menu'>
			<a href='".get_Link('Top','User')."'>".LanguageValidation::nMsg('menu.top.number',$top_members_limit)."</a> ".LanguageValidation::eMsg('menu.top.number',$top_members_limit)."-
			<a href='".get_Link('Battlegrounds','Battle')."'>".LanguageValidation::nMsg('menu.battle.ground')."</a> ".LanguageValidation::eMsg('menu.battle.ground')."
		</div>";
	}
}

if(!function_exists('menu_character'))
{
	function menu_character()
	{
		global $already_call_menu_character;
		// Avatar - Coffre - Atelier - Ordre - Journal - Quetes
		if(!$already_call_menu_character)
		{
			echo "
			<div class='city-menu'>
				<a href='". get_Link('Character','Game')."'>".LanguageValidation::nMsg('menu.character')."</a>".LanguageValidation::eMsg('menu.character')."-
				<a href='". get_Link('Inventory','Game')."'>".LanguageValidation::nMsg('menu.inventory')."</a>".LanguageValidation::eMsg('menu.inventory')."-
				<a href='". get_Link('Order','Game')."'>".LanguageValidation::nMsg('menu.order')."</a>".LanguageValidation::eMsg('menu.order')."- 
				<a href='". get_Link('Diary','Game')."'>".LanguageValidation::nMsg('menu.diary')."</a>".LanguageValidation::eMsg('menu.diary')."-
				<a href='". get_link('QuestLogs','Game') ."'>".LanguageValidation::nMsg('menu.questlog')."</a>".LanguageValidation::eMsg('menu.questlog')."<br />
				<a href='". get_link('Job','Game') ."'>".LanguageValidation::nMsg('menu.job')."</a>".LanguageValidation::eMsg('menu.job')."<br />
			</div>";
			$already_call_menu_character = true;
		}
	}
}

if(!function_exists('menu_town'))
{
	function menu_town()
	{
		global $already_call_menu_town;
		//Donjon - Missions - Quetes - Forgeron - Armurier - Zigourat - Bazar - Temple - Auberge
		if(!$already_call_menu_town)
		{
			echo '<div class="city-menu">
					<a href="'.get_link('Dungeon','Battle').'">'.LanguageValidation::nMsg('menu.dungeon').'</a>'.LanguageValidation::eMsg('menu.dungeon').'|
					<a href="'.get_link('Mission','Battle').'">'.LanguageValidation::nMsg('menu.mission').'</a>'.LanguageValidation::eMsg('menu.mission').'|
					<a href="'.get_link('QuestBoard','Game').'">'.LanguageValidation::nMsg('menu.questboard').'</a>'.LanguageValidation::eMsg('menu.questboard').'|
					<a href="'.get_link('Weapon','Shop').'">'.LanguageValidation::nMsg('menu.weapon').'</a>'.LanguageValidation::eMsg('menu.weapon').'|
					<a href="'.get_link('Accessory','Shop').'">'.LanguageValidation::nMsg('menu.Accessory').'</a>'.LanguageValidation::eMsg('menu.Accessory').'|
					<a href="'.get_link('Magic','Shop').'">'.LanguageValidation::nMsg('menu.magic').'</a>'.LanguageValidation::eMsg('menu.magic').'|
					<a href="'.get_link('Item','Shop').'">'.LanguageValidation::nMsg('menu.item').'</a>'.LanguageValidation::eMsg('menu.item').'|
					<a href="'.get_link('Temple','Shop').'">'.LanguageValidation::nMsg('menu.temple').'</a>'.LanguageValidation::eMsg('menu.temple').'|
			    	<a href="'. get_link('Craft','Game') .'">'.LanguageValidation::nMsg('menu.craft').'</a>'.LanguageValidation::eMsg('menu.craft').'|
					<a href="'.get_link('Inn','Map').'">'.LanguageValidation::nMsg('menu.inn').'</a>'.LanguageValidation::eMsg('menu.inn').'
				</div>
				';
			$already_call_menu_town = true;
		}
	}
}

if(!function_exists('menu_guild'))
{
	function menu_guild()
	{
		global $already_call_menu_guild;
		
		// Guilde - Offrande - Forum - Membres - Chat - Message - Grades - Recrutement - 
		if(!$already_call_menu_guild)
		{
			echo "
			<div class='city-menu'>
				<a href='". get_Link('Guild','Guild')."'>".LanguageValidation::nMsg('menu.guild')."</a>".LanguageValidation::eMsg('menu.guild')." -
				<a href='". get_Link('Gift','Guild')."'>".LanguageValidation::nMsg('menu.gift')."</a>".LanguageValidation::eMsg('menu.gift')." -";
			
			if(verif_guild(true))
			{
				echo "
					<a href='". get_Link('Main','Guild')."'>".LanguageValidation::nMsg('menu.forum')."</a>".LanguageValidation::eMsg('menu.forum')." -
					<a href='". get_Link('Membres','Guild')."'>".LanguageValidation::nMsg('menu.members')."</a>".LanguageValidation::eMsg('menu.members')." -
					<!--<a href='". get_Link('Chat','Guild')."'>".LanguageValidation::nMsg('menu.chat')."</a>".LanguageValidation::eMsg('menu.chat')." -->
				";
				
				if(has_guild_acces('message'))
					echo "<a href='". get_Link('Message','Guild')."'>".LanguageValidation::nMsg('menu.message')."</a>".LanguageValidation::eMsg('menu.message')." -";
				
				if(has_guild_acces('rank'))
					echo "<a href='". get_Link('Rank','Guild')."'>".LanguageValidation::nMsg('menu.rank')."</a>".LanguageValidation::eMsg('menu.rank')." -";
			
				if(has_guild_acces('recrutement'))
					echo "<a href='". get_Link('Recrutement','Guild')."'>".LanguageValidation::nMsg('menu.recrutement')."</a>".LanguageValidation::eMsg('menu.recrutement')." -";
			}	
			echo "</div>";
			$already_call_menu_guild = true ;
		}
	}
}

if(!function_exists('menu_profil'))
{
	function menu_profil()
	{
		global $already_call_menu_profil;
		
		if(!$already_call_menu_profil)
		{
			echo "<div class='city-menu'>";
			if(verif_connect(true)) 
			{
				echo '<a href="'.get_Link('Profil','User').'">'.LanguageValidation::nMsg('menu.profil').'</a>'.LanguageValidation::eMsg('menu.profil').' - ' ; 
				if (verif_access("Modo",true) )
				{
					echo '<a href="'.get_Link('Main','Moderator').'">'.LanguageValidation::nMsg('menu.moderator').'</a>'.LanguageValidation::eMsg('menu.moderator').' - ' ; 
				}
				if (verif_access("Admin",true))
				{
					echo '<a href="'.get_Link('Main','Admin').'">'.LanguageValidation::nMsg('menu.admin').'</a>'.LanguageValidation::eMsg('menu.admin').' - ' ; 
					echo '<a href="'.get_Link().'?setMessageEditionMode=ok">'.LanguageValidation::nMsg('menu.edition').'</a>'.LanguageValidation::eMsg('menu.edition').' - ' ; 
				}
				echo '<a href="'.get_Link('Logout','User').'">'.LanguageValidation::nMsg('menu.logout').'</a>'.LanguageValidation::eMsg('menu.logout').' - ' ; 		
			} 
			echo "</div>";
			$already_call_menu_profil = true ;
		}
	}
}

if(!function_exists('verif_battle'))
{
	/** 
	 * verifie si l'utilisateur est dans une bataille 
	 *
	 */
	function verif_battle($menu = false)
	{
		global $path;
		
		if(isset($_SESSION['Battle']))
		{
			if ($_SESSION['Battle'] == 1)
			{
				return true ;
			}
			if(!$menu)
			{
				echo "Vous n'êtes dans aucun affrontement";
				require_once($path."HTML/Footer.php");
				die();
			}
		}
		return false ;
	}
}

if(!function_exists('clear_battle'))
{
	/*** 
	 * fonction qui vide la session des combat 
	 * voire à supprimer Global.php
	 */
	function clear_battle()
	{
		global $array_battle_type ;
		
		if (!verif_battle(true)) // le joueur n'est pas dans un combat
			 foreach($array_battle_type as $b_type)
				$_SESSION[$b_type.'_Battle'] = 0 ;
	}
}

if(!function_exists('has_guild'))
{
	function has_guild()
	{		
		global $Guild_Data ;
		
		$candidat = intval(user_data("Account_Guild_Accept"))===0 ? true : false ;
		
		$_gm  = $Guild_Data['Guild_Owner_ID'] === logged_data("Account_ID") ? true : false ;
		
		if(intval(user_data("Account_Guild_ID"))!==0)
			if(!$candidat || $_gm)
				if(!empty($Guild_Data))
					if(!is_null($Guild_Data))
						return true ;
					
		return false ;
	}
}

if(!function_exists('postul_guild'))
{
	function postul_guild()
	{		
		global $Guild_Data ;
		
		$candidat = intval(user_data("Account_Guild_Accept"))===0 ? true : false ;
		
		$_gm  = $Guild_Data['Guild_Owner_ID'] === logged_data("Account_ID") ? true : false ;

		if(intval(user_data("Account_Guild_ID"))!==0)
			if($candidat && !$_gm)
				if(!empty($Guild_Data))
					if(!is_null($Guild_Data))
						return true ;
					
		return false ;
	}
}

if(!function_exists('get_Guild'))
{
	/**
	 * Première fonction que j'ai faite en suivant ce que Dimitri m'apprend :p
	 */
	function get_Guild()
	{	
		global $Guild_Data, $Account_Data ;
		
		if(empty($Account_Data))
			get_perso(logged_data('Account_Pseudo'));
		
		//if(has_guild())
		if(intval(user_data("Account_Guild_ID"))!==0)
		{
			$Guild_Data = get_db('request_guild',array(
			    'Account_Guild_ID'=>user_data('Account_Guild_ID')
			    ));
			
			if(!empty($Guild_Data))
			{															
				$membres = list_db('members_guild',array(
				    'Account_Guild_ID'=>user_data('Account_Guild_ID')
				    ));
						
				if(!empty($membres))
					$Guild_Data['membres']= stripslashes_r($membres);	
			}
		}
	}
}

if(!function_exists('guild_has'))
{
	/**
	 * retourne si une valeur de la guilde existe
	 */
	function guild_has($data="Guild_ID")
	{
		global $Guild_Data ;
		
		if(empty($Guild_Data))
			get_Guild();
		
		if(has_guild())
			if(isset($Guild_Data[$data]))
					return true ;
				
		return false ;
	}
}

if(!function_exists('guild_data'))
{
	/**
	 * retourne les valeurs de la guilde
	 */
	function guild_data($data="Guild_ID")
	{
		global $Guild_Data ;
		
		if(empty($Guild_Data))
			get_Guild();
		
		if(has_guild())
			if(isset($Guild_Data[$data]))
				if(!empty($Guild_Data))
					return $Guild_Data[$data];
				
		return false ;
	}
}

if(!function_exists('has_guild_acces'))
{
	function has_guild_acces($privilege)
	{
		global $Guild_Data ;
		
		if(empty($Guild_Data))
			get_Guild();

		if(guild_data('Guild_Owner_ID') == user_data('Account_ID'))
			return true ;
			
		$r = get_db('access_guild', array('Account_Rank_ID' => user_data('Account_Rank_ID'), 'privilege' =>$privilege ));
		
		if(isset($r))
			return true;
			
		return false;

	}
}

if(!function_exists('has_order'))
{
	function has_order()
	{
		if(user_has('Order_ID'))
		{
			if(user_data('Order_ID') == 0)
			{
				return false ;
			}
			else
			if(user_data('Order_ID') == 1)
			{
				return false ;
			}
			else
			if(user_data('Order_ID') > 1)
			{
				return true ;
			}
			else
			{
				return false ;
			}
		}
		
		return false; 
	}
}

if(!function_exists('init_equipement_session'))
{
	/** 
	 * fonction qui initialise par defaut l'equipement du personnage à 0 
	 * 
	 */
	function init_equipement_session()
	{
		global $array_accessory_type , $array_character_type ;
		// Si l'utilisateur en cours a acces à la plateforme
		if(verif_auth())
		{
			foreach($array_accessory_type as $k => $type)
			{
				$obj = !is_array($type) ? $type : $k ;
					
				if (empty($Stuff_Data[$obj.'_Inventory_ID']))
				{
					$Stuff_Data[$obj]['Inventory_ID'] = 0;
					$Stuff_Data[$obj]['ID'] = 0;
					$Stuff_Data[$obj]['Name'] = "Aucune";
					
					foreach($array_character_type as $char)
						$Stuff_Data[$obj]['effect'][$char] = 0;
				}
			}
			
			if (empty($Stuff_Data["Weapon"]['Inventory_ID']))
			{
				$Stuff_Data["Weapon"]['Inventory_ID'] = 0;
				$Stuff_Data["Weapon"]['ID'] = 0;
				$Stuff_Data["Weapon"]['Name'] = "Aucune";
				$Stuff_Data["Weapon"]['type'] = "Aucune";
				
				foreach($array_character_type as $char)
					$Stuff_Data["Weapon"]['effect'][$char] = 0;
			}
		}
	}
}

if(!function_exists('init_stat_session'))
{
	/** 
	 * fonction qui initialise par defaut les stats(value/max) du personnage par la somme 
	 * de la valeur de base + bonus
	 * des effets d'equipement
	 */
	function init_stat_session()
	{
		global $Account_Data , $Stats_Data,  $Stuff_Data , $array_character_type, $array_accessory_type, $array_weapon_type ;
		
		foreach( $array_character_type as $car)
		{
			debug_log("user_data(level_$car) => ".user_data('Level_'.$car));
			
			$base = user_data('Level_'.$car) + user_data('Account_'.$car.'_Bonus') + guild_data('Level_'.$car);
			$Stats_Data[$car.'_Total'] = $base ;
			
			if(isset($Stuff_Data["Weapon"]['effect'][$car]))
			{
				foreach( $array_weapon_type as $k => $acc)
					if($Stuff_Data["Weapon"]['type'] == $acc)
						$Stats_Data[$car.'_Total'] += $Stuff_Data["Weapon"]['effect'][$car];			
			}	
			
			foreach( $array_accessory_type as $k => $acc)
			{
				if(!is_array($acc))
				{
					if(isset($Stuff_Data[$acc]['effect'][$car]))
						$Stats_Data[$car.'_Total'] += $Stuff_Data[$acc]['effect'][$car];
				}
			}
		
			unset($base);
		}
	}
}

if(!function_exists('get_equipement'))
{
	/** 
	 * retrouve l'equipement du joueur
	 * utilisé dans refresh.php
	 * utilisé dans login.php
	 */
	function get_equipement($Pseudo)
	{	
		if(verif_auth())
		{		
			init_equipement_session();
						
			$equip = list_db('list_equipement',array('Pseudo'=>$Pseudo)); 
			
			if(!empty($equip))
			{
				foreach($equip as $piece)
				{
					cast_equipement($piece);
				}		
			}
		}
	}
}

if(!function_exists('cast_equipement'))
{
	/** 
	 * retrouve l'equipement du joueur
	 * utilisé dans refresh.php
	 * utilisé dans login.php
	 * utilisé dans inventory.php (equip_item)
	 */
	function cast_equipement($equipment)
	{
		global $array_character_type, $array_weapon_type , $Stuff_Data ;
		
		if(isset($equipment) && !empty($equipment))
		{
			if(isset($equipment['Item_Type']))
			{
				$type = in_array($equipment['Item_Type'],$array_weapon_type) ? "Weapon" : $equipment['Item_Type'];
				
				$Stuff_Data[$type]['Inventory_ID'] = stripslashes($equipment['Inventory_ID']);
				$Stuff_Data[$type]['ID'] = stripslashes($equipment['Inventory_Item_ID']);
				$Stuff_Data[$type]['Name'] = stripslashes($equipment['Item_Name']);
				
				if(in_array($equipment['Item_Type'],$array_weapon_type))
					$Stuff_Data[$type]['type'] = stripslashes($equipment['Item_Type']);
				
				foreach($array_character_type as $char)
					if(isset($equipment['Item_'.$char.'_Effect']))
						$Stuff_Data[$type]['effect'][$char] = stripslashes($equipment['Item_'.$char.'_Effect']);
					
			}
		}
	}
}

function retire_equipement($type)
{
	global $Stuff_Data ;
	
	if(isEquiped($type) )
	{
		update_db('Caranille_Inventory',array(
			'Inventory_ID'=> $Stuff_Data[$type]['Inventory_ID'], 
			'Inventory_Item_ID'=> $Stuff_Data[$type]['ID'] ,
			'Inventory_Item_Equipped'=> 'No' 
		));
		
		$Stuff_Data[$type]['ID'] = 0;
		$Stuff_Data[$type]['Name'] = 'Aucun(e)';
		$Stuff_Data[$type]['Level_Required'] = 0;
		$Stuff_Data[$type]['Quantity'] = 0;
		$Stuff_Data[$type]['Sale_Price'] = 0;
		
	}
}

if(!function_exists('isEquiped'))
{
	function isEquiped($piece='None')
	{
		global $array_accessory_type ,$array_weapon_type , $Stuff_Data ;
		
		if(in_array($piece,$array_accessory_type))
			if(isset($Stuff_Data[$piece]['ID']))
				if($Stuff_Data[$piece]['ID']!==0)
					return true;

		//if(in_array($piece,$array_weapon_type))
		if($piece==="Weapon")
			foreach($array_weapon_type as $pi)
				if(isset($Stuff_Data['Weapon']['ID']))
					if($Stuff_Data['Weapon']['ID']!==0)
						if($Stuff_Data['Weapon']['type']==$pi)
							return true;
					
		return false;
	}
}

if(!function_exists('isArmed'))
{
	function isArmed()
	{
		global $array_weapon_type , $Stuff_Data ;
		
		if(isset($Stuff_Data["Weapon"]['ID']))
			if($Stuff_Data["Weapon"]['ID']!==0)
				foreach($array_weapon_type as $pi)
					if($Stuff_Data["Weapon"]['type']==$pi)
						return true;
					
		return false;
	}
}

if(!function_exists('type_weapon'))
{
	function type_weapon()
	{
		global $array_weapon_type , $Stuff_Data ;

		if(isset($Stuff_Data["Weapon"]['ID']))
			if($Stuff_Data["Weapon"]['ID']!==0)
				foreach($array_weapon_type as $pi)
					if($Stuff_Data["Weapon"]['type']==$pi)
						return htmlspecialchars(addslashes($pi));
	}
}

if(!function_exists('get_weapon'))
{
	function get_weapon($champs="")
	{
		global $array_weapon_type , $Stuff_Data ;
		
		if(isset($Stuff_Data["Weapon"]['ID']))
			if($Stuff_Data["Weapon"]['ID']!==0)
				foreach($array_weapon_type as $pi)
					if($Stuff_Data["Weapon"]['type']==$pi)
						return htmlspecialchars(addslashes($Stuff_Data["Weapon"][$champs]));

	}
}

if(!function_exists('equipement'))
{
	function equipement($piece='None')
	{
		global $array_weapon_type , $Stuff_Data ;
				
		if(in_array($piece,$array_weapon_type))	
			if(isArmed())
				return get_weapon('Name');
				
		if(isEquiped($piece))
			return htmlspecialchars(addslashes($Stuff_Data[$piece]['Name']));

		return 'Aucun(e)';
	}
}

if(!function_exists('get_arme_ocedar'))
{
	function get_arme_ocedar()
	{
		global $already_call_arme_ocedar ;
		
		if(!$already_call_arme_ocedar)
		{
			if(isArmed())
			{
				//echo "armé ::".isArmed().'<br/>type ::'.type_weapon().'<br/>nom ::'.get_weapon('Name');
		?>
				 <div id="arme" class="<?php echo ( isArmed() ? 'equiped '.type_weapon() :'' )?>" title="Arme : <?php echo get_weapon('Name')?>">
					<div id="garde" class="manche">&nbsp;</div>
					<div id="garde" class="garde">&nbsp;</div>
					<div id= "lame" class="lame">&nbsp;</div>
				 </div>
		<?php
			}
			
			$already_call_arme_ocedar = true ;
		}
	}

}

if(!function_exists('get_ocedar'))
{
	function get_ocedar()
	{
		global $already_call_ocedar ;
		
		if(!$already_call_ocedar)
		{		
		?>
		<table id="corps" class="<?php echo user_data('Account_Sexe')?> account" align="center" valign="middle" >
			<tr>
				<td></td>
				<td colspan="2">
					<div id="tete" class="<?php echo ( isEquiped("Helmet") ? 'equiped' :'' )?>" title="Casque : <?php echo equipement('Helmet')?>" >
						<div id="visage">
						&bullet;&nbsp;&nbsp;&nbsp;&nbsp;&bullet;<br/>
						&nbsp;&dharl;&nbsp;&dharr;&nbsp;<br/>
						&nbsp;&smile;&nbsp;
						</div>
					</div>
				</td>
				<td></td>
				<td rowspan="10"><?php get_arme_ocedar() ?></td>
			</tr>
			
			<tr>
				<td ></td>
				<td colspan="2" ><div id="neck" class=""></div></td>
			</tr>

			<tr>
				<td class="epaule" ><div class=" Droit <?php echo ( isEquiped("Armor") ? 'equiped' :'' )?>" title="Protection : <?php echo equipement('Armor')?>"></div></td>
				<td colspan="2" ><div id="buste" class="<?php echo ( isEquiped("Armor") ? 'equiped' :'' )?>" title="Protection : <?php echo equipement('Armor')?>"></div></td>
				<td class="epaule" ><div class=" Gauche <?php echo ( isEquiped("Armor") ? 'equiped' :'' )?>" title="Protection : <?php echo equipement('Armor')?>"></div></td>
			</tr>
			
			<tr valign='top' >
				<td rowspan="2"><div class="bras Droit" ></div></td>
				<td colspan="2" ><div id="poitrine" class="<?php echo ( isEquiped("Armor") ? 'equiped' :'' )?>" ></div></td>
				<td rowspan="2" ><div class="bras Gauche" ></div></td>
			</tr>
			
			<tr valign='top' >
				<td colspan="2" ><div id="abdomen" class="<?php echo ( isEquiped("Armor") ? 'equiped' :'' )?>" ></div></td>
			</tr>
			
			<tr valign='top'>
				<td rowspan="2">
					<div class="avant bras Droit <?php echo ( isEquiped("Gloves") ? 'equiped' :'' )?>" title="Gants: <?php echo equipement('Gloves')?>"></div>
					<div class="poing Droit"></div>
				</td>
				<td colspan="2"><div id="ceinture" class="<?php echo ( isEquiped("Pants") ? 'equiped' :'' )?>" title="Pantalons : <?php echo equipement('Pants')?>" ></div></td>
				<td rowspan="2">
					<div class="avant bras Gauche <?php echo ( isEquiped("Gloves") ? 'equiped' :'' )?>" title="Gants : <?php echo equipement('Gloves')?>"></div>
					<div class="poing Gauche"></div>
				</td>
			</tr>
			<tr >
				<td ><div id="cuisse-droite" class="cuisse Droit <?php echo ( isEquiped("Pants") ? 'equiped' :'' )?>" title="Pantalons : <?php echo equipement('Pants')?>" ></div></td>
				<td ><div id="cuisse-gauche" class="cuisse Gauche <?php echo ( isEquiped("Pants") ? 'equiped' :'' )?>" title="Pantalons : <?php echo equipement('Pants')?>" ></div></td>
			</tr>
			<tr >
				<td ></td>
				<td><div class="jambes Droit <?php echo ( isEquiped("Boots") ? 'equiped' :'' )?>" title="Bottes : <?php echo equipement('Boots')?>"></div></td>
				<td><div class="jambes Gauche <?php echo ( isEquiped("Boots") ? 'equiped' :'' )?>" title="Bottes : <?php echo equipement('Boots')?>"></div></td>
				<td></td>
			</tr>
			<tr >
				<td colspan="2"><div class="pieds Droit <?php echo ( isEquiped("Boots") ? 'equiped' :'' )?>" title="Bottes : <?php echo equipement('Boots')?>"></div></td>
				<td colspan="2"><div class="pieds Gauche <?php echo ( isEquiped("Boots") ? 'equiped' :'' )?>" title="Bottes : <?php echo equipement('Boots')?>"></div></td>
			</tr>
		</table>
		<?php
			$already_call_ocedar = true ;
		}
	}

}

if(!function_exists('get_arena_ocedar'))
{
	function get_arena_ocedar()
	{
?>
        <table id="corps" class="homme arena" align="center" valign="middle" >
			<tr>
				<td rowspan="10"><div id="arme"></div></td>
				<td></td>
				<td colspan="2"><div id="tete" ><div id="visage">
					&bullet;&nbsp;&nbsp;&nbsp;&nbsp;&bullet;<br/>
						&nbsp;&dharl;&nbsp;&dharr;&nbsp;<br/>
							&nbsp;&smile;&nbsp;				
				</div></div></td>
				<td></td>
			</tr>
			<tr>
				<td ></td>
				<td colspan="2" ><div id="neck" ></div></td>
			</tr>
			<tr>
				<td class="epaule" ><div class="Droit" ></div></td>
				<td colspan="2" ><div id="buste" ></div></td>
				<td class="epaule"><div class="Gauche" ></div></td>
			</tr>
			<tr valign='top' >
				<td rowspan="2"><div class="bras Droit" ></div></td>
				<td colspan="2" ><div id="poitrine" ></div></td>
				<td rowspan="2" ><div class="bras Gauche" ></div></td>
			</tr>
			<tr valign='top' >
				<td colspan="2" ><div id="abdomen" ></div></td>
			</tr>
			<tr valign='top'>
				<td rowspan="2"><div class="avant bras Droit" ></div></td>
				<td colspan="2"><div id="ceinture" class="" ></div></td>
				<td rowspan="2"><div class="avant bras Gauche" ></div></td>
			</tr>
			<tr >
				<td><div id="cuisse-droite" class="cuisse Droit" ></div></td>
				<td><div id="cuisse-gauche" class="cuisse Gauche" ></div></td>
			</tr>
			<tr >
				<td></td>
				<td><div class="jambes Droit" ></div></td>
				<td><div class="jambes Gauche" ></div></td>
			</tr>
			<tr >
				<td colspan="2"><div class="pieds Droit" ></div></td>
				<td colspan="2"><div class="pieds Gauche" ></div></td>
			</tr>
		</table>
<?php
	}
}

if(!function_exists('get_perso_card'))
{
	function get_perso_card()
	{
		global $already_call_perso_card , $installing , $secteur_module , $Next_Level , $array_character_stats ;
		
		if(!$already_call_perso_card)
		{	
			if(!$installing)
			{ 
				if(verif_connect(true) && ($secteur_module !== 'Admin' && $secteur_module !== 'Moderator' && $secteur_module !== 'Forum' ))
				{
					if (isset($Next_Level))
					{ 
						$hp_purcent = (user_data('Account_HP_Remaining')/perso_data('HP_Total') )*100;
						$mp_purcent = (user_data('Account_MP_Remaining')/perso_data('MP_Total') )*100;
						$xp_purcent = (user_data('Account_Experience')/user_data('Level_Experience_Required'))*100;
?>
			<div class="important"><?php echo LanguageValidation::iMsg("label.pseudo.card") ?> :</div> <?php echo user_data('Account_Pseudo'); ?> <br />
			<div class="important"><?php echo LanguageValidation::iMsg("label.guild.card") ?> :</div> <?php echo guild_data('Guild_Name'); ?> <br />
			<div class="important"><?php echo LanguageValidation::iMsg("label.order.card") ?> :</div> <?php echo user_data('Order_Name'); ?> <br /><br />
			
			<div class="important"><?php echo LanguageValidation::iMsg("label.level.card") ?></div> : <?php echo user_data('Level_Number'); ?> <br />
			
			<div class="important"><?php echo LanguageValidation::iMsg("label.hp.card") ?></div> : <div title='<?php echo user_data('Account_HP_Remaining'). "/" .perso_data('HP_Total'); ?>' class='barre' id='hp' >
												<div style='width:<?php echo $hp_purcent ?>px;' ></div>
											</div> <br />
			<div class="important"><?php echo LanguageValidation::iMsg("label.mp.card") ?></div> : <div title='<?php echo user_data('Account_MP_Remaining'). "/" .perso_data('MP_Total'); ?>' class='barre' id='mp' >
												<div style='width:<?php echo $mp_purcent ?>px;' ></div>
											</div>  <br />

			<div class="important"><?php echo LanguageValidation::iMsg("label.xp.card") ?></div> : <div title='<?php echo user_data('Account_Experience')."/".user_data('Level_Experience_Required'); ?>' class='barre' id='xp' >
												<div style='width:<?php echo $xp_purcent ?>px;' >&nbsp;</div> 
												<em style='width:<?php echo (100-$xp_purcent) ?>px;' class="restant"><?php echo $Next_Level; ?></em>
											</div> <br /><br />
											
			<?php foreach($array_character_stats as $char) {?>
				<div class="important"><?php echo LanguageValidation::iMsg("label.".strtolower($char).".card") ?></div> : <?php echo perso_data(ucfirst($char).'_Total'); ?> <br />
			<?php } ?>
			
			<br />
			
		
			
			<div class="important"><?php echo LanguageValidation::iMsg("label.gold.card") ?></div> : 	<?php echo render_money();?>	<br/>
			<div class="important"><?php echo LanguageValidation::iMsg("label.notoriety.card") ?></div> : <div class="gain notoriety"><?php echo user_data('Account_Notoriety'); ?></div><br /><br />
<?php
				}
			}
		}
		
			$already_call_perso_card = true ;
		}
	}
}

function pay_invocation($Invocation_ID)
{
	$Invocation = get_db('request_invocation',array('Invocation_ID' => $Invocation_ID) );

	if(!empty($Invocation))
	{
    	$has_Invocation = get_db('invocation_inventaire_has',array(
			'Invocation_ID' =>$Invocation_ID ,
			'Account_ID' => user_data('Account_ID')
			
		));

		if (empty($has_Invocation))
		{
			if (user_data('Account_Golds') >= $Invocation['Invocation_Price'])
			{
				$Gold = user_data('Account_Golds') - $Invocation['Invocation_Price'];

				insert_db('Caranille_Inventory_Invocations',array(
					'Inventory_Invocation_Invocation_ID'=> $Invocation_ID,
					'Inventory_Invocation_Account_ID' => user_data('Account_ID')
				));
				
				update_db('Caranille_Accounts',array('Account_Golds'=> $Gold, 'Account_ID'=> user_data('Account_ID')));
				
				return $Invocation ;
			
			}
		}
	}
	
	return false ;
}

function pay_magic($Magic_ID)
{
	$Magic = get_db('request_magic',array('Magic_ID' => $Magic_ID) );

	if(!empty($Magic))
	{
    	$has_Magic = get_db('magic_inventaire_has',array(
			'Magic_ID' =>$Magic_ID ,
			'Account_ID' => user_data('Account_ID')
			
		));

		if (empty($has_Magic))
		{
			if (user_data('Account_Golds') >= $Item['Magic_Price'])
			{
				$Gold = user_data('Account_Golds') - $Item['Magic_Price'];

				 insert_db('Caranille_Inventory_Magics',array(
					'Inventory_Magic_Magic_ID'=> $Magic_ID,
					'Inventory_Magic_Account_ID'=> user_data('Account_ID')
				));
				
				update_db('Caranille_Accounts',array('Account_Golds'=> $Gold, 'Account_ID'=> user_data('Account_ID')));
				
				return $Magic ;
			}
		}
	}
	return false ;
}

function pay_item($Item_ID)
{
	$Item = get_db('request_item',array('Item_ID' => $Item_ID) );
    
	if(!empty($Item))
	{
    	if (user_data('Account_Golds') >= $Item[$sell_price])
		{
			$Gold = user_data('Account_Golds') - $Item[$sell_price];

			update_db('Caranille_Accounts',array('Account_Golds'=> $Gold, 'Account_ID'=> user_data('Account_ID')));
			
			return gain_item($Item_ID); //return true ;
		
		}
	}
	return false ;
}

function gain_invocation($Invocation_ID)
{
	$Invocation = get_db('request_invocation',array('Invocation_ID' => $Invocation_ID) );

	if(!empty($Invocation))
	{
		$has_Invocation = get_db('invocation_inventaire_has',array(
			'Invocation_ID' =>$Invocation_ID ,
			'Account_ID' => user_data('Account_ID')
			
		));

		if (empty($has_Invocation))
		{
		    insert_db('Caranille_Inventory_Invocations',array(
        		'Inventory_Invocation_Invocation_ID'=> $Invocation_ID,
        		'Inventory_Invocation_Account_ID' => user_data('Account_ID')
        	));
		}
		
		return $Invocation ;
	}
}

function gain_magic($Magic_ID)
{
	$Magic = get_db('request_magic',array('Magic_ID' => $Magic_ID) );

	if(!empty($Magic))
	{
		$has_Magic = get_db('magic_inventaire_has',array(
			'Magic_ID' =>$Magic_ID ,
			'Account_ID' => user_data('Account_ID')
			
		));

		if (empty($has_Magic))
		{
		    insert_db('Caranille_Inventory_Magics',array(
        		'Inventory_Magic_Magic_ID'=> $Magic_ID,
        		'Inventory_Magic_Account_ID'=> user_data('Account_ID')
        	));
		}
		
		return $Magic ;
	}
    
}

function gain_item($Item_ID)
{
	$Item = get_db('request_item',array('Item_ID' => $Item_ID) );
    
	if(!empty($Item))
	{
		//$Item_Name = stripslashes($Item['Item_Name']);
		//echo "Vous avez gagné l'objet suivant: $Item_Name<br />";

		$Item_Quantity = get_db('item_inventaire_qte',array(
			'Item_ID' =>$Item_ID ,
			'Account_ID' => user_data('Account_ID')
			
		));

		if (!empty($Item_Quantity))
		{
			extract($Item_Quantity);
			
			$Inventory_Item_Quantity++;
			
			update_db('Caranille_Inventory',array('Inventory_Account_ID'=> user_data('Account_ID') , 'Inventory_Item_ID'=> $Item_ID, 'Inventory_Item_Quantity' => $Inventory_Item_Quantity ));
		}
		else
		{
			insert_db('Caranille_Inventory',array('Inventory_Account_ID'=> user_data('Account_ID') , 'Inventory_Item_ID'=> $Item_ID, 'Inventory_Item_Quantity' => 1, 'Inventory_Item_Equipped' => 'No' ));
		}
		
		return $Item ;
	}
}

function gain_ressource($Ressource_ID)
{
	$Ressource = get_db('request_ressource',array('Ressource_ID' => $Ressource_ID) );
    
	if(!empty($Ressource))
	{
		$Ressource_Quantity = get_db('ressource_inventaire_qte',array(
			'Ressource_ID' =>$Ressource_ID ,
			'Account_ID' => user_data('Account_ID')
			
		));

		if (!empty($Ressource_Quantity))
		{
			$Ressource_Quantity['Inventory_Ressource_Quantity']++;
			
			update_db('Caranille_Inventory_Ressources',$Ressource_Quantity);//array('Inventory_Account_ID'=> user_data('Account_ID') , 'Inventory_Ressource_ID'=> $Ressource_ID, 'Inventory_Ressource_Quantity' => $Inventory_Ressource_Quantity ));
		}
		else
		{
			insert_db('Caranille_Inventory_Ressources',array('Inventory_Account_ID'=> user_data('Account_ID') , 'Inventory_Ressource_ID'=> $Ressource_ID, 'Inventory_Ressource_Quantity' => 1 ));
		}
		
		return $Ressource ;
	}
}

function use_fragment($craft_ID,$inventory_ID)
{
 	$Item = get_db('request_fragment',array('craft_ID' => $craft_ID) );
   
	if(!empty($Item))
	{
		$Item_Query = get_db('fragment_inventaire',array('craft_ID' => $craft_ID, 'Inventory_ID' => $Inventory_ID ,'Account_ID' =>user_data('Account_ID')  ));
			
		if(!empty($Item_Query))	
		{		
			extract($Item_Query);
			
			if ($Inventory_Item_Quantity >=2)
			{
				$Inventory_Item_Quantity--;
				update_db('Caranille_Inventory_Fragments',array(
					'Inventory_Fragment_ID'=> $Inventory_ID, 
					'Inventory_Fragment_Account_ID' => user_data('Account_ID') ,
					'Inventory_Fragment_Quantity' => $Inventory_Item_Quantity 
				));
			}
			else
			{
				delete_db('Caranille_Inventory',array(
					'Inventory_Fragment_ID'=> $Inventory_ID, 
					'Inventory_Fragment_Account_ID' => user_data('Account_ID') ,
				));
			}
			
			return $Item ;
		}
	}
}

function use_item($Item_ID,$inventory_ID)
{
 	$Item = get_db('request_item',array('Item_ID' => $Item_ID) );
   
	if(!empty($Item))
	{
		$Item_Query = get_db('item_inventaire',array('Item_ID' => $Item_ID, 'Inventory_ID' => $Inventory_ID ,'Account_ID' =>user_data('Account_ID')  ));
			
		if(!empty($Item_Query))	
		{		
			extract($Item_Query);
			
			if ($Inventory_Item_Quantity >=2)
			{
				$Inventory_Item_Quantity--;
				update_db('Caranille_Inventory',array(
					'Inventory_ID'=> $Inventory_ID, 
					'Inventory_Account_ID' => user_data('Account_ID') ,
					'Inventory_Item_Quantity' => $Inventory_Item_Quantity )
				);
			}
			else
			{
				delete_db('Caranille_Inventory',array(
					'Inventory_ID'=> $Inventory_ID, 
					'Inventory_Account_ID' => user_data('Account_ID') ,
					'Inventory_Item_Quantity' => $Inventory_Item_Quantity )
				);
			}
			
			return $Item ;
		}
	}
}

if(!function_exists('get_user'))
{
	/** 
	 * retrouve le joueur
	 * utilisé dans refresh.php
	 * utilisé dans login.php
	 */
	function get_user($Pseudo)
	{	
		//global $Account_Data ;
				
		$_SESSION['Account_Data'] = get_db('login_account',array('Pseudo'=>$Pseudo));
	}
}

if(!function_exists('get_perso'))
{
	/** 
	 * retrouve le joueur
	 * utilisé dans refresh.php
	 * utilisé dans login.php
	 */
	function get_perso($Pseudo)
	{	
		global $Account_Data , $already_get_perso;
		
		if(!$already_get_perso)
		{
			debug_log( "function get_perso($Pseudo)");
						
			$user_record = get_db('perso_account',array('Pseudo'=>$Pseudo));
			
			if(!empty($user_record))
				$Account_Data = stripslashes_r($user_record);
				
			debug_log( "Account_Data =><".print_r($Account_Data,1).">");
			
			$already_get_perso = true;
		}
	}
}

/**
 * Vérification pour savoir si le joueur monte de niveau
 */
function get_new_level()
{
	global $Account_Data ;
 
	$Next_Level = 2 ;
	$Account_Level = 1 ;
	
	$Experience = 0 ;
	$Level_Experience_Required = 0;
	
	if(empty($Account_Data))
		get_perso(logged_data('Account_Pseudo'));
	
	if(verif_connect(true))
	{
		if(user_has('Account_Experience'))$Experience = user_data('Account_Experience');
		if(user_has('Level_Experience_Required'))$Level_Experience_Required = user_data('Level_Experience_Required');
		if(user_has('Account_Level')) $Account_Level = user_data('Account_Level');

		if ($Experience < 0) $Experience = 0;
		
		$gain = 0 ;
		
		if($Experience >= $Level_Experience_Required)
		{			
			while ($Experience >= $Level_Experience_Required)
			{
				$Level_Data = get_db('get_level_exp_req',array('Account_Level' => ($Account_Level+1) ) );
				
				if(!empty($Level_Data))
				{
					$Level_Experience_Required = $Level_Data['Level_Experience_Required'];
					$gain++;

					debug_log( "theorical calcul level :: (".($Account_Level+$gain));
					
					if($Experience < $Level_Experience_Required)
						break ;
				}
				else
				{
					debug_log("level max");
					break ;
				}
			}
			
			user_set('Level_Experience_Required',$Level_Experience_Required);
			
			$message = "Votre personnage vient de gagner [".$gain."] niveau\\nIl est maintenant au niveau : $Account_Level";
			
			add_diary($message);
		}
		
		update_db('Caranille_Accounts',array('Account_Level'=> ($Account_Level+$gain), 'Account_Experience'=> $Experience, 'Account_ID'=>  user_data('Account_ID') ));
				
		$Next_Level = user_data('Level_Experience_Required') - $Experience;
		
	   if(isset($message) && !empty($message))
			echo "<script type=\"text/javascript\"> alert(\"$message\"); </script>";
	}	
	return $Next_Level ;
}

if(!function_exists('user_has'))
{
	/**
	 * retourne si la valeur user donnée en parametre existe
	 */
	function user_has($data="Account_ID")
	{
		global $Account_Data ;
		
		if(!empty($Account_Data))
			if(isset($Account_Data[$data]))
				//if(!empty($Account_Data[$data]))
					return true;
				
		return false ;
	}
}

if(!function_exists('user_set'))
{
	/**
	 * met à jour les données du joueur en session
	 */
	function user_set($data="Account_ID",$value)
	{
		global $Account_Data ;
		
		if(empty($Account_Data))
			get_perso(logged_data('Account_Pseudo'));
			
		if(user_has($data))
		{
			$Account_Data[$data] = $value ;
		}		
	} 
}

if(!function_exists('user_record'))
{
	/**
	 * met à jour les données du joueur en base
	 */
	function user_record()
	{
		global $Account_Data ;
			
		if(verif_connect(true))
			update_db('Caranille_Accounts',$Account_Data);
	}
}
	
if(!function_exists('user_data'))
{
	/**
	 * retourne la valeur user donnée en parametre
	 */
	function user_data($data=null)
	{
		global $Account_Data ;
		
		if(empty($Account_Data))
			get_perso(logged_data('Account_Pseudo'));
		
		debug_log("user_data($data)");
		
		if(is_null($data))
			return $Account_Data;

		if(user_has($data))
			debug_log("result => user_data($data)".$Account_Data[$data]);
	
		if(user_has($data))
			return $Account_Data[$data];
				
		return false ;
	}
}

if(!function_exists('perso_data'))
{
	function perso_data($var="")
	{
		global $Stats_Data ;
		
		if(isset($Stats_Data[$var]))
			return $Stats_Data[$var] ;
			
		return 0 ;
	}
}

if(!function_exists('get_money'))
{
	function get_money($somme)
	{		
		$fortune = frac_money($somme);
		
		debug_log( "fortune : ".print_r($fortune,1));
		
		return array_reverse($fortune) ;
	}
	
	function frac_money($somme, $count = 0)//,$fortune=array())
	{
		global $money_tx , $money_nb;
		
		if(strlen($somme)>strlen($money_tx))
		{
			debug_log(" modulo :: ".intval($somme%$money_tx));
			debug_log(" reste :: ".intval($somme/$money_tx));
			
			/**
			$m = round($somme/$money_tx,strlen($money_tx));
			
			
			debug_log( "money : ".$m );
			
			$r = explode(".",$m);
			**/
			
			$r[0] = intval($somme/$money_tx) ;
			$r[1] = intval($somme%$money_tx) ;
			
			debug_log( "frac : ".print_r($r,1));
				
			if(is_array($r))
			{
				$count+=count($r);
				
				debug_log("nb-money => ".$count." <= ".($money_nb));
				
				if( $count <= ($money_nb) )
				{
					$fortune = frac_money($r[0], $count );
			    	if(isset($r[1]))$fortune[] = $r[1]; // array_merge($fortune,
				}
				else
					$fortune = $r ;
				
				return $fortune ;
			}
		}
		return array($somme);
	}

	function render_money($somme = null)
	{
		if(is_null($somme))
			$somme = user_data('Account_Golds');
			
		$prix = get_money($somme);
				
		$cout ="<br/>";
		foreach($prix as $x => $am)
			$cout .= $am.'<div class="gain gold'.$x.'">'.LanguageValidation::iMsg("label.gold".$x.".card").'</div>';
		$cout .="<br/>";

		return $cout ;
	}
}

if(!function_exists('get_avatar'))
{
	function get_avatar($Account=null)
	{
		$no_photo_src = "data:image/png;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wBDAAUDBAQEAwUEBAQFBQUGBwwIBwcHBw8LCwkMEQ8SEhEPERETFhwXExQaFRERGCEYGh0dHx8fExciJCIeJBweHx7/2wBDAQUFBQcGBw4ICA4eFBEUHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh4eHh7/wAARCADXAKEDASIAAhEBAxEB/8QAHAABAAIDAQEBAAAAAAAAAAAAAAUGAQMEAgcI/8QAPxAAAgIBAgQCBgYIBAcAAAAAAAECAwQFEQYSITEiQRMyUWFxkXKBobHB0RQVIzNEUnPhNUJTYiQ0VGOSw/D/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8A/XQAAAAAAAABoysvGxY82RfCr3SfV/UBvBCX8S4MG1VXdd70uVfacsuKevhwfnZ/YCygrcOKY7+PCa+jZ+aOzG4i061pTdlL/wB8enzQEwDXTdVdDnpshZH2xe6NgAAAAAAAAAAAAAAAAA1321UVStunGEI95MxlX1Y2PO+6XLCC3bKRrGp3ajfzS3jVF+Cvfove/eBI6rxFda3Xgp1V/wCo14n8PYQM5SnNznJyk+7b3bMAAAAAAA2Y192NYrKLZ1y9sXsWTSOIo2NU56UJdlal4X8V5FXAH0lNNJppp9mjJT+HtZlhzjj5MnLGb6N96/7FvTTSaaafZoDIAAAAAAAAAAAEdxDlvD0yycXtZPwQ+L8/luBXuJ9ReXluiuX7Cl7Lb/NLzZDgAAAAAAAAAAAALPwjqLnH9Aulu4repv2ecSsGzHunRfC6t7ThJSQH0YGrFuhkY1d8PVsipI2gAAAAAAAACq8a382VRjp9IQc38X/ZFqKRxRNy1u9fyqMfsQEYAAAAAAAAAAAAAAAC4cH3+k0uVTfWqxpfB9fzJorHBE/2uVX5OMZfa0WcAAAAAAAAAUbiVba5k+9p/Yi8lQ4xqcNUjb5WVr5rp+QEIAAAAAAAAAAAAAAACw8Er/icqX/bivtLSV/gqpxxL7mvXmor6l/csAAAAAAAAAAheL8V3acr4reVEt39F9H+BNHmyEbIShNKUZJpp+aA+bg69Vwp4GbOiW7iusJe2PkcgAAAAAAAAAAAAur2S3YJjhbAeVm/pFkf2ND36+cvJfiBZ9Ixv0PTqaGvFGO8vpPqzrAAAAAAAAAAAACP1vTYaji8nSN0Otcn9z9zKRfVZRbKq2DhOL2kn5H0cj9Y0qjUa95fs7orw2JfY/agKKDp1DBycG30eRW47+rJdYy+DOYAAAAAAAEjpOkZOoSUknXR52SX3e0Dn03Cuz8lU0r3yk+0V7WXrCxqsPGhj0raMV9bfm2YwMOjBx1Tjw2Xdt95P2s6AAAAAAAAAAAAAAAAaMrLxcWO+RfXX7m+vy7gbLa67a3XbCM4PvGS3TITN4axbW5YtkqH/K/FH80esniXCrbVNVtz9vqr7SOu4ny5fuqKa1795MDTkcPalW3yQruXthP8GcstK1KL2eFf9UdzdPXtUl/EKP0YJGp6xqb/AI236tgENI1Ob6YVy+K2+87MbhvPsadsqqV75cz+SOSOs6ov42x/HZ/gbq+INUh3uhP6Va/ACewOH8HGanankTXnP1fkSySSSS2S7Iq9HFF6a9Pi1zXthJxf4kjjcRafbsrHZQ/98d180BMA10XVXw56bYWR9sXubAAAAAAAAAABryLqsemV19ka4R7tgbCP1LV8PB3jZP0lv+nDq/r9hA6vxBdkc1WHzU1dnL/PL8iDfV7sCXz9fzsneNUlj1+yHrfMiZNyk5Sbbfdt7swAAAAAAAAAAAA90220zVlNkq5Lzi9mTen8SZNTUcuCvh/MukvyZAgD6DgZ2LnQ5sa1Sa7xfSS+KOk+b1WTqsVlc5QnHtKL2aLLo/ESk1TqGyfZWpdPrX4gWMGItSipRaaa3TXmZAAADl1LOowMd3Xvv0jFd5P3FK1PUMjULue6W0V6kF2j/wDe08ahmXZuTK++W7fRJdor2I5wAAAAGYxlLfljKW3fZb7AYBlprbdNbrdbruHGSSk4ySfZtdGBgGUm3sk235JGXCa33hJbPZ7p9APIJ3WcHGp0HTL6KErrl45R3bl4dyDSbeyTbfkl1AwDo0/FllZ9OK+aDsmot8u7jv57G3WsB6dqFmLzysjHbabjtvutwOIGZRlHbmjKO/bdbbmAAAAldE1i3AkqrN7MZvrHzj71+Rcce6rIpjdTNThJbpo+ckjomqWadf13nRJ+OH4r3gXkEd+u9L/6tf8AiwBRgAAAAAs/AsuSGoy2Utqk9n2frFYLLwT+41P+ivukB26jyahRw/dfVDe6yPNGK2WzW+3w6HVqF36dj6zhXVV+jxYL0Wy6p8u+/wAzjc4w07hqUmklZDdv6J2ZWPbjQ17JvShVdBejlv38G33gVThr/HsL+qvuZbNRveTg65j2V18mPHw7Lq/Bvu/fuVPhr/HsL+qvuZbM3HtoxdeutiowujvW9+6UNvvAYGTKjC0KuNdcvTLkcpLrFcjfT5HNh8mHmcQZ1VUHbQ94brovDu/tPVH/AC/Dn0v/AFsxTCWRdxHi1bSusa5Y77b+HYD3lZMq9U0bNhXWrcytV29O6fKzXnXyzeMcfT74Vyook5xW3Vvk36/Wa9Xaxsvh6m5qM6nHnW/b1V957yKLaOOaMq1KNN/hrluur5NtgM6zf+sNC1R31wTxMhxqaXVbNfmyllz1HHtw9B1l5EVD0+Q5V9d+ZNrYpgAAAAAAAAAAAAAAN2NlZOMprHvnUrFtPle3MveaQButysm2iuiy+c6qvUg30j8D1fnZt9KpvyrrK49oym2jnAHfw9OMNbxJzlGMVZu23sl0Z08TZt09Uy6Ksqcsac0+WM94PoiHAHStQzUqUsq1Kn90t/U6bdPqPMc3LhlSyo5Nsb5d7FLZv4mgAbMi+7Itdt9s7bH3lJ7s2X5uZkRrjfk22Kt7w5pb8vwOcAdGVm5mVGMcnKtujHspy3SOcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP/Z";
		
		if(!is_null($Account))
		{
			if(isset($Account['Account_Avatar']) && $Account['Account_Avatar']!=="")
				return $Account['Account_Avatar'];
			else
				return $no_photo_src ;
		}
		else
		{
			if(user_data('Account_Avatar') != null || user_data('Account_Avatar') !='' )
				 return user_data('Account_Avatar');
			else
				return $no_photo_src ;
		}

	}
}

if(!function_exists('add_diary'))
{
	function add_diary($message="", $Account_ID = null)
	{
		if(verif_connect(true))
		{
			$message = addslashes_r($message);
			
			$ID = $Account_ID != null ? $Account_ID : user_data('Account_ID') ;
			
			insert_db('Caranille_Diaries',array(
				'Diary_Account_ID' => $ID,
				'Diary_Message' => $message ,
				'Diary_Date' => date("Y-m-d H:i:s")
			   ));
		}
	}
}

function get_html_option_town($Items,$Item_ID)
{
	foreach($Items as $ID => $Monster_Item_One )
		echo "<option ".($ID == $Item_ID ? 'selected' : '')." value=\"$ID\">$Monster_Item_One</option>";
}

function get_list_values_town()
{
	$Items_List = list_db('list_town');
	
	foreach($Items_List as $Items)
		$l_Items[$Items['Town_ID']] = stripslashes($Items['Town_Name']);
			
	return $l_Items ;
}

/** liste de selection utilisé dans la partie Admin **/
function get_list_option_town($Town_ID)
{
	$option ="";
	
	$Town_List = list_db('list_town');
	
	foreach( $Town_List as $Town )
		$option .= '<option '.($Town['Town_ID']== $Town_ID ? 'selected' : '').' value="'.$Town['Town_ID'].'">'.$Town['Town_Name'].'</option>';

	return $option ;
}

/** liste de selection utilisé dans la partie Admin **/
function get_list_option_monster($Chapter_Monster_ID, $Monster_Access="Chapter")
{
	$option_monster ="\n";

	$Monster_List = list_db('list_monster_access',array('Monster_Access'=>$Monster_Access) );

	foreach($Monster_List as $Monster)
		$option_monster .='<option '.($Monster['Monster_ID']== $Chapter_Monster_ID ? 'selected' : '').' value="'.$Monster_List['Monster_ID'].'">'.$Monster['Monster_Name'].'</option>';
	
	return $option_monster ;
}

function get_html_option_item($Items,$Item_ID)
{
	foreach($Items as $ID => $Monster_Item_One )
		echo "<option ".($ID == $Item_ID ? 'selected' : '')." value=\"$ID\">$Monster_Item_One</option>";
}

function get_list_option_item()
{
	$Items_List = list_db('list_item');
	
	foreach($Items_List as $Items)
		$l_Items[$Items['Item_ID']] = stripslashes($Items['Item_Name']);
			
	return $l_Items ;
}

function get_list_option_chapter($Town_Chapter_ID)
{	
	$option_monster ="\n";
	
	$chapters = list_db('list_chapter');
	
	foreach($chapters as $chapter)
		$option_monster .='<option '.(isset($Town_Chapter_ID) && $chapter['Chapter_ID']== $Town_Chapter_ID ? 'selected' : '').' value="'.$chapter['Chapter_ID'].'">'.stripslashes($chapter['Chapter_Name']).'</option>';
	
	return $option_monster ;
}
	
function get_list_option_user()
{
	$Players_List = list_db('list_account');
	
	$options = "";
	
	foreach($Players_List as $Player)
	{
		$options .= '<option value="'.$Player['Account_ID'].'">'.$Player['Account_Pseudo'].'</option>';
	}

    return $options ;
}



?>