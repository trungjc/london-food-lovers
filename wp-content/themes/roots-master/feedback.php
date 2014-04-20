<?php

/* Template Name: Feedback */
/*New*/
$error = false;
$message = false;

$order_id = base64_decode($_GET['id']);
//$order_id = $_GET['id'];

$query  = mysql_query("Select order_id , cart from orders where feedback_request = 'Sent' and order_id = '$order_id'");
$result = mysql_fetch_assoc($query);
if((!$result && !$_SESSION['message']) || !$order_id){
    $url = home_url();
	///header("Location:$url");
	echo "<script>window.location.href='$url';</script>";
	exit;
}

$cart = json_decode($result['cart'],true);

?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

<script src='<?php echo home_url();?>/js/jquery.MetaData.js' type="text/javascript" language="javascript"></script>
<script src='<?php echo home_url();?>/js/jquery.rating.js' type="text/javascript" language="javascript"></script>
<link href='<?php echo home_url();?>/js/jquery.rating.css' type="text/css" rel="stylesheet"/>

<script>
  jQuery(function() {
	  jQuery( "#datepicker" ).datepicker();
	  jQuery('input.star').rating();
  });
</script>

<div>
	<?php if($_SESSION['message']):?>
	 	  <div style="color:red;" align="center"><?php echo $_SESSION['message']; unset($_SESSION['message']);?></div>
	<?php else:?>
	    <form method="post" name="feedback" id="feedback" action="<?php echo home_url()?>/cart/feedback.php?id=<?php echo base64_encode($order_id);?>" enctype="multipart/form-data">
	    	 <?php if($error):?>
	    	 	  <div style="color:red;" align="center"><?php echo $error;?></div>
	    	 <?php endif;?>
	         
	         <br /><br />
	         
	         <table align="center" width="100%">
	         	 <tr>
             		<td>Your full name:</td>
             		<td>
             			<input type="text" name="name" id="name" value="" />
             		</td>
	             </tr>
	             
	             <tr>
             		<td>Which tour did you take?</td>
             		<td>
             			<input type="checkbox" checked="checked" value="1" name="tour_name" /> Soho
             		</td>
	             </tr>
	             
	             <tr>
             		<td>Tour Date:</td>
             		<td>
             			<input type="text" name="tour_date" id="datepicker" />
             		</td>
	             </tr>
	             
	             <tr>
	             	<td>Overall experience:</td>
	             	<td>	
	             		<input class="star" type="radio" name="rating" value="1" />
	             		<input class="star" type="radio" name="rating" value="2" />
	             		<input class="star" type="radio" name="rating" value="3" />
	             		<input class="star" type="radio" name="rating" value="4" />
	             		<input class="star" checked="checked" type="radio" name="overall_rating" value="5" />
	             	</td>
	             </tr>
	             
	             <tr>
             		<td>What was the highlight of the tour for you?</td>
             		<td>
             			<textarea rows="3" cols="60" name="tour_highlight" style="resize:none;"></textarea>
             		</td>
	             </tr>
	             
	             <tr>
	             	 <td colspan="2"><h3>Please tell us about your tour guide...</h3></td>
	             </tr>
	             
	             <tr>
	             	<td>Cultural and culinary expertise</td>
	             	<td>	
	             		<input class="star" type="radio" name="cultural_expertise" value="1" />
	             		<input class="star" type="radio" name="cultural_expertise" value="2" />
	             		<input class="star" type="radio" name="cultural_expertise" value="3" />
	             		<input class="star" type="radio" name="cultural_expertise" value="4" />
	             		<input class="star" checked="checked" type="radio" name="cultural_expertise" value="5" />
	             	</td>
	             </tr>
	             
	             <tr>
	             	<td>Communication skills</td>
	             	<td>	
	             		<input class="star" type="radio" name="comm_skills" value="1" />
	             		<input class="star" type="radio" name="comm_skills" value="2" />
	             		<input class="star" type="radio" name="comm_skills" value="3" />
	             		<input class="star" type="radio" name="comm_skills" value="4" />
	             		<input class="star" checked="checked" type="radio" name="comm_skills" value="5" />
	             	</td>
	             </tr>
	             
	             <tr>
	             	<td>Professionalism</td>
	             	<td>	
	             	    <input class="star" type="radio" name="professionalism" value="1" />
	             		<input class="star" type="radio" name="professionalism" value="2" />
	             		<input class="star" type="radio" name="professionalism" value="3" />
	             		<input class="star" type="radio" name="professionalism" value="4" />
	             		<input class="star" checked="checked" type="radio" name="professionalism" value="5" />
	             	</td>
	             </tr>
	             
	             <tr>
	             	<td>Organizational abilities</td>
	             	<td>	
	             		<input class="star" type="radio" name="org_abilities" value="1" />
	             		<input class="star" type="radio" name="org_abilities" value="2" />
	             		<input class="star" type="radio" name="org_abilities" value="3" />
	             		<input class="star" type="radio" name="org_abilities" value="4" />
	             		<input class="star" checked="checked" type="radio" name="org_abilities" value="5" />
	             	</td>
	             </tr>
	             
	             <tr>
	             	<td>X factor finalist chances</td>
	             	<td>	
	             		<input class="star" type="radio" name="x_factor" value="1" />
	             		<input class="star" type="radio" name="x_factor" value="2" />
	             		<input class="star" type="radio" name="x_factor" value="3" />
	             		<input class="star" type="radio" name="x_factor" value="4" />
	             		<input class="star" checked="checked" type="radio" name="x_factor" value="5" />
	             	</td>
	             </tr>
	             
	             <tr>
	             	<td><br /></br></td>
	             </tr>
	             
	             <tr>
	             	 <td>
	             	 	Tour Picture
	             	 </td>
	             	 <td>
	             	 	<input type="file" name="image" value="" />
	             	 </td>
	             </tr>
	             
	             <tr>
	             	 <td colspan="2"><h3>Your opinion of the level of physical activity on the tour:</h3></td>
	             </tr>
	             
	             <tr>
	             	<td colspan="2"><input type="checkbox" id="" name="too_little" value="1" /> Too little</td>
	             </tr>
	             
	             <tr>
	             	<td colspan="2"><input type="checkbox" id="" name="just_right" value="1" /> Just right</td>
	             </tr>
	             
	             <tr>
	             	<td colspan="2"><input type="checkbox" id="" name="feel_feet" value="1" /> I can still feel my feet</td>
	             </tr>
	             
	             <tr>
	             	<td colspan="2"><input type="checkbox" id="" name="last_stop" value="1" /> can't feel my feet but the last stop definitely helped</td>
	             </tr>
	             
	             <tr>
	             	<td colspan="2"><input type="checkbox" id="" name="walk_more" value="1" /> I-would-walk-a-thousand-miles-AND-I-would-walk-a-thousand-more..!!!</td>
	             </tr>
	             
	             <tr>
	             	 <td colspan="2"><h3>...and how about 2 more minutes to make it UNIQUE?</h3></td>
	             </tr>
	             
	             <tr>
             		<td>Comments/ suggestions / unreserved praise:</td>
             		<td>
             			<textarea rows="3" cols="60" name="comments" style="resize:none;"></textarea>
             		</td>
	             </tr>
	             
	             <tr>
	             	 <td colspan="2"><h3>May we use your comments on our website?</h3></td>
	             </tr>
	             
	             <tr>
	             	<td colspan="2">
	             		<input type="checkbox" id="" name="elegant_name" value="1" /> My name Does look elegant in print...
	             		<input type="checkbox" id="" name="use_no" value="1" /> No
	             	</td>
	             </tr>
	             
	             <tr>
	             	 <td colspan="2"><h3>May we contact you with info on future tours/ promotions?</h3></td>
	             </tr>
	             
	             <tr>
	             	<td colspan="2">
	             		<input type="checkbox" id="" name="contact_abs" value="1" /> Absolutely
	             		<input type="checkbox" id="" name="contact_no" value="1" /> No <br />
	             		(We don't spam or sell/share info with Anyone)
	             	</td>
	             </tr>
	             
	             <tr>
	             	 <td colspan="2"><h3>Where did you hear about us?</h3></td>
	             </tr>
	             
	             <tr>
	             	<td colspan="2">
	             		<input type="checkbox" id="" name="hear_us_referral" value="1" /> Referral
	             		<input type="checkbox" id="" name="hear_us_google" value="1" /> Google 
	             		<input type="checkbox" id="" name="hear_us_blog" value="1" /> Blog 
	             		<input type="checkbox" id="" name="hear_us_trip_advisor" value="1" /> Trip advisor 
	             		<input type="checkbox" id="" name="hear_us_other" value="1" /> Other 
	             		<input type="text" name="hear_other" value="" />
	             	</td>
	             </tr>
	             
	             <tr>
	             	 <td colspan="2"><h3>Friends that might be interested in Food Lovers tours...</h3></td>
	             </tr>
	             
	             <tr>
             		<td>Email 1:</td>
             		<td>
             			<input type="text" name="email1" id="email1" value="" />
             		</td>
	             </tr>
	             
	             <tr>
             		<td>Email 2:</td>
             		<td>
             			<input type="text" name="email2" id="email2" value="" />
             		</td>
	             </tr>
	             
	             <tr>
	                 <td colspan="2" align="center">
	                 	<br />
	                 	<input type="submit" name="submitfeedback" class="btn btn-orange btn-md" value="Submit Feedback" />
	                 </td>
	             </tr>
	         </table>
	         
	         <br /><br />
	         <div>
	         	 We hope to see you again very soon, <br /><br />

					Sarah and the rest of the team at Food Lovers Inc. 
	         </div>
	         <br /><br />
	    </form>
   <?php endif;?>	    
</div>      	 	  