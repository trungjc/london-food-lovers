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
    $tour_date = date('m d, Y H:i A' , strtotime($date));

    $email_body = "<div align='right'><img src='$host_path/images/logo.png' alt='' /></div>";

    $email_body .= "<br /><div>";
    $email_body .= "Dear ".$data['customer_name']." <br /><br />";
    $email_body .= "Thank you for booking with London Food Lovers! Your order ID $order_id is Confirmed. <br /><br />
					Below, you will find your Pre-Paid Voucher with all of your tour details, however if you have any further questions, please feel free to contact us!";
    $email_body .= "My Pre-Paid Voucher <br />";
    $email_body .= "<h2>Order Details</h2>";
    $email_body .= "<table>
    					<tr>
    						<td colspan='2'>$tour_name</td>
    					</tr>
    					<tr>
    						<td>Lead Participant</td>
    						<td>".$data['customer_name']."</td>
    					</tr>
    					<tr>
    						<td>Number of Participants</td>
    						<td>Adults:".$_SESSION['cart']['adults'].", Kids:".$_SESSION['cart']['children']."</td>
    					</tr>
    					<tr>
    						<td>Tour Date</td>
    						<td>".$tour_date."</td>
    					</tr>
    					<tr>
    						<td>Departure Time</td>
    						<td>9:45am</td>
    					</tr>
    					<tr>
    						<td>Total Amount</td>
    						<td>".$_SESSION['cart']['total']."</td>
    					</tr>
    				</table>";
    $email_body .= "</div><br />";

    $email_body .= "<h2>Tour Meeting Place Location&Instructions:</h2>";
    $email_body .= "<p>Meeting Place Location: Golden Square, Soho, London W1F</p>";
    $email_body .= "<p>When to get there: Please arrive at least 15 minutes prior to the tour departure, as tours depart on time. We have delicious food prepared for you and we want to make sure we arrive when our tastings are fresh.</p>";
    $email_body .= "<p>How to get there:Golden Square is a 4 minute walk from Picadilly Circus! No matter how you decide to come, we can help you find us:</p>";
    $email_body .= "<p>From the tube: The closest tube stop is Picadilly Circus. Exit the tube and cross Regent street heading North towards the massive television screens (you will see a big Barclays bank under the screens). Once you cross the street and are standing in front of the Barclay’s, turn LEFT (on Glasshouse Street), walk 50 meters, and then turn RIGHT on Sherwood street. Walk straight on Sherwood Street, as this is the street that will take you directly to Golden Square. Please note that once you pass Brewer Street, the street name changes from Sherwood to Lower St. John Street, but keep going 100 meters more and you will find Golden Square, where we will be waiting for you at the entrance of square, opposite the Nordic Bakery!</p>";
    $email_body .= "<p>With a bus: There are many buses that go to Picadilly Circus. If you arrive by bus, get out at Picadilly Circus and head towards the massive television screens (you will see a big Barclays bank under the screens). Once you cross the street and are standing in front of the Barclay’s, turn LEFT (on Glasshouse Street), walk 50 meters, and then turn RIGHT on Sherwood street. Walk straight on Sherwood Street, as this is the street that will take you directly to Golden Square. Please note that once you pass Brewer Street, the street name changes from Sherwood to Lower St. John Street, but keep going 100 meters more and you will find Golden Square, where we will be waiting for you at the entrance of square, opposite the Nordic Bakery!</p>";
    $email_body .= "<p>With a Taxi: If you arrive by taxi, tell the driver Golden Square. We will be waiting for you at the entrance of the square, opposite the Nordic Bakery!</p>";
    $email_body .= "<p>Additional Instructions: The Soho Food Tour stops at nine different locations, where you will have over 10 food and drink tastings, serving enough food for a breakfast, lunch and snacks in between. For this reason, it’s important to COME HUNGRY! We recommend not eating breakfast, or if you absolutely have to - eat a REALLY light breakfast.</p>";
    $email_body .= "<p>We also recommend bringing a water bottle. It’s nice to keep yourself hydrated between tastings!</p>";
    $email_body .= "<p>London is known to rain, but a little rain won’t stop us from enjoying the delicious food and drink tastings. As the Londoners would say, Keep Calm and Bring An Umbrella – just in case!</p>";
    $email_body .= "<p>Remember, this is a walking tour, and in between our tastings, we will be exploring Soho on foot, so good walking shoes are a plus!</p>";
    $email_body .= "<p>Our tour finishes in a different location than the starting point. There are two tube stops nearby and many buses. At the end of our tour, we can help provide you with directions to get back to the starting point or help you get to the nearest Underground station or bus stop.</p>";
    $email_body .= "<p>Your booking receipt and printable voucher are available on-line at the following link: [Link Here]</p>";

    $email_body .= "<h3>Important !!</h3>";
    $email_body .= "<p>Please let us know if you have any dietary restrictions so that we can make the necessary substitutions to accommodate your needs. You MUST notify us at least 48 hours prior to your tour. We can find substitutions for Vegetarian, vegan, glucose-free and lactose-intolerant dietary restrictions, but we must be notified in advance. If you didn’t note your dietary needs on your online booking form, then please call to confirm your special dietary restrictions as soon as possible.</p>";
    $email_body .= "Tour Inclusions";
    $email_body .= "<ul><li>10 different Food Tastings</li><li>Wine and Ale Tastings</li><li>Expert Food Guide</li><li>London Food Lovers Food Guide to London</li></ul>";

    $email_body .= "<h3>Terms and conditions</h3>";
    $email_body .= "<p>Tickets are non-refundable and non-exchangeable. Please check carefully for tour dates and times before placing your order. For the Full Terms and Conditions, please click here </p>";
    
    $email_body .= "Best wishes, <br /> London Food Lovers";

    $from = "no-reply@londonfoodlovers.com";
    $fromName = "London Food Lovers";

    $phpmailer = new PHPMailer();
    $phpmailer->From = $from;
    $phpmailer->FromName = $fromName;
    $phpmailer->Subject  = "Order Confirmation - London Food Lovers";
    $phpmailer->MsgHTML($email_body);
    $phpmailer->AddAddress($data['customer_email'],$data['customer_name']);

    if($phpmailer->Send()){
        return 1;
    }
    else{
        return $phpmailer->ErrorInfo;
    }
}

