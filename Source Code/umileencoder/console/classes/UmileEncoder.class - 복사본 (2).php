<?
	/**
 			@filename : UmileEncoder.class.php
 			@description : UmileEncoder Database 클래스 
 	*/

	
	
	class UmileEncoder
	{
		var $databaseName;
		
		function UmileEncoder($dbName) 
		{
			$databaseName = $dbName;
			mysql_select_db($dbName);
			// echo $dbName;
		}
		
		function MakeDBTables($sql)
		{
			// echo $sql;
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
		
		function MakeDBTables_UMILE_AD_VIEW($year)
		{
			$tablename = 'UMILE_AD_VIEW_'.$year;
			
			if (true == $this->CheckTableIsExist($tablename))
				return;
			
			$sql = " CREATE TABLE IF NOT EXISTS `$tablename` (
					  `IDX` bigint(20) NOT NULL auto_increment,
					  `AD_IDX` bigint(20) NOT NULL,
					  `IP` varchar(20) NOT NULL,
					  `CNT` int(11) NOT NULL,
					  `RegDate` datetime NOT NULL,
					  PRIMARY KEY  (`IDX`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1; ";
			
			mysql_query($sql);
		}
		
		function MakeDBTables_UMILE_AD_CLICK($year)
		{
			$tablename = 'UMILE_AD_CLICK_'.$year;
			
			if (true == $this->CheckTableIsExist($tablename))
				return;
			
			$sql = " CREATE TABLE IF NOT EXISTS `$tablename` (
					  `IDX` bigint(20) NOT NULL auto_increment,
					  `AD_IDX` bigint(20) NOT NULL,
					  `IP` varchar(20) NOT NULL,
					  `RegDate` datetime NOT NULL,
					  PRIMARY KEY  (`IDX`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1; ";
			
			mysql_query($sql);
		}
		
		function MakeDBTables_UMILE_NOTICE_CLICK($year)
		{
			$tablename = 'UMILE_NOTICE_CLICK_'.$year;
			
			if (true == $this->CheckTableIsExist($tablename))
				return;
			
			$sql = " CREATE TABLE IF NOT EXISTS `$tablename` (
					  `IDX` bigint(20) NOT NULL auto_increment,
					  `NOTICE_IDX` bigint(20) NOT NULL,
					  `IP` varchar(20) NOT NULL,
					  `RegDate` datetime NOT NULL,
					  PRIMARY KEY  (`IDX`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1; ";
			
			mysql_query($sql);
		}
		
		function MakeDBTables_UMILE_STAT($year, $month)
		{			
			$tablename = 'UMILE_STAT_'.$year.'_'.$month;
			
			if (true == $this->CheckTableIsExist($tablename))
				return;
			
			$sql = " CREATE TABLE IF NOT EXISTS `$tablename` (
					  `IDX` bigint(20) NOT NULL auto_increment,
					  `IP` varchar(20) NOT NULL,
					  `Version` varchar(20) NOT NULL,
					  `Count` int(11) NOT NULL,
					  `Type` int(11) NOT NULL,
					  `Product` int(11) NOT NULL,
					  `Locale` varchar(10) NOT NULL,
					  `RegDate` datetime NOT NULL,
					  PRIMARY KEY  (`IDX`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1; ";
			
			mysql_query($sql);
		}
		
		function MakeDBTables_UMILE_STAT2()
		{
			$datetime = date('Y-m-d H:i:s');
			$year = date('Y');
			$month = date('m');			
			$tablename = 'UMILE_STAT_'.$year.'_'.$month;
			
			if (true == $this->CheckTableIsExist($tablename))
				return;
			
			$sql = " CREATE TABLE IF NOT EXISTS `$tablename` (
					  `IDX` bigint(20) NOT NULL auto_increment,
					  `IP` varchar(20) NOT NULL,
					  `Version` varchar(20) NOT NULL,
					  `Count` int(11) NOT NULL,
					  `Type` int(11) NOT NULL,
					  `Product` int(11) NOT NULL,
					  `Locale` varchar(10) NOT NULL,
					  `RegDate` datetime NOT NULL,
					  PRIMARY KEY  (`IDX`)
					) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1; ";
			
			mysql_query($sql);
		}
		
		
		function MakeDBTables_UMILE_STATPROFILE($year, $month)
		{
			$tablename = 'UMILE_STATPROFILE_'.$year.'_'.$month;
			
			if (true == $this->CheckTableIsExist($tablename))
				return;
			
			$sql = " CREATE TABLE IF NOT EXISTS `$tablename` (
					  `IDX` bigint(20) NOT NULL auto_increment,
					  `IP` varchar(20) character set utf8 NOT NULL,
					  `Version` varchar(20) character set utf8 NOT NULL,
					  `Profile` varchar(100) character set utf8 NOT NULL,
					  `Count` int(11) NOT NULL,
					  `Product` int(11) NOT NULL,
					  `Locale` varchar(10) character set utf8 NOT NULL,
					  `RegDate` datetime NOT NULL,
					  PRIMARY KEY  (`IDX`)
					) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ";
			
			mysql_query($sql);
		}
		
		function MakeDBTables_UMILE_STATPROFILE2()
		{
			$datetime = date('Y-m-d H:i:s');
			$year = date('Y');
			$month = date('m');
			$tablename = 'UMILE_STATPROFILE_'.$year.'_'.$month;
			
			if (true == $this->CheckTableIsExist($tablename))
				return;
			
			
			$sql = " CREATE TABLE IF NOT EXISTS `$tablename` (
					  `IDX` bigint(20) NOT NULL auto_increment,
					  `IP` varchar(20) character set utf8 NOT NULL,
					  `Version` varchar(20) character set utf8 NOT NULL,
					  `Profile` varchar(100) character set utf8 NOT NULL,
					  `Count` int(11) NOT NULL,
					  `Product` int(11) NOT NULL,
					  `Locale` varchar(10) character set utf8 NOT NULL,
					  `RegDate` datetime NOT NULL,
					  PRIMARY KEY  (`IDX`)
					) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1; ";
			
			mysql_query($sql);
		}
		
		
		// 프로그램 설치/삭제/실행에 대한 정보를 기록하는 함수 (UMILE_STAT_year)
		function AddCount($ip, $version, $type, $product, $locale)
		{
			
			$locale = strtolower($locale);
			$datetime = date('Y-m-d H:i:s');
			$year = date('Y');
			$month = date('m');
			$curdate = date('Y-m-d');
			
			$database = 'UMILE_STAT_'.$year.'_'.$month;
				
			$sql =  " select count from $database where ip='$ip' and version='$version' and type=$type and product=$product and locale='$locale' and SUBSTR(regdate,1,10)='$curdate' ";			
			$result = mysql_query($sql);
			
			if ($result)
			{
				if ($rows = mysql_fetch_array($result) ) 
				{
					$count = $rows['count'] + 1;
					$sql = " update $database  set count=$count where ip='$ip' and version='$version' and type=$type and product = $product and locale='$locale' and SUBSTR(regdate,1,10)='$curdate' ";
					mysql_query($sql);
				}
				else
				{
					$sql = " insert into $database (ip, version, count, type, product, locale, regdate) values ( '$ip', '$version', 1, $type, $product, '$locale', '$datetime') ";				
					mysql_query($sql);
				}
			
			}
		}
		
		// Profile 실행에 대한 정보를 기록하는 함수 (UMILE_STATPROFILE_year)
		function AddStatProfile($ip, $version, $profile, $count, $product, $locale)
		{
			$locale = strtolower($locale);
			$datetime = date('Y-m-d H:i:s');
			$year = date('Y');
			$month = date('m');
			$curdate = date('Y-m-d');
			
			$database = 'UMILE_STATPROFILE_'.$year.'_'.$month;
			
			$sql =  " select count from $database where ip='$ip' and version='$version' and profile='$profile' and product=$product and locale='$locale' and SUBSTR(regdate,1,10)='$curdate' ";
			
			$result = mysql_query($sql);

			if ($result)
			{
				if ($rows = mysql_fetch_array($result) ) 
				{
					$count2 = $rows['count'] + $count;
					$sql = " update $database  set count=$count2 where ip='$ip' and version='$version' and profile='$profile' and product=$product and locale='$locale' and SUBSTR(regdate,1,10)='$curdate' ";
					mysql_query($sql);
				}
				else
				{
					$sql = " insert into $database (ip, version, profile, count, product, locale, regdate) values ( '$ip', '$version', '$profile', $count, $product, '$locale', '$datetime') ";				
					mysql_query($sql);
				}
			}
			
		}
		
		// 공지 사항을 사용자가 클릭할 경우 기록하는 함수 (UMILE_NOTICE_CLICK_year)
		function AddNoticeClick($idx, $ip)
		{
			$datetime = date('Y-m-d H:i:s');
			$year = date('Y');
			$database = 'UMILE_NOTICE_CLICK_'.$year;
			
			$sql = " insert into $database (NOTICE_IDX, IP, RegDate) values ($idx, '$ip', '$datetime') ";		
			mysql_query($sql);
		}

		// 공지 사항을 쿼리하는 함수
		function GetNotice($product, $locale)
		{
			$locale = strtolower($locale);
			$vResult = array();
			$curDate = date('Y-m-d');
	
			$sql =  "select IDX, Message, LinkURL from UMILE_NOTICE where product=$product and (LOWER(locale)='$locale' or LOWER(locale)='all') and '$curDate' BETWEEN startDate AND endDate order by IDX asc ";			
			
			$result = mysql_query($sql);
			
			if ($result) 
			{
				while ($rows = mysql_fetch_array($result)) 
				{
					array_push($vResult,
						array("idx" =>$rows['IDX'],
							    "message" =>$rows['Message'],
							    "linkurl" =>$rows['LinkURL']
						)
					);
				}
				mysql_free_result($result);
			}
			
			return $vResult;
		}
		
		// 최신 프로그램의 버젼 정보를 얻는 함수 (UMILE_UPDATE) 
		function GetUpdate($product, $locale)
		{
			$locale = strtolower($locale);
			$vResult = array();
	
			$sql =  "select LastVersion, PageURL from UMILE_UPDATE where product=$product and (LOWER(locale)='$locale' or LOWER(locale)='all') order by IDX desc ";			
			
			$result = mysql_query($sql);
			
			if ($result) 
			{
				if ($rows = mysql_fetch_array($result)) 
				{
					array_push($vResult,
						array("lastversion" =>$rows['LastVersion'],
							    "pageurl" =>$rows['PageURL']
						)
					);
				}
				mysql_free_result($result);
			}
			
			return $vResult;
		}
		
		// 광고 진행을 위한 광고 리스트를 얻는 함수
		function GetAds($product, $locale)
		{
			$locale = strtolower($locale);
			$vResult = array();
			$curDate = date('Y-m-d');
	
			$sql =  "select IDX, Position, Type, ImageUrl, LinkUrl, PageUrl, Title, RollTime, Try from UMILE_AD where product=$product and (LOWER(locale)='$locale' or LOWER(locale)='all') and '$curDate' BETWEEN startDate AND endDate order by IDX asc ";			
			
			$result = mysql_query($sql);
			
			if ($result) 
			{
				while ($rows = mysql_fetch_array($result)) 
				{
					array_push($vResult,
						array("idx" =>$rows['IDX'],
							    "position" =>$rows['Position'],
								"type" =>$rows['Type'],
								"imageurl" =>$rows['ImageUrl'],
								"linkurl" =>$rows['LinkUrl'],
								"pageurl" =>$rows['PageUrl'],
								"title" =>$rows['Title'],
							    "rolltime" =>$rows['RollTime'],
								"try" =>$rows['Try']
						)
					);
				}
				mysql_free_result($result);
			}
			
			return $vResult;
		}
		
		// 광고를 클릭 했을때 기록하는 함수
		function AddAdClick($idx, $ip)
		{
			$datetime = date('Y-m-d H:i:s');
			$year = date('Y');
			$database = 'UMILE_AD_CLICK_'.$year;
			
			$sql = " insert into $database (AD_IDX, IP, RegDate) values ($idx, '$ip', '$datetime') ";		
			mysql_query($sql);
		}
		
		// 광고의 집행(View) 사항를 기록하는 함수
		function AddAdView($idx, $ip, $count)
		{
			$datetime = date('Y-m-d H:i:s');
			$year = date('Y');
			$database = 'UMILE_AD_VIEW_'.$year;
			
			$sql = " insert into $database (AD_IDX, IP, CNT, RegDate) values ($idx, '$ip',  $count, '$datetime') ";		
			mysql_query($sql);
		}
		
		// 광고의 집행(View) 사항를 기록하는 함수
		function Mail_Daily_Summary($locale)
		{
			
			$uselocal = '';
			$yesterday = date('Y-m-d', mktime(0, 0, 0, date("m")  , date("d") - 1, date("Y")));
			$year = substr($yesterday, 0, 4);
			$month = substr($yesterday, 5, 2);
			
			$database = 'UMILE_STATPROFILE_'.$year.'_'.$month;
			
			if ($locale != 'all')
				$uselocal = "locale='$locale' and ";
			
			$sql =  " select count(*), sum(count) from $database where $uselocal SUBSTR(regdate,1,10)='$yesterday' ";	
			
			$result = mysql_query($sql);
			if ($result) 
			{
				if ($rows = mysql_fetch_array($result))
				{
					$user = $rows[0];
					$sum = $rows[1];
					
					mysql_free_result($result);
					
					return array($user, $sum);
				}
			}

			return array(0, 0);
		}
		
		// 다나와 Link 광고 진행을 위한 광고 리스트를 얻는 함수
		function GetDanawaAds($profile)
		{
			$vResult = array();
			
			$sql =  " select IDX, DanawaUrl from UMILE_AD_DANAWA where profile='$profile' ";			
			
			$result = mysql_query($sql);
			
			if ($result) 
			{
				while ($rows = mysql_fetch_array($result)) 
				{
					array_push($vResult, array("idx" =>$rows['IDX'], "danawaurl" =>$rows['DanawaUrl']));
				}
				mysql_free_result($result);
			}
			
			return $vResult;
		}
	}
?>