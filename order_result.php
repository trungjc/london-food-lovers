<?php

include_once 'wp-load.php';

if(!session_id()){
	session_start();
}

if(!$_SESSION['booking_message']){
	$url = home_url();
	echo "<script>window.location.href='$url';</script>";
	exit;
}

$message = $_SESSION['booking_message'];
?>
<!DOCTYPE html>
<html class="no-js" lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>London Food Lovers - Food &amp; Wine Tours in the Soho Neighborhood</title>

    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">

  
<!-- This site is optimized with the Yoast WordPress SEO plugin v1.5.2.7 - https://yoast.com/wordpress/plugins/seo/ -->
<meta name="description" content="Explore the International Tastes of London - Eat, Drink, and enjoy a Cultural Walking Tour in Small Groups. Book Online or Call Now: +44 (0) 777 409 9306"/>
<link rel="canonical" href="https://londonfoodlovers.com/" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="London Food Lovers - Food &amp; Wine Tours in the Soho Neighborhood" />
<meta property="og:description" content="Explore the International Tastes of London - Eat, Drink, and enjoy a Cultural Walking Tour in Small Groups. Book Online or Call Now: +44 (0) 777 409 9306" />
<meta property="og:url" content="https://londonfoodlovers.com/" />
<meta property="og:site_name" content="London Food Lovers - Food and Wine Tours" />
<!-- / Yoast WordPress SEO plugin. -->

