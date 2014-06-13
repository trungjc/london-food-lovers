<?php

//include_once '../wp-load.php';
include_once '/nas/wp/www/cluster-2188/foodloverstour/wp-load.php';

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

    if($_FILES['image']){
        $image_name = $order_id."_".time().".jpg";
        $save_path  = $_SERVER['DOCUMENT_ROOT'] . "/cart/images/".$image_name;
        @move_uploaded_file($_FILES['image']['tmp_name'],$save_path);
    }
    else{
        $image_name = '';
    }

    if($_FILES['image1']){
        $image_name1 = $order_id."_".time()."_1.jpg";
        $save_path  = $_SERVER['DOCUMENT_ROOT'] . "/cart/images/".$image_name1;
        @move_uploaded_file($_FILES['image1']['tmp_name'],$save_path);
    }

    if($_FILES['image2']){
        $image_name2 = $order_id."_".time()."_1.jpg";
        $save_path  = $_SERVER['DOCUMENT_ROOT'] . "/cart/images/".$image_name2;
        @move_uploaded_file($_FILES['image2']['tmp_name'],$save_path);
    }

    if($_FILES['image3']){
        $image_name3 = $order_id."_".time()."_1.jpg";
        $save_path  = $_SERVER['DOCUMENT_ROOT'] . "/cart/images/".$image_name3;
        @move_uploaded_file($_FILES['image3']['tmp_name'],$save_path);
    }

    $data = $_POST;
    unset($data['submitfeedback']);
    unset($data['rating']);
    array_walk($data , "filterstr");

    $extra_str = '';
    foreach($data as $k => $v) {
        $extra_str .= ($extra_str ? ", " : "") . $k . "='" . $v . "'";
    }

    mysql_query("Insert into feedbacks SET $extra_str , order_id = '$order_id' , category_id = '$category_id' , city = '$city' , state = '$state' , image = '$image_name' , image1 = '$image_name1' , image2 = '$image_name2' , image3 = '$image_name3' , dateofmodification = '".date('Y-m-d H:i:s')."'") or die(mysql_error());

    mysql_query("Update orders SET feedback_request = 'Completed' where order_id = '$order_id'") or die(mysql_error());

    $_SESSION['message'] = "Your feedback has beed saved. Thanks for feedback.";
    
    include_once 'phpmailer/class-phpmailer.php';
    
    $phpmailer = new PHPMailer();
    $phpmailer->From = "no-reply@londonfoodlovers.com";
    $phpmailer->FromName = "FoodLoversTours Team";;
    $phpmailer->Subject  = "Feedback received - FoodLoversTours";
    $email_body = "Hi Admin, <br /> Customer $name has sent the feedback. <br /> Thanks, <br /> LondonFoodLovers Team";
    $phpmailer->MsgHTML($email_body);
    $phpmailer->AddAddress("info@londonfoodlovers.com");
    $phpmailer->Send();

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