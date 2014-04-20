<?php

include_once '../wp-load.php';
include_once 'phpmailer/class-phpmailer.php';

if($_POST['booknow'] && $_POST['firstname'] && $_POST['email']){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $comments = $_POST['comments'];
    $title    = $_POST['title'];
    $company  = $_POST['company'];

    $to = "info@londonfoodlovers.com";
    $from = 'no-reply@londonfoodlovers.com';
    $fromName = "FoodLoversTours";
    $pagename = urldecode($_POST['frompage']);

    $email_body = 'Hi Admin, <br /><br />';
    $email_body .= "New Corporate tour request information is <br />";
    $email_body .= "<table border='1' cellpadding='5' cellspacing='0'>
    					<tr>
    					     <td>First Name</td>
    					     <td>$firstname</td>
    					</tr>
    					<tr>
    					     <td>Last Name</td>
    					     <td>$lastname</td>
    					</tr>
    					<tr>
    					     <td>Title</td>
    					     <td>$title</td>
    					</tr>
    					<tr>
    					     <td>Company</td>
    					     <td>$company</td>
    					</tr>
    					<tr>
    					     <td>Email</td>
    					     <td>$email</td>
    					</tr>
    					<tr>
    					     <td>Phone</td>
    					     <td>$phone</td>
    					</tr>
    					<tr>
    					     <td>Comments</td>
    					     <td>$comments</td>
    					</tr>
    				</table>
    				<br />";
    
    $email_body .= "Regards, <br />";
    $email_body .= "London FoodLovers Team";

    $phpmailer = new PHPMailer();
    $phpmailer->From = $from;
    $phpmailer->FromName = $fromName;
    $phpmailer->Subject  = "Corporate - FoodLoversTours Request";
    $phpmailer->MsgHTML($email_body);
    $phpmailer->AddAddress($to);
    //$phpmailer->AddAddress("vipin.garg12@gmail.com");
    $phpmailer->Send();

    $url = home_url();
    echo "<script>alert('Your request is submitted. We will contact you shortly.');</script>";
    echo "<script>window.location.href='$url';</script>";
    exit;
}
else{
    $url = home_url();
    echo "<script>window.location.href='$url';</script>";
    exit;
}