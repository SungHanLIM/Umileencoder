<?php
	//header('Content-Type: text/xml; charset=UTF-8');
	
	//include("../include/DBConnection.php");
	//require_once("../classes/UmileEncoder.class.php");
	//require_once("../classes/XmlWriter.class.php");
	
	$yesterday = date('Ymd', mktime(0, 0, 0, date("m")  , date("d") - 1, date("Y")));
	$nextday = date('Ymd', mktime(0, 0, 0, date("m")  + 10, date("d"), date("Y")));
	
	$year = substr($yesterday, 0, 4);
	$month = substr($yesterday, 4, 2);
	$day  = substr($yesterday, 6, 2);
	
	$myear = substr($nextday, 0, 4);
	$mmonth = substr($nextday, 4, 2);
	$mday  = substr($nextday, 6, 2);
	
	$year++;
	
	$database = 'UMILE_STATPROFILE_'.$year.'_'.$month.'_'.$day;
	echo $database;
	
	echo ' ';
	
	$database2 = 'UMILE_STATPROFILE_'.$myear.'_'.$mmonth.'_'.$mday;
	echo $database2;
?>