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
    $id=$_SESSION['id'];
	$sql="select person_name as name, person_surname as surname, date_of_birth as dob, email as mail,  perons_id as id
	from persons where person_id=$id";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);
}
?>
<div class="container">
			 
			    <header class="register_head">
				<h1>Update Personal Information</h1>
            </header>       
      <div  class="form_register">
    		<form name="registrationform" id="form_register" method="post" action="update_info.php"> 
			
			   <p class="contact"><label for="id">Personal ID Number</label></p> 
    			<input id="id" name="id" value="<?php echo $row["id"]; ?>"required="" tabindex="2" type="text"> 
    			<p class="contact"><label for="name">Name</label></p> 
    			<input id="name" name="name" value="<?php echo $row["name"]; ?>" required="" tabindex="1" type="text"> 
    			 
				 <p class="contact"><label for="surname">Surname</label></p> 
    			<input id="surname" name="surname" value="<?php echo $row["surname"]; ?>" required="" tabindex="2" type="text"> 
				
    			<p class="contact"><label for="email">Email</label></p> 
    			<input id="email" name="email" value="<?php echo $row["mail"]; ?>" required="" type="email"> 
                
                
    			 
                
        
                <p class="contact"><label for="dob">Date Of Birth</label></p> 
                <input type="date" id="dob" name="dob" required="" value="<?php echo $row["dob"]; ?>"> 
             
           <br><br>
            
            
            <input  class="buttom" name="submit" id="submit" tabindex="5" value="Update" type="submit"> 	 
   </form> 
</div>   
</div>
<footer>
<p>
Travel Company. All rights reserved.
</p>            
</footer>
</div>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
	$id=trim($_POST['id']);
	$name=trim($_POST['name']);
	$surname=trim($_POST['surname']);
	$email=trim($_POST['email']);
	$dob=trim($_POST['dob']);
	$errors=array();
	if (strlen($id)==0)
		array_push($errors, "Please enter your id");
	if (strlen($name)==0)
		array_push($errors, "Please enter your name");
	if (strlen($surname)==0)
		array_push($errors, "Please enter your surname");
	if (strlen($email)==0)
		array_push($errors, "Please enter your email");
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        array_push($errors, "Please specify a valid email address");
	
	$ddmmyyyy = split( '-', $dob);
    if (count($ddmmyyyy) != 3 )
        array_push($errors, "Invalid date!");
    else
    if (count($ddmmyyyy)==3  && !checkdate($ddmmyyyy[1],$ddmmyyyy[2],$ddmmyyyy[0]))
        array_push($errors, "Invalid date!");
	
	
    foreach($errors as $val) {
       echo $val;
    }
	
	if (count($errors)==0) 
	{
		$pers_id=$_SESSION['id'];
		$sql="update persons set person_name='$name', person_surname='$surname', email='$email', date_of_birth='$dob', perons_id='$id'
		where person_id=$pers_id";
		$update=mysql_query($sql) or die ("error");
		header("location:update_info.php");
	}
}
?>