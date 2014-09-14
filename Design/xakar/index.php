<!-- saved from url=(0048)http://www.internetwisdom.free.fr/designs/xakar/ -->

<head>
	<?php include_once($header) ?>
</head>
<body>



<?php 

if($secteur_module=='Public' && ($page =='main'|| $page=='')){

	include_once('homepage.php');
}
else
{
?>
			<?php if(!is_null($head)) include_once($head) ?>

	<div id="wrapper">  
	
			<?php if(!is_null($left)) include_once($left) ?>

		<div class="content">
            <div class="top">
			<?php if(isset($baseline)) echo $baseline ?>
            </div>
            
            <div class="middle">
			<p><?php include_once($content) ?></p>
			
			 </div>
            
            <div class="bottom">
            </div>
			
			<?php if(!is_null($right)) include_once($right) ?>
			
			<?php if(!is_null($sub)) include_once($sub) ?>
		 </div>
    
</div>
<?php } ?>
