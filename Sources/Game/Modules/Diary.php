<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	$title ="Historique";
	$baseline= "vos actes passés";
	
	load_css('corps.css','corps');
	
	if(request_confirm('edit-role-play'))
	{
	    if(verifier_token(600, get_link('diary','game') , "editor-role-play-".request_post('Diary_ID') ))
	    {
    	    update_db('Caranille_Diaries',array(
    	        
    	        'Diary_Description' => request_post('roleplay'),
    	        'Diary_ID' => request_post('Diary_ID')
    	        
    	    ));
	    }
	}
	
	if(request_confirm('remove-role-play'))
	{
	    if(verifier_token(600, get_link('diary','game') , "remover-role-play-".request_post('Diary_ID') ))
	    {
    	    delete_db('Caranille_Diaries',array(
    	        
    	        'Diary_ID' => request_post('Diary_ID')
    	        
    	    ));
	    }
	}

?>
