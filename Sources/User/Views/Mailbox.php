<?php
	if(verif_connect())
	{
		
		if (request_confirm('Write'))
		{
			echo LanguageValidation::iMsg("intro.message.write");
						
			$Player_List = list_db('list_account_friends',array('Account_ID'=>logged_data('Account_ID')));

			foreach ($Player_List as $Player)
			{
				$Receiver = strip_tags(stripslashes($Player['Account_Pseudo']));
				$Players[$Receiver] = $Receiver;
			}
			
			echo formulaire_input(array(
			
					select_input("label.message.destinataire","Receiver",$Players,null,null,"Receiver")
				,	text_input("label.message.subject","Message_Subject",null,null,null,"placeholder.message.subject")
				,	call_bbcode_editor("Message")
				,	submit_input("Send","btn.message.send")
			
			),"Mailbox-Send",get_link('Mailbox','User'),"post",null);
		}
		else
		if (request_confirm('Read'))
		{			
			$Messages = list_db('request_mailbox',user_data());
			
			echo "<table class='newsboard email' >";
				
				echo "<tr><th><div class='important'>".LanguageValidation::iMsg("label.message.emetteur")."</div></th>";
					echo "<th><div class='important'>".LanguageValidation::iMsg("label.message.subject")."</div></th>";
					echo "<th>".LanguageValidation::iMsg("label.message.content")."</th>";
					echo '<th></th></tr>';
					
					echo '<tr>';
				echo '<td class="none" colspan="4" >';
				echo '</td>';
			echo '</tr>';
			if(!empty($Messages))
			{
				foreach($Messages as $Message)
				{
					extract(stripslashes_r($Message));
					
					$ID = get_db('request_mail',$Message);
					
					if(!empty($ID))
					{
						$Transmitter = $ID['Account_Pseudo'];
						echo "<tr><td>$Transmitter</td>";
						echo "<td>$Private_Message_Subject</td>";
						echo "<td>".bb_code($Private_Message_Message)."</td>";
						echo '<td>';
						
						echo formulaire_input(array(
			
								hidden_input("Private_Message_ID",$Private_Message_ID)
							,	hidden_input("Private_Message_Conversation",$Private_Message_Conversation)
							,	hidden_input("Transmitter",$Transmitter)
							,	hidden_input("Message_Subject",$Private_Message_Subject)
							,	hidden_input("Message",nl2br($Private_Message_Message))
							
							,	submit_input("Reply","btn.message.reply")
							,	submit_input("Delete","btn.message.delete")
						
						),"Mailbox-Send-$Private_Message_ID",get_link('Mailbox','User'),"post",null);
						
						echo '</td></tr>';
						echo '<tr>';
						echo '<td class="none" colspan="4" >';
						echo '</td>';
						echo '</tr>';
					}
					
				}
			}	
			echo "</table>";
			
			echo '<p>';
			echo '<a href="'.get_link('Mailbox','User',array("Write"=>"mail") ).'">'.LanguageValidation::nMsg("btn.message.write").'</a>';
			echo '</p>';


			if (empty($Private_Message_ID))
			{
				echo 'Vous n\'avez aucun nouveau message';
			}
		}
		else		//Si l'utilisateur souhaite repondre à un message
		if (request_confirm('Reply'))
		{
			$Conversation = request_post('Private_Message_Conversation') == 0 ? request_post('Private_Message_ID') : request_post('Private_Message_Conversation');
			$Receiver = htmlspecialchars(addslashes($_POST['Transmitter']));
			$Message_Subject = htmlspecialchars(addslashes($_POST['Message_Subject']));
			$Message = htmlspecialchars(addslashes($_POST['Message']));
			
			echo LanguageValidation::iMsg("intro.message.reply");
			
			echo formulaire_input(array(
			
								text_input("label.message.reply","Receiver",$Receiver,null,null,"placeholder.message.reply",null,true)
							,	text_input("label.message.subject","Message_Subject","Re : $Message_Subject",null,null,"placeholder.message.subject",null,true)
							,	call_bbcode_editor("Message")
							,	submit_input("Send","btn.message.send")
						
						),"Mailbox-Send",get_link('Mailbox','User'),"post",null);
			echo bb_code($Message);

        }
		else
		//Si rien n'as été choisie, afficher la page d'accueil de la messagerie
		//if (empty($_POST['Write']) && empty($_POST['Read']) && empty($_POST['Send']) && empty($_POST['Reply']) && empty($_POST['Delete']))
		{
			echo LanguageValidation::iMsg("intro.private.message");
			
			echo '<p>';
			echo '<a href="'.get_link('Mailbox','User',array("Write"=>"mail") ).'">'.LanguageValidation::nMsg("btn.message.write").'</a>';
			echo ' - ' ;
			echo '<a href="'.get_link('Mailbox','User',array("Read"=>"box") ).'">'.LanguageValidation::nMsg("btn.message.read").'</a>';
			echo '</p>';
		}
	}
	
