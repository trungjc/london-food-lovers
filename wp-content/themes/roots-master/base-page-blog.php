<?php 

$host_path = home_url();
include 'cart/lib/foodloverstours.php';

$Booking = new Booking();
$categories = $Booking->query_categories();

// start a new booking session
if(isset($_POST['item_id'])) {
    $tour = array('category_id' => $_POST['category_id'] , 
             'item_id' => $_POST['item_id'],
                 'adults' => $_POST['adults'],
                 'children' => $_POST['children'],
                 'tour_year' => $_POST['tour_year'],
                 'tour_month' => $_POST['tour_month'],
                 'tour_date' => $_POST['tour_date'],
           'discount_code' => $_POST['discount_code'],
                 
    );
    
    $_SESSION['cart'] = $tour;
    $url = home_url() . "/checkout";
  header("Location:$url");
  exit;
}
?>

<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>
  


  <div class="home-section">
      
       <?php putRevSlider("blog") ?>
    </div>
  
  


  <script type="text/javascript" src="<?php echo $host_path?>/js/booking.js"></script>
  <link href="<?php echo $host_path?>/css/calender.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript">
      host_path = '<?php echo $host_path?>';
  </script>
  
  <div class="wrap container" role="document">
    <div class="content row">      
      <?php if (roots_display_sidebar()) : ?>
        <aside class="sidebar sidbar-blog <?php echo roots_sidebar_class(); ?>" role="complementary">             
        <!-- end form-search-->
         <?php  require_once locate_template('form-book-tour.php');       ?>
          <?php dynamic_sidebar('sidebar-blog'); ?>
                <div class="recent-blog widget ">
                    <h3>Most Recent Posts </h3>
                        <?php $the_query = new WP_Query( "showposts=2" ); ?>
                        <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                        <div class="recent-post-items">
                            <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
                            
                          <?php the_excerpt(); ?>
                            <div class="clearfix">
                                   <a class="btn btn-black  pull-right" href="<?php the_permalink() ?>">Read More</a>
                     
                            </div>
                            </div>     
                        <?php endwhile;?>
                    </div>
        </aside><!-- /.sidebar -->
      <?php endif; ?>
    <main class="main <?php echo roots_main_class(); ?>" role="main">
           <!--?php the_breadcrumb(); ?-->
        <?php include roots_template_path(); ?>
      </main><!-- /.main -->
    </div><!-- /.content -->
  
  </div><!-- /.wrap -->

<?php  require_once locate_template('pre-footer.php');       ?>
  <?php get_template_part('templates/footer'); ?>

</body>
</html>
