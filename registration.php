<div class="container">
			 
			    <header class="register_head">
				<h1>Registration Form</h1>
            </header>       
      <div  class="form_register">
    		<form name="registrationform" id="form_register" method="post"  onsubmit="return validate()"> 
			
			   <p class="contact"><label for="id">Personal ID Number</label></p> 
    			<input id="id" name="id" placeholder="id" required="" tabindex="2" type="text"> 
    			<p class="contact"><label for="name">Name</label></p> 
    			<input id="name" name="name" placeholder="name" required="" tabindex="1" type="text"> 
    			 
				 <p class="contact"><label for="surname">Surname</label></p> 
    			<input id="surname" name="surname" placeholder="surname" required="" tabindex="2" type="text"> 
				
    			<p class="contact"><label for="email">Email</label></p> 
    			<input id="email" name="email" placeholder="example@domain.com" required="" type="email"> 
                
                
    			 
                <p class="contact"><label for="password">Create a password</label></p> 
    			<input type="password" id="password" name="password" placeholder="password" required=""> 
                <p class="contact"><label for="repassword">Confirm your password</label></p> 
    			<input type="password" id="repassword" name="repassword" placeholder="password" required=""> 
        
                <p class="contact"><label for="dob">Date Of Birth</label></p> 
                <input type="date" id="dob" name="dob" required=""> 
             
            <p class="contact"><label for="gender">Gender</label></p> 
            <select class="select-style gender" name="gender">
            <option value="select">i am..</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            
            </select><br><br>
            
            
            <input  class="buttom" name="submit" id="submit" tabindex="5" value="Sign me up!" type="submit"> 	 
   </form> 
</div>   
</div>
<script>
function validate() {
if (document.registrationform.password.value!=document.registrationform.repassword.value) {
alert("Passwords doeasn't match");
document.registrationform.password.focus();
return false;
}
}
</script>
<?php
include ('configuration/connection.php');
if (isset($_POST['submit']))
{
	$id=trim($_POST['id']);
	$name=trim($_POST['name']);
	$surname=trim($_POST['surname']);
	$email=trim($_POST['email']);
	$password=trim($_POST['password']);
	$gender=trim($_POST['gender']);
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
	if (strlen($password)==0)
		array_push($errors, "Please enter your password");
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        array_push($errors, "Please specify a valid email address");
	if (!(strcmp($gender, "male") || strcmp($gender, "female")))
        array_push($errors, "Please specify your gender");
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
		$password = addslashes($password);
        $hash_pass = md5($password.'@^%^TYGHys23233');
		$insert_person="insert into persons (person_name, person_surname, perons_id, date_of_birth, gender, email, password)
		values ('$name','$surname','$id','$dob','$gender','$email','$hash_pass')";
		mysql_query($insert_person) or die("error");
		?>
		<script type="text/javascript">
             window.location="thenk-reg.php";
        </script>
	<?php 
	} 
}
?>
