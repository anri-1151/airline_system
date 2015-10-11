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
	
	if (isset($_POST['buy']))
	{
		$flights=$_SESSION['flights'];
		$adult_cnt=$_POST['adult'];
		$child_cnt=$_POST['child'];
	    $arr=$_POST['places'];
		$_SESSION['places']=$arr;
		$_SESSION['adult']=$adult_cnt;
		$_SESSION['child']=$child_cnt;
		if (count($flights)==1)
		{
		   $flight_id=$flights[0];
		   $flight_sql="select adult_price as adult, child_price as child from flights where flight_id=$flight_id";
		   $result_flight=mysql_query($flight_sql) or die("error");
		   $row_flight=mysql_fetch_array($result_flight);
		   $ad=$row_flight["adult"]; $ch=$row_flight["child"];
		   $total=$ad*$adult_cnt+$ch*$child_cnt;
		   $_SESSION['total']=$total;
		}
		else
		{
			if (count($flights)==2)
			{
				$flight_id1=$flights[0];
				$flight_id2=$flights[1];
				$flight_sql1="select adult_price as adult, child_price as child from flights where flight_id=$flight_id1";
		        $result_flight1=mysql_query($flight_sql1) or die("error");
		        $row_flight1=mysql_fetch_array($result_flight1);
				$ad1=$row_flight1["adult"]; $ch1=$row_flight1["child"];
				$flight_sql2="select adult_price as adult, child_price as child from flights where flight_id=$flight_id2";
		        $result_flight2=mysql_query($flight_sql2) or die("error");
		        $row_flight2=mysql_fetch_array($result_flight2);
				$ad2=$row_flight2["adult"]; $ch2=$row_flight2["child"];
				$total=($ad1+$ad2)*$adult_cnt+($ch1+$ch2)*$child_cnt;
				$total1=$ad1*$adult_cnt+$ch1*$child_cnt;
				$total2=$ad2*$adult_cnt+$ch2*$child_cnt;
				$_SESSION['total1']=$total1;
				$_SESSION['total2']=$total2;
			}
		}
	   
	   
	}

}
?>
<header class="register_head">
				<h1>Fill Payment Details</h1>
            </header> 
			<br>
<p class="contact" ><label><h1 style="text-align:center;">Your total Payment is <?php echo $total; ?>GEL</h1></label>
<br><br>			
      <div  class="form_register">
    		<form name="registrationform" id="form_register" method="post" action="finish.php"> 
			   
			   <p class="contact"><label for="card_number">Card Number</label></p> 
    			<input id="card_number" name="card_number" placeholder="card number" required="" tabindex="2" type="text"> 
				<p class="contact"><label for="uniq">Unique Number</label></p> 
    			<input id="uniq" name="uniq" placeholder="unique number" required="" tabindex="2" type="text">
				<br>
				 <input  class="buttom" name="submit" id="submit" tabindex="5" value="Buy" type="submit"> 	 
   </form> 
   </div>
   <footer>
<p>
Travel Company. All rights reserved.
</p>            
</footer>
</div>
</body>
</html>