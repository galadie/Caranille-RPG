

		<title><?php echo $MMORPG_Name ?> - <?php if(isset($title)) echo $title ?></title>
		<meta charset="utf-8" />
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Style-Type" content="text/css">
		
		<meta name="robots" content="index, follow, archive, all" />
		
		<meta http-equiv="Content-Language" content="fr-FR" />

		<meta name="description" content="éditeur de MMORPG en PHP. <?php echo (isset($description) ? $description : "") ?>" />
		<meta name="keywords" content="<?php echo (isset($keywords) ? $keywords : "") ?>" />
		<meta name="language" content="fr-FR" />
		<meta name="Indentifier-URL" content="<?php echo $_url ?>"> 
		
		<?php echo $link_css ?>
		<link rel="stylesheet" media="screen" type="text/css" title="design" href="<?php echo get_design('Design.css') ?>" >
		
		<?php echo $link_js ?>
