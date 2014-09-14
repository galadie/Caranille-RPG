<?php
		//	print_r($_POST);
	
	//On commence par s'assurer que le membre est connecté
	if(verif_connect()) 
	{
		if (request_confirm('Finish'))
		{
		    extract(addslashes_r($_POST));

		    if(verifier_token(60, get_link('Profil','User') ,  'Character-Password'))
	        {
    			$return = "";
				
				if ($New_Password == $New_Password_Confirmation)
    			{
    				// reencodage du mot de passe avec une nouvelle clé
    				$r['Account_ID'] = user_data('Account_ID');
    				$r['Account_Salt'] = uniqid();
    				$r['Account_Password'] = password_encode($prefixe_salt.$r['Account_Salt'].$suffixe_salt, $New_Password  );
    				
    				if(update_db('Caranille_Accounts',addslashes_r($r)))
    				{
    				    $_return .= 'Votre mot de passe à bien été modifié';
    			    	$_return .= '<form method="POST" action="'.get_link("Character","Game").'"><br />';
    				    $_return .= '<input type="submit" name="Cancel" value="Retour">';
    				    $_return .= '</form>';
    				}
    			}
    			else
    			{
    				$_return .= 'Les deux mots de passe ne sont pas identiques';
    				$_return .= '<form method="POST" action="'.get_link("Character","Game").'"><br />';
    				$_return .= '<input type="submit" name="Cancel" value="Retour">';
    				$_return .= '</form>';
    			}
	        }
	        else
	        $_return .= "erreur sur le token";
		}
		
		if (request_confirm('sent'))
		{
			//On déclare les variables 

			$_return = "";
			
			$signature_erreur = NULL;
			$avatar_erreur = NULL;
			$avatar_erreur1 = NULL;
			$avatar_erreur2 = NULL;
			$avatar_erreur3 = NULL;

			//Encore et toujours notre belle variable $i :p
			$i = 0;
			$temps = time(); 
			$signature = request_post('signature');

			//Vérification de la signature
			if (strlen($signature) > 200)
			{
				$signature_erreur = "Votre nouvelle signature est trop longue";
				$i++;
			}
			else
			{
				user_set('Account_Signature',$signature);
			}
		 
			//Vérification de l'avatar
		 
			if (!empty($_FILES['avatar']['size']))
			{
				//Liste des extensions valides
				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'bmp' );
				$e_av = false ;
				if ($_FILES['avatar']['error'] > 0)
				{
					$avatar_erreur = "Erreur lors du tranfsert de l'avatar : ";
					$e_av = true ;
				}
				
				if ($_FILES['avatar']['size'] > $avatar_maxsize)
				{
					$i++;
					$e_av = true ;
					$avatar_erreur1 = "Le fichier est trop gros :
					(<strong>".$_FILES['avatar']['size']." Octets</strong>
					contre <strong>".$avatar_maxsize." Octets</strong>)";
				}
		 
				$image_sizes = getimagesize($_FILES['avatar']['tmp_name']);
				if ($image_sizes[0] > $avatar_maxl OR $image_sizes[1] > $avatar_maxh)
				{
					$i++;
					$e_av = true ;
					$avatar_erreur2 = "Image trop large ou trop longue :
					(<strong>".$image_sizes[0]."x".$image_sizes[1]."</strong> contre
					<strong>".$avatar_maxl."x".$avatar_maxh."</strong>)";
				}
		 
				$extension_upload = strtolower(substr(  strrchr($_FILES['avatar']['name'], '.')  ,1));
				if (!in_array($extension_upload,$extensions_valides) )
				{
						$i++;
						$e_av = true ;
						$avatar_erreur3 = "Extension de l'avatar incorrecte";
				}
				
				if (!$e_av)
				{
					$ft = fopen($_FILES['avatar']['tmp_name'], "r");
					$imgbinary = fread( $ft , filesize($_FILES['avatar']['tmp_name']));
					$data = base64_encode($imgbinary);
		
					$nomavatar= 'data:' . $_FILES['avatar']['type'] . ';base64,' .$data ; //move_avatar($_FILES['avatar']);
					
					user_set('Account_Avatar',$nomavatar);
				}
			}
			elseif (request_confirm('delete'))
			{
				user_set('Account_Avatar',"");
			}
			
			$_return .= '<p><i>Vous êtes ici</i> : <a href="./index.php">Index du forum</a> --> Modification du profil';
			$_return .= '<h1>Modification d\'un profil</h1>';

			if ($i == 0) // Si $i est vide, il n'y a pas d'erreur
			{
				$_return .='<h1>Modification terminée</h1>';
				$_return .='<p>Votre profil a été modifié avec succès !</p>';
				$_return .='<p>Cliquez <a href="./index.php">ici</a> pour revenir à la page d accueil</p>';
			}
			else
			{
				$_return .='<h1>Modification interrompue</h1>';
				$_return .='<p>Une ou plusieurs erreurs se sont produites pendant la modification du profil</p>';
				$_return .='<p>'.$i.' erreur(s)</p>';
				$_return .='<p>'.$signature_erreur.'</p>';
				$_return .='<p>'.$avatar_erreur.'</p>';
				$_return .='<p>'.$avatar_erreur1.'</p>';
				$_return .='<p>'.$avatar_erreur2.'</p>';
				$_return .='<p>'.$avatar_erreur3.'</p>';
				$_return .='<p> Cliquez <a href="./voirprofil.php?action=modifier">ici</a> pour recommencer</p>';
			}
			
			user_record();

		}
	}
?>