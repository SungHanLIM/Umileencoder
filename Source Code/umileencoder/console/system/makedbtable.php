<?php

	$day = date('d');
	if ($day < 27)
	{
		return; // 27일에 DB teble 생성
	}

	include("../include/DBConnection.php");
	require_once("../classes/UmileEncoder.class.php");
	
	$db_conn = mysql_connect($database['server'], $database['username'], $database['password']);
	mysql_query("set names utf8", $db_conn);
	
	$objUmile = new UmileEncoder($database['database']);
	
	$year = date('Y');
	$month = date('m');
		
	if ($month == 12)
	{
		$year++;
		$month = "01";
		
		$objUmile->MakeDBTables_UMILE_AD_VIEW($year);
		$objUmile->MakeDBTables_UMILE_AD_CLICK($year);
		$objUmile->MakeDBTables_UMILE_NOTICE_CLICK($year);
	}
	else
	{
		$month++;
		if (10 > $month)
			$month = "0".$month;
	}
	
	$objUmile->MakeDBTables_UMILE_STAT($year, $month);
	$objUmile->MakeDBTables_UMILE_STATPROFILE($year, $month);

	mysql_close($db_conn);
?>