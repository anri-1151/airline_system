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
<div class="menu">
<ul>
<li><a href="admin.php">Main Page</a></li>
<li><a href="plain.php">Add Plane</a></li>
<li><a href="flight.php">Add Flight</a></li>
<li><a href="update_plain.php">Update Plane</a></li>
<li><a href="update_flight.php">Update Flight</a></li>
<li><a href="payment.php">See Payments</a></li>
<li><a href="logout.php">Log Out</a></li>
</ul>
</div>
<br><br>
<div  class="form_register">
    		<form name="registrationform" id="form_register" method="post"> 
			<p class="contact"><label for="name">Plain Name</label></p> 
    			<input id="name" name="name" placeholder="plane name" required="" tabindex="1" type="text"> 
				<br>
				 <input  class="buttom" name="submit" id="submit" tabindex="5" value="Add" type="submit"> 	 
   </form> 
</div>   
<?php
include ('../configuration/connection.php');
session_start();
if (!isset($_SESSION['id']) || trim($_SESSION['id'])=='') 
{
	header("location:../index.php");
	exit();
}
else
{
	if (isset($_POST['submit']))
	{
		$name=trim($_POST['name']);
		$insert="insert into plains (plain_name) values ('$name')";
		$result_insert=mysql_query($insert) or die("error");
		echo '<script>alert("Successfully Recorded")</script>';
		
	}
	
}
?>
</div>
</body>
</html>