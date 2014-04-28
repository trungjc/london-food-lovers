<?php

/* Template Name: food tour details */

$reviews = $wpdb->get_results("select * from feedbacks where status = 1 order by dateofmodification DESC limit 10");

?>
<script src='<?php echo home_url();?>/js/jquery.raty.js' type="text/javascript" language="javascript"></script>

<div class="page-tour-detail">
	<?php get_template_part('templates/content', 'page'); ?>

	<div class="tab-tour"><!-- Nav tabs -->
	    <ul class="nav nav-tabs">
	        <li class="active"><a href="#tour-detail" data-toggle="tab">TOUR DETAILS</a></li>
	        <li><a href="#ITINERARY" data-toggle="tab">ITINERARY</a></li>
	        <li><a href="#INCLUSIONS" data-toggle="tab">INCLUSIONS</a></li>
	        <li><a href="#REVIEWS" data-toggle="tab">REVIEWS</a></li>
	    </ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane active" id="tour-detail">
				<div class="row">
					<div class="col-sm-6 col-md-8 col-xs-12">
						<h4 style="color: #ee794d; font-size: 18px;">Soho International Food Tour</h4>
						<p>Our exploration will begin with a breakfast tasting, in a tucked-away, historic location. After a delicious start to the day, more tastings are to follow, as you enjoy a colorful walk through some of Soho’s oldest and most charming streets, eating your way from one interesting international destination to another. </p>
						<p>In addition to the many world foods, we will also enjoy some British delicacies at a famous English pub – one of the five oldest in London, and an exclusive tea lounge.</p>
						<p>Our tour also includes a trip through Chinatown on our way to the final destination – the place that inspired the creation of London Food Lovers – an old wine-bar in London.    </p>
						
						<h4 style="color: #ee794d; font-size: 18px;">Discover Soho</h4>
						<p>Soho, London’s premier neighborhood for entertainment, is filled with pubs, bakeries, bars, restaurants & coffee shops.  From the traditional to some of the newest fusions in the city, Soho is the place to learn about London’s incredible International Food scene. </p>
	    
						<p>Our 4.5-hour tour will start at the meeting point in Soho. After a brief introduction, you will begin your exploration of Soho with breakfast tasting, at an exclusive, little diner.  </p>
	
						<p>From there, you will wander down one historical street after another, stopping for a variety of delicious international food tastings as Italian, Indian, Chinese and Mexican food, along with  local food tastings in a famous English Pub – one of the five oldest in London, where you’ll sit back and relax with a traditional British ale-tasting accompanied by a tasting of their famous fish and chips and tastings different types of beer, while learning about the importance of pubs in British culture.</p>
	
						<p>After a very exclusive dessert in a secret location, it is time for the final tasting at an old underground bar London for an international wine tasting. </p>
	
						<h4 style="color: #ee794d; font-size: 18px;">Feel Like a Local</h4>
	
						<p>Our tour aims to give you the local feel of Soho and all it has to offer. Soho folklore is rich with colorful stories of writers, poets, artists and historical figures. Anyone can walk around Soho and enjoy the vibrant atmosphere, but we want to show you the layers underneath, that are not always visible to the eye.</p>
	
						<p>Our tour will take you through some of Soho’s most historically interesting streets, as we try a wide variety of International Foods from some of our favorite places. </p>
	
						<p>We don’t recommend eating much before this tour, as it fully includes breakfast, lunch and many tastes in between. </p>
	
						<h4 style="color: #ee794d; font-size: 18px;">Multi-Cultural Influences = Amazing International Cuisine</h4>
	
	                    <p>The Theme of our Soho Food tour is “International Foods”, because Soho is considered one of London’s oldest multicultural areas. From the time of its development in the late 1600s, the rich never looked upon Soho as favorably as the other luxury boroughs. Immigrants moved in, and Soho initially became known as London’s “French Quarter”. Most foreigners that came to London, found cheap housing in Soho, and brought with them their incredible cuisines. Amidst the music halls, small theatres and brothels, these immigrants opened up cheap “eating-houses” all over the neighborhood, making it the “in” place to eat for intellectuals, writers and artists, looking for delicious international cuisine.</p>
	                    
	                    <p>Your exploration of Soho will bring to life layer upon layer of Soho’s rich history, and highlight the cultures that have created so many of London’s diverse foods – often Soho being the first place to find them.</p>
					</div>
					<div class="col-sm-6 col-md-4 col-xs-12">
						<div class="panel panel-default orange">
							<div class="panel-heading center">
								<h3 style="font-size: 14px;">Tour Information</h3>
							</div>
							<div class="panel-body box-cal">
	    						<div><span> Price:</span> Adult (12+): £59 <span style="margin-left: 45px; display: block; color: rgb(51, 51, 51); line-height: 26px;"> Child (4-12): £39</span> </div>
								<div><span> Duration:</span> 4.5 hours</div>
								<div><span> Operating Days:</span> Mon-Sun</div>
								<div><span> Start Time:</span> 09:45 AM</div>
								<div><span> Food Tastings:</span> 10 </div>
								<div><span> Meeting Point: </span>Soho. Details provided upon booking.</div>
							</div>
						</div>
					</div>
	
	  				<div class="col-sm-6 col-md-4 col-xs-12">
	                    <div class="panel panel-default orange">
	                        <div class="panel-heading center">
	                            <h3 style="font-size:14px;">Tour Benefits</h3>
	                        </div>
	                        <div class="panel-body box-cal">
	                            <div >• Explore Soho, London’s oldest multi-cultural neighborhood, and discover exclusive places, unique stories, and incredible foods – all included in the price of the tour</div>
	
	                          <div> •   Get a taste of London’s Cosmopolitan food scene with an expert Food Guide, visiting some of Soho’s most unique venues, while enjoying 10 different tastings </div>
	
	                           <div>•   Feel like a local in your small group of no more than 12 people, having a relaxing day out with new friends.</div>
	                            
	                        </div>
	                     </div>
	                </div>
				</div>
			</div>
	
			<div class="tab-pane" id="ITINERARY">  
				<div class="row">
	                <div class="col-sm-6 col-md-8 col-xs-12">
	                    <h4 style="color: #ee794d; font-size: 18px;">Itinerary</h4>
	                    <p>Our 4.5-hour exploration of Soho will begin with a delicious breakfast tasting at a unique, little restaurant.</p>
	                    
	                    <p>From there, you will wander down one charming street after another, stopping for a variety of delicious international foods including Italian, Indian, Chinese and Mexican, along with local British food tastings in a famous English Pub – one of the five oldest in London, while learning about the importance of pubs in British culture. </p>
	                    
	                    <p>Then your tour tour guide will lead you through the bustling streets of Chinatown, as you head towards dessert.</p>
	                    
	                    <p>After enjoying some “well-needed” dessert in an exclusive Tea Lounge, you will head to London’s most historic wine bar for the grand finale – an international wine tasting.</p>
					</div>
					<div class="col-sm-6 col-md-4 col-xs-12">
	                    <div class="panel panel-default orange">
	                        <div class="panel-heading center">
	                        <h3 style="font-size: 14px;">Tour Information</h3>
	                        </div>
	                        <div class="panel-body box-cal">
	                            <div><span> Price:</span> Adult (12+): £59 <span style="margin-left: 45px; display: block; color: rgb(51, 51, 51); line-height: 26px;"> Child (4-12): £39</span> </div>
	                        <div><span> Duration:</span> 4.5 hours</div>
	                        <div><span> Operating Days:</span> Mon-Sun
	                        
	                        </div>
	                        <div><span> Start Time:</span> 09:45 AM</div>
	                        <div><span> Food Tastings:</span> Up to 12 </div>
	                        <div><span> Meeting Point: </span>Soho.
	                        
	                        	Details provided upon booking.</div>
	                    	</div>
						</div>
					</div>
				</div>
			</div> <!-- End Itinrary-->
	
			<div class="tab-pane" id="INCLUSIONS">
	            <div class="row">
	                <div class="col-sm-6 col-md-8 col-xs-12">
	                    <h4 style="color: #ee794d; font-size: 18px;">Inclusions</h4>
	                    <ul>
	                         <li>10 Delicious Tastings – in and around Soho </li>
	                        <li>  An expert Food Guide, who will bring you to a variety of Soho destinations, keeping you entertained as well as informed about food, cultures, and interesting historical anecdotes</li>
	                        <li>  Our official London Food Lovers “Best of London” Food Guide and map of Soho</li>
	                        <li>A British ale-tasting </li>
	                        <li> An International Wine tasting </li>
	                        <li> Exclusive access to number of Soho’s historical establishments </li>
	                    </ul>
					</div>
					<div class="col-sm-6 col-md-4 col-xs-12">
	                    <div class="panel panel-default orange">
	                    <div class="panel-heading center">
	                    <h3 style="font-size: 14px;">Inclusions</h3>
	                    </div>
	                    <div class="panel-body box-cal">
	                        <div><span> Price:</span> Adult (12+): £59 <span style="margin-left: 45px; display: block; color: rgb(51, 51, 51); line-height: 26px;"> Child (4-12): £39</span> </div>
	                    <div><span> Duration:</span> 4.5 hours</div>
	                    <div><span> Operating Days:</span> Mon-Sun
	                    
	                    </div>
	                    <div><span> Start Time:</span> 09:45 AM</div>
	                    <div><span> Food Tastings:</span> Up to 12 </div>
	                    <div><span> Meeting Point: </span>Soho.
	                    
	                    Details provided upon booking.</div>
	                    </div>
	                    </div>
					</div>
				</div>
			</div>
			
			<div class="tab-pane" id="REVIEWS">
	            <div class="page-corporate-column">
	                <?php get_template_part('templates/content', 'page'); ?>
	                <h3>Here are the latest reviews from our customers</h3>
	                
	                <?php foreach($reviews as $review):?>
	                		<div class="review-item hasArrow">
	                			<div class="panel panel-default ">
	                        		<div class="panel-body ">
	                        			<div class= "date"> <?php echo date('d M, Y',strtotime($review->tour_date));?> </div> 
	                        			<?php $review->tour_highlight = str_ireplace("\n","<br/>",$review->tour_highlight);?>
	                           			<span class="quote1">“</span><?php echo $review->tour_highlight;?><span class="quote1">”</span>
	                     			</div> 
	                    		</div>
	                			<div class="media">
	                    			<a class="pull-left" href="#">
	                    				<img src="<?php echo home_url();?>/cart/images/<?php echo $review->image;?>" alt="" class="img-rounded img-thumbnail" width="70">
	                    			</a>
	                    			<div class="media-body">
	                    				<div class="author"><?php echo $review->name .",". $review->country;?></div>
	                    				<div id="rate_<?php echo $review->id;?>"></div>
	                    			</div>
	                    		</div>
	                   		 </div>
	                   		 <script>jQuery('#rate_<?php echo $review->id;?>').raty({ readOnly: true , half: true , score: <?php echo $review->overall_rating;?> });</script>
	            	<?php endforeach;?>
			  </div>
	       </div> <!-- End tab panes-->
	   </div>
	</div>
</div>	