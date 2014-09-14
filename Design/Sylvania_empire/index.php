	<head><?php include_once($header) ?></head>
	
	<body>
		<?php //frameValidation::getPartial('menu-notice', $side_elem) ?>

		<div class="sized panier">	
		
			<div class="t">&nbsp;</div>
				<div class="c">
					<div id="wrapper"><?php include_once($content) ?></div><!-- fin warpper -->
				</div><!-- fin c -->
			<div class="b">&nbsp;</div>
			
			<div id="header"><?php if(!is_null($head)) include_once($head) ?>
			
			<?php if(!is_null($left)) include_once($left) ?>
				
			</div><!-- fin header -->
			
			<div id="sidebar"><?php if(!is_null($right)) include_once($right) ?></div><!-- fin sidebar -->
			
			<div id="footer"><?php if(!is_null($footer))include_once($footer)  ?></div><!-- fin footer -->
		
		</div>

					
