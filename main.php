<div class="slider">
<div id="slideshow">

	<ul class="slides">
    	<li><img src="img/photos/1.jpg" width="100%" height="320" alt="picture1" /></li>
        <li><img src="img/photos/2.jpg" width="100%" height="320" alt="picture2" /></li>
        <li><img src="img/photos/3.jpg" width="100%" height="320" alt="picture3" /></li>
     </ul>

    <span class="arrow previous"></span>
    <span class="arrow next"></span>
</div>
</div>
<aside id="login_side">
<div class="wrapper">
<div class="container1">
		<h1>Welcome</h1>

		<form class="form"  method="post">
			<input type="text" placeholder="Personal ID" name="id">
			<input type="password" placeholder="Password" name="password">
			<button type="submit" id="login-button" name="login">Login</button>
		</form>
	</div>
	</div>
</aside>
<article>
<br>
<h1>Travel Company</h1>
<br>
Our travel company has flights in many countries. To buy ticket you need to do this steps.
<ul>
<li>You must register into our website.</li>
<li>Then you must go to user panel and there you can choose desired directions.</li>
<li>In Our company you can pay only from card. </li>
<li>Finally, when your booking process will be finished, you must go check in process to finish to buy ticket. </li>
</ul>
Without this process, in airport you will have problems. Thank you for using our travel company. Wish you Success!!! :)
<br>
</article>
</div>
<?php
session_start();
include ('configuration/connection.php');
if (isset($_POST['login']))
{
$id=$_POST['id'];
$password=$_POST['password'];
$password = addslashes($password);
$hash_pass = md5($password.'@^%^TYGHys23233');

$sql="select person_id as id, person_name as name, person_surname as surname from persons where perons_id='$id' and password='$hash_pass'";
$result=mysql_query($sql) or die ("error");

if (mysql_num_rows($result)==1)
{
$row=mysql_fetch_array($result);
$_SESSION['id']=$row["id"];
$_SESSION['name']=$row["name"];
$_SESSION['surname']=$row["surname"];
}
else
{
    echo '<script>window.alert("Wrong Username or password");</script>';
}
?>
<script type="text/javascript">
 window.location='user/index.php';
 </script>
<?php
}
?>

