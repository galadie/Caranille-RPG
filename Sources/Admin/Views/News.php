<?php

	if(verif_access("Admin"))
	{	
		if (request_confirm('Edit'))
		{
            echo 'Voici la liste des News du MMORPG<br /><br />';
			
			list_html_db('Caranille_News','News',array('News_Title','News_Date','News_Account_Pseudo'));
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$News_ID = request_data('News_ID');

			$News_List= get_db("edit_admin",array(
				'table' => 'Caranille_News' ,
				'ID' => 'News_ID',
				'value' => $News_ID
			));

			get_formulaire($News_List);
		}
		else
		if (request_confirm('Second_Show'))
		{
			$News_List= get_db("edit_admin",array(
				'table' => 'Caranille_News' ,
				'ID' => 'News_ID',
				'value' => request_data('News_ID')
			));

			echo show_db('Caranille_News',$News_List);
		}
		else
		if (request_confirm('Add'))
		{
			get_formulaire();
		}
		else
		//if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && empty($_POST['Add']) && empty($_POST['End_Add']))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("News","Admin").'">';
			echo '<input type="submit" name="Add" value="Ajouter une News">';
			echo '<input type="submit" name="Edit" value="Modifier une News">';
			echo '</form>';
		}
	}
?>