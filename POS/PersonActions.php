<?php
session_start();
$date = new DateTime();
//$date->format('Y-m-d H:i:s');
try
{
	//Open database connection
	$con = mysql_connect("localhost","root","Q");
	mysql_select_db("Nagios_Inventory", $con);

	//Getting records (listAction)
	if($_GET["action"] == "listso")
	{
	    if (isset($_SESSION['session_user']))
		{
		if ($_SESSION['session_prv_POS_VIEW'] == "Y")
		{
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM NAGIOS_POS_SO;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];
		//Get records from database
		$result = mysql_query("SELECT * FROM `NAGIOS_POS_SO` WHERE `ACTIVE` = 'YES'  ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	}
	}
else	if($_GET["action"] == "listpos")  
	{
		if (isset($_SESSION['session_user']))
		{
		if ($_SESSION['session_prv_POS_VIEW'] == "Y")
		{
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM V_NAGIOS_POS_DEV;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];

		//Get records from database
		$result = mysql_query("SELECT * FROM V_NAGIOS_POS_DEV WHERE SO_ID = '". $_GET['SO_ID'] ."' AND ACTIVE = 'YES' ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	}
	}
	else	if($_GET["action"] == "listsrv")  
	{
		if (isset($_SESSION['session_user']))
		{
		if ($_SESSION['session_prv_POS_VIEW'] == "Y")
		{
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM V_NAGIOS_POS;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];

		//Get records from database
		$result = mysql_query("SELECT * FROM `V_NAGIOS_POS` WHERE `POS_DEV_ID` = '". $_GET['POS_DEV_ID'] ."' AND `ACTIVE_SERVICE`= 'YES';");
		
		//Add all records to an array
		$rows = array();
		while($row = mysql_fetch_array($result))
		{
		    $rows[] = $row;
		}

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['TotalRecordCount'] = $recordCount;
		$jTableResult['Records'] = $rows;
		print json_encode($jTableResult);
	}
	}
	}
	
	//Creating a new record (createAction)
	else if($_GET["action"] == "create")
	{   
		if (isset($_SESSION['session_user']))
		{
		if ($_SESSION['session_prv_POS_VIEW'] == "Y")
		{
		if ($_SESSION['session_prv_POS_MMGT'] == "Y")
		{
		//Insert record into database
		$result = mysql_query("INSERT INTO NAGIOS_POS_SO(`SO_ID`, `SO_CITY`, `SO_ADDRESS`, `SO_PHONE`, `SO_WH`, `SO_GPS_LA`, `SO_GPS_LO`, `ACTIVE`) VALUES (".$_POST["SO_ID"].",'". $_POST["SO_CITY"]. "','".$_POST["SO_ADDRESS"]."','".$_POST["SO_PHONE"]."','".$_POST["SO_WH"]."',".$_POST["SO_GPS_LA"].",".$_POST["SO_GPS_LO"].",'".$_POST["ACTIVE"]."' )");
		
		//Get last inserted record (to return to jTable)
		$result = mysql_query("SELECT * FROM NAGIOS_POS_SO WHERE SO_ID = '".$_POST["SO_ID"]."' AND ACTIVE = '".$_POST["ACTIVE"]."'  ");
		$histQ = mysql_query ("INSERT INTO `NAGIOS_POS_HISTORY`(`ID`, `Type` , `Source`, `Destination`, `Date`, `Login`, `Comment`, `Status`) VALUES (NULL,'SO','NEW','".$_POST["SO_ID"]." ".$_POST["SO_CITY"]." ".$_POST["SO_ADDRESS"]." ".$_POST["SO_PHONE"]." ".$_POST["SO_WH"]." ".$_POST["SO_GPS_LA"]." ".$_POST["SO_GPS_LO"]." ".$_POST["ACTIVE"]."','".$date->format('Y-m-d H:i:s')."','".$_SESSION['session_user']."','NEW SO','NEW')");
		$row = mysql_fetch_array($result);

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row;
		print json_encode($jTableResult);
	}
	}
	}
	}
	else if($_GET["action"] == "createpos")
	{	
		if (isset($_SESSION['session_user']))
		{
		if ($_SESSION['session_prv_POS_VIEW'] == "Y")
		{
		if ($_SESSION['session_prv_POS_MMGT'] == "Y")
		{
		//Insert record into database
		$check = mysql_query("SELECT COUNT( * ) AS RecordCount FROM NAGIOS_POS_ST WHERE  `POS_ID` = ".$_POST["POS_ID"]."");
		$value = mysql_fetch_array($check);
		$count = $value['RecordCount'];
		//echo ($count);
		if ( $count == "0" )
			{
			$resultpos = mysql_query("INSERT INTO `NAGIOS_POS_ST` (`SO_ID`, `POS_ID`) VALUES (".$_GET["SO_ID"].",".$_POST["POS_ID"]." )");
		//$resultserv = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID_DEV"]. "'),NULL,3,4,5,6)");
			}
		$result = mysql_query("INSERT INTO  `Nagios_Inventory`.`NAGIOS_POS_DEV` (`POS_DEV_ID` ,`POS_ID` ,`POS_DEV_TYPE` ,`POS_DEV_LAN_IP` ,`POS_DEV_WAN_IP` ,`POS_DEV_SVN_NO` ,`POS_DEV_PORT_NO` ,`POS_DEV_STATUS` ,`POS_DEV_OUTPUT` ,`POS_DEV_DATETIME`) VALUES ('NULL','" . $_POST["POS_ID"]. "','". $_POST["POS_DEV_TYPE"]. "','". $_POST["POS_DEV_LAN_IP"]. "','". $_POST["POS_DEV_WAN_IP"]. "','". $_POST["POS_DEV_SVN_NO"]. "','". $_POST["POS_DEV_PORT_NO"]. "','UP','-','-')");
		$histQ = mysql_query ("INSERT INTO `NAGIOS_POS_HISTORY`(`ID`, `Type` , `Source`, `Destination`, `Date`, `Login`, `Comment`, `Status`) VALUES (NULL,'POS','NEW','".$_POST["POS_ID"]." ".$_POST["POS_DEV_TYPE"]." ".$_POST["POS_DEV_LAN_IP"]." ".$_POST["POS_DEV_WAN_IP"]." ".$_POST["POS_DEV_SVN_NO"]." ".$_POST["POS_DEV_PORT_NO"]." ".$_POST["ACTIVE"]."','".$date->format('Y-m-d H:i:s')."','".$_SESSION['session_user']."','NEW POS','NEW')");
	
		if ( $_POST["POS_DEV_TYPE"] == "PC")
		{
		
		$resultPING = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'PING','UP','-','-')");
		$resultASYNC = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'AsyncDocHandler','UP','-','-')");
		$resultDRIVE = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'Drive Usage','UP','-','-')");
		$resultMEM = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'Memory Usage','UP','-','-')");
		$resultCPU = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'CPU Load','UP','-','-')");
			
		$Nagios = file_get_contents('http://10.134.47.1/NMC/POS/Nagios_int?sel=PC&so='.$_GET["SO_ID"].'&posid='.$_POST["POS_ID"].'');
		
		}
		
		else if ( $_POST["POS_DEV_TYPE"] =="VRRP")
		{
		$resultPING = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'PING','UP','-','-')");		
		$Nagios = file_get_contents('http://10.134.47.1/NMC/POS/Nagios_int?sel=VRRP&so='.$_GET["SO_ID"].'&posid='.$_POST["POS_ID"].'');
		}
		
		else if ( $_POST["POS_DEV_TYPE"] =="Pinpad")
		{
		$resultPING = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'PING','UP','-','-')");
		$Nagios = file_get_contents('http://10.134.47.1/NMC/POS/Nagios_int?sel=Pinpad&so='.$_GET["SO_ID"].'&posid='.$_POST["POS_ID"].'');
		}
		
		else if ( $_POST["POS_DEV_TYPE"] =="Primary router 3G")
		{
		$resultPING = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'PING','UP','-','-')");
		$resultSignal = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'Signal Strength','UP','-','-')");
		$resultGre = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'GRE Status','UP','-','-')");	
		$Nagios = file_get_contents('http://10.134.47.1/NMC/POS/Nagios_int?sel=PR3G&so='.$_GET["SO_ID"].'&posid='.$_POST["POS_ID"].'');
		}
		
		else if ( $_POST["POS_DEV_TYPE"] =="Primary router CDMA")
		{
		$resultPING = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'PING','UP','-','-')");
		$resultSignal = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'Signal Strength','UP','-','-')");
		$resultGre = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'GRE Status','UP','-','-')");	
		}
		
		else if ( $_POST["POS_DEV_TYPE"] =="Primary router VSAT")
		{
		$resultPING = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'PING','UP','-','-')");
		}
		
		else if ( $_POST["POS_DEV_TYPE"] =="Primary router DSL")
		{
		$resultPING = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'PING','UP','-','-')");
		$Nagios = file_get_contents('http://10.134.47.1/NMC/POS/Nagios_int?sel=PDSL&so='.$_GET["SO_ID"].'&posid='.$_POST["POS_ID"].'');
		}
		
		else if ( $_POST["POS_DEV_TYPE"] =="Secondary router 3G")
		{
		$resultPING = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'PING','UP','-','-')");
		$resultSignal = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'Signal Strength','UP','-','-')");
		$resultGre = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'GRE Status','UP','-','-')");	
		$Nagios = file_get_contents('http://10.134.47.1/NMC/POS/Nagios_int?sel=SR3G&so='.$_GET["SO_ID"].'&posid='.$_POST["POS_ID"].'');
		}
		
		else if ( $_POST["POS_DEV_TYPE"] =="Secondary router CDMA")
		{
		$resultPING = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'PING','UP','-','-')");
		$resultSignal = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'Signal Strength','UP','-','-')");
		$resultGre = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'GRE Status','UP','-','-')");	
		}
		
		else if ( $_POST["POS_DEV_TYPE"] =="Secondary router VSAT")
		{
		$resultPING = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'PING','UP','-','-')");
		}
		
		else if ( $_POST["POS_DEV_TYPE"] =="Secondary router DSL")
		{
		$resultPING = mysql_query("INSERT INTO `NAGIOS_POS_SERV`(`POS_DEV_ID`, `POS_SERV_ID`, `POS_SERV_TYPE`, `POS_SERV_STATUS`, `POS_SERV_OUTPUT`, `POS_SERV_Date`) VALUES ((SELECT `POS_DEV_ID` FROM `NAGIOS_POS_DEV` WHERE `POS_ID` = '" . $_POST["POS_ID"]. "' AND `POS_DEV_TYPE` = '" . $_POST["POS_DEV_TYPE"]. "'),NULL,'PING','UP','-','-')");
		}
		
		
		//Get last inserted record (to return to jTable)
		//$result = mysql_query("SELECT * FROM NAGIOS_POS_ST WHERE POS_ID = ".$_POST["POS_ID_DEV"]."");
		$result = mysql_query("SELECT * FROM `V_NAGIOS_POS` ;");
		$row = mysql_fetch_array($result);
		
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		$jTableResult['Record'] = $row; 
		print json_encode($jTableResult);
		}
		}
		}
		}
	//Updating a record (updateAction)
	else if($_GET["action"] == "update")
	{	
		if (isset($_SESSION['session_user']))
		{
		if ($_SESSION['session_prv_POS_VIEW'] == "Y")
		{
			if ($_SESSION['session_prv_POS_MMGT'] == "Y")
		{
		//Update record in database
				
		$q = mysql_query ("SELECT SO_CITY FROM `NAGIOS_POS_SO` WHERE `SO_ID` = '" . $_POST["SO_ID"] . "'");
		$value = mysql_fetch_array($q);
		$city = $value['SO_CITY'];
		
		$q = mysql_query ("SELECT SO_ADDRESS FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_POST["SO_ID"]."");
		$value = mysql_fetch_array($q);
		$addr = $value['SO_ADDRESS'];
		
		$q = mysql_query ("SELECT SO_PHONE FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_POST["SO_ID"]."");
		$value = mysql_fetch_array($q);
		$phone = $value['SO_PHONE'];
		
		$q = mysql_query ("SELECT SO_WH FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_POST["SO_ID"]."");
		$value = mysql_fetch_array($q);
		$wh = $value['SO_WH'];
		
		$q = mysql_query ("SELECT SO_GPS_LA FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_POST["SO_ID"]."");
		$value = mysql_fetch_array($q);
		$gpsla = $value['SO_GPS_LA'];
		
		$q = mysql_query ("SELECT SO_GPS_LO FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_POST["SO_ID"]."");
		$value = mysql_fetch_array($q);
		$gpslo = $value['SO_GPS_LO'];
		
		$q = mysql_query ("SELECT ACTIVE FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_POST["SO_ID"]."");
		$value = mysql_fetch_array($q);
		$active = $value['ACTIVE'];
		
		$histQ = mysql_query ("INSERT INTO `NAGIOS_POS_HISTORY`(`ID`, `Type`, `Source`, `Destination`, `Date`, `Login`, `Comment`, `Status`) VALUES (NULL,'SO','".$_POST["SO_ID"]." ".$city." ".$addr." ".$phone." ".$wh." ".$gpsla." ".$gpslo." ".$active."','".$_POST["SO_ID"]." ".$_POST["SO_CITY"]." ".$_POST["SO_ADDRESS"]." ".$_POST["SO_PHONE"]." ".$_POST["SO_WH"]." ".$_POST["SO_GPS_LA"]." ".$_POST["SO_GPS_LO"]." ".$_POST["ACTIVE"]."','".$date->format('Y-m-d H:i:s')."','".$_SESSION['session_user']."','UPDATE SO','UPDATE')");
		$result = mysql_query("UPDATE NAGIOS_POS_SO SET  SO_CITY = '" . $_POST["SO_CITY"] . "',SO_ADDRESS= '" . $_POST["SO_ADDRESS"] . "',SO_PHONE= '" . $_POST["SO_PHONE"] . "',SO_WH= '" . $_POST["SO_WH"] . "',SO_GPS_LA= '" . $_POST["SO_GPS_LA"] . "',SO_GPS_LO= '" . $_POST["SO_GPS_LO"] . "',ACTIVE= '".$_POST["ACTIVE"]."' WHERE SO_ID = '" . $_POST["SO_ID"] . "';");

	//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	}
	}
	}
	
	else if($_GET["action"] == "updatepos")
	{ 
		if (isset($_SESSION['session_user']))
		{
		if ($_SESSION['session_prv_POS_VIEW'] == "Y")
		{
			if ($_SESSION['session_prv_POS_MMGT'] == "Y")
		{
		
		$q = mysql_query ("SELECT POS_ID FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = ".$_POST["POS_DEV_ID"]."");
		$value = mysql_fetch_array($q);
		$posid = $value['POS_ID'];
		
		$q = mysql_query ("SELECT POS_DEV_TYPE FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = ".$_POST["POS_DEV_ID"]."");
		$value = mysql_fetch_array($q);
		$devtype = $value['POS_DEV_TYPE'];
		
		$q = mysql_query ("SELECT POS_DEV_LAN_IP FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = ".$_POST["POS_DEV_ID"]."");
		$value = mysql_fetch_array($q);
		$lip = $value['POS_DEV_LAN_IP'];
		
		$q = mysql_query ("SELECT POS_DEV_WAN_IP FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = ".$_POST["POS_DEV_ID"]."");
		$value = mysql_fetch_array($q);
		$wip = $value['POS_DEV_WAN_IP'];
		
		$q = mysql_query ("SELECT POS_DEV_SVN_NO FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = ".$_POST["POS_DEV_ID"]."");
		$value = mysql_fetch_array($q);
		$sn = $value['POS_DEV_SVN_NO'];
		
		$q = mysql_query ("SELECT POS_DEV_PORT_NO FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = ".$_POST["POS_DEV_ID"]."");
		$value = mysql_fetch_array($q);
		$port = $value['POS_DEV_PORT_NO'];
		
		$q = mysql_query ("SELECT ACTIVE FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = ".$_POST["POS_DEV_ID"]."");
		$value = mysql_fetch_array($q);
		$active = $value['ACTIVE'];
		
		$histQ = mysql_query ("INSERT INTO `NAGIOS_POS_HISTORY`(`ID`, `Type`, `Source`, `Destination`, `Date`, `Login`, `Comment`, `Status`) VALUES (NULL,'POS','".$posid." ".$devtype." ".$lip." ".$wip." ".$sn." ".$port." ".$active."','".$posid." " . $_POST["POS_DEV_TYPE"] . " " . $_POST["POS_DEV_LAN_IP"] . " " . $_POST["POS_DEV_WAN_IP"] . " " . $_POST["POS_DEV_SVN_NO"] . " " . $_POST["POS_DEV_PORT"] . " " . $_POST["ACTIVE"] . " ','".$date->format('Y-m-d H:i:s')."','".$_SESSION['session_user']."','UPDATE POS','UPDATE')");
		
		//Update record in database
		$result = mysql_query("UPDATE NAGIOS_POS_DEV SET POS_DEV_TYPE = '" . $_POST["POS_DEV_TYPE"] . "', POS_DEV_LAN_IP = '" . $_POST["POS_DEV_LAN_IP"] . "', POS_DEV_WAN_IP = '" . $_POST["POS_DEV_WAN_IP"] . "', POS_DEV_SVN_NO = '" . $_POST["POS_DEV_SVN_NO"] . "', POS_DEV_PORT_NO = '" . $_POST["POS_DEV_PORT_NO"] . "',ACTIVE= '".$_POST["ACTIVE"]."' WHERE POS_DEV_ID = '" . $_POST["POS_DEV_ID"] . "';");

		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	}
	}
	}
	
	//Deleting a record (deleteAction)
	else if($_GET["action"] == "delete")
	{
		if (isset($_SESSION['session_user']))
		{
		if ($_SESSION['session_prv_POS_VIEW'] == "Y")
		{
			if ($_SESSION['session_prv_POS_MMGT'] == "Y")
		{
		//Delete from database
		//$result = mysql_query("DELETE FROM NAGIOS_POS_SO WHERE SO_ID = '" . $_POST["SO_ID"] . "';");
		$result = mysql_query("UPDATE NAGIOS_POS_SO SET  ACTIVE= 'NO' WHERE SO_ID = '" . $_POST["SO_ID"] . "';");
		$result = mysql_query("UPDATE `V_NAGIOS_POS_DEV` SET `ACTIVE`='NO' WHERE `SO_ID`='" . $_POST["SO_ID"] . "';");
		$result = mysql_query("UPDATE `V_NAGIOS_POS` SET `ACTIVE_SERVICE`='NO' WHERE `SO_ID`='" . $_POST["SO_ID"] . "';");
		
		$q = mysql_query ("SELECT SO_CITY FROM `NAGIOS_POS_SO` WHERE `SO_ID` = '" . $_POST["SO_ID"] . "'");
		$value = mysql_fetch_array($q);
		$city = $value['SO_CITY'];
		
		$q = mysql_query ("SELECT SO_ADDRESS FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_POST["SO_ID"]."");
		$value = mysql_fetch_array($q);
		$addr = $value['SO_ADDRESS'];
		
		$q = mysql_query ("SELECT SO_PHONE FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_POST["SO_ID"]."");
		$value = mysql_fetch_array($q);
		$phone = $value['SO_PHONE'];
		
		$q = mysql_query ("SELECT SO_WH FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_POST["SO_ID"]."");
		$value = mysql_fetch_array($q);
		$wh = $value['SO_WH'];
		
		$q = mysql_query ("SELECT SO_GPS_LA FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_POST["SO_ID"]."");
		$value = mysql_fetch_array($q);
		$gpsla = $value['SO_GPS_LA'];
		
		$q = mysql_query ("SELECT SO_GPS_LO FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_POST["SO_ID"]."");
		$value = mysql_fetch_array($q);
		$gpslo = $value['SO_GPS_LO'];
		
		$q = mysql_query ("SELECT ACTIVE FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_POST["SO_ID"]."");
		$value = mysql_fetch_array($q);
		$active = $value['ACTIVE'];
		
		$histQ = mysql_query ("INSERT INTO `NAGIOS_POS_HISTORY`(`ID`, `Type`, `Source`, `Destination`, `Date`, `Login`, `Comment`, `Status`) VALUES (NULL,'SO','DELETE','".$_POST["SO_ID"]." ".$city." ".$addr." ".$phone." ".$wh." ".$gpsla." ".$gpslo." ".$active."','".$date->format('Y-m-d H:i:s')."','".$_SESSION['session_user']."','DELETE SO','DELETE')");
		
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	}
	}
	}
	
	else if($_GET["action"] == "deletepos")
	{
			if (isset($_SESSION['session_user']))
		{
		if ($_SESSION['session_prv_POS_VIEW'] == "Y")
		{
			if ($_SESSION['session_prv_POS_MMGT'] == "Y")
		{
		//Delete from database
		//$result = mysql_query("DELETE FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = '".$_POST["POS_DEV_ID"]."' ;");
		$result = mysql_query("UPDATE NAGIOS_POS_DEV SET ACTIVE= 'NO' WHERE POS_DEV_ID = '" . $_POST["POS_DEV_ID"] . "';");
		$result = mysql_query("UPDATE `V_NAGIOS_POS` SET `ACTIVE_SERVICE`='NO' WHERE `POS_DEV_ID`='" . $_POST["POS_DEV_ID"] . "';");
		
		$q = mysql_query ("SELECT POS_ID FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = ".$_POST["POS_DEV_ID"]."");
		$value = mysql_fetch_array($q);
		$posid = $value['POS_ID'];
		
		$q = mysql_query ("SELECT POS_DEV_TYPE FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = ".$_POST["POS_DEV_ID"]."");
		$value = mysql_fetch_array($q);
		$devtype = $value['POS_DEV_TYPE'];
		
		$q = mysql_query ("SELECT POS_DEV_LAN_IP FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = ".$_POST["POS_DEV_ID"]."");
		$value = mysql_fetch_array($q);
		$lip = $value['POS_DEV_LAN_IP'];
		
		$q = mysql_query ("SELECT POS_DEV_WAN_IP FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = ".$_POST["POS_DEV_ID"]."");
		$value = mysql_fetch_array($q);
		$wip = $value['POS_DEV_WAN_IP'];
		
		$q = mysql_query ("SELECT POS_DEV_SVN_NO FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = ".$_POST["POS_DEV_ID"]."");
		$value = mysql_fetch_array($q);
		$sn = $value['POS_DEV_SVN_NO'];
		
		$q = mysql_query ("SELECT POS_DEV_PORT_NO FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = ".$_POST["POS_DEV_ID"]."");
		$value = mysql_fetch_array($q);
		$port = $value['POS_DEV_PORT_NO'];
		
		$q = mysql_query ("SELECT ACTIVE FROM `NAGIOS_POS_DEV` WHERE `POS_DEV_ID` = ".$_POST["POS_DEV_ID"]."");
		$value = mysql_fetch_array($q);
		$active = $value['ACTIVE'];
		
		$histQ = mysql_query ("INSERT INTO `NAGIOS_POS_HISTORY`(`ID`, `Type`, `Source`, `Destination`, `Date`, `Login`, `Comment`, `Status`) VALUES (NULL,'POS','DELETE','".$_POST["POS_DEV_ID"]." ".$posid." ".$devtype." ".$lip." ".$wip." ".$sn." ".$port." ".$active."','".$date->format('Y-m-d H:i:s')."','".$_SESSION['session_user']."','DELETE SO','DELETE')");
		
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	}
	}
	}
	
	else if($_GET["action"] == "deletesrv")
	{
		if (isset($_SESSION['session_user']))
		{
		if ($_SESSION['session_prv_POS_VIEW'] == "Y")
		{
			if ($_SESSION['session_prv_POS_MMGT'] == "Y")
		{
		//Delete from database
		//$result = mysql_query("DELETE FROM `NAGIOS_POS_SERV` WHERE `POS_SERV_ID` = '".$_POST["POS_SERV_ID"]."' ;");
		$result = mysql_query("UPDATE NAGIOS_POS_SERV SET ACTIVE= 'NO' WHERE POS_SERV_ID = '" . $_POST["POS_SERV_ID"] . "';");
		//Return result to jTable
		$jTableResult = array();
		$jTableResult['Result'] = "OK";
		print json_encode($jTableResult);
	}
	}
	}
	}
	//Close database connection
	mysql_close($con);

}
catch(Exception $ex)
{
    //Return error messSO_CITY
	$jTableResult = array();
	$jTableResult['Result'] = "ERROR";
	$jTableResult['MessSO_CITY'] = $ex->getMessSO_CITY();
	print json_encode($jTableResult);
}
	
?>