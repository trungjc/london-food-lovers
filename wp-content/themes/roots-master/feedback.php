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


<div class="panel">
    <div class="panel-body">
	<?php if($_SESSION['message']):?>
	
	 	  <div class="alert alert-danger"><?php echo $_SESSION['message']; unset($_SESSION['message']);?></div>
	 	  
	<?php else:?>
	    <form method="post" name="feedback" id="feedback" action="<?php echo home_url()?>/cart/feedback.php?id=<?php echo base64_encode($order_id);?>" enctype="multipart/form-data">
	    	 <?php if($error):?>
	    	 	 <div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><?php echo $error;?></div>
	    	 <?php endif;?>
	          <div class="form-horizontal">
                     <h2>Tell us about your experience with Food Lovers!</h2>
                     <hr/>
                                
                     <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Your full name:</label>
                        <div class="col-sm-4">
                        <input type="text" name="name" id="name" value="" class="form-control" />
                        </div>
                     </div>   
                    
                    <div class="form-group">
                        <label for="tour_name" class="col-sm-4 control-label">Which tour did you take?</label>
                        <div class="col-sm-6">
                        <input type="checkbox"   checked="checked" value="1" name="tour_name" /> Soho
                        </div>
                    </div>   
                      
                    <div class="form-group">
                        <label for="datepicker" class="col-sm-4 control-label">Tour Date:</label>
                        <div class="col-sm-4">
                       <input type="text"  class="form-control"  name="tour_date" id="datepicker" />
                        </div>
                    </div>  
                     
                    <div class="form-group">
                        <label for="rating" class="col-sm-4 control-label">Overall experience:</label>
                        <div class="col-sm-6">
                            <input class="star" type="radio" name="overall_rating" value="1" />
    	             		<input class="star" type="radio" name="overall_rating" value="2" />
    	             		<input class="star" type="radio" name="overall_rating" value="3" />
    	             		<input class="star" type="radio" name="overall_rating" value="4" />
    	             		<input class="star" checked="checked" type="radio" name="overall_rating" value="5" />
                        </div>
                    </div> 
	             
	             	<h3>How was your tour?</h3>
	             	<hr/>
	             	
                    <div class="form-group">
                        <label for="tour_highlight" class="col-sm-4 control-label">What was the highlight of the tour?</label>
                        <div class="col-sm-6">
                       <textarea rows="3" cols="60"  class="form-control"  name="tour_highlight" style="resize:none;"></textarea>
                        </div>
                    </div> 
                    
                    <h3>What was your favorite food experience?</h3>
                    <hr/>
                    
                    <div class="form-group">
                       <table width="90%" border="1" cellpadding="10" cellspacing="0" align="center">
                       		<tr>
                       			<td> <input type="checkbox" name="Pancakes" id="Pancakes" value="1" /> Pancakes</td>
                       			
                       			<td> <input type="checkbox" name="Chocolate" id="Chocolate" value="1" /> Chocolate</td>
                       			
                       			<td> <input type="checkbox" name="Ravioli" id="Ravioli" value="1" /> Ravioli</td>
                       			
                       			<td> <input type="checkbox" name="FishChips" id="FishChips" value="1" /> Fish&Chips</td>
                       			
                       			<td> <input type="checkbox" name="AleTasting" id="AleTasting" value="1" /> Ale Tasting</td>
                       		</tr>
                       		
                       		<tr>
                       			<td> <input type="checkbox" name="Samosa" id="Samosa" value="1" /> Samosa</td>
                       			
                       			<td> <input type="checkbox" name="Tacos" id="Tacos" value="1" /> Tacos</td>
                       			
                       			<td> <input type="checkbox" name="DimSum" id="DimSum" value="1" /> Dim Sum</td>
                       			
                       			<td> <input type="checkbox" name="TeaandDesserts" id="TeaandDesserts" value="1" /> Tea and Desserts</td>
                       			
                       			<td> <input type="checkbox" name="WineTasting" id="WineTasting" value="1" /> Wine-Tasting</td>
                       		</tr>
                       </table>
                    </div>
                    
                    <div class="form-group">
                        <label for="cultural_expertise" class="col-sm-4 control-label">Is there a food you wouldn’t try again?</label>
                        <div class="col-sm-6">
                        	<input type="checkbox" name="foodnottry" value="1" />
                        </div>
                   </div>
                   
                   <div class="form-group">     	
                        <label for="cultural_expertise" class="col-sm-4 control-label">Why:</label>
                        <div class="col-sm-6">
                        	<textarea rows="3" cols="40" name="foodwhy"></textarea>
                        </div> 	
                   </div>     
                   
                   <h3>How was the level of physical activity on the tour:</h3> <hr/>
                    <div class="form-group">
                        <div class="col-sm-6 col-md-offset-4">
                            <input type="checkbox" id="" name="too_little" value="1" /> Too little
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <div class="col-sm-6 col-md-offset-4">
                            <input type="checkbox" id="" name="just_right" value="1" /> Just right
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <div class="col-sm-6 col-md-offset-4">
                            <input type="checkbox" id="" name="too_much" value="1" /> Too much
                        </div>
                    </div>
                   
                    <br/>
                    <h3>How was your guide:</h3>
	             	<hr/>
	             	
                    <div class="form-group">
                        <label for="cultural_expertise" class="col-sm-4 control-label">Cultural and culinary expertise</label>
                        <div class="col-sm-6">
                                <input class="star" type="radio" name="cultural_expertise" value="1" />
                                <input class="star" type="radio" name="cultural_expertise" value="2" />
                                <input class="star" type="radio" name="cultural_expertise" value="3" />
                                <input class="star" type="radio" name="cultural_expertise" value="4" />
                                <input class="star" checked="checked" type="radio" name="cultural_expertise" value="5" />
                            </div>
                        </div> 
	           
                      	<div class="form-group">
                       	  <label for="comm_skills" class="col-sm-4 control-label">Communication skills</label>
                          <div class="col-sm-6">
                            <input class="star" type="radio" name="comm_skills" value="1" />
    	             		<input class="star" type="radio" name="comm_skills" value="2" />
    	             		<input class="star" type="radio" name="comm_skills" value="3" />
    	             		<input class="star" type="radio" name="comm_skills" value="4" />
    	             		<input class="star" checked="checked" type="radio" name="comm_skills" value="5" />
                        </div>
                       </div>
	             
                       <div class="form-group">
                        <label for="professionalism" class="col-sm-4 control-label">Professionalism</label>
                        <div class="col-sm-6">
                          <input class="star" type="radio" name="professionalism" value="1" />
	             		  <input class="star" type="radio" name="professionalism" value="2" />
	             		  <input class="star" type="radio" name="professionalism" value="3" />
	             		  <input class="star" type="radio" name="professionalism" value="4" />
	             		  <input class="star" checked="checked" type="radio" name="professionalism" value="5" />
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label for="org_abilities" class="col-sm-4 control-label">Organizational abilities</label>
                        <div class="col-sm-6">
                          <input class="star" type="radio" name="org_abilities" value="1" />
	             		  <input class="star" type="radio" name="org_abilities" value="2" />
	             		  <input class="star" type="radio" name="org_abilities" value="3" />
	             		  <input class="star" type="radio" name="org_abilities" value="4" />
	             		  <input class="star" checked="checked" type="radio" name="org_abilities" value="5" />
                        </div>
                    </div>
                     
                    <div class="form-group">
                        <label for="org_abilities" class="col-sm-4 control-label">X factor finalist chances</label>
                        <div class="col-sm-6">
                          <input class="star" type="radio" name="x_factor" value="1" />
	             		<input class="star" type="radio" name="x_factor" value="2" />
	             		<input class="star" type="radio" name="x_factor" value="3" />
	             		<input class="star" type="radio" name="x_factor" value="4" />
	             		<input class="star" checked="checked" type="radio" name="x_factor" value="5" />
                        </div>
                    </div>
                     
	                <h3>Do you have any other comments or suggestions for us?</h3> <hr/>
	                <div class="form-group">
                        <label for="comments" class="col-sm-4 control-label">Comments/ suggestions / unreserved praise:</label>
                        <div class="col-sm-6">
                         <textarea class="form-control" rows="3" cols="60" name="comments" style="resize:none;"></textarea>
                        </div>
                    </div>
                    <br/>
                    
                    <h2>THANKS for your Tour Feedback!</h2>
                    
                    <h3>We would also LOVE to know more about you!</h3>
                    
                    <br/> <br/>
                    
                    <div class="form-group">
                        <label for="org_abilities" class="col-sm-4 control-label">
                        	Did you take any photos during you tour? 
                        	<br/>
                        	We love to see our clients enjoying our tours, and we often feature great client photos in Newsletters and our Facebook, Twitter and Blog pages!
                        </label>
                        <div class="col-sm-6">
                         <input type="file" name="image" value="" />
                        </div>
                    </div>
                    <br/>
                    
                    <h3>May we use your comments on our website?</h3> <hr/>
                      <div class="form-group">
                        <div class="col-sm-6 col-md-offset-4">
                            <p> <input type="checkbox" id="" name="elegant_name" value="1" /> My name Does look elegant in print...</p>
                 			<p><input type="checkbox" id="" name="use_no" value="1" /> No</p>
                        </div>
                      </div>
                     <br/>
                     
                     <h3>If you answered Yes to the previous question, you can upload your photo here so we can add your review on our website</h3>
                       <div class="form-group">
                          <div class="col-sm-6 col-md-offset-4">
                          		<input type="checkbox" name="photocanuse" value="1" />
                          </div>
                       </div>   
                     
                     
                     <h3>May we contact you with info on future tours/ promotions?</h3><hr/>
                     <div class="form-group">
                        <div class="col-sm-6 col-md-offset-4">
                               <p>   <input type="checkbox" id="" name="contact_abs" value="1" /> Absolutely</p>
	             		 <p> <input type="checkbox" id="" name="contact_no" value="1" /> No</p>
	             		(We don't spam or sell/share info with Anyone)
                        </div>
                    </div>
                       <br/>
                       
                     <h3>Where did you hear about us?</h3><hr/>
                      <div class="form-group">
                        <div class="col-sm-4 col-md-offset-4">
                            <p> <input type="checkbox" id="" name="hear_us_referral" value="1" /> Referral </p>
	             		 	<p><input type="checkbox" id="" name="hear_us_google" value="1" /> Google  </p>
    	             		 <p><input type="checkbox" id="" name="hear_us_blog" value="1" /> Blog  </p>
    	             		 <p><input type="checkbox" id="" name="hear_us_trip_advisor" value="1" /> Trip advisor </p>
    	             		 <p><input type="checkbox" id="" name="hear_us_other" value="1" /> Other  </p>
    	             		 <p><input type="text"  class="form-control" name="hear_other" value="" /></p>
                            </div>
                        </div>
                       <br/>
                       
                    <h3>Friends that might be interested in Food Lovers tours...</h3><hr/>
	             	<div class="form-group">
                        <label for="email1" class="col-sm-4 control-label">Email 1:</label>
                        <div class="col-sm-4">
                         <input type="text" name="email1" class="form-control" id="email1" value="" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email1" class="col-sm-4 control-label">Email 2</label>
                        <div class="col-sm-4">
                         <input type="text" name="email2" class="form-control" id="email2" value="" />
                        </div>
                    </div>
                    <hr/>
	               <div class="form-group ">
                        <div class="col-sm-6 col-md-offset-4"><input type="submit" name="submitfeedback" class="btn btn-orange btn-lg" value="Submit Feedback" />
	               		</div>
                   </div>
	         
	         		<br />
	         		<div>
                     	<p> Thanks again and we hope to see you again very soon, </p>
                        <p> The Food Lovers Tours Team </p>
	         		</div>
	         </div>
	    </form>
   <?php endif;?>	    
</div>      	 	  
</div>