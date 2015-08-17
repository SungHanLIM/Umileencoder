<?php
	include("../include/DBConnection.php");
	require_once("../classes/UmileEncoder.class.php");
	require_once("../classes/SendMail.class.php");
	
	$db_conn = mysql_connect($database['server'], $database['username'], $database['password']);
	mysql_query("set names utf8", $db_conn);
	
	$objUmile = new UmileEncoder($database['database']);
	$resultAll = $objUmile->Mail_Daily_Summary('all');  // 전체 사용량
	$resultEn = $objUmile->Mail_Daily_Summary('en'); // 해외 사용량
	mysql_close($db_conn);
	
	$yesterday = date('Y-m-d', mktime(0, 0, 0, date("m")  , date("d") - 1, date("Y")));
	$strSubject = '[UmileEncoder] '.$yesterday.' 일일 사용 현황';

	$html = '';
	$html .= '<HTML>'; 
	$html .= '<HEAD>';  
	$html .= '<TITLE>Umile Encoder Summary</TITLE>'; 
	$html .= '</HEAD>'; 
	$html .= '<BODY>';  
	$html .= '<TABLE border="1" cellspacing="0">';  
	$html .= '<TR><TH>구분</TH><TH>사용자</TH><TH>변환파일</TH></TR>'; 
	$html .= '<TR><TD>국내</TD><TD>'.($resultAll[0]-$resultEn[0]).'</TD><TD>'.($resultAll[1]-$resultEn[1]).'</TD></TR>'; 
	$html .= '<TR><TD>국외</TD><TD>'.$resultEn[0].'</TD><TD>'.$resultEn[1].'</TD></TR>'; 
	$html .= '<TR><TD>합계</TD><TD>'.$resultAll[0].'</TD><TD>'.$resultAll[1].'</TD></TR>'; 
	$html .= '</TABLE>';  
	$html .= '</BODY>';  
	$html .= '</HTML>'; 
		
	$dMail = new Sendmail; 
	$dMail->setUseSMTPServer(true); 
	$dMail->setSMTPServer('mail.technonia.com'); 
	$dMail->setSMTPUser('intramail'); 
	$dMail->setSMTPPasswd('#nonia21088123*'); 
	$dMail->setFrom('umileencoder@technonia.com', '=?UTF-8?B?'.base64_encode('Umile Encoder 3').'?='); 
	$dMail->setSubject('=?UTF-8?B?'.base64_encode($strSubject).'?=');
	$dMail->setMailBody($html, true); 
	$dMail->addTo('umile@technonia.com', '=?UTF-8?B?'.base64_encode('Umile Family').'?=');  
	$dMail->send();
?>


