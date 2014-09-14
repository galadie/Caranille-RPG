

<form method="POST" action="<?php echo get_link("Styles","Admin") ?>">

<?php
if(!empty($retour))
{
	foreach ($retour as $donnees)
	{
		$id = $donnees['Style_ID'] ;
		
		echo "Commentaires : <input placeholder='Commentaires'  size=25 type='text' value='".$donnees['Style_Commentaire']."' name='style[$id][Style_Commentaire]' /><br/>"; // Le champ de texte du commentaire
		echo "Code : <textarea placeholder='Code' name='style[$id][Style_Code]' cols=30 rows=8>".$donnees['Style_Code']."</textarea><br/>"; // Un textarea qui contiendra le Style_Code
		echo "<input type='submit' value='&check;' name='modifier'/>";
		echo "<input type='submit' value='&cross;' name='supr'/>";
		echo "<br /><br />";
	}
}
?>

Commentaires : <input placeholder="Commentaires" type="text" name="style[0][Style_Commentaire]" size=25/><br />
Code : <br /><textarea placeholder="Code" name="style[0][Style_Code]" cols=30 rows=8></textarea><br />
<input type="submit" value="Rajouter" name="rajout"/>

</form>
