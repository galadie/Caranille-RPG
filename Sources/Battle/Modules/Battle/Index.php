<?php

function has_roaster()
{
	if(user_data('Account_Roaster_ID')!=0)
	{
		$r = get_roaster();
		$c = count($r);
		
		//echo "count(r) => $c<br/>";
		
		if( $c > 0 )
			return true ;
	}
	
	return false ;

}

function compo_roaster()
{
	if(user_data('Account_Roaster_ID')!=0)
	{
		$roaster = get_roaster();	
		
		if(!empty($roaster))
		{
			echo "<h3>goupe de combat</h3>";
			foreach($roaster as $recrus)
			{
				echo $recrus['Account_Pseudo']."<br/>";
			}
		}
	}
}

function get_roaster()
{
	global $connect_marge , $roaster_max_membres;
	
	if(user_data('Account_Roaster_ID')!=0)
	{
		$Marge = time() - $connect_marge;
					
		$d = date("Y-m-d H:i:s", $Marge);


		$recrus = list_db("list_roaster",array(
				'Roaster_ID' => user_data('Account_Roaster_ID'),
				'timeout' => $d ,
				'Account_ID' => user_data('Account_ID'),
				'limit' => $roaster_max_membres
			)) ;
		
		return $recrus ;
	}
	
	return null ;
}


function monster_data($data='ID')
{
    if(verif_battle(true))
    {
        if(isset($_SESSION['Monster_'.$data]))
        {
            //if(!empty($_SESSION['Monster_'.$data]))
            //{
                return htmlspecialchars(stripslashes($_SESSION['Monster_'.$data]));
           // }
             echo "<br/>la variable Monster_$data est vide<br/>";
        }
        echo "<br/>la variable Monster_$data n'existe pas<br/>";
    }
    return null;  
}

function init_battle($type='Account',$data=array(),$challenge)
{
    global $array_battle_type;
    
    if($type == "Account")
    {
        $_SESSION['Monster_Image'] = "";
		$_SESSION['Monster_ID'] = stripslashes($data['Account_ID']);
		$_SESSION['Monster_Name'] = stripslashes($data['Account_Pseudo']);
		$_SESSION['Monster_Strength'] = stripslashes($data['Level_Strength']);
		$_SESSION['Monster_Defense'] = stripslashes($data['Level_Defense']);
		$_SESSION['Monster_HP'] = stripslashes($data['Account_HP_Remaining']);
		$_SESSION['Monster_Golds'] = stripslashes($data['Account_Golds']);
    }
    else
    {
		$_SESSION['Monster_ID'] = stripslashes($data['Monster_ID']);
		//$_SESSION['Monster_Image'] = stripslashes($data['Monster_Image']);
		$_SESSION['Monster_Name'] = stripslashes($data['Monster_Name']);
		$_SESSION['Monster_Description'] = stripslashes(nl2br($data['Monster_Description']));
		$_SESSION['Monster_Level'] = stripslashes($data['Monster_Level']);
		$_SESSION['Monster_Strength'] = stripslashes($data['Monster_Strength']);
		$_SESSION['Monster_Defense'] = stripslashes($data['Monster_Defense']);
		$_SESSION['Monster_HP'] = stripslashes($data['Monster_HP']);
		$_SESSION['Monster_Experience'] = stripslashes($data['Monster_Experience']);
		$_SESSION['Monster_Golds'] = stripslashes($data['Monster_Golds']);
		
		/**
		$_SESSION['Monster_Item_One'] = stripslashes($data['Monster_Item_One']);
		$_SESSION['Monster_Item_One_Rate'] = stripslashes($data['Monster_Item_One_Rate']);
		$_SESSION['Monster_Item_Two'] = stripslashes($data['Monster_Item_Two']);
		$_SESSION['Monster_Item_Two_Rate'] = stripslashes($data['Monster_Item_Two_Rate']);
		$_SESSION['Monster_Item_Three'] = stripslashes($data['Monster_Item_Three']);
		$_SESSION['Monster_Item_Three_Rate'] = stripslashes($data['Monster_Item_Three_Rate']);
		**/
		$_SESSION['Monster_Image_Name'] = stripslashes($data['Image_Name']);
		$_SESSION['Monster_Image_Type'] = stripslashes($data['Image_Type']);
		$_SESSION['Monster_Image_Base64'] = stripslashes($data['Image_Base64']);
		
    }

	$_SESSION['Battle'] = 1;

    foreach($array_battle_type as $b_type)
    	$_SESSION[$b_type.'_Battle'] = ($b_type === $challenge ? 1 : 0) ;
}

function close_battle()
{
	if (user_data('Account_HP_Remaining') <= 0 || 	monster_data('HP') <= 0)
    {
		$_SESSION['Battle'] = 0;
    }

}

