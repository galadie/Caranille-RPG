<?php
	if(verif_connect()) 
	{
	
		echo LanguageValidation::iMsg("intro.public.chat")
?>		
		<!--// chat_content -->
		<iframe class="chatroom-frame" src="<?php echo get_link('list','Chat') ?>"></iframe>
<?php 
        echo formulaire_input(array(
			
					text_input("label.chat.message","Message",null,null,null,"placeholder.chat.message")
				,	submit_input("Send","btn.chat.send")
				, 	( verif_access("Admin",true) ? submit_input("Clear","btn.chat.clear") : null)
			
			),"Chat-Send",get_link('Chat','User'),"post",null);

	}
?>