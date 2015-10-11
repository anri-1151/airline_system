<?php
$q=intval($_GET['q']);
include ('../configuration/connection.php');
$sql="select plain_name as plane, p.plain_id as plain_id, departure_city as dep_city, arrival_city as arr_city, departure_time as dep_time, arrival_time as arr_time,
class_name as class, seats, adult_price, child_price from flights f, plains p  where flight_id=$q and p.plain_id=f.plain_id";
$result=mysql_query($sql) or die("error");
$row=mysql_fetch_array($result);
$plain_sql="select plain_id, plain_name from plains";
$result_plain=mysql_query($plain_sql) or die("error");
?>
<form name="registrationform" id="form_register" method="post" action="update_flight.php"> 
			<p class="contact"><label for="plain">Plain</label></p> 
			<select class="select-style gender" name="plain">
            <option value="<?php echo $row['plain_id']; ?>"><?php echo $row['plane']; ?></option>
			<?php
			while ($row_plain=mysql_fetch_array($result_plain))
			echo '<option value="'.$row_plain['plain_id'].'">'.$row_plain['plain_name'].'</option>';
			?>
            </select>
<p class="contact"><label for="dep_city"><br>Departure City</label></p> 
    			<input id="dep_city" name="dep_city" value="<?php echo $row['dep_city'] ?>" required="" tabindex="1" type="text"> 
				<p class="contact"><label for="arr_city">Arrival City</label></p> 
    			<input id="arr_city" name="arr_city" value="<?php echo $row['arr_city'] ?>" required="" tabindex="1" type="text"> 
				<p class="contact"><label for="dep_time">Departure time</label></p> 
    			<input id="dep_time" name="dep_time" value="<?php echo $row['dep_time'] ?>" required="" tabindex="1" type="datetime"> 
				<p class="contact"><label for="arr_time">Arrival time</label></p> 
    			<input id="arr_time" name="arr_time" value="<?php echo $row['arr_time'] ?>" required="" tabindex="1" type="datetime"> 
				<p class="contact"><label for="plain">Class</label></p> 
                <select class="select-style gender" name="class">
                <option value="<?php echo $row['class'] ?>"><?php echo $row['class']?></option>
				<option value="econom">econom</option>
				<option value="business">business</option>
				</select>
                 <p class="contact"><label for="seats"><br>Seats</label></p> 
    			<input id="seats" name="seats" value="<?php echo $row['seats'] ?>" required="" tabindex="1" type="text"> 
				<p class="contact"><label for="ad_price">Adult Price</label></p> 
    			<input id="ad_price" name="ad_price" value="<?php echo $row['adult_price'] ?>" required="" tabindex="1" type="text"> 
				<p class="contact"><label for="ch_price">Child Price</label></p> 
    			<input id="ch_price" name="ch_price" value="<?php echo $row['child_price'] ?>" required="" tabindex="1" type="text"> 
				<input type="hidden" name="id" value="<?php echo $q; ?>">
				<br>
				<input  class="buttom" name="update" id="update" tabindex="5" value="Update" type="submit"> 	 
   </form> 