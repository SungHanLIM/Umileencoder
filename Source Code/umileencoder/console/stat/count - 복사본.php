
<?php
	$strVersion = $_REQUEST['version'];
	$strType = $_REQUEST['type'];
	
	console.log("Test 111");
	
	if (($strVersion == '') || ($strType == ''))
		return;
		
	$strUserIP = $_SERVER["REMOTE_ADDR"];
	$strLocale = $_REQUEST['locale'];	
	
	if (($strLocale == '') || ($strLocale == ' '))
		$strLocale = 'en';
		
	$strProduct = $_REQUEST['product'];	
	
	if (($strProduct == '') || ($strProduct == ' '))
		$strProduct = '0';	
	
	include("../include/DBConnection.php");
	require_once("../classes/UmileEncoder.class.php");
	
	$db_conn = mysql_connect($database['server'], $database['username'], $database['password']);
	mysql_query("set names utf8", $db_conn);
	
	$objUmile = new UmileEncoder($database['database']);
	$objUmile->MakeDBTables_UMILE_STAT2();
	$result = $objUmile->AddCount($strUserIP, $strVersion, $strType, $strProduct, $strLocale);	

	mysql_close($db_conn);
?>