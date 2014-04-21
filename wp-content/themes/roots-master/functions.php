<?php
/**
 * Roots includes
 */
require_once locate_template('/lib/utils.php');           // Utility functions
require_once locate_template('/lib/init.php');            // Initial theme setup and constants
require_once locate_template('/lib/wrapper.php');         // Theme wrapper class
require_once locate_template('/lib/sidebar.php');         // Sidebar class
require_once locate_template('/lib/config.php');          // Configuration
require_once locate_template('/lib/activation.php');      // Theme activation
require_once locate_template('/lib/titles.php');          // Page titles
require_once locate_template('/lib/cleanup.php');         // Cleanup
require_once locate_template('/lib/nav.php');             // Custom nav modifications
require_once locate_template('/lib/gallery.php');         // Custom [gallery] modifications
require_once locate_template('/lib/comments.php');        // Custom comments modifications
require_once locate_template('/lib/relative-urls.php');   // Root relative URLs
require_once locate_template('/lib/widgets.php');         // Sidebars and widgets
require_once locate_template('/lib/scripts.php');         // Scripts and stylesheets
require_once locate_template('/lib/custom.php');          // Custom functions
require_once locate_template('/lib/shortcodes.php');          // Custom functions

function new_excerpt_length($length) {
    return 200;
}
add_filter('excerpt_length', 'new_excerpt_length',999);


function tow_excerpt($charlength) {
$excerpt = get_the_excerpt();
$charlength++;
if(strlen($excerpt)>$charlength) {
$subex = substr($excerpt,0,$charlength-5);
$exwords = explode(" ",$subex);
$excut = -(strlen($exwords[count($exwords)-1]));
if($excut<0) {
echo substr($subex,0,$excut);
} else {
echo $subex;
}
echo "[...]";
} else {
echo $excerpt;
}
}



function header_text($atts){
 	extract( shortcode_atts( array(
		'h2' => 'no foo',
		'p' => 'default bar',
		'no' => 'no'
	), $atts ) );

if ($no == "no") 

{

		$message =  '<div class="caption-slide"><div class=" header_manual" ><h2>'.$h2.'</h2>' ;
	$message .= '<p>' .$p. '</p></div></div>'; 
	

return $message;
}	

else

{

		$message =  '<div class="caption-slide"><div class="header_manual" ><h2>'.$h2.'</h2>' ;
	$message .= '<p>' .$p. '</p></div>'; 
	$message .= '<div class="buttons_manual"><div class="clearfix button"><a href="/gift-certificates" class="pull-left gift-certificates"></a><a href="/private-tours" class="pull-left private-tours"></a></div></div></div>';

return $message;
}	





}// End some_random_code()
 
add_shortcode( 'header_text', 'header_text' );










/*

<div class="tp-caption big_white fade start" data-x="704" data-y="8" data-speed="300" data-start="0" data-easing="easeOutExpo" style="-webkit-transform: scale(1, 1) rotate(0deg); font-size: 35px; padding: 2px 4px 0px; margin: 0px; border: 0px; line-height: 36px; white-space: nowrap; left: 704px; top: 8px; opacity: 0; visibility: hidden;"><h2>Explore the International Tastes of London</h2>
<p>Discover Soho - Eat, Drink, and enjoy a Cultural Walking Tour </p></div>

*/






?>

