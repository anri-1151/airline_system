<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/form_style.css"/>
<link rel="stylesheet" type="text/css" href="../css/style.css"/>
<link rel="stylesheet" type="text/css" href="../css/styles.css"/>
<link rel="stylesheet" href="../css/login_style.css">
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
<script src="../js/script.js"></script>
<script src="../js/script_menu.js"></script>
<script src="../js/autoadvance.js"></script>
<script src="../js/index.js"></script>
<title>Airline System</title>
</head>
<body>

<div class="container">
<div class="header">


<div id='cssmenu'>
<ul>
    <li class='active'><a href='../index.php'>Home</a></li>
   <li><a href='../index.php?menu=1'>User Register</a></li>
   <li><a href='../index.php?menu=2'>About Us</a></li>
    <li><a href='../index.php?menu=3'>Contact</a></li>
   <h1>Airline ticket Reservation System</h1>
</ul>
</div>
</div>
<br><br>
<h1 style="text-align: center;">Admin Panel</h1>
<div class="wrapper">
<div class="container1">
		<h1>Welcome</h1>

		<form class="form"  method="post">
			<input type="text" placeholder="nick name" name="nick">
			<input type="password" placeholder="password" name="password">
			<button type="submit" id="login-button" name="login">Log In</button>
		</form>
</div>
</div>

<?php

include ('../configuration/connection.php');
if (isset($_POST['login']))
{
	$name=trim($_POST['nick']);
	$password=trim($_POST['password']);
	$password = addslashes($password);
    $hash_pass = md5($password.'@^%^TYGHys23233');
	$sql="select id, nick, password from administrator where nick='$name' and password='$hash_pass'";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
	if (mysql_num_rows($result)==1)
	{
		session_start();
		$_SESSION['id']=$row['id'];
		$_SESSION['nick']=$row['nick'];
		?>
		<script type="text/javascript">
          window.location='admin.php';
        </script>
 <?php
	}
	else
	{
		echo '<script>window.alert("Wrong Username or password");</script>';
	}
}




?>
</div>
</body>
</html>