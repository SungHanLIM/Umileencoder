<?php
	$strProduct = $_REQUEST['product'];	
	
	if (($strProduct == '') || ($strProduct == ' '))
		$strProduct = '0';	
		
	$strLocale = $_REQUEST['locale'];
	
	if (($strLocale == '') || ($strLocale == ' '))
		$strLocale = 'en';
		
	if ($strLocale == 'en')								// 영어
	{
		echo "<script> window.location.replace('http://www.umileencoder.com/en/tutorial/tutorial_install.html');</script>";
	}
	else if ($strLocale == 'kr')						// 한국어
	{
		echo "<script> window.location.replace('http://www.umileencoder.com/kr/tutorial/tutorial_install.html');</script>";
	}
	else if ($strLocale == 'ch')						// 중국어
	{
		echo "<script> window.location.replace('http://www.umileencoder.com/ch/tutorial/tutorial_install.html');</script>";
	}
	else if ($strLocale == 'ja')						// 일본어
	{
		echo "<script> window.location.replace('http://www.umileencoder.com/ja/tutorial/tutorial_install.html');</script>";
	}
	else												// 기타언어
	{
		echo "<script> window.location.replace('http://www.umileencoder.com/en/tutorial/tutorial_install.html');</script>";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<title>Umile Encoder Tutorial</title>
	<script type="text/javascript">
  		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-9158388-3']);
  		_gaq.push(['_trackPageview']);

  		(function() {
    			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  		})();
	</script>
</head>
<body>
</body>
</html>
