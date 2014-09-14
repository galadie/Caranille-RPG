<?php
/*
    PROTOTYPE DU MODULE GUILDE
    */
    if(verif_connect())
    {
		//Si l'utilisateur ne possède pas de Guilde
        if(has_guild())
        {
			//echo 'vous appartenez déjà à une guilde';
			menu_guild();
					
			echo "<table>";
			
            if(has_guild_acces('rank'))
			{
				echo "<tr>";
				echo "<td>";
				echo "<form method='post' action='".get_link('Rank','Guild')."'>";
				echo "<label></label><input name='new_rank' type='text' />";
				echo '<input type="hidden" name="token" value="'.generer_token("guild-rank-create").'"/>';
				echo "<input type='submit' name='create_rank' /><br/>";
				echo "</form >";
				echo "</td>";
				echo "</tr>";
			}
			
					/**
					if(has_guild_acces('rank'))
						if ($reorder)
							if( $rank['Rank_Order'] != ($ct-$a) )
								update_db('Caranille_Rank', array('Rank_ID' => $rank['Rank_ID'], 'Rank_Order' => ($ct-$a) ) );
					**/		
					echo "<tr>";
					
					echo "<td valign='top' align='left'>";
					
					$list_rank = list_db('guild_list_rank',array( 'Guild_ID' =>user_data('Account_Guild_ID') ) );
					
					if(!empty($list_rank))
					{
						foreach( $list_rank  as $a => $rank)
						{		
							if(has_guild_acces('rank'))
							{
								echo "<form method='post' action='".get_link('Rank','Guild')."'>";
								echo "<label></label><input name='new_rank' type='text' value='".$rank['Rank_Name']."' />";
								echo '<input type="hidden" name="rank" value="'.$rank['Rank_ID'].'"/>';
								echo '<input type="hidden" name="token" value="'.generer_token("guild-rank-edit-".$rank['Rank_ID']).'"/>';
								echo "<input type='submit' name='edit_rank' />";
								echo "<input type='submit' name='show_rank' value='voir' />";
								echo "</form ><br/>";
							}
							else
								echo $rank['Rank_Name'];
								
						}
					}
					echo "</td>";

						echo "<td>";
					if(isset($_rank['Rank_ID']))
					{
						if(has_guild_acces('privilege'))
						{
							echo "<form method='post' action='".get_link('Rank','Guild')."'>";
						}
						if(isset($array_guild_functions) && !empty($array_guild_functions))
						{
							echo "fonctions de guilde:<br/>";
							foreach( $array_guild_functions as $e => $priv)
							{
								$r = get_db("has_privilege",array(
								        'Rank_ID' => $_rank['Rank_ID'],
								        'Access' => $priv
								    ));
								
								
								echo '<input '.(!has_guild_acces('privilege') ? 'readonly="readonly"' : '').' '.(isset($r) ? 'checked="checked"' : "" ).' type="checkbox" name="priv['.$e.']" value="'.$priv.'"/>'.$priv.'<br/>' ;
							}
							echo "<br/>";
						}
						if(isset($array_forum_type) && !empty($array_forum_type))
						{
							echo "forums de guilde:<br/>";
							foreach( $array_forum_type as $e => $priv)
							{
                            	$r = get_db("has_privilege",array(
								        'Rank_ID' => $_rank['Rank_ID'],
								        'Access' => $priv
								    ));	
								    
								echo '<input '.(!has_guild_acces('privilege') ? 'readonly="readonly"' : '').' '.(isset($r) ? 'checked="checked"' : "" ).' type="checkbox" name="priv['.$e.']" value="'.$priv.'"/>'.$priv.'<br/>' ;
							}
							echo "<br/>";
						}
						if(isset($array_topic_type) && !empty($array_topic_type))
						{
							foreach( $array_topic_type as $e => $priv)
							{
                            	$r = get_db("has_privilege",array(
								        'Rank_ID' => $_rank['Rank_ID'],
								        'Access' => $priv
								    ));	
								
								echo '<input '.(!has_guild_acces('privilege') ? 'readonly="readonly"' : '').' '.(isset($r) ? 'checked="checked"' : "" ).' type="checkbox" name="priv['.$e.']" value="'.$priv.'"/>'.$priv.'<br/>' ;
							}
							echo "<br/>";
						}
						
						if(has_guild_acces('privilege'))
						{
							echo '<input type="hidden" name="rank" value="'.$_rank['Rank_ID'].'"/>';
							echo '<input type="hidden" name="token" value="'.generer_token("guild-rank-priv-".$_rank['Rank_ID']).'"/>';
							echo "<input type='submit' name='priv_rank' /><br/>";
							echo "</form >";
						}
					}
					echo "</td>";
					
					echo "</tr>";
			echo "</table>";
		}
	}