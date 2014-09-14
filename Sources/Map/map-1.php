<?php		
		$_Buildings = list_db('town_building',$array_town );
								 
		if(!empty($_Buildings))
		{
			foreach($_Buildings as $b)
			{
				$x = $b['Building_PosX'];
				$y = $b['Building_PosY'];
				
				$l_Buildings[$x][$y] = $b ;
			}
		}
		
		//echo $req_joueurs ;
		
		$l_joueurs = list_db('town_account',$array_town );
	 
		if(!empty($l_joueurs))
		{
			foreach ($l_joueurs as $joueur)
			{
				//print_r($joueur);
				
				$x = $joueur['Position_PosX'];
				$y = $joueur['Position_PosY'];
				
				$l_joueur[$x][$y] = $joueur['Account_Pseudo'] ;
			}
		}										
        $posx = 0;//$recup['posx'];
        $posy = 0;//$recup['posy'];
    
  
	echo "\t\t\t\t\t".'<div id="Map" class="city">'."\n";
		$compteurX = $posx - $rayon_city;
        $compteurY = $posy + $rayon_city;

        $finX = $posx + $rayon_city;
        $finY = $posy - $rayon_city;
                                        
        $debutX = $posx - $rayon_city;

		echo "\t\t\t\t\t\t".'<div class="header ligneMap">'."\n";
        echo "\t\t\t\t\t\t\t".'<div class="ext caseMap"></div>'."\n";
       
                for($x = $compteurX; $x <= $finX ; $x++) 
                        echo "\t\t\t\t\t\t\t".'<div class=" caseMap">'.$x.'</div>'."\n";
						
        echo "\t\t\t\t\t\t\t".'<div class="ext caseMap"></div>'."\n";
		echo "\t\t\t\t\t\t", '</div>'."\n";

        while($compteurY >= $finY) {
                echo "\t\t\t\t\t\t".'<div class="ligneMap">'."\n";
				echo "\t\t\t\t\t\t\t".'<div class="caseMap compteur">'.$compteurY.'</div>'."\n";
       
                while($compteurX <= $finX) {
                        echo "\t\t\t\t\t\t\t".'<div class="caseMap">'."\n";
						
						if(isset($l_Buildings[$compteurX][$compteurY]))
						{
							$Buildings = $l_Buildings[$compteurX][$compteurY];
							
							echo "\t\t\t\t\t\t\t\t".'<div class="landing ' .stripslashes($information_Town['Town_Landing']). '">'."\n";
							$Building_ID = stripslashes($Buildings['Building_ID']);
							
							echo '<form method="POST" action="'.get_link('Map','Map').'">';
							echo '<input type="submit" title="'.$Buildings['Building_Type'].'">';
							echo '</form>';
							
							echo "\t\t\t\t\t\t\t\t".'</div>'."\n";
						}
						else
						if(isset($l_joueur[$compteurX][$compteurY]))
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

		echo "\t\t\t\t\t\t".'<div class="footer ligneMap">'."\n";
        echo "\t\t\t\t\t\t\t".'<div class="ext caseMap"></div>'."\n";
		
		                for($x = $compteurX; $x <= $finX ; $x++) 
                        echo "\t\t\t\t\t\t\t".'<div class=" caseMap">'.$x.'</div>'."\n";

        echo "\t\t\t\t\t\t\t".'<div class="ext caseMap"></div>'."\n";
		echo "\t\t\t\t\t\t", '</div>'."\n";
		
	echo "\t\t\t\t\t".'</div>'."\n";

?>