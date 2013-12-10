<?php
session_start();
$date = new DateTime();
require_once('../engine.php');	
try
{
	//Open database connection
	$con = mysql_connect("localhost","root","Q");
	mysql_select_db("Nagios_Inventory", $con);
	
if ($_GET['sel'] == 'PC')
{

echo "OK";

	$q = mysql_query ("SELECT SO_CITY FROM `NAGIOS_POS_SO` WHERE `SO_ID` = '" . $_GET["so"] . "'");
		$value = mysql_fetch_array($q);
		$city = $value['SO_CITY'];
		
		$q = mysql_query ("SELECT SO_ADDRESS FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$addr = $value['SO_ADDRESS'];
		
		$q = mysql_query ("SELECT SO_PHONE FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$phone = $value['SO_PHONE'];
		
		$q = mysql_query ("SELECT SO_WH FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$wh = $value['SO_WH'];
		
		$q = mysql_query ("SELECT SO_GPS_LA FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$gpsla = $value['SO_GPS_LA'];
		
		$q = mysql_query ("SELECT SO_GPS_LO FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$gpslo = $value['SO_GPS_LO'];

		$q = mysql_query ("SELECT `POS_DEV_LAN_IP` FROM NAGIOS_POS_DEV WHERE `POS_ID` = '".$_GET["posid"]."' AND `POS_DEV_TYPE` = 'PC'");
		$value = mysql_fetch_array($q);
		$iplan = $value['POS_DEV_LAN_IP'];
		
$file = '/usr/local/nagios/etc/objects/POS/NEW/PC/'.$_GET['so'].'_'.$_GET['posid'].'_PC.cfg';
$config = 'define host{
        use                    POS-PC-HOST            
        host_name      '.$_GET['so'].'_POS_'.$_GET['posid'].'_PC
        parents			 '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router, '.$_GET['so'].'_POS_'.$_GET['posid'].'_Secondary_Router
        alias                  PC '.$city.'  '.$addr.'  '.$phone.'  '.$wh.'  '.$gpsla.' '.$gpslo.' 
        address          '.$iplan.'
		2d_coords		'.$gpsla.','.$gpslo.' 
		3d_coords 	'.$gpsla.','.$gpslo.',0
		notes latlng: 	'.$gpsla.','.$gpslo.' 
 }

 #PC services

define service{
	use					POS-PC-CPU-LOAD
	host_name       '.$_GET['so'].'_POS_'.$_GET['posid'].'_PC
	service_description	 CPU Load
	}



# Create a service for monitoring memory usage
# Change the host_name to match the name of the host you defined above

define service{
	use					POS-PC-MEMORY-USAGE
	host_name      '.$_GET['so'].'_POS_'.$_GET['posid'].'_PC
	service_description	 Memory Usage
	}



# Create a service for monitoring C:\ disk usage
# Change the host_name to match the name of the host you defined above

define service{
	use					POS-PC-DISK-SPACE
	host_name      '.$_GET['so'].'_POS_'.$_GET['posid'].'_PC
	service_description C:\ Drive Space
	}

# Create a service for monitoring the W3SVC service
# Change the host_name to match the name of the host you defined above

# Create a service for monitoring the Explorer.exe process
# Change the host_name to match the name of the host you defined above

define service{
        use                     POS-PC-SERVICE-ASYNC
        host_name               '.$_GET['so'].'_POS_'.$_GET['posid'].'_PC
        service_description  AsyncDocHandler
	}
	
define service{
        use                     POS-PC-SERIAL
        host_name                '.$_GET['so'].'_POS_'.$_GET['posid'].'_PC
        service_description  Serial Number
	}

';
$create = file_put_contents($file, $config);
}
if ($_GET['sel'] == 'Pinpad')
{

echo "OK";

	$q = mysql_query ("SELECT SO_CITY FROM `NAGIOS_POS_SO` WHERE `SO_ID` = '" . $_GET["so"] . "'");
		$value = mysql_fetch_array($q);
		$city = $value['SO_CITY'];
		
		$q = mysql_query ("SELECT SO_ADDRESS FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$addr = $value['SO_ADDRESS'];
		
		$q = mysql_query ("SELECT SO_PHONE FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$phone = $value['SO_PHONE'];
		
		$q = mysql_query ("SELECT SO_WH FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$wh = $value['SO_WH'];
		
		$q = mysql_query ("SELECT SO_GPS_LA FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$gpsla = $value['SO_GPS_LA'];
		
		$q = mysql_query ("SELECT SO_GPS_LO FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$gpslo = $value['SO_GPS_LO'];

		$q = mysql_query ("SELECT `POS_DEV_LAN_IP` FROM NAGIOS_POS_DEV WHERE `POS_ID` = '".$_GET["posid"]."' AND `POS_DEV_TYPE` = 'Pinpad'");
		$value = mysql_fetch_array($q);
		$iplan = $value['POS_DEV_LAN_IP'];
		
$file = '/usr/local/nagios/etc/objects/POS/NEW/Pinpad/'.$_GET['so'].'_'.$_GET['posid'].'_Pinpad.cfg';
$config = 'define host{
        use                    POS-PINPAD-HOST           
        host_name      '.$_GET['so'].'_POS_'.$_GET['posid'].'_Pinpad
        parents			 '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router, '.$_GET['so'].'_POS_'.$_GET['posid'].'_Secondary_Router
        alias                  Pinpad '.$city.'  '.$addr.'  '.$phone.'  '.$wh.'  '.$gpsla.' '.$gpslo.' 
        address                '.$iplan.'
		2d_coords		'.$gpsla.','.$gpslo.' 
		3d_coords 	'.$gpsla.','.$gpslo.',0
		notes latlng: 	'.$gpsla.','.$gpslo.' 
 }
 
 define service{
         use                   POS-PINPAD-PING
        host_name                '.$_GET['so'].'_POS_'.$_GET['posid'].'_Pinpad
        service_description   PING  '.$iplan.'
        } 
 
 ';
$create = file_put_contents($file, $config);
}

if ($_GET['sel'] == 'VRRP')
{

echo "OK";

	$q = mysql_query ("SELECT SO_CITY FROM `NAGIOS_POS_SO` WHERE `SO_ID` = '" . $_GET["so"] . "'");
		$value = mysql_fetch_array($q);
		$city = $value['SO_CITY'];
		
		$q = mysql_query ("SELECT SO_ADDRESS FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$addr = $value['SO_ADDRESS'];
		
		$q = mysql_query ("SELECT SO_PHONE FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$phone = $value['SO_PHONE'];
		
		$q = mysql_query ("SELECT SO_WH FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$wh = $value['SO_WH'];
		
		$q = mysql_query ("SELECT SO_GPS_LA FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$gpsla = $value['SO_GPS_LA'];
		
		$q = mysql_query ("SELECT SO_GPS_LO FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$gpslo = $value['SO_GPS_LO'];

		$q = mysql_query ("SELECT `POS_DEV_LAN_IP` FROM NAGIOS_POS_DEV WHERE `POS_ID` = '".$_GET["posid"]."' AND `POS_DEV_TYPE` = 'VRRP'");
		$value = mysql_fetch_array($q);
		$iplan = $value['POS_DEV_LAN_IP'];
		
$file = '/usr/local/nagios/etc/objects/POS/NEW/VRRP/'.$_GET['so'].'_'.$_GET['posid'].'_VRRP.cfg';
$config = 'define host{
        use                    POS-VRRP-HOST            
        host_name      '.$_GET['so'].'_POS_'.$_GET['posid'].'_VRRP
        parents			 Join point TP - Orange Primary,Join point TP - Orange Secondary
        alias                  VRRP '.$city.'  '.$addr.'  '.$phone.'  '.$wh.'  '.$gpsla.' '.$gpslo.' 
        address          '.$iplan.'
		2d_coords		'.$gpsla.','.$gpslo.' 
		3d_coords 	'.$gpsla.','.$gpslo.',0
		notes latlng: 	'.$gpsla.','.$gpslo.' 
 }
 
 define service{
         use                   POS-VRRP-PING 
        host_name        '.$_GET['so'].'_POS_'.$_GET['posid'].'_VRRP
        service_description  PING  '.$iplan.'
        } 
 
 ';
$create = file_put_contents($file, $config);
}

if ($_GET['sel'] == 'PR3G')
{

echo "OK";

	$q = mysql_query ("SELECT SO_CITY FROM `NAGIOS_POS_SO` WHERE `SO_ID` = '" . $_GET["so"] . "'");
		$value = mysql_fetch_array($q);
		$city = $value['SO_CITY'];
		
		$q = mysql_query ("SELECT SO_ADDRESS FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$addr = $value['SO_ADDRESS'];
		
		$q = mysql_query ("SELECT SO_PHONE FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$phone = $value['SO_PHONE'];
		
		$q = mysql_query ("SELECT SO_WH FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$wh = $value['SO_WH'];
		
		$q = mysql_query ("SELECT SO_GPS_LA FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$gpsla = $value['SO_GPS_LA'];
		
		$q = mysql_query ("SELECT SO_GPS_LO FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$gpslo = $value['SO_GPS_LO'];

		$q = mysql_query ("SELECT `POS_DEV_LAN_IP` FROM NAGIOS_POS_DEV WHERE `POS_ID` = '".$_GET["posid"]."' AND `POS_DEV_TYPE` = 'Primary router 3G'");
		$value = mysql_fetch_array($q);
		$iplan = $value['POS_DEV_LAN_IP'];
		
$file = '/usr/local/nagios/etc/objects/POS/NEW/Primary_r/'.$_GET['so'].'_'.$_GET['posid'].'_POS_Primary_Router.cfg';
$config = 'define host{
        use                     POS-PR3G-HOST      
        host_name      '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        parents			 '.$_GET['so'].'_POS_'.$_GET['posid'].'_VRRP
        alias                 Primary router 3G '.$city.'  '.$addr.'  '.$phone.'  '.$wh.'  '.$gpsla.' '.$gpslo.' 
        address          '.$iplan.'  
		2d_coords		'.$gpsla.','.$gpslo.' 
		3d_coords 	'.$gpsla.','.$gpslo.',0
		notes latlng: 	'.$gpsla.','.$gpslo.' 
 }
 
 define service{
         use                   POS-PR3G-GRE
        host_name               '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description  GRE Interface Status
	}
define service{
        use                   POS-PR3G-ETH0
        host_name               '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description  ETH0 Interface Status
        }
define service{
         use                   POS-PR3G-WAN
        host_name               '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description  WAN Interface Status
        }
define service{
         use                   POS-PR3G-SIGNAL
        host_name               '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description Signal		    
        }
define service{
         use                   POS-PR3G-SIM-REG
        host_name               '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description  SIM Registred		    
        }
define service{
         use                   POS-PR3G-SIM-ATTACH 
        host_name               '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description  SIM Attached	    
        }
define service{
         use                   POS-PR3G-SIM-TECH
        host_name               '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description   Technology		    
        }
define service{
         use                   POS-PR3G-APN
        host_name               '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description   APN		    
        }
define service{
         use                  POS-PR3G-UPT
        host_name               '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description  Uptime 
        }
define service{
         use                   POS-PR3G-DESC
        host_name               '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description  System Desc
        }
 
 ';
$create = file_put_contents($file, $config);
}
if ($_GET['sel'] == 'SR3G')
{

echo "OK";

	$q = mysql_query ("SELECT SO_CITY FROM `NAGIOS_POS_SO` WHERE `SO_ID` = '" . $_GET["so"] . "'");
		$value = mysql_fetch_array($q);
		$city = $value['SO_CITY'];
		
		$q = mysql_query ("SELECT SO_ADDRESS FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$addr = $value['SO_ADDRESS'];
		
		$q = mysql_query ("SELECT SO_PHONE FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$phone = $value['SO_PHONE'];
		
		$q = mysql_query ("SELECT SO_WH FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$wh = $value['SO_WH'];
		
		$q = mysql_query ("SELECT SO_GPS_LA FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$gpsla = $value['SO_GPS_LA'];
		
		$q = mysql_query ("SELECT SO_GPS_LO FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$gpslo = $value['SO_GPS_LO'];

		$q = mysql_query ("SELECT `POS_DEV_LAN_IP` FROM NAGIOS_POS_DEV WHERE `POS_ID` = '".$_GET["posid"]."' AND `POS_DEV_TYPE` = 'Secondary router 3G'");
		$value = mysql_fetch_array($q);
		$iplan = $value['POS_DEV_LAN_IP'];
		
$file = '/usr/local/nagios/etc/objects/POS/NEW/Secondary_r/'.$_GET['so'].'_POS_'.$_GET['posid'].'_POS_Secondary_Router.cfg';
$config = 'define host{
        use                     POS-SR3G-HOST      
        host_name      '.$_GET['so'].'_POS_'.$_GET['posid'].'_Secondary_Router
        parents			 '.$_GET['so'].'_POS_'.$_GET['posid'].'_VRRP
        alias                 Secondary router 3G '.$city.'  '.$addr.'  '.$phone.'  '.$wh.'  '.$gpsla.' '.$gpslo.' 
        address          '.$iplan.'  
		2d_coords		'.$gpsla.','.$gpslo.' 
		3d_coords 	'.$gpsla.','.$gpslo.',0
		notes latlng: 	'.$gpsla.','.$gpslo.' 
 }
 
 define service{
         use                   POS-SR3G-GRE
        host_name                '.$_GET['so'].'_POS_'.$_GET['posid'].'_Secondary_Router
        service_description   GRE Interface Status
	}
define service{
        use                   POS-SR3G-ETH0
        host_name               '.$_GET['so'].'_POS_'.$_GET['posid'].'_Secondary_Router
        service_description  ETH0 Interface Status
        }
define service{
         use                   POS-SR3G-WAN
        host_name                '.$_GET['so'].'_POS_'.$_GET['posid'].'_Secondary_Router
        service_description  WAN Interface Status
        }
define service{
         use                   POS-SR3G-SIGNAL
        host_name                '.$_GET['so'].'_POS_'.$_GET['posid'].'_Secondary_Router
        service_description  Signal		    
        }
define service{
         use                   POS-SR3G-SIM-REG
        host_name               '.$_GET['so'].'_POS_'.$_GET['posid'].'_Secondary_Router
        service_description   SIM Registred		    
        }
define service{
         use                   POS-SR3G-SIM-ATTACH 
        host_name                '.$_GET['so'].'_POS_'.$_GET['posid'].'_Secondary_Router
        service_description  SIM Attached	    
        }
define service{
         use                   POS-SR3G-SIM-TECH
        host_name                '.$_GET['so'].'_POS_'.$_GET['posid'].'_Secondary_Router
        service_description  SIM Technology		    
        }
define service{
         use                   POS-SR3G-APN
        host_name                '.$_GET['so'].'_POS_'.$_GET['posid'].'_Secondary_Router
        service_description  APN		    
        }
define service{
         use                  POS-SR3G-UPT
        host_name                '.$_GET['so'].'_POS_'.$_GET['posid'].'_Secondary_Router
        service_description   Uptime 
        }
define service{
         use                   POS-SR3G-DESC
        host_name               '.$_GET['so'].'_POS_'.$_GET['posid'].'_Secondary_Router
        service_description  System Desc
        }
 
 ';
$create = file_put_contents($file, $config);
}
if ($_GET['sel'] == 'PDSL')
{

echo "OK";

	$q = mysql_query ("SELECT SO_CITY FROM `NAGIOS_POS_SO` WHERE `SO_ID` = '" . $_GET["so"] . "'");
		$value = mysql_fetch_array($q);
		$city = $value['SO_CITY'];
		
		$q = mysql_query ("SELECT SO_ADDRESS FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$addr = $value['SO_ADDRESS'];
		
		$q = mysql_query ("SELECT SO_PHONE FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$phone = $value['SO_PHONE'];
		
		$q = mysql_query ("SELECT SO_WH FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$wh = $value['SO_WH'];
		
		$q = mysql_query ("SELECT SO_GPS_LA FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$gpsla = $value['SO_GPS_LA'];
		
		$q = mysql_query ("SELECT SO_GPS_LO FROM `NAGIOS_POS_SO` WHERE `SO_ID` = ".$_GET["so"]."");
		$value = mysql_fetch_array($q);
		$gpslo = $value['SO_GPS_LO'];

		$q = mysql_query ("SELECT `POS_DEV_LAN_IP` FROM NAGIOS_POS_DEV WHERE `POS_ID` = '".$_GET["posid"]."' AND `POS_DEV_TYPE` = 'Primary router DSL'");
		$value = mysql_fetch_array($q);
		$iplan = $value['POS_DEV_LAN_IP'];
		
$file = '/usr/local/nagios/etc/objects/POS/NEW/Primary_r/'.$_GET['so'].'_POS_'.$_GET['posid'].'_POS_Primary_Router.cfg';
$config = 'define host{
        use                      POS-PDSL-HOST   
        host_name      '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        parents			 '.$_GET['so'].'_POS_'.$_GET['posid'].'_VRRP
        alias                 Primary router DSL '.$city.'  '.$addr.'  '.$phone.'  '.$wh.'  '.$gpsla.' '.$gpslo.' 
        address          '.$iplan.'  
		2d_coords		'.$gpsla.','.$gpslo.' 
		3d_coords 	'.$gpsla.','.$gpslo.',0
		notes latlng: 	'.$gpsla.','.$gpslo.' 
 }
 
 define service{
         use                  POS-PDSL-VLAN
        host_name             '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description   Vlan Interface Status
        }
  define service{
         use                 POS-PDSL-ATM
        host_name             '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description   ATM Interface Status
        }
define service{
         use                    POS-PDSL-WAN
        host_name             '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description   WAN Interface Status
        }

 
 define service{
         use                   POS-PDSL-LO
        host_name             '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description   Loopback Interface Status
        }

define service{
         use                   POS-PDSL-UP
        host_name             '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description   Uptime
        }
define service{
         use                   POS-PDSL-DESC
        host_name             '.$_GET['so'].'_POS_'.$_GET['posid'].'_Primary_Router
        service_description   System Desc
        }
 
 ';
$create = file_put_contents($file, $config);
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