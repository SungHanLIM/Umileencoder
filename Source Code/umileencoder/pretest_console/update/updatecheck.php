<?php
	header('Content-Type: text/xml; charset=UTF-8');
	
	include("../include/DBConnection.php");
	require_once("../classes/UmileEncoder.class.php");
	require_once("../classes/XmlWriter.class.php");
	
	$strLocale = $_REQUEST['locale'];	
	
	if (($strLocale == '') || ($strLocale == ' '))
		$strLocale = 'en';
		
	$strProduct = $_REQUEST['product'];	
	
	if (($strProduct == '') || ($strProduct == ' '))
		$strProduct = '0';
	
	$db_conn = mysql_connect($database['server'], $database['username'], $database['password']);
	mysql_query("set names utf8", $db_conn);
	
	$objUmile = new UmileEncoder($database['database']);
	$result = $objUmile->GetUpdate($strProduct, $strLocale);	
	
	if (count($result) > 0) 
	{
		$xml = new TNXmlWriter();
		
		$xml->push('Response');
		foreach ($result as $vRows) 
		{
			$xml->push('UpdateInfo');
			$xml->element('LastVersion', $vRows['lastversion']);
			$xml->elementKOR('PageUrl', $vRows['pageurl']);
			$xml->pop();
		}
		$xml->pop();
		
		echo $xml->getXml();
	}
	
	mysql_close($db_conn);
?>