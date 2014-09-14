<?php

	load_css('corps.css','corps');	
	load_css('infobulle.css','infobulle');	
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$title ="";
	$baseline= LanguageValidation::iMsg("welcome.game.inventory");
	
	if(verif_connect()) 
	{
		// action dans l'inventaire
		if (request_confirm('Item_ID'))
		{
			extract($_POST);
			
			$params = $_POST + user_data() ;
			
			$Item_Query = get_db('item_inventaire',$params);
			
			if(!empty($Item_Query))	
			{
				//$type = $Item_Query['Item_Type'];
				$type = in_array($Item_Query['Item_Type'],$array_weapon_type) ? "Weapon" : $Item_Query['Item_Type'];

				extract($Item_Query);
		
				//equiper
				if (request_confirm('Item_Equip'))
				{					
					if (user_data('Level_Number') >= $Item_Level_Required)
					{	
						retire_equipement($type);

						update_db('Caranille_Inventory',array(
							'Inventory_ID'=> $Inventory_ID, 
							'Inventory_Item_ID'=> $Item_ID,
							'Inventory_Item_Equipped'=> 'Yes' 
						));
							
						cast_equipement($Item_Query);

						$baseline= "Equipement effectué";
					}
					else
					{
						$baseline= 'Vous ne possedez pas le niveau requis pour équiper cet objet';
					}
				}
				
				// desequiper
				if (request_confirm('Item_Desequip'))
				{					
					if(isEquiped($type))
					{
						retire_equipement($type);
					
						$baseline= "Déséquipement effectué";
					}
				}
				
				// mettre à l'hotel des ventes...
				if(request_confirm('host'))
				{
					update_db('Caranille_Inventory',array('Inventory_ID'=> $Inventory_ID, 'Item_ID'=> $Item_ID,'Inventory_Item_Equipped'=> 'Host' ));				
/**
					if(isEquiped($type))
					{					
						retire_equipement($type);
						
						$baseline= "Déséquipement effectué";
					}
**/				}
				
				// jeter
				if(request_confirm('Drop'))
				{
					use_item($Item_ID,$inventory_ID);
					$baseline= "Item jeté";
				}
				
				// vente immédiate
				if (request_confirm('Sale'))
				{	
					if ($Inventory_ID == $_SESSION['Armor_Inventory_ID'] || $Inventory_ID == $_SESSION['Boots_Inventory_ID'] ||$Inventory_ID == $_SESSION['Gloves_Inventory_ID'] || $Inventory_ID == $_SESSION['Helmet_Inventory_ID'] || $Inventory_ID == $_SESSION['Weapon_Inventory_ID'])
					{
						$baseline= 'Vous ne pouvez pas vendre cet objet car il est actuellement équipé<br />';
					}
					else
					{
						use_item($Item_ID,$inventory_ID);
						
						exec_db("UPDATE Caranille_Accounts SET Account_Golds = (Account_Golds + ".intval($Item_Sale_Price).") WHERE Account_ID = ".intval($ID)." limit 1");
						$baseline= "Vente effectuée";

					}
				}
			
				//Module of Parchement
				if (request_confirm('Use'))
				{
					use_item($Item_ID,$inventory_ID);
				
					exec_db("UPDATE Caranille_Accounts
						SET
							Account_HP_Bonus = Account_HP_Bonus + ".intval($Item_HP_Effect)."
						, 	Account_MP_Bonus = Account_MP_Bonus + ".intval($Item_MP_Effect)."
						, 	Account_Strength_Bonus = Account_Strength_Bonus + ".intval($Item_Strength_Effect)."
						, 	Account_Magic_Bonus = Account_Magic_Bonus + ".intval($Item_Magic_Effect)."
						, 	Account_Agility_Bonus = Account_Agility_Bonus + ".intval($Item_Agility_Effect)."
						, 	Account_Defense_Bonus = Account_Defense_Bonus + ".intval($Item_Defense_Effect)."
						WHERE 
							Account_ID = $ID
						Limit 1");
						
					$baseline= "Le parchemin à bien été utilisé ";
				}		
			}
		}
	}
?>
