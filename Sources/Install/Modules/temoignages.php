<?php

// ---------------------
			// 2EME VERIFICATION : en PHP
			// GESTION d'ERREURS
// -----------------------
// CENSURE
function censorWords($text){
	/*liste des mots a filtrer ou expression aussi longue que tu veux*/
	$find = array(
	'/[caca|pipi|prout]\s/i',
	'/censuré\s/i',
	'/censuré\s/i',
	'/censuré\s/i',
	'/censuré\s/i',
	);
	$replace = ' **** ';
	return preg_replace($find,$replace,$text);
}

function temoignages_exec()
{
	global $secteur, $page , $_path , $temoignage_delimit , $temoignage_ipvisiteur , $temoignage_validForm , $temoignage_message ,$temoignage_nom, $temoignage_mail , $temoignage_MsgErreur , $temoignage_file ;
	
	if( $page =='temoignages')// (request_confirm('reglements')  ) //($secteur ==='Install'||$secteur ==='install') &&
	{
		// ---------------------
		// GUESTBOOK
			$temoignage_file		= $_path.'livredor.txt';
			$temoignage_delimit 	= '-*-'; // délimiteur
		// ---------------------
		// IP du visiteur / date
			$temoignage_ipvisiteur = $_SERVER["REMOTE_ADDR"];
			$date		= date ( "d/m/Y H:i:s" );
		// ---------------------
		// Initialisation
			$temoignage_nom		= '';
			$temoignage_message	= '';
			$temoignage_mail		= '';
			$temoignage_validForm	= true;
			$temoignage_MsgErreur	= '';
		// ---------------------
		// TRAITEMENT SI formulaire soumis
		if(request_confirm('LivredorSubmit'))//], $_POST['antiF5'], $_SESSION['antiF5']) && $_POST['antiF5']==$_SESSION['antiF5'])
		{
			if(verifier_token(600, get_link('temoignages','Install') ,  'Temoignage-Send'))
	        {
				// ---------------------
				// RECUPERATION des DONNEES
				//On convertit les caracteres html
				$temoignage_nom 		= request_post('nom') ;
				$temoignage_mail 		= request_post('mail');
				// textarea :attention aux injections de code html !
				$allowable_tags = '<b><a>'; // (facultatif) on autorise ces balises
				$temoignage_message 	= request_post('message');
				$temoignage_message 	= strip_tags($temoignage_message, $allowable_tags);
				$temoignage_message 	= nl2br($temoignage_message); // nl2br() : change les sauts de ligne tapés par le visiteur en <br />
				$temoignage_message 	= preg_replace("/(\r\n|\n|\r)/", " ", $temoignage_message); // enlève les sauts de ligne résiduels, pour l'écriture dans le fichier (sur une seule ligne)
				
				// On censure
				$newnom 	= censorWords($temoignage_nom);
				$newmessage = censorWords($temoignage_message);
				$newmail 	= censorWords($temoignage_mail);
				$champ_censure = array();
				if ($temoignage_nom!=$newnom) {			$champ_censure[] = 'Nom'; }
				if ($temoignage_message!=$newmessage) {	$champ_censure[] = 'Message'; }
				if ($temoignage_mail!=$newmail) {			$champ_censure[] = 'Email'; }
				if(count($champ_censure)>0) {
					$temoignage_MsgErreur 	.= 'Ces champs ont été censurés : '.implode(', ',$champ_censure).'<br />';
				}
				// champs obligatoires
				$champ_obligatoire = array();
				if ($temoignage_nom=='' || $newnom=='') {			$temoignage_validForm = false;		$champ_obligatoire[] = 'Nom'; }
				if ($temoignage_message=='' || $newmessage=='') {	$temoignage_validForm = false;		$champ_obligatoire[] = 'Message'; }
				if(count($champ_obligatoire)>0) {
					$temoignage_MsgErreur 	.= 'Remplissez tous les champs obligatoires : '.implode(', ',$champ_obligatoire).'<br />';
				}
				// -----------------------
				// Vérification du format de l'Email
				if($temoignage_mail!='' && !filter_var($temoignage_mail, FILTER_VALIDATE_EMAIL)){
					$temoignage_validForm 	= false;
					$temoignage_MsgErreur 	.= 'Invalide Email !<br />';
				}
				// -----------------------
				// OK SI PAS D'ERREUR
				if($temoignage_validForm === true) 
				{
					// ---------------------
					if($newnom!='' && $newmessage!='')
					{
						// ECRITURE dans le GESTBOOK
						//Ouverture du fichier en écriture
						$fp 	= fopen($temoignage_file,'a'); // 'a' : à la fin du fichier
						$line 	= $newnom.$temoignage_delimit.$newmessage.$temoignage_delimit.$newmail.$temoignage_delimit.$date.$temoignage_delimit.$temoignage_ipvisiteur."\n";
						//On rajoute le message
						fwrite($fp, $line, strlen($line));
						//fermeture du fichier
						fclose($fp);
						// ---------------------
					}
					// ---------------------
					// On vide
					$temoignage_nom 		= '';
					$temoignage_message 	= '';
					$temoignage_mail 		= '';
				}
			}
		}
		// ---------------------
		//unset($_POST);
		// anti-F5 (évite de re-poster le formulaire en cas de F5 ("Actualiser la page")
		//$_SESSION['antiF5'] = rand(100000,999999);
		// ---------------------
		
		load_css('goldbook.css','goldbook');
		load_js('goldbook.js','goldbook');
	}
}

