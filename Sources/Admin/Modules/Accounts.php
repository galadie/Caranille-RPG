<?php
	if(verif_access("Admin"))
	{
	
		function formulaire($Account)
		{
			global $prefixe_salt, $suffixe_salt, $array_access_type ;
						
			extract($Account);
?>
				<form method="POST" action="<?php echo get_link("Accounts","Admin")?>">
				<table>
				<tr><th colspan="3" >Identifiants</th></tr>
				<tr><td colspan="3" ><?php
				
				echo line_db("Caranille_Accounts","Account_Pseudo",$Account_Pseudo);
    			echo line_db("Caranille_Accounts","Account_Email",$Account_Email);
    			echo line_db("Caranille_Accounts","Account_Password",password_decode($prefixe_salt.$Account_Salt.$suffixe_salt, $Account_Password ));
    			echo line_db("Caranille_Accounts","Account_Access",$Account_Access);
    			echo line_db("Caranille_Accounts","Account_Valid",$Account_Valid);
				
				?></td></tr>
			    <tr><td class="none" colspan="3" ></td></tr>
				
				<tr><th colspan="3" >Connection</th></tr>
				<tr><td colspan="3" ><?php
				
				echo line_db("Caranille_Accounts","Account_Last_Connection",$Account_Last_Connection);
				echo line_db("Caranille_Accounts","Account_Last_IP",$Account_Last_IP);
				echo line_db("Caranille_Accounts","Account_Last_Connected",$Account_Last_Connected);
				
				?></td></tr>
				
				<tr><td class="none" colspan="3" ></td></tr>

				<tr><th colspan="3" >Stats</th></tr>
				<tr><th></th><th>Restant</th><th>Bonus</th></tr>
				<tr><td>HP</td>
					<td><input type="text" name="Account_HP_Remaining" value="<?php echo $Account_HP_Remaining?>"/></td>
					<td><input type="text" name="Account_HP_Bonus" value="<?php echo $Account_HP_Bonus?>"/></td>
				</tr>
				<tr><td>MP</td>
					<td><input type="text" name="Account_MP_Remaining" value="<?php echo $Account_MP_Remaining?>"/></td>
					<td><input type="text" name="Account_MP_Bonus" value="<?php echo $Account_MP_Bonus?>"/></td>
				</tr>
				<tr><td>Force</td><td></td><td><input type="text" name="Account_Strength_Bonus" value="<?php echo $Account_Strength_Bonus?>"/></td></tr>
				<tr><td>Magie</td><td></td><td><input type="text" name="Account_Magic_Bonus" value="<?php echo $Account_Magic_Bonus?>"/></td></tr>
				<tr><td>Agility</td><td></td><td><input type="text" name="Account_Agility_Bonus" value="<?php echo $Account_Agility_Bonus?>"/></td></tr>
				<tr><td>Defense</td><td></td><td><input type="text" name="Account_Defense_Bonus" value="<?php echo $Account_Defense_Bonus?>"/></td></tr>
				
				<tr><td class="none" colspan="3" ></td></tr>
				
				<tr><th colspan="3" >Progression</th></tr>
				<tr><td colspan="3" ><?php
				
				echo line_db("Caranille_Accounts","Account_Level",$Account_Level);
    			echo line_db("Caranille_Accounts","Account_Experience",$Account_Experience);
    			echo line_db("Caranille_Accounts","Account_Golds",$Account_Golds);
    			echo line_db("Caranille_Accounts","Account_Notoriety",$Account_Notoriety);
    			echo line_db("Caranille_Accounts","Account_Chapter",$Account_Chapter);
    			echo line_db("Caranille_Accounts","Account_Mission",$Account_Mission);
    			echo line_db("Caranille_Accounts","Account_Order",$Account_Order);
    			echo line_db("Caranille_Accounts","Account_Guild_ID",$Account_Guild_ID);

				
				?></td></tr>
				
				<tr><td class="none" colspan="3" ></td></tr>
				
				<tr><th colspan="3" >Infos complémentaires</th></tr>
				<tr><td colspan="3" ><?php
				
				echo line_db("Caranille_Accounts","Account_siteweb",$Account_siteweb);
				echo line_db("Caranille_Accounts","Account_Avatar",$Account_Avatar);
				echo line_db("Caranille_Accounts","Account_Signature",$Account_Signature);
				echo line_db("Caranille_Accounts","Account_localisation",$Account_localisation);
				
				?></td></tr>
				
				<tr><td class="none" colspan="3" ></td></tr>
				
				<tr><th colspan="3" >Banissement</th></tr>
				<tr><td colspan="3" ><?php
				
				echo line_db("Caranille_Accounts","Account_Status",$Account_Status);
    			echo line_db("Caranille_Accounts","Account_Reason",$Account_Reason);

				
				?></td></tr>
				
				<tr><td class="none" colspan="3" ></td></tr>
				
				<tr>
					<td class="none" colspan="3" >
						<input type="submit" name="Back" value="Annuler" />
						<input type="submit" name="End_Edit" value="Terminer"/>
				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
					</td>
				</tr>				
				</table>
    			<?php echo line_db("Caranille_Accounts","Account_ID",$Account_ID); ?>
			</form>
<?php
				if(isset($Account["Account_ID"]))
				{
					$loots = list_db('foreign_list',array(
						'table' => 'Caranille_Inventory' ,
						'ID' => 'Inventory_Account_ID',
						'value' => $Account["Account_ID"]
					));
					
					
					if(!empty($loots))
					{
						list_html($loots,"Caranille_Inventory","Accounts",array('Inventory_Item_ID','Inventory_Item_Quantity','Inventory_Item_Equipped'),false,false);
					}
					
					$loots = list_db('foreign_list',array(
						'table' => 'Caranille_Inventory_Invocations' ,
						'ID' => 'Inventory_Invocation_Account_ID',
						'value' => $Account["Account_ID"]
					));
										
					if(!empty($loots))
					{
						list_html($loots,"Caranille_Inventory_Invocations","Accounts",array('Inventory_Invocation_Invocation_ID'),false,false);
					}
					
					$loots = list_db('foreign_list',array(
						'table' => 'Caranille_Inventory_Magics' ,
						'ID' => 'Inventory_Magic_Account_ID',
						'value' => $Account["Account_ID"]
					));
										
					if(!empty($loots))
					{
						list_html($loots,"Caranille_Inventory_Magics","Accounts",array('Inventory_Magic_Magic_ID'),false,false);
					}
				}
		}

		if (request_confirm('End_Edit'))
		{
			if (valid_post_db('Caranille_Accounts'))//request_confirm('Account_Pseudo') && request_confirm('Account_Email') && request_confirm('Account_Chapter') && request_confirm('Account_Access'))
			{
				// reencodage du mot de passe avec une nouvelle clé
				$_POST['Account_Salt'] = uniqid();
				$_POST['Account_Password'] = password_encode($prefixe_salt.$_POST['Account_Salt'].$suffixe_salt, $_POST['Account_Password']  );
				
				update_db('Caranille_Accounts',addslashes_r($_POST));
				
				echo 'Le compte a bien été modifié';
			}
			else
			{
				echo 'Tous les champs n\'ont pas été remplis';
			}
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Accounts',$_POST);
			echo 'Le compte a bien été supprimé';
		}
	
		
		//print_r($_POST);
	}
?>
