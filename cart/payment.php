<?php

include_once 'func.php';
include_once 'lib/foodloverstours.php';

include_once '/nas/wp/www/cluster-2188/foodloverstour/wp-load.php';

if(!session_id()){
	//session_start();
}

$Booking = new Booking();
$error = false;

if($_POST['placeOrder'] && $_SESSION['cart']){
	require_once 'authnet/AuthorizeNet.php';

	/*define("AUTHORIZENET_API_LOGIN_ID", "2hfYT85W");
	 define("AUTHORIZENET_TRANSACTION_KEY", "23m2qL9tW7f43TUV");
	 define("AUTHORIZENET_SANDBOX", true);*/

	define("AUTHORIZENET_API_LOGIN_ID", "4za9QX58");
	define("AUTHORIZENET_TRANSACTION_KEY", "43Hgk84e3C2gSDqH");
	define("AUTHORIZENET_SANDBOX", false);

	$auth = new AuthorizeNetAIM;

	$item_id = $_SESSION['cart']['item_id'];
	$date = $_SESSION['cart']['tour_year']."-".$_SESSION['cart']['tour_month']."-".$_SESSION['cart']['tour_date'];
	$tour_date = date('Y-m-d' , strtotime($date));

	$items = $Booking->query_inventory(
	array(
		'category_id' => $_SESSION['cart']['category_id'],
	    'start_date'  => $tour_date,
		'item_id' => (int)$_SESSION['cart']['item_id'],
		'discount_code' => $_SESSION['cart']['discount_code'],
		'available' => 1,
	    'param'  => array(
			'adults' => $_SESSION['cart']['adults'],
			'children' => $_SESSION['cart']['children']
	)
	)
	);

	$item_data = $items[$_SESSION['cart']['item_id']];
	$item_name = substr($item_data['name'],0,10);

	$item_id = $_SESSION['cart']['item_id'];
	$slip = $items[$item_id]['rate']['slip'];

	$Booking->clear();
	$Booking->set($slip);

	//$item_data['rate']['summary']['details']
	$desc = "Adults: ".$_SESSION['cart']['adults']."\n Kids: ".$_SESSION['cart']['children'];

	if((float)$_SESSION['total'] <= 0){
		$_SESSION['total'] = 1;
	}

	$auth->addLineItem("1" , $item_name , $desc , '1', $_SESSION['total'], 'N');
	$auth->amount = $_SESSION['total'];
	$_SESSION['cart']['total'] = $_SESSION['total'];

	$_POST['expire_date'] = $_POST['month'] ."-".$_POST['year'];
	$auth->card_num   = $_POST['card_number'];
	$auth->exp_date   = $_POST['expire_date'];
	$auth->card_code  = $_POST['cvv'];

	list($fname,$lname) = explode(" ",$_POST['holder_name']);

	$auth->email  = $_POST['customer_email'];
	$auth->first_name  = $fname;
	$auth->last_name   = $lname;
	$auth->address   = $_POST['customer_address'];
	$auth->city     = $_POST['customer_city'];
	$auth->state    = $_POST['customer_region'];
	$auth->zip      = $_POST['customer_postal_zip'];
	$auth->country  = $_POST['customer_country'];

	$auth->ship_to_first_name  = $_POST['customer_name'];
	$auth->ship_to_last_name   = '';
	$auth->ship_to_city   = $_POST['customer_city'];
	$auth->ship_to_state  = $_POST['customer_region'];
	$auth->ship_to_zip    = $_POST['customer_postal_zip'];
	$auth->ship_to_address  = $_POST['customer_address'];
	$auth->ship_to_country  = $_POST['bill_country'];

	// Set Invoice Number:
	$auth->invoice_num = time();
	$response = $auth->authorizeOnly();

	unset($_POST['card_number']);
	unset($_POST['expire_date']);
	unset($_POST['cvv']);

	$message = "Order details ". print_r($_SESSION,true) . " POST : ". print_r($_POST,true) . " Response: ".print_r($response,true);

	//@mail("vipin.garg12@gmail.com","payment error",$message);

	file_put_contents("paymentlogs.txt",$message,FILE_APPEND);

	if ($response->approved) {
		$foods = array('Vegetarian?'=>'vegetarian','No Pork?'=>'no_pork','No Fish?'=>'no_fish','No Alcohol?'=>'no_alcohol','Vegan?'=>'vegan','No Eggs?'=>'no_eggs','No Gluten?'=>'no_gluten','No Nuts?'=>'no_nuts','No Lactose?'=>'no_lactose','No Shellfish?'=>'no_shellfish');
		$foods_values = array_values($foods);

		$_POST['guestname'] = implode(" , ",$_POST['guestname']);

		$qty   = ($_SESSION['cart']['adults'] + $_SESSION['cart']['children']);
		foreach($_POST as $key => $value){
			if(in_array($key,$foods_values) and is_array($_POST[$key])){
				$keyval = array();
				for($j=1;$j<=$qty;$j++){
					if($_POST[$key][$j]){
						$keyval[] = 'Yes';
					}
					else{
						$keyval[] = 'No';
					}
				}

				$_POST[$key] = @implode(" , ", $keyval);
			}
		}

		$form  = $_POST;

		$order = $Booking->create($form);
		if($order){
			$Booking->update_booking($order['booking']['id']);

			$transaction_id = $response->transaction_id;
			if(!$transaction_id){
				$transaction_id = $response->invoice_number;
			}

			$auth->priorAuthCapture($response->transaction_id);

			$data = array();
			$data = $_POST;
			$data['transaction_id'] = $transaction_id;
			$data['result'] = $order;
			$data['auth_response'] = $response;

			$order_id = $order['booking']['id'];
			//this function will send email, save order in database
			//function written in func.php file
			saveOrder($data , $order_id , $transaction_id);
			$message = "<h3>Your Order has been placed successfully.</h3> <h3>Your transaction ID :</h3> $transaction_id AND Booking ID: ".$order['booking']['id'];
			unset($_SESSION['cart']);
			unset($_SESSION['data']);
		}
		else{
			$error = true;
			//cancel the transaction
			$auth->void($response->transaction_id);
			$_SESSION['data'] = $_POST;

			$message = "<h2>Your Order was not placed, following error occured: </h2>";
			$message .= "{$order->request->status}. Please <a href='".home_url()."/checkout'>go back</a> and try again";
		}
	}
	else{
		$error = true;
		$_SESSION['data'] = $_POST;

		$message = "<h2>Your Order is not placed, following error occured: </h2>";
		$message .= "{$response->response_reason_text}. Please <a href='".home_url()."/checkout'>go back</a> and try again";
	}

	$_SESSION['booking_message'] = $message;
	setcookie('booking_message',$message);
	
	if(!$error){
		$url = home_url() . "/order_result.php";
	}
	else{
		$url = home_url() . "/error.php";
	}
	header("Location:$url");
	exit;
}
else{
	//unset($_SESSION['booking_message']);

	$url = home_url();
	header("Location:$url");
	exit;
}

?>