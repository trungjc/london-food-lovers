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

<div class=" form-search">
    <div class="panel panel-default">
      <div class="panel-headings center"><h3>Book A Tour</h3></div>
      <div class="panel-body">

            <div class="form-groups">
                    <div class="form-group">				  
                      <select class="form-control">
                            <option value="pizza">
                              Sushi Tour
                            </option>
                            <option value="salad">
                              Salad Tour
                            </option>
                            <option value="pizzasalad">
                              Pizza and Salad
                            </option>
                      </select>
                    </div>
                    <div class="form-group">
                      <div class=" date-time">
                            <select class="">
                                    <option value="pizza">
                                      year
                                    </option>
                              </select>
                              <select class=" ">
                                    <option value="pizza">
                                      moth
                                    </option>
                              </select>
                              <select class=" ">
                                    <option value="pizza">
                                      day
                                    </option>
                              </select>
                      </div>

                    </div>
                    <div class="form-group">				  
                      <select class="form-control">
                            <option value="pizza">
                              Sushi Tour
                            </option>
                            <option value="salad">
                              Salad Tour
                            </option>
                            <option value="pizzasalad">
                              Pizza and Salad
                            </option>
                      </select>
                    </div>
              <div class="form-group">
                      <div class=" date-time">
                            <select class="">
                                    <option value="pizza">
                                     1
                                    </option>
                              </select>
                              &nbsp;&nbsp;&nbsp;<span class="label-option">ADULTS (19+)</span>&nbsp;&nbsp;&nbsp;
                              <select class=" ">
                                    <option value="pizza">
                                      0
                                    </option>
                              </select>
                              &nbsp;&nbsp;&nbsp;<span class="label-option">KIDS</span>&nbsp;&nbsp;&nbsp;
                      </div>				  
                    </div>
                    <hr>
              <div class="form-group center">

                    <a id="" href="#">ENTER PROMOTION CODE</a>
              </div>
              <div class="center"><a class="btn btn-orange btn-md" href="#">Book Now</a></div>

            </div>
      </div>
    </div>  
</div>

<?php
elseif ( is_page('new-page') ) :   
  dynamic_sidebar('sidebar-new');
else:   
  //dynamic_sidebar('sidebar-primary');
endif;  
  dynamic_sidebar('sidebar-primary');
?>
