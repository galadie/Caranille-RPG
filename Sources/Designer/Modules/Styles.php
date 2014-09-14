<?php
	if(confirm_request('modif'))
	{
?>
	<a href="css.php">Index css</a>
<code type="html"><form method="POST" action="css.php">
Commentaires : <input type="text" name="commentaire" size=25/><br />
Code : <br /><textarea name="code" cols=30 rows=8></textarea><br />
<input type="submit" value="Rajouter" name="rajout"/>
<?php
	}
	
	if(confirm_request('modif'))
	{
?>
		<form method="POST" action="css.php">
		<?php
		$retour=mysql_query('SELECT * FROM css');// On récupère les entrées
		$id=0;
		 
		while ($donnees=mysql_fetch_array($retour))
		{
				echo "<input size=25 type='text' value='".$donnees['commentaire']."' name='style[$id][commentaire]' />"; // Le champ de texte du commentaire
				echo "<a href='css.php?supr=".$donnees['id']."'>Supprimer</a><br />"; // Le lien pour supprimer un code   
				echo "<textarea name='style[$id][code]' cols=30 rows=8>".$donnees['code']."</textarea><br/>"; // Un textarea qui contiendra le code
				echo "<input type='hidden' name='style[$id][id]' value='".$donnees['id']."' />"; // Un champ caché pour récupérer l'id du code
				echo "<br /><br />";
				$id++;
		}
		?>
		<input type="submit" value="Modifier" name="modifier"/>
		</form>
<?php

	}
	
?>