<link rel="stylesheet" href="/wp-content/plugins/sp-faq/css/jqueryuicss.css?ver=3.9">
<link rel="stylesheet" href="/wp-content/plugins/revslider/rs-plugin/css/settings.css?ver=3.9">
<link rel="stylesheet" href="/wp-content/plugins/revslider/rs-plugin/css/captions.css?ver=3.9">
<link rel="stylesheet" href="/wp-content/themes/roots-master/assets/css/main.min.css?ver=9880649384aea9f1ee166331c0a30daa">
<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
<script>window.jQuery || document.write('<script src="https://londonfoodlovers.com/wp-content/themes/roots-master/assets/js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
<script type='text/javascript' src='/wp-content/plugins/sp-faq/js/jqueryuijs.js?ver=3.9'></script>
<script type='text/javascript' src='/wp-content/plugins/revslider/rs-plugin/js/jquery.themepunch.plugins.min.js?ver=3.9'></script>
<script type='text/javascript' src='/wp-content/plugins/revslider/rs-plugin/js/jquery.themepunch.revolution.min.js?ver=3.9'></script>
<script type='text/javascript' src='/wp-content/themes/roots-master/assets/js/vendor/modernizr-2.7.0.min.js'></script>
<link rel="stylesheet" type="text/css" href="//cloud.typography.com/7329292/732424/css/fonts.css" />
  <link rel="alternate" type="application/rss+xml" title="London Food Lovers - Food and Wine Tours Feed" href="https://londonfoodlovers.com/feed/">
<link rel="stylesheet" type="text/css" href="https://londonfoodlovers.com/wp-content/themes/roots-master/assets/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="https://londonfoodlovers.com/wp-content/themes/roots-master/assets/css/ui.css" media="screen" />


<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-49895740-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body class="home page logged-in">

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.    </div>
  <![endif]-->

  <header class="banner navbar navbar-default  navbar-fixed-topa navbar-inverse" role="banner">
  <div class="container">
   <div class="col-md-3 col-xs-12 hidden-xs">
       <a class="logo" href="../"><img src="https://londonfoodlovers.com/wp-content/themes/roots-master/assets/images/logo.png"  alt="London Food Lovers &#8211; Food and Wine Tours"  /></a>

    </div>
      <div class="col-md-9 col-xs-12 ">
            <div class="clearfix top-menu">
                    <div class="pull-right">
                        <a class="phone-number" ><span class="glyphicon glyphicon-earphone"></span>+44 (0)7884 852 151 </a>
                       <a href="/london-food-tour-gift-certificate"><strong>Gift Certificates</strong></a>
                          
                            <a href="/FAQ"><strong>FAQ</strong></a>
                            <a href="http://londonfoodlovers.com/blog"><strong>Blog</strong></a>
                          <!--  <a class="SocIcon twitter-b" href="">twitter</a>
                            <a class="SocIcon facebook" href="">facebook</a> -->
                         
                    </div>					
            </div>
          <div class="clearfix header-bottom">
              <div class="navbar-header">
                      <a class="logo visible-xs" href="https://londonfoodlovers.com/"><img src="https://londonfoodlovers.com/wp-content/themes/roots-master/assets/images/logo.png" alt="London Food Lovers &#8211; Food and Wine Tours"  /></a>
           
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                 </div>
              <nav class="collapse navbar-collapse" role="navigation">
                <ul id="menu-primary-navigation" class="nav navbar-nav"><li class="active menu-home"><a href="/">home</a></li>
<li class="dropdown menu-food-tours"><a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="/soho-food-tour/">Food Tours <b class="caret"></b></a>
<ul class="dropdown-menu">
	<li class="menu-soho-food-tour"><a href="/soho-food-tour/">Soho Food Tour</a></li>
	<li class="menu-corporate-tours"><a href="/london-corporate-food-tours/">Corporate Tours</a></li>
	<li class="menu-private-tours"><a href="/london-private-food-tours/">Private Tours</a></li>
</ul>
</li>
<li class="menu-why-us"><a href="/why-london-food-lovers-tours/">Why us</a></li>
<li class="menu-reviews"><a href="/reviews/">Reviews</a></li>
<li class="menu-contact"><a href="/contact-us/">contact</a></li>
<li class="menu-book-now"><a href="/soho-food-tour/">Book Now</a></li>
</ul>              </nav>
          </div>
      </div>
  </div>
</header>  
  <script type="text/javascript" src="https://londonfoodlovers.com/js/booking.js"></script>
  <link href="https://londonfoodlovers.com/css/calender.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript">
  		host_path = 'https://londonfoodlovers.com';
  </script>

  <div class="home-section">
          
       </div>

  <div class="wrap container" role="document">
    <div class="content row">      
	 <div class="panel">
		<div class="panel-body">
			<div align="center" style="padding:20px;">
				<br /><br /><br />
	        	<?php echo '<h2>' , $message, '</h2>'; ?>
	
				<p>You will now recieve an email with detailed instructions on what to do next. Please check your mail, if you cannot find it please check your spam box and if that doesn't do the trick email us at <em>info@londonfoodlovers.com</em> or call us <em>at +44 (0)7884 852 151</em></p>
				
				<br /><br />
			</div>
		</div>	
	</div>
    </div><!-- /.content -->
  </div><!-- /.wrap -->

   <div class="pre-footer trungjc edit ">
    <div class="container">
       
    </div>
</div>

<div class="newletter">
    <div class="container">
        <div class="newletter-inner">
            <form method="post" name="newletter2" action="https://londonfoodlovers.com/cart/newsletter.php">
                 Find the best restaurant reviews and most unique places in London
                 <input type="text" placeholder="enter your email" name="email" class="form-control" />
                 <input type="submit" value="submit" name="newslettersubmit" class="btn btn-orange btn-md" />
            </form>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        jQuery(window).scroll(function () {
            if (jQuery(window).scrollTop() > 50) {
                  jQuery('.newletter').addClass('active');   
            }
            if (jQuery(window).scrollTop() < 50) {
                  jQuery('.newletter').removeClass('active');   
            }
        });
    })
</script>   
  <div class="container">
     </div>
<footer class="content-info" role="contentinfo">
 
    <div class="footer">
		<div class="container">
                    <div class="row">
                         <section class="col-md-3 col-xs-12  widget nav_menu-2 widget_nav_menu"><h3>ABOUT</h3><ul id="menu-about" class="menu"><li class="menu-about-us"><a href="/why-london-food-lovers-tours/">About Us</a></li>
