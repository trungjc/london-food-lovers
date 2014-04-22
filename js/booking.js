function getTours(cid){
    url = host_path + '/cart/request.php?action=items&category_id='+cid;
	jQuery.ajax({
       url: url,
       success:function(data){
           parts = data.split("@@@");
           jQuery("#calender").html(parts[0]);
           jQuery("#itemsDiv").html(parts[1]);
           bindCalenderEvent();
           jQuery("#item_id").prop("selectedIndex",1);
	   },
	   error:function(error){
		   //alert(error);
	   }
	});
}

function checkavail(){
    jQuery("#booknow").val("Please wait...");
    
	url = host_path + '/cart/request.php?action=avails';
	jQuery.ajax({
       url: url,
       data: { 
           item_id : jQuery('#item_id').val() , 
           category_id : jQuery('#category_id').val() , 
           tour_year  : jQuery('#tour_year').val() , 
           tour_month : jQuery('#tour_month').val() , 
           tour_date  : jQuery('#tour_date').val() , 
           adults : jQuery('#adults').val() ,
           children : jQuery('#children').val() 
       },
       success:function(html){
           if(html == 'Yes'){
               document.forms['booking'].submit();
           }
           else{
        	   alert("This Tour is not available on selected date or qty");
        	   return false; 
           }
	   },
	   error:function(error){
		   //alert(error);
	   }
	});

	jQuery("#booknow").val("Book Now");
	return false; 
}

function filldate(date){
    jQuery("#tour_year").val(date.substring(0,4));
    jQuery("#tour_month").val(date.substring(4,6));
    jQuery("#tour_date").val(date.substring(6));
    jQuery("#calender").hide();
}

function bindCalenderEvent(){
    jQuery(".cf-next").click(function(){
	   next();
    });    

   jQuery(".cf-prev").click(function(){	 
	   prev();
   });

   jQuery(".cf-cal-sm").find("a").click(function(){
	   parentClass = jQuery(this).parent().attr('class');
	   if(parentClass == 'X'){
		   return false;
	   }
	   
	   if(jQuery(this).attr('class') != 'cf-next' && jQuery(this).attr('class') != 'cf-prev'){
	   	  val = this.href.split("#D");
	   	  filldate(val[1]);
	   }
   });
}

function next(){
   jQuery.ajax({
	   url: host_path + '/cart/calender.php?action=ajax',
	   data:{date:jQuery('#month').val(),type:'next'},
	   success:function(html){
		   parts = html.split("@@");
		   jQuery("#month").val(parts[0]);
		   jQuery("#calender").html(parts[1]);
		   bindCalenderEvent();
		}
	});
}

function prev(){
   jQuery.ajax({
	   url:'cart/calender.php?action=ajax',
	   data:{date:jQuery('#month').val(),type:'prev'},
	   success:function(html){
		   parts = html.split("@@");
		   jQuery("#month").val(parts[0]);
		   jQuery("#calender").html(parts[1]);
		   bindCalenderEvent();
	   }
   });
}

function phoneFix(){
	phone = jQuery("#customer_phone").val();
	phone = phone.replace(/\s+/g, ""); 
	phone = phone.replace(/\-/g, ""); 
	phone = phone.replace(/[a-zA-Z]/g, ""); 
	
	formatted = phone.substr(0, 3) + '-' + phone.substr(3, 3) + '-' + phone.substr(6,4);
	jQuery("#customer_phone").val(formatted);
}

function validateForm(){
    if(!jQuery('#customer_name').val()){
        alert('Please enter name');
        jQuery('#customer_name').focus();
        return false;
    }

    if(!jQuery('#customer_email').val()){
        alert('Please enter email');
        jQuery('#customer_email').focus();
        return false;
    }

    if(!jQuery('#customer_phone').val()){
        alert('Please enter phone number');
        jQuery('#customer_phone').focus();
        return false;
    }

    if(!jQuery('#customer_address').val()){
        alert('Please enter address');
        jQuery('#customer_address').focus();
        return false;
    }

    if(!jQuery('#customer_city').val()){
        alert('Please enter city');
        jQuery('#customer_city').focus();
        return false;
    }
    
    if(!jQuery('#customer_region').val()){
        alert('Please enter state');
        jQuery('#customer_region').focus();
        return false;
    }

    if(!jQuery('#customer_postal_zip').val()){
        alert('Please enter zipcode');
        jQuery('#customer_postal_zip').focus();
        return false;
    }

    if(!jQuery('#card_number').val() || jQuery('#card_number').val().length != 16){
        alert('Please enter valid card number');
        jQuery('#card_number').focus();
        return false;
    }

    if(!jQuery('#cvv').val()){
        alert('Please enter cvv');
        jQuery('#cvv').focus();
        return false;
    }

    if(!jQuery('#terms').is(":checked")){
    	alert('Please select checkbox of terms and conditions');
        jQuery('#terms').focus();
        return false;
    }

	return true;
}