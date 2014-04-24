<?php

include_once '../wp-load.php';
include_once 'func.php';

$error = false;

if($_POST['placeOrder']){
    require_once 'authnet/AuthorizeNet.php';

    /*define("AUTHORIZENET_API_LOGIN_ID", "2hfYT85W");
     define("AUTHORIZENET_TRANSACTION_KEY", "23m2qL9tW7f43TUV");
     define("AUTHORIZENET_SANDBOX", true);*/

    define("AUTHORIZENET_API_LOGIN_ID", "4za9QX58");
    define("AUTHORIZENET_TRANSACTION_KEY", "27342GzTN5rjx7Un");
    define("AUTHORIZENET_SANDBOX", false);

    $auth = new AuthorizeNetAIM;

    $auth->addLineItem(1 , "Gift Certificate", "Gift Certificate", $_SESSION['cart']['qty'] , 80, 'N');
    $auth->amount = $_SESSION['cart']['qty']*80;
    $_SESSION['cart']['total'] = $_SESSION['cart']['qty']*80;

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
        $transaction_id = $response->transaction_id;
        if(!$transaction_id){
            $transaction_id = $response->invoice_number;
        }

        $auth->captureOnly();

        $data = array();
        $data = $_POST;
        $data['transaction_id'] = $transaction_id;
        $data['auth_response'] = $response;

        //this function will send email, save order in database
        //function written in func.php file
        saveCertificate($data , $transaction_id);
        $message = "<h6>Your Order has been placed successfully.</h6> Your transaction ID : $transaction_id";
        unset($_SESSION['cart']);
        unset($_SESSION['data']);
    }
    else{
        $error = true;
        $_SESSION['data'] = $_POST;

        $message = "<h6>Your Order is not placed, following error occured: </h6>";
        $message .= "{$response->response_reason_text}. Please <a href='".home_url()."/checkout-certificate'>go back</a> and try again";
    }

    $_SESSION['message'] = $message;
    $url = home_url() . "/certificate-success";
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