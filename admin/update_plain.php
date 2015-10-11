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
function showPlain(str) {
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
        xmlhttp.open("GET","getplain.php?q="+str,true);
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
	$plain_sql="select plain_id, plain_name from plains";
	$result_plain=mysql_query($plain_sql);
	
}


?>
<br>
<div  class="form_register">

	<p class="contact"><label for="plain">Plain</label></p> 
    <select class="select-style gender" name="plain" onchange="showPlain(this.value)">
     <option value="select">plain..</option>
			<?php
			while ($row_plain=mysql_fetch_array($result_plain))
			echo '<option value="'.$row_plain['plain_id'].'">'.$row_plain['plain_name'].'</option>';
			?>
    </select>
	<br><br>

<div id="response">
	<p class="contact"><label>Plain info will be listed here...</label></b></p>
</div>
<br>
</div>
</div>
</body>
</html>
<?php
if (isset($_POST['update']))
{
	$q=trim($_POST['id']);
	$name=trim($_POST['plain']);
	$update="update plains set plain_name='$name' where plain_id=$q";
	$update_result=mysql_query($update) or die("error");
	echo '<script>alert("Successfully Updated")</script>';
}
?>
