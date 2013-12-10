<html>
  <head>

    <link href="themes/trontastic/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" />
	<link href="scripts/jtable/themes/metro/green/jtable.css" rel="stylesheet" type="text/css" />
	
	<script src="scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="scripts/jtable/jquery.jtable.js" type="text/javascript"></script>
	
  </head>
  <body>
<?php
 if ($_GET["select"] == "histall")
 {
 ?>
<script type="text/javascript">
 
    $(document).ready(function () {
 
        $('#StudentTableContainer').jtable({
            title: 'History/Changes List',
            paging: true, //Enable paging
            pageSize: 50,
			sorting: true, //Enable sorting
            defaultSorting: 'Date DESC',
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
           actions: {
					listAction: 'HistoryActions.php?action=list',
					
				},
            fields: {
                ID: {
						title: 'ID',
						width: '1%',
						key: false,
						create: false,
						edit: false,
						list: false
					},
					 Type: {
						title: 'Type',
						width: '10%',
						create: false,
						edit: false,
						list: true
					},
					Source: {
						title: 'Start Value',
						width: '20%',
						create: false,
						edit: false,
						list: true
					},
					Destination: {
						title: 'Changed Value',
						width: '20%',
						create: false,
						edit: false,
						list: true
					},
					Date: {
						title: 'Date',
						width: '5%',
						key: true,
						create: false,
						edit: false,
						list: true
					},
					Login: {
						title: 'Who',
						width: '5%',
						create: false,
						edit: false,
						list: true
					},
					Comment: {
						title: 'Comment',
						width: '1%',
						create: false,
						edit: false,
						list: false
					},
					Status: {
						title: 'Status',
						width: '5%',
						create: false,
						edit: false,
						list: true,
						
					},
               

            }
        });
 
        //Load student list from server
        $('#StudentTableContainer').jtable('load');
 
    });

</script>
<?php
}
else if ($_GET["select"] == "histso")
 {
 ?>
<script type="text/javascript">
 
    $(document).ready(function () {
 
        $('#StudentTableContainer').jtable({
            title: 'History/Changes List',
            paging: true, //Enable paging
            pageSize: 50,
			sorting: true, //Enable sorting
            defaultSorting: 'Date DESC',
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
           actions: {
					listAction: 'HistoryActions.php?action=listso',				
				},
            fields: {
                ID: {
						title: 'ID',
						width: '1%',
						key: false,
						create: false,
						edit: false,
						list: false
					},
					 Type: {
						title: 'Type',
						width: '10%',
						create: false,
						edit: false,
						list: true
					},
					Source: {
						title: 'Start Value',
						width: '20%',
						create: false,
						edit: false,
						list: true
					},
					Destination: {
						title: 'Changed Value',
						width: '20%',
						create: false,
						edit: false,
						list: true
					},
					Date: {
						title: 'Date',
						width: '5%',
						key: true,
						create: false,
						edit: false,
						list: true
					},
					Login: {
						title: 'Who',
						width: '5%',
						create: false,
						edit: false,
						list: true
					},
					Comment: {
						title: 'Comment',
						width: '1%',
						create: false,
						edit: false,
						list: false
					},
					Status: {
						title: 'Status',
						width: '5%',
						create: false,
						edit: false,
						list: true,
						
					},
               

            }
        });
 
        //Load student list from server
        $('#StudentTableContainer').jtable('load');
 
    });

</script>
<?php
 }
 else if ($_GET["select"] == "histpos")
 {
 ?>
<script type="text/javascript">
 
    $(document).ready(function () {
 
        $('#StudentTableContainer').jtable({
            title: 'History/Changes List',
            paging: true, //Enable paging
            pageSize: 50,
			sorting: true, //Enable sorting
            defaultSorting: 'Date DESC',
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
           actions: {
					listAction: 'HistoryActions.php?action=listpos',
					
				},
            fields: {
                ID: {
						title: 'ID',
						width: '1%',
						key: false,
						create: false,
						edit: false,
						list: false
					},
					 Type: {
						title: 'Type',
						width: '10%',
						create: false,
						edit: false,
						list: true
					},
					Source: {
						title: 'Start Value',
						width: '20%',
						create: false,
						edit: false,
						list: true
					},
					Destination: {
						title: 'Changed Value',
						width: '20%',
						create: false,
						edit: false,
						list: true
					},
					Date: {
						title: 'Date',
						width: '5%',
						key: true,
						create: false,
						edit: false,
						list: true
					},
					Login: {
						title: 'Who',
						width: '5%',
						create: false,
						edit: false,
						list: true
					},
					Comment: {
						title: 'Comment',
						width: '1%',
						create: false,
						edit: false,
						list: false
					},
					Status: {
						title: 'Status',
						width: '5%',
						create: false,
						edit: false,
						list: true,
						
					},
               

            }
        });
 
        //Load student list from server
        $('#StudentTableContainer').jtable('load');
 
    });

</script>
<?php
 }
 else if ($_GET["select"] == "histsrv")
 {
   echo "Error Service under construction or not exist";
 ?>
<script type="text/javascript">
 
    $(document).ready(function () {
 
        $('#StudentTableContainer').jtable({
            title: 'History/Changes List',
            paging: true, //Enable paging
            pageSize: 50,
			sorting: true, //Enable sorting
            defaultSorting: 'Date DESC',
            //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
           actions: {
					listAction: 'HistoryActions.php?action=listsrv',
					
				},
            fields: {
                ID: {
						title: 'ID',
						width: '1%',
						key: false,
						create: false,
						edit: false,
						list: false
					},
					 Type: {
						title: 'Type',
						width: '10%',
						create: false,
						edit: false,
						list: true
					},
					Source: {
						title: 'Start Value',
						width: '20%',
						create: false,
						edit: false,
						list: true
					},
					Destination: {
						title: 'Changed Value',
						width: '20%',
						create: false,
						edit: false,
						list: true
					},
					Date: {
						title: 'Date',
						width: '5%',
						key: true,
						create: false,
						edit: false,
						list: true
					},
					Login: {
						title: 'Who',
						width: '5%',
						create: false,
						edit: false,
						list: true
					},
					Comment: {
						title: 'Comment',
						width: '1%',
						create: false,
						edit: false,
						list: false
					},
					Status: {
						title: 'Status',
						width: '5%',
						create: false,
						edit: false,
						list: true,
						
					},
               

            }
        });
 
        //Load student list from server
        $('#StudentTableContainer').jtable('load');
 
    });

</script>
<?php
 }
 ?>
 <div id="StudentTableContainer" style="width: 100%;"></div>
  </body>
</html>
