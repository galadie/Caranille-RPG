<?php    
 
/****************************** login.php *******************************************************/
// les cookies ne fonctionnent pas vraiment .....
function brute_force_authorized_login()
{
    	// Si le cookie n'existe pas 
	if(!isset($_COOKIE['marqueur-try-connect']))
	{
	    return true ;
	}
	// Si le cookie existe
    else
    {
        // Si le temps de blocage a été dépassé
        if($_COOKIE['marqueur-try-connect'] < time())
        {
            setcookie("marqueur-try-connect", "", 0);
        }
            
        return false ;
    }
}

function brute_force_clear_limit()
{
    // Si on a dépassé le temps de blocage
    if(isset($_SESSION['nombre']) and $_SESSION['timestamp_limite'] < time())
    {
        // Destruction des variables de session
        unset($_SESSION['nombre']);
        unset($_SESSION['timestamp_limite']);
    }
}

function brute_force_init_limit()
{
    global $_TIME_BLOCAGE ;
	// Si la variable de session qui compte le nombre de soumissions n'existe pas
	if(!isset($_SESSION['nombre']))
	{
		// Initialisation de la variable 
		$_SESSION['nombre'] = 0;
        // Blocage pendant 10 min
        $_SESSION['timestamp_limite'] = time() + (60 * $_TIME_BLOCAGE);
	}
}

// S'il y a eu moins de $connect_try identifications ratées dans la journée, on laisse passer
function brute_force_ctrl_limit($tentatives)
{
    global $connect_try;
    
	if(isset($connect_try) && !is_null($connect_try) && $connect_try !=0)
	{
		if($tentatives < $connect_try)
		{
			return true;
		}
	}
	else
	{
		return true;
	}
	
	return false ;
}

function brute_force_cookie()
{
    global $connect_try;
    
    // Si on a dépassé les $connect_try tentatives
	if($_SESSION['nombre'] >= $connect_try)
	{
		// Si le cookie marqueur n'existe pas on le crée 
		if(!isset($_COOKIE['marqueur-try-connect']))
		{
		    $timestamp_marque = time() + 60; // On le marque pendant une minute 
			 $cookie_vie = time() + 60*60*24; // Durée de vie de 24 heures pour le décalage horaire
		    setcookie("marqueur-try-connect", $timestamp_marque, $cookie_vie);
		}
		
		// on quitte le script
		return false;
	}
}

/****************************** login.php *******************************************************/

function ft_files($Pseudo)
{
    global $_path, $connect_try ;
    
    $file = $_path.'Logs/antibrute/'.$Pseudo.'.tmp' ;
    
    //echo "file :: $file<br/>";
	 // Si le fichier existe, on le lit
    if(file_exists($file))
    {
        // On ouvre le fichier
        $fichier_tentatives = fopen($file, 'r+');

        // On récupère son contenu dans la variable $infos_tentatives
        $contenu_tentatives = fgets($fichier_tentatives);

	//	echo "contenu_tentatives :: $contenu_tentatives<br/>";

        // On découpe le contenu du fichier pour récupérer les informations
        $infos_tentatives = explode(';', $contenu_tentatives);

        // Si la date du fichier est celle d'aujourd'hui, on récupère le nombre de tentatives
        if($infos_tentatives[0] === date('d/m/Y'))
        {
            $existence_ft = 3;
        	$tentatives = $infos_tentatives[1];
        }
        // Si la date du fichier est dépassée, on met le nombre de tentatives à 0 et $existence_ft à 2
        else
        {
            $existence_ft = 2;
            $tentatives = 0; // On met la variable $tentatives à 0
        }

        // Si on a ouvert un fichier, on le referme (eh oui, il ne faut pas l'oublier)
        fclose($fichier_tentatives);
    }
    // Si le fichier n'existe pas encore, on met la variable $existence_ft à 1 et on met les $tentatives à 0
    else
    {
        $existence_ft = 1;
        $tentatives = 0;
    }

	//	echo "existence_ft :: $existence_ft<br/>";
	//	echo "tentatives :: $tentatives<br/>";


	return array($tentatives,$existence_ft) ;
}

function ft_treatment($Pseudo,$tentatives,$existence_ft)
{
    global $connect_try, $MMORPG_Name ;
    
	// Si le fichier n'existe pas encore ou Si la date n'est plus a jour, on le créé
	if($existence_ft <= 2)
	{
		$exec = log_files("antibrute", $Pseudo.'.tmp', date('d/m/Y').';1' );	   
	}
	else
	{
		if(brute_force_ctrl_limit($tentatives))
		{
			$ip = getRealIpAddr();
			
		   $email_administrateur = 'Email de administrateur du site';

		   $sujet = '['.$MMORPG_Name.'] Un compte membre a atteint son quota';

		   $message_texte = 'Un des comptes a atteint le quota de mauvais mots de passe journalier :'."\n";
		   $message_texte .= $Pseudo.' - '.$ip.' - '.gethostbyaddr($ip);
		   
		   send_email($email_administrateur,$sujet,$message_texte);
		}
		   
		$tentatives++;

		$exec = log_files("antibrute", $Pseudo.'.tmp', date('d/m/Y').';'.$tentatives ); 	
	}
}

