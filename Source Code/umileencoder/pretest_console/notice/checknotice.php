<?php
	header('Content-Type: text/xml; charset=UTF-8');
	
	$strLocale = $_REQUEST['locale'];	
	
	if (($strLocale == '') || ($strLocale == ' '))
		$strLocale = 'en';
		
	$strProduct = $_REQUEST['product'];	
	
	if (($strProduct == '') || ($strProduct == ' '))
		$strProduct = '0';
		
	include("../include/DBConnection.php");
	require_once("../classes/UmileEncoder.class.php");
	require_once("../classes/XmlWriter.class.php");	
	
	$db_conn = mysql_connect($database['server'], $database['username'], $database['password']);
	mysql_query("set names utf8", $db_conn);
	
	$objUmile = new UmileEncoder($database['database']);
	$result = $objUmile->GetNotice($strProduct, $strLocale);	
	
	if (count($result) > 0) 
	{
		$cnt = 1;
		$saveurl = 'http://console.umileencoder.com/notice/clicknotice.php?idx=';
		
		$xml = new TNXmlWriter();
		
		$xml->push('Response');
		foreach($result as $vRows) 
		{
			$xml->push('NoticeInfo',  '');
			$xml->element('Index', $cnt);
			$xml->elementKOR('Message', $vRows['message']);
			$xml->elementKOR('LinkUrl', $vRows['linkurl']);
			$xml->elementKOR('LogUrl', $saveurl.$vRows['idx']);
			$xml->pop();
			$cnt = $cnt + 1;
		}
		$xml->pop();
		
		echo $xml->getXml();
	}
	
	mysql_close($db_conn);
?>