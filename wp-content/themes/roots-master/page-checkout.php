<?php

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
?>
<div class="panel checkout-page">
    <div class="panel-body">
		<h3 class="title-img">1. <?php echo $category['name'] . " " .$item_data['name'];?></h3>
		
		<hr/>
		
    	<form class="form-horizontal" method="post" role="form" id="checkout" action="<?php echo home_url();?>/cart/confirm.php" onsubmit="return validateForm();">
          <div class="form-group">
        	<label for="inputEmail3" class="col-sm-4 control-label">Tour Date:</label>
        	<div class="col-sm-6">
        		<?php $date = $_SESSION['cart']['tour_year']."-".$_SESSION['cart']['tour_month']."-".$_SESSION['cart']['tour_date'];?>
        	    <?php echo date('d-M-Y',strtotime($date));?>
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputEmail3" class="col-sm-4 control-label">Subtotal:</label>
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
        	  <input type="text" class="form-control" name="customer_name" value="<?php echo @$_SESSION['data']['customer_name']?>" id="customer_name" placeholder="name">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Special Requests (For example - Celebrating a Birthday or Anniversary? Let us know!):</label>
        	<div class="col-sm-6">
        	  <textarea class="form-control" name="note"><?php echo @$_SESSION['data']['note']?></textarea>
        	</div>
          </div>
            <!--calendar here-->
            
            <div class="panel panel-default orange " style="margin: 20px 0px;">
        <div class="panel-heading ">
            <h3 style="font-weight: normal; font-size: 18px; color: white;"><span style="color: white;" class="glyphicon glyphicon-calendar"></span> What to change the tour date?</h3>
        </div>
        <div class="panel-body">
		<div class="row calendarbox">
            <div style="" class="col-sm-6 col-md-6 col-xs-12">
				<div style="margin: 10px auto; width: 72%;" class="form-groups">
                <div class="form-group">
                    <select onchange="getTours(this.value);" id="category_id" name="category_id" class="form-control">
					  	<option value="">Select Category</option>
					            						<option value="1">
        						   London Soho Tour        						</option>
        							
					  </select>
                </div>
                
                <div class="form-group">
                    <div class="date-times">
				      					  <select style="width: 32%;" class="form-control pull-left" name="tour_year" id="tour_year">
						<option value="">Year</option>
					            						<option value="2014">
        						   2014        						</option>
        				        						<option value="2015">
        						   2015        						</option>
        									  </select>
					  
					  <select style="margin-left: 10px; width: 32%;" class="form-control pull-left" name="tour_month" id="tour_month">
						<option value="">Month</option>
					            						<option value="04">
        						  Apr        						</option>
        				        						<option value="05">
        						  May        						</option>
        				        						<option value="06">
        						  Jun        						</option>
        				        						<option value="07">
        						  Jul        						</option>
        				        						<option value="08">
        						  Aug        						</option>
        				        						<option value="09">
        						  Sep        						</option>
        				        						<option value="10">
        						  Oct        						</option>
        				        						<option value="11">
        						  Nov        						</option>
        				        						<option value="12">
        						  Dec        						</option>
        									  </select>
					  
					  <select style="margin-left: 10px; width: 28%;" class="form-control pull-left" name="tour_date" id="tour_date">
						<option value="">Day</option>
					            						<option value="01">
        						   1        						</option>
        				        						<option value="02">
        						   2        						</option>
        				        						<option value="03">
        						   3        						</option>
        				        						<option value="04">
        						   4        						</option>
        				        						<option value="05">
        						   5        						</option>
        				        						<option value="06">
        						   6        						</option>
        				        						<option value="07">
        						   7        						</option>
        				        						<option value="08">
        						   8        						</option>
        				        						<option value="09">
        						   9        						</option>
        				        						<option value="10">
        						   10        						</option>
        				        						<option value="11">
        						   11        						</option>
        				        						<option value="12">
        						   12        						</option>
        				        						<option value="13">
        						   13        						</option>
        				        						<option value="14">
        						   14        						</option>
        				        						<option value="15">
        						   15        						</option>
        				        						<option value="16">
        						   16        						</option>
        				        						<option value="17">
        						   17        						</option>
        				        						<option value="18">
        						   18        						</option>
        				        						<option value="19">
        						   19        						</option>
        				        						<option value="20">
        						   20        						</option>
        				        						<option value="21">
        						   21        						</option>
        				        						<option value="22">
        						   22        						</option>
        				        						<option value="23">
        						   23        						</option>
        				        						<option value="24">
        						   24        						</option>
        				        						<option value="25">
        						   25        						</option>
        				        						<option value="26">
        						   26        						</option>
        				        						<option value="27">
        						   27        						</option>
        				        						<option value="28">
        						   28        						</option>
        				        						<option value="29">
        						   29        						</option>
        				        						<option value="30">
        						   30        						</option>
        				        						<option value="31">
        						   31        						</option>
        									  </select>
					  
					  <a onclick="jQuery('#calender').toggle();" href="javascript:void(0);" style="margin-left: 4px; font-size: 48px; display: none;"><img src="https://londonfoodlovers.com/images/img.gif"></a>
				   </div>
				   
				   <div style="display:none;position:absolute" id="calender"><table class="cf-cal-sm"><thead><tr class="head"><td><a class="cf-prev" href="#D20140301">◄</a></td><td colspan="5"><select class="none" id="cf-month" name="cf-month"><option selected="selected" value="20140423">APRIL 2014</option><option value="20140501">MAY 2014</option><option value="20140601">JUNE 2014</option><option value="20140701">JULY 2014</option><option value="20140801">AUGUST 2014</option><option value="20140901">SEPTEMBER 2014</option><option value="20141001">OCTOBER 2014</option><option value="20141101">NOVEMBER 2014</option><option value="20141201">DECEMBER 2014</option><option value="20150101">JANUARY 2015</option><option value="20150201">FEBRUARY 2015</option><option value="20150301">MARCH 2015</option><option value="20150401">APRIL 2015</option><option value="20150501">MAY 2015</option><option value="20150601">JUNE 2015</option><option value="20150701">JULY 2015</option><option value="20150801">AUGUST 2015</option><option value="20150901">SEPTEMBER 2015</option></select></td><td><a class="cf-next" href="#D20140501">►</a></td></tr><tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr></thead><tfoot><tr><td colspan="7">Wednesday April 23</td></tr></tfoot><tbody><tr><td class="X"><a href="#D20140331">31</a></td><td class="X"><a href="#D20140401"> 1</a></td><td class="X"><a href="#D20140402"> 2</a></td><td class="X"><a href="#D20140403"> 3</a></td><td class="X"><a href="#D20140404"> 4</a></td><td class="X"><a href="#D20140405"> 5</a></td><td class="X"><a href="#D20140406"> 6</a></td></tr>
