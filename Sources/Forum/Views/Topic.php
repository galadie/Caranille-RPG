<?php
//On récupère la valeur de t
$topic = intval(request_get('t'));
//Nombre de pages
$numpage = request_confirm('page') ? intval(request_get('page')) : 1;

/**A partir d'ici, on va compter le nombre de messages pour n'afficher que les 15 premiers
$query=get_db('request_topic',array('topic'=> $topic));**/

extract(stripslashes_r($query));

$forum=$Forum_ID; 
$totalDesMessages = $Topic_Post;
$nombreDeMessagesParPage = 15;
$nombreDePages = ceil($totalDesMessages / $nombreDeMessagesParPage);
$premierMessageAafficher = ($numpage - 1) * $nombreDeMessagesParPage;

debug_log("topic->totalDesMessages::$totalDesMessages");
debug_log("topic->nombreDeMessagesParPage::$nombreDeMessagesParPage");
debug_log("topic->nombreDePages::$nombreDePages (ceil($totalDesMessages / $nombreDeMessagesParPage)) ");
debug_log("topic->premierMessageAafficher::$premierMessageAafficher( ($numpage - 1) * $nombreDeMessagesParPage )");

$query=list_db('request_topic_post',array(
	'topic'=> $topic , 
	'premierMessageAafficher' => intval($premierMessageAafficher), 
	'nombreDeMessagesParPage' => intval($nombreDeMessagesParPage) 
));

echo '<h1>'.$Topic_Titre.'</h1>';

 if(verif_access($Auth_View))
{

//On affiche les pages 1-2-3 etc...
echo '<p>Page : ';
for ($i = 1 ; $i <= $nombreDePages ; $i++)echo ($i == $numpage) ? $i : '<a href="'.get_link('Topic','Forum',array('t'=>$topic,'page'=>$i)).'">' . $i . '</a> ';
echo'</p>';
 

if(verif_access($Auth_Post,true))//On affiche l'image répondre
	echo'<a href="'.get_link('Poster','Forum',array('action'=>'repondre','t'=>$topic)).'">&diams;&nbsp;&nbsp;Répondre</a>';
 
if(verif_access($Auth_Topic,true))//On affiche l'image nouveau topic
	echo'<a href="'.get_link('Poster','Forum',array('action'=>'nouveautopic','f'=>$Forum_ID)).'">&plusmn;&nbsp;&nbsp;Nouveau Topic</a>';

//Enfin on commence la boucle !
?>
<br/>
<?php

	 
	//On vérifie que la requête a bien retourné des messages
	if (count($query)<1)
	{
        echo'<p>Il n y a aucun post sur ce topic, vérifiez l url et reessayez</p>';
	}
	else
	{
        //Si tout roule on affiche notre tableau puis on remplit avec une boucle
        ?><table>
        <tr>
        <th class="vt_auteur"><strong>Auteurs</strong></th>             
        <th class="vt_mess"><strong>Messages</strong></th>       
        </tr>
        <?php
        foreach( $query as $data)
        {
			extract(stripslashes_r($data));
  
		//On commence à afficher le pseudo du créateur du message :
         //On vérifie les droits du Account
         //(partie du code commentée plus tard)
         echo'<tr><td><strong>
         <a href="'.get_link('Account','Forum',array('m'=>$Account_ID,'action'=>'consulter')).'">
         '.$Account_Pseudo.'</a></strong></td>';
           
         /* Si on est l'auteur du message, on affiche des liens pour
         Modérer celui-ci.
         Les modérateurs pourront aussi le faire, il faudra donc revenir sur
         ce code un peu plus tard ! */     
		 $d = new datetime($Post_Time);
   
         if (user_data('Account_ID') == $Post_Createur)
         {
			 echo'<td id=p_'.$Post_ID.'>Posté à '.$d->format('H\hi \l\e d M y').'
			 <a href="'.get_link('Poster','Forum',array('action'=>'delete','p'=>$Post_ID)).'"><span alt="Supprimer" title="Supprimer ce message" >&cross;</span></a>   
			 <a href="'.get_link('Poster','Forum',array('action'=>'edit','p'=>$Post_ID)).'"><span alt="Editer" title="Editer ce message" >&check;</span></a></td></tr>';
         }
         else
         {
			echo'<td>Posté à '.$d->format('H\hi \l\e d M y').'</td></tr>';
         }
       		 $d = new datetime($Account_Inscription);

         //Détails sur le Account qui a posté
         echo'<tr><td>
         <img src="'.get_avatar($data)/**$Account_Avatar**/.'" alt="" />
         <br />Membre inscrit le '.$d->format('d/m/Y').'
         <br />Messages : '.$Account_Post.'<br />
         Localisation : '.$Account_localisation.'</td>';
               
         //Message
         echo'<td>'.bb_code($Post_Texte).'
         <br /><hr />'.bb_code($Account_Signature).'</td></tr>';
         } //Fin de la boucle ! \o/
         ?>
</table>

<?php
        echo '<p>Page : ';
        for ($i = 1 ; $i <= $nombreDePages ; $i++) //On affiche pas la page actuelle en lien
                echo ($i == $numpage) ? $i :'<a href="'.get_link('Topic','Forum',array('t'=>$topic,'page'=>$i)).'">' . $i . '</a> ' ;
        echo'</p>';
       
        

	} //Fin du if qui vérifiait si le topic contenait au moins un message
}
?>           
