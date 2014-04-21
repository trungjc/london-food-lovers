<?php

include_once '../wp-load.php';

include 'lib/foodloverstours.php';
include 'func.php';

$Booking = new Booking();
$categories = $Booking->query_categories();

mysql_query("truncate table categories");
foreach($categories as $category){
	mysql_query("Insert into categories SET category_id = '".$category['category_id']."' , name = '".$category['name']."'");
}


//check all orders which feedback request is not sent
//$query = "Select *, DATEDIFF(now(),tour_date) as diff from orders where feedback_request = 'Pending' having diff >= 1";
$query = "Select * from orders where feedback_request = 'Pending'";
$order_query  = mysql_query($query) or die(mysql_error());
while($order_result = mysql_fetch_assoc($order_query)){
	$res = sendFeedbackEmail($order_result['order_id'] , $order_result);
	if($res == 1){
		mysql_query("Update orders SET feedback_request = 'Sent' where order_id = '".$order_result['order_id']."'");
	}
}

echo "success";