<li class="menu-soho-food-tour"><a href="/soho-food-tour/">Soho Food Tour</a></li>
<li class="menu-gift-certificates"><a href="/london-food-tour-gift-certificate/">Gift Certificates</a></li>
<li class="menu-faq"><a href="/faq/">FAQ</a></li>
<li class="menu-terms-and-conditions"><a href="#">Terms and Conditions</a></li>
<li class="menu-privacy-policy"><a href="#">Privacy Policy</a></li>
</ul></section><section class="col-md-3 col-xs-12  widget nav_menu-3 widget_nav_menu"><h3>TOUR</h3><ul id="menu-tours" class="menu"><li class="menu-soho-food-tour"><a href="/soho-food-tour/">Soho Food Tour</a></li>
<li class="menu-private-tours"><a href="/london-private-food-tours/">Private Tours</a></li>
<li class="menu-corporate-tours"><a href="/london-corporate-food-tours/">Corporate Tours</a></li>
<li class="menu-blog"><a href="/blog">Blog</a></li>
</ul></section><section class="col-md-3 col-xs-12  widget text-2 widget_text"><h3>Location</h3>			<div class="textwidget"><div class="address pull-left">



						Food Lovers LTD   <br>
						258a Pentonville Rd  <br>
						London, N1 9JY<br>
						Phone: <span class="skype_c2c_print_container">+44 (0)7884 852 151 </span><span class="skype_c2c_container" dir="ltr" tabindex="-1" onmouseover="SkypeClick2Call.MenuInjectionHandler.showMenu(this, event)" onmouseout="SkypeClick2Call.MenuInjectionHandler.hideMenu(event)" skype_menu_props="{&quot;numberToCall&quot;:&quot;+442035644743&quot;,&quot;isFreecall&quot;:false,&quot;isMobile&quot;:false,&quot;isRtl&quot;:false}"><span class="skype_c2c_highlighting_inactive_common" dir="ltr" skypeaction="skype_dropdown"><span class="skype_c2c_textarea_span"><span class="skype_c2c_text_span"></span><span class="skype_c2c_free_text_span"></span></span></span></span>  <br>
						Email: info@londonfoodlovers.com
					</div></div>
		</section><section class="col-md-3 col-xs-12  widget text-12 widget_text"><h3>Newsletter</h3>			<div class="textwidget"><div class="new-letter">
Gain access to the best restaurants around London and to our exclusive discounts!</p>
<form>
<input type="text" class="form-control" name="email" placeholder="enter your email"><br />
<button type="submit" class="btn btn-orange btn-md" >Subscribe <span class="glyphicon glyphicon-envelope"></span></button><br />
</form>
</div>
</div>
		</section><section class="col-md-3 col-xs-12  widget text-11 widget_text">			<div class="textwidget"><div class="modal fade" id="privacy-policy">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times;</button>
			<h4 class="modal-title">PRIVACY POLICY OF THE LONDON FOOD LOVERS WEBSITE</h4>
		  </div>
		  <div class="modal-body">
			


<p><b>Effective Date: April 15, 2014</b></p>

<p>Food Lovers Tours LTD. (the “Company”) strives to offer its visitors the many advantages of Internet 

technology and to provide an interactive and personalized experience. We may use your name, e-mail 

address, street address, telephone number (“Personally Identifiable Information”) subject to the terms 

of this Privacy Policy. Please note that this Privacy Policy applies only to information collected through 

the Site and does not impact information collected or used by the Company or its affiliates through other 

means.</p>

<p><b>1. How we gather information from users. </b>How we collect and store information depends on the page 

or portion of the Site that you are visiting, the activities in which you elect to participate and the services 

provided. You can visit many pages on the Site without providing any information. Other pages may 

prompt you to provide information, such as when you register for access to portions of the Site, sign up 

for membership, request certain features or make a purchase.</p>

<p>We do not collect personally identifiable information through the Site unless that information is provided 

by you during registration for various features on the Site. Information required to participate in such 

features may vary but will typically include your first and last name; address including city, state, zip 

code and country; daytime and evening phone numbers; and e-mail address; and, in the case of making 

purchases, a credit card number and expiration date. You may also be requested to provide a username 

and password for certain features.<p/>

<p>Like most websites, the Site also collects information automatically and through the use of electronic 

tools that may be transparent to our visitors. For example, we may log the name of your Internet Service 

Provider or use “cookie” technology. Among other things, the cookie may store your user name and 

password, sparing you from having to re-enter that information each time you visit, or may control the 

number of times you encounter a particular feature while visiting the Site. As we adopt and/or implement 

additional technology, we may also gather information through other means. In certain cases, you 

can choose not to provide us with information, for example by setting your browser to refuse to accept 

cookies, but doing so may limit your ability to access certain portions of the Site or may require you to re-
enter your user name and password. Additionally we may not be able to customize the Site’s features 

according to your preferences.</p>

<p><b>2. What we do with the information we collect. </b> We will use your information only as permitted by law. 

