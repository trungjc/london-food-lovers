<?php

header("content-type:text/html;charset=utf8");
include_once '../wp-load.php';

include 'lib/foodloverstours.php';
$Booking = new Booking();

if(@$_GET['category_id'] && @$_GET['action']=='items'){
	$date = date('Ymd');
	$availdates = $Booking->category_avail($_GET['category_id'],$date);
	
	$items = $Booking->query_items(
			array(
				'category_id' => $_GET['category_id'],
			)
	);

	if(count($items)){
		$items_str = '<select class="form-control" name="item_id" id="item_id">';
		$items_str .= '<option value="">Select Tour</option>';
		foreach($items as $item_id => $item) {
			$items_str .= '<option value="'.$item_id.'">'.$item['name'].'</option>';
		}
		$items_str .= '</select>';
		print $availdates['ui']['calendar'] ."@@@". $items_str;
	}
}
elseif(@$_GET['action']=='items'){
	$items_str = '<select class="form-control" name="item_id">';
	$items_str .= '<option value="">Select Tour</option>';
	$items_str .= '</select>';
	print $items_str;
}
elseif(@$_GET['item_id'] && @$_GET['action']=='avails'){
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
		echo "Yes";
	}
	else{
		echo "No";
	}
}