/** return les degats causé par l'adversaire dans un tour **/
function getMonsterDamage()
{
	global $bonus_malus_battle ;
	
	//Si le joueur est dans une ville, on regarde si il est actuellement en combat
	if (verif_battle(true))
	{
		$Monster_MIN_Strength = monster_data('Strength') /  $bonus_malus_battle;
		$Monster_MAX_Strength = monster_data('Strength') *  $bonus_malus_battle;
		
		$MIN_Defense = perso_data('Defense_Total') /  $bonus_malus_battle;
		$MAX_Defense = perso_data('Defense_Total') *  $bonus_malus_battle;
				
		$Monster_Positive_Damage = mt_rand($Monster_MIN_Strength, $Monster_MAX_Strength);
		$Monster_Negative_Damage = mt_rand($MIN_Defense, $MAX_Defense);
		$Total_Damage_Monster = htmlspecialchars(addslashes($Monster_Positive_Damage)) - htmlspecialchars(addslashes($Monster_Negative_Damage));

		//Si les dégats du monstre sont égal ou inférieur à zero
		if ($Total_Damage_Monster <=0)	$Total_Damage_Monster = 0;
		
		//$Remaining_HP = htmlspecialchars(addslashes(user_data('Account_HP_Remaining'))) - htmlspecialchars(addslashes($Total_Damage_Monster));
		//update_db('Caranille_Accounts',array('Account_HP_Remaining'=> $Remaining_HP, 'Account_ID'=> user_data('Account_ID') ));
				
		user_set('Account_HP_Remaining', (user_data('Account_HP_Remaining') -$Total_Damage_Monster ) );
		user_record();
		
		return $Total_Damage_Monster ;

	}
	
	return 0;
}

/** return les defenses de l'adversaire dans un tour **/
function getMonsterDefense()
{
	global $bonus_malus_battle ;
	
	//Si le joueur est dans une ville, on regarde si il est actuellement en combat
	if (verif_battle(true))
	{
		$Monster_MIN_Defense = monster_data('Defense') / $bonus_malus_battle;
		$Monster_MAX_Defense = monster_data('Defense') * $bonus_malus_battle;

		return mt_rand($Monster_MIN_Defense, $Monster_MAX_Defense);
	}
	
	return 0;				
}   
  
  
/** return les degats causÃ© par le joueur dans un tour **/
function getPlayerDamage()
{
	if (request_confirm('Attack'))
	{
		$MIN_Strength = perso_data('Strength_Total') / $bonus_malus_battle;
		$MAX_Strength = perso_data('Strength_Total') * $bonus_malus_battle;
		
		$Positive_Damage_Player = mt_rand($MIN_Strength, $MAX_Strength);
		$Negative_Damage_Player = getMonsterDefense(); //mt_rand($Monster_MIN_Defense, $Monster_MAX_Defense);
		
		$Total_Damage_Player = htmlspecialchars(addslashes($Positive_Damage_Player)) - htmlspecialchars(addslashes($Negative_Damage_Player));
						
		//Si les dégats du joueurs ou du monstre sont égal ou inférieur à zero
		if ($Total_Damage_Player <=0) $Total_Damage_Player = 0;
		
		$_SESSION['Monster_HP'] = monster_data('HP') - htmlspecialchars(addslashes($Total_Damage_Player));
	}
	
	if (request_confirm('End_Invocations'))
	{
		$Invocation_Choice = htmlspecialchars(addslashes($_POST['Invocation']));
		$MP_Choice = htmlspecialchars(addslashes($_POST['MP_Choice']));
		
		if ($_SESSION['MP'] >= $MP_Choice)
		{
			$Invocation = get_db("edit_admin",array(
						'table' => 'Caranille_Invocations' ,
						'ID' => 'Invocation_Name',
						'value' => $Invocation_Choice
					));	
					
			$Invocation_Damage = $Invocation['Invocation_Damage'];
						
			// non utilisé ??? 
			//$Monster_MIN_Defense = htmlspecialchars(addslashes($_SESSION['Monster_Defense'])) / $bonus_malus_battle;
			//$Monster_MAX_Defense = htmlspecialchars(addslashes($_SESSION['Monster_Defense'])) * $bonus_malus_battle;

			$Invocation_Total_Damage = htmlspecialchars(addslashes($Invocation_Damage)) * htmlspecialchars(addslashes($MP_Choice));

			$_SESSION['Monster_HP'] = monster_data('HP') - htmlspecialchars(addslashes($Invocation_Total_Damage));
		}
		else
		{
			$message = 'Vous n\'avez pas assez de MP';
		}
	}
					
}

/** return les effects causÃ© par le joueur dans un tour **/
function getPlayerTreatment()
{
    
}