Information that does not personally identify you (“Aggregated Information”) may be used in various 

ways. For example, we may combine information about your usage patterns with similar information 

obtained from other users to learn which Site pages are visited most or what features of the Site are most 

attractive. Aggregated Information may be shared with our advertisers and business partners, but cannot 

be used to contact you individually.</p>

<p>As we continue to develop our business and grow, we may sell, buy, merge or partner with other 

companies or businesses. In such transactions, user information may be among the transferred assets. 

We may also disclose your information in response to a court order, at other times when we believe we 

are reasonably required to do so by law, in connection with the collection of amounts you may owe to 

us, and/or whenever we deem it appropriate or necessary to give such information to law enforcement 

authorities. Please note we may not provide you with notice prior to disclosure in such cases. </p>

<p><b>3. Security of personal information. </b>The Site has undertaken various security measures to protect 

against the loss, misuse and alteration of the information under its control. We have and will continue to 

undertake physical, electronic and managerial procedures to safeguard and help prevent unauthorized 

access, maintain data security, and correctly use the information.</p>

<p>Although we take various measures to safeguard against unauthorized disclosures of information, we 

cannot assure you that the personally identifiable information that we collect will never be disclosed in a 

manner that is inconsistent with this Privacy Policy. Inadvertent disclosures may result, for example, when 

third parties misrepresent their identities and request access to personally identifiable information.

Only those employees and hired professionals (e.g., lawyers) needed to carry out requisite business 

functions will have access to information on individual Site users. Employees and hired professionals 

violating these privacy policies will be subject to disciplinary action.</p>

<p>Please note, however, that whatever a user transmits or discloses online can be collected and used 

by others or unlawfully intercepted by third parties. No data transmission over the Internet can be 

guaranteed to be 100% secure. Although we strive to protect your personal information, we cannot 

warrant the security of any information you transmit to us. Such activities are beyond the control of the 

Site and this Privacy Policy.</p>

<p><b>4. Affiliated sites, linked sites and advertisements. </b> The Site expects its partners, advertisers and 

third-party affiliates to respect the privacy of our users. However, third parties, including our partners, 

advertisers, affiliates and other content providers accessible through the Site, may have their own privacy 

and data collection policies and practices. For example, during your visit to the Site you may link to, or 

view as part of a frame on the Site, certain content that is actually created or hosted by a third party. Also, 

through the Site you may be introduced to, or be able to access, information, web sites, advertisements, 

features, contests or sweepstakes offered by other parties. The Site is not responsible for the actions or 

policies of such third parties. You should check the applicable privacy policies of those third parties when 

providing information on a feature or page operated by a third party.</p>

<p><b>5. Children.</b> The Site does not knowingly collect or solicit personally identifiable information from or about 

children under the age of 13, except as permitted by law. If we discover we have received any information 

from a child under the age of 13 in violation of this Privacy Policy, we will delete that information 

immediately. If you believe the Site has any information from or about anyone under the age of 13, please 

contact us at the address in Section 6 listed below. Further,</p>

<ul>

<li>The only personal information that the Site will ever collect from children under 13 is email 

addresses. Children will never be asked to provide names, addresses, hobbies or any other 

information that would enable anyone to identify a particular child;</li>

<li>Email addresses will be provided directly by the children and will be used only for future emails 

containing information about the Site and its products</li>

<li>The Site will not disclose information collected from children to any third parties;</li>

<li>Parents of children have the option to consent to the collection and use of their child’s information 

without consenting to the disclosure of the information to third parties;</li>

<li> The Site may not, and will not, require a child to disclose more information that is reasonably 

necessary to participate in an activity as a condition of participation; </li>

<li>Children are encouraged to tell their parents about any information that they have provided to this 

Site or any other site; and </li>

<li>Parents of children can review their child’s personal information, ask to have it deleted and refuse 

to allow any further collection or use of the child’s information. Should a parent elect this option, that 

parent can contact the Site at the address listed in Section 6 below. </li> </ul>

<p><b>6. Opt-Out Procedure. </b>If you are a California resident and wish to exercise your right to opt-out from 

the Company sharing your personally identifiable information with third-parties for their direct marketing 

purposes, please send your written request for a California Customer Choice Notice and opt-out form to 

the email address in Section 7 below.</p>

<p><b>7. Contacting us. </b> We can be reached by contacting: </p>

