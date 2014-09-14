<?php
	$title = 'Gallery';
	$baseline='';
	
	$images = array();
	
	if($dossier = opendir($_path.'/Design/'.$MMORPG_Template.'Images/Gallery'))
    {
        while(false !== ($fichier = readdir($dossier)))
        {
            if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
            {
                $images[] = $fichier ;
            }
        }
        
        closedir($dossier);

    }
    	
	if(!empty($images))
	{
		echo "<div id='gallery'>";
		foreach($images as $img )
		{
			echo "<a href='".get_link($img,'Gallery')."'>" ;
			echo "<img src='".get_link($img,'Gallery')."' width='200px' height='100px' />" ;
			echo "</a>";
		}
		echo "</div>";
	}
	else
		echo "Captures d'écran indisponibles..."
?>