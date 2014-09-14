<?php
			$posx = user_data('Account_PosX');
			$posy = user_data('Account_PosY');
	
  
	echo "\t\t\t\t\t".'<div id="Map">'."\n";
		$compteurX = $posx - $rayon_map;
        $compteurY = $posy + $rayon_map;

        $finX = $posx + $rayon_map;
        $finY = $posy - $rayon_map;
                                        
        $debutX = $posx - $rayon_map;

		echo "\t\t\t\t\t\t".'<div class="header ligneMap">'."\n";
        echo "\t\t\t\t\t\t\t".'<div class="ext caseMap"></div>'."\n";
       
 	
 	//echo "$req_joueur<br/>" ;
 	
	$array_around = array(
		'compteurX' => $compteurX ,
		'compteurY' => $compteurY ,
		'finX' => $finX ,
		'finY' => $finY ,
		'Account_Chapter' => user_data('Account_Chapter')
	);
	
 	$joueurs = list_db('arround_account',$array_around );
	if(!empty($joueurs))
	{
		foreach ($joueurs as $joueur)
		{
			$x = $joueur['Account_PosX'];
			$y = $joueur['Account_PosY'];
			
			$l_joueur[$x][$y] = $joueur['Account_Pseudo'] ;
		}
	}
 	$Towns = list_db('arround_town',$array_around);
 	
	if(!empty($Towns))
	{
		foreach ($Towns as $Town)
		{
			$x = $Town['Town_PosX'];
			$y = $Town['Town_PosY'];
			
			$l_Twons[$x][$y] = $Town ;
		}
	}


 	$Lands = list_db('arround_landing',$array_around );
 	
	if(!empty($Lands))
	{
		foreach ($Lands as $Land)
		{
			$x = $Land['Landing_PosX'];
			$y = $Land['Landing_PosY'];
			
			$l_Lands[$x][$y] = $Land ;
		}  
	}
                for($x = $compteurX; $x <= $finX ; $x++) 
                        echo "\t\t\t\t\t\t\t".'<div class=" caseMap">'.$x.'</div>'."\n";
						
        echo "\t\t\t\t\t\t\t".'<div class="ext caseMap"></div>'."\n";
		echo "\t\t\t\t\t\t", '</div>'."\n";

        while($compteurY >= $finY) {
                echo "\t\t\t\t\t\t".'<div class="ligneMap">'."\n";
				echo "\t\t\t\t\t\t\t".'<div class="caseMap compteur">'.$compteurY.'</div>'."\n";
       
                while($compteurX <= $finX) {
                        echo "\t\t\t\t\t\t\t".'<div class="caseMap">'."\n";
						
						if(isset($l_Twons[$compteurX][$compteurY]))
						{
							$Towns = $l_Twons[$compteurX][$compteurY];
							
							if(!is_null($Towns['Town_Image']))
								$Town_Image = "data:".$Towns['Image_Type'].";base64,".$Towns['Image_Base64'];//stripslashes($Towns['Town_Image']);
								
							$Town_ID = stripslashes($Towns['Town_ID']);
							
							echo "\t\t\t\t\t\t\t\t".'<div class="landing ' .stripslashes($Towns['Town_Landing']). '">'."\n";

							echo '<form method="POST" action="'.get_link('Map','Map').'">';
							echo "<input type=\"hidden\" name=\"Town_ID\" value=\"$Town_ID\">";
    		                echo '<input type="hidden" name="token" value="'.generer_token('entrer_Town-'.$Towns['Town_ID']).'" />';
							
						if(!empty($Town_Image))
						{
							echo '<input type="image" name="img_Town" src="'.$Town_Image.'" title="' .stripslashes($Towns['Town_Name']). '">';
							echo '<input type="hidden" name="entrer_Town" value="X" />';
						}
						else
							echo '<input type="submit" name="entrer_Town" value="X" title="' .stripslashes($Towns['Town_Name']). '">';
							
							echo '</form>';
							echo "\t\t\t\t\t\t\t\t".'</div>'."\n";
						}
						else
						if(isset($l_Lands[$compteurX][$compteurY]))
						{
							$landings = stripslashes($l_Lands[$compteurX][$compteurY]['Landing_Type']);
							echo "\t\t\t\t\t\t\t\t".'<div class="landing '.$landings.'" >'."\n";
							echo "\t\t\t\t\t\t\t\t".'</div>'."\n";
						}
						elseif(isset($l_joueur[$compteurX][$compteurY]))
						{
						   $joueur =  $l_joueur[$compteurX][$compteurY];
							echo "\t\t\t\t\t\t\t\t".'<div class="landing personnage" title="' .stripslashes($joueur). '">'."\n";
							echo "\t\t\t\t\t\t\t\t".'</div>'."\n";
						}
                        echo "\t\t\t\t\t\t\t".'</div>'."\n";
                        $compteurX++;
                }
				echo "\t\t\t\t\t\t\t".'<div class="caseMap compteur">'.$compteurY.'</div>'."\n";

                                
        echo "\t\t\t\t\t\t", '</div>'."\n";
        $compteurX = $debutX; // <===============ICI
        $compteurY--;
        }
	
	echo "\t\t\t\t\t".'</div>'."\n";

?>