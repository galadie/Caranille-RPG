<?php
	if(verif_access("Admin"))
	{
?>
		<form method="post" action="<?php echo get_link("bdd", "admin")?>">
			<input type="submit" name="Dump_db" value="Sauvegarder" />
			<input type="submit" name="Alter_db" value="MàJ" />
		</form>
<?php
		echo "Voici les MàJ de base de données à faire. Vous pouvez cliquer sur le bouton prevue à cette effet<br>";
		echo "ou les copier/coller dans votre SGBDR.<br/><br/>";
		
		foreach($db_mapping as $table => $r )
		{
			$req = get_alter_req($table,$r);
			if(!is_null($req))
				echo "$req<br/>";
		}
	}