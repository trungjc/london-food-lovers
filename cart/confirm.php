<?php

//include_once '../wp-load.php';

include_once '/nas/wp/www/cluster-2188/foodloverstour/wp-load.php';

$_SESSION['data'] = $_POST;

$url = home_url()."/checkout-confirm/";
header("Location:$url");
exit;