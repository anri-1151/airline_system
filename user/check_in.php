<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/form_style.css"/>
<link rel="stylesheet" type="text/css" href="../css/style.css"/>
<link rel="stylesheet" type="text/css" href="../css/styles.css"/>
<link rel="stylesheet" type="text/css" href="../css/login_style.css">
<link rel="stylesheet" type="text/css" href="../css/table.css"/>
<link rel="stylesheet" type="text/css" href="../css/ticket.css"/>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
<script src="../js/script.js"></script>
<script src="../js/script_menu.js"></script>
<script src="../js/autoadvance.js"></script>
<script src="../js/index.js"></script>
<script src="../js/jquery.seat-charts.min.js"></script> 
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
<h1 style="text-align: center;">User Panel</h1>
<div class="menu">
<ul>
<li><a href="index.php">Main Page</a></li>
<li><a href="update_info.php">Update Personal Information</a></li>
<li><a href="check_in.php">Make Ticket Check In</a></li>
<li><a href="logout.php">Log Out</a></li>
</ul>
</div>
<header class="register_head">
				<h1>Fill Check In Details</h1>
            </header> 
			<br>
     
      <div  class="form_register">
    		<form name="registrationform" id="form_register" method="post" action="ticket.php"> 
			   <p class="contact"><label for="uniq">Unique Code</label></p> 
    			<input id="uniq" name="uniq" placeholder="unique code" required="" tabindex="2" type="text">
				<p class="contact"><label for="passport">Passport Number</label></p> 
    			<input id="passport" name="passport" placeholder="passport number" required="" tabindex="2" type="text"> 
				<p class="contact"><label for="date">Class</label></p> 
    			<input id="class" name="class"  placeholder="class" required="" tabindex="2" type="text"> 
				<p class="contact"><label for="passport">Departure City</label></p> 
    			<input id="dep_city" name="dep_city" placeholder="departure city" required="" tabindex="2" type="text"> 
				<p class="contact"><label for="passport">Arrival City</label></p> 
    			<input id="arr_city" name="arr_city" placeholder="Arrival city" required="" tabindex="2" type="text"> 
				<p class="contact"><label for="date">Departure Date</label></p> 
    			<input id="dep_date" name="dep_date"  required="" tabindex="2" type="date"> 
				<br>
				 <input  class="buttom" name="submit" id="submit" tabindex="5" value="Check In" type="submit"> 	 
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
}
?>
<footer>
<p>
Travel Company. All rights reserved.
</p>            
</footer>
</div>
</body>
</html>