<?php

$Booking = new Booking();
$categories = $Booking->query_categories();

if(!$_SESSION['cart']) {
    $url = home_url();
    header("Location:$url");
	exit;
}

if(!$_SESSION['data']) {
    $url = home_url()."/checkout/";
    header("Location:$url");
	exit;
}

if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
    $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    header("Location: $redirect");
    exit;
}

$query  = "select name from categories where category_id = '".(int)$_SESSION['cart']['category_id']."'";
$result = mysql_query($query) or die(mysql_error());
$category = mysql_fetch_assoc($result);

$qty   = ($_SESSION['cart']['adults'] + $_SESSION['cart']['children']);
$date = $_SESSION['cart']['tour_year']."-".$_SESSION['cart']['tour_month']."-".$_SESSION['cart']['tour_date'];
$tour_date = date('Y-m-d' , strtotime($date));

$items = $Booking->query_inventory(
	array(
		'category_id' => $_SESSION['cart']['category_id'],
	    'start_date'  => $tour_date,
		'item_id' => (int)$_SESSION['cart']['item_id'],
		'available' => 1,
		'discount_code' => $_SESSION['cart']['discount_code'],
	    'param'  => array(
			'adults' => $_SESSION['cart']['adults'],
			'children' => $_SESSION['cart']['children']
		)
	)
);
		
$item_data = $items[$_SESSION['cart']['item_id']];

