<div class="container">
     <?php dynamic_sidebar('common-widget'); ?>
</div>
<footer class="content-info" role="contentinfo">
 
    <div class="footer">
		<div class="container">
                    <div class="row">
                         <?php dynamic_sidebar('sidebar-footer'); ?>
                    </div>
			<br>
			<div class="row bg-line">
				<div class="col-md-12 center">
				<h3>  London Food Tours</h3>
					<div class="social-container" style="margin: 0 0 10px">
						<a style="margin:5px"  href="https://www.facebook.com/pages/London-Food-Lovers/864626370344634"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/fb.png" /></a>
						<a style="margin:5px" href="https://twitter.com/FoodLoversTours"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitt.png" /></a>
						<a style="margin:5px" href="https://plus.google.com/112092265692699836505/posts"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/google.png" /></a>
						<a style="margin:5px" href="mailto:info@londonfoodlovers.com"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/email.png" /></a>
					</div>
					
					<p>
				London Food Lovers Food Tours are rated among the top London Attractions, London Tours, London Private Tours, London Group Tours and London Food Tours. 
					</p>
				</div>
			</div>
			<p class="copyright center">
					©2014 Food Lovers Tours LTD. All Rights Reserved
			</p>
		</div>
	</div>
</footer>

	

<script>
	jQuery(document).ready(function(){
	jQuery('.modal').modal('hide');

		jQuery('.footer .menu-privacy-policy a').attr({'data-toggle':"modal", 'data-target':"#privacy-policy"});
		jQuery('.footer .menu-terms-and-conditions a').attr({'data-toggle':"modal", 'data-target':"#terms-condtions"});
	})
</script> 

<?php wp_footer(); ?>

