
<?php
$q=intval($_GET['q']);
include ('../configuration/connection.php');
$sql="select p1.perons_id as person_id, concat(p1.person_name,' ',p1.person_surname) as person, b.check_status as status, b.total_price as total, 
p.pay_type as type, p.card_number as card, p.unic_number as unic, p.payment_amount as amount 
from flights f, books b, persons p1, payments p where f.flight_id=b.flight_id and b.book_id=p.book_id and p.person_id=p1.person_id 
and f.flight_id=$q";
$result=mysql_query($sql);
if (mysql_num_rows($result)==0)
{
	echo '<h1 style="text-align: center">There is no payment information</h1>';
}
else
{   echo '<div class="CSSTableGenerator">';
	echo '<table><tr><td>Person ID</td><td>Person</td><td>Status</td><td>Total Price</td><td>Pay Type</td><td>Card Number</td><td>Unique Number</td><td>Payment Amount</td></tr>';
	while ($row=mysql_fetch_array($result))
	{
		echo '<tr><td>'.$row["person_id"].'</td><td>'.$row["person"].'</td><td>'.$row["status"].'</td><td>'.$row["total"].'</td><td>'.$row["type"].'</td>
		<td>'.$row["card"].'</td><td>'.$row["unic"].'</td><td>'.$row["amount"].'</td></tr>';
	}
	
	echo '</table></div>';
	
}
?>