<tr><td class="X"><a href="#D20140407"> 7</a></td><td class="X"><a href="#D20140408"> 8</a></td><td class="X"><a href="#D20140409"> 9</a></td><td class="X"><a href="#D20140410">10</a></td><td class="X"><a href="#D20140411">11</a></td><td class="X"><a href="#D20140412">12</a></td><td class="X"><a href="#D20140413">13</a></td></tr>
<tr><td class="X"><a href="#D20140414">14</a></td><td class="X"><a href="#D20140415">15</a></td><td class="X"><a href="#D20140416">16</a></td><td class="X"><a href="#D20140417">17</a></td><td class="X"><a href="#D20140418">18</a></td><td class="X"><a href="#D20140419">19</a></td><td class="X"><a href="#D20140420">20</a></td></tr>
<tr><td class="X"><a href="#D20140421">21</a></td><td class="X"><a href="#D20140422">22</a></td><td class="Q T"><a href="#D20140423">23</a></td><td class=""><a href="#D20140424">24</a></td><td class=""><a href="#D20140425">25</a></td><td class=""><a href="#D20140426">26</a></td><td class=""><a href="#D20140427">27</a></td></tr>
<tr><td class=""><a href="#D20140428">28</a></td><td class=""><a href="#D20140429">29</a></td><td class=""><a href="#D20140430">30</a></td><td class=""><a href="#D20140501"> 1</a></td><td class=""><a href="#D20140502"> 2</a></td><td class=""><a href="#D20140503"> 3</a></td><td class=""><a href="#D20140504"> 4</a></td></tr>
</tbody></table><input type="hidden" value="20140423:20140423" id="CF_range"></div>
            	   <input type="hidden" value="04" id="month" name="month">
                </div>
                
                <div id="itemsDiv" class="form-group"><select id="item_id" name="item_id" class="form-control"><option value="">Select Tour</option><option value="6">Morning Tour - English - 09:45AM</option></select></div>
			    
                <div id="detailsDiv" class="form-group">
				  <div class="date-times">
					<select style="width: 20%;" class="form-control pull-left" name="adults" id="adults">
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
											  </select>
					  &nbsp;<span class="label-option pull-left" style="margin-left: 5px; font-size: 11px; margin-top: 5px; margin-right: 5px;">ADULTS (12+)</span>
					  <select style="width: 20%;" class="form-control pull-left" name="children" id="children">
														<option value="0">0</option>
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
														<option value="4">4</option>
														<option value="5">5</option>
														<option value="6">6</option>
														<option value="7">7</option>
														<option value="8">8</option>
														<option value="9">9</option>
														<option value="10">10</option>
											  </select>
					  &nbsp;<span class="label-option pull-left" style="font-size: 11px; margin-top: 5px; margin-left: 5px;">KIDS (4-12)</span>
				   </div>				  
				</div>

                
                <div class=" center ">
                    <a id="" onclick="jQuery('#discount_code').toggle();" href="javascript://" class="PROMOTION">ENTER PROMOTION CODE</a>
					
					 <input type="text" style="display:none;" id="discount_code" value="" name="discount_code">
				</div>
            </div>
			</div>
            <div class="col-sm-6 col-md-6 col-xs-12" style="border-left: 1px solid rgb(227, 227, 227);">
				<div style="margin: 10px auto; width: 210px;" id="calender"><table class="cf-cal-sm"><thead><tr class="head" style="height: 48px;"><td><a class="cf-prev" href="#D20140301">◄</a></td><td colspan="5"><select class="none form-control" id="cf-month" name="cf-month"><option selected="selected" value="20140423">APRIL 2014</option><option value="20140501">MAY 2014</option><option value="20140601">JUNE 2014</option><option value="20140701">JULY 2014</option><option value="20140801">AUGUST 2014</option><option value="20140901">SEPTEMBER 2014</option><option value="20141001">OCTOBER 2014</option><option value="20141101">NOVEMBER 2014</option><option value="20141201">DECEMBER 2014</option><option value="20150101">JANUARY 2015</option><option value="20150201">FEBRUARY 2015</option><option value="20150301">MARCH 2015</option><option value="20150401">APRIL 2015</option><option value="20150501">MAY 2015</option><option value="20150601">JUNE 2015</option><option value="20150701">JULY 2015</option><option value="20150801">AUGUST 2015</option><option value="20150901">SEPTEMBER 2015</option></select></td><td><a class="cf-next" href="#D20140501">►</a></td></tr><tr><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th><th>Sun</th></tr></thead><tfoot><tr><td colspan="7">Wednesday April 23</td></tr></tfoot><tbody><tr><td class="X"><a href="#D20140331">31</a></td><td class="X"><a href="#D20140401"> 1</a></td><td class="X"><a href="#D20140402"> 2</a></td><td class="X"><a href="#D20140403"> 3</a></td><td class="X"><a href="#D20140404"> 4</a></td><td class="X"><a href="#D20140405"> 5</a></td><td class="X"><a href="#D20140406"> 6</a></td></tr>
