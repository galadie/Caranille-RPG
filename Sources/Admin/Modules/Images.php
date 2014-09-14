<?php

function base64_encode_image ($filename=string,$filetype=string) {
    if ($filename) {
        $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
    }
}

function get_mime_type($filename)
{
	$finfo = finfo_open(FILEINFO_MIME_TYPE); // Retourne le type mime à la extension mimetype
	$mime = finfo_file($finfo, $filename);
	finfo_close($finfo);

	return $mime ;
}

function isExtAuthorized( $ext, $authExt )
{
	//debugLog($ext, __FILE__, __LINE__);
	$ext = strtolower($ext);
	if( in_array($ext, $authExt) || $authExt == array("*.*") )
		return true;
	else
		return false;
}

function resize($key)
{
	// Target dimensions
	global $avatar_maxsize,$avatar_maxh,$avatar_maxl ;
	
	if (function_exists("gd_info")) 
	{
		// Check if file was uploaded ok
		if( ! is_uploaded_file($_FILES['image']['tmp_name']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK)
		{
			exit('File not uploaded. Possibly too large.');
		}
		// Create image from file
		switch(strtolower($_FILES['image']['type']))
		{
			case "image/jpg":
			case "image/jpeg":
			case "image/pjpeg": //IE's weird jpeg MIME type		
				$image = imagecreatefromjpeg($_FILES['image']['tmp_name']);
				break;
			case 'image/png':
				$image = imagecreatefrompng($_FILES['image']['tmp_name']);
				break;
			case 'image/gif':
				$image = imagecreatefromgif($_FILES['image']['tmp_name']);
				break;
			default:
				exit('Unsupported type: '.$_FILES['image']['type']);
		}

		list($width,$height) = getimagesize($fn);
		
		$ratio = $width/$height ;
		
		if( $ratio > 1) {
			$width = $avatar_maxl;
			$height = $avatar_maxh/$ratio;
		}
		else {
			$width = $avatar_maxl*$ratio;
			$height = $avatar_maxh;
		}
		
		// Create new empty image
		$new = imagecreatetruecolor($new_width, $new_height);

		// Resize old image into new
		imagecopyresampled($new, $image, 
			0, 0, 0, 0, 
			$new_width, $new_height, $old_width, $old_height);
			
		// Catch the imagedata
		ob_start();
		
		switch(strtolower($_FILES['image']['type']))
		{

			case "image/jpg":
			case "image/jpeg":
			case "image/pjpeg": //IE's weird jpeg MIME type			
				imagejpeg($new, NULL, 90);
				break;
			case 'image/png':
				imagepng($new,NULL);
				break;
			case 'image/gif':
				imagegif($new,NULL);
				break;
			default:
				exit('Unsupported type: '.$_FILES['image']['type']);
		}
		
		$data = ob_get_clean();
		
			// Destroy resources
		imagedestroy($image);
		imagedestroy($new);
		
		return $data ;
	}
	
	return false ;
}	
function record_file($key, $authExt = array("*.*"))
{
	global $avatar_maxsize,$avatar_maxh,$avatar_maxl ;
		
	if(isset($_FILES[$key]))
	{
		for($i=0; $i< count($_FILES[$key]['name']) ; $i++) 
		{
			// Nom temporaire sur le serveur:
			$nomUtilisateur = $_FILES[$key]["name"][$i] ;
			// Type du fichier choisi:
			$typeFichier = $_FILES[$key]["type"][$i] ;
			// Poids en octets du fichier choisit:
			$poidsFichier = $_FILES[$key]["size"][$i] ;
			// Code de l'erreur si jamais il y en a une:
			$codeErreur = $_FILES[$key]["error"][$i] ;
			// Contenu du fichier
			$dataFichier = $_FILES[$key]["tmp_name"][$i] ;

			if($codeErreur > 0 ) return $codeErreur;
					
			$image_sizes = getimagesize($dataFichier);
			
			if($poidsFichier <= 0)// Si le poids du fichier est de 0 bytes, le fichier est invalide (ou le chemin incorrect) => message d'erreur
				return 13 ;
							
			if($avatar_maxsize > 0)
			{						
				if($poidsFichier >= $avatar_maxsize) // Si la taille du fichier est suprieure  la taille maximum spcifie => message d'erreur
					return 12 ;
			}
			
			if($avatar_maxh > 0 && $avatar_maxl > 0 )
			{
				if ($image_sizes[0] > $avatar_maxl OR $image_sizes[1] > $avatar_maxh)
					return 9 ;
			}
			
			if(!isExtAuthorized($typeFichier, $authExt)) // On teste ensuite si le fichier a une extension autorise
				return 11 ;
			
			if(!is_uploaded_file($dataFichier ))
				return 10 ;

			$ft = fopen($dataFichier, "r");
			$imgbinary = fread( $ft , filesize($dataFichier));
			$data = base64_encode($imgbinary);
			
			insert_db('Caranille_Images', array('Image_Base64'=>$data, 'Image_Name'=>$nomUtilisateur, 'Image_Type'=>$typeFichier)); //, 'Image_ID'=>$DocID));
		}	
		return 0;
	}	
}

	if(verif_access("Admin"))
	{
		
		if (request_confirm('Delete'))
		{
			$Image_ID = htmlspecialchars(addslashes($_POST['Image_ID']));

			delete_db('Caranille_Images',array('Image_ID'=> $Image_ID));
			
			$message = 'Le Batiment a bien été supprimée';
		
		}
		
		if(request_confirm('End_Edit'))
		{
			foreach($_POST as $key => $value)
			{
				$c = count_db("edit_admin",array(
					'table' => 'Caranille_Configuration' ,
					'ID' => 'Configuration_Name',
					'value' => $key
				));
			//"select * from  where  ='$' limit 1");
				
				if($c == 1)
					update_db('Caranille_Configuration',addslashes_r(array( 'Configuration_Name' => $key , 'Configuration_Value' => $value )));
				else
					insert_db('Caranille_Configuration',addslashes_r(array( 'Configuration_Name' => $key , 'Configuration_Value' => $value )));
			}
		}
		
		if (request_confirm('End_Add'))
		{		    
			if (valid_post_db('Caranille_Images'))// (request_confirm('Image_Type') && ($_POST['Image_Town_ID']) && ($_POST['Image_PosX']) && ($_POST['Image_PosY']) )
			{
				$r = record_file('caranille_image', array("*.*") );

				if($r == 0)
					$message = 'Batiment ajouté';
				else
				{
					if($r == 1) $message = "La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini.";
					if($r == 2) $message = "La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE($avatar_maxsize), qui a été spécifiée dans le formulaire HTML.";
					if($r == 3) $message = "Le fichier n'a été que partiellement téléchargé.";
					if($r == 4) $message = "Aucun fichier n'a été téléchargé.";
					if($r == 6) $message = "Un dossier temporaire est manquant. Introduit en PHP 5.0.3.";
					if($r == 7) $message = "Échec de l'écriture du fichier sur le disque. Introduit en PHP 5.1.0.";
					if($r == 8) $message = "Une extension PHP a arrêté l'envoi de fichier. PHP ne propose aucun moyen de déterminer quelle extension est en cause. L'examen du phpinfo() peut aider. Introduit en PHP 5.2.0.";
				}
			}
			else
			{
				$message = 'Tous les champs n\'ont pas été remplis';
			}	
		}
		
		$list_img = list_db("list_t",array( 'table' => "Caranille_Images"));
	}
