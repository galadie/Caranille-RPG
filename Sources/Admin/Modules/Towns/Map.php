<?php
$posx = 0;
			$posy = 0;
  
	echo "\t\t\t\t\t".'<div id="Map">'."\n";
		$compteurX = $posx - $rayon_map;
        $compteurY = $posy + $rayon_map;

        $finX = $posx + $rayon_map;
        $finY = $posy - $rayon_map;
                                        
        $debutX = $posx - $rayon_map;
		
		echo "\t\t\t\t\t\t".'<div class="header ligneMap">'."\n";
       
        echo "\t\t\t\t\t\t\t".'<div class=" caseMap"></div>'."\n";
                for($x = $compteurX; $x <= $finX ; $x++) 
                        echo "\t\t\t\t\t\t\t".'<div class=" caseMap">'.$x.'</div>'."\n";
						
        echo "\t\t\t\t\t\t\t".'<div class=" caseMap"></div>'."\n";
		echo "\t\t\t\t\t\t", '</div>'."\n";

        while($compteurY >= $finY) {
                echo "\t\t\t\t\t\t".'<div class="ligneMap">'."\n";
				echo "\t\t\t\t\t\t\t".'<div class="caseMap compteur">'.$compteurY.'</div>'."\n";
       
                while($compteurX <= $finX) {
                        echo "\t\t\t\t\t\t\t".'<div class="caseMap">'."\n";
						
						if(isset($l_Twons[$compteurX][$compteurY]))
						{
							$Towns = $l_Twons[$compteurX][$compteurY];
							
							echo "\t\t\t\t\t\t\t\t".'<div class="landing ' .stripslashes($Towns['Town_Landing']). '">'."\n";
							$Town_ID = stripslashes($Towns['Town_ID']);
							echo '<form method="POST" action="'.get_link('Towns','Admin').'">';
							echo "<input type=\"hidden\" name=\"Town_ID\" value=\"$Town_ID\">";
							echo '<input type="submit" name="Second_Edit" value="X" title="'.$Towns['Town_Name'].'">';
							echo '</form>';
							echo "\t\t\t\t\t\t\t\t".'</div>'."\n";
						}
						elseif(isset($l_Landings[$compteurX][$compteurY]))
						{
							$Landings = $l_Landings[$compteurX][$compteurY];
							
							echo "\t\t\t\t\t\t\t\t".'<div class="landing ' .stripslashes($Landings['Landing_Type']). '">'."\n";
							echo '<form method="POST" action="'.get_link('Towns','Admin').'">';
							echo '<input type="hidden" name="PosX" value="'.$compteurX.'">';
							echo '<input type="hidden" name="PosY" value="'.$compteurY.'">';
							echo '<input type="submit" name="Add" value="+" />';
							echo '</form>';
							echo "\t\t\t\t\t\t\t\t".'</div>'."\n";
						}
						else
						{
							echo '<form method="POST" action="'.get_link('Towns','Admin').'">';
							echo '<input type="hidden" name="PosX" value="'.$compteurX.'">';
							echo '<input type="hidden" name="PosY" value="'.$compteurY.'">';
							echo '<input type="submit" name="Add" value="+">';
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
	
	echo "\t\t\t\t\t".'</div>'."\n";
