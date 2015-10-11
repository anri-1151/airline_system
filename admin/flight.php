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
	$plain_sql="select plain_id, plain_name from plains";
	$result_plain=mysql_query($plain_sql) or die("error");
	
?>
<div  class="form_register">
    		<form name="registrationform" id="form_register" method="post"> 
			<p class="contact"><label for="plain">Plain</label></p> 
            <select class="select-style gender" name="plain">
            <option value="select">plain..</option>
			<?php
			while ($row_plain=mysql_fetch_array($result_plain))
			echo '<option value="'.$row_plain['plain_id'].'">'.$row_plain['plain_name'].'</option>';
			?>
            </select>
			
			<p class="contact"><label for="dep_city"><br>Departure City</label></p> 
    			<input id="dep_city" name="dep_city" placeholder="departure city" required="" tabindex="1" type="text"> 
				<p class="contact"><label for="arr_city">Arrival City</label></p> 
    			<input id="arr_city" name="arr_city" placeholder="arrival city" required="" tabindex="1" type="text"> 
				<p class="contact"><label for="dep_time">Departure time</label></p> 
    			<input id="dep_time" name="dep_time" placeholder="departure time" required="" tabindex="1" type="datetime"> 
				<p class="contact"><label for="arr_time">Arrival time</label></p> 
    			<input id="arr_time" name="arr_time" placeholder="arr time" required="" tabindex="1" type="datetime"> 
				<p class="contact"><label for="plain">Class</label></p> 
                <select class="select-style gender" name="class">
                <option value="select">class..</option>
				<option value="econom">econom</option>
				<option value="business">business</option>
				</select>
                 <p class="contact"><label for="seats"><br>Seats</label></p> 
    			<input id="seats" name="seats" placeholder="number of seats" required="" tabindex="1" type="text"> 
				<p class="contact"><label for="ad_price">Adult Price</label></p> 
    			<input id="ad_price" name="ad_price" placeholder="adult price" required="" tabindex="1" type="text"> 
				<p class="contact"><label for="ch_price">Child Price</label></p> 
    			<input id="ch_price" name="ch_price" placeholder="adult price" required="" tabindex="1" type="text"> 
				<br>
				 <input  class="buttom" name="submit" id="submit" tabindex="5" value="Add" type="submit"> 	 
   </form> 
</div>   
<?php
if (isset($_POST['submit']))
{
	$plain_id=trim($_POST['plain']);
	$dep_city=trim($_POST['dep_city']);
	$arr_city=trim($_POST['arr_city']);
	$dep_time=trim($_POST['dep_time']);
	$arr_time=trim($_POST['arr_time']);
	$class=trim($_POST['class']);
	$seats=trim($_POST['seats']);
	$ad_price=trim($_POST['ad_price']);
	$ch_price=trim($_POST['ch_price']);
	$insert="insert into flights (plain_id, departure_city, arrival_city, departure_time, arrival_time, class_name, seats, adult_price, child_price)
	values ($plain_id, '$dep_city','$arr_city','$dep_time','$arr_time','$class',$seats,$ad_price,$ch_price)";
	$result=mysql_query($insert) or die("error");
	echo '<script>alert("Successfully Recorded")</script>';
	
}

}
?>

</div>
</body>
</html>
<?php
if (isset($_POST['update']))
{

	$name=trim($_POST['plain']);
	$update="update plains set plain_name='$name' where plain_id=$q";
	$update_result=mysql_query($update) or die("error");
	echo '<script>alert("Successfully Updated")</script>';
}
?>