<p>Food Lovers Tours, LTD: info@Londonfoodlovers.com </p>

<p><b>8. Changes to this policy.</b> This Privacy Policy may be changed at any time. Please check this page 

periodically for changes. Your continued use of the Site following the posting of changes to these terms 

will mean you accept those changes. Information collected prior to the time any change is posted will be 

used according to the rules and laws that applied at the time the information was collected.</p>

<p><b>9. Miscellaneous.</b> This Privacy Policy and the use of this Site shall be governed by and construed in 

accordance with the laws of the State of Illinois as applied to agreements entered into and to be fully 

performed within the State, without regard to its conflicts of law provisions. You hereby agree that any 

cause of action you may have with respect to the Site must be filed in a court located in London, Illinois 

within 180 days of the time in which the events giving rise to such claim occurred, or you agree to 

unconditionally waive such claim. You agree no such claim may be brought as a class action. The Site is 

controlled, operated and administered entirely within the United Kingdom. If you are located outside the 

United Kingdom, please note the information you provide to us will be transferred to the United Kingdom. 

This Privacy Policy also hereby incorporates in full by this reference the terms and conditions contained in 

the Company’s Terms and Conditions of Use Agreement. </p>






		
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-orange" data-dismiss="modal">Close</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<div class="modal fade" id="terms-condtions">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="false">&times;</button>
			<h4 class="modal-title">TERMS AND CONDITIONS OF USE OF LONDONFOODLOVERS.COM</h4>
		  </div>
		  <div class="modal-body">
			




<p><b>Effective Date: April 15, 2014</b></p>

<p>Welcome to <b>londonfoodlovers.com</b> (the “Site”). Please read the following Terms and Conditions of 

Use Agreement (this “Agreement”) carefully before using the Site. The following Agreement governs your 

use of the Site. By accessing and using the Site, you signify and acknowledge your acceptance of this 

Agreement and our Privacy Policy. Please read both of these documents very carefully. Your acceptance 

of this Agreement provides you with a limited, temporary and non-exclusive license and permission to 

use the resources of the Site, as well as the opportunity to purchase tickets for one of our food tasting 

and cultural walking tours. This limited, temporary and non-exclusive license and permission are freely 

revocable at any time, for any reason whatsoever, and with or without notice, by Food Lovers Tours LTD 

(the “Company”) as described more fully below. If you do not agree to this Agreement, please do not use 

the Site or purchase tickets for our tours. Please print a copy of this Agreement for your records.</p>

<p><b>1. Intellectual Property.</b> All information, content, services and software displayed on, transmitted 

through, or used in connection with the Site including, for example and without limitation, text, 

photographs, images, illustrations, audio clips, video, html, source and object code, trademarks, logos, 

and the like (collectively, the “Content”), as well as its selection and arrangement, is owned by the 

Company, and/or the Company’s affiliated entities, licensors and/or suppliers. You may use the Content 

online only, and solely for your personal, non-commercial use. If you operate a website and wish to link 

to the Site, you may do so upon written notice to the Company, provided you agree to immediately cease 

such link upon request from the Site. No other use is permitted without prior written permission of the 

Site. The permitted use described in this paragraph is contingent on your compliance at all times with this 

Agreement.</p>

<p>You may not, without the prior, written approval of the Company: (i) republish any portion of the Content 

on any Internet, Intranet or extranet site or incorporate the Content in any database, compilation, archive 

or cache, (ii) distribute any Content to others, whether or not for payment or other consideration, (iii) 

modify, copy, frame, cache, reproduce, sell, publish, transmit, display or otherwise use any portion of the 

Content, or (iv) scrape or otherwise copy our Content without permission. You agree not to decompile, 

reverse engineer or disassemble any software or other products or processes accessible through the 

Site, not to insert any code or product or manipulate the content of the Site in any way that affects the 

user’s experience, and not to use any data mining, data gathering or extraction method.</p>

<p>Requests to use Content for any purpose other than as permitted in this Agreement should be directed to 

the email address listed below under the heading “Contact Us.”</p>

<p><b>2. Infringement Complaints.</b> The Site respects the intellectual property of others. If you believe your 

rights have been infringed and/or are aware of any infringing material on the Site, please contact us at the 

email address listed below under the heading “Contact Us.”</p>

 

