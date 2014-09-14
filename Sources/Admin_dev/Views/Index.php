<?php
	if(verif_access("Admin"))
	{
		$table = $page ;

		if (empty($_POST['Edit']) && empty($_POST['Add']) && empty($_POST['Second_Add']) && empty($_POST['Second_Edit']) && empty($_POST['End_Edit']) && (empty($_POST['Delete'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link($table."s","Admin").'">';
			echo '<input type="submit" name="Edit" value="Modifier une '.$table.'">';
			echo '</form>';
			
			echo "
<p style='text-align:left;'>La fonction essentielle d'Une $table institutionnel n’est pas une fonction de jeux, mais une fonction de communication informative.</p>
<p style='text-align:left;'>ses contenus sont donc destinés essentiellement :
<br/>- aux partenaires divers de votre site 
<br/>- aux individus à la recherche d’informations diverses sur le site ou le jeu 
<br/>- aux investisseurs, actionnaires et analystes financiers 
<br/>- à la presse 
<br/>- aux personnes à la recherche d’emploi ou de stages 
<br/>- .....</p>
<p style='text-align:left;'>Les principales rubriques et contenus dans ces ".$table."s institutionnel sont généralement :
<br/>- la présentation et l’organisation de l’activité 
<br/>- les hommes et chiffres clés de l’activité 
<br/>- l’information financière (cours de bourse, information financière obligatoire,..) 
<br/>- la rubrique emploi / stages 
<br/>- la rubrique presse 
<br/>- l’historique de la société 
<br/>- les engagements et fondations d’entreprises 
<br/>- ...</p>
			";
			
		}
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des '.$table.'s du MMORPG<br /><br />';
			
			list_html_db('Caranille_'.$table.'s',$table.'s',array($table.'_Title',$table.'_Description',$table.'_Order'));
			
		}
		if (request_confirm('Second_Edit'))
		{
		    $table_ID = request_data($table.'_ID');

			$table_r = get_db("edit_admin",array(
				'table' => 'Caranille_'.$table.'s' ,
				'ID' => $table.'_ID',
				'value' => $table_ID
			));
			
			formulaire($table_r);

		}
		
		if (request_confirm('Second_Delete'))
		{
		    $table_ID = request_data($table.'_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link($table."s","Admin") ?>">
				<input type="hidden" name="<?php echo $table.'_ID' ?>" value="<?php echo eval("return \$".$table."_ID"); ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
		
		if (request_confirm('Add'))
		{
			formulaire();
		}
		
		
		if(isset($message) && $message !=="")
		{
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link("$tables","Admin") ?>">
			<input type="hidden" name="<?php echo $table.'_ID' ?>" value="<?php echo eval("return \$".$table."_ID"); ?>"/>
			<input type="submit" name="Second_Edit" value="modifier"/>
			<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
<?php
		}
	}
?>