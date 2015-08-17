<?php

	$day = date('d');
	if ($day < 27)
	{
		return; 
	}

	include("../include/DBConnection.php");
	require_once("../classes/UmileCustomer.class.php");
	
	
	$db_conn = mysql_connect($database['server'], $database['username'], $database['password']);
	mysql_query("set names utf8", $db_conn);
	
	$objUmile = new UmileCustomer($database['database']);
	
	$year = date('Y');
	$month = date('m');
		
	if ($month == 12)
	{
		$year++;
		$month = "01";
	}
	else
	{
		$month++;
		if (10 > $month)
			$month = "0".$month;
	}
	
	$objUmile->MakeDBTables_UMILE_STAT($year, $month);

	mysql_close($db_conn);
?>