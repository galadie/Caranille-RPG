<?php
if($MMORPG_Template =='Neutral_skin')
{
	function get_ocedar()
	{
		echo "<h2>equipment</h2>";
		echo "Casque : ".( isEquiped("Helmet") ? equipement('Helmet') :"")."<br/>" ;
		echo "Arme : ".( isEquiped("Weapon") ?equipement('Weapon') :"")."<br/>" ;
		echo "Protection : ".( isEquiped("Armor") ? equipement('Armor') :"")."<br/>" ;
		echo "Gants: ".( isEquiped("Gloves") ?equipement('Gloves') :"")."<br/>" ;
		echo "Pantalons : ".( isEquiped("Pants") ? equipement('Pants') :"")."<br/>" ;
		echo "Bottes : ".( isEquiped("Boots") ? equipement('Boots') :"")."<br/>" ;
	}
}