<?php
class mysql{
	var $handle;
	var $USR;
	var $PASS;
	var $Name;
	var $Sname;
	var $Email;
	var $Group;

	function __construct($dbuser,$dbpass,$dbname,$dbhost){
		$this->handle = mysql_connect($dbhost,$dbuser,$dbpass) or die('Wrong! database, authentication data, or address');
		$tmp = mysql_select_db($dbname,$this->handle) or die('Wrong DB');
	}

	function showq(){
		$ret = array();	
		$q = mysql_query('select * from Qserver order by Status');
		while ($txt = mysql_fetch_assoc($q)){
			$ret[] = $txt;
			
			}
		return $ret;		
	}
	function showp(){
		$ret = array();	
		$q = mysql_query("SELECT s1.`HOSTNAME` , s1.`HOSTSTATE` , s1.`HOSTADDRESS` , s1.`HOSTOUTPUT` , s1.`LONGDATETIME` , s1.`HOSTDURATION` FROM NAGIOS_HOST_STATE s1 JOIN (SELECT  `HOSTNAME` , MAX(  `LONGDATETIME` ) AS dt FROM NAGIOS_HOST_STATE GROUP BY  `HOSTNAME`) AS s2 ON s1.`HOSTNAME` = s2.`HOSTNAME` AND s1.`LONGDATETIME` = s2.dt WHERE  `HOSTGROUPNAME` =  'POS' order by `HOSTSTATE`");
		while ($txt = mysql_fetch_assoc($q)){
			$ret[] = $txt;
			
			}
		return $ret;		
	}
	function checklogin($USR,$PASS){
		$this->USR = $USR;
		$this->PASS = $PASS;
		$ret = array();	
		$q = mysql_query("SELECT * FROM `V_NAGIOS_USERS` WHERE `LOGIN` ='".$this->USR."' AND `PASS` = '".$this->PASS."' AND `ACTIVE` = 'Y'");
		while ($txt = mysql_fetch_assoc($q)){
			$ret[] = $txt;
			return $ret;
			}
}
	function addusr($USR,$PASS,$Name,$Sname,$Email,$Group,$DATE){
		$this->USR = $USR;
		$this->PASS = $PASS;
		$this->Name = $Name;
		$this->Sname = $Sname;
		$this->Email = $Email;
		$this->Group = $Group;
		$this->NOW = $DATE;
		$ret = array();	
		$q = mysql_query("INSERT INTO `NAGIOS_USERS_USR`(`ID`, `LOGIN`, `PASS`, `NAME`, `SURNAME`, `EMAIL`, `DATE`, `ACTIVE`) VALUES ('NULL','".$this->USR."','".$this->PASS."','".$this->Name."','".$this->Sname."','".$this->Email."','".$this->NOW."','N')");
		while ($txt = mysql_fetch_assoc($q)){
			$ret[] = $txt;
			return $ret;
			}
			
}
	function addusrgr($USR,$Group){
		$this->USR = $USR;
		$this->Group = $Group;
		$ret = array();	
		$q = mysql_query("INSERT INTO `NAGIOS_USERS_GROUPS`(`LOGIN`, `GR_NAME`) VALUES ('".$this->USR."','".$this->Group."')");
		while ($txt = mysql_fetch_assoc($q)){
			$ret[] = $txt;
			return $ret;
			}
}
}
class File{
	var $Project_Dir;
	var $Command;
	var $Ret;
	var $files;
	var $filest;
	function newdir($DN){
		$this->Project_Dir = $DN;
		$this->Command = "mkdir $this->Project_Dir";
		exec($this->Command);
		return "file created";
		}
		function chmod($DN){
		$this->Project_Dir = $DN;
		$this->Command = "chmod a+rw $this->Project_Dir";
		exec($this->Command);
		
		}
		function check($DN){
		$this->Project_Dir = $DN;
		if (file_exists($this->Project_Dir)){
			return true;
		}
		else{
			return false;
			}
			
		}
		function save($DN,$FN,$FNT){
		$this->Project_Dir = $DN;
		$this->files = $FN;
		$this->filest = $FNT;	
		$this->Ret = $this->Project_Dir . basename($this->files);
		if (move_uploaded_file($this->filest, $this->Ret)) {
		return true;
		}
		else
		{
		return false;
		}
							
		}	
		function emptydir($DN){
		$this->Project_Dir = $DN;
		$this->destdir = $this->Project_Dir;
		$this->handle = opendir($this->destdir);
		$this->c = 0;
		while ($this->file = readdir($this->handle)&& $c<3) {
		$this->c++;
		}
		if ($this->c>2) {
	    return False;
		} 
		else {
		return True;
		}
	}

}		
class Project{
	var $Project_Name;
	var $Project_Dir;
	var $Project_Path;
	
	
	function newpr($PN){
		$this->Project_Name = $PN;
		$this->Project_Dir = "/home/Sysops/";
		$this->Project_Dir.''.$this->Project_Name;
		$this->Project_Path = $this->Project_Dir.''.$this->Project_Name;
		}
	
		
}
class QServer{
	var $File_N = "ETC_PL_000";
	var $File_S = "OK";
	function QServer($FN,$ST){
		$this->File_N = $FN;
		$this->File_S = $ST;
		}
	}
class curl{
	var $ch ;
	var $url = "google.pl" ;
	function curl_def($URL){
		$this->ch = curl_init();
		$this->url = $URL;
		curl_setopt($this->ch,CURLOPT_URL,'$this->url' );
		curl_exec($this->ch);
		}
	}
class POS{
	var $Host_N = "POS1";
	var $Host_IP = "127.0.0.1";
	var $Host_St = "OK";	
	var $Service_N = "Service1";
	var $Service_IP = "127.0.0.1";
	var $Service_St = "OK";
	function POS($HName,$HIP,$HST,$SName,$SIP,$SST){
		$this->Host_N = $HName;
		$this->Host_IP = $HIP;
		$this->Host_St = $HST;

		$this->Service_N = $SName;
		$this->Service_IP = $SIP;
		$this->Service_St = $SST;
	}

}
class POSPC{
	var $Host_N = "POS1";
	var $Host_IP = "127.0.0.1";
	var $Host_St = "OK";	
	var $Host_Output= "YES";
	var $Host_Date= "YES";
	var $Host_Duration = 1;
	
	
	
	function POSPC($HName,$HIP,$HST,$HOP,$HDT,$HDU){
		$this->Host_N = $HName;
		$this->Host_IP = $HIP;
		$this->Host_St = $HST;
		$this->Host_Output= $HOP;
		$this->Host_Date= $HDT;
		$this->Host_Duration= $HDU;
	}	

}
class mail{
	var $srv;
	var $port;
	var $title;
	var $from;
	var $to;
	var $cont;
	var $handle;
	
	function send($SRV,$PORT,$TITLE,$FROM,$TO,$CONT){
	$this->srv = $SRV;
	$this->port =$PORT;
	$this->title = $TITLE;
	$this->from = $FROM;
	$this->to = $TO;
	$this->cont = $CONT;
	$this->handle = "sendEmail -s '".$this->srv."':'".$this->port."' -t '".$this->to."' -f '".$this->from."' -u '".$this->title."' -m '".$this->cont."' ";
	$this->send = system($this->handle);
	
	
	}
}

?>