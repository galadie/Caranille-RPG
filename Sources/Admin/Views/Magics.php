<?php

    if(verif_access("Admin"))
	{
		
		if (request_confirm('Edit'))
		{
            echo 'Voici la liste des Magies du MMORPG<br /><br />';
			
			list_html_db('Caranille_Magics','Magics',array('Magic_Name','Magic_Description','Magic_Type'));
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Magic_ID = request_data('Magic_ID');

			$Magics= get_db("edit_admin",array(
				'table' => 'Caranille_Magics' ,
				'ID' => 'Magic_ID',
				'value' => $Magic_ID
			));
					    
			get_formulaire($Magics);
			
		}
		else
		if (request_confirm('Second_Delete'))
		{
		    			$Magic_ID = request_data('Magic_ID');

?>
            <p>Supprimer definitivement ?</p>
                <form method="POST" action="<?php echo get_link("Magics","Admin") ?>">
				<input type="hidden" name="Magic_ID" value="<?php echo $Magic_ID ?>"/>
				<input type="submit" name="Back" value="Annuler" />
				<input type="submit" name="Delete" value="supprimer" />
				</form>
<?php
		}
		else
		if (request_confirm('Add'))
		{
			get_formulaire();
		}
		else
		//if (empty($_POST['Edit'])&& empty($_POST['Second_Edit']) && (empty($_POST['Add'])))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Magics","Admin").'">';
			echo '<input type="submit" name="Add" value="Ajouter une magie">';
			echo '<input type="submit" name="Edit" value="Modifier une magie">';
			echo '</form>';
		}
	}
