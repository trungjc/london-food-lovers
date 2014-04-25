<?php

include_once '../wp-load.php';

$_SESSION['data'] = $_POST;

$url = home_url()."/checkout-confirm/";
header("Location:$url");
exit;