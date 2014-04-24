<?php

mysql_query("delete from tmp_vouchers where id = '".session_id()."'");
    
$qty = (int)$_POST['qty'];

$tmp_vouchers = $wpdb->get_results("select codes from tmp_vouchers");
$tmp_vouchers_str = '';
foreach($tmp_vouchers as $code){
	if($code->codes){
	    $tmp_vouchers_str .= $code->codes . ",";
	}
}
if($tmp_vouchers_str){
	$tmp_vouchers_str = substr($tmp_vouchers_str,0,-1);
}

if($tmp_vouchers_str){
    $_query = "select code from vouchers where is_used = 0 and status = 1 and code not in ($tmp_vouchers_str) order by rand() ASC limit $qty";
}
else{
    $_query = "select code from vouchers where is_used = 0 and status = 1 order by rand() ASC limit $qty";
}

$code_query  = mysql_query($_query) or die(mysql_error() . "Query: $_query");
$codes = array();
$codestr = '';
while($code_result = mysql_fetch_assoc($code_query)){
    $codes[]  = $code_result['code'];
    $codestr .= '"'. $code_result['code'] .'",';
}
$codestr = substr($codestr,0,-1);

if(sizeof($codes) != $qty){
    $error_message = sizeof($codes) . " only gift vouchers are availables";
}

mysql_query("Insert into tmp_vouchers SET codes = '$codestr' , id = '".session_id()."'");

$_SESSION['cart']['codes'] = $codestr;
$_SESSION['cart']['qty'] = $qty;
    
?>
<div class="panel checkout-page">
    <div class="panel-body">
		<h3 class="title-img">Online Gift certificate</h3>
		
		<hr/>
		<?php if($error_message):?>
			<div style="color:red;"><?php echo $error_message;?></div>		
		<?php endif;?>
		
    	<form class="form-horizontal" method="post" role="form" id="checkout" action="<?php echo home_url();?>/cart/certificate.php" onsubmit="return validateForm();">
          <div class="form-group">
        	<label for="inputEmail3" class="col-sm-4 control-label">Date:</label>
        	<div class="col-sm-6">
        	    <?php echo date('d-M-Y',time());?>
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputEmail3" class="col-sm-4 control-label">Unit Price:</label>
        	<div class="col-sm-6">
        	   <?php echo "£80";?>
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputEmail3" class="col-sm-4 control-label">Qty:</label>
        	<div class="col-sm-6">
        	   <?php echo $qty;?>
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputEmail3" class="col-sm-4 control-label">Total:</label>
        	<div class="col-sm-6">
        	   <?php echo "£". 80*$qty;?>
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputEmail3" class="col-sm-4 control-label">Customer Name:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" name="customer_name" value="<?php echo @$_SESSION['data']['customer_name']?>" id="customer_name" placeholder="name">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputEmail3" class="col-sm-4 control-label">Email Adresss:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" id="customer_email" value="<?php echo @$_SESSION['data']['customer_email']?>" name="customer_email" placeholder="e-mail">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Customer Phone:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" id="customer_phone" value="<?php echo @$_SESSION['data']['customer_phone']?>" name="customer_phone" onchange="phoneFix();" placeholder="phone">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Address:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" id="customer_address" value="<?php echo @$_SESSION['data']['customer_address']?>" name="customer_address" placeholder="Address">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Country:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" id="customer_country" value="<?php echo @$_SESSION['data']['customer_country']?>" name="customer_country" placeholder="country">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">State:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" id="customer_region" value="<?php echo @$_SESSION['data']['customer_region']?>" name="customer_region" placeholder="state">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">City:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" id="customer_city"  value="<?php echo @$_SESSION['data']['customer_city']?>" name="customer_city" placeholder="city">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Zip:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" id="customer_postal_zip" value="<?php echo @$_SESSION['data']['customer_postal_zip']?>" name="customer_postal_zip" placeholder="zip">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Note:</label>
        	<div class="col-sm-6">
        	  <textarea class="form-control" name="note"><?php echo @$_SESSION['data']['note']?></textarea>
        	</div>
          </div>
          
          <h3 class="sub-title">Enter your credit card details</h3>
          <hr/>
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Card Type:</label>
        	<div class="col-sm-3">
        	  <select id="authorizenet_cc_type" name="cc_type" class="validate[required]">
                    <option value="">Select Your Card</option>
                
                    
                    <option value="VI">Visa</option>

                    
                    <option value="MC">MasterCard</option>
                    
                    <option value="DI">Discover</option>
    <option value="AE">American Express</option>
                    
        	  </select>
        	</div>

          <img class= "pull-left" src="http://londonfoodlovers.com/wp-content/uploads/2014/04/visa.png"><img class= "pull-left" src="http://londonfoodlovers.com/wp-content/uploads/2014/04/master-card.png"> <img class= "pull-left" src="http://londonfoodlovers.com/wp-content/uploads/2014/04/discover.png"> <img class= "pull-left" src="http://londonfoodlovers.com/wp-content/uploads/2014/04/amex.png">
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Card Number:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" autocomplete="off" name="card_number" id="card_number" placeholder="Card Number">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">CVV code :</label>
        	<div class="col-sm-8">
        	  <input autocomplete="off" style="width: 90px;display: inline-block" type="text" class="form-control" maxlength="3" name="cvv" id="cvv" placeholder="CVV code">
        	  <img width="40px"  src="<?php echo $host_path?>/images/fir.png" />
        	  <span>(Last three digits on the back of your card)</span>
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Expire Date:</label>
        	<div class="col-sm-6">
        	  <select class="select" name="month">
        		 <?php for($i=1;$i<=12;$i++): $k = $i; if($i < 10){ $k = '0'.$i; }?>
        		 		<option value="<?php echo $k;?>"><?php echo $k;?></option>
        		 <?php endfor;?>
        	  </select>
        	  <select class="select" name="year">
        		 <?php for($i=date('Y');$i<=date('Y')+10;$i++):?>
        		 		<option value="<?php echo $i;?>"><?php echo $i;?></option>
        		 <?php endfor;?>
        	  </select>
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Billing Address:</label>
        	<div class="col-sm-6">
        	  <input type="text" autocomplete="off" class="form-control" id="inputPassword3" id="bill_address" name="bill_address" placeholder="Billing Address">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Billing Country:</label>
        	<div class="col-sm-6">
        	  <input type="text" autocomplete="off" class="form-control" id="inputPassword3" id="bill_country" name="bill_country" placeholder="Billing Country">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Card Holders Name :</label>
        	<div class="col-sm-6">
        	  <input type="text" autocomplete="off" class="form-control" id="inputPassword3" id="holder_name" name="holder_name" placeholder="Card Holders Name">
        	</div>
          </div>
          
          <div class="form-group">
        	   <label for="inputPassword3" class="col-sm-12 control-label">
        	   <input type="checkbox" name="terms" id="terms" value="1"> I have read and agree to the terms and conditions</label>
          </div>
          
          <div class="form-group">
        	   <label for="inputPassword3" class="col-sm-12 control-label">
        	   <input type="checkbox" name="newsletter" id="newsletter" value="1"> Would you like subscribe to newsletter?</label>
          </div>
          
          <hr/>
          <div class="form-group">
        	<div class="col-sm-10">
        	  <button type="submit" class="btn btn-orange" name="placeOrder" value="placeOrder">Check Out</button>
        	</div>
          </div>
    </form>
 </div>
</div>    