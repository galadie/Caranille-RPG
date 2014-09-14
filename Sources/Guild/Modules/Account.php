<?php

		$query=get_db("SELECT membre_pseudo, membre_avatar,
       membre_email, membre_msn, membre_signature, membre_siteweb, membre_Post,
       membre_inscrit, membre_localisation
       FROM Forum_membres WHERE membre_id='$membre' limit 1");

       //On affiche les infos sur le membre
       echo '<p><i>Vous êtes ici</i> : <a href="./index.php">Index du forum</a> --> profil de '.$membre_pseudo;
       echo'<h1>Profil de '.$membre_pseudo.'</h1>';
       
       echo'<img src="./images/avatars/'.$membre_avatar.'" alt="Ce membre n a pas d avatar" />';
       
       echo'<p><strong>Adresse E-Mail : </strong><a href="mailto:'.$membre_email.'">'.$membre_email.'</a><br />';
       
       echo'<strong>MSN Messenger : </strong>'.$membre_msn.'<br />';
       
       echo'<strong>Site Web : </strong><a href="'.$membre_siteweb.'">'.$membre_siteweb.'</a><br /><br />';
 
       echo'Ce membre est inscrit depuis le <strong>'.date('d/m/Y',$membre_inscrit).'</strong> et a posté <strong>'.$membre_Post.'</strong> messages<br /><br />';
       echo'<strong>Localisation : </strong>'.$membre_localisation.'</p>';
?>