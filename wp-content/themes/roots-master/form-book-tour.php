<form method="post" name="booking" id="booking" action="" onsubmit="return checkavail();">
<div class=" form-search" >
    <div class="panel panel-default orange">
        <div class="panel-heading center">
            <h3>Book A Tour</h3>
        </div>
        <div class="panel-body">
            <div class="form-groups">
                <div class="form-group">
                    <select class="form-control" name="category_id" id="category_id" onchange="getTours(this.value);">
					  	<option value="">Select Category</option>
					    <?php foreach($categories as $category): if($category['name'] != 'Private Tour' && $category['name'] != 'Corporate Tour'):?>
        						<option value="<?php echo $category['category_id']?>">
        						   <?php echo $category['name']?>
        						</option>
        				<?php endif; endforeach;?>			
					  </select>
                </div>
                
                <div class="form-group">
                    <div class="date-time">
				      <?php $y = date('Y') - 1;?>
					  <select class="" name="tour_year" id="tour_year">
						<option value="">Year</option>
					    <?php for($i=1;$i<=2;$i++):?>
        						<option value="<?php echo $y+$i?>">
        						   <?php echo $y+$i?>
        						</option>
        				<?php endfor;?>
					  </select>
					  
					  <select class="" name="tour_month" id="tour_month">
						<option value="">Month</option>
					    <?php for($i=0;$i<=12-Date('m');$i++):?>
        						<option value="<?php echo date('m',strtotime("+$i Month"));?>">
        						  <?php echo date('M',strtotime("+$i Month"));?>
        						</option>
        				<?php endfor;?>
					  </select>
					  
					  <select class="" name="tour_date" id="tour_date">
						<option value="">Day</option>
					    <?php for($i=1;$i<=31;$i++): $k=$i; if($i<10) $k="0".$i;?>
        						<option value="<?php echo $k?>">
        						   <?php echo $i?>
        						</option>
        				<?php endfor;?>
					  </select>
					  
					  <a href="javascript:void(0);" onclick="jQuery('#calender').toggle();"><img src="<?php echo home_url()?>/images/img.gif" /></a>
				   </div>
				   
				   <div id="calender" style="display:none;position:absolute"></div>
            	   <input type="hidden" name="month" id="month" value="<?php echo date('m');?>" />
                </div>
                
                <div class="form-group" id="itemsDiv">				  
				  <select class="form-control" name="item_id" id="item_id">
					<option value="">Select Tour</option>
				  </select>	
			    </div>
			    
                <div class="form-group" id="detailsDiv">
				  <div class="date-time">
					<select class="" name="adults" id="adults">
						<?php for($i=1;$i<=10;$i++):?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
						<?php endfor;?>
					  </select>
					  &nbsp;<span class="label-option">ADULTS (12+)</span>
					  <select class="" name="children" id="children">
						<?php for($i=0;$i<=10;$i++):?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
						<?php endfor;?>
					  </select>
					  &nbsp;<span class="label-option">KIDS (4-12)</span>
				   </div>				  
				</div>
                
                <div class=" center ">
                    <a class="PROMOTION" href="javascript://" onclick="jQuery('#discount_code').toggle();" id="">ENTER PROMOTION CODE</a>
					<input type="text" name="discount_code" value="" id="discount_code" style="display:none;" />
				</div>
				<hr>
				<div id="errorMessage">
				
				</div>

				<div class="center">
			  	    <input type="submit" class="btn btn-orange btn-md" id="booknow" name="booknow" value="Book Now" />
			    </div>
            </div>
        </div>
    </div>
 </div>
</form>
<script type="text/javascript">
	jQuery(document).ready(function(){
        jQuery("#category_id").val(1);
        getTours(1);
        filldate("<?php echo date('Ymd')?>");
	});
</script>
<!-- end form-search-->