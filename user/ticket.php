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
<h1 style="text-align: center;" id="panel">User Panel</h1>
<div class="menu" id="menu">
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
if (isset($_POST['submit']))
{
	$unic_code=$_POST['uniq'];
	$passport=$_POST['passport'];
	$dep_city=$_POST['dep_city'];
	$arr_city=$_POST['arr_city'];
	$date=$_POST['dep_date'];
	$person_id=$_SESSION['id'];
	$class=$_POST['class'];
    $flight_sql="select  b.book_id as id, f.departure_time as dep_time, f.arrival_time as arr_time, 
	b.adult_quantity as adult, b.child_quantity as child, b.check_status as status
	from flights f, books b 
	where f.flight_id=b.flight_id and lower(f.class_name)=lower('$class') and b.person_id=$person_id and lower(f.departure_city)=lower('$dep_city') and lower(f.arrival_city)=lower('$arr_city') 
	and b.unic_code='$unic_code' and date(f.departure_time)='$date'";
	$result_flight=mysql_query($flight_sql) or die("error flight");
	$result_flight1=mysql_query($flight_sql) or die("error flight");
	$row1=mysql_fetch_array($result_flight1);
	if (mysql_num_rows($result_flight1)!=0 && $row1["status"]!="not chacked")
	{
		echo '<br><br><h1 style="text-align: center;">You have already checked</h1>';
	}
	else
	if (mysql_num_rows($result_flight)==1)
	{
		
		$sql="select person_name as name, person_surname as surname, perons_id as id from persons where person_id=$person_id";
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		$row_flight=mysql_fetch_array($result_flight);
		$update="update books set check_status='checked' where book_id=$row_flight[id]";
		$update_result=mysql_query($update) or die("error");
		echo "Name:".$row["name"]."<br>";
		echo "Surname:".$row["surname"]."<br>";
		echo "ID number:".$row["id"]."<br>";
		echo "Passport Number:".$passport."<br>";
		echo "Class:".$class."<br>";
		echo "Departure City:".$dep_city."<br>";
		echo "Departure Time:".$row_flight["dep_time"]."<br>";
		echo "Arrival City:".$arr_city."<br>";
		echo "Arrival Time:".$row_flight["arr_time"]."<br>";
		echo "Adult Quantity:".$row_flight["adult"]."<br>";
		echo "Child Quantity:".$row_flight["child"]."<br>";
		echo "Selected Places:<br>";
		$sql_place="select place_number as place from booked_places where book_id=$row_flight[id]";
		$place=mysql_query($sql_place);
		while ($row_place=mysql_fetch_array($place))
		{
			echo $row_place["place"]."<br>";
		}
		
	}
	else
		if (mysql_num_rows($result_flight)==0)
		{
			$sql="select f.flight_id as id1, f1.flight_id as id2, f.departure_city as dep_city, f.arrival_city as arr_city, f1.arrival_city as arr_city1, 
			f.departure_time as dep_time, f.arrival_time as arr_time, f1.departure_time as dep_time1, f1.arrival_time as arr_time1
			from flights f, flights f1
			where lower(f.departure_city)=lower('$dep_city') and f.arrival_city=f1.departure_city 
		    and lower(f1.arrival_city)=lower('$arr_city') and f.class_name=f1.class_name and lower(f.class_name)=lower('$class') and date(f.departure_time)='$date'";
			$result=mysql_query($sql) or die("error");
			$row=mysql_fetch_array($result);
			$dep_city=$row["dep_city"]; $arr_city=$row["arr_city"]; $arr_city1=$row["arr_city1"];
			$dep_time=$row["dep_time"]; $arr_time=$row["arr_time"]; $dep_time1=$row["dep_time1"]; $arr_time1=$row["arr_time1"];
			$id1=$row["id1"];
			$id2=$row["id2"];
			$sql1="select b.book_id as id, b.check_status as status, b.adult_quantity as adult, b.child_quantity as child
			from books b where b.flight_id='$id1' and person_id=$person_id";
			$sql2="select b.book_id as id, b.check_status as status, b.adult_quantity as adult, b.child_quantity as child
			from books b where b.flight_id='$id2' and person_id=$person_id";
			$result1=mysql_query($sql1) or die("error result1");  
			$result2=mysql_query($sql2) or die("error result2");
			$result11=mysql_query($sql1) or die("error result1");  
			$result21=mysql_query($sql1) or die("error result1");  
			$row11=mysql_fetch_array($result11);
			$row21=mysql_fetch_array($result21);
			if (mysql_num_rows($result1)!=0 && mysql_num_rows($result2)!=0 && $row11["status"]!="not chacked" && $row21["status"]!="not chacked")
			{
				echo '<br><br><h1 style="text-align: center;">You have already checked</h1>';
			}
			else
			{
				if (mysql_num_rows($result1)==1 && mysql_num_rows($result2)==1)
				{
					$sql="select person_name as name, person_surname as surname, perons_id as id from persons where person_id=$person_id";
		            $result=mysql_query($sql);
		            $row=mysql_fetch_array($result);
		            $row1=mysql_fetch_array($result1);  
			        $row2=mysql_fetch_array($result2);
					$update1="update books set check_status='checked' where book_id=$row1[id]";
					$update2="update books set check_status='checked' where book_id=$row2[id]";
					$update_result1=mysql_query($update1) or die("error");
					$update_result2=mysql_query($update2) or die("error");
		            echo "Name:".$row["name"]."<br>";
		            echo "Surname:".$row["surname"]."<br>";
		            echo "ID number:".$row["id"]."<br>";
		            echo "Passport Number:".$passport."<br>";
		            echo "Class:".$class."<br>";
					echo "Transit"."<br>";
					echo "Departure City:".$dep_city."<br>";
		            echo "Departure Time:".$dep_time."<br>";
		            echo "Arrival City:".$arr_city."<br>";
		            echo "Arrival Time:".$arr_time."<br>";
					echo "Adult Quantity:".$row1["adult"]."<br>";
		            echo "Child Quantity:".$row1["child"]."<br>";
		            echo "Selected Places:<br>";
					$sql_place="select place_number as place from booked_places where book_id=$row1[id]";
		            $place=mysql_query($sql_place);
		            while ($row_place=mysql_fetch_array($place))
		            {
			            echo $row_place["place"]."<br>";
		            }
					echo "Departure City:".$arr_city."<br>";
		            echo "Departure Time:".$dep_time1."<br>";
		            echo "Arrival City:".$arr_city1."<br>";
		            echo "Arrival Time:".$arr_time1."<br>";
					echo "Adult Quantity:".$row1["adult"]."<br>";
		            echo "Child Quantity:".$row1["child"]."<br>";
		            echo "Selected Places:<br>";
					$sql_place1="select place_number as place from booked_places where book_id=$row2[id]";
		            $place1=mysql_query($sql_place1);
		            while ($row_place1=mysql_fetch_array($place1))
		            {
			            echo $row_place1["place"]."<br>";
		            }
					
				}
				else
				{
					echo '<br><br><h1 style="text-align: center;">Error in Filling Information</h1>';
				}
			}
			
			
			
		}
		
}
}
?>
<br><br><br>
<button onclick="myFunction()" id="button">Print this page</button>
<script>
function myFunction() {
	$("#cssmenu").hide();
	$("#menu").hide();
	$("#panel").hide();
	$("#button").hide();
    window.print();
	$("#cssmenu").show();
	$("#menu").show();
	$("#panel").show();
	$("#button").show();
	
}
</script>
<footer>
<p>
Travel Company. All rights reserved.
</p>            
</footer>
</div>
</body>
</html>