
	<head><?php include_once($header) ?></head>

	<body class="<?php echo strtolower($secteur_module) ?>">
	
		<?php if(!is_null($head)) include_once($head) ?>

		<?php if(!is_null($left)) include_once($left) ?>

		<section>
		
		    <p class="baseline"><?php if(isset($baseline)) echo $baseline ?></p>

			<article><?php include_once($content) ?></article>
			
			<?php if(!is_null($sub)) include_once($sub) ?>
			
		</section>

		<?php if(!is_null($right)) include_once($right) ?>

		<?php if(!is_null($footer))include_once($footer)  ?>	