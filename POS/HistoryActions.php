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
	if($_GET["action"] == "list")
	{
	    if (isset($_SESSION['session_user']))
		{
		if ($_SESSION['session_prv_POS_VIEW'] == "Y")
		{
		if ($_SESSION['session_prv_POS_HIST_VIEW'] == "Y")
		{
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM NAGIOS_POS_HISTORY;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];
		//Get records from database
		$result = mysql_query("SELECT * FROM `NAGIOS_POS_HISTORY` ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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
	}
	if($_GET["action"] == "listso")
	{
	    if (isset($_SESSION['session_user']))
		{
		if ($_SESSION['session_prv_POS_VIEW'] == "Y")
		{
		if ($_SESSION['session_prv_POS_HIST_VIEW'] == "Y")
		{
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM NAGIOS_POS_HISTORY;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];
		//Get records from database
		$result = mysql_query("SELECT * FROM  `NAGIOS_POS_HISTORY` WHERE  `Type` =  'SO'  ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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
	}
	
	if($_GET["action"] == "listpos")
	{
	    if (isset($_SESSION['session_user']))
		{
		if ($_SESSION['session_prv_POS_VIEW'] == "Y")
		{
		if ($_SESSION['session_prv_POS_HIST_VIEW'] == "Y")
		{
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM NAGIOS_POS_HISTORY;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];
		//Get records from database
		$result = mysql_query("SELECT * FROM  `NAGIOS_POS_HISTORY` WHERE  `Type` =  'POS'  ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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
	}
	if($_GET["action"] == "listsrv")
	{
	    if (isset($_SESSION['session_user']))
		{
		if ($_SESSION['session_prv_POS_VIEW'] == "Y")
		{
		if ($_SESSION['session_prv_POS_HIST_VIEW'] == "Y")
		{
		$result = mysql_query("SELECT COUNT(*) AS RecordCount FROM NAGIOS_POS_HISTORY;");
		$row = mysql_fetch_array($result);
		$recordCount = $row['RecordCount'];
		//Get records from database
		$result = mysql_query("SELECT * FROM  `NAGIOS_POS_HISTORY` WHERE  `Type` =  'SRV'  ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
		
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
	}
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