function connexion($Pseudo,$Password)
{
	global $baseline, $prefixe_salt , $suffixe_salt , $MMORPG_Access ;
	
	$login = get_db('request_account',$_POST); 
	
	$pswd = password_encode($prefixe_salt.$login['Account_Salt'].$suffixe_salt, $Password)		;
	$restore = password_decode($prefixe_salt.$login['Account_Salt'].$suffixe_salt, $login['Account_Password'] )		;
	
	if($login['Account_Password'] === $pswd && $restore === $Password )
	{
		if($login['Account_Valid'] == '1')
		{
			if(!isConnected($login))
			{
				get_user($Pseudo);
			
				if(verif_auth())// (user_data('Account_Status') == "Authorized")
				{
					init_equipement_session();
					
					get_perso($Pseudo);
					get_equipement($Pseudo);
					get_Guild($Pseudo);

					clear_battle();
					
					$ID = user_data('Account_ID');
					$Date = date('Y-m-d H:i:s');
					$IP = getRealIpAddr();
					$Last_Connection = user_data('Account_Last_Connection');
					$Last_IP = user_data('Account_Last_IP');
					
					update_db('Caranille_Accounts',array('Account_Last_Connection' => $Date, 'Account_Last_IP' => $IP, 'Account_ID' => $ID));

					if ($Last_IP !== $IP)
					{
						$message = "ATTENTION!!!"."\n";
						$message .= "Votre dernière connexion ne provient pas de la même adresse IP."."\n";
						$message .= "Cela peut signifier qu'une autre personne se soit précédemment connectée avec votre compte."."\n";
						$message .= "Si par contre vous vous êtes connecté depuis un autre poste veuillez ignorer ce message.";
						$message .= "\n\n";
						$message .= "Pour information voici un détail de votre dernière connexion:."."\n";
						$message .= "- Date de connexion: $Last_Connection "."\n";
						$message .= "- Adresse IP: $Last_IP "."\n";
					}

					if ($MMORPG_Access === "Yes")
					{
						$baseline = 'Connection Réussi<br /><br />';
						$baseline .= '<a href="'.get_link('Main','Public').'">Commencer à jouer</a>';
					}
					elseif($MMORPG_Access === "No" && verif_access("Admin",true)) //(user_data('Account_Access') == "Admin")
					{
						$baseline = 'Connection Réussi<br /><br />';
						$baseline .= '<a href="'.get_link('Main','Admin').'">Administration</a>';
					}
					else
					{	
						$baseline = 'Le jeu est actuellement fermé, merci de revenir plus tard';
						session_destroy();
					}
					
					return true;
					
				}
				
				return 2 ;
			}
			
			return 3 ;
		}
		
		return 4 ;
	}
	
	return 5 ;
}  
  
		$affich = true ;

        if (request_confirm('Login'))
    	{
            if(verifier_token(60, get_link('Login','User') ,  'Login'))
    	    {
        		extract(addslashes_r($_POST));

                list( $tentatives,$existence_ft) = ft_files($Pseudo);

                if(brute_force_ctrl_limit($tentatives))
                {					
					$c_Login = count_db('count_account',$_POST);
					
					if ($c_Login === 1)
					{
						$connect = connexion($Pseudo,$Password) ;
						
						if($connect === 2)
						{
							$message = "IMPOSSIBLE DE SE CONNECTER!!!"."\n";
							$message .= "Votre compte est banni pour la raison suivante : "."\n";
							$message .= user_data('Account_Reason');
						}
						elseif($connect === 3)
						{
							$baseline = 'Compte actuellement connecté';
							ft_treatment($Pseudo,$tentatives,$existence_ft);            			       
						}
						elseif($connect === 4)
						{
							print_r($login);
							$baseline = 'Compte non validé';
						}
						elseif($connect === 5)
						{
							$baseline = 'Mauvaise combinaison Pseudo/Mot de passe';
							ft_treatment($Pseudo,$tentatives,$existence_ft);            			       
						}
						
					}
					elseif ($c_Login === 0)
					{
						$baseline = 'Compte inconnu';
					}
					elseif($c_Login > 1)
					{
						$baseline = 'il y a un pb avec ce pseudo';
					}
									
    			}
    			else
    			{
    			    $baseline ="essai max($connect_try) atteind pour aujourd'hui";
    			}
    	    }
    	    else
    	    {
    	        $baseline = 'Ne renvoyez pas le formulaire';
    	    }
    	}
    	else
    	{
    	    $baseline = 'Pour continuer votre partie veuillez vous identifier';
    	}

        $title = "Connexion";
            
		//echo $baseline ;
	
       if(isset($message) && $message !=='')
	   {
			echo '<script type="text/javascript">'."\n";
			echo 'alert("'.$message.'");';
			echo '</script>';
	   }
	
?>
