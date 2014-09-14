<?php
/*
Cette œuvre est mise à disposition sous licence Attribution - Pas d’Utilisation Commerciale - Partage dans les Mêmes Conditions 3.0 France. Pour voir une copie de cette licence, visitez http://creativecommons.org/licenses/by-nc-sa/3.0/fr/ ou écrivez à Creative Commons, 444 Castro Street, Suite 900, Mountain View, California, 94041, USA.
*/
session_start();

date_default_timezone_set("Europe/Paris");

$kernel_path = realpath(dirname(__FILE__));
$core_path = realpath($kernel_path.'/../Core');

    //update by Dimitri
$Config = $kernel_path.'/../Config.php';

$plugin_path = $kernel_path.'/../Plugins'; 

require_once($kernel_path."/Systems.php");
require_once($kernel_path."/Formulaire.php");
require_once($kernel_path."/Language.php");
require_once($kernel_path."/Debug.php");

if (file_exists($Config))
{
	require_once($Config);	
	$_configured = true ;
}
else
{
	$_path = realpath($kernel_path.'/../').'/';
	$_url = get_url();
	$_configured = false ;
}
require_once($kernel_path."/Database.php");

require_once($core_path."/Constants.php");
require_once($core_path."/db-mapping.php");
require_once($core_path."/Requetes.php");

connect_db();

// verifie l'installation complete	
$install_step = verif_install();
$installing = isInstalling();

// verifie si l'URL REWRITING est activée
$_rewrite = _mod_rewrite();

// info config
extract(load_config());

if(!$installing)
{
	// load_plugin(); // => import de plug-in... non fonctionnel
	
	require_once($core_path."/Functions.php");
	
	if(request_confirm('setMessageEditionMode'))
	{
		LanguageValidation::setMessageEditionMode();
	}	
	
	if(LanguageValidation::isMessageEditionMode())
	{
		translateForm::edition();
	}

	require_once($core_path."/Refresh.php");

	$_menu_ = list_pages();
}
?>