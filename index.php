<?php 

// chargement 
require_once("Kernel/Load.php"); 

if (is_ban(getRealIpAddr())) 
{
    header('HTTP/1.0 403 Forbidden');
     //L'IP est bannie, on affiche la page et on arrête le script
     readfile($_path.'Ban.php');
     die();
}

// recuperation de la command
list($page,$secteur_module) = get_module_and_page() ;

// execution
include_once($_path."Sources/index.php");

// cloture totale
die();

?>
