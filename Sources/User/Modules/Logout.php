<?php
	// l'utilisateur peut ajouter un titre pour chaque module different de Caranille -Accueil
	//$title ="";
	//$baseline= ""
	
	if(verif_connect()) 
	{
    	session_destroy();
		header('location:'.get_link());
	}
?>
