<?php
	function ajout_cat_form($map_cat)
	{		
		if(has_guild_acces('forum')) 
		{ 
			$form = '<form method="POST" action="'.get_link("Main","Guild").'">';
			$form .= '<h2>Ajout de Category</h2>';
			$form .= '<input type="hidden" name="Cat_Guild_ID" value="'.user_data('Account_Guild_ID').'"/>';
			$form .= '<input type="hidden" name="Cat_Ordre" value="'.(count($map_cat)+1).'"/>';
			$form .= '<table style="width:100%">';
			$form .= '<tr>';
			$form .= '<td style="width:80%">'.line_db("Caranille_Categories","Cat_Nom").'</td>';
			$form .= '<td style="width:20%"><input type="submit" name="End_Add_Cat" value="Terminer"/></td>';
			$form .= '</tr>';
			$form .= '</table>';
			$form .= '</form>';
			
			return $form ;
		}
	}

	function ajout_forum_form($map_cat)
	{
		$list_rank = list_db('guild_list_rank',array( 'Guild_ID' =>user_data('Account_Guild_ID') ) );
		
		foreach( $list_rank as $l)
			$values[  $l['Rank_ID']  ] = $l['Rank_Name'];
		
		set_values_db("Caranille_Forums","Auth_View",$values);
		set_values_db("Caranille_Forums","Auth_Post",$values);
		set_values_db("Caranille_Forums","Auth_Topic",$values);
		set_values_db("Caranille_Forums","Auth_Annonce",$values);
		set_values_db("Caranille_Forums","Auth_Modo",$values);

		if(has_guild_acces('forum')) 
		{ 
												$form = '<form method="POST" action="'.get_link("Main","Guild").'">';
												$form .= '<h2>Ajout de Forum</h2>';
												$form .= '<input type="hidden" name="Forum_Guild_ID" value="'.user_data('Account_Guild_ID').'"/>';
												$form .= '<table style="width:100%">';
												$form .= '<tr>';
												$form .= '<td style="width:50%">';
												$form .= line_db("Caranille_Forums","Forum_Name"); 
												$form .= 'Catégorie : <select name="Forum_Cat_ID">';
			foreach($map_cat as $ID => $nom ) 	$form .= '<option value="'.$ID.'">'.$nom.'</option>';
												$form .= '</select>';
												
												$form .= line_db("Caranille_Forums","Auth_View");
												$form .= line_db("Caranille_Forums","Auth_Post");
												$form .= line_db("Caranille_Forums","Auth_Topic");
												$form .= line_db("Caranille_Forums","Auth_Annonce");
												$form .= line_db("Caranille_Forums","Auth_Modo");
												
												$form .= '</td>';
												$form .= '<td style="width:50%">'.call_bbcode_editor("Forum_Desc","","guild-forum").'</td>';
												$form .= '</tr>';
												$form .= '<tr>';
												$form .= '<td><input type="submit" name="End_Add_Forum" value="Terminer"/></td>';
												$form .= '</tr>';
												$form .= '</table>';
												$form .= '</form>';
			return $form ;
		} 
	}
	
    if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
		
		
		
//Initialisation de deux variables
$totaldesmessages = 0;
$categorie = NULL;



//echo $r; 


$query=list_db('request_guild_forum', array('Guild_ID' => guild_data('Guild_ID') ));//

			menu_guild();
	$map_cat = array();

?>

<table border="1" >
<?php
if(!empty($query))
{
	
	//Début de la boucle
	foreach($query as $data)
	{
		extract(stripslashes_r($data));
		
		if(verif_access($Auth_view,true))
		{
		
			//On affiche chaque catégorie
			if( $categorie != $Cat_ID )
			{
				//Si c'est une nouvelle catégorie on l'affiche
				$map_cat[$Cat_ID] = $Cat_nom;
				$categorie = $Cat_ID;
				?>
				<tr>
				<th></th>
				<th class="titre"><strong><?php echo $Cat_nom; ?></strong></th>             
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
			<td class="titre"><strong><a href="'.get_link('Forum','Guild',array('f'=>$Forum_ID)).'">'.$Forum_Name.'</a></strong><br />'.bb_code($Forum_Desc).'</td>
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
				A <a href="'.get_link('Topic','Guild',array('t'=>$Topic_ID,'page'=>$numpage)).'#p_'.$Post_ID.'"> '.$d->format('H\hi \l\e d/M/Y').'</a>
				</td>';
			 }
			 else
			 {
				 echo'<td class="nombremessages">Pas de message</td>';
			 }
				         echo'<td id=t_'.$Forum_ID.'>
         <a href="'.get_link('Poster','Guild',array('action'=>'delete','f'=>$Forum_ID)).'"><span alt="Supprimer" title="Supprimer ce message" >&cross;</span></a>   
         <a href="'.get_link('Poster','Guild',array('action'=>'edit','f'=>$Forum_ID)).'"><span alt="Editer" title="Editer ce message" >&check;</span></a></td>';

				echo '</tr>';
			 //Cette variable stock le nombre de messages, on la met à jour
			 $totaldesmessages += $Forum_Post;
		}
		 //On ferme notre boucle et nos balises
		 else
		echo "Vous n'avez pas acces au forum !!! ";
	} //fin de la boucle
	
}
else
	echo "<tr><th colspan='5' >Ce forum est vide....</th></tr>";
?>
<tr>
	<th colspan='2'><?php if(has_guild_acces('forum')) echo init_popIn('categorie',"Ajouter Categorie",ajout_cat_form($map_cat),'categorie-link') ?></th>
	<th></th>
	<th colspan='2'><?php if(has_guild_acces('forum')) echo init_popIn('forum',"Ajouter Forum",ajout_forum_form($map_cat),'forum-link') ?></th>
</tr>

</table>
<?php 



			
	}
}