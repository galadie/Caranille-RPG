<?php

	if(verif_access("Admin"))
	{
	
		if (request_confirm('Edit'))
		{
			echo 'Voici la liste des news du MMORPG<br /><br />';
			list_html_db('Caranille_Comments','Comments',array('Comment_Date','Comment_Account_Pseudo','Comment_Message','Comment_News_ID'));
		}
		else
		if (request_confirm('Second_Edit'))
		{
			$Comment_ID = request_data('Comment_ID');

			$Comment_List = get_db("edit_admin",array(
				'table' => 'Caranille_Comments' ,
				'ID' => 'Comment_ID',
				'value' => $Comment_ID
			));
			
			get_formulaire($Comment_List);
		}
		else
		//if (empty($_POST['Edit']) && empty($_POST['Second_Edit']) && empty($_POST['Add']) && empty($_POST['End_Add']))
		{
			echo 'Que souhaitez-vous faire ?<br />';
			echo '<form method="POST" action="'.get_link("Comments","Admin").'">';
			echo '<input type="submit" name="Edit" value="Modifier un Comment">';
			echo '</form>';
		}
	}
?>