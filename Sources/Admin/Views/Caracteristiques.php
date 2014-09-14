<?php

	if(verif_access("Admin"))
	{	
		
		
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des Caracteristiques du MMORPG<br /><br />';
			
			list_html_db('Caranille_Caracteristiques','Caracteristiques',array('Caracteristique_Type','Caracteristique_Name','Caracteristique_Opposant','Caracteristique_Order'));

		}
		elseif (request_confirm('Second_Edit'))
		{
			$Caracteristique_ID = request_data('Caracteristique_ID');

			$Caracteristique_List = get_db("edit_admin",array(
				'table' => 'Caranille_Caracteristiques' ,
				'ID' => 'Caracteristique_ID',
				'value' => $Caracteristique_ID
			));
			
			get_formulaire_Caracteristique($Caracteristique_List);

		}
		elseif (request_confirm('Second_Delete'))
		{
			$Caracteristique_ID = request_data('Caracteristique_ID');
			confirm_remove_db('Caranille_Caracteristiques',"Caracteristiques",$Caracteristique_ID);

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Caracteristiques","Admin") ?>">
				<input type="hidden" name="Caracteristique_ID" value="<?php echo $Caracteristique_ID ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
		elseif (request_confirm('Add'))
		{
			get_formulaire_Caracteristique();
		}
		else//if(empty($_POST) || request_confirm('Back'))//if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && (empty($_POST['Add'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Caracteristiques","Admin").'">';
			echo '<input type="submit" name="Add" value="Ajouter un Caracteristique">';
			echo '<input type="submit" name="Edit" value="Modifier un Caracteristique">';
			echo '</form>';
		}
		
		if(isset($message) && $message !=="")
		{
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link("Caracteristiques","Admin") ?>">
			<input type="hidden" name="Caracteristique_ID" value="<?php echo $Caracteristique_ID ?>"/>
			<input type="submit" name="Second_Edit" value="modifier"/>
			<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
<?php
		}
	}