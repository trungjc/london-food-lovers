<?php

/* Template Name: Success Order */

session_start();

if(!$_SESSION['message']){
	$url = home_url();
	echo "<script>window.location.href='$url';</script>";
	exit;
}

$message = $_SESSION['message'];

?>
<div align="center">
    <?php if($error):?>
    
    	<p><?php echo $message;?></p>
    <?php else:?>
    
        <p><?php echo $message;?></p>
        
        <h6>Many thanks for your business and trust.</h6>
        
    <?php endif;?>
</div>