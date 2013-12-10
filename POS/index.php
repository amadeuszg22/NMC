<?php
session_start();
?>

<html>
<link href="css/trontastic/jquery-ui-1.10.3.custom.css"  rel="stylesheet" >
	<script src="js/jquery-1.9.1.js"></script>
	<script src="js/jquery-ui-1.10.3.custom.js"></script>
	<script>
	$(function() {
		$( "#menu" ).menu();
		$( "#accordion" ).accordion();
		

		
		var availableTags = [
			"ActionScript",
			"AppleScript",
			"Asp",
			"BASIC",
			"C",
			"C++",
			"Clojure",
			"COBOL",
			"ColdFusion",
			"Erlang",
			"Fortran",
			"Groovy",
			"Haskell",
			"Java",
			"JavaScript",
			"Lisp",
			"Perl",
			"PHP",
			"Python",
			"Ruby",
			"Scala",
			"Scheme"
		];
		$( "#autocomplete" ).autocomplete({
			source: availableTags
		});
		

		
		$( "#button" ).button();
		$( "#radioset" ).buttonset();
		

		
		$( "#tabs" ).tabs();
		

		
		$( "#dialog" ).dialog({
			autoOpen: false,
			width: 400,
			buttons: [
				{
					text: "Ok",
					click: function() {
						$( this ).dialog( "close" );
					}
				},
				{
					text: "Cancel",
					click: function() {
						$( this ).dialog( "close" );
					}
				}
			]
		});
		$( "#dialog1" ).dialog({
      autoOpen: false,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
 
    $( "#opener1" ).click(function() {
      $( "#dialog1" ).dialog( "open" );
    });
		// Link to open the dialog
		$( "#dialog-link" ).click(function( event ) {
			$( "#dialog" ).dialog( "open" );
			event.preventDefault();
		});
		

		
		$( "#datepicker" ).datepicker({
			inline: true
		});
		

		
		$( "#slider" ).slider({
			range: true,
			values: [ 17, 67 ]
		});
		

		
		$( "#progressbar" ).progressbar({
			value: false
		});
		$( "#progressbare" ).progressbar({
			value: false
		});
		 $( "#dialog-modal" ).dialog({
      height: 950,
      width: 1500,
	  modal: true
    });

		// Hover states on the static widgets
		$( "#dialog-link, #icons li" ).hover(
			function() {
				$( this ).addClass( "ui-state-hover" );
			},
			function() {
				$( this ).removeClass( "ui-state-hover" );
			}
		);
	});  
        $(document).ready(function(){
            $("#report tr:odd").addClass("odd");
            $("#report tr:not(.odd)").hide();
            $("#report tr:first-child").show();
            
            $("#report tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).find(".arrow").toggleClass("up");
            });
            //$("#report").jExpand();
			 $(function() {
    $( "#rerun" )
      .button()
      .click(function() {
        alert( "Running the last action" );
      })
      .next()
        .button({
          text: false,
          icons: {
            primary: "ui-icon-triangle-1-s"
          }
        })
        .click(function() {
          var menu = $( this ).parent().next().show().position({
            my: "left top",
            at: "left bottom",
            of: this
          });
          $( document ).one( "click", function() {
            menu.hide();
          });
          return false;
        })
        .parent()
          .buttonset()
          .next()
            .hide()
            .menu();
  });
  $( "input[type=submit], a, button" )
      .button();
        });

		
$( "#progressbar" ).progressbar({
      value: false
    });
	$( "#progressbare" ).progressbar({
      value: false
    });
    </script>     
	<style>
	 .ui-menu { position: absolute; width: 500px; }
	  body { font-family:Arial, Helvetica, Sans-Serif; font-size:0.8em;}
        #report { border-collapse:collapse;}
        #report h4 { margin:0px; padding:0px;}
        #report img { float:right;}
        #report ul { margin:10px 0 100px 40px; padding:0px;}
        #report th { background:#7CB8E2 url(header_bkg.png) repeat-x scroll center left; color:#fff; padding:7px 15px; text-align:left;}
        #report td { background:#00FF55 none repeat-x scroll center left; color:#000; padding:5px 7px; }
        #report tr.odd td { background:#fff url(row_bkg.png) repeat-x scroll center left; cursor:pointer; }
        #report div.arrow { background:transparent url(arrows.png) no-repeat scroll 0px -16px; width:16px; height:16px; display:block;}
        #report div.up { background-position:0px 0px;}
	body{
		font: 62.5% "Trebuchet MS", sans-serif;
		margin: 50px;
	}
	.demoHeaders {
		margin-top: 2em;
	}
	#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
	}
	#dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
	#icons {
		margin: 0;
		padding: 0;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	.fakewindowcontain .ui-widget-overlay {
		position: absolute;
	}
	#draggable {
    width: 768px;
    height: 768px;
    background: #ccc;
  }
	</style>
<head>
<script type="text/javascript" language="JavaScript">
<!--
function popup(form) {
    window.open('', 'formpopup', 'view text','menubar=no,scrollbars=no,resizable=no,width=550,height=250');
    form.target = 'formpopup';
}
-->
</script>
<title>Host OverView</title>
</head>
<body>
	<div class="ui-widget">

<?php
?>

 
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">In Operations </a></li>
		<li><a href="#tabs-2">Deleted</a></li>
		<li><a href="#tabs-3">Changes</a></li>
</ul>

<div id="tabs-1">
		<iframe src="http://10.134.47.1/NMC/jTableSimple.php" name="POS" width="1760" height="900">
		</iframe>

</div>
<div id="tabs-2">
		<iframe src="http://10.134.47.1/NMC/jTableSimple.php" name="Deleted" width="1760" height="900">
		</iframe>

</div>
<div id="tabs-3">
		<iframe src="http://10.134.47.1/NMC/jTableSimple.php" name="Changes" width="1760" height="900">
		</iframe>

</div>


</div>

</div>

</body>
</html>