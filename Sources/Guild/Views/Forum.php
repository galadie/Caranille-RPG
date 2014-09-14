<?php
    if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
//On récupère la valeur de f
$Forum_ID = intval(request_get('f'));
//Nombre de pages
$numpage = request_confirm('page') ? intval(request_get('page')) : 1;

//A partir d'ici, on va compter le nombre de messages
//pour n'afficher que les 25 premiers

$data=get_db('request_forum',array('forum'=>$Forum_ID));//get_db($r);

//print_r($data);

extract(stripslashes_r($data));



$totalDesMessages = $Forum_Topic + 1;
$nombreDeMessagesParPage = 25;
$nombreDePages = ceil($totalDesMessages / $nombreDeMessagesParPage);
$premierMessageAafficher = ($numpage - 1) * $nombreDeMessagesParPage;

//On prend tout ce qu'on a sur les Annonces du forum
       
$query=list_db('request_forum_topic',array('forum'=>$Forum_ID, 'Guild_ID' => guild_data('Guild_ID')));
//echo $r ;
//t.Topic_Last_Post = p.Post_ID
//having p.Post_ID = max(mp.Post_ID)
// Topic_Genre = 'Annonce' AND
//On lance notre tableau seulement s'il y a des requêtes !

			menu_guild();


//On affiche les pages 1-2-3, etc.
echo '<p>Page : ';
for ($i = 1 ; $i <= $nombreDePages ; $i++)
    echo ($i == $numpage) ? $i :'<a href="'.get_link('Forum','Guild',array('f'=>$Forum_ID,'page'=>$i)).'">'.$i.'</a>';
echo '</p>';

//Le titre du forum
echo '<h1>'.$Forum_Name.'</h1>';

//Et le bouton pour poster
echo'<a href="'.get_link('Poster','Guild',array('action'=>'nouveautopic','f'=>$Forum_ID)).'">&plusmn;&nbsp;&nbsp;Nouveau Topic</a>';

if (count($query)>0)
{
	$genre = "";
	
	?>
	<table>
				<?php
	
	 //On commence la boucle
			foreach( $query as $data)
			{
				extract(stripslashes_r($data));

				$d = new Datetime($Topic_Time);

			
				if($Topic_Genre !== $genre)
				{
					$genre = $Topic_Genre ;
					?>
				
					<tr><td class="none"></td></tr>

					<tr>
					<th>&Phi;</th>
					<th class="titre"><strong>Titre</strong></th>             
					<th class="nombremessages"><strong>Réponses</strong></th>
					<th class="nombrevu"><strong>Vus</strong></th>
					<th class="auteur"><strong>Auteur</strong></th>                       
					<th class="derniermessage"><strong>Dernier message</strong></th>
					</tr>   
				   
					<?php
				}
                //Pour chaque topic :
                //Si le topic est une annonce on l'affiche en haut
                //mega echo de bourrain pour tout remplir
			   //<strong>'.$Topic_Genre.' : </strong>
                echo '
					<tr>
						<td>&Phi;</td>
						<td id="titre"><strong><a href="'.get_link('Topic','Guild',array('t'=>$Topic_ID)).'" title="Topic commencé à '.$d->format('H\hi \l\e d M,y').'">'.$Topic_Titre.'</a></strong></td>
						<td class="nombremessages">'.$Topic_Post.'</td>
						<td class="nombrevu">'.$Topic_Vu.'</td>
						<td><a href="'.get_link('Account','Forum',array('m'=>$Topic_Createur,'action'=>'consulter')).'">'.$Account_Pseudo_Createur.'</a></td>';

               	//Selection dernier message
		$nombreDeMessagesParPage = 15;
		$nbr_Post = $Topic_Post +1;
		$numpage = ceil($nbr_Post / $nombreDeMessagesParPage);
		
			   $d = new Datetime($Post_Time);

                echo '<td class="derniermessage">';
				
				if(!is_null($Topic_Last_Post) && !empty($Topic_Last_Post) && $Topic_Last_Post!="")
				{
					echo 'Par <a href="'.get_link('Account','Forum',array('m'=>$Post_Createur,'action'=>'consulter')).'">'.$Account_Pseudo_Last_Posteur.'</a><br />';
					echo'A <a href="'.get_link('Topic','Guild',array('t'=>$Topic_ID,'page'=>$numpage)).'#p_'.$Topic_Last_Post.'">'.$d->format("H\hi \l\e d M y").'</a>' ;
				}
				echo '</td></tr>';
			}
?>		
		 </table>
<?php
		}

	}

}
?>