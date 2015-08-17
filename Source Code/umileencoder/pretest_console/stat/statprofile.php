<?php
	$strProfile = urldecode($_REQUEST['profile']);
	if ($strProfile == '')
		return;
	
	$strUserIP = $_SERVER["REMOTE_ADDR"];
	$strVersion = $_REQUEST['version'];
	
	if (($strVersion == '') || ($strVersion == ' '))
		$strVersion = '3.0.8';	
	
	$strCount = $_REQUEST['count'];
	
	if (($strCount == '') || ($strCount == ' ') ||  ($strCount < 0))
		$strCount = '1';
	
	$strProduct = $_REQUEST['product'];	
	
	if (($strProduct == '') || ($strProduct == ' '))
		$strProduct = '0';	
		
	$strLocale = $_REQUEST['locale'];	
	
	if (($strLocale == '') || ($strLocale == ' '))
		$strLocale = 'en';	
	
	if (($strLocale == 'ko') && (($strVersion == '3.0.8') || ($strVersion == '3.0.9')))
	{
		$strProfile = iconv("EUC-KR", "UTF-8", $strProfile);
	}
	
	include("../include/DBConnection.php");
	require_once("../classes/UmileEncoder.class.php");
	
	$db_conn = mysql_connect($database['server'], $database['username'], $database['password']);
	mysql_query("set names utf8", $db_conn);
	
	$objUmile = new UmileEncoder($database['database']);
	$objUmile->AddStatProfile($strUserIP, $strVersion, $strProfile, $strCount, $strProduct, $strLocale);

	mysql_close($db_conn);
?>