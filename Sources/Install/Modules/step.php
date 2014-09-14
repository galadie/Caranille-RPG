<?php

function step_1()
{
	global $install_step;

	if ( empty($_POST) && $install_step == 1 ) //(empty($_POST) && empty($_GET)) || (request_confirm('step') && request_get('step')===1) )
	{
		?>
		<p>
			Bienvenue dans l'assistant d'installation de Caranille<br />
			Cet assistant vous guidera tout au long de l'installation de Caranille<br />
			pour vous offrir la meilleur experience possible dans la création de votre MMORPG
		</p>
		
		Pour commencer l'installation de Caranille veuillez lire et accepter la license d'utilisation<br /><br />
		<a rel="license" href="http://creativecommons.org/licenses/by/4.0/deed.fr"><img alt="Licence Creative Commons" style="border-width:0" src="http://i.creativecommons.org/l/by/4.0/88x31.png" /></a><br />Ce(tte) œuvre est mise à disposition selon les termes de la <a rel="license" href="http://creativecommons.org/licenses/by/4.0/deed.fr">Licence Creative Commons Attribution 4.0 International</a>.
		<br /><br /><iframe src="LICENCE.txt">
		</iframe><br />
		<form method="POST" action="<?php echo get_link("Index","Install") ?>">
		<input type="submit" name="Accept" value="J'accepte la license d'utilisation de caranille et je la respecte"/><br /><br />
		</form>
		<?php
	}
}


function get_locals()
{
    global $language_codes , $country_codes ;
    
    $locale_data = array();
         
    //Get locales from Linux terminal command locale
    $chain_locales = shell_exec('locale -a');
     
    debug_log("<pre>$chain_locales<pre>");
     
    $locales = explode("\n" , $chain_locales);
     
     debug_log(print_r($locales,1));
     
    foreach($locales as $c => $l)
    {
        if(strlen($l))
        {
            $_dot = strpos($l, '.');
            
            if($_dot !== false )
            {
                $parts = explode('.' , $l);
                $lc = $parts[0];
            }
            else
            {
                $lc = $l;
                $parts[1] = "";
            }
                $_usc = strpos($lc, '_');
                
            if($_usc !== false )
            {
                list($lcode , $ccode) = explode('_' , $lc);
                
                if(isset($lcode))
                {
                    $lcode = strtolower($lcode);
                     
                    if(isset( $language_codes[$lcode]))
                        $language = $language_codes[$lcode];
                    
                    if(isset( $country_codes[$ccode]))
                        $country = $country_codes[$ccode];
                     
                    if(isset($language) and isset($country) and strlen($language) and strlen($country))
                    {
                        $locale_data[$l] = "$language - $country";
                        if(isset($parts[1]) && $parts[1]!="" )  $locale_data[$l] .= "- {$parts[1]}";
                    }
                }
            }
        }
    }
    
    return $locale_data ;
}

function step_2()
{
	if (request_confirm('Accept') ) // || ( $install_step == 2 )) //(request_confirm('step') && request_get('step')===2) )
	{
	    $drivers = pdo::getAvailableDrivers() ;
	    $fuseaux = DateTimeZone::listIdentifiers();
	    $locales = get_locals();
		?>
		<p>Caranille à besoins d'une base de donnée pour stocker toutes les informations de votre jeu<br />
		en passant par les données des joueurs, des objets, des monstres etc...</p>
		
		<p>Veuillez compléter le formulaire suivant avec les informations de connexion à votre base de donnée<br />
		Si vous possedez un hébergement mutualisé il vous suffit de vous connecter sur le site de votre prestataire<br />
		et de chercher les informations de votre base de donnée</p>
		
		<form method="POST" action="<?php echo get_link("Index","Install") ?>">
		
		<label>Adresse de votre serveur SQL</label><input value="<?php /*echo getenv('SERVER_ADDR')*/ ?>" placeholder="Localhost" type="text" name="Server"/><br /><br />
		<label>Nom d'utilisateur</label><input placeholder="User" type="text" name="User"/><br /><br />
		<label>Mot de passe</label><input placeholder="Password" type="password" name="Password"/><br /><br />
		<label>Nom de la base</label><input placeholder="Database" type="text" name="Database"/><br /><br />
		
		<label>Driver</label><select placeholder="Driver" name="Driver" >
			<option>Driver</option>
			<?php foreach( $drivers as $driver) { ?><option value="<?php echo $driver ?>"><?php echo strtoupper($driver) ?></option><?php } ?>
		</select><br /><br />
		
		<label>Locales</label><select placeholder="Locale" name="Locale" >
		<?php foreach( $locales as $id => $loc ) { ?><option value="<?php echo $id ; ?>" ><?php echo $loc ; ?></option><?php } ?>
		</select><br /><br />
		
		<label>Fuseaux Horaires</label><select placeholder="Fuseaux" name="Fuseaux" >
		<?php foreach( $fuseaux as $hor ) { ?><option value="<?php echo $hor ; ?>" ><?php echo $hor ; ?></option><?php } ?>
		</select><br /><br />
		
		<input type="submit" name="Create_Configuration" value="Creer la configuration du MMORPG"/>
		</form>
		<?php
	}
}

