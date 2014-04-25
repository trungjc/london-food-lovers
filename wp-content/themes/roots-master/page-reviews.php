<?php

$reviews = $wpdb->get_results("select * from feedbacks where status = 1 order by dateofmodification DESC limit 10");

?>
<script src='<?php echo home_url();?>/js/jquery.MetaData.js' type="text/javascript" language="javascript"></script>
<script src='<?php echo home_url();?>/js/jquery.rating.js' type="text/javascript" language="javascript"></script>
<link href='<?php echo home_url();?>/js/jquery.rating.css' type="text/css" rel="stylesheet"/>

<script>
  jQuery(function() {
	  jQuery('input.star').rating();
  });
</script>

<div class="page-corporate-column">
    <?php get_template_part('templates/content', 'page'); ?>
    
    <h3>Customer Reviews</h3>
    
    <?php foreach($reviews as $review):?>
    		<div class="review-item hasArrow">
    			<div class="panel panel-default ">
            		<div class="panel-body ">
            			<div class= "date"> <?php echo date('d M, Y',strtotime($review->tour_date));?> </div> 
            			<?php $review->tour_highlight = str_ireplace("\n","<br/>",$review->tour_highlight);?>
               			<span class="quote1">“</span><?php echo $review->tour_highlight;?><span class="quote1">”</span>
         			</div> 
        		</div>
    			<div class="media">
        			<a class="pull-left" href="#">
        				<img src="<?php echo home_url();?>/cart/images/<?php echo $review->image;?>" alt="" class="img-rounded img-thumbnail" width="70">
        			</a>
        			<div class="media-body">
        				<div class="author"><?php echo $review->name .",". $review->country;?></div>
        				<div class="rate">
       					    <span class="glyphicon glyphicon-star <?php if($review->overall_rating > 1):?> rated <?php endif;?>"></span>
       					    <span class="glyphicon glyphicon-star <?php if($review->overall_rating > 2):?> rated <?php endif;?>"></span>
       					    <span class="glyphicon glyphicon-star <?php if($review->overall_rating > 3):?> rated <?php endif;?>"></span>
       					    <span class="glyphicon glyphicon-star <?php if($review->overall_rating > 4):?> rated <?php endif;?>"></span>
       					    <span class="glyphicon glyphicon-star <?php if($review->overall_rating == 5):?> rated <?php endif;?>"></span>
        				</div>
        			</div>
        		</div>
       		 </div>
	<?php endforeach;?>
</div>