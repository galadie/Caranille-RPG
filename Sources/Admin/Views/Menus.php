<?php

	if(verif_access("Admin"))
	{	
		if(empty($_POST) || request_confirm('Back'))//if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && (empty($_POST['Add'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Menus","Admin").'">';
			echo '<input type="submit" name="Add" value="Ajouter un Menu">';
			echo '<input type="submit" name="Edit" value="Modifier un Menu">';
			echo '</form>';
		}
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des Menus du MMORPG<br /><br />';
			
			echo '<table class="Admin list">' ;
				echo '<tr>' ;
				echo '<th>Affiche</th>';
				echo '<th>Position</th>';
				echo '<th>Parent</th>';
				echo '<th>Type</th>';
				echo '<th>Ordre</th>';
				echo '<th>label</th>';
				echo '<th>lien</th>';
				echo '<th><form method="POST" action="'.get_link("Menus","Admin").'">';
			echo '<input type="submit" name="Add" value="Ajouter un menu">';
			echo '</form></th>';
				echo '</tr>' ;

			$Equipment_List = list_db("SELECT * FROM Caranille_Menus order by Menu_Module , Menu_Position, Menu_Parent, Menu_Ordre ");
/**			
			foreach($Equipment_List as $m)
			{
				extract($m);
				
				if($Menu_Type == "Rubrique")
					if(!isset($menus[$Menu_ID]))
						$menus[$Menu_ID] = array("Label" =>  $m , "Links"=> array());
						
				if($Menu_Type == "Lien")
				{					
					if($Menu_Parent!= 0 )
						$menus[$Menu_Parent]["Links"][$Menu_ID] = $m;
					else	
						$menus["Direct_Links"][$Menu_ID] = $m ;
					
				}
			}
			
			foreach($menus as $id => $rub)
			{		
				echo '<tr>' ;
				if($id != "Direct_Links")
				{
					extract($rub);
					
					echo "<li><a href='#'><div class='important'>$Label</div></a>";
					echo "<ul>";
					foreach( $Links as $mention => $lien )
						echo '<li><a href="'.get_link($lien[0],$lien[1]).'">'.$mention.'</a></li>';
					echo "</ul>";
					echo "</li>";
				}
				else
				{
					//print_r($rub);
					foreach( $rub as $mention => $lien )
						echo '<li><a href="'.get_link($lien[0],$lien[1]).'">'.$mention.'</a></li>';
				}
				echo '<td><form method="POST" action="'.get_link("Menus","Admin").'">';
				echo "<input type=\"hidden\" name=\"Menu_ID\" value=\"$Menu_ID\">";
				echo '<input type="submit" name="Second_Edit" value="modifier">';
				echo '<input type="submit" name="Second_Delete" value="supprimer">';
				echo '</form></td>';				
				echo '</tr>' ;
			}
**/			
			foreach ($Equipment_List as $Equipment)
			{
				$Menu_ID = stripslashes($Equipment['Menu_ID']);
				echo '<tr>' ;
				echo '<td>' .stripslashes($Equipment['Menu_Affiche'])."</td>";
				echo '<td>' .stripslashes($Equipment['Menu_Position'])."</td>";
				echo '<td>' .stripslashes($Equipment['Menu_Parent'])."</td>";
				echo '<td>' .stripslashes($Equipment['Menu_Type'])."</td>";
				echo '<td>' .stripslashes($Equipment['Menu_Ordre'])."</td>";
				echo '<td>' .stripslashes($Equipment['Menu_Label'])."</td>";
				echo '<td>(' .stripslashes($Equipment['Menu_Link']).',' .stripslashes($Equipment['Menu_Module']).")</td>";
				
				echo '<td><form method="POST" action="'.get_link("Menus","Admin").'">';
				echo "<input type=\"hidden\" name=\"Menu_ID\" value=\"$Menu_ID\">";
				echo '<input type="submit" name="Second_Edit" value="modifier">';
				echo '<input type="submit" name="Second_Delete" value="supprimer">';
				echo '</form></td>';
				echo '</tr>' ;
			}
				echo '</table>' ;
			
			//list_html_db('Caranille_Menus','Menus',array('Menu_Parent','Menu_Label','Menu_Link'));

		}
		if (request_confirm('Second_Edit'))
		{
			$Menu_ID = request_data('Menu_ID');

			$Menu_List = get_db("SELECT * FROM Caranille_Menus WHERE Menu_ID = '$Menu_ID' limit 1");

			get_formulaire_Menu($Menu_List);

		}
		if (request_confirm('Second_Delete'))
		{
			$Menu_ID = request_data('Menu_ID');
			confirm_remove_db('Caranille_Menus',"Menus",$Menu_ID);

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Menus","Admin") ?>">
				<input type="hidden" name="Menu_ID" value="<?php echo $Menu_ID ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
		if (request_confirm('Add'))
		{
			get_formulaire_Menu();
		}
		
		
		if(isset($message) && $message !=="")
		{
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link("Menus","Admin") ?>">
			<input type="hidden" name="Menu_ID" value="<?php echo $Menu_ID ?>"/>
			<input type="submit" name="Second_Edit" value="modifier"/>
			<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
<?php
		}
	}
?>

<!--<?php
	$mods =	list_modules();
	$pos = list_positions();
?>
<table>
<?php
	foreach($mods as $module)
	{
?>
							<tr>
								<th colspan="4"><?php echo $module ?></th>
							</tr>
<?php		
		$menus = list_menu($module);

		foreach($pos as $position)
		{	
?>
							<tr>
								<th></th>
								<th colspan="3"><?php echo $position ?></th>
							</tr>
<?php				$rubs = list_db("select distinct Menu_Rubrique from Caranille_Menu where Menu_Module = '$module' and Menu_Position = '$position' order by Menu_Rubrique ASC");
			
			if(!empty($rubs))
			{	
				foreach($rubs as $rubrique)
				{
					extract($rubrique);
					
?>
							<tr>
								<th></th>
								<th></th>
								<th colspan="2" ><?php echo $Menu_Rubrique ?></th>
							</tr>
<?php					$links = list_db("select distinct Menu_Link from Caranille_Menu where Menu_Module = '$module' and Menu_Position = '$position' and Menu_Rubrique = '$Menu_Rubrique' order by Menu_Rubrique ASC");
					
					if(!empty($links))
					{	
						foreach($links as $lien)
						{
							extract($lien);

?>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th><?php echo $Menu_Label ?></th>
								<th>
									<select></select>
								</th>
							</tr>
<?php
						}
					}
				}
			}
?>
			<tr>
				<th></th>
				<th></th>
				<td colspan="2">
					<form method="post">
						<input type="text" value="Ajouter" />
						<input type="submit" value="Ajouter" />
					</form>
				</td>
			</tr>
<?php
		}
?>
		<tr><td colspan="4" class="none"></td></tr>
<?php		
	}
?>
</table>-->