function temoignages()
{
	global $secteur, $page , $temoignage_delimit , $temoignage_ipvisiteur , $temoignage_validForm , $temoignage_message ,$temoignage_nom, $temoignage_mail , $temoignage_MsgErreur , $temoignage_file ;
	if($page == 'temoignages')
	{
		?>
		<div class="grande">		
			<h1>Livre d'Or</h1>	
			<form id="livredorform" method="post" action="<?php echo get_link('temoignages','Install') ?>" onsubmit="validLivredor(); return false;"><!---->
				<input type="hidden" name="token" value="<?php echo generer_token("Temoignage-Send") ?>" />
			<p>
				<label for="idnom">Nom* :</label>
				<input id="idnom" type="text" name="nom" value="<?php if(!$temoignage_validForm) echo $temoignage_nom; ?>" size="25" />
				<label for="idmail">Mail :</label>
				<input id="idmail" type="text" name="mail" value="<?php if(!$temoignage_validForm) echo $temoignage_mail; ?>" size="25" /> <i>(facultatif)</i>
			</p>
			<p>
				<label for="idmessage">Message* :</label>
				<textarea id="idmessage" name="message" rows="5" cols="47"><?php if(!$temoignage_validForm) echo $temoignage_message; ?></textarea>
			</p>
			<p>
				<label>&nbsp;</label>
				<input type="submit" name="LivredorSubmit" value="Envoyer" />
			</p>
				<?php if(!empty($temoignage_MsgErreur)) { // erreur ? ?>
					<p class="errChamps"><label>&nbsp;</label><?php echo $temoignage_MsgErreur; ?></p>
				<?php } ?>
			</form>
		 
		<?php 
		
		if(file_exists($temoignage_file))
		{
			$aff = '<h2>Vos Commentaires :</h2>';
			// ---------------------
			// LECTURE DU FICHIER TEXTE
			$lines = file($temoignage_file);
			// FACULTATIF : reverse pour ordre ANTI-CHRONOLOGIQUE
			$lines = array_reverse($lines);
			// lecture ligne par ligne
			foreach($lines as $line) {
				$line	= trim($line);
				if(strlen($line)>0){
				
					list( $temoigne_nom ,$temoigne_message , $temoigne_mail , $date, $ip )	= explode($temoignage_delimit,$line);

					$aff .= '<p><span class="livredor-nom">De <b>'.$temoigne_nom.'</b>';
					if($temoigne_mail!='') { $aff .= ' <i>('.$temoigne_mail.')</i>'; }
					$aff .= '</span><span class="livredor-date">';
					// Affichage de l'IP UNIQUEMENT pour le visiteur
					if($temoignage_ipvisiteur == $ip) { $aff .= ' [IP : '.$ip.'] '; }
					$aff .= '<i>le '.$date.'</i>';
					$aff .= '</span></p>';
					$aff .= '<p class="livredor-message">'.html_entity_decode($temoigne_message).'</p><hr/>';
				}
			}
			
			echo $aff;
			// ---------------------
		}
		?>
		</div>
<?php	
	}
}
