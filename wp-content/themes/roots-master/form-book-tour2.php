<div style="margin: 10px auto; width: 76%;" class="form-groups">
  <div class="panel-body">
    <div class="form-groups">
        <div class="form-group">
            <select class="form-control" name="category_id" id="category_id2" onchange="getTours(this.value);">
			  	<option value="">Select Category</option>
			    <?php foreach($categories as $category): if($category['name'] != 'Private Tour' && $category['name'] != 'Corporate Tour'):?>
						<option value="<?php echo $category['category_id']?>">
						   <?php echo $category['name']?>
						</option>
				<?php endif; endforeach;?>			
			  </select>
        </div>
        
        <div class="form-group">
            <div class="date-timex">
		      <?php $y = date('Y') - 1;?>
			  <select class="form-control" name="tour_year" id="tour_year2">
				<option value="">Year</option>
			    <?php for($i=1;$i<=2;$i++):?>
						<option value="<?php echo $y+$i?>">
						   <?php echo $y+$i?>
						</option>
				<?php endfor;?>
			  </select>
			  
			  <select class="form-control" name="tour_month" id="tour_month2">
				<option value="">Month</option>
			    <?php for($i=0;$i<=12-Date('m');$i++):?>
						<option value="<?php echo date('m',strtotime("+$i Month"));?>">
						  <?php echo date('M',strtotime("+$i Month"));?>
						</option>
				<?php endfor;?>
			  </select>
			  
			  <select class="form-control" name="tour_date" id="tour_date2">
				<option value="">Day</option>
			    <?php for($i=1;$i<=31;$i++): $k=$i; if($i<10) $k="0".$i;?>
						<option value="<?php echo $k?>">
						   <?php echo $i?>
						</option>
				<?php endfor;?>
			  </select>
		   </div>
		   
		   <div id="calender" style="display:none;position:absolute"></div>
    	   <input type="hidden" name="month" id="month" value="<?php echo date('m');?>" />
        </div>
        
        <div class="form-group" id="itemsDiv2">				  
		  <select class="form-control" name="item_id" id="item_id2">
			<option value="">Select Tour</option>
		  </select>	
	    </div>
	    
        <div class="form-group" id="detailsDiv">
		  <div class="date-timex">
			<select class="form-control" name="adults" id="adults" style="width:64px">
				<?php for($i=1;$i<=10;$i++):?>
						<option value="<?php echo $i;?>" <?php if($i == $_SESSION['cart']['adults']):?> selected="selected" <?php endif;?> ><?php echo $i;?></option>
				<?php endfor;?>
			  </select>
			 
			&nbsp;<span class="label-option pull-left" style="margin:7px 5px">ADULTS (12+)</span> 				  
			 <select class="form-control" name="children" id="children" style="width:64px"> 


				<?php for($i=0;$i<=10;$i++):?>
						<option value="<?php echo $i;?>" <?php if($i == $_SESSION['cart']['children']):?> selected="selected" <?php endif;?> ><?php echo $i;?></option>
				<?php endfor;?>
			  </select>
		<span style="margin: 7px 0px 7px 2px;" class="label-option pull-left">KIDS (4-12)</span>



		   </div>				  
		</div>
        <div class=" center ">
            <a class="PROMOTION" href="javascript://" onclick="jQuery('#discount_code').toggle();" id="">ENTER PROMOTION CODE</a>
			 <input type="text" name="discount_code" value="" id="discount_code" style="display:none;" />
		</div>
		<hr>
    </div>
 </div>
</div>
<script type="text/javascript">
	jQuery(document).ready(function(){
        jQuery("#category_id2").val(1);
        getTours(1);
        date = "<?php echo date('Ymd' , strtotime($date))?>";
        jQuery("#tour_year2").val(date.substring(0,4));
        jQuery("#tour_month2").val(date.substring(4,6));
        jQuery("#tour_date2").val(date.substring(6));
	});
</script>
<!-- end form-search-->