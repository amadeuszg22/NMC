<?php
session_start();
?>
<html>
  <head>

    <link href="themes/trontastic/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" />
	<link href="scripts/jtable/themes/metro/red/jtable.css" rel="stylesheet" type="text/css" />
	
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
	
  </head>
  <body>
<?php
 if ($_GET["select"] == "delall")
 {
 ?>
<script type="text/javascript">
 
    $(document).ready(function () {
 
        $('#StudentTableContainer').jtable({
            title: 'Sales Office List',
            paging: true, //Enable paging
            pageSize: 50,
			sorting: true, //Enable sorting
            defaultSorting: 'SO_ID ASC',
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
           actions: {
					<?php
					if (isset($_SESSION['session_user']))
					{
					if ($_SESSION['session_prv_POS_DEL_VIEW'] == "Y")
					{
					?>
					listAction: 'DeletedActions.php?action=listso',
					<?php
					}
					if ($_SESSION['session_prv_POS_DEL_MMGT'] == "Y")
					{
					?>
					createAction: 'DeletedActions.php?action=create',
					updateAction: 'DeletedActions.php?action=update',
					deleteAction: 'DeletedActions.php?action=delete',
					<?php
					}
					}
					?>
				},
            fields: {
                SO_ID: {
						title: 'Sales Office',
						width: '20%',
						key: true,
						create: true,
						edit: true,
						list: true
					},
					 SO_CITY: {
						title: 'CITY',
						width: '30%'
					},
					SO_ADDRESS: {
						title: 'ADDRESS',
						width: '20%',
					},
					SO_PHONE: {
						title: 'PHONE',
						width: '20%',
					},
					SO_WH: {
						title: 'WH',
						width: '15%',
					},
					SO_GPS_LA: {
						title: 'GPS LA',
						width: '20%',
					},
					SO_GPS_LO: {
						title: 'GPS LO',
						width: '20%',
					},
					ACTIVE: {
						title: 'Productive',
						width: '20%',
						create: true,
						edit: true,
						list: false,
						options: { 'YES': 'YES','NO':'NO'}
					},
                //CHILD TABLE DEFINITION FOR "PHONE NUMBERS"
               POS_ID: {
                    title: 'POSES',
                   width: '1%',
					sorting: false,
					edit: false,
					create: false,
					listClass: 'child-opener-image-column',
                    display: function (studentData) {
                        //Create an image that will be used to open child table
                        var $img = $('<img src="scripts/jtable/themes/metro/dropdown.png" title="Edit phone numbers" />');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $('#StudentTableContainer').jtable('openChildTable',
                                    $img.closest('tr'),
                                    {
                                        title: 'POS Data',
										paging: true, //Enable paging
										sorting: true, //Enable sorting
										defaultSorting: 'POS_ID_DEV ASC',
										actions: {
										<?php
										if (isset($_SESSION['session_user']))
										{
										if ($_SESSION['session_prv_POS_DEL_VIEW'] == "Y")
										{
										?>
										listAction: 'DeletedActions.php?action=listpos&SO_ID='+studentData.record.SO_ID,
										<?php
										}
										if ($_SESSION['session_prv_POS_DEL_MMGT'] == "Y")
										{
										?>
										createAction: 'DeletedActions.php?action=createpos&SO_ID='+studentData.record.SO_ID,
										updateAction: 'DeletedActions.php?action=updatepos',
										deleteAction: 'DeletedActions.php?action=deletepos',
										<?php
										}
										}
										?>
										},
                                        fields: {
						SO_ID: {
						title: 'SO_ID',
						create: false,
						edit: false,
						list: false
					},
						POS_DEV_ID: {
						title: 'POS_DEV_ID',
						key: true,
						create: false,
						edit: false,
						list: false
											},
						POS_ID: {
						title: 'POS ID',
						width: '5%',
						create: true,
						edit: true,
						list: true
											},
						POS_DEV_TYPE: {
						title: 'DEV TYPE',
						width: '10%',
						options: { 'PC': 'PC', 'VRRP': 'VRRP','Pinpad': 'Pinpad', 'Primary router 3G': 'Primary router 3G' , 'Primary router CDMA': 'Primary router CDMA', 'Primary router VSAT': 'Primary router VSAT', 'Primary router DSL': 'Primary router DSL', 'Secondary router VSAT': 'Secondary router VSAT', 'Secondary router CDMA': 'Secondary router CDMA' , 'Secondary router 3G': 'Secondary router 3G', 'Secondary router DSL': 'Secondary router DSL'}
											},
						POS_DEV_LAN_IP: {
						title: 'DEV LAN IP',
						width: '20%',
											},
						POS_DEV_WAN_IP: {
						title: 'DEV WAN IP',
						width: '20%',
											},
						POS_DEV_SVN_NO: {
						title: 'DEV SN NO',
						width: '20%',
											},
						POS_DEV_PORT_NO: {
						title: 'DEV PORT NO',
						width: '15%',
											},
						ACTIVE: {
						title: 'Productive',
						width: '20%',
						create: true,
						edit: true,
						list: false,
						options: { 'YES': 'YES','NO':'NO'}
					},
					SERVICES: {
                    title: 'SERVICES',
                    width: '1%',
                    sorting: false,
                    edit: false,
                    create: false,
                    display: function (studentData1) {
                        //Create an image that will be used to open child table
                       var $img = $('<img src="scripts/jtable/themes/metro/dropdown.png" title="Edit exam results" />');
                        //Open child table when user clicks the image
                        $img.click(function () {
                            $('#StudentTableContainer').jtable('openChildTable',
                                    $img.closest('tr'), //Parent row
                                    {
                                    title:"POS" + studentData1.record.POS_ID + studentData1.record.POS_DEV_TYPE,
										paging: true, //Enable paging
										sorting: true, //Enable sorting
										defaultSorting: 'POS_SERV_TYPE ASC',
                                        actions: {
										<?php
										if (isset($_SESSION['session_user']))
										{
										if ($_SESSION['session_prv_POS_DEL_VIEW'] == "Y")
										{
										?>
										listAction: 'DeletedActions.php?action=listsrv&POS_DEV_ID='+studentData1.record.POS_DEV_ID,
										<?php
										}
										if ($_SESSION['session_prv_POS_DEL_MMGT'] == "Y")
										{
										?>
										createAction: 'DeletedActions.php?action=create',
										updateAction: 'DeletedActions.php?action=update',
										deleteAction: 'DeletedActions.php?action=deletesrv',
										<?php
										}
										}
										?>
										},
                                   
                                    fields: {
                                       
                                        DEV_ID_SERV: {
                                            title: 'DEV_ID_SERV',
											create: false,
											edit: false,
											list: false
                                        },
										   POS_SERV_ID: {
                                            title: 'SERV ID',
											key: true,
											create: false,
											edit: false,
											list: false
                                        },
									
                                        POS_SERV_TYPE: {
                                            title: 'SERV TYPE',
                                            width: '40%',
											edit: false
                                        },
										ACTIVE: {
										title: 'Productive',
										width: '20%',
										create: true,
										edit: true,
										list: false,
										options: { 'YES': 'YES','NO':'NO'}
					},
                                    }
                                }, function (data) { //opened handler
                                    data.childTable.jtable('load');
                                });
                        });
                      
						//Return image to show on the person row
                       // return studentData1.record.DEV_ID_SERV;
						return $img;
                    }
                },	
									   }
                                    }, function (data) { //opened handler
                                        data.childTable.jtable('load');
                                    });
                        });
						  //return studentData.record.POS_ID
                        //Return image to show on the person row
                       //return studentData1.record.DEV_ID_SERV;
						return $img;
                    }
                },
                //CHILD TABLE DEFINITION FOR "EXAMS"

            }
        });
 
        //Load student list from server
        $('#StudentTableContainer').jtable('load');
 
    });

