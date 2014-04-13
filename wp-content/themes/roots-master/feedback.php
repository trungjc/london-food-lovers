<?php

/* Template Name: Feedback */

$error = false;
$message = false;

$order_id = base64_decode($_GET['id']);
$query  = mysql_query("Select order_id from orders where feedback_request = 'Sent' and order_id = '$order_id'");
$result = mysql_fetch_assoc($query);
if(!$result){
    $url = home_url();
	header("Location:$url");
	exit;
}

if(@$_POST['submitfeedback'] AND strlen(@$_POST['comments']) > 50){
	$comments = mysql_real_escape_string($_POST['comments']);
	mysql_query("Insert into feedbacks SET order_id = '$order_id' , comments = '$comments' , dateofmodification = '".date('Y-m-d H:i:s')."'") or die(mysql_error());
	
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
	    <form method="post" name="feedback" id="feedback" action="">
	    	 <?php if($error):?>
	    	 	  <div style="color:red;" align="center"><?php echo $error;?></div>
	    	 <?php endif;?>
	    
	    	 <h2>Feedback form</h2>
	         <table align="center">
	             <tr>
	                 <td><h4>Write your feedback about tour</h4></td>
	             </tr>
	             
	             <tr>
	             	<td>
	             		<textarea rows="10" cols="60" name="comments" style="resize:none;"></textarea>
	             		<br />
	             		<b>At least 50 characters</b>
	             	</td>
	             </tr>
	             
	             <tr>
	                 <td>
	                 	<br />
	                 	<input type="submit" name="submitfeedback" value="Submit Feedback" />
	                 </td>
	             </tr>
	         </table>
	         <br /><br />
	    </form>
   <?php endif;?>	    
</div>      	 	  