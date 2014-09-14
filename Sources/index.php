<?php 
	debug_log("page :: $page",false);
/**	
if(trim(ucfirst($secteur_module))=='Admin')
{
	debug_log("module :: admin",false);
	$path_module = path_module("Index","Admin_dev");
	$content = path_view("Index","Admin_dev");
}	
else
**/
if(trim(ucfirst($secteur_module))=='Shop')
{
	debug_log("module :: shop",false);
	$path_module = path_module("Index",ucfirst($secteur_module));
	$content = path_view("Index",ucfirst($secteur_module));
}
elseif(trim(ucfirst($secteur_module)) == 'Contenu')
{
	debug_log("module :: contenu",false);
	$path_module = path_module("Index",ucfirst($secteur_module));
	$content = path_view("Index",ucfirst($secteur_module));
}
elseif(preg_match('/install/i',$secteur_module))//(trim(ucfirst($secteur_module)) == "Install")
{
	debug_log("module :: install",false);
	$path_module = path_module("Index",ucfirst($secteur_module));
	$content = path_view("Index",ucfirst($secteur_module));
}
else
{
	debug_log("module :: public",false);
	$path_module = path_module(ucfirst($page),ucfirst($secteur_module));
	$content = path_view(ucfirst($page),ucfirst($secteur_module));
}
	debug_log("page :: $page",false);
	
	load_css('important.css','important');	
	load_css('barre.css','barre');	
	load_css('arme.css','arme');	
	load_css('corps.css','corps');
	load_css('menu.css','menu');	
	load_css('ordre.css','ordre');
	load_css('translate.css','translate');	
	load_css('debug.css','debug');	
	
	load_css('popin.css','popin');
	load_js('popin.js','popin');
	load_js('bbcode.parser.js','bbcode.parser');


$header = path_design_layout("Header",ucfirst($secteur_module));
$head = path_design_template("Head",ucfirst($secteur_module));
$left = path_design_template("Left",ucfirst($secteur_module));
$right = path_design_template("Right",ucfirst($secteur_module));
$sub = path_design_template("Sub",ucfirst($secteur_module));
$footer = path_design_layout("Footer",ucfirst($secteur_module));

debug_log("secteur_module : ".trim(ucfirst($secteur_module))."",false);
debug_log("path_module : $path_module",false);
debug_log("content : $content",false);

if(!is_null($path_module))include_once($path_module);

if(file_exists($_path."Design/$MMORPG_Template/loading.php"))
	include_once($_path."Design/$MMORPG_Template/loading.php");

$link_css = call_css() ;
$link_js = call_js() ;

include_once($_path."Design/Menu.php"); // fonctions des menus admin, moderateur, joueur, visiteur
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">

<?php 
if(ucfirst($secteur_module)=='Chat')
	include_once($content);
else
	include_once($_path."Design/$MMORPG_Template/index.php");
	//include_once($_path."Design/$MMORPG_Template/frame.php");

if(ucfirst($secteur_module)!=='Chat')	echo debug_screen();
	
	write_popIn();

?>	
	</body>
</html>
<?php
	
if(isset($bdd) && !empty($bdd)) $bdd = NULL;


die();
?>