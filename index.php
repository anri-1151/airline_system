<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/form_style.css"/>
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/styles.css"/>
<link rel="stylesheet" type="text/css" href="css/login_style.css">
<link rel="stylesheet" type="text/css" href="css/contact.css">
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
<script src="js/script.js"></script>
<script src="js/script_menu.js"></script>
<script src="js/autoadvance.js"></script>
<script src="js/index.js"></script>
<title>Airline System</title>
</head>
<body>

<div class="container">
<div class="header">


<div id='cssmenu'>
<ul>
   <li class='active'><a href='?menu=0'>Home</a></li>
   <li><a href='?menu=1'>User Register</a></li>
   <li><a href='?menu=2'>About Us</a></li>
    <li><a href='?menu=3'>Contact</a></li>
   <h1>Airline ticket Reservation System</h1>
</ul>
</div>
</div>

<?php
$menu=0;
if (isset($_GET['menu']))
{
$menu=$_GET['menu'];
if ($menu=='') $menu=0;
}
$mn[]='main.php';
$mn[]='registration.php';
$mn[]='about_us.php';
$mn[]='contact.php';
include $mn[$menu]; 
?>
</div>
<footer>
<marquee behavior="scroll" direction="left"><img src="img/airplain.jpg" width="250" height="100"  /></marquee>

<p>
Travel Company. All rights reserved.
</p>            
</footer>       
</body>        
</html>         