function step_3()
{
	global $_path , $_rewrite, $install_step, $bdd;
	
	$aff = false ;

	if (request_confirm('Create_Configuration') )//|| ( $install_step == 2 )
	{
		if(create_config())
		{			
		    if($_rewrite) // si l'URL_REWRITING est activé.
				create_htaccess();
		} 
		$aff = true ;
	}
	elseif ( $install_step == 2)
	{
		if( empty($_POST))
		{
			$aff = true ;
		}
		else
		if(!request_confirm('Choose_Curve'))
		{
			$aff = false ;
		}
		else
		{
	        echo "cas de figure inattendue...<br/>";
		}
		
	}
	else
	{
		$aff = false ;
	}
	
	if($aff)
	{
		if (file_exists($_path."Config.php"))
		{
		    
		    connect_db();
		    
		    if($bdd!==false)
		    {
    			?>
    			
    			<form method="POST" action="<?php echo get_link("Index","Install") ?>">
        			<p>Félicitation Le fichier de configuration à votre base de donnée à bien été crée
        			Ce fichier va permettre à Caranille de communiquer à votre base de donnée.</p><br />
        			<br /><br />
        			<input type="submit" name="Choose_Curve" value="Continuer"/>
    			</form>
    
    			<?php
		    }
		    else
		    {
		    	echo "Le fichier de configuration contient une erreur...";
		        
		    }
		}
		else
		{
			echo "Le fichier de configuration n'a pu être crée. Veuillez vérifier que PHP à bien les droits d'écriture";
		}
		
	}
	else
	{
	    echo "erreur inattendue...<br/>";
	}
}

function step_4()
{
	global $array_character_type;
	
	if (request_confirm('Choose_Curve'))
	{
		?>
		Veuillez choisir la courbe d'experience pour les personnages ainsi que les guildes
		
		<form method="POST" action="<?php echo get_link("Index","Install") ?>">
		<?php foreach( $array_character_type as $char) { ?>
			<label><?php echo strtoupper($char) ?></label>
			<input placeholder="Gain de {<?php echo ucfirst($char) ?>} par niveau:" type="text" name="<?php echo ucfirst($char) ?>_Level"/>
			<br /><br />
		<?php } ?>
		<!--
		Gain de HP par niveau: <br /> <input type="text" name="HP_Level"/><br /><br />
		Gain de MP par niveau: <br /> <input type="text" name="MP_Level"/><br /><br />
		Gain de Force par niveau: <br /> <input type="text" name="Strength_Level"/><br /><br />
		Gain de Magie par niveau: <br /> <input type="text" name="Magic_Level"/><br /><br />
		Gain de Agilité par niveau: <br /> <input type="text" name="Agility_Level"/><br /><br />  
		Gain de Defense par niveau: <br /> <input type="text" name="Defense_Level"/><br /><br />                                  
		-->
		Experience demandé en plus par niveau: <br /> <input type="text" name="Experience_Level"/><br /><br />
		<input type="submit" name="Start_Installation" value="Lancer l'installation">
		</form>
		<?php
	}
}

