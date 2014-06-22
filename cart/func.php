<?php

$host_path = "https://www.londonfoodlovers.com/";

include_once 'phpmailer/class-phpmailer.php';
include_once 'Mailchimp.php';

function sendOrderEmail($data , $order_id){
	global $host_path;

	$tour_query = mysql_query("select name from categories where category_id = '".$_SESSION['cart']['category_id']."'");
	$tour_data  = mysql_fetch_array($tour_query);
	$tour_name  = $tour_data['name'];

	$date = $_SESSION['cart']['tour_year']."-".$_SESSION['cart']['tour_month']."-".$_SESSION['cart']['tour_date'];
	$tour_date = date('d M Y, H:i A' , strtotime($date));

	$email_body = file_get_contents("email/TourDetails.html");
	$params = array("{name}","{order_id}","{participants}","{tour_date}","{tour_amount}");
	$values = array($data['customer_name'],$order_id,"Adults:".$_SESSION['cart']['adults'].", Kids:".$_SESSION['cart']['children'],$tour_date,$_SESSION['cart']['total']);

	$email_body = str_ireplace($params,$values,$email_body);

	$from = "info@londonfoodlovers.com";
	$fromName = "London Food Lovers";

	$phpmailer = new PHPMailer();
	$phpmailer->From = $from;
	$phpmailer->FromName = $fromName;
	$phpmailer->Subject  = "Order Confirmation - London Food Lovers";
	$phpmailer->MsgHTML($email_body);
	$phpmailer->AddAddress($data['customer_email'],$data['customer_name']);

	if($phpmailer->Send()){
		$phpmailer->ClearAddresses();
		 
		// send email to admin also
		$phpmailer->AddAddress($from,$fromName);
		$phpmailer->AddAddress("doriharpaz@gmail.com",$fromName);
		$phpmailer->Send();
		 
		return 1;
	}
	else{
		return $phpmailer->ErrorInfo;
	}
}

function sendGiftCertificateEmail($data){
	global $host_path;

	$email_body = file_get_contents("email/GiftCertificate.html");
	$params = array("{name}","{gift_codes}");
	$values = array($data['customer_name'],$_SESSION['cart']['codes']);

	$email_body = str_ireplace($params,$values,$email_body);

	$from = "info@londonfoodlovers.com";
	$fromName = "London Food Lovers";

	$phpmailer = new PHPMailer();
	$phpmailer->From = $from;
	$phpmailer->FromName = $fromName;
	$phpmailer->Subject  = "Order Confirmation - FoodLoversTours";
	$phpmailer->MsgHTML($email_body);
	$phpmailer->AddAddress($data['customer_email'],$data['customer_name']);

	if($phpmailer->Send()){
		return 1;
	}
	else{
		return $phpmailer->ErrorInfo;
	}
}

function sendFeedbackEmail($order_id , $data){
	global $host_path;

	$url = $host_path."/feedback?id=".base64_encode($order_id);

	$email_body = file_get_contents("email/Feedback.html");
	$params = array("{name}","{url}");
	$values = array($data['customer_name'],$url);
	$email_body = str_ireplace($params,$values,$email_body);

	$from = "info@londonfoodlovers.com";
	$fromName = "London Food Lovers";

	$phpmailer = new PHPMailer();
	$phpmailer->From = $from;
	$phpmailer->FromName = $fromName;
	$phpmailer->Subject  = "Feedback requested - London Food Lovers";
	$phpmailer->MsgHTML($email_body);
	$phpmailer->AddAddress($data['email'],$data['customer_name']);

	if($phpmailer->Send()){
		return 1;
	}
	else{
		return 0;
	}
}

