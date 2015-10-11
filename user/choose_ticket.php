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

    <div class="demo">
   		<div id="seat-map" class="demo">
			<!--<div class="front">SCREEN</div>-->			
		</div>
		<div class="booking-details">
			<!--<p>Movie: <span> Gingerclown</span></p>
			<p>Time: <span>November 3, 21:00</span></p>
			<p>Seat: </p>-->
			<p><span>Selected Seats</span></p>
			<p id="demo"></p>
			<form class="form" method="post" action="buy.php">
			
			
			 <ul id="selected-seats" name="selected-seats"></ul>
			<!--<p>Tickets: <span id="counter">0</span></p>
			<p>Total: <b>$<span id="total">0</span></b></p>-->
			<input type="text" name="adult" placeholder="Number Of Adults" style="width: 200px" required>
			<input type="text" name="child" placeholder="Number Of Children" style="width: 200px" required>	
			
			<input type="submit" name="buy" value="Buy" style="background-color: gray">
			</form>		
			<div id="legend"></div>
		</div>
		<div style="clear:both"></div>
</div>

<br><br><br>



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
		$flight=$_POST['flight'];
		$arr=split(' ',$flight);
		$_SESSION['flights']=$arr;
		
	}
}
?>
</div>
<?php 
if (count($arr)==1)
{
$flight1=$arr[0];
$flight_sql="select b2.place_number as place, f.class_name as class  from books b1, booked_places b2, flights f where b1.book_id=b2.book_id and b1.flight_id=f.flight_id and f.flight_id=$flight1";
$result=mysql_query($flight_sql) or die ("error");
$result1=mysql_query("select class_name as class from flights where flight_id=$flight1") or die ("error");
$row1=mysql_fetch_array($result1); 
}
else
if (count($arr)==2)
{
$flight1=$arr[0]; $flight2=$arr[1];
$flight_sql="select b2.place_number as place, f.class_name as class  from books b1, booked_places b2, flights f where b1.book_id=b2.book_id and b1.flight_id=f.flight_id and (f.flight_id=$flight1 or f.flight_id=$flight2)";
$result=mysql_query($flight_sql) or die ("error"); 
$result1=mysql_query("select class_name as class from flights where flight_id=$flight1") or die ("error");
$row1=mysql_fetch_array($result1); 
}


?>

<script type="text/javascript">


var price = 10; //price
$(document).ready(function() {
	var $data=<?php if ($row1["class"]=="econom") { echo "['1_1','1_2','1_3','1_4','1_5','1_6','2_1','2_2','2_3','2_4','2_5','2_6','3_1','3_2','3_3','3_4','3_5','3_6',";
while ($row=mysql_fetch_array($result)) 
echo  "'".$row["place"]."',";
echo "]"; 
}
else if ($row1["class"]=="business") { echo "['5_1','5_2','5_3','5_4','5_5','5_6','6_1','6_2','6_3','6_4','6_5','6_6','7_1','7_2','7_3','7_4','7_5','7_6',
'8_1','8_2','8_3','8_4','8_5','8_6','9_1','9_2','9_3','9_4','9_5','9_6','10_1','10_2','10_3','10_4','10_5','10_6',
'11_1','11_2','11_3','11_4','11_5','11_6','12_1','12_2','12_3','12_4','12_5','12_6',";
while ($row=mysql_fetch_array($result)) 
echo  "'".$row["place"]."',";
echo "]";
} ?>
	
	
	//document.getElementById("demo").innerHTML=$data;
	var $cart = $('#selected-seats'), //Sitting Area
	$counter = $('#counter'), //Votes
	$total = $('#total'); //Total money
	
	var sc = $('#seat-map').seatCharts({
	
		map: [  //Seating chart
			'aaaaaa',
            'aaaaaa',
            'aaaaaa',
            '______',
            'aaaaaa',
			'aaaaaa',
			'aaaaaa',
			'aaaaaa',
			'aaaaaa',
            'aaaaaa',
			'aaaaaa',
			'aaaaaa',
			
			
			
		],
		naming : {
			top : true,
			getLabel : function (character, row, column) {
				return column;
			}
		},
		legend : { //Definition legend
			node : $('#legend'),
			items : [
				[ 'a', 'available',   'Option' ],
				[ 'a', 'unavailable', 'Sold']
			]					
		},
		click: function () { //Click event
		
			if (this.status() == 'available') { //optional seat
			
	
			     var $d1=this.settings.row+1;
				 var $d2=this.settings.row;
				 
				$('<li><input type=hidden name=places[] value='+(this.settings.row+1)+'_'+this.settings.label+'>R'+(this.settings.row+1)+' S'+this.settings.label+'</li>')
					.attr('id', 'cart-item-'+this.settings.id)
					.data('seatId', this.settings.id)
					.appendTo($cart);

				$counter.text(sc.find('selected').length+1);
				$total.text(recalculateTotal(sc)+price);
							
				return 'selected';
			} else if (this.status() == 'selected') { //Checked
					//Update Number
					$counter.text(sc.find('selected').length-1);
					//update totalnum
					$total.text(recalculateTotal(sc)-price);
						
					//Delete reservation
					$('#cart-item-'+this.settings.id).remove();
					//optional
					return 'available';
			} else if (this.status() == 'unavailable') { //sold
				return 'unavailable';
			} else {
				return this.style();
			}
		}
	});
	//sold seat
	
	sc.get($data).status('unavailable');
		
});
//sum total money
function recalculateTotal(sc) {
	var total = 0;
	sc.find('selected').each(function () {
		total += price;
	});
			
	return total;
}
</script>
<footer>
<p>
Travel Company. All rights reserved.
</p>            
</footer>
</body>
</html>

