<?php

include_once '../wp-load.php';

//$order_id = $_GET['id'];
$order_id = base64_decode($_GET['id']);

$query  = mysql_query("Select order_id , cart from orders where feedback_request = 'Sent' and order_id = '$order_id'");
$result = mysql_fetch_assoc($query);
if(!$result){
    $url = home_url();
	header("Location:$url");
	exit;
}

$cart = json_decode($result['cart'],true);

if(@$_POST['submitfeedback']){
    $category_id = (int)$cart['cart']['category_id'];
    $name  = mysql_real_escape_string($cart['data']['customer_name']);
    $city  = mysql_real_escape_string($cart['data']['customer_city']);
    $state = mysql_real_escape_string($cart['data']['customer_region']);
    
	$image_name = $order_id."_".time().".jpg";
	$save_path  = $_SERVER['DOCUMENT_ROOT'] . "/cart/images/".$image_name;
	//$save_path  = $_SERVER['DOCUMENT_ROOT'] . "/LondonLovers/foodloverstour/cart/images/".$image_name;
	move_uploaded_file($_FILES['image']['tmp_name'],$save_path);
	
	$data = $_POST;
	unset($data['submitfeedback']);
	unset($data['rating']);
	array_walk($data , "filterstr");
	
    $extra_str = '';
	foreach($data as $k => $v) {
	    $extra_str .= ($extra_str ? ", " : "") . $k . "='" . $v . "'";
	}
	
	mysql_query("Insert into feedbacks SET $extra_str , order_id = '$order_id' , category_id = '$category_id' , city = '$city' , state = '$state' , image = '$image_name' , dateofmodification = '".date('Y-m-d H:i:s')."'") or die(mysql_error());
	
	mysql_query("Update orders SET feedback_request = 'Completed' where order_id = '$order_id'") or die(mysql_error());
	
	$_SESSION['message'] = "Your feedback has beed saved. Thanks for feedback.";
	
	$url = home_url()."/feedback?id=".base64_encode($order_id);
	header("Location:$url");
	exit;
}
else{
    $url = home_url();
	header("Location:$url");
	exit;
}

function filterstr(&$item1, $key){
	if(is_array($item1)){
		$item1 = implode(",",$item1);
		$item1 = mysql_real_escape_string($item1);
	}
	else{
		$item1 = mysql_real_escape_string($item1);
	}
}