function saveOrder($data , $order_id , $transaction_id){
	$orderExist = mysql_query("select * from orders where order_id = '$order_id'");
	if(mysql_numrows($orderExist) > 0){
		return -1;
	}
	else{
		$date = $_SESSION['cart']['tour_year']."-".$_SESSION['cart']['tour_month']."-".$_SESSION['cart']['tour_date'];
		$tour_date = date('Y-m-d' , strtotime($date));

		$order_query = "Insert into orders SET order_id = '$order_id' ,
						tour_id = '".$_SESSION['cart']['item_id']."' , 
						total = '".$_SESSION['cart']['total']."',
						adults = '".$_SESSION['cart']['adults']."' , 
						child = '".$_SESSION['cart']['children']."',
						customer_name = '".mysql_real_escape_string($data['customer_name'])."' , 
						email = '".mysql_real_escape_string($data['customer_email'])."' , 
						address = '".mysql_real_escape_string($data['customer_address'])."' , 
						city = '".mysql_real_escape_string($data['customer_city'])."',
						state = '".mysql_real_escape_string($data['customer_region'])."' , 
						country = '".mysql_real_escape_string($data['customer_country'])."',
						zip = '".mysql_real_escape_string($data['customer_postal_zip'])."',
						phone = '".mysql_real_escape_string($data['customer_phone'])."',
						cart  = '".mysql_real_escape_string(json_encode($_SESSION))."',
						order_date  = '".mysql_real_escape_string(date('Y-m-d H:i:s'))."',
						tour_date  = '".mysql_real_escape_string($tour_date)."',
						session_id  = '".session_id()."',
						transaction_id  = '".$transaction_id."',
						dateofmodification = '".date('Y-m-d H:i:s')."'";

		mysql_query($order_query) or die(mysql_error());

		//send email to cusotmer
		sendOrderEmail($data , $order_id);

		if($data['newsletter']){
			// add customer email to mailchimp list
			$mailchimp = new Mailchimp('554cd522f2f036339282af14cbeb9a6c-us3');
			$id = 'be2e10f35b';
			list($fname,$lname) = explode(" ",$data['customer_name']);
			try{
				$result = $mailchimp->lists->subscribe($id,array('email'=>$data['customer_email']),array('FNAME'=>$fname,'LNAME'=>$lname));
			}
			catch(Exception $e){
				//
			}
		}
	}
}


function saveCertificate($data , $transaction_id){
	$orderExist = mysql_query("select * from gift_certificates where transaction_id = '$transaction_id'");
	if(mysql_numrows($orderExist) > 0){
		return -1;
	}
	else{
		$order_query = "Insert into gift_certificates SET transaction_id = '$transaction_id' ,
						total = '".$_SESSION['cart']['total']."',
						customer_name = '".mysql_real_escape_string($data['customer_name'])."' , 
						email = '".mysql_real_escape_string($data['customer_email'])."' , 
						address = '".mysql_real_escape_string($data['customer_address'])."' , 
						city = '".mysql_real_escape_string($data['customer_city'])."',
						state = '".mysql_real_escape_string($data['customer_region'])."' , 
						country = '".mysql_real_escape_string($data['customer_country'])."',
						zip = '".mysql_real_escape_string($data['customer_postal_zip'])."',
						phone = '".mysql_real_escape_string($data['customer_phone'])."',
						cart  = '".mysql_real_escape_string(json_encode($_SESSION))."',
						order_date  = '".mysql_real_escape_string(date('Y-m-d H:i:s'))."',
						vouchers 	= '".$_SESSION['cart']['codes']."',
						dateofmodification = '".date('Y-m-d H:i:s')."'";

		mysql_query($order_query) or die(mysql_error());

		mysql_query("Update vouchers SET is_used = 1 where code in (".$_SESSION['cart']['codes'].")");

		mysql_query("delete from tmp_vouchers where id = '".session_id()."'");

		//send email to cusotmer
		sendGiftCertificateEmail($data);

		if($data['newsletter']){
			// add customer email to mailchimp list
			$mailchimp = new Mailchimp('554cd522f2f036339282af14cbeb9a6c-us3');
			$id = 'be2e10f35b';
			list($fname,$lname) = explode(" ",$data['customer_name']);
			try{
				$result = $mailchimp->lists->subscribe($id,array('email'=>$data['customer_email']),array('FNAME'=>$fname,'LNAME'=>$lname));
			}
			catch(Exception $e){
				//
			}
		}
	}
}

function uniqueCode($size=6){
	$validchars = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
	@mt_srand ((double) microtime() * 1000000);
	$code = '';
	for ($i = 0; $i < $size; $i++){
		@$index = @mt_rand(0, count($validchars));
		if(!$index){
			$index=0;
		}
		$code .= @$validchars[$index];
	}
	return $code;
}