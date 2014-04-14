<?php

include_once '../wp-load.php';

include_once 'func.php';
include 'lib/foodloverstours.php';

$Booking = new Booking();

$error = false;

if($_POST['placeOrder'] && $_SESSION['cart']){
    require_once 'authnet/AuthorizeNet.php';
    
    /*define("AUTHORIZENET_API_LOGIN_ID", "2hfYT85W");
    define("AUTHORIZENET_TRANSACTION_KEY", "23m2qL9tW7f43TUV");
    define("AUTHORIZENET_SANDBOX", true);*/
    
    define("AUTHORIZENET_API_LOGIN_ID", "4za9QX58");
    define("AUTHORIZENET_TRANSACTION_KEY", "27342GzTN5rjx7Un");
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
				'available' => 1,
				'discount_code' => $_SESSION['cart']['discount_code'],
			    'param'  => array(
					'adults' => $_SESSION['cart']['adults'],
					'children' => $_SESSION['cart']['children']
				)
			)
	);
	
	$item_data = $items[$_SESSION['cart']['item_id']];
	
    $auth->addLineItem($item_id , $item_data['name'], $item_data['rate']['summary']['details'], '1', $item_data['rate']['sub_total'], 'N');
    $auth->amount = $item_data['rate']['sub_total'];
    $_SESSION['cart']['total'] = $item_data['rate']['sub_total'];

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
    $auth->country  = 'GB';
    
    $auth->ship_to_first_name  = $_POST['customer_name'];
    $auth->ship_to_last_name   = '';
    $auth->ship_to_city   = $_POST['customer_city'];
    $auth->ship_to_state  = $_POST['customer_region'];
    $auth->ship_to_zip    = $_POST['customer_postal_zip'];
    $auth->ship_to_address  = $_POST['customer_address'];
    $auth->ship_to_country  = 'GB';

    // Set Invoice Number:
    $auth->invoice_num = time();
    $response = $auth->authorizeOnly();

    unset($_POST['card_number']);
    unset($_POST['expire_date']);
    unset($_POST['cvv']);

    if ($response->approved) {
		$item_id = $_SESSION['cart']['item_id'];
		$slip = $items[$item_id]['rate']['slip'];
		
    	$Booking->clear();
        $Booking->set($slip);
        
        $form  = $_POST;
        $order = $Booking->create($form);
        if($order){
        	$Booking->update_booking($order['booking']['id']);
        	
            $transaction_id = $response->transaction_id;
            if(!$transaction_id){
                $transaction_id = $response->invoice_number;
            }

            $auth->captureOnly();

            $data = array();
            $data = $_POST;
            $data['transaction_id'] = $transaction_id;
            $data['result'] = $order;
            $data['auth_response'] = $response;

            $order_id = $order['booking']['id'];
            //this function will send email, save order in database
            //function written in func.php file
            saveOrder($data , $order_id);
            $message = "<h6>Your Order has been placed successfully.</h6> Your transaction ID : $transaction_id";
            unset($_SESSION['cart']);
        }
        else{
            $error = true;
            //cancel the transaction
            $auth->void($response->transaction_id);
            $_SESSION['data'] = $_POST;

            $message = "<h6>Your Order is not placed, following error occured: </h6>";
            $message .= "{$order->request->status}. Please <a href='".home_url()."/checkout'>go back</a> and try again";
        }
    }
    else{
        $error = true;
        $_SESSION['data'] = $_POST;

        $message = "<h6>Your Order is not placed, following error occured: </h6>";
        $message .= "{$response->response_reason_text}. Please <a href='".home_url()."/checkout'>go back</a> and try again";
    }

    $_SESSION['message'] = $message;
    $url = home_url() . "/success";
    header("Location:$url");
    exit;
}
else{
    unset($_SESSION['message']);
    
    $url = home_url();
    header("Location:$url");
    exit;
}

?>