<p><b>3. User-Provided Information and Content. </b> By providing information to, communicating with, and/

or placing material on the Site (collectively, “User-Provided Content”), you represent and warrant that 

you, in consideration of being allowed to use the Site, irrevocably and unconditionally grant, transfer 

and assign all right, title and interest in and to the User-Provided Content to the Company, its affiliates 

and related entities, including the Site. You represent and warrant that, as a result of this grant, transfer 

and assignment, you will retain no ownership rights in and to the User-Provided Content whatsoever. 

You acknowledge and agree that all rights in this paragraph are granted without the need for additional 

compensation of any sort to you and that you are waiving any claim against the Company, the Site, and 

the affiliates of the foregoing, arising directly or indirectly out of the User-Provided Content.

Without limiting the other provisions of this Agreement in any way, you represent, warrant, acknowledge 

and agree that: (i) the Company solely owns all Content and User-Provided Content and retains the 

unfettered right to modify any portion of the Site; and (ii) the Company will, in its sole discretion, be 

constantly making changes to the Site by modifying, adding or eliminating features, functions and 

abilities. </p>

 

<p><b>4. Transactions and e-commerce on our site. </b> During your visit to the Site you may elect to engage in 

a transaction involving the purchase of a product or a service. To serve you most efficiently, credit card 

transactions and order fulfillment may be handled by a third party processing agent, bank or distribution 

institution. While in most cases transactions are completed without difficulty, there is no such thing as 

“perfect security” on the Internet or offline. If you’re concerned about online credit card safety, in most 

cases a telephone number will be made available so you can call us and place your order by phone. The 

Company and the Site cannot take responsibility for the success or security of transactions undertaken or 

processed by third parties. </p>

<p>On occasion, a product or service may not be available at the time or the price as it appears or is 

promoted. In such event, or in the event a product is listed at an incorrect price or with incorrect 

information due to typographical error, technology effort, error in the date or length of publication, or error 

in pricing or product information received from our advertisers or suppliers, you agree that the Company 

and the Site are not responsible for such errors or discrepancies. </p>

 

<p><b>5. Communications with Third Parties Through The Site.</b>  Your dealings or communications through 

the Site with any party other than the Company and the Site are solely between you and that third party. 

For example, certain areas of the Site may allow you to conduct transactions or purchase goods or 

services. In certain cases, these transactions will be conducted by our third-party partners and vendors. 

Under no circumstances will the Company or the Site be liable for any goods, services, resources or 

content available through such third party dealings or communications, or for any harm related thereto. 

Please review carefully that third party’s policies and practices and make sure you are comfortable with 

them before you engage in any transaction. Complaints, concerns or questions relating to materials 

provided by third parties should be forwarded directly to the third party. </p>

<p>During your visit to the Site you may link to, or view as part of a frame, certain content that is actually 

created or hosted by a third party. You may be introduced to, or be able to access, information, Web 

sites, advertisements, features, contests or sweepstakes offered by other parties. The Company and the 

Site are not responsible for the actions or policies of such third parties. You should check the applicable 

terms of service and privacy policies of those third parties when providing information on such a feature 

or page.</p>

 

<p><b>7. General Disclaimer and Limitation of Liability. </b>  While the Company and the Site use reasonable 

efforts to include accurate and up-to-date information, we make no warranties or representations as to the 

accuracy of the Content and assume no liability or responsibility for any error or omission in the Content. 

The Company and the Site do not represent or warrant that use of any Content will not inadvertently 

infringe rights of third parties. The Company and the Site have no responsibility for actions of third parties 

or for content provided or posted by others. </p>

<p>Use of the site is at your own risk. all content is provided “as is” and “as available.” neither the company, 

the site, nor any of their affiliated or related companies, nor any of the past, present or future employees, 

officers, agents, content providers or licensors of any of them, makes any representation or warranty 

of any kind regarding the site, the content, any advertising material, information, products or services 

available on or through the site, and/or the results that may be obtained from use of the site or 

such content or services. all express or implied warranties, including without limitation warranties of 

merchantability and fitness for a particular purpose, warranties against infringement, and warranties 

that the site will meet your requirements, be uninterrupted, timely, secure or error free, are specifically 

disclaimed. the company, the site, and the affiliates of the foregoing are not responsible or liable for 

content posted by third parties, actions of any third party, or for any damage to, or virus that may infect, 

