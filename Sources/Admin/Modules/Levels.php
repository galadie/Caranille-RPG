<?php
	if(verif_access("Admin"))
	{
		function get_formulaire_Level($level = array())
		{
?>			
			<form method="POST" action="<?php echo get_link("Levels","Admin") ?>">
                <?php echo forumulaire_db('Caranille_Levels',$level); ?>
			    <br/>
				<input type="submit" name="Back" value="Annuler" />
		    	<input type="submit" name="End_<?php echo (request_confirm('Add') ? 'Add' : 'Edit') ?>" value="Terminer"/>
				<?php if(request_confirm('Second_Edit')) { ?><input type="submit" name="Second_Delete" value="Supprimer"><?php } ?>
		    </form>
<?php
		}	
		
		if (request_confirm('Auto_Add'))
		{
			$max = get_db("level_max"); 
			
			$confs = list_db("config_curve");
			
			foreach($confs as $c)
				$curve[$c['Configuration_Name']] = $c['Configuration_Value'];
				
			$Level = $max['Level_Number'];
			$Experience = $max['Level_Experience_Required'];
			$HP = $max['Level_HP'];
			$MP = $max['Level_MP'];
			$Strength= $max['Level_Strength'];
			$Magic = $max['Level_Magic'];
			$Agility = $max['Level_Agility'];
			$Defense = $max['Level_Defense'];					
			
			$limit = $max['Level_Number']+$_POST['count_level'];
			
			while ($Level <= $limit)
			{
				$HP += $curve['curve-HP'];
				$MP += $curve['curve-MP'];
				$Strength += $curve['curve-Strength'];
				$Magic += $curve['curve-Magic'];
				$Agility += $curve['curve-Agility'];
				$Defense += $curve['curve-Defense'];
				$Experience += $curve['curve-Experience'];
				
				$Level ++;				
				
				insert_db('Caranille_Levels', array(
					'Level_ID' => $Level ,
					'Level_Number' => $Level,
					'Level_Experience_Required' => $Experience,
					'Level_HP' => $HP,
					'Level_MP' => $MP,
					'Level_Strength' =>$Strength,
					'Level_Magic' => $Magic,
					'Level_Agility' => $Agility,
					'Level_Defense' => $Defense
				));
				
							
			}
		
		}
		
		if (request_confirm('Set_Curve'))
		{
			$max = get_db("level_max"); 
			
			$Level = 1;
			$Experience = 0;
			$HP = 100;
			$MP = 10;
			$Strength= 10;
			$Magic = 10;
			$Agility = 10;
			$Defense = 10;					
			
			do
			{
				update_db('Caranille_Levels', array(
					'Level_ID' => $Level ,
					'Level_Number' => $Level,
					'Level_Experience_Required' => $Experience,
					'Level_HP' => $HP,
					'Level_MP' => $MP,
					'Level_Strength' =>$Strength,
					'Level_Magic' => $Magic,
					'Level_Agility' => $Agility,
					'Level_Defense' => $Defense
				));
				
				$HP += $_POST['HP_Level'];
				$MP += $_POST['MP_Level'];
				$Strength += $_POST['Strength_Level'];
				$Magic += $_POST['Magic_Level'];
				$Agility += $_POST['Agility_Level'];
				$Defense += $_POST['Defense_Level'];
				$Experience += $_POST['Experience_Level'];
				$Level ++;						
			}
			while ($Level <= $max['Level_Number'] );
			
			update_db('Caranille_Configuration',array(
				'Configuration_Name' => 'curve-Experience',
				'Configuration_Value' => $_POST['Experience_Level']
			));
			
			foreach($array_character_type as $type)
				update_db('Caranille_Configuration',array(
					'Configuration_Name' => 'curve-'.$type,
					'Configuration_Value' => $_POST[$type.'_Level']
				));
		}
		if (request_confirm('Delete'))
		{
			delete_db('Caranille_Levels',$_POST);
			$message = 'Le niveau a bien été supprimée';
		}
		if (request_confirm('End_Add'))
		{
			if (valid_post_db('Caranille_Levels'))// (request_confirm('Level_Number') )
			{
				insert_db('Caranille_Levels',addslashes_r($_POST));

				$message = 'niveau ajouté';
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
	}
	
	
?>
