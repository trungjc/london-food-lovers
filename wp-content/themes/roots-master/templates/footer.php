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
					<p>
						Reserved for SEO
					</p>
				</div>
			</div>
			<p class="copyright center">
					2014 Food Lovers Tours LTD. All Rights Reserved
			</p>
		</div>
	</div>
</footer>

	

<script>
	jQuery(document).ready(function(){
	jQuery('.modal').modal('hide');

		jQuery('.footer .menu-private-policy a').attr({'data-toggle':"modal", 'data-target':"#privacy-policy"});
		jQuery('.footer .menu-terms-conditions a').attr({'data-toggle':"modal", 'data-target':"#terms-condtions"});
	})
</script> 

<?php wp_footer(); ?>