your computer equipment or other property.</p>

<p>In no event shall the company or the site, including their affiliates, employees, officers, agents, 

content providers and licensors, be liable for any indirect, consequential, special, incidental or punitive 

damages including, without limitation, damages related to unauthorized access to or alteration of your 

transmissions or data, the content of the site, or any errors or omissions in the content, even if advised 

of the possibility of such damages. in no event shall the company, the site, or their affiliates, employees, 

officers, agents, content providers or licensors be liable for any amount for direct damages in excess of 

1000 GBP.</p>

<p><b>8. Indemnity.</b>  you agree to indemnify, defend and hold harmless, the company and the site, each 

of their parent and affiliated companies, and each of their respective partners, suppliers, licensors, 

officers, directors, shareholders, employees, representatives, contractors and agents, from any and all 

claims (including, but not limited to, claims for defamation, trade disparagement, privacy and intellectual 

property infringement) and damages (including attorneys’ fees and court costs) arising from or relating 

to any allegation regarding: (1) your use of the site; (2) the company or the site’s use of any content or 

information you provide, as long as such use is not inconsistent with this agreement; (3) information or 

material posted or transmitted through your membership account, even if not posted by you; (4) your 

participation in any of the food and cultural walking tours offered through the site; and (5) any violation of 

this agreement by you.</p>

<p><b>9. Waiver and Release of Claims- Walking Tours. </b> By virtue of purchasing tickets for and/or 

participating in the food tasting and cultural walking tours offered by the Company, and in consideration 

of being allowed to purchase said tickets and for other good and valuable consideration, the receipt and 

sufficiency of which is acknowledged, you understand, acknowledge, represent, warrant and agree as 

follows, with the knowledge that the Company will rely on same:

A. You desire to participate in the food tasting and cultural walking tours offered by the Company (the 

“Tours”); </p>

<p>B. You are in good health and suffer from no minor or serious physical or mental injury, illness or 

disability that would make you especially susceptible to injury or disability while performing any activity 

contemplated by this Agreement (including, without limitation, this Section 9);</p>

<p>C. On occasions, the Company might make changes to tour dates, times, prices, itinerary, etc. The 

Company also reserves the right to cancel, change or substitute any of our service, tour(s) or ticket(s) that 

you have booked, at any time, for any reason. Under such circumstances, the Company makes its best 

effort to contact and notify you in advance to alter or re-book your tours whenever possible. If you are not 

satisfied with the alternatives offered, you are entitled to a full refund of the original purchase price. </p>

<p>D. You fully comprehend and accept all of the risks associated with your participation in the Tours 

including, without limitation, exposure to unfavorable weather conditions, food sickness, injuries (e.g., 

without limitation, those arising out of self-inflicted accidents or mishaps, other participants, automobiles, 

pedestrians and the like) and death; </p>

<p>E. You grant to Company and Company’s assigns the irrevocable, sub-licensable right and authority 

to use your name, likeness, photograph and/or picture for any and all commercial or non-commercial 

purposes now known or later developed in perpetuity throughout the universe without further obligation or 

compensation to you; </p>

<p>F. Your participation in the tours is at your own sole risk. you, on behalf of yourself and/or any person 

or entity claiming through or on your behalf, hereby forever and unconditionally release and discharge

the company, the company’s related and affiliated entities, the present and former employees, owners, 

officers, members, managers, partners, contractors, insurers, representatives and agents of the foregoing 

(including, without limitation, foodtourpros.com, brown paper tickets) (collectively, “released parties”) from 

any and all claims, actions, damages, liabilities, losses, costs and expenses in any way arising out of, 

or resulting from, your participation in the tours, including, without limitation, any and all claims, actions, 

and liabilities for death, injury, loss or damage to you, to any one else, or to any property, regardless 

of whether or not such injury, loss or damage was caused by the negligence or willful conduct of the 

company or any of the released parties. you, on behalf of yourself and/or any person or entity acting 

through or on your behalf, further agree to defend and indemnify the released parties, and to hold the 

released parties harmless, from any and all liabilities, claims, actions, damages, expenses (including, 

without limitation, attorney’s fees) and losses of any kind or nature whatsoever in any way arising out of, 

or resulting from, your participation in the tours; and </p>

<p>G. this section 9 is in addition to, and not a limitation of, the other terms and conditions of this agreement.</p>

