<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/form_style.css"/>
<link rel="stylesheet" type="text/css" href="../css/style.css"/>
<link rel="stylesheet" type="text/css" href="../css/styles.css"/>
<link rel="stylesheet" type="text/css" href="../css/login_style.css">
<link rel="stylesheet" type="text/css" href="../css/table.css"/>
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
<h1 style="text-align: center;">User Panel</h1>
<div class="menu">
<ul>
<li><a href="index.php">Main Page</a></li>
<li><a href="update_info.php">Update Personal Information</a></li>
<li><a href="#">Make Ticket Check In</a></li>
<li><a href="logout.php">Log Out</a></li>
</ul>
</div>
<br><br><br>
<?php echo '<form action="choose_ticket.php" method="post" class="form">'; ?>
<div class="CSSTableGenerator">

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
	
	if (isset($_POST['continue']))
	{
		$dep_city=mysql_escape_string(trim($_POST['dep_city']));
		$arr_city=mysql_escape_string(trim($_POST['arr_city']));
		$sql1="select f.flight_id as id, p.plain_name as name, f.departure_city as dep_city, f.arrival_city as arr_city,
		f.departure_time as dep_time, f.arrival_time as arr_time, f.class_name as class, f.adult_price as add_price, f.child_price as child_price
		from flights f, plains p 
		where f.plain_id=p.plain_id and lower(f.departure_city)=lower('$dep_city') and lower(f.arrival_city)=lower('$arr_city')";
		$result_flight1=mysql_query($sql1) or die ("error");
		if (mysql_num_rows($result_flight1)!=0)
		{
		 echo '<table><tr><td></td><td>Plane</td><td>Departure_city</td><td>Arrival City</td><td>Departure Time</td><td>Arrival Time</td><td>Class</td><td>Adult Price GEL</td><td>Child Price GEL</td></tr>';
		while ($row=mysql_fetch_array($result_flight1))
		{
			echo '<tr><td><input type="radio" name="flight" value='.$row["id"].'></td><td>'.$row["name"].'</td><td>'.$row["dep_city"].'</td><td>'.$row["arr_city"].'</td><td>'.$row["dep_time"].'</td><td>'.$row["arr_time"].'</td><td>'.$row["class"].'</td><td>'
			.$row["add_price"].'</td><td>'.$row["child_price"].'</td></tr>';
		}
		echo '</table>';
		
		}
		else
		{
			
			$sql="select f1.flight_id as id1, f2.flight_id as id2, p.plain_name as name, f1.departure_city as dep_city, f1.arrival_city as arr_city,
		f1.departure_time as dep_time, f1.arrival_time as arr_time, f1.class_name as class, f1.adult_price as add_price, f1.child_price as child_price,
		f2.departure_city as dep1_city, f2.arrival_city as arr1_city,
		f2.departure_time as dep1_time, f2.arrival_time as arr1_time, f2.class_name as class1, f2.adult_price as add_price1, f2.child_price as child_price1
		from flights f1, flights f2, plains p 
		where f1.plain_id=p.plain_id and lower(f1.departure_city)=lower('$dep_city') and f1.arrival_city=f2.departure_city 
		and lower(f2.arrival_city)=lower('$arr_city') and f1.class_name=f2.class_name";
		$result_flight=mysql_query($sql) or die("error");
		if (mysql_num_rows($result_flight)!=0)
		{
			echo '<table><tr><td></td><td style="font-size: 12px;">Departure_city</td><td style="font-size: 12px;">Arrival City</td><td style="font-size: 12px;">Departure Time</td><td style="font-size: 12px;">Arrival Time</td><td style="font-size: 12px;">Class</td style="font-size: 12px;"><td style="font-size: 12px;">Adult Price GEL</td><td style="font-size: 12px;">Child Price GEL</td>
			<td style="font-size: 12px;">Departure_city</td><td style="font-size: 12px;">Arrival City</td><td style="font-size: 12px;">Departure Time</td><td style="font-size: 12px;">Arrival Time</td><td style="font-size: 12px;">Class</td><td style="font-size: 12px;">Adult Price GEL</td><td style="font-size: 12px;">Child Price GEL</td></tr>';
			while ($row=mysql_fetch_array($result_flight))
		   {
			echo '<tr><td><input type="radio" name="flight" value="'.$row['id1'].' '.$row['id2'].'"><td style="font-size: 12px;">'.$row["dep_city"].'</td><td style="font-size: 12px;">'.$row["arr_city"].'</td><td style="font-size: 12px;">'.$row["dep_time"].'</td><td style="font-size: 12px;">'.$row["arr_time"].'</td><td style="font-size: 12px;">'.$row["class"].'</td><td style="font-size: 12px;">'
			.$row["add_price"].'</td><td style="font-size: 12px;">'.$row["child_price"].'</td>
			<td style="font-size: 12px;">'.$row["dep1_city"].'</td><td style="font-size: 12px;">'.$row["arr1_city"].'</td><td style="font-size: 12px;">'.$row["dep1_time"].'</td><td style="font-size: 12px;">'.$row["arr1_time"].'</td><td style="font-size: 12px;">'.$row["class1"].'</td><td style="font-size: 12px;">'
			.$row["add_price1"].'</td><td style="font-size: 12px;">'.$row["child_price1"].'</td></tr>';
		   }
		echo '</table>';
		}
		else
			echo 'no such fligh exists';
		}
		
		
	}
	

}
?>


</div>
<?php echo '<br><br><br><input type="submit" name="continue" value="Continue">';
		echo '</form>'; 
?>
<footer>
<p>
Travel Company. All rights reserved.
</p>            
</footer>
</div>
</body>
</html>