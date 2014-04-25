<?php

/* Template Name: Success Order */

@session_start();

if(!$_SESSION['booking_message']){
	$url = home_url();
	echo "<script>window.location.href='$url';</script>";
	exit;
}

$message = $_SESSION['booking_message'];
?>
<div class="panel">
	<div class="panel-body">
		<div align="center">
        	<?php echo '<h2>' , $message, '</h2>'; ?>

			<p>You will now recieve an email with detailed instructions on what to do next. Please check your mail, if you cannot find it please check your spam box and if that doesn't do the trick email us at <em>info@londonfoodlovers.com</em> or call us <em>at 44 (777) 409 9306</em></p>
		</div>
	</div>	
</div>