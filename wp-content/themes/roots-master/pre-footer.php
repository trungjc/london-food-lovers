<div class="pre-footer ">  
    <div class="container">
        <?php dynamic_sidebar('bottom-widget'); ?>        
        <!--   <div class="row">
         <div class="col-md-6 col-xs-12">
                <div class="pull-right tripadvisor">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tripadvisor.jpg" />
            	
            </div></div> -->
            <div class=" col-xs-12">
                <div class=" recent-post">
                    <div class="panel panel-default orange">
                        <div class="panel-heading center">
                            <h3>Recent Blog Posts</h3>
                        </div>
                        <div class="panel-body">
                            <?php $the_query = new WP_Query( "showposts=2" ); ?>
                            <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                            <div class="recent-post-item">
                                <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                                <div class="date">
                                    <?php echo date("F j, Y "); ?> 
                                </div>
                               <?php the_excerpt(); ?>
    
                                <a class="readmore" href="<?php the_permalink() ?>">Read More</a>
                            </div>     
                            <?php endwhile;?>
                        </div>
                    </div>
                </div>
        	</div>
         </div>
    </div>
</div>

<div class="newletter">
    <div class="container">
        <div class="newletter-inner">
            <form method="post" name="newletter" action="<?php echo home_url()?>/cart/newsletter.php">
                 Find the best restaurant reviews and most unique places in London
                 <input type="text" placeholder="enter your email" name="email" class="form-control" />
                 <input type="submit" value="submit" name="newslettersubmit" class="btn btn-orange btn-md" />
            </form>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        jQuery(window).scroll(function () {
            if (jQuery(window).scrollTop() > 50) {
                  jQuery('.newletter').addClass('active');   
            }
            if (jQuery(window).scrollTop() < 50) {
                  jQuery('.newletter').removeClass('active');   
            }
        });
    })
</script>