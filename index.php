<!DOCTYPE html>
<?php
session_start();
$date = new DateTime();
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
									<a class="gn-icon gn-icon-search" ><span>Search</span></a>
								</li>
								<li>
									<?php
									if ($_SESSION['session_prv_POS_VIEW'] == "Y")
									{
									?>
									<a class="gn-icon gn-icon-download" href="http://10.134.47.1/NMC/POS.php?select=allop">POS</a>
								
										<li><a class="gn-icon gn-icon-illustrator" href="http://10.134.47.1/NMC/POS.php?select=delall">Deleted POS Items</a></li>
										<li><a class="gn-icon gn-icon-photoshop" href="http://10.134.47.1/NMC/POS.php?select=histall">History /Changes</a></li>
									
									<?php
									}
									?>									
								
									
										<li><a class="gn-icon gn-icon-videos" href="logout.php" >Logout</a></li>
								</li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
		
				
				<li><a class="codrops-icon codrops-icon-drop" href="http://10.134.47.1/NMC/index.php"><span><?php echo ($_SESSION['session_NAME'].' '.	$_SESSION['session_SURNAME']); ?></span></a></li>
			</ul>
			<header>
				<h1>Nagios Management Console <span>Use this tool to manage Nagios Inventory</span></h1>			
			</header>

			<center><h1>Wlecome in Nagios Management Console!!</h1></center>
		</div><!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
		<?php			
			}
			else
			{
			?>
			<div class="container">
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
							<li><a class="codrops-icon codrops-icon-drop" href="index.php?sign=1"><span>Sign In</span></a></li>
							<li><a class="gn-icon gn-icon-download" href="http://10.134.47.1/NMC/">Home</a></li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
		
				
				<li><a class="codrops-icon codrops-icon-drop" href="index.php?sign=1"><span>Sign In</span></a></li>
			</ul>
			<header>
				<h1>Nagios Management Console <span>Use this tool to manage Nagios Inventory</span></h1>			
			</header>

			<center><h1>Wlecome to Nagios Management Console!!</h1>
			<?php
			if (isset($_GET['sign']))
			{
			?>
		<div class='h3'><h3>Sign in</h3></div><div class='text'>
	<form action='index.php' method='POST'>
	<table>
		<tr>
			<td>Pass Your Login:</td><td><input type='text' name='login' class='input' /></td>
		</tr>
		<tr>
			<td>Pass Password:</td><td><input type='password' name='pass' class='input' /></td>
		</tr>
		<tr>
			<td>Pass Your Name:</td><td><input type='text' name='name' class='input' /></td>
		</tr>
		<tr>
			<td>Pass Your Surname:</td><td><input type='text' name='sname' class='input' /></td>
		</tr>
		<tr>
			<td>Pass Your E-mail:</td><td><input type='text' name='email' class='input' /></td>
		</tr>
		<tr>
			<td>Pass Your Group:</td><td><select name="group">
		<option>Sysops</option>
		<option>CS</option>
		<option>CSA</option>
		<option>MSC</option>
	</select></td>
		</tr>
		<tr>
			<td colspan=2><input type='submit' name='Signin' value='Sign in' /></td>
		</tr>
	</table>
	</form>
	<?php
	}
	else
	{
	?>
	<div class='h3'><h3>Log in!</h3></div><div class='text'>
	<form action='' method='POST'>
	<table>
		<tr>
			<td>Username:</td><td><input type='text' name='user' class='input' /></td>
		</tr>
		<tr>
			<td>Password:</td><td><input type='password' name='password' class='input' /></td>
		</tr>
		<tr>
			<td colspan=2><input type='submit' name='zaloguj' value='Log in' /></td>
		</tr>
	</table>
	</form>
	</div><div class='foot'></div>
		</center>
		</div><!-- /container -->
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
				<?php		
			}
			if(isset($_POST['zaloguj']))
		{
		$user = $_POST['user'];
		$password = $_POST['password'];
		
		#Sprawdzanie pól formularza
		if(!$_POST['user'] || !$_POST['password'])
		{
			echo "One ore more fileds are empty";
			exit; 
		}
		if(isset($_POST['user']) && isset($_POST['password']))
		{
		$db = new mysql('root','Q','Nagios_Inventory','localhost');
		$pass = md5($_POST['password']);
		//echo $pass;
		$data = $db->checklogin($_POST['user'],$pass);
		foreach($data as $element){
		if(isset($element['ID']))
		{
		//echo($element['ID']);
		//echo($element['LOGIN']);
		//echo($element['PASS']);
		//echo($element['NAME']);
		//echo($element['SURNAME']);
		//echo(md5($element['PASS']));
		$_SESSION['session_id'] = $element['ID'];
		$_SESSION['session_user'] = $element['LOGIN'];
		$_SESSION['session_NAME'] = $element['NAME'];
		$_SESSION['session_SURNAME'] = $element['SURNAME'];
		$_SESSION['session_EMAIL'] = $element['EMAIL'];
		$_SESSION['session_DATE'] = $element['DATE'];
		$_SESSION['session_ACTIVE'] = $element['ACTIVE'];
		$_SESSION['session_GR_NAME'] = $element['GR_NAME'];
		$_SESSION['session_prv_POS_MMGT'] = $element['POS_MMGT'];
		$_SESSION['session_prv_POS_VIEW'] = $element['POS_VIEW'];
		$_SESSION['session_prv_POS_DEL_VIEW'] = $element['POS_DEL_VIEW'];
		$_SESSION['session_prv_POS_DEL_MMGT'] = $element['POS_DEL_MMGT'];
		$_SESSION['session_prv_POS_HIST_VIEW'] = $element['POS_HIST_VIEW'];
		
		header('location: index.php'); 
		$db->close();
		}
		else 
			{
				echo "Login lub hasło, jest niepoprawne...";
				exit;
			}
		}
		}
		}
		}
		if(isset($_POST['Signin']))
		{
		if(!$_POST['login'] || !$_POST['pass'] || !$_POST['name'] || !$_POST['sname'] || !$_POST['email'] || !$_POST['group'])
		{
			echo "One ore more fileds are empty";
			exit; 
		}
		//echo ($_POST['login']);
		//echo ($_POST['pass']);
		$pass = md5($_POST['pass']);
		//echo $pass;
		//echo ($_POST['name']);
		//echo ($_POST['sname']);
		//echo ($_POST['email']);
		//echo ($_POST['group']);
		$now = $date->format('Y-m-d H:i:s');
		$dbu = new mysql('root','Q','Nagios_Inventory','localhost');
		$datau = $dbu->addusr($_POST['login'],$pass,$_POST['name'],$_POST['sname'],$_POST['email'],$_POST['group'],$now);
		$datag = $dbu->addusrgr($_POST['login'],$_POST['group']);
		#$c = "sendEmail -s 10.134.27.1:25 -t amadeusz.grabowski@kapsch.net -f NMC@viatoll.pl -u 'New User Registred please activate' -m 'You Have New Accout in system \n\nUser Login:'".$_POST['login']."' \nUser name:'".$_POST['name']."' \n User surname:'".$_POST['sname']."' \n User email:'".$_POST['email']."'\n Group:'".$_POST['group']."' \n\n Please activate! '";
		#$mail = system($c);
		#$c2 = "sendEmail -s 10.134.27.1:25 -t '".$_POST['email']."' -f NMC@viatoll.pl -u 'New User Registred wait for activation' -m 'Account successfully created \n\nUser Login:'".$_POST['login']."' \nUser name:'".$_POST['name']."' \n User surname:'".$_POST['sname']."' \n User email:'".$_POST['email']."'\n Group:'".$_POST['group']."' \n\n Please wait for activation by admin! '";
		#$mail2 = system($c2);
		header('location: index.php'); 
		echo "OK Registration Successfull! Wait for Activation By Administrator";
		
		}
		
		
		
			?>
	</body>
</html>
