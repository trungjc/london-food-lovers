<?php

include_once 'phpmailer/class-phpmailer.php';
include_once 'Mailchimp.php';

function sendOrderEmail($data){
	$email_body = "Dear ".$data['customer_name']." <br /><br />";
	$email_body .= "Your order has been placed successfully. Here are the details:<br /><br />";

	$email_body .= "";
	$email_body .= "Best wishes, <br /> FoodLoversTours";

	$from = "no-reply@foodloverstours.com";
	$fromName = "FoodLoversTours";

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
	
	$email_body = "Dear ".$data['customer_name']." <br /><br />";
	
	$email_body .= "We want your some time to give feedback us on currently ordered tour. <br /><br/>";
	$email_body .= "Follow the below link to complete the feedback <br/>";
	$email_body .= "<a href='".$host_path."/feedback?id=".base64_encode($order_id)."'>click here</a><br/><br/>";
	
	$email_body .= "Best wishes, <br /> FoodLoversTours";

	$from = "no-reply@foodloverstours.com";
	$fromName = "FoodLoversTours";

	$phpmailer = new PHPMailer();
	$phpmailer->From = $from;
	$phpmailer->FromName = $fromName;
	$phpmailer->Subject  = "Feedback requested - FoodLoversTours";
	$phpmailer->MsgHTML($email_body);
	$phpmailer->AddAddress($data['email'],$data['customer_name']);

	if($phpmailer->Send()){
		return 1;
	}
	else{
		return 0;
	}
}

function saveOrder($data , $order_id){
	$orderExist = mysql_query("select * from orders where order_id = '$order_id'");
	if(mysql_numrows($orderExist) > 0){
		return -1;
	}
	else{
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
						dateofmodification = '".date('Y-m-d H:i:s')."'";

		mysql_query($order_query) or die(mysql_error());

		//send email to cusotmer
		sendOrderEmail($data);

		// add customer email to mailchimp list
		$mailchimp = new Mailchimp('97cdba3afa7a992c92242f5c9000cf8b-us8');
		$id = 'a40b80792e';
		list($fname,$lname) = explode(" ",$data['customer_name']);
		try{
		    $result = $mailchimp->lists->subscribe($id,array('email'=>$data['customer_email']),array('FNAME'=>$fname,'LNAME'=>$lname));
		}
		catch(Mailchimp_List_InvalidImport $e){
		    //
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