<?php
/**
 * Dashboard Administration Screen
 *
 * @package WordPress
 * @subpackage Administration
 */

/** Load WordPress Bootstrap */
require_once( dirname( __FILE__ ) . '/admin.php' );

/** Load WordPress dashboard API */
require_once(ABSPATH . 'wp-admin/includes/dashboard.php');

wp_dashboard_setup();

wp_enqueue_script( 'dashboard' );
if ( current_user_can( 'edit_theme_options' ) )
	wp_enqueue_script( 'customize-loader' );
if ( current_user_can( 'install_plugins' ) )
	wp_enqueue_script( 'plugin-install' );
if ( current_user_can( 'upload_files' ) )
	wp_enqueue_script( 'media-upload' );
add_thickbox();

if ( wp_is_mobile() )
	wp_enqueue_script( 'jquery-touch-punch' );

$title = __('Dashboard');
$parent_file = 'index.php';

$help = '<p>' . __( 'Welcome to your WordPress Dashboard! This is the screen you will see when you log in to your site, and gives you access to all the site management features of WordPress. You can get help for any screen by clicking the Help tab in the upper corner.' ) . '</p>';

// Not using chaining here, so as to be parseable by PHP4.
$screen = get_current_screen();

$screen->add_help_tab( array(
	'id'      => 'overview',
	'title'   => __( 'Overview' ),
	'content' => $help,
) );

// Help tabs

$help  = '<p>' . __( 'The left-hand navigation menu provides links to all of the WordPress administration screens, with submenu items displayed on hover. You can minimize this menu to a narrow icon strip by clicking on the Collapse Menu arrow at the bottom.' ) . '</p>';
$help .= '<p>' . __( 'Links in the Toolbar at the top of the screen connect your dashboard and the front end of your site, and provide access to your profile and helpful WordPress information.' ) . '</p>';

$screen->add_help_tab( array(
	'id'      => 'help-navigation',
	'title'   => __( 'Navigation' ),
	'content' => $help,
) );

$help  = '<p>' . __( 'You can use the following controls to arrange your Dashboard screen to suit your workflow. This is true on most other administration screens as well.' ) . '</p>';
$help .= '<p>' . __( '<strong>Screen Options</strong> - Use the Screen Options tab to choose which Dashboard boxes to show.' ) . '</p>';
$help .= '<p>' . __( '<strong>Drag and Drop</strong> - To rearrange the boxes, drag and drop by clicking on the title bar of the selected box and releasing when you see a gray dotted-line rectangle appear in the location you want to place the box.' ) . '</p>';
$help .= '<p>' . __( '<strong>Box Controls</strong> - Click the title bar of the box to expand or collapse it. In addition, some boxes have configurable content, and will show a &#8220;Configure&#8221; link in the title bar if you hover over it.' ) . '</p>';

$screen->add_help_tab( array(
	'id'      => 'help-layout',
	'title'   => __( 'Layout' ),
	'content' => $help,
) );

$help  = '<p>' . __( 'The boxes on your Dashboard screen are:' ) . '</p>';
if ( current_user_can( 'edit_posts' ) )
	$help .= '<p>' . __( '<strong>Site Content</strong> - Displays a summary of the content on your site and identifies which theme and version of WordPress you are using.' ) . '</p>';
$help .= '<p>' . __( '<strong>Activity</strong> - Shows the upcoming scheduled posts, recently published posts, and the most recent comments on your posts and allows you to moderate them.' ) . '</p>';
if ( is_blog_admin() && current_user_can( 'edit_posts' ) )
	$help .= '<p>' . __( "<strong>Quick Draft</strong> - Allows you to create a new post and save it as a draft. Also displays links to the 5 most recent draft posts you've started." ) . '</p>';
if ( ! is_multisite() && current_user_can( 'install_plugins' ) )
	$help .= '<p>' . __( '<strong>WordPress News</strong> - Latest news from the official WordPress project, the <a href="http://planet.wordpress.org/">WordPress Planet</a>, and popular and recent plugins.' ) . '</p>';
