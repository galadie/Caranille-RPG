<?php                                                
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
							
							echo "\t\t\t\t\t\t\t\t".'<div class="landing ' .stripslashes($Towns['Town_Landing']). '">'."\n";
							$Building_ID = stripslashes($Buildings['Building_ID']);
							echo '<form method="POST" action="'.get_link('Buildings','Admin').'">';
							echo "<input type=\"hidden\" name=\"Building_ID\" value=\"$Building_ID\">";
							echo '<input type="submit" name="Second_Edit" value="&Cross;" title="'.$Buildings['Building_Type'].'">';
							echo '</form>';
							echo "\t\t\t\t\t\t\t\t".'</div>'."\n";
						}
						else
						{
							echo '<form method="POST" action="'.get_link('Buildings','Admin').'">';
							echo '<input type="hidden" name="Building_PosX" value="'.$compteurX.'">';
							echo '<input type="hidden" name="Building_PosY" value="'.$compteurY.'">';
							echo '<input type="hidden" name="Building_Town_ID" value="'.$Town_ID.'">';
							echo '<input type="submit" name="Add" value="&plus;">';
							echo '</form>';
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