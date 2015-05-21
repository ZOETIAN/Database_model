<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "topp";

mysql_connect($host, $user, $pass);
mysql_select_db($db);

if (isset($_POST['username'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$sql = "select * FROM users WHERE username='".$username."' AND password='".$password."' LIMIT 1";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) == 1) {
		echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=topp.php">';
		exit();
	} else {
		echo "Login Failed! Click login to try again.";
		exit();
	}
}

?>

<!DOCTYPE html>

	<!-- CSCI2141 DB FINAL WEB -->

<html>
    <head>

        <meta charset="utf-8">
        <meta name="author" content="Wanru,Tian">
        <meta name="description" content="Final Project_logging page">

        <title>Log-in</title>

 		<link href="css/custom.css" rel="stylesheet" type="text/css" media="all" />

		
    </head>
    <body>

		<div class="login-site">	
		<div class = "login-logo">
				<a href="login.php"><img src="media/logo.jpg" alt="logo"/></a>
		</div>
			<div style="box-sizing: border-box; 
						display:inline-block; 
						width:auto; 
						max-width: 480px; 
						background-color: #FFFFFF; 
						border: 2px solid #0361A8; 
						border-radius: 5px; 
						box-shadow: 0px 0px 8px #0361A8; 
						margin: 50px auto auto;">
						
			
				<div style="background: #0361A8; <!--#0361A8 #D4D4D4-->
							border-radius: 5px 5px 0px 0px; 
							padding: 15px;">
							<span style="font-family: verdana,arial;color: white; 
								font-size: 1.00em; font-weight:bold;">
									Enter your login and password
							</span>
				</div>
			
			<div style="background: white; padding: 15px">
				<form method="post" action="login.php" name="aform" target="_top">
					<input type="hidden" name="action" value="login">
					<input type="hidden" name="hide" value="">
					<table class='center'>
						<tr><td>Username:</td><td><input type="text" name="username"></td></tr>
						<tr><td>Password:</td><td><input type="password" name="password"></td></tr>
						<tr></tr>
						<tr></tr>
						<tr></tr>
						<tr><td>&nbsp;</td><td><input type="submit" value="Submit"></td></tr>
						<tr><td colspan=2>&nbsp;</td></tr>
					</table>
				</form>
			</div>
			</div>
		</div>

    </body>
</html>