</script>
<?php
}
else if ($_GET["select"] == "delso")
 {
 ?>
<script type="text/javascript">
 
    $(document).ready(function () {
 
        $('#StudentTableContainer').jtable({
            title: 'Sales Office List',
            paging: true, //Enable paging
            pageSize: 50,
			sorting: true, //Enable sorting
            defaultSorting: 'SO_ID ASC',
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
           actions: {
					<?php
					if (isset($_SESSION['session_user']))
					{
					if ($_SESSION['session_prv_POS_DEL_VIEW'] == "Y")
					{
					?>
					listAction: 'DeletedActions.php?action=listso',
					<?php
					}
					if ($_SESSION['session_prv_POS_DEL_MMGT'] == "Y")
					{
					?>
					createAction: 'DeletedActions.php?action=create',
					updateAction: 'DeletedActions.php?action=update',
					deleteAction: 'DeletedActions.php?action=delete',
					<?php
					}
					}
					?>
				},
            fields: {
                SO_ID: {
						title: 'Sales Office',
						width: '20%',
						key: true,
						create: true,
						edit: true,
						list: true
					},
					 SO_CITY: {
						title: 'CITY',
						width: '30%'
					},
					SO_ADDRESS: {
						title: 'ADDRESS',
						width: '20%',
					},
					SO_PHONE: {
						title: 'PHONE',
						width: '20%',
					},
					SO_WH: {
						title: 'WH',
						width: '15%',
					},
					SO_GPS_LA: {
						title: 'GPS LA',
						width: '20%',
					},
					SO_GPS_LO: {
						title: 'GPS LO',
						width: '20%',
					},
					ACTIVE: {
						title: 'Productive',
						width: '20%',
						create: true,
						edit: true,
						list: false,
						options: { 'YES': 'YES','NO':'NO'}
					},
               
                //CHILD TABLE DEFINITION FOR "EXAMS"

            }
        });
 
        //Load student list from server
        $('#StudentTableContainer').jtable('load');
 
    });

</script>
<?php
 }
 else if ($_GET["select"] == "delpos")
 {
 ?>
<script type="text/javascript">
 
    $(document).ready(function () {
 
        $('#StudentTableContainer').jtable({
            title: 'Sales Office List',
            paging: true, //Enable paging
            pageSize: 50,
			sorting: true, //Enable sorting
            defaultSorting: 'POS_ID ASC',
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
           actions: {
					<?php
					if (isset($_SESSION['session_user']))
					{
					if ($_SESSION['session_prv_POS_DEL_VIEW'] == "Y")
					{
					?>
					listAction: 'DeletedActions.php?action=listposa',
					<?php
					}
					if ($_SESSION['session_prv_POS_DEL_MMGT'] == "Y")
					{
					?>
					updateAction: 'DeletedActions.php?action=updatepos',
					deleteAction: 'DeletedActions.php?action=deletepos',
					<?php
					}
					}
					?>
				},                
                 fields: {
						SO_ID: {
						title: 'SO_ID',
						create: false,
						edit: false,
						list: false
					},
						POS_DEV_ID: {
						title: 'POS_DEV_ID',
						key: true,
						create: false,
						edit: false,
						list: false
											},
						POS_ID: {
						title: 'POS ID',
						width: '5%',
						key: false,
						create: true,
						edit: true,
						list: true
											},
						POS_DEV_TYPE: {
						title: 'DEV TYPE',
						width: '10%',
						options: { 'PC': 'PC', 'VRRP': 'VRRP','Pinpad': 'Pinpad', 'Primary router 3G': 'Primary router 3G' , 'Primary router CDMA': 'Primary router CDMA', 'Primary router VSAT': 'Primary router VSAT', 'Primary router DSL': 'Primary router DSL', 'Secondary router VSAT': 'Secondary router VSAT', 'Secondary router CDMA': 'Secondary router CDMA' , 'Secondary router 3G': 'Secondary router 3G', 'Secondary router DSL': 'Secondary router DSL'}
											},
						POS_DEV_LAN_IP: {
						title: 'DEV LAN IP',
						width: '20%',
											},
						POS_DEV_WAN_IP: {
						title: 'DEV WAN IP',
						width: '20%',
											},
						POS_DEV_SVN_NO: {
						title: 'DEV SN NO',
						width: '20%',
											},
						POS_DEV_PORT_NO: {
						title: 'DEV PORT NO',
						width: '15%',
											},
						ACTIVE: {
						title: 'Productive',
						width: '20%',
						create: true,
						edit: true,
						list: false,
						options: { 'YES': 'YES','NO':'NO'}
					},
		
                //CHILD TABLE DEFINITION FOR "EXAMS"

            }
        });
 
        //Load student list from server
        $('#StudentTableContainer').jtable('load');
 
    });

</script>
<?php
 }
 else if ($_GET["select"] == "delsrv")
 {
 echo "Error Service under construction or not exist";
 }
 ?>
 <div id="StudentTableContainer" style="width: 1750px;"></div>
  </body>
</html>
