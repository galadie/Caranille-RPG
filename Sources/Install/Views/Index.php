<?php
			debug_log("étape :: $install_step");
			
			//if($page ==="Index" || $page ==="index" || !isset($page))
			if(function_exists($page))
			{
				call_user_func($page);
			}
			else
			{
					step_1();
					step_2();
					step_3();
					step_4();
					step_5();
					step_6();
					step_7();
			}
			
				//include_once($_path."Sources/Contenu/".$page.".php");
?>
