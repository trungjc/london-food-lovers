<?php if ( is_page('private-tours') ) :    
  //dynamic_sidebar('private-tours'); 
  
$pagename = get_query_var('pagename');
if ( !$pagename && $id > 0 ) {
    // If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object
    $post = $wp_query->get_queried_object();
    $pagename = $post->post_name;
}
?>
<div class="form-request">
  <form method="post" action="<?php echo home_url() ?>/cart/private_tour.php" id="">
  	<input type="hidden" name="frompage" value="<?php echo $pagename;?>" />
  	
    <div class="panel panel-default orange">
        <div class="panel-heading"><h3 style="font-size: 16px">SUBMIT A REQUEST FORM</h3></div>
        <div class="panel-body">				
            <div class="form-group">
                <div class="form-group">
                     <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
                </div>
                <div class="form-group">
                      <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
                </div>
                <div class="form-group">
                     <input type="text" class="form-control" name="email" id="email" id="inputEmail3" placeholder="Email">
                </div>
                <div class="form-group">
                     <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number">
                </div>
                <div class="form-group">
                     <textarea class="form-control" name="comments" id="comments"></textarea>
                </div>
                <div class="form-group">
                    <div class=" row">
                        <div class="col-md-7 col-xs-12">
                            <select class="select-small" name="adults" id="adults">
        						<?php for($i=1;$i<=10;$i++):?>
        								<option value="<?php echo $i;?>"><?php echo $i;?></option>
        						<?php endfor;?>
        					</select>
                            <span class="label-option"  style="font-size:10px">ADULTS(19+)</span>
                        </div>

                        <div class="col-md-5 col-xs-12">
                            <select class="select-small" name="children" id="children">
        						<?php for($i=0;$i<=10;$i++):?>
        								<option value="<?php echo $i;?>"><?php echo $i;?></option>
        						<?php endfor;?>
        					</select>
                            <span class="label-option"  style="font-size:11px">KIDS</span>
                        </div>
                    </div>
               </div>
               <div class="center">
               		<input type="submit" class="btn btn-black btn-md" id="booknow" name="booknow" value="Book Now" />
               </div>
          </div>
       </div>
   </div>  <!--end--form-search-->
  </form>   
</div>
<?php 
elseif ( is_page('corporate-tours')  ) : ?>


<div class="form-request">
  <form method="post" action="<?php echo home_url() ?>/cart/corporate-tour.php" id="">
  	<input type="hidden" name="frompage" value="<?php echo $pagename;?>" />
  	
    <div class="panel panel-default orange">
        <div class="panel-heading"><h3 style="font-size: 16px">SUBMIT A REQUEST FORM</h3></div>
        <div class="panel-body">				
            <div class="form-group">
                <div class="form-group">
                     <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name">
                </div>
                <div class="form-group">
                      <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name">
                </div>
                <div class="form-group">
                     <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                </div>
                <div class="form-group">
                      <input type="text" class="form-control" name="company" id="company" placeholder="Company">
                </div>
                
                <div class="form-group">
                     <input type="text" class="form-control" name="email" id="email" id="inputEmail3" placeholder="Email">
                </div>
                <div class="form-group">
                     <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number">
                </div>
                <div class="form-group">
                     <textarea class="form-control" name="comments" id="comments"></textarea>
                </div>
                <div class="form-group">
                    <div class=" row">
                        <div class="col-md-7 col-xs-12">
                            <select class="select-small" name="adults" id="adults">
        						<?php for($i=1;$i<=10;$i++):?>
        								<option value="<?php echo $i;?>"><?php echo $i;?></option>
        						<?php endfor;?>
        					</select>
                            <span class="label-option"  style="font-size:10px">ADULTS(19+)</span>
                        </div>

                        <div class="col-md-5 col-xs-12">
                            <select class="select-small" name="children" id="children">
        						<?php for($i=0;$i<=10;$i++):?>
        								<option value="<?php echo $i;?>"><?php echo $i;?></option>
        						<?php endfor;?>
        					</select>
                            <span class="label-option"  style="font-size:11px">KIDS</span>
                        </div>
                    </div>
               </div>
               <div class="center">
               		<input type="submit" class="btn btn-black btn-md" id="booknow" name="booknow" value="Book Now" />
               </div>
          </div>
       </div>
   </div>  <!--end--form-search-->
  </form>   
</div>


<?php elseif ( is_page('checkout') ) :  ?>

<?php  require_once locate_template('form-book-tour.php');       ?>

<?php
elseif ( is_page('new-page') ) :   
  dynamic_sidebar('sidebar-new');
else:   
  //dynamic_sidebar('sidebar-primary');
endif;  
  dynamic_sidebar('sidebar-primary');
?>