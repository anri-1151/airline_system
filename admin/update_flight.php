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
<script>
function showFlight(str) {
    if (str == "") {
        document.getElementById("response").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("response").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","getflight.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
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
	$flight_sql="select flight_id as id, concat (departure_city, ' ', arrival_city, ' ', departure_time,' ',class_name) as flight from flights";
	$result_flight=mysql_query($flight_sql);
	
}


?>
<br>
<div  class="form_register">

	<p class="contact"><label for="flight">Plain</label></p> 
    <select class="select-style gender" name="flight" onchange="showFlight(this.value)">
     <option value="select">flights..</option>
			<?php
			while ($row_flight=mysql_fetch_array($result_flight))
			echo '<option value="'.$row_flight['id'].'">'.$row_flight['flight'].'</option>';
			?>
    </select>
	<br><br>

<div id="response">
	<p class="contact"><label>Flight info will be listed here...</label></b></p>
</div>
<br>
</div>

</div>
</body>
</html>
<?php
if (isset($_POST['update']))
{
    $id=trim($_POST['id']);
    $plain_id=trim($_POST['plain']);
	$dep_city=trim($_POST['dep_city']);
	$arr_city=trim($_POST['arr_city']);
	$dep_time=trim($_POST['dep_time']);
	$arr_time=trim($_POST['arr_time']);
	$class=trim($_POST['class']);
	$seats=trim($_POST['seats']);
	$ad_price=trim($_POST['ad_price']);
	$ch_price=trim($_POST['ch_price']);
	$update="update flights set plain_id=$plain_id, departure_city='$dep_city', arrival_city='$arr_city',departure_time='$dep_time',arrival_time='$arr_time',
	class_name='$class',seats=$seats, adult_price=$ad_price, child_price=$ch_price where flight_id=$id";
	$result=mysql_query($update) or die("error");
	echo '<script>alert("Successfully Updated")</script>';
}
	
?>