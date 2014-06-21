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

if($_GET['action'] == 'delete' && $_GET['id']){
    mysql_query("delete from orders where id = '".(int)$_REQUEST['id']."'") or die(mysql_error());
    
    $_SESSION['message'] = 'Order is deleted successfully';
}
elseif($_GET['action'] == 'refund' && $_GET['id']){
	require_once '../cart/authnet/AuthorizeNet.php';
	
	define("AUTHORIZENET_API_LOGIN_ID", "4za9QX58");
	define("AUTHORIZENET_TRANSACTION_KEY", "43Hgk84e3C2gSDqH");
	define("AUTHORIZENET_SANDBOX", false);
	
	$order = $wpdb->get_row("select * from orders where id = '".(int)$_REQUEST['id']."'");
	if($order && $order->transaction_id){
		$auth = new AuthorizeNetAIM;
		$response = $auth->void($order->transaction_id);
	}
	
	$data = array($order , $response);
	file_put_contents("../cart/refundlogs.txt",print_r($data,true) , FILE_APPEND);
	
	if($response->approved){
		mysql_query("update orders SET status = 'refunded' where id = '".(int)$_REQUEST['id']."'") or die(mysql_error());
		$_SESSION['message'] = 'Order status is changed to refunded.';
	}
	else{
		$_SESSION['message'] = 'Order status refund fail because '. $response->response_reason_text;
	}
}

if($_REQUEST['action']){
    $url = home_url(). "/wp-admin/orders.php";
    wp_redirect($url);
    exit;
}

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

include_once '../cart/split_page_results.php';
global $wpdb;

$page = (int)$_GET['p'];
if(!$page){
    $page = 1;
}

$query = "Select * from orders order by order_date desc";

$split_page = new splitPageResults($query , 20 , 'orders.php' , $page);
$orders = $wpdb->get_results($split_page->sql_query);

?>
<div class="wrap">
	<h2>Manage Orders</h2> <br />
	
	<div align="center" style="color:red;"><?php echo @$_SESSION['message']; unset($_SESSION['message']);?></div>
	
    <table border="1" width="100%" cellpadding="5" cellspacing="0">
    	<tr>
    		<td>Order ID</td>
    		<td>Trans ID</td>
    		<td>Customer Name</td>
    		<td>Email</td>
    		<td>Date</td>
    		<td>Phone</td>
    		<td>Status</td>
    		<td>Action</td>
    	</tr>
    	<?php foreach($orders as $order):?>
    		<tr>
    			<td><a target="_blank" href="https://foodloverstours.checkfront.co.uk/booking/<?php echo $order->order_id;?>"><?php echo $order->order_id;?></a></td>
    			
    			<td><?php echo $order->transaction_id;?></td>
    			
        		<td><?php echo $order->customer_name;?></td>
        		
        		<td><?php echo $order->email;?></td>
        		
        		<td><?php echo $order->order_date;?></td>
        		
        		<td><?php echo $order->phone;?></td>
        		
        		<td>
        		   <?php echo $order->status;?>
        		</td>
        		
        		<td>
        			<?php if($order->status != 'refunded'):?>
        			
        				<a href="orders.php?id=<?php echo $order->id?>&action=refund" onclick="if(!confirm('Are you sure? You can not redo this action.')){ return false;}">Refund</a> |
        			
        			<?php endif;?>	
        			
        		    <a href="orders.php?id=<?php echo $order->id?>&action=delete" onclick="if(!confirm('Are you sure? You want to delete this order.')){ return false;}">Delete</a>
        		</td>
        	</tr>
    	<?php endforeach;?>
    	
    	<tr>
    		<td colspan="3"><?php echo $split_page->display_count('Displaying %s to %s (of %s Records)');?></td>
    		
    		<td colspan="6"><?php echo $split_page->display_links(5);?></td>
    	</tr>
    </table>

</div><!-- wrap -->

<?php
require( ABSPATH . 'wp-admin/admin-footer.php' );
