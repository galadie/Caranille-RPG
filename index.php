<?php 

// chargement 
require_once("Kernel/Load.php"); 

// recuperation de la command
list($page,$secteur_module) = get_module_and_page() ;

// execution
include_once($_path."Sources/index.php");

// cloture totale
die();

?>