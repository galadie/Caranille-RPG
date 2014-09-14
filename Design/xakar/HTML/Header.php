<!--<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

<title>Xakar</title>
-->

<title><?php echo $MMORPG_Name ?> - <?php if(isset($title)) echo $title ?></title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<meta name="robots" content="index, follow, archive, all" />
		
		<meta http-equiv="Content-Language" content="fr-FR" />

		<meta name="description" content="éditeur de MMORPG en PHP. <?php echo (isset($description) ? $description : "") ?>" />
		<meta name="keywords" content="<?php echo (isset($keywords) ? $keywords : "") ?>" />
		<meta name="language" content="fr-FR" />
		<meta name="Indentifier-URL" content="<?php echo $_url ?>"> 
		

<?php if($secteur_module=='Public' && ($page =='main'|| $page=='')){ ?>

	<link href="<?php echo get_design('homepage.css') ?>" rel="stylesheet" type="text/css">
<?php
}
else
{
?>

<link href="<?php echo get_design('Design.css') ?>" rel="stylesheet" type="text/css">

		<?php echo $link_js ?>
				<?php echo $link_css ?>
				
<?php } ?>