<p><b>10. Miscellaneous: </b>The Company and the Site reserve the right to change this Agreement at any time 

in its sole discretion and to notify users of any such changes solely by posting such changes. Your 

continued use of the Site after the posting of any amended agreement shall constitute your agreement to 

be bound by any such changes.

the use of any portion of the Site, including the availability of any portion of the Content at any time, 

without notice or liability. The Company and the Site may deny access to any person or user at any time 

for any reason. In addition, The Company and the Site may at any time transfer rights and obligations 

under this Agreement to any affiliate, subsidiary or business unit, or any of their affiliated companies or 

divisions, or any entity that acquires the Company, the Site or any of their assets.</p>

 

<p>This Agreement also hereby incorporates in full by this reference the terms and conditions contained in 

the Privacy Policy of londonfoodlovers.com</p>

<p><b>11. Refund and Cancellation Policy: </b>:</p>
<p>•	Food Lovers Tours will reimburse in full any tours cancelled no later than 3 weeks before the confirmed tour date.</p>
<p>•	Cancellations must be communicated via email to info@londonfoodlovers.com no less than 3 weeks in advance in order to receive a full refund.</p>
<p>•	Approval of cancellation of any and all bookings will be confirmed via email</p>
<p>•		Any and all changes or adjustments made in reference to a confirmed booking must be made 72 hours prior to the originally scheduled tour in order to be approved</p>
<p>a.	If the client wishes to execute any changes 72 hours prior to the commencement of the tour we will do everything possible to accommodate their requests, dependent on availability and circumstance; if we cannot entertain these changes and subsequently the client wishes to cancel, we will refund half of the ticket price of the scheduled tour.</p>
<p>b.	If the client requests changes in relation to the tour within the 72-hour window of the scheduled start, we will do what we can to best accommodate the changes, but in the event that the client chooses to cancel their booking, no refund will be issued.</p>
<p>•	 No partial (or full) refunds are available once a tour has commenced.
 </p>

<p><b>12. Contact Us. </b>To contact the Company:</p>

<p>Food Lovers Tours LTD</p>

<b>info@londonfoodlovers.com</b>




		
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-orange" data-dismiss="modal">Close</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->












</div>
		</section>                    </div>
			<br>
			<div class="row bg-line">
				<div class="col-md-12 center">
					<h3>  London Food Tours</h3>
<div class="social-container" style="margin: 0 0 10px">
					<a style="margin:5px"  href="https://www.facebook.com/pages/London-Food-Lovers/864626370344634"><img src="https://londonfoodlovers.com/wp-content/themes/roots-master/assets/images/fb.png" /></a>
					<a style="margin:5px" href="https://twitter.com/FoodLoversTours"><img src="https://londonfoodlovers.com/wp-content/themes/roots-master/assets/images/twitt.png" /></a>
					<a style="margin:5px" href="https://plus.google.com/112092265692699836505/posts"><img src="https://londonfoodlovers.com/wp-content/themes/roots-master/assets/images/google.png" /></a>
					<a style="margin:5px" href="mailto:info@londonfoodlovers.com"><img src="https://londonfoodlovers.com/wp-content/themes/roots-master/assets/images/email.png" /></a>
				</div>

					<p>
				London Food Lovers Food Tours are rated among the top London Attractions, London Tours, London Private Tours, London Group Tours and London Food Tours. 
					</p>
				</div>
			</div>
			<p class="copyright center">
					©2014 Food Lovers Tours LTD. All Rights Reserved
			</p>
		</div>
	</div>
</footer>

	

<script>
	jQuery(document).ready(function(){
	jQuery('.modal').modal('hide');

		jQuery('.footer .menu-privacy-policy a').attr({'data-toggle':"modal", 'data-target':"#privacy-policy"});
		jQuery('.footer .menu-terms-and-conditions a').attr({'data-toggle':"modal", 'data-target':"#terms-condtions"});
	})
</script> 

	<script type="text/javascript">
	
	 //jQuery( "#accordion" ).accordion(); 
	 
	   jQuery( "#accordion" ).accordion({
heightStyle: "content"
});
	</script>
	<script type='text/javascript' src='/wp-content/themes/roots-master/assets/js/scripts.min.js?ver=0fc6af96786d8f267c8686338a34cd38'></script>

  	
</body>


</html>