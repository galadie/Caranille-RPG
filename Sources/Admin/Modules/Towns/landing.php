<?php
$posx = 0;
			$posy = 0;
  
  $compteurX = $posx - $rayon_map;
        $compteurY = $posy + $rayon_map;

        $finX = $posx + $rayon_map;
        $finY = $posy - $rayon_map;
		
			$Towns = list_db("list_town_landing",array(
				'compteurX' =>$compteurX,
				'finX' =>$finX,
				'compteurY' =>$compteurY,
				'finY' =>$finY,
			));
			
		if(!empty($Towns))
		{
			foreach ($Towns as $Town)
			{
				$x = $Town['Town_PosX'];
				$y = $Town['Town_PosY'];
				
				$l_Twons[$x][$y] = $Town ;
			}
		}
		
  
	echo "\t\t\t\t\t".'<div id="Map">'."\n";
		
                                        
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
							
							if(!is_null($Towns['Town_Image']))
								$Town_Image = "data:".$Towns['Image_Type'].";base64,".$Towns['Image_Base64'];//stripslashes($Towns['Town_Image']);
							
							echo "\t\t\t\t\t\t\t\t".'<div class="landing ' .stripslashes($Towns['Town_Landing']). '">'."\n";
							$Town_ID = stripslashes($Towns['Town_ID']);
							echo '<form method="POST" action="'.get_link('Towns','Admin').'">';
							echo "<input type=\"hidden\" name=\"Town_ID\" value=\"$Town_ID\">";
							echo '<input type="submit" name="Second_Edit" value="&Cross;" title="'.$Towns['Town_Name'].'">';
							echo '</form>';
							echo "\t\t\t\t\t\t\t\t".'</div>'."\n";
						}
						elseif(isset($l_Landings[$compteurX][$compteurY]))
						{
							$Landings = $l_Landings[$compteurX][$compteurY];
							
							echo "\t\t\t\t\t\t\t\t".'<div class="landing ' .stripslashes($Landings['Landing_Type']). '">'."\n";
							$Landing_ID = stripslashes($Landings['Landing_ID']);
							echo '<form method="POST" action="'.get_link('Landing','Admin').'">';
							echo "<input type=\"hidden\" name=\"Landing_ID\" value=\"$Landing_ID\">";
							echo '<input type="submit" name="Second_Edit" value="X" />';
							echo '</form>';
							echo "\t\t\t\t\t\t\t\t".'</div>'."\n";
						}
						else
						{
							echo '<form method="POST" action="'.get_link('Landing','Admin').'">';
							echo '<input type="hidden" name="PosX" value="'.$compteurX.'"/>';
							echo '<input type="hidden" name="PosY" value="'.$compteurY.'"/>';
							echo '<input type="submit" name="Add" value="+"/>';
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
