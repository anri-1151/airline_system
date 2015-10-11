<?php
$q=intval($_GET['q']);
include ('../configuration/connection.php');
$sql="select plain_id, plain_name from plains where plain_id=$q";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
?>
<form name="registrationform" id="form_register" method="post" action="update_plain.php"> 
<input type="hidden" name="id" value="<?php echo $q; ?>">
<p class="contact"><label for="plain"><br>Plain</label></p> 
 <input id="plain" name="plain"  required="" tabindex="1" type="text" value="<?php echo $row['plain_name']; ?>"> 
<br>
<input  class="buttom" name="update" id="update" tabindex="5" value="Update" type="submit"> 
</form>


