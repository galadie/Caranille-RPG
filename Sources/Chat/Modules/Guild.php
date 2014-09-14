<?php 	

	if(verif_connect())
	{
		if(verif_access("Admin",true))
	    {
		    if (request_confirm('Delete'))
		    {
				$ID_Message = htmlspecialchars(addslashes($_POST['ID_message']));
				
				delete_db('Caranille_Chat',array('Chat_Message_ID' => $ID_Message));
				echo 'Le message a bien été supprimé';
			}
		}
	}	
		$title = 'ChatRoom';
?>