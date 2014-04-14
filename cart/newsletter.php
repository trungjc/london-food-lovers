<?php

include_once '../wp-load.php';
include_once 'Mailchimp.php';

if($_POST['newslettersubmit']){
    $email = $_POST['email'];
    // add customer email to mailchimp list
    $mailchimp = new Mailchimp('554cd522f2f036339282af14cbeb9a6c-us3');
    $id = 'be2e10f35b';
    list($fname,) = explode("@",$email);
    try{
        $result = $mailchimp->lists->subscribe($id,array('email'=>$email),array('FNAME'=>$fname,'LNAME'=>''));
    }
    catch(Mailchimp_List_InvalidImport $e){
        //
    }
    catch(Exception $e2){

    }
}

$url = home_url();
header("Location:$url");
exit;