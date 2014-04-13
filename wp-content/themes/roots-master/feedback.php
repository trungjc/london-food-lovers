<?php

/* Template Name: Feedback */

$error = false;
$message = false;

$order_id = base64_decode($_GET['id']);
$query  = mysql_query("Select order_id , cart from orders where feedback_request = 'Sent' and order_id = '$order_id'");
$result = mysql_fetch_assoc($query);
if(!$result){
    $url = home_url();
	header("Location:$url");
	exit;
}

if(@$_POST['submitfeedback'] AND strlen(@$_POST['comments']) > 50){
    $cart = json_decode($result['cart'],true);
    
    $category_id = (int)$cart['cart']['category_id'];
    $name  = mysql_real_escape_string($cart['cart']['customer_name']);
    $email = mysql_real_escape_string($cart['data']['customer_email']);
    $city  = mysql_real_escape_string($cart['data']['customer_city']);
    $state = mysql_real_escape_string($cart['data']['customer_region']);
    
	$comments = mysql_real_escape_string($_POST['comments']);
	$rating = mysql_real_escape_string($_POST['rating']);
	
	$image_name = $order_id."_".time().".jpg";
	$save_path  = $_SERVER['DOCUMENT_ROOT'] . "/cart/images/".$image_name;
	//$save_path  = $_SERVER['DOCUMENT_ROOT'] . "/LondonLovers/foodloverstour/cart/images/".$image_name;
	move_uploaded_file($_FILES['uploadpic']['tmp_name'],$save_path);
	
	mysql_query("Insert into feedbacks SET order_id = '$order_id' , category_id = '$category_id' , comments = '$comments' ,
				 name = '$name' , email = '$email' , city = '$city' , state = '$state' , rating = '$rating' ,
				 image = '$image_name' , dateofmodification = '".date('Y-m-d H:i:s')."'") or die(mysql_error());
	
	mysql_query("Update orders SET feedback_request = 'Completed' where order_id = '$order_id'") or die(mysql_error());
	
	$message = "Your feedback has beed saved. Thanks for feedback.";
}
elseif(@$_POST['submitfeedback'] AND strlen(@$_POST['comments']) < 50){
	$error = "Please enter comments at least in 50 characters";
}

?>
<div align="center">
	<?php if($message):?>
	 	  <div style="color:red;" align="center"><?php echo $message;?></div>
	<?php else:?>
	    <form method="post" name="feedback" id="feedback" action="" enctype="multipart/form-data">
	    	 <?php if($error):?>
	    	 	  <div style="color:red;" align="center"><?php echo $error;?></div>
	    	 <?php endif;?>
	    
	         <table align="center" width="100%">
	             <tr>
	                 <td colspan="2" align="center"><h4>Write your feedback about tour</h4></td>
	             </tr>
	             
	             <tr>
             		<td>Comments</td>
             		<td>
             			<textarea rows="10" cols="60" name="comments" style="resize:none;"></textarea>
             			<br />
             			<b>At least 50 characters</b>
             			<br /><br />
             		</td>
	             </tr>
	             
	             <tr>
	             	<td width="200px;">Upload Picture</td>
	             	<td>
	             		<input type="file" name="uploadpic" value="" />
	             		<br />
	             	</td>
	             </tr>
	             
	             <tr>
	             	<td>
	             		Rating
	             	</td>
	             	<td>	
	             		1 <input type="radio" name="rating" value="1" />
	             		2 <input type="radio" name="rating" value="2" />
	             		3 <input type="radio" name="rating" value="3" />
	             		4 <input type="radio" name="rating" value="4" />
	             		5 <input checked="checked" type="radio" name="rating" value="5" />
	             	</td>
	             </tr>
	             
	             <tr>
	                 <td colspan="2" align="center">
	                 	<br />
	                 	<input type="submit" name="submitfeedback" value="Submit Feedback" />
	                 </td>
	             </tr>
	         </table>
	         <br /><br />
	    </form>
   <?php endif;?>	    
</div>      	 	  