else
	$help .= '<p>' . __( '<strong>WordPress News</strong> - Latest news from the official WordPress project, the <a href="http://planet.wordpress.org/">WordPress Planet</a>.' ) . '</p>';
if ( current_user_can( 'edit_theme_options' ) )
	$help .= '<p>' . __( '<strong>Welcome</strong> - Shows links for some of the most common tasks when setting up a new site.' ) . '</p>';

$screen->add_help_tab( array(
	'id'      => 'help-content',
	'title'   => __( 'Content' ),
	'content' => $help,
) );

unset( $help );

$screen->set_help_sidebar(
	'<p><strong>' . __( 'For more information:' ) . '</strong></p>' .
	'<p>' . __( '<a href="http://codex.wordpress.org/Dashboard_Screen" target="_blank">Documentation on Dashboard</a>' ) . '</p>' .
	'<p>' . __( '<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>' ) . '</p>'
);

include( ABSPATH . 'wp-admin/admin-header.php' );
?>
<?php 

$review_id = (int)$_GET['id'];
if(!$review_id){
    $url = home_url(). "/wp-admin/reviews.php";
    echo "<script>window.location.href='$url';</script>";
    exit;
}

if($_POST['submitfeedback']){
    $data = $_POST;
    unset($data['submitfeedback']);
    
    $image_name = $order_id."_".time().".jpg";
	$save_path  = $_SERVER['DOCUMENT_ROOT'] . "/cart/images/".$image_name;
	if($_FILES['image']['tmp_name'] AND move_uploaded_file($_FILES['image']['tmp_name'],$save_path)){
		$data['image'] = $image_name;
	}
	else{
	    unset($data['image']);
	}
    
    $extra_str = '';
	foreach($data as $k => $v) {
	    $extra_str .= ($extra_str ? ", " : "") . $k . "='" . $v . "'";
	}
	
	mysql_query("Update feedbacks SET $extra_str where id = '$review_id'") or die(mysql_error());
	
	$url = home_url(). "/wp-admin/reviews.php";
    echo "<script>window.location.href='$url';</script>";
    exit;
}

$query  = "Select f.* , c.name as category_name from feedbacks f left join categories c on (c.category_id = f.category_id) where f.id = '$review_id'";
$review = $wpdb->get_row($query);

?>
<script src='<?php echo home_url();?>/js/jquery.MetaData.js' type="text/javascript" language="javascript"></script>
<script src='<?php echo home_url();?>/js/jquery.rating.js' type="text/javascript" language="javascript"></script>
<link href='<?php echo home_url();?>/js/jquery.rating.css' type="text/css" rel="stylesheet"/>
<script>
  jQuery(function() {
	  jQuery('input.star').rating();
  });
</script>

