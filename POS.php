<!DOCTYPE html>
<?php
session_start();
require_once('engine.php');	
?>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Nagios Management Console</title>
		<meta name="description" content="Nagios Management Console" />
		<meta name="keywords" content="Nagios Management Console" />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body>
<?php
						if (isset($_SESSION['session_user']))
{
?>
		<div class="container">
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
								<li class="gn-search-item">
									<input placeholder="Search" type="search" class="gn-search">
									<a class="gn-icon gn-icon-search"><span>Search</span></a>
								</li>
								<li>
									<li><a class="gn-icon gn-icon-download" href="http://10.134.47.1/NMC/">Home</a></li>	
									<?php
									if ($_SESSION['session_prv_POS_VIEW'] == "Y")
									{
									?>
									<li><a class="gn-icon gn-icon-download" href="http://10.134.47.1/NMC/POS.php?select=allop">POS</a></li>
								<!--<ul class="gn-submenu"> -->
										<li><a class="gn-icon gn-icon-illustrator" href="http://10.134.47.1/NMC/POS.php?select=delall">Deleted POS Items</a></li>
										<li><a class="gn-icon gn-icon-photoshop" href="http://10.134.47.1/NMC/POS.php?select=histall">History /Changes</a></li>
								<!--	</ul>-->
									<?php
									}
?>
								
									<li><a class="gn-icon gn-icon-videos" href="logout.php" >Logout</a></li>
								</li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
				<?php
				if ($_GET["select"] == "allop" )
				{
				?>
				<li><a href="http://10.134.47.1/NMC/POS.php?select=allop">POS In Operations</a></li>
				<?php
				}
				else if ($_GET["select"] == "delall"  || $_GET["select"] == "delso" || $_GET["select"] == "delpos" || $_GET["select"] == "delsrv")
				{
				?>
				<li><a class="codrops-icon codrops-icon-prev" href="http://10.134.47.1/NMC/POS.php?select=delall"><span>Deleted Items All</span></a></li>
				<li><a class="codrops-icon codrops-icon-prev" href="http://10.134.47.1/NMC/POS.php?select=delso"><span>Sales Office</span></a></li>
				<li><a class="codrops-icon codrops-icon-prev" href="http://10.134.47.1/NMC/POS.php?select=delpos"><span>POS</span></a></li>
				<li><a class="codrops-icon codrops-icon-prev" href="http://10.134.47.1/NMC/POS.php?select=delsrv"><span>Service</span></a></li>
				<?php
				}
				else if ($_GET["select"] == "histall"  || $_GET["select"] == "histso" || $_GET["select"] == "histpos" || $_GET["select"] == "histsrv")
				{
				?>
				<li><a class="codrops-icon codrops-icon-prev" href="http://10.134.47.1/NMC/POS.php?select=histall"><span>History All</span></a></li>
				<li><a class="codrops-icon codrops-icon-prev" href="http://10.134.47.1/NMC/POS.php?select=histso"><span>Sales Office</span></a></li>
				<li><a class="codrops-icon codrops-icon-prev" href="http://10.134.47.1/NMC/POS.php?select=histpos"><span>POS</span></a></li>
				<li><a class="codrops-icon codrops-icon-prev" href="http://10.134.47.1/NMC/POS.php?select=histsrv"><span>Service</span></a></li>
				<?php
				}
				?>
				<li><a class="codrops-icon codrops-icon-drop" href="http://10.134.47.1/NMC/index.php"><span><?php echo ($_SESSION['session_NAME'].' '.	$_SESSION['session_SURNAME']); ?></span></a></li>
			</ul>
			<header>
				<h1>Nagios POS Management <span>Use this tool to manage Nagios POS inventory</span></h1>			
			</header> 
			<?php
		if($_GET["select"] == "allop")
		{
		echo	'<center><iframe frameborder="0" src="http://10.134.47.1/NMC/POS/jTableSimple.php" name="POS" width="1775" height="1000"></iframe></center>';
				}
		else if ($_GET["select"] == "delall")
		{
		echo	'<center><iframe frameborder="0" src="http://10.134.47.1/NMC/POS/POS_Deleted.php?select=delall" name="POS" width="1775" height="1000"></iframe></center>';
		}
		else if ($_GET["select"] == "delso")
		{
		echo	'<center><iframe frameborder="0" src="http://10.134.47.1/NMC/POS/POS_Deleted.php?select=delso" name="POS" width="1775" height="1000"></iframe></center>';
		}
		else if ($_GET["select"] == "delpos")
		{
		echo	'<center><iframe frameborder="0" src="http://10.134.47.1/NMC/POS/POS_Deleted.php?select=delpos" name="POS" width="1775" height="1000"></iframe></center>';
		}
		else if ($_GET["select"] == "delsrv")
		{
		echo	'<center><iframe frameborder="0" src="http://10.134.47.1/NMC/POS/POS_Deleted.php?select=delsrv" name="POS" width="1775" height="1000"></iframe></center>';
		}
		else if ($_GET["select"] == "histall")
		{
		echo	'<center><iframe frameborder="0" src="http://10.134.47.1/NMC/POS/History.php?select=histall" name="POS" width="1775" height="1000"></iframe></center>';
		}
		else if ($_GET["select"] == "histso")
		{
		echo	'<center><iframe frameborder="0" src="http://10.134.47.1/NMC/POS/History.php?select=histso" name="POS" width="1775" height="1000"></iframe></center>';
		}
		else if ($_GET["select"] == "histpos")
		{
		echo	'<center><iframe frameborder="0" src="http://10.134.47.1/NMC/POS/History.php?select=histpos" name="POS" width="1775" height="1000"></iframe></center>';
		}
		else if ($_GET["select"] == "histsrv")
		{
		echo	'<center><iframe frameborder="0" src="http://10.134.47.1/NMC/POS/History.php?select=histsrv" name="POS" width="1775" height="1000"></iframe></center>';
		}
?>		
		</div><!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
			<?php			
			}
			else
			{
			echo "You are not authorized tho see this content";
			header('location: index.php'); 
			}
			?>
		</script>
	</body>
</html>