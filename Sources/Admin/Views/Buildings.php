<?php

	if(verif_access("Admin"))
	{
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des Batiments du MMORPG<br /><br />';
			
			list_html_db('Caranille_Building','Buildings',array('Building_Number','Building_Name'));
		}
		elseif (request_confirm('Second_Edit'))
		{
			$Building_ID = request_data('Building_ID');

			$Building_List = get_db("edit_admin",array(
				'table' => 'Caranille_Building' ,
				'ID' => 'Building_ID',
				'value' => $Building_ID
			));
			
			get_formulaire_Building($Building_List);

		}
		elseif (request_confirm('Second_Delete'))
		{
		    			$Building_ID = request_data('Building_ID');

?>
            <p>Supprimer definitivement ?</p>
			<form method="POST" action="<?php echo get_link('Buildings','Admin') ?>">
				<input type="hidden" name="Building_ID" value="<?php echo $Building_ID ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
			</form>
<?php
		}
		elseif (request_confirm('Add'))
		{
			get_formulaire_Building($_POST);
		}
		else//		if(empty($_POST) || request_confirm('Back'))//if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && (empty($_POST['Add'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link('Buildings','Admin').'">';
			echo '<input type="submit" name="Add" value="Ajouter un Batiment">';
			echo '<input type="submit" name="Edit" value="Modifier un Batiment">';
			echo '</form>';
		}
		
		
		if(isset($message) && $message !=="")
		{
			$Building_ID = request_data('Building_ID');
			$Town_ID = request_data('Building_Town_ID');
			
			echo $message ;
?>
			<form method="POST" action="<?php echo get_link('Buildings','Admin') ?>">
				<input type="hidden" name="Building_ID" value="<?php echo $Building_ID ?>"/>
				<input type="submit" name="Second_Edit" value="modifier"/>
				<input type="submit" name="Back" value="Revenir à la liste" />
			</form>
			<form method="POST" action="<?php echo get_link('Towns','Admin') ?>">
				<input type="hidden" name="Town_ID" value="<?php echo $Town_ID ?>"/>
				<input type="submit" name="Second_Edit" value="revenir à la ville"/>
			</form>
<?php
		}
	}