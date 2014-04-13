<?php

header("content-type:text/html;charset=utf8");
include 'lib/foodloverstours.php';

$Booking = new Booking();

if(@$_GET['action']=='ajax' && isset($_GET['date'])){
	$type = @$_GET['type'];
	if($type == 'prev'){
		$m = ((int)$_GET['date']-1);
	}
	else{
		$m = ((int)$_GET['date']+1);
	}
	
	if($m < 10){
		$m = "0".$m;
	}
	
	$date = date("Y".$m."01");
	
	$availdates = $Booking->category_avail(1,$date);
	echo $m ."@@". $availdates['ui']['calendar'];
	exit;
}
else{
	$date = date('Ymd');
	$availdates = $Booking->category_avail(1,$date);
}

?>
<html>
 <head>	
	<link href="css/calender.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript">
	   function next(){
		   jQuery.ajax({
			   url:'calender.php?action=ajax',
			   data:{date:jQuery('#month').val(),type:'next'},
			   success:function(html){
				   parts = html.split("@@");
				   jQuery("#month").val(parts[0]);
				   jQuery("#calender").html(parts[1]);

				   jQuery(".cf-next").click(function(){
					   next();
				   });    

				   jQuery(".cf-prev").click(function(){	 
					   prev();
				   });
			   }
	   	    });
	   }

	   function prev(){
		   jQuery.ajax({
			   url:'calender.php?action=ajax',
			   data:{date:jQuery('#month').val(),type:'prev'},
			   success:function(html){
				   parts = html.split("@@");
				   jQuery("#month").val(parts[0]);
				   jQuery("#calender").html(parts[1]);

				   jQuery(".cf-next").click(function(){
					   next();
				   });    

				   jQuery(".cf-prev").click(function(){	 
					   prev();
				   });
			   }
		   });
	   }
	   
	   jQuery(document).ready(function(){	
		   jQuery(".cf-next").click(function(){
			   next();
		   });    

		   jQuery(".cf-prev").click(function(){	 
			   prev();
		   });

		   jQuery(".cf-cal-sm").find("a").click(function(){
			   val = this.href.split("#D");
			   alert(val[1]);
		   });
	   });
	</script>
</head>
<body>
	<input type="hidden" name="month" id="month" value="<?php echo date('m');?>" />
	<div id="calender"><?php echo $availdates['ui']['calendar'];?></div>
</body>
</html>