<?php
	if(verif_access("Admin"))
	{
		if(request_confirm('End_Edit'))
		{
			foreach($_POST as $key => $value)
			{
				$c = count_db("get_config_key",array('key'=>$key));
				
				$conf = array( 'Configuration_Name' => $key , 'Configuration_Value' => $value );
				
				debug_log("mise à jour conf :: ".print_r($conf,1));
				
				if($c == 1)
					update_db('Caranille_Configuration',$conf);
				else
					insert_db('Caranille_Configuration',$conf);		
		    }
		}
	}
?>
