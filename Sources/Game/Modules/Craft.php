<?php
	/** http://crafting.cubicleninja.com/ **/
	
	if(verif_connect())
	{
		if(!isset($_SESSION['CRAFT']))
		{
			$_SESSION['CRAFT'] = array(
				'item'=> array(
					'Item_Name'=>'',
					'Item_Type'=>'',
					'Item_Level_Required'=>''
				),
				'crafting' => array()
			);
			
			foreach($array_character_type as $char)
				$_SESSION['CRAFT']['item']['Item_'.ucfirst($char).'_Effect'] = 0 ;
		}
		
		
		if(request_confirm('end-craft'))
		{
			// c'est fini ...
			
			$_SESSION['CRAFT']['item']['Item_Name'] = $_POST['item-name'];
			
			$id_item = insert_db('Caranille_Items',$_SESSION['CRAFT']['item']);
			
			if(isset($_SESSION['CRAFT']['crafting']))
			{
				foreach($_SESSION['CRAFT']['crafting'] as $craft)
				{
					insert_db('Caranille_Craftings',array(
						'Crafting_Fragment_ID' => $craft,
						'Crafting_Item_ID' => $id_item 
					));
				}
			}
			
			insert_db('Caranille_Inventory',array(
				'Inventory_Account_ID' => user_data('Account_ID') ,
				'Inventory_Item_ID' => $id_item , 
				'Inventory_Item_Quantity' => 1 , 
				'Inventory_Item_Equipped' => 'No' 
			));
			
			unset($_SESSION['CRAFT']);
		}
		elseif(request_confirm('choose-name'))
		{
			// saisir un nom et valider les resultats
			// seulement si le craft contient les 5 element requis...
			
			if(request_confirm('item-frag'))
			{
				$_SESSION['CRAFT']['crafting'] = $_POST['item-frag'];
				
				foreach(request_post('item-frag') as $k => $_frag)
				{
					if($k >= 0 && $k <=4)
					{
						$frag = get_db("edit_admin",array(
							'table' => 'Caranille_Fragments' ,
							'ID' => 'Fragment_ID',
							'value' => $_frag
						));
						
						foreach($array_character_type as $char)
							if(isset($frag['Fragment_'.ucfirst($char).'_Effect']))
								$_SESSION['CRAFT']['item']['Item_'.ucfirst($char).'_Effect'] += stripslashes($frag['Fragment_'.ucfirst($char).'_Effect']);
							
					}
				}
			}
			// 3 pieces et 2 bonus 
			// sinon on invite à recommencer ou abandonner
		}
		elseif(request_confirm('select-frag'))
		{
			//print_r($_POST);
			
			$_SESSION['CRAFT']['item']['Item_Type'] = request_post('item-type');
			$_SESSION['CRAFT']['item']['Item_Level_Required'] = user_data('Account_Level');
			
			$Fragment_Query = list_db('craftable_list',array('Account_ID' => user_data('Account_ID') , "Item_Type" => $_SESSION['CRAFT']['item']['Item_Type']));
		}
	}
	
?>