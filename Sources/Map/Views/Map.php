<?php
	if(verif_connect()) 
	{
		if ($_SESSION['Town'] == 0)
		{	
			if (request_confirm('Exit_Town'))
			{
				echo '<p>'.$message.'<br/><br/>';			
				echo '<form method="POST" action="'.get_link('Map','Map').'">';
				echo '<input type="submit" name="carte" value="Continuer">';
				echo '</form></p>';
			}

			if (empty($_POST))//['entrer_Town']))
			{	
				bousole("Map");
				
				include_once(path_source("map-2","Map","Map"));
			}
		}
		if ($_SESSION['Town'] == 1)
		{
			if (request_confirm('Exit_Town'))
			{
				echo '<p>'.$message.'<br/><br/>';			
				echo '<form method="POST" action="'.get_link('Map','Map').'">';
				echo '<input type="submit" name="carte" value="Retourner à la carte du monde">';
				echo '<input type="hidden" name="token" value="'.generer_token('carte').'" />';
				echo '</form></p>';
			}
			
			if (empty($_POST))//['Exit_Town']))
			{
				$Town_Image = htmlspecialchars(addslashes($_SESSION['Town_Image']));
				
				menu_town();
			
				bousole("Town");
 				
				include_once(path_source("map-1","Map","Map"));

				
				//if(file_exists($_path."Sources/Game/Modules/Map/map-1.php"))
				//	include_once($_path."Sources/Game/Modules/Map/map-1.php");
			    //else
			    //     echo 'carte indisponible';
			
				echo '<div style="float:left; margin-left:35px">';
				
				echo "<img src=\"$Town_Image\"><br />";
				echo "" .$_SESSION['Town_Description']. "<br /><br />";
/*
				echo '<a href="'.get_link('Dungeon','Battle').'">S\'entrainer</a><br />';
				echo '<a href="'.get_link('Mission','Battle').'">Les missions</a><br />';
				echo '<a href="'.get_link('QuestBoard','Game').'">Tableaux des Quetes</a><br />';
				echo '<a href="'.get_link('Weapon_Shop','Game').'">Boutique d\'armes</a><br />';
				echo '<a href="'.get_link('Accessory_Shop','Game').'">Boutique d\'accessoire</a><br />';
				echo '<a href="'.get_link('Magic_Shop','Game').'">Boutique de magie</a><br />';
				echo '<a href="'.get_link('Item_Shop','Game').'">Boutique d\'objets</a><br />';
				echo '<a href="'.get_link('Temple','Game').'">Le temple</a><br />';
				echo '<a href="'.get_link('Inn','Game').'">L\'auberge</a><br /><br />';
*/				
				echo '<form method="POST" action="'.get_link('Map','Map').'">';
				echo '<input type="submit" name="Exit_Town" value="Quitter la Ville">';
    		    echo '<input type="hidden" name="token" value="'.generer_token('Exit_Town-'.$_SESSION['Town_ID']).'" />';
				echo '</form>';
				
				echo '</div>';
			
			}
		}	
		
?>
		<div style="position:fixed;top:320px;right:330px;width:200px;display:block">
		<?php if(isset($message)) echo $message ?>
		<br><br>
		La carte vous montrera tous les lieux où vous pouvez aller que çe soit pour vous balader ou pour une mission<br /><br />
		</div>	
<?php
	}
?>