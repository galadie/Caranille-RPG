<?php
	load_css('infobulle.css','infobulle');	

	if(verif_connect()) 
	{
		switch(strtolower($page))
		{
			case 'weapon' :
			case "accessory" :		
			case "item" :
	
				//include_once('/../items_shop.php');
				
        		$sell_type = "Item_Type";
        		$sell_image = 'Item_Image';
        		$sell_id = 'Item_ID';
        		$sell_level_required = 'Item_Level_Required';
        		$sell_name = 'Item_Name';
        		$sell_description = 'Item_Description';
        		$sell_price = 'Item_Purchase_Price';
        
        		$sell_HP = 'Item_HP_Effect'; $term_HP = '+ %s HP</br>';
        		$sell_MP = 'Item_MP_Effect'; $term_MP = '+ %s HP<br/>';
        		$sell_strength = 'Item_Strength_Effect'; $term_strength = '+ %s Force<br/>';
        		$sell_magic = 'Item_Magic_Effect'; $term_magic = '+ %s Magic<br/>';
        		$sell_agility = 'Item_Agility_Effect'; $term_agility ='+ %s agilité<br/>';
        		$sell_defense = 'Item_Defense_Effect'; $term_defense ='+ %s defense<br/>';
        		
		        $request_indice = 'shop_request_item';
				
				if(strtolower($page)==="weapon")
				{
				    $request_params = array( 'type_list' => implode("','",$array_weapon_type) , 'town' => $_SESSION['Town_ID'] );
				}
			elseif(strtolower($page)==="accessory")
				{
    				$request_params = array( 'type_list' => implode("','",$array_accessory_type) , 'town' => $_SESSION['Town_ID'] );
				}
			elseif(strtolower($page)==="item")
				{
			    	$request_params = array( 'type_list' => implode("','",$array_items_shop_type) , 'town' => $_SESSION['Town_ID'] );
				}
				
			break;

			
			case "magic" :
				//$racine = "magic";
				//include_once('/../magics_shop.php');
				
				$sell_id = 'Magic_ID';
        		$sell_image = 'Magic_Image';
        		$sell_type = 'Magic_Type';
        		$sell_name ='Magic_Name';
        		$sell_description ='Magic_Description';
            	$sell_price ='Magic_Price';
        		
            	$sell_HP = 'Magic_Effect'; $term_HP = '+ %s %s<br/>'; //HP/Damage	
				
				$request_indice = 'shop_request_magic';
				$request_params = array(  'town' => $_SESSION['Town_ID'] );
				
			break;
			
			case "temple" :
				//$racine = "temple" ;
				//include_once('/../invocations_shop.php');

        		$sell_image = 'Invocation_Image';
        		$sell_id = 'Invocation_ID';
        		$sell_name = 'Invocation_Name';
        		$sell_description ='Invocation_Description';
        		$sell_price ='Invocation_Price';
        		$sell_HP = 'Invocation_Damage';
        		
        		$term_HP = '+ %s Damage<br/>';		
				
				$request_indice = 'shop_request_invocation';
				$request_params = array(  'town' => $_SESSION['Town_ID'] );
			break;
		}
	
	
		if (verif_town())
		{
			$Town = htmlspecialchars(addslashes($_SESSION['Town_ID']));
			
			$return = print_r($_POST,1)."<br/>";
			
			if (request_confirm('Buy'))
			{
				$return .= "<br/>sell_id::$sell_id";
				if(isset($sell_id))
				{
					$Item_ID = htmlspecialchars(addslashes($_POST[$sell_id]));
					
					$return .= "<br/>Item_ID::$Item_ID";
					
					$return .= "<br/>page::$page";
					
					$return .= "<br/>get_link($page,'Shop') = ".get_link($page,"Shop");
					
					$return .= "<br/>$_path"."Sources/".ucfirst("Shop")."/Modules/".ucfirst($page).".php";
					$return .= "<br/>$_url".strtolower($directory)."/".strtolower($Module).".html";

					if(verifier_token(600, get_link($page,'Shop') ,  "buy-".strtolower($page)."-".$_POST[$sell_id]))
                    {
    					
                		switch(strtolower($page))
                		{
                			case 'weapon' :
                			case "accessory" :		
                			case "item" :
                			    
                			     $item = pay_item($Item_ID) ;
    							if($item !== false) 
    							{
    							    $paid = true;
    							}
                    		break;
                    		
                			case "magic" :
                			    $item = pay_magic($Item_ID);
    							if($item !== false) 
    							{
    							    $paid = true;
    							}
                			break;
                			
                			case "temple" :
                			    $item = pay_invocation($Item_ID);
    							if($item !== false) 
    							{
    							    $paid = true;
    							}
                			break;
                		}    		
   		
                        if($paid)
                        {
                            $message = "Vous avez acheté ".$item[$sell_name].".";
            				
            				add_diary($message);
            			}
            			else
            			{
            				$message = "Vous n'avez pas assez d'argent";
            			}
						
						$return .= "$message <br /><br />";
						$return .= '<form method="POST" action="'.get_link($page,'Shop').'">';
						$return .= '<input type="submit" name="Cancel" value="'.LanguageValidation::nMsg("btn.return.town").'"/>'.LanguageValidation::eMsg("btn.return.town");
						$return .= '</form>';
    				}
                }
			}
		}
	}
	