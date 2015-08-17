<?php
	
	$strMac = $_REQUEST['mac'];
	$strProgram = $_REQUEST['program'];
	$strVersion = $_REQUEST['version'];
	$strType = $_REQUEST['type'];
	$strCustomer = $_REQUEST['customer'];
	$strProduct = $_REQUEST['product'];
	$strLocale = $_REQUEST['locale'];	
	$strUserIP = $_SERVER["REMOTE_ADDR"];
	
	if (($strMac == '') || ($strProgram == '') || ($strVersion == '') || 
		($strType == '') || ($strCustomer == '') || ($strProduct == '') || ($strLocale == ''))
		return;
	
	include("../include/DBConnection.php");
	require_once("../classes/UmileCustomer.class.php");
	
	$db_conn = mysql_connect($database['server'], $database['username'], $database['password']);
	mysql_query("set names utf8", $db_conn);
	
	$objUmile = new UmileCustomer($database['database']);
	$result = $objUmile->AddCount($strUserIP, $strMac, $strProgram, $strVersion, $strType, $strCustomer, $strProduct, $strLocale);	

	mysql_close($db_conn);
?>