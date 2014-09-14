<?php

	$competences = list_db('account_work',array( 'Account_ID' => logged_data('Account_ID') ));
	$jobs = list_db('list_works');
	
?>