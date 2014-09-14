<?php

	function news_date($News)
	{
		 $date = new DateTime($News['News_Date']);
		 
		 return $date->format("d/m/Y à H:i");
	}

	function news_intro($News)
	{
		return stripslashes(nl2br($News['News_Intro']));
	}

	function news_message($News)
	{
		return stripslashes(nl2br($News['News_Message']));
	}

	function news_details_form($News)
	{
		$form ="<a href='".get_link('Comments','Public',array('News_ID' =>$News['News_ID'] ))."'>".LanguageValidation::nMsg("btn.news.details")."</a>".LanguageValidation::eMsg("btn.news.details");
	/**	
		$form .= '<form enctype="multipart/form-data" method="post" action="'.get_link('Comments','Public').'">';
		$form .= '<input type="hidden" name="News_ID" value="'.$News['News_ID'].'"/>';
		$form .= '<input type="hidden" name="token" value="'.generer_token("News-".$News['News_ID']).'"/>';
		//$form .= '<input type="submit" name="Comment" value="Voir la News"/>';
		$form .= '<input type="submit" name="Comment" value="'.LanguageValidation::nMsg("btn.news.details").'"/>'.LanguageValidation::eMsg("btn.news.details");
		$form .= '</form>';
	**/	
		return $form;
	}


    $baseline = '';
	$title = "Accueil";
	

	$month = request_confirm('m') ? str_pad(request_get('m'),2,"0",STR_PAD_LEFT) : date('m');
	$year  = request_confirm('y') ? str_pad(request_get('y'),4,"0",STR_PAD_LEFT) : date('Y');
	
	debug_log("period($year,$month)");

	$period = new DateTime($year."-".$month."-01");//strtotime($_y."-".$_m."-01");//
	$t = intval($period->format('t'));//intval(date('t',$period));//

	debug_log("period=>($year,$month)=>".$t);
	
	$r = array();
	
	for($i = 1; $i <= $t ; $i++)
	{				
        $day = str_pad($i,2,"0",STR_PAD_LEFT);

		$r[$day] = str_replace(0,7,intval($period->format('w')));//str_replace(0,7,intval(date('w',$period)));//
		
		$period->modify('+ 1 day');//add(new DateInterval('P1D'));//+=(24*60*60);//
	}
	
	$pm = intval($month)== 1 ? 12 : $month-1 ;
	$nm = intval($month)== 12 ? 1 : $month+1 ;
	
	$py = intval($month)==  1 ? ($year-1) : $year ;
	$ny = intval($month)== 12 ? ($year+1) : $year ;
?>	