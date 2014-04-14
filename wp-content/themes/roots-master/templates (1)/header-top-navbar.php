<header class="banner navbar navbar-default  navbar-fixed-topa navbar-inverse" role="banner">
  <div class="container">
   <div class="col-md-3 col-xs-12 hidden-xs">
       <a class="logo" href="../"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png"  alt="<?php bloginfo('name'); ?>"  /></a>

    </div>
      <div class="col-md-9 col-xs-12 ">
            <div class="clearfix top-menu">
                    <div class="pull-right">
                            <a href="www.google.com">FAQ</a>
                            <a href="">Blog</a>&nbsp;&nbsp;&nbsp;
                            <a class="SocIcon twitter-b" href="">twitter</a>
                            <a class="SocIcon facebook" href="">facebook</a>
                            <a class="SocIcon twitter" href="">twitter</a>
                    </div>					
            </div>
          <div class="clearfix header-bottom">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                  <a class="logo visible-xs" href="<?php echo home_url(); ?>/"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="<?php bloginfo('name'); ?>"  /></a>
              </div>
              <nav class="collapse navbar-collapse" role="navigation">
                <?php
                  if (has_nav_menu('primary_navigation')) :
                    wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav'));
                  endif;
                ?>
              </nav>
          </div>
      </div>
    

    
  </div>
</header>