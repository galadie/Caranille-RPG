<?php 

if(verif_connect()) {

function get_months($year='2000',$month='01')
{
	$_m = str_pad($month,2,"0",STR_PAD_LEFT);
	$_y = str_pad($year ,4,"0",STR_PAD_LEFT);
	
	debug_log("period=>($_y,$_m)=>".$_y."-".$_m."-01");
	
	$period = new DateTime($_y."-".$_m."-01");//strtotime($_y."-".$_m."-01");//
	$t = intval($period->format('t'));//intval(date('t',$period));//

	debug_log("period=>($_y,$_m)=>".$t);
	
	$r = array();
	
	for($i = 1; $i <= $t ; $i++)
	{				
        $_i = str_pad($i,2,"0",STR_PAD_LEFT);

		$r[$_i] = str_replace(0,7,intval($period->format('w')));//str_replace(0,7,intval(date('w',$period)));//
		
		$period->modify('+ 1 day');//add(new DateInterval('P1D'));//+=(24*60*60);//
	}
	
	unset($period);
	
	return $r ;
}

function get_opens_days($year='2000')
{
	// Liste des jours feriés
	$arr_bank_holidays[] = mktime(0, 0, 0, 1, 1, $year); // Jour de l'an
	$arr_bank_holidays[] = mktime(0, 0, 0, 5, 1, $year); // Fete du travail
	$arr_bank_holidays[] = mktime(0, 0, 0, 5, 8, $year); // Victoire 1945
	$arr_bank_holidays[] = mktime(0, 0, 0, 7, 14, $year); // Fete nationale
	$arr_bank_holidays[] = mktime(0, 0, 0, 8, 15, $year); // Assomption
	$arr_bank_holidays[] = mktime(0, 0, 0, 11, 1, $year); // Toussaint
	$arr_bank_holidays[] = mktime(0, 0, 0, 11, 11, $year);// Armistice 1918
	$arr_bank_holidays[] = mktime(0, 0, 0, 12, 25, $year); // Noel
			
	// Récupération de paques. Permet ensuite d'obtenir le jour de l'ascension et celui de la pentecote 
	$easter = self::easter_date($year);
	$arr_bank_holidays[] = $easter + 86400; // Paques
	$arr_bank_holidays[] = $easter + (86400*39); // Ascension
	$arr_bank_holidays[] = $easter + (86400*50); // Pentecote   

	return $arr_bank_holidays;
}

    if(request_confirm('End_Add_Event'))
    {
        insert_db('Caranille_Events', $_POST);
    }
    
    if(request_confirm('End_Edit_Event'))
    {
        update_db('Caranille_Events', $_POST);
    }
    
	$month = request_confirm('m') ? str_pad(request_get('m'),2,"0",STR_PAD_LEFT) : date('m');
	$year  = request_confirm('y') ? str_pad(request_get('y'),4,"0",STR_PAD_LEFT) : date('Y');
	
	debug_log("period($year,$month)");

	$calendar = get_months($year,$month);
	
	foreach( $calendar as $day => $week)
	{
		$events[$day] = get_db('request_event',array(
			'date' => "$year-$month-$day%",
			'guild' => guild_data('Guild_ID')
		));
	}
/**
	$list_events = list_db('list_event',array(
			'date' => "$year-$month%",
			'guild' => guild_data('Guild_ID')
		));
**/
		
	$pm = intval($month)== 1 ? 12 : $month-1 ;
	$nm = intval($month)== 12 ? 1 : $month+1 ;
	
	$py = intval($month)==  1 ? ($year-1) : $year ;
	$ny = intval($month)== 12 ? ($year+1) : $year ;
	
	$date = new DateTime($year."-".$month."-01");

}