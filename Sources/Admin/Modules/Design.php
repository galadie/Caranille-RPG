<?php
	if(verif_access("Admin"))
	{
		if (request_confirm('End_Edit'))
		{
			extract($_POST);
			
			if(request_confirm('Constants'))
			{	
				$Open_Config = fopen($_path."Core/Constants.php", "w");
				fwrite($Open_Config, "$Constants");
				fclose($Open_Config);
			}
			
			if(request_confirm('Design'))
			{	
				$Open_Config = fopen($_path."Design/".$MMORPG_Template."/Design.css", "w");
				fwrite($Open_Config, "$Design");
				fclose($Open_Config);
			}
			if(request_confirm('Header'))
			{	
				$Open_Config = fopen($_path."Design/".$MMORPG_Template."/Templates/Head.php", "w");
				fwrite($Open_Config, "$Header");
				fclose($Open_Config);
			}
			if(request_confirm('Sub'))
			{	
				$Open_Config = fopen($_path."Design/".$MMORPG_Template."/Templates/Sub.php", "w");
				fwrite($Open_Config, "$Sub");
				fclose($Open_Config);
			}
			if(request_confirm('Footer'))
			{	
				$Open_Config = fopen($_path."Design/".$MMORPG_Template."/HTML/Footer.php", "w");
				fwrite($Open_Config, "$Footer");
				fclose($Open_Config);
			}
			if(request_confirm('Left'))
			{	
				$Open_Config = fopen($_path."Design/".$MMORPG_Template."/Templates/Left.php", "w");
				fwrite($Open_Config, "$Left");
				fclose($Open_Config);
			}	
			if(request_confirm('Right'))
			{
				$Open_Config = fopen($_path."Design/".$MMORPG_Template."/Templates/Right.php", "w");
				fwrite($Open_Config, "$Right");
				fclose($Open_Config);
			}
		}		
	}

?>
