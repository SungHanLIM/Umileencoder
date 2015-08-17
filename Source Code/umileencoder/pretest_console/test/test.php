<?php
	//header('Content-Type: text/xml; charset=UTF-8');
	
	//include("../include/DBConnection.php");
	//require_once("../classes/UmileEncoder.class.php");
	//require_once("../classes/XmlWriter.class.php");
	
	$yesterday = date('Y-m-d', mktime(0, 0, 0, date("m")  , date("d") - 1, date("Y")));
	
	$year = substr($yesterday, 0, 4);
	$month = substr($yesterday, 5, 2);
	
	$database = 'UMILE_STATPROFILE_'.$year.'_'.$month;
	echo $database;
?>