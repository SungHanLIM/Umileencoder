<?php
	$strIDX = $_REQUEST['idx'];
	$strCount = $_REQUEST['count'];
	
	if ($strIDX == '')
		return;
		
	if ($strCount == '')
		$strCount = 1;
		
	include("../include/DBConnection.php");
	require_once("../classes/UmileEncoder.class.php");
	
	$db_conn = mysql_connect($database['server'], $database['username'], $database['password']);
	mysql_query("set names utf8", $db_conn);
	
	$strUserIP = $_SERVER["REMOTE_ADDR"];	
	
	$objUmile = new UmileEncoder($database['database']);
	$result = $objUmile->AddAdvView($strIDX, $strUserIP, $strCount);	

	mysql_close($db_conn);
?>