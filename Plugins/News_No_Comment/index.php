 <?php
 
function news_comment_form($News)
{
 /**  	$form = '<form method="POST" action="'.get_link('Comments','Public').'">';
    $form .= '<textarea name="Comment_Message" ID="message" rows="10" cols="50"></textarea><br/><br/>';
	$form .= '<input type="hidden" name="Comment_News_ID" value="'.stripslashes_r($News['News_ID']).'"/>';
	$form .='<input type="hidden" name="News_ID" value="'.stripslashes_r($News['News_ID']).'"/>';
	$form .= '<input type="hidden" name="Comment_Date" value="'.date('Y-m-d H:i:s').'"/>';
	$form .= '<input type="hidden" name="Comment_Account_Pseudo" value="'.user_data('Account_Pseudo' ).'"/>';
	$form .= '<input type="hidden" name="token" value="'.generer_token('Comment-'.$News['News_ID']).'" />';
	$form .=  '<input type="submit" name="End_Add" value="Terminer">';
	$form .= '</form>';
**/
	$form ="un plug-in empeche de commenter les news...";
	return $form ;
}

function news_comment_record($News)
{
	if(verif_connect(true)) 
		if(verifier_token(600, get_link('Comments','Public') ,  'Comment-'.$News['News_ID']))
	        if (request_confirm('End_Add'))
    			if (request_confirm('Comment_Message'))
					echo "vous ne devriez pas pouvoir faire ça...";
}

function news_comment_date($comment)
{
    //$_date = new DateTime($comment['Comment_Date']);
    
    return  "";//$_date->format("d/m/Y à H:i");
}

function news_comment_message($comment)
{
    return "";//stripslashes(nl2br($comment['Comment_Message']));
}