<tr><td class="X"><a href="#D20140407"> 7</a></td><td class="X"><a href="#D20140408"> 8</a></td><td class="X"><a href="#D20140409"> 9</a></td><td class="X"><a href="#D20140410">10</a></td><td class="X"><a href="#D20140411">11</a></td><td class="X"><a href="#D20140412">12</a></td><td class="X"><a href="#D20140413">13</a></td></tr>
<tr><td class="X"><a href="#D20140414">14</a></td><td class="X"><a href="#D20140415">15</a></td><td class="X"><a href="#D20140416">16</a></td><td class="X"><a href="#D20140417">17</a></td><td class="X"><a href="#D20140418">18</a></td><td class="X"><a href="#D20140419">19</a></td><td class="X"><a href="#D20140420">20</a></td></tr>
<tr><td class="X"><a href="#D20140421">21</a></td><td class="X"><a href="#D20140422">22</a></td><td class="Q T"><a href="#D20140423">23</a></td><td class=""><a href="#D20140424">24</a></td><td class=""><a href="#D20140425">25</a></td><td class=""><a href="#D20140426">26</a></td><td class=""><a href="#D20140427">27</a></td></tr>
<tr><td class=""><a href="#D20140428">28</a></td><td class=""><a href="#D20140429">29</a></td><td class=""><a href="#D20140430">30</a></td><td class=""><a href="#D20140501"> 1</a></td><td class=""><a href="#D20140502"> 2</a></td><td class=""><a href="#D20140503"> 3</a></td><td class=""><a href="#D20140504"> 4</a></td></tr>
</tbody></table><input type="hidden" value="20140423:20140423" id="CF_range"></div>

			</div>
		</div>
			<div class="center" style="margin-top: 20px;"><a href="http://foodloverstour.wpengine.com/reviews/" class="btn btn-black btn-md">change dates</a></div>
        </div>
    </div>
            <!--end calendar herer-->
          
          <h3 class="title-img">2. Contact Information</h3>
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
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Vegetarian?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="" id="Vegetarian" value="1" name="Vegetarian">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">No Pork?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="" id="no_pork" value="1" name="no_pork" placeholder="No Pork">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">No Fish?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="" id="no_fish" value="1" name="no_fish" placeholder="No Pork">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">No Alcohol?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="" id="no_alcohol" value="1" name="no_alcohol" placeholder="No Alcohol">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Vegan?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="" id="vegan" value="1" name="vegan" placeholder="No Alcohol">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">No Eggs?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="" id="no_eggs" value="1" name="no_eggs" placeholder="No Alcohol">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">No Gluten?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="" id="no_gluten" value="1" name="no_gluten" placeholder="No Alcohol">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">No Nuts?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="" id="no_nuts" value="1" name="no_nuts" placeholder="No Chocolate">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">No Lactose?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="" id="no_lactose" value="1" name="no_lactose" placeholder="No Chocolate">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">No Shellfish?</label>
        	<div class="col-sm-6">
        	  <input type="checkbox" class="" id="no_shellfish" value="1" name="no_shellfish" placeholder="No Chocolate">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Other restriction(s): (here should be a box for person to write their special need)</label>
        	<div class="col-sm-6">
        	  <textarea class="form-control" name="other_note"><?php echo @$_SESSION['data']['other_note']?></textarea>
        	</div>
          </div>
          
          
          <h3 class="title-img">4. Enter your Payment details</h3>
          <hr/>
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">Card Type:</label>
        	<div class="col-sm-6">
        	  <select id="authorizenet_cc_type" name="cc_type" class="validate[required] form-control">
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
        	  <input type="text" class="form-control" autocomplete="off" name="card_number" id="card_number" placeholder="Card Number">
        	</div>
          </div>
          
          <div class="form-group">
        	<label for="inputPassword3" class="col-sm-4 control-label">CVV code:</label>
        	<div class="col-sm-8">
        	  <input autocomplete="off" style="width: 90px;display: inline-block" type="text" class="form-control" maxlength="3" name="cvv" id="cvv" placeholder="CVV code">
        	  <img width="40px"  src="<?php echo $host_path?>/images/cardsecfw.jpg" />
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
        	<label for="inputPassword3" class="col-sm-4 control-label">Card Holders Name:</label>
        	<div class="col-sm-6">
        	  <input type="text" autocomplete="off" class="form-control" id="inputPassword3" id="holder_name" name="holder_name" placeholder="Card Holders Name">
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
        	   <input type="checkbox" name="terms" id="terms" value="1"> I have read and agree to the terms and conditions</label>
          </div>
          
          <div class="form-group">
        	   <label for="inputPassword3" class="col-sm-12 control-label">
        	   <input type="checkbox" name="newsletter" id="newsletter" value="1"> Would you like subscribe to newsletter?</label>
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