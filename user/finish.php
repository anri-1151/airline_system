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
	if (isset($_POST['submit']))
	{
		$card_number=$_POST['card_number'];
		$uniq=$_POST['uniq'];
		$adult_cnt=$_SESSION['adult'];
	    $child_cnt=$_SESSION['child'];
		$arr=$_SESSION['places'];
		$flights=$_SESSION['flights'];
	    
        if (count($flights)==1) 
	   { 
           $total=$_SESSION['total'];
		   $flight_id=$flights[0];
		   $name=$_SESSION['name']; $surname=$_SESSION['surname'];
		   $unic_code=$_SESSION['name'].$_SESSION['id'].$surname[0].$surname[1];
		   $person_id=$_SESSION['id'];
		   $book_sql="insert into books (flight_id, person_id, adult_quantity,child_quantity, total_price, unic_code)
		   values ($flight_id, $person_id, $adult_cnt, $child_cnt, $total, '$unic_code')";
		   $book_result=mysql_query($book_sql) or die("error in books");
		   $book_sql1="select book_id as id from books where unic_code='$unic_code' and flight_id=$flight_id";
		   $book_result1=mysql_query($book_sql1) or die ("error in books one");
		   $row_book=mysql_fetch_array($book_result1);
		   $book_id=$row_book["id"];
		   $payment_sql="insert into payments (book_id, person_id, card_number, unic_number, payment_amount)
		   values ($book_id, $person_id, '$card_number', '$uniq', $total)";
		   $payment_result=mysql_query($payment_sql) or die("error in payment");
		   foreach ($arr as $a=>$b)
		   {
			   $booked_place_sql="insert into booked_places (book_id, place_number) values ($book_id, '$arr[$a]')";
			   $result=mysql_query($booked_place_sql) or die("error in booked places");
		   }
		   
		   echo '<br><h1 style="text-align: center">Thank You Successfully done</h1>';
		   echo '<br><h1 style="text-align: center">You Must Go Check In to be able to go passport control in airport</h1>';
		   echo '<br><h1 style="text-align: center">For check in You must remember Your Unique Code</h1>';
		   echo '<br><h1 style="text-align: center">'. $unic_code.'</h1>';
	         
		}
		else
		{
			if (count($flights)==2)
			{
				$flight_id1=$flights[0];
				$flight_id2=$flights[1];
				$total1=$_SESSION['total1'];
				$total2=$_SESSION['total2'];
				$name=$_SESSION['name']; $surname=$_SESSION['surname'];
				$unic_code=$_SESSION['name'].$_SESSION['id'].$surname[0].$surname[1];
		        $person_id=$_SESSION['id'];
				$book_sql1="insert into books (flight_id, person_id, adult_quantity,child_quantity, total_price, unic_code)
		           values ($flight_id1, $person_id, $adult_cnt, $child_cnt, $total1, '$unic_code')";
				$book_result1=mysql_query($book_sql1) or die("error in books");
				$book_sql="select book_id as id from books where unic_code='$unic_code' and flight_id=$flight_id1";
		        $book_result=mysql_query($book_sql) or die ("error in books one");
				$row_book=mysql_fetch_array($book_result);
				$book_id1=$row_book["id"];
				$payment_sql1="insert into payments (book_id, person_id, card_number, unic_number, payment_amount)
		        values ($book_id1, $person_id, '$card_number', '$uniq', $total1)";
		        $payment_result=mysql_query($payment_sql1) or die("error in payment");
		        foreach ($arr as $a=>$b)
		        {
			      $booked_place_sql="insert into booked_places (book_id, place_number) values ($book_id1, '$arr[$a]')";
			      $result=mysql_query($booked_place_sql) or die("error in booked places");
		        }
				
				$book_sql2="insert into books (flight_id, person_id, adult_quantity,child_quantity, total_price, unic_code)
		           values ($flight_id2, $person_id, $adult_cnt, $child_cnt, $total2, '$unic_code')";
				$book_result2=mysql_query($book_sql2) or die("error in books");
				$book_sql="select book_id as id from books where unic_code='$unic_code' and flight_id=$flight_id2";
		        $book_result=mysql_query($book_sql);
				$row_book=mysql_fetch_array($book_result) or die ("error in books one");
				$book_id2=$row_book["id"];
				$payment_sql2="insert into payments (book_id, person_id, card_number, unic_number, payment_amount)
		        values ($book_id2, $person_id, '$card_number', '$uniq', $total2)";
		        $payment_result=mysql_query($payment_sql2) or die("error in payment");
		        foreach ($arr as $a=>$b)
		        {
			      $booked_place_sql="insert into booked_places (book_id, place_number) values ($book_id2, '$arr[$a]')";
			      $result=mysql_query($booked_place_sql) or die("error in booked places");
		        }
				echo '<br><h1 style="text-align: center">Thank You Successfully done</h1>';
		        echo '<br><h1 style="text-align: center">You Must Go Check In to be able to go passport control in airport</h1>';
		        echo '<br><h1 style="text-align: center">For check in You must remember Your Unique Code</h1>';
		        echo '<br><h1 style="text-align: center">'. $unic_code.'</h1>';
				
			}
		}
	}
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