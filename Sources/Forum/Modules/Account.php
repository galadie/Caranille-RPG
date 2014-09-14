<?php

$membre = intval(request_get('m'));

       $Resultat = list_db('public_diary_list',array('Account_ID'=>$membre));

	   
		$query=get_db('account_forum',array('membre' => $membre));

	   extract($query);