 <div class="contact_form">
    <br>
	<h2 class="contact_form">Contact Form</h2>
	<br>
	<form class="contact_form" method="post">
		
		<p class="name">
			<input type="text" name="name" id="name" placeholder="John Doe" required=""/>
			<label for="name">Name</label>
		</p>
		<br>
		<p class="email">
			<input type="email" name="email" id="email" placeholder="mail@example.com" required="" />
			<label for="email">Email</label>
		</p>
		<br>
	    <br>
		<p class="text">
			<textarea name="text" placeholder="Write something to us" required=""/></textarea>
		</p>
		<br>
		<p class="contact_form1">
			<input type="submit" value="Send" name="send"/>
		</p>
	</form>
	</div>
<?php
if (isset($_POST['send']))
{
$name=trim($_POST['name']);
$email=trim($_POST['email']);
$message=trim($_POST['text']);
$from = 'From: YourWebsite.com'; 
$to = 'youremail@gmail.com'; 
$subject = 'Email Inquiry';
$body = "From: $name\n E-Mail: $email\n Message:\n $message";
if (mail($email, $subject, $message, $from))
{
	echo '<script>alert("Successfully send");</script>';
}
else
{
	echo '<script>alert("Oops! An error occurred. Try sending your message again.");</script>';
}
}
?>