?>
<div class="panel checkout-page">
    <div class="panel-body">
		<h3 class="title-img">1. <?php echo $category['name'] . " " .$item_data['name'];?></h3>
		<hr/>
		
    	<form class="form-horizontal" method="post" role="form" id="checkout" action="<?php echo home_url();?>/cart/payment.php" onsubmit="return validateForm();">
          <div class="form-group">
        	<label for="inputEmail3" class="col-sm-4 control-label">Tour Date:</label>
        	<div class="col-sm-6">
        		<?php $date = $_SESSION['cart']['tour_year']."-".$_SESSION['cart']['tour_month']."-".$_SESSION['cart']['tour_date'];?>
        	    <?php echo date('d-M-Y',strtotime($date));?>
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputEmail3" class="col-sm-4 control-label">Price:</label>
        	<div class="col-sm-6">
        	   <?php print_r($item_data['rate']['summary']['details']);?> <br />
        	   <?php echo $item_data['rate']['summary']['price']['total'];?>
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputEmail3" class="col-sm-4 control-label">Number Of Adults:</label>
        	<div class="col-sm-6">
        	  <?php echo $_SESSION['cart']['adults']?>
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputEmail3" class="col-sm-4 control-label">Number Of Children:</label>
        	<div class="col-sm-6">
        	  <?php echo $_SESSION['cart']['children']?>
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputEmail3" class="col-sm-4 control-label">Lead traveller's Name:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" readonly="readonly" name="customer_name" value="<?php echo @$_SESSION['data']['customer_name']?>" id="customer_name" placeholder="name">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Special Requests:</label>
        	<div class="col-sm-6">
        	  <textarea class="form-control" readonly="readonly" name="note"><?php echo @$_SESSION['data']['note']?></textarea>
        	</div>
          </div>
          
          <h3 class="sub-title">2. Contact Information</h3>
          <hr/>
          
          <div class="form-group">
        	<label for="inputEmail3" class="col-sm-4 control-label">Email Adresss:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" readonly="readonly" id="customer_email" value="<?php echo @$_SESSION['data']['customer_email']?>" name="customer_email" placeholder="e-mail">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Customer Phone:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" readonly="readonly" id="customer_phone" value="<?php echo @$_SESSION['data']['customer_phone']?>" name="customer_phone" onchange="phoneFix();" placeholder="phone">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Address:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" readonly="readonly" id="customer_address" value="<?php echo @$_SESSION['data']['customer_address']?>" name="customer_address" placeholder="Address">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Country:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" readonly="readonly" id="customer_country" value="<?php echo @$_SESSION['data']['customer_country']?>" name="customer_country" placeholder="country">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">State:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" readonly="readonly" id="customer_region" value="<?php echo @$_SESSION['data']['customer_region']?>" name="customer_region" placeholder="state">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">City:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" readonly="readonly" id="customer_city"  value="<?php echo @$_SESSION['data']['customer_city']?>" name="customer_city" placeholder="city">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Zip:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" readonly="readonly" id="customer_postal_zip" value="<?php echo @$_SESSION['data']['customer_postal_zip']?>" name="customer_postal_zip" placeholder="zip">
        	</div>
          </div>
          
          <h3 class="sub-title">3. Dietary Restrictions</h3>
          <hr/>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Vegetarian?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="form-control" id="Vegetarian" <?php if($_SESSION['data']['Vegetarian']):?> checked="checked" <?php endif;?> name="Vegetarian">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">No Chocolate?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="form-control" id="no_chocolate" <?php if($_SESSION['data']['no_chocolate']):?> checked="checked" <?php endif;?> name="no_chocolate" placeholder="No Chocolate">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">No Alcohol?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="form-control" id="no_alcohol" <?php if($_SESSION['data']['no_alcohol']):?> checked="checked" <?php endif;?> name="no_alcohol" placeholder="No Alcohol">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">No Pork?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="form-control" id="no_pork" <?php if($_SESSION['data']['no_pork']):?> checked="checked" <?php endif;?> name="no_pork" placeholder="No Pork">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Can't eat anything cooked in peanut oil?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="form-control" id="peanut_oil" <?php if($_SESSION['data']['peanut_oil']):?> checked="checked" <?php endif;?> name="peanut_oil" placeholder="Can't eat anything cooked in peanut oil?">
        	</div>
          </div>
          
          <h3 class="sub-title">4. Enter your Payment details</h3>
          <hr/>
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Card Type:</label>
        	<div class="col-sm-6">
        	  <select id="authorizenet_cc_type" name="cc_type" class="validate[required]">
                    <option value="">--Please Select--</option>
                    <option value="AE" <?php if($_SESSION['data']['cc_type'] == 'AE'):?> selected="selected" <?php endif;?>>American Express</option>
                    <option value="VI" <?php if($_SESSION['data']['cc_type'] == 'VI'):?> selected="selected" <?php endif;?>>Visa</option>
                    <option value="MC" <?php if($_SESSION['data']['cc_type'] == 'MC'):?> selected="selected" <?php endif;?>>MasterCard</option>
                    <option value="DI" <?php if($_SESSION['data']['cc_type'] == 'DI'):?> selected="selected" <?php endif;?>>Discover</option>
        	  </select>
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Card Number:</label>
        	<div class="col-sm-6">
        	  <input type="text" class="form-control" readonly="readonly" value="<?php echo $_SESSION['data']['card_number']?>" autocomplete="off" name="card_number" id="card_number" placeholder="Card Number">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">CVV code :</label>
        	<div class="col-sm-8">
        	  <input autocomplete="off" readonly="readonly" style="width: 90px;display: inline-block" value="<?php echo $_SESSION['data']['cvv']?>" type="text" class="form-control" maxlength="3" name="cvv" id="cvv" placeholder="CVV code">
        	  <img width="40px"  src="<?php echo $host_path?>/images/cardsecfw.jpg" />
        	  <span>(Last three digits on the back of your card)</span>
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Expire Date:</label>
        	<div class="col-sm-6">
        	  <select class="select" name="month">
        		 <?php for($i=1;$i<=12;$i++): $k = $i; if($i < 10){ $k = '0'.$i; }?>
        		 		<option value="<?php echo $k;?>" <?php if($_SESSION['data']['month'] == $k):?> selected="selected" <?php endif;?>><?php echo $k;?></option>
        		 <?php endfor;?>
        	  </select>
        	  <select class="select" name="year">
        		 <?php for($i=date('Y');$i<=date('Y')+10;$i++):?>
        		 		<option value="<?php echo $i;?>" <?php if($_SESSION['data']['year'] == $i):?> selected="selected" <?php endif;?>><?php echo $i;?></option>
        		 <?php endfor;?>
        	  </select>
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Billing Address:</label>
        	<div class="col-sm-6">
        	  <input type="text" autocomplete="off" readonly="readonly" class="form-control" value="<?php echo $_SESSION['data']['bill_address']?>" id="inputPassword3" id="bill_address" name="bill_address" placeholder="Billing Address">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Billing Country:</label>
        	<div class="col-sm-6">
        	  <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="<?php echo $_SESSION['data']['bill_country']?>" id="inputPassword3" id="bill_country" name="bill_country" placeholder="Billing Country">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Card Holders Name :</label>
        	<div class="col-sm-6">
        	  <input type="text" autocomplete="off" class="form-control" readonly="readonly" value="<?php echo $_SESSION['data']['holder_name']?>" id="inputPassword3" id="holder_name" name="holder_name" placeholder="Card Holders Name">
        	</div>
          </div>
          
          <?php if($_SESSION['cart']['discount_code']):?>
        	  <div class="form-group">
        		<label for="inputPassword3" class="col-sm-4 control-label">Promotion Code:</label>
        		<div class="col-sm-6">
        		  <strong><?php echo $_SESSION['cart']['discount_code'];?></strong>
        		</div>
        	  </div>
          <?php endif;?>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Subtotal:</label>
        	<div class="col-sm-6">
        	  <strong><?php echo $item_data['rate']['summary']['price']['total'];?></strong>
        	</div>
          </div>
          
          <div class="form-group">
        	   <label for="inputPassword3" class="col-sm-12 control-label">
        	   <input type="checkbox" name="terms" id="terms" value="1" <?php if($_SESSION['data']['terms']):?> checked="checked" <?php endif;?>> I have read and agree to the terms and conditions</label>
          </div>
          
          <div class="form-group">
        	   <label for="inputPassword3" class="col-sm-12 control-label">
        	   <input type="checkbox" name="newsletter" id="newsletter" value="1" <?php if($_SESSION['data']['newsletter']):?> checked="checked" <?php endif;?>> Would you like subscribe to newsletter?</label>
          </div>
          
          <hr/>
          <div class="form-group">
        	<div class="col-sm-10">
        	   <button type="button" onclick="window.location.href='<?php echo home_url()?>/checkout/';" class="btn btn-orange" name="placeOrder" value="placeOrder">Back</button>	 
        	   
        	   <button type="submit" class="btn btn-orange" name="placeOrder" value="placeOrder">Confirm Order</button>
        	</div>
          </div>
    </form>
 </div>
</div>    