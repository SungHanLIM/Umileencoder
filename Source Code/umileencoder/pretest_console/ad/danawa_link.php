<?php
	header('Content-Type: text/xml; charset=UTF-8');
	
	$strLocale = $_REQUEST['locale'];	
	
	if ($strLocale != 'kr')
		return;
		
	$strProduct = $_REQUEST['product'];	
	
	if (($strProduct == '') || ($strProduct == ' '))
		$strProduct = '0';
		
	$strProfile = $_REQUEST['profile'];		
	
	include("../include/DBConnection.php");
	require_once("../classes/UmileEncoder.class.php");
	require_once("../classes/XmlWriter.class.php");
	
	$db_conn = mysql_connect($database['server'], $database['username'], $database['password']);
	mysql_query("set names utf8", $db_conn);
	
	$objUmile = new UmileEncoder($database['database']);
	$result = $objUmile->GetDanawaAds($strProfile);
	
	if (count($result) > 0) 
	{
		$xml = new TNXmlWriter();
	
		$xml->push('Response');
		foreach($result as $vRows) 
		{
			$xml->push('DanawaInfo', '');
			$xml->element('Index', $vRows['idx']);
			$xml->element('DanawaUrl', $vRows['danawaurl']);
			$xml->pop();
		}
		$xml->pop();
		
		echo $xml->getXml();
	}
	else
	{
		$xml = new TNXmlWriter();
	
		$xml->push('Response');
		$xml->push('DanawaInfo', '');
		$xml->element('Index', '0');
		$xml->element('DanawaUrl', 'http://www.danawa.com');
		$xml->pop();
		$xml->pop();
		
		echo $xml->getXml();
	}
	
	mysql_close($db_conn);
?>