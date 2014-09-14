<?php

	if(verif_access("Admin"))
	{	
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des chapitres du MMORPG<br /><br />';
			
			list_html_db('Caranille_Chapters','Chapters',array('Chapter_Number','Chapter_Name'));

		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Chapter_ID = request_data('Chapter_ID');

			$Chapter_List = get_db("edit_admin",array(
				'table' => 'Caranille_Chapters' ,
				'ID' => 'Chapter_ID',
				'value' => $Chapter_ID
			));
			
			get_formulaire_chapter($Chapter_List);

		}
		else
		if (request_confirm('Second_Delete'))
		{
			$Chapter_ID = request_data('Chapter_ID');
			confirm_remove_db('Caranille_Chapters',"Chapters",$Chapter_ID);

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Chapters","Admin") ?>">
				<input type="hidden" name="Chapter_ID" value="<?php echo $Chapter_ID ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
		else
		if (request_confirm('Add'))
		{
			get_formulaire_chapter();
		}
		else//if(empty($_POST) || request_confirm('Back'))//if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && (empty($_POST['Add'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Chapters","Admin").'">';
			echo '<input type="submit" name="Add" value="Ajouter un chapitre">';
			echo '<input type="submit" name="Edit" value="Modifier un chapitre">';
			echo '</form>';
		}

		
		if(isset($message) && $message !=="")
		{
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link("Chapters","Admin") ?>">
			<input type="hidden" name="Chapter_ID" value="<?php echo $Chapter_ID ?>"/>
			<input type="submit" name="Second_Edit" value="modifier"/>
			<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
<?php
		}
	}