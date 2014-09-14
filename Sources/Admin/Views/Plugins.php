<form method="POST" action="<?php echo get_link("Plugins","Admin") ?>">
<?php
if(verif_access("Admin"))
{
	$f = list_plugings_db();
	$l = list_plugins_installed();
			

	if(!empty($l))
	{
		foreach ($l as $r => $p)
		{
			$active = false;
			
			if(!empty($f))
				foreach($f as $record)
					if($record['Plugin_Name'] == $p)
						$active = true;
						
			echo "name : <input placeholder='nom' size=25 type='text' value='".$p."' name='plugin[$p][nom]' />"; // Le champ de texte du commentaire
			echo "active : <input type='checkbox' ".($active ? "checked='checked'" : '')." name='plugin[$p][active]'/>"; 
			
			//echo "<input type='submit' value='&check;' name='plugin[$p][modifier]'/>";
			//echo "<input type='submit' value='&cross;' name='plugin[$p][supr]'/>";
			
			echo "<br />";
		}
	}
}
?>
<input type="submit" value="valider" name="confirm"/>
</form>