<?php

include_once '../wp-load.php';

include_once 'func.php';
include 'lib/foodloverstours.php';

$_SESSION['data'] = $_POST;

$url = home_url()."/checkout-confirm/";
header("Location:$url");
exit;