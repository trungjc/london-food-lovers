<?php if ( is_page('corporate-tours') || is_page('private-tours') ) :    
  //dynamic_sidebar('private-tours'); 
?>
<div class="form-request">
    <div class="panel panel-default orange  ">
        <div class="panel-heading "><h3 style="font-size: 16px">SUBMIT A REQUEST FORM</h3></div>
            <div class="panel-body">				
                <div class="form-group">
                        <div class="form-group">
                             <input type="text" class="form-control" id="inputEmail3" placeholder="First Name">
                        </div>
                        <div class="form-group">
                              <input type="text" class="form-control" id="inputEmail3" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                             <input type="text" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                        <div class="form-group">
                             <input type="text" class="form-control" id="inputEmail3" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                             <textarea class="form-control"></textarea>
                       </div>
                       <div class="form-group">
                            <div class="  row">
                                <div class="col-md-7 col-xs-12">
                                    <select class="select-small ">
                                        <option value="pizza"> 0</option>
                                    </select >
                                    <span class="label-option"  style="font-size:10px">ADULTS(19+)</span>
                                </div>

                                <div class="col-md-5 col-xs-12">
                                    <select class="select-small ">
                                        <option value="pizza"> 0</option>
                                    </select >
                                    <span class="label-option"  style="font-size:11px">KIDS</span>
                                </div>
                            </div>
                        </div>
                        <div class="center"><a class="btn btn-black btn-md" href="#">&nbsp;&nbsp;BOOK NOW&nbsp;&nbsp;</a></div>
                </div>
          </div>
    </div>  <!--end--form-search-->
</div>
<?php
    
elseif ( is_page('checkout') ) :  ?>

<?php  require_once locate_template('form-book-tour.php');       ?>

<?php
elseif ( is_page('new-page') ) :   
  dynamic_sidebar('sidebar-new');
else:   
  //dynamic_sidebar('sidebar-primary');
endif;  
  dynamic_sidebar('sidebar-primary');
?>