<div class="wrap" align="center">
	<h2>Edit Review</h2>
	
	<form method="post" name="feedback" id="feedback" action="reviews_edit.php?id=<?php echo $review->id;?>" enctype="multipart/form-data">
    	<table width="70%" cellpadding="5" cellspacing="10">
    		<tr>
    			<td>Customer Name</td>
    			<td><?php echo $review->name;?></td>
    		</tr>
    		
    		<tr>
    			<td>Tour Date</td>
    			<td><?php echo $review->tour_date;?></td>
    		</tr>
    		
    		<tr>
    			<td>Overall experience:</td>
    			<td>
    				<input class="star" type="radio" name="overall_rating" value="1" <?php if($review->overall_rating == 1):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="overall_rating" value="2" <?php if($review->overall_rating == 2):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="overall_rating" value="3" <?php if($review->overall_rating == 3):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="overall_rating" value="4" <?php if($review->overall_rating == 4):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="overall_rating" value="5" <?php if($review->overall_rating == 5):?> checked="checked" <?php endif;?> />
    			</td>
    		</tr>
    		
    		<tr>
    			<td>What was the highlight of the tour for you?</td>
    			<td><textarea rows="3" cols="40" name="tour_highlight" style="resize:none;"><?php echo $review->tour_highlight;?></textarea></td>
    		</tr>
    		
    		 <tr>
             	 <td colspan="2"><h3>Please tell us about your tour guide...</h3></td>
             </tr>
	             
    		<tr>
    			<td>Cultural and culinary expertise</td>
    			<td>
    				<input class="star" type="radio" name="cultural_expertise" value="1" <?php if($review->cultural_expertise == 1):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="cultural_expertise" value="2" <?php if($review->cultural_expertise == 2):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="cultural_expertise" value="3" <?php if($review->cultural_expertise == 3):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="cultural_expertise" value="4" <?php if($review->cultural_expertise == 4):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="cultural_expertise" value="5" <?php if($review->cultural_expertise == 5):?> checked="checked" <?php endif;?> />
    			</td>
    		</tr>
    		
    		<tr>
    			<td>Communication skills</td>
    			<td>
    				<input class="star" type="radio" name="comm_skills" value="1" <?php if($review->comm_skills == 1):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="comm_skills" value="2" <?php if($review->comm_skills == 2):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="comm_skills" value="3" <?php if($review->comm_skills == 3):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="comm_skills" value="4" <?php if($review->comm_skills == 4):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="comm_skills" value="5" <?php if($review->comm_skills == 5):?> checked="checked" <?php endif;?> />
    			</td>
    		</tr>
    		
    		<tr>
    			<td>Professionalism</td>
    			<td>
    				<input class="star" type="radio" name="professionalism" value="1" <?php if($review->professionalism == 1):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="professionalism" value="2" <?php if($review->professionalism == 2):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="professionalism" value="3" <?php if($review->professionalism == 3):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="professionalism" value="4" <?php if($review->professionalism == 4):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="professionalism" value="5" <?php if($review->professionalism == 5):?> checked="checked" <?php endif;?> />
    			</td>
    		</tr>
    		
    		<tr>
    			<td>Organizational abilities</td>
    			<td>
    				<input class="star" type="radio" name="org_abilities" value="1" <?php if($review->org_abilities == 1):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="org_abilities" value="2" <?php if($review->org_abilities == 2):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="org_abilities" value="3" <?php if($review->org_abilities == 3):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="org_abilities" value="4" <?php if($review->org_abilities == 4):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="org_abilities" value="5" <?php if($review->org_abilities == 5):?> checked="checked" <?php endif;?> />
    			</td>
    		</tr>
    		
    		<tr>
    			<td>X factor finalist chances</td>
    			<td>
    				<input class="star" type="radio" name="x_factor" value="1" <?php if($review->x_factor == 1):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="x_factor" value="2" <?php if($review->x_factor == 2):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="x_factor" value="3" <?php if($review->x_factor == 3):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="x_factor" value="4" <?php if($review->x_factor == 4):?> checked="checked" <?php endif;?> />
             		<input class="star" type="radio" name="x_factor" value="5" <?php if($review->x_factor == 5):?> checked="checked" <?php endif;?> />
    			</td>
    		</tr>
    		
    		<tr>
             	 <td>
             	 	Your Picture
             	 </td>
             	 <td>
             	 	<input type="file" name="image" value="" />
             	 	
             	 	<img src="<?php echo home_url(). "/cart/images/". $review->image;?>" width="100" height="100" />
             	 </td>
             </tr>
	             
    		 <tr>
             	 <td colspan="2"><h3>Your opinion of the level of physical activity on the tour:</h3></td>
             </tr>
             
             <tr>
             	<td colspan="2"><input type="checkbox" id="" name="too_little" value="1" <?php if($review->too_little == 1):?> checked="checked" <?php endif;?> /> Too little</td>
             </tr>
             
             <tr>
             	<td colspan="2"><input type="checkbox" id="" name="just_right" value="1" <?php if($review->just_right == 1):?> checked="checked" <?php endif;?> /> Just right</td>
             </tr>
             
             <tr>
             	<td colspan="2"><input type="checkbox" id="" name="feel_feet" value="1" <?php if($review->feel_feet == 1):?> checked="checked" <?php endif;?> /> I can still feel my feet</td>
             </tr>
             
             <tr>
             	<td colspan="2"><input type="checkbox" id="" name="last_stop" value="1" <?php if($review->last_stop == 1):?> checked="checked" <?php endif;?> /> can't feel my feet but the last stop definitely helped</td>
             </tr>
             
             <tr>
             	<td colspan="2"><input type="checkbox" id="" name="walk_more" value="1" <?php if($review->walk_more == 1):?> checked="checked" <?php endif;?> /> I-would-walk-a-thousand-miles-AND-I-would-walk-a-thousand-more..!!!</td>
             </tr>
             
             <tr>
             	 <td colspan="2"><h3>...and how about 2 more minutes to make it UNIQUE?</h3></td>
             </tr>
             
             <tr>
         		<td>Comments/ suggestions / unreserved praise:</td>
         		<td>
         			<textarea rows="3" cols="60" name="comments" style="resize:none;"><?php echo $review->comments?></textarea>
         		</td>
             </tr>
             
             <tr>
             	 <td colspan="2"><h3>May we use your comments on our website?</h3></td>
             </tr>
             
             <tr>
             	<td colspan="2">
             		<input type="checkbox" id="" name="elegant_name" value="1" <?php if($review->elegant_name == 1):?> checked="checked" <?php endif;?> /> My name Does look elegant in print...
             		<input type="checkbox" id="" name="use_no" value="1" <?php if($review->use_no == 1):?> checked="checked" <?php endif;?> /> No
             	</td>
             </tr>
             
             <tr>
             	 <td colspan="2"><h3>May we contact you with info on future tours/ promotions?</h3></td>
             </tr>
             
             <tr>
             	<td colspan="2">
             		<input type="checkbox" id="" name="contact_abs" value="1" <?php if($review->contact_abs == 1):?> checked="checked" <?php endif;?> /> Absolutely
             		<input type="checkbox" id="" name="contact_no" value="1" <?php if($review->contact_no == 1):?> checked="checked" <?php endif;?> /> No <br />
             		(We don't spam or sell/share info with Anyone)
             	</td>
             </tr>
             
             <tr>
             	 <td colspan="2"><h3>Where did you hear about us?</h3></td>
             </tr>
             
             <tr>
             	<td colspan="2">
             		<input type="checkbox" id="" name="hear_us_referral" value="1" <?php if($review->hear_us_referral == 1):?> checked="checked" <?php endif;?> /> Referral
             		<input type="checkbox" id="" name="hear_us_google" value="1" <?php if($review->hear_us_google == 1):?> checked="checked" <?php endif;?> /> Google 
             		<input type="checkbox" id="" name="hear_us_blog" value="1" <?php if($review->hear_us_blog == 1):?> checked="checked" <?php endif;?> /> Blog 
             		<input type="checkbox" id="" name="hear_us_trip_advisor" value="1" <?php if($review->hear_us_trip_advisor == 1):?> checked="checked" <?php endif;?> /> Trip advisor 
             		<input type="checkbox" id="" name="hear_us_other" value="1" <?php if($review->hear_us_other == 1):?> checked="checked" <?php endif;?> /> Other 
             		<input type="text" name="hear_other" value="<?php echo $review->hear_other;?>" />
             	</td>
             </tr>
             
             <tr>
                 <td colspan="2" align="center">
                 	<br />
                 	<input type="submit" name="submitfeedback" class="btn btn-orange btn-md" value="Submit Feedback" />
                 </td>
             </tr>
    	</table>
    </form>	
</div>
<!-- wrap -->

<?php
require( ABSPATH . 'wp-admin/admin-footer.php' );
