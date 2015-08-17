<?
	/**
 			@filename : UmileCustomer.class.php
 			@description : UmileCustomer Database 클래스 
 	*/

	class UmileCustomer
	{
		function UmileCustomer($dbName) 
		{
			mysql_select_db($dbName);
		}
		
		function MakeDBTables_UMILE_STAT($year, $month)
		{
			$tablename = 'UMILE_STAT_'.$year.'_'.$month;
			
			if (true == $this->CheckTableIsExist($tablename))
				return;
			
			$sql = " CREATE TABLE IF NOT EXISTS `$tablename` (
					  `IDX` int(11) NOT NULL auto_increment,
					  `IP` varchar(20) NOT NULL,
					  `MAC` varchar(40) NOT NULL,
					  `Count` int(11) NOT NULL,
					  `Type` int(11) NOT NULL,
					  `Program` varchar(100) NOT NULL,
					  `Version` varchar(20) NOT NULL,
					  `Customer` varchar(100) NOT NULL,
					  `Product` int(11) NOT NULL,
					  `Locale` varchar(10) NOT NULL,
					  `RegDate` datetime NOT NULL,
					  PRIMARY KEY  (`IDX`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1; ";
			
			mysql_query($sql);
		}
		
		function CheckTableIsExist($tablename)
		{
			$sql =  " SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = '$this->databaseName' AND table_name = '$tablename' ";
			$result = mysql_query($sql);
			
			if ($result)
			{
				if ($rows = mysql_fetch_array($result) ) 
				{
					$count = $rows[0];
					if ($count >= 1)
						return true;
				}
				mysql_free_result($result);
			}
			
			return false;
		}
		
		// 프로그램 설치/삭제/실행에 대한 정보를 기록하는 함수 (UMILE_STAT_year_month)
		function AddCount($ip, $mac, $program, $version, $type, $customer, $product, $locale)
		{
			$locale = strtolower($locale);
			$datetime = date('Y-m-d H:i:s');
			$year = date('Y');
			$month = date('m');
			$curdate = date('Y-m-d');
			
			$database = 'UMILE_STAT_'.$year.'_'.$month;
				
			$sql =  " select count from $database where ip='$ip' and mac='$mac' and version='$version' and type=$type and program='$program' and customer='$customer' and product=$product and locale='$locale' and SUBSTR(regdate,1,10)='$curdate' ";			
			$result = mysql_query($sql);

			if ($result)
			{
				if ($rows = mysql_fetch_array($result) ) 
				{
					$count = $rows['count'] + 1;
					$sql = " update $database  set count=$count where ip='$ip' and mac='$mac' and version='$version' and type=$type and program='$program' and customer='$customer' and product=$product and locale='$locale' and SUBSTR(regdate,1,10)='$curdate' ";
					mysql_query($sql);
				}
				else
				{
					$sql = " insert into $database (ip, mac, version, count, type, program, customer, product, locale, regdate) values ( '$ip', '$mac', '$version', 1, $type, '$program', '$customer', $product, '$locale', '$datetime') ";				
					mysql_query($sql);
				}
			}
		}
		
	}
?>