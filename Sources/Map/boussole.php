<form class="bousole" action="move.php" method="post">

        <div class="ligneMove">
                <input  type="image" name="deplacement" src="<?php echo get_link("Images/boussole/fleche_haut-gauche.gif","Design") ?>" alt="NO" value="-1|1" onclick="document.deplacementForm.submit();"/>                                   
                <input  type="image" name="deplacement" src="<?php echo get_link("Images/boussole/fleche_haut.gif","Design") ?>" alt="N" value="0|1" onclick="document.deplacementForm.submit();" />
                <input  type="image" name="deplacement" src="<?php echo get_link("Images/boussole/fleche_haut-droite.gif","Design") ?>" alt="NE" value="1|1" onclick="document.deplacementForm.submit();" />     
        </div>
        
        <div class="ligneMove">
                <input  type="image" name="deplacement" src="<?php echo get_link("Images/boussole/fleche_gauche.gif","Design") ?>" alt="O" value="-1|0" onclick="document.deplacementForm.submit();" />                            
                <input  type="image" src="" alt="Vous" />
                <input  type="image" name="deplacement" src="<?php echo get_link("Images/boussole/fleche_droite.gif","Design") ?>" alt="E" value="1|0" onclick="document.deplacementForm.submit();" />     
        </div>
                
        <div class="ligneMove">
                <input  type="image" name="deplacement" src="<?php echo get_link("Images/boussole/fleche_bas-gauche.gif","Design") ?>" alt="SO" value="-1|-1" onclick="document.deplacementForm.submit();" />                     
                <input  type="image" name="deplacement" src="<?php echo get_link("Images/boussole/fleche_bas.gif","Design") ?>" alt="S" value="0|-1" onclick="document.deplacementForm.submit();" />
                <input  type="image" name="deplacement" src="<?php echo get_link("Images/boussole/fleche_bas-droite.gif","Design") ?>" alt="SE" value="1|-1" onclick="document.deplacementForm.submit();" />
        </div>
                                
</form>