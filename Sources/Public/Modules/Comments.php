<?php
	//on recupere les fonction de Main.php pour réafficher la news
	include_once(path_module("Main","Public"));
	
    $baseline = '';
	$title = "Accueil";
	
if(!function_exists('news_comment_form'))
{	
	function news_comment_form($News)
	{
		$form = '<form method="POST" action="'.get_link('Comments','Public').'">';
		$form .= call_bbcode_editor("Comment_Message");
		//$form .= '<textarea name="Comment_Message" ID="message" rows="10" cols="50"></textarea><br/><br/>';
		$form .= '<input type="hidden" name="Comment_News_ID" value="'.stripslashes_r($News['News_ID']).'"/>';
		$form .='<input type="hidden" name="News_ID" value="'.stripslashes_r($News['News_ID']).'"/>';
		$form .= '<input type="hidden" name="Comment_Date" value="'.date('Y-m-d H:i:s').'"/>';
		$form .= '<input type="hidden" name="Comment_Account_Pseudo" value="'.user_data('Account_Pseudo' ).'"/>';
		$form .= '<input type="hidden" name="token" value="'.generer_token('Comment-'.$News['News_ID']).'" />';
		$form .=  '<input type="submit" name="End_Add" value="Terminer">';
		$form .= '</form>';
		
		return $form ;
	}
}

if(!function_exists('news_comment_record'))
{	
	function news_comment_record($News)
	{
		if(verif_connect(true))
			if(verifier_token(600, get_link('Comments','Public') ,  'Comment-'.$News['News_ID']))
				if (request_confirm('End_Add'))
					if (request_confirm('Comment_Message'))
						insert_db('Caranille_Comments',addslashes_r($_POST));
	}
}

if(!function_exists('news_comment_date'))
{	
	function news_comment_date($comment)
	{
		$_date = new DateTime($comment['Comment_Date']);
		
		return  $_date->format("d/m/Y à H:i");
	}
}

if(!function_exists('news_comment_message'))
{	
	function news_comment_message($comment)
	{
		return stripslashes(bb_code($comment['Comment_Message']));
	}
}
	
	//Search and display game news
	$News = get_db('request_news',$_REQUEST);

	news_comment_record($News);	
	
	$list_comment = list_db('list_comments',$News);
?>
