<?php  
  
	load_css('forum.css','forum');
	
	if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
			$titre = "Forum";

			$baseline ='<i>Vous êtes ici : </i><a href ="'.get_link('Main','Guild').'">Index du forum de guilde</a>';
			
			debug_log("guild forum main => ".print_r($_POST,1));
			
			if (request_confirm('End_Add_Cat'))
			{
				if(has_guild_acces('forum')) 
				{
					if (valid_Post_db('Caranille_Categories'))// (request_confirm('Category_Number') && ($_POST['Category_Name']) && ($_POST['Category_Opening']) && ($_POST['Category_Ending']) && ($_POST['Category_Defeate']))
					{
						insert_db('Caranille_Categories',addslashes_r($_POST));

						$message = 'page ajouté';
					}
					else
					{
						$message = 'Tous les champs n\'ont pas été remplis';
					}	
				}
			}
		
			if (request_confirm('End_Add_Forum'))
			{
				if(has_guild_acces('forum')) 
				{
					debug_log( " - has_guild_acces ");
					
					insert_db('Caranille_Forums',addslashes_r($_POST));

					$message = 'page ajouté';
				}
			}
		}
	}
?>