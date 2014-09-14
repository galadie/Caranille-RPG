<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$title ="";
	//$baseline= ""
	include_once("Battle/Index.php");//(path_source("Index","Battle","Battle"));
	
	if(verif_connect())
	{
		$roaster = get_roaster();
		
		if (request_confirm('Launch'))
		{
			if(verifier_token(60, get_link('Story','Battle') ,  'Story'))
	        {
    	        extract($_POST); 

    			$Chapter_Monster = get_db('story_step_content',array('Chapter_Number'=>$Chapter_Number));
				
    			if(!empty($Chapter_Monster))
    			{
    			    init_battle('Monster',$Chapter_Monster,'Chapter');
    			    
					$launch = true ;
    			}
	        }
		}
	}
	
	
?>
