<?php
	header('Content-Type: text/xml; charset=UTF-8');
	
	$strLocale = $_REQUEST['locale'];	
	
	if (($strLocale == '') || ($strLocale == ' '))
		$strLocale = 'en';
		
	$strProduct = $_REQUEST['product'];	
	
	if (($strProduct == '') || ($strProduct == ' '))
		$strProduct = '0';
		
	$strVersion = $_REQUEST['version'];
	
	if (($strVersion == '') || ($strVersion == ' '))
		return;
		
	include("../include/DBConnection.php");
	require_once("../classes/UmileEncoder.class.php");
	require_once("../classes/XmlWriter.class.php");
	
	$db_conn = mysql_connect($database['server'], $database['username'], $database['password']);
	mysql_query("set names utf8", $db_conn);
	
	$objUmile = new UmileEncoder($database['database']);
	$result = $objUmile->GetAds($strProduct, $strLocale);	
	
	if (count($result) != 0) 
	{
		$cnt = 1;
		$oldPosition = -1;
		$xml = new TNXmlWriter();
		
		$xml->push('Response');
		foreach($result as $vRows) 
		{
			$xml->push('AdInfo',  '');
			$xml->element('Position', $vRows['position']);
			$xml->element('AdIndex', $cnt);
			$xml->element('AdType', $vRows['type']);
			$xml->elementKOR('ImageUrl', $vRows['imageurl']);
			$xml->elementKOR('LinkUrl', $vRows['linkurl']);
			$xml->elementKOR('PageUrl', $vRows['pageurl']);
			$xml->elementKOR('Title', $vRows['title']);
			$xml->element('RollTime', $vRows['rolltime']);
			$xml->element('Try', $vRows['try']);
			$xml->elementKOR('ClickLogUrl', 'http://console.umileencoder.com/ad/clickadv.php?idx='.$vRows['position']);
			$xml->elementKOR('ViewLogUrl', 'http://console.umileencoder.com/ad/viewadv.php?idx='.$vRows['position'].'&count=');
			$xml->pop();
			if ($oldPosition != $vRows['position'])
			{
				$cnt = $cnt + 1;
			}
			else
			{
				$oldPosition = $vRows['position'];
				$cnt = 1;
			}
		}
		$xml->pop();
		
		echo $xml->getXml();
	}
	
	mysql_close($db_conn);
?>