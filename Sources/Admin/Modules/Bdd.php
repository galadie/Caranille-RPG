<?php
	if(verif_access("Admin"))
	{
		if(request_confirm('Alter_db'))
		{
			alter_db();
		}
		
		if(request_confirm('Dump_db'))
		{
			if(dump_db())
				$message = "dump éffectué";
		}
	}
?>