function step_5()
{
	global $install_step ;
	
		$access = false ;
				
	if (request_confirm('Start_Installation'))// || ( $install_step == 3 )) //(request_confirm('step') && request_get('step')===3) )
		if (request_confirm('Start_Installation'))
			if(create_db())//install_bdd();
				$access = true ;
				
		if( $install_step == 3 && empty($_POST) ) //((request_confirm('step') && request_get('step')===3) )
			$access = true ;

			
		if($access)
		{
			if (request_confirm('Start_Installation'))
				install_edit_step_record(3);
			
				mmorpg_init();// creatio des levels
?>
				Installation de caranille terminée avec succès<br />
				Dans la suite de l'installation vous allez devoir configurer les bases de votre MMORPG<br />
				
				<form method="POST" action="<?php echo get_link("Index","Install") ?>">
				<input type="submit" name="Configure" value="Configurer mon MMORPG"/>
				</form>
<?php
		}
	
}

function step_6()
{
	global $install_step ;
	
	if (request_confirm('Configure') ) //(request_confirm('step') && request_get('step')===4 ) )
	{
		$aff = true ;
	}
	elseif( $install_step == 4 && empty($_POST) )
	{
		$aff = true ;
	}
	else
	{
		$aff = false ;
	}
	
	if($aff)
	{
		install_edit_step_record(4);		
		?>
		Dernière étape avant de pouvoir commencer votre MMORPG<p>
		Cette étape est l'une des plus importantes pour votre jeu<br />
		C'est ici que vous allez devoir donner un nom à votre MMORPG ainsi que une courte introduction<br /><br />
		
		De plus vous allez créer votre propre compte qui sera le compte administrateur</p>
		
		<form method="POST" action="<?php echo get_link("Index","Install") ?>">
		Nom de votre MMORPG<br /> <input type="text" name="MMORPG_Name"/><br /><br />
		Description(metas):<br/><textarea name="MMORPG_Description" ID="MMORPG_Description" ></textarea><br /><br />
		Présentation<br /><?php echo call_wysiwyg('MMORPG_Presentation');?><br /><br />
		Pseudo<br /> <input type="text" name="Pseudo"/><br /><br />
		Mot de passe<br /> <input type="password" name="Password"/><br /><br />
		Confirmer le mot de passe<br /> <input type="password" name="Password_Confirm"/><br /><br />
		Adresse e-mail<br /> <input value="<?php echo getenv('SERVER_ADMIN') ?>" type="text" name="Email"/><br /><br />
		<input type="submit" name="Finish" value="Terminer"/>
		</form>
		<?php
	}			
}

function step_7()
{
	if (request_confirm('Finish'))
	{
		if (request_confirm('MMORPG_Name') && request_confirm('MMORPG_Presentation') && request_confirm('Pseudo') && request_confirm('Password') && request_confirm('Email'))
		{	
			if ( mmorpg_init() )
			{
		    	install_edit_step_record(5);		
?>
				Félicitation Votre MMORPG a bien été crée<p/>
				Vous allez maintenant pouvoir créer et modifier votre jeu et donner vie à une communauté de joueurs<br /><br />
				
				Par mesure de sécurité veuillez de supprimer le répertoire "Install" de votre serveur FTP<br />
				
				<form method="POST" action="<?php echo get_link("Main","game") ?>">
			    	<input type="submit" name="accueil" value="retourner à l'accueil"/>
				</form>
<?php
			}
			else
			{
				$error = "ATTENTION: Les deux mots de passe entrée ne sont pas identiques";

			}
		}
		else
		{
				$error = "ATTENTION: Vous n'avez pas rempli tous les champs correctement";

		}
		
		if(isset($error) && !is_null($error))
		{
		    echo $error
?>				
			<form method="POST" action="<?php echo get_link("Index","Install") ?>">
				<input type="submit" name="Configure" value="Recommencer"/>
			</form>
<?php		    
		}
	}				
}
?>