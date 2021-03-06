﻿<?php

@session_start();

$Booking = new Booking();
$categories = $Booking->query_categories();

if(!$_SESSION['cart']) {
    $url = home_url();
    echo "<script>window.location.href='$url';</script>";
    exit;
}

if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
    $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    echo "<script>window.location.href='$redirect';</script>";
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
    'discount_code' => $_SESSION['cart']['discount_code'],
    'available' => 1,
      'param'  => array(
      'adults' => $_SESSION['cart']['adults'],
      'children' => $_SESSION['cart']['children']
    )
  )
);

$item_data = $items[$_SESSION['cart']['item_id']];

$slip = $item_data['rate']['slip'];
$Booking->clear();
$Booking->set($slip);

//print "<pre>";
//print_r($_SESSION); exit;

if($_SESSION['sub_total'] == $_SESSION['total']){
	$_SESSION['price_total'] = $_SESSION['sub_total'] + $_SESSION['discount'];
}
else{
	$_SESSION['price_total'] = $_SESSION['sub_total'];
}
?>  
<div class='alert alert-info'></div>
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
			  <label for="inputEmail3" class="col-sm-4 control-label">Details:</label>
			  <div class="col-sm-6">
				 <?php print_r($item_data['rate']['summary']['details']);?> <br />
			  </div>
          </div>

		   <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">Subtotal:</label>
              <div class="col-sm-6">
                <strong>£<?php echo $_SESSION['price_total'];?></strong>
              </div>
          </div>
          
          <?php if($_SESSION['cart']['discount_code']):?>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-4 control-label">Promotion Code:</label>
                <div class="col-sm-6">
                    <strong><?php echo $_SESSION['cart']['discount_code'];?></strong>
                </div>
             </div>
             
             <div class="form-group">   
                <label for="inputPassword3" class="col-sm-4 control-label">Discount:</label>
                <div class="col-sm-6">
                    <strong>£<?php echo $_SESSION['discount'];?></strong>
                </div>
            </div>
          <?php endif;?>

		  <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">Total:</label>
              <div class="col-sm-6">
                <strong>£<?php echo $_SESSION['total'];?></strong>
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
                <input type="text" class="form-control" name="customer_name" value="<?php echo @$_SESSION['data']['customer_name']?>" id="customer_name" placeholder="name">
              </div>
          </div>
          
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">Special Requests (For example - Celebrating a Birthday or Anniversary? Let us know!):</label>
              <div class="col-sm-6">
                <textarea class="form-control" name="note"><?php echo @$_SESSION['data']['note']?></textarea>
              </div>
          </div>

		  <div id="accordionx" class="panel-group-collapse">
            <div class="panel panel-default orange " style="margin: 20px 0px 0; box-shadow: none">
                  <div class="panel-heading " style=" box-shadow: none">
                    <h3 ><span style="color: white;" class="glyphicon glyphicon-calendar"></span>  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" style="font-weight: normal; font-size: 18px; color: white;">Want to change the tour date?</a></h3>
                </div>
      	    </div>
	        <div id="collapseThree" class="panel-collapse collapse" style="border-radius: 0 0 5px 5px;border:1px solid #ddd;margin-bottom:20px;">
	              <div class="panel-body">
	              <div class="row calendarbox">
	                    <div style="" class="col-sm-6 col-md-6 col-xs-12">
	                    <?php  require locate_template('form-book-tour2.php'); ?>
	                    </div>
	                       <div class="col-sm-6 col-md-6 col-xs-12" style="border-left: 1px solid rgb(227, 227, 227);">
	                      <div style="margin: 10px auto; width: 210px;" id="calender2"></div>
	                     </div>
	                </div>
	                <div class="center" style="margin-top: 20px;">  
	                	<div id="errorMessage"></div>
	                    <input type="button" class="btn btn-black btn-md" onclick="changeTourDate();" id="changedate" name="changedate" value="Change Date" />
	                </div>
	              </div>  
	        </div>
          </div>
          
          <h3 class="title-img" style="margin: 20px 0;">2. Contact Information</h3>
          <hr/>
          
          <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label">Email Adresss:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="customer_email" value="<?php echo @$_SESSION['data']['customer_email']?>" name="customer_email" placeholder="e-mail">
          </div>
          </div>
          
          <div class="form-group">
          <label for="inputPassword3" class="col-sm-4 control-label">Contact Number:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="customer_phone" value="<?php echo @$_SESSION['data']['customer_phone']?>" name="customer_phone" onchange="phoneFix();" placeholder="phone">
          </div>
          </div>
          
          <div class="form-group">
          <label for="inputPassword3" class="col-sm-4 control-label">Country:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="customer_country" value="<?php echo @$_SESSION['data']['customer_country']?>" name="customer_country" placeholder="country">
          </div>
          </div>
          
          <div class="form-group">
          <label for="inputPassword3" class="col-sm-4 control-label">Address:</label>
          <div class="col-sm-6">
            <input type="text" class="form-control" id="customer_address" value="<?php echo @$_SESSION['data']['customer_address']?>" name="customer_address" placeholder="Address">
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
          
          <h3 class="title-img">3. Let us know about your Food Needs! </h3>
          <hr/>
          
          <p> Please select the number of persons in your party for each line </p>
          
          <?php $foods = array('Vegetarian?'=>'vegetarian','No Pork?'=>'no_pork','No Fish?'=>'no_fish','No Alcohol?'=>'no_alcohol','Vegan?'=>'vegan','No Eggs?'=>'no_eggs','No Gluten?'=>'no_gluten','No Nuts?'=>'no_nuts','No Lactose?'=>'no_lactose','No Shellfish?'=>'no_shellfish')?>
		  <?php for($i=1;$i<=$qty;$i++):?>
		  	  <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label" style="color:#EE794D">Guest Name <?php echo $i; ?></label>
                  <div class="col-sm-6">
                  	<input type="text" id="guestname" name="guestname[<?php echo $i;?>]" value="<?php echo $_SESSION['data']['guestname'][$i]; ?>" class="form-control" />
                  </div>
              </div>
          
              <?php foreach($foods as $key => $value):?>	
                  <div class="form-group">
                      <label for="inputPassword3" class="col-sm-4 control-label"><?php echo $key;?></label>
                      <div class="col-sm-6">
                      	<input type="checkbox" <?php if($_SESSION['data'][$value][$i] == 1):?> checked="checked" <?php endif;?> id="<?php echo $value;?>" name="<?php echo $value;?>[<?php echo $i;?>]" value="1" class="form-control" />
                      </div>
                  </div>
              <?php endforeach;?>
          <?php endfor;?>    
          
          <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">Other restriction(s):</label>
              <div class="col-sm-6">
                <textarea class="form-control" name="other_note"><?php echo @$_SESSION['data']['other_note']?></textarea>
              </div>
          </div>
          
          <?php if($_SESSION['total'] > 0):?>
          
	          <h3 class="title-img">4. Enter your Payment details</h3>
	          <hr/>
	          <div class="form-group">
	          <label for="inputPassword3" class="col-sm-4 control-label">Card Type:</label>
	          <div class="col-sm-3">
	            <select id="authorizenet_cc_type" name="cc_type" class="validate[required] form-control">
	                <option value="">Your Card</option>
	                <option value="VI" <?php if($_SESSION['data']['cc_type'] == 'VI'):?> selected="selected" <?php endif;?>>Visa</option>
	                <option value="MC" <?php if($_SESSION['data']['cc_type'] == 'MC'):?> selected="selected" <?php endif;?>>MasterCard</option>
	                <option value="DI" <?php if($_SESSION['data']['cc_type'] == 'DI'):?> selected="selected" <?php endif;?>>Discover</option>
	                <option value="AE" <?php if($_SESSION['data']['cc_type'] == 'AE'):?> selected="selected" <?php endif;?>>American Express</option>
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
	          <label for="inputPassword3" class="col-sm-4 control-label">CVV code:</label>
	          <div class="col-sm-8">
	            <input autocomplete="off" style="width: 90px;display: inline-block" type="text" class="form-control" maxlength="3" name="cvv" id="cvv" placeholder="CVV code">
	            <img width="40px"  src="<?php echo $host_path?>/images/fir.png" />
	            <span>(Last three digits on the back of your card)</span>
	          </div>
	          </div>
	          
	          <div class="form-group">
	          <label for="inputPassword3" class="col-sm-4 control-label">Expire Date:</label>
	          <div class="col-sm-6">
	            <select class="select-x form-control pull-left" name="month">
	             <?php for($i=1;$i<=12;$i++): $k = $i; if($i < 10){ $k = '0'.$i; }?>
	                <option value="<?php echo $k;?>"><?php echo $k;?></option>
	             <?php endfor;?>
	            </select>
	            <select class="select-x form-control pull-left" name="year">
	             <?php for($i=date('Y');$i<=date('Y')+10;$i++):?>
	                <option value="<?php echo $i;?>"><?php echo $i;?></option>
	             <?php endfor;?>
	            </select>
	          </div>
	          </div>
	          
	          <div class="form-group">
	          <label for="inputPassword3" class="col-sm-4 control-label">Billing Address:</label>
	          <div class="col-sm-6">
	            <input type="text" autocomplete="off" class="form-control" value="<?php echo $_SESSION['data']['bill_address'];?>" id="bill_address" name="bill_address" placeholder="Billing Address">
	          </div>
	          </div>
	          
	          <div class="form-group">
	          <label for="inputPassword3" class="col-sm-4 control-label">Billing Country:</label>
	          <div class="col-sm-6">
	            <input type="text" autocomplete="off" class="form-control" value="<?php echo $_SESSION['data']['bill_country'];?>" id="bill_country" name="bill_country" placeholder="Billing Country">
	          </div>
	          </div>
	          
	          <div class="form-group">
	          <label for="inputPassword3" class="col-sm-4 control-label">Card Holders Name:</label>
	          <div class="col-sm-6">
	            <input type="text" autocomplete="off" class="form-control" value="<?php echo $_SESSION['data']['holder_name'];?>" id="holder_name" name="holder_name" placeholder="Card Holders Name">
	          </div>
	          </div>
	      <?php endif;?>    
       
		  <div class="form-group">
              <label for="inputPassword3" class="col-sm-4 control-label">Total:</label>
              <div class="col-sm-6">
                <strong>£<?php echo $_SESSION['total'];?></strong>
              </div>
          </div>
          
          <div class="form-group">
             <label for="inputPassword3" class="col-sm-12 control-label">
             <input type="checkbox" name="terms" id="terms" value="1"> I have read and agree to the terms and conditions</label>
          </div>
          
          <div class="form-group">
             <label for="inputPassword3" class="col-sm-12 control-label">
             <input type="checkbox" name="newsletter" id="newsletter" value="1" checked="checked"> Subscribe me to your updates and news?</label>
          </div>
          
          <hr/>
          <div class="form-group">
          <div class="col-sm-12 center" >
            <button type="submit" class="btn btn-orange btn-lg" name="placeOrder" value="placeOrder">Check Out</button>
          </div>
          </div>
    </form>
 </div>
</div>    