function sendGiftCertificateEmail($data){
    global $host_path;
    
    $email_body = "<div align='right'><img src='$host_path/images/logo.png' alt='' /></div>";

    $email_body .= "<br /><div>";
    $email_body .= "Dear ".$data['customer_name']." <br /><br />";
    $email_body .= "Your gift certtificate order has been placed successfully.<br /><br />";
    $email_body .= "Your gift certtificate code is: FoodLovers2014 <br /><br />";
    $email_body .= "</div><br />";

    $email_body .= "Best wishes, <br /> London Food Lovers";

    $from = "no-reply@londonfoodlovers.com";
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

    $email_body = "<div align='right'><img src='$host_path/images/logo.png' alt='' /></div>";

    $email_body .= "<br /><div>";
    $email_body .= "Dear ".$data['customer_name']." <br /><br />";
    $email_body .= "Thanks for spending the day with London Food Lovers!<br/><br/>";
    $email_body .= "We hope you enjoyed your Soho Food Tour as much as we do. We enjoy receiving feedback about our clients experiences and we'd love to know what YOU thought...";
    $email_body .= "That said, please take 54 seconds to rate us !Click <a href='".$host_path."/feedback?id=".base64_encode($order_id)."'>this link</a> to start.";
    $email_body .= "</div><br />";

    $email_body .= "Best wishes, <br /> London Food Lovers";

    $from = "no-reply@londonfoodlovers.com";
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

function saveOrder($data , $order_id){
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
						dateofmodification = '".date('Y-m-d H:i:s')."'";

        mysql_query($order_query) or die(mysql_error());

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