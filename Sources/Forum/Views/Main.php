<?php 
//Initialisation de deux variables
$totaldesmessages = 0;
$categorie = NULL;


//echo $r; //WHERE Auth_View = '".user_data("Account_Access")."'
//-- p.Post_ID = f.Forum_Last_Post_ID
//AND t.Topic_Guild_ID = 0
//AND p.Post_Guild_ID = 0

//Cette requête permet d'obtenir tout sur le forum
$query=list_db('forum_main');//
?>

<table>
<?php
if(!empty($query))
{
	//Début de la boucle
	foreach($query as $data)
	{
		extract(stripslashes_r($data));
		
		if(verif_access($Auth_View,true))
		{
		
			//On affiche chaque catégorie
			if( $categorie != $Cat_ID )
			{
				//Si c'est une nouvelle catégorie on l'affiche
			   
				$categorie = $Cat_ID;
				?>
				<tr>
				<th></th>
				<th class="titre"><strong><?php echo $Cat_nom; ?>
				</strong></th>             
				<th class="nombremessages"><strong>Sujets</strong></th>       
				<th class="nombresujets"><strong>Messages</strong></th>       
				<th class="derniermessage"><strong>Dernier message</strong></th>   
				</tr>
				<?php
					   
			}

			//Ici, on met le contenu de chaque catégorie

			// Ce super echo de la mort affiche tous
			// les forums en détail : description, nombre de réponses etc...

			echo'<tr><td>&sum;</td>
			<td class="titre"><strong><a href="'.get_link('Forum','Forum',array('f'=>$Forum_ID)).'">'.$Forum_Name.'</a></strong><br />'.nl2br($Forum_Desc).'</td>
			<td class="nombresujets">'.$Forum_Topic.'</td>
			<td class="nombremessages">'.$Forum_Post.'</td>';

			// Deux cas possibles :
			// Soit il y a un nouveau message, soit le forum est vide
			if (!empty($Forum_Post))
			{
				 //Selection dernier message
			 $nombreDeMessagesParPage = 15;
				 $nbr_Post = $Topic_Post +1;
			 $numpage = ceil($nbr_Post / $nombreDeMessagesParPage);
				 
				 $d = new Datetime($Post_Time);
				 
				 echo'<td class="derniermessage">
				Par <a href="'.get_link('Account','Forum',array('m'=>$Account_ID,'action'=>'consulter')).'">'.$Account_Pseudo.'  </a><br/>
				A <a href="'.get_link('Topic','Forum',array('t'=>$Topic_ID,'page'=>$numpage)).'#p_'.$Post_ID.'"> '.$d->format('H\hi \l\e d/M/Y').'</a>
				</td></tr>';

			 }
			 else
			 {
				 echo'<td class="nombremessages">Pas de message</td></tr>';
			 }

			 //Cette variable stock le nombre de messages, on la met à jour
			 $totaldesmessages += $Forum_Post;
		}
		 //On ferme notre boucle et nos balises
		 else
		echo "Vous n'avez pas acces au forum !!! ";
	} //fin de la boucle
	
}
else
	echo "Ce forum est vide....";
?></table>
