<?php

header("content-type:text/html;charset=utf8");
include_once '../wp-load.php';

include 'lib/foodloverstours.php';
$Booking = new Booking();

if(@$_GET['action']=='changedate'){
    $date = $_GET['tour_year']."-".$_GET['tour_month']."-".$_GET['tour_date'];
    $tour_date = date('Y-m-d' , strtotime($date));
    $item_id = (int)$_GET['item_id'];

    $items = $Booking->query_inventory(array(
					'category_id' => $_GET['category_id'],
				    'start_date'  => $tour_date,
					'item_id'   => $item_id,
					'available' => 1,
				    'param'  => array(
						'adults' => $_GET['adults'],
						'children' => $_GET['children']
                    )
            )
    );

    if($items[$item_id]){
        $_SESSION['cart']['tour_year'] = $_GET['tour_year'];
        $_SESSION['cart']['tour_month'] = $_GET['tour_month'];
        $_SESSION['cart']['tour_date'] = $_GET['tour_date'];
    
        echo "Yes";
    }
    else{
        echo "No";
    }
}
else{
    echo "No";
}