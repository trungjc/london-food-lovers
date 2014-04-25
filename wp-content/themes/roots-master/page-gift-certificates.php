<?php
/* Template Name: gift-certificate */
if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
    $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    echo "<script>window.location.href='$redirect';</script>";
    exit;
}

$code_query  = mysql_query("select code , rand(1000) from vouchers where is_used = 0 and status = 1 order by rand() ASC limit 1");
$code_result = mysql_fetch_assoc($code_query);
if($code_result){
    $code = $code_result['code'];
}
?>
<div class="panel panel-default ">
	<div class="panel-body">
         <h3 class="title-img">Gift Certificate</h3>
         <div class="media">
             <div class="pull-left">
                 <img src="../wp-content/uploads/2014/04/about1.png" />
             </div>
             <div class="media-body">
                   <p>                  
           If you want to give someone a gift that they will be able to taste in their memories again and again for years to come, why not give them a London Food Lovers Gift Voucher?
 		</p>
		<p>    
			We promise a day full of delicious food, fun stories, and interesting historical anecdotes about one of London’s oldest international neighbourhoods, Soho.Once purchased, the gift voucher will be emailed to the purchaser. All vouchers 
			are valid for a year from their purchasing date. 
 		</p>
 		 <p>    
			To purchase your gift voucher for our Soho International Food Tour, simply follow the online instructions. 
 		</p> 
 		<p>    
			Once your order has been confirmed, you will receive email confirmation of your voucher as well as the printable tour voucher that can be validated when you decide which day you will redeem the tour.
        </p>
             </div>
         </div>
       
	</div>
</div>

<div class="panel panel-default review-box">
	<div class="panel-body">
          <h3 >Give a gift from the heart, a Food Lovers Gift Certificate!</h3>
    
          <ol class="guidle">
              <li> <span class="badge badge-x orange">1</span><strong>Select the quantity and buy! Pay through Credit Card. </strong></li>
              <li> <span class="badge  badge-x orange">2</span><strong>   Get our confirmation and online gift certificate   </strong>  </li>
              <li> <span class="badge  badge-x orange">3</span> <strong> Use your voucher code to make a reservation of the tour of your choice. </strong>  </li>
          </ol>
              
          <div class="center-block " style="width: 60%"> 
              <div class="form-groups center">
              	  <form method="post" action="<?php echo home_url()?>/checkout-certificate" id="certificate"> 
                     
                      <div class="form-group center ">
                      	 <?php if($code):?>
                      	 	 Select the number of gifts to give! 
                      	 	 <select name="qty">
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
                      	 	 
                          	 <!-- <a class="btn btn-black btn-md" href="javascript://" onclick="document.forms['certificate'].submit();" style="border-radius: 13px;  padding: 3px 20px;">Add to Cart</a>
                          	 <a class="paypal-button" href="#">
                              <img width="" src="../wp-content/uploads/2014/04/paypal.jpg"> -->
                          	 <div></a> <a href="javascript://" onclick="document.forms['certificate'].submit();" ><img style="margin-bottom: 5px" width="" src="http://londonfoodlovers.com/wp-content/uploads/2014/04/buy_gift.png"> </a></div>
                         <?php endif;?>  	 
                      </div>
                  </form>
              </div>
         </div>
    </div> 
</div>

<div class="panel panel-default ">
    <div class="panel-body">
        <h3 >Here are some pictures from our latest tours!</h3>             
        <?php putRevSlider("gift-certificates") ?>
    </div>    
</div>

<div class="two-column">
    <?php get_template_part('templates/content', 'page'); ?>
</div>