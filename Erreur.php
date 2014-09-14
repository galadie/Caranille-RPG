<?php 

session_start();

$kernel_path = realpath(dirname(__FILE__))."/Kernel";
 
$Config = "Config.php"; 

require_once($kernel_path."/Systems.php");

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

if(isset( $_SESSION['erreurFatale']))
{
	$req = $_SESSION['erreurFatale'];
	unset($_SESSION['erreurFatale']);
}
$corrig_path = str_replace("/",'\\',$_path);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Erreur</title>
<link rel="stylesheet" type="text/css" href="style/erreur.css" />
</head>

<body>
<?php if(isset($req)) { ?>

	<h1><?php echo $req['type'] ?></h1>
	interruption brutale de process : 
	<p><?php echo $req['message'] ?></p>
	<p>Fichier : <?php echo str_replace($corrig_path,"",$req['file']) ?> / Ligne : <?php echo $req['line'] ?></p>
	<p>Requete : <?php echo $req['sql'] ?></p>
	
	<a href="<?php echo $req['page'] ?>">&gt; Retour</a><br/>
<?php } else echo "erreur non répertoriable" ; ?>
</body>
</html>
