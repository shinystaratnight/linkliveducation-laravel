@extends('app')
@section('content')

<!-- banner  -->
<section class="banner" id="main_banner">
	<div class="container">
		<div class="row">
			<div class="banner-overflow">
				<h2 class="word">Start Mining Cryptocurrencies Today!</h2>
				<p>It’s as easy as it can get - Your mining rigs are already fully operational.<br/>
As soon as you’ve registered as a member you can start earning your first coins from our cloud mining service!</p>
				<a href="register" class="btn btn-primary">Start Mining</a>
				<a href="#third" class="btn btn-danger nav-link js-scroll-trigger">Read More</a>	
			</div>
		</div>
	</div>
</section>
<!--  /banner  -->




<!-- section content -->
<section class="sec-cmain-content">
	<div class="container">
		<div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 gm-home-hardware">
				<div class="feature_box">
					<h3><span></span>Your hardware is <strong>already running</strong></h3>
					<p>Don't wrestle with rig assembly and hot, noisy miners at home. We have the fastest bitcoin mining hardware running for you already!</p>
					<a href="/datacenter" class="btn btn-info" title="Our Datacenters">Our Datacenters</a>
				</div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 gm-home-coins">
				<div class="feature_box">
					<h3><span></span>Mine alternative <strong>cryptocurrencies</strong></h3>
					<p>You can mine any cryptocurrency available in our catalogue! Switch your mining power on the fly for all the coins using our bitcoin mining website</p>
					<a href="/contact" class="btn btn-info" title="Customer Service Center">Customer Service</a>
				</div>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 gm-home-payout">
				<div class="feature_box">
					<h3><span></span>Get your first <strong>payout today</strong></h3>
					<p>You will get daily payouts of your investment to your designated wallet. Try our bitcoin mining platform now!</p>
					<a href="/pricing" class="btn btn-info" title="Our pricing">Our pricing</a>
				</div>
            </div>
        </div>
		
	</div>
</section>


<!--  section content  -->

<!-- about us  -->
<section class="sec-aboutus" id="third">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12  About-sec-part1-left">
				<h2>ABOUT <span>US</span></h2>
				<p><i>Arkonix is a Brand New and very promising Swiss Based Cloud-Mining Company.</i></p>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 hidden-xs">
				<img src="{{ URL::asset('site_assets/images/border.png') }}" class="img-responsive" alt="border" />
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 About-sec-part1-left-right">
				<p>We offer the possibility for users Worldwide and without any technical knowledge, to instantly start benefitting from the incredible opportunity which Cryptocurrency offers from the source itself, Mining.</p>
			</div>
		</div>
		<div class="row aboutus-sec-part2-main">
			<div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 aboutus-sec-left-img wow zoomIn ">
				<div class="embed-responsive embed-responsive-16by9">
				  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/dNqm0XV2Enw"></iframe>
				</div> 
			</div>
			<div class="col-lg-7 col-md-6 col-sm-6 col-xs-12 aboutus-sec-right-cont wow bounceInRight">
				<h2 class="text-center">OUR <span>BLOGS</span></h2>
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				  <ol class="carousel-indicators">
				
				<?php $blogs = DB::table('blog_posts')->where('active', '1')->get(); 
				//print_r($blogs);
				$counter=0;
				foreach($blogs as $blog)
				{
				?>
				
				  
					<li data-target="#carousel-example-generic" data-slide-to="{{$counter}}" class="<?php if($counter==0){echo 'active';} ?>"></li>
				<?php $counter=$counter+1;} ?>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner" role="listbox">
				  
				  
				  <?php 
				  $counter=0;
				foreach($blogs as $blog)
				{
				?>
					<div class="<?php if($counter==0){echo 'item active';}else {echo 'item';} ?>">
						<div class="panel panel-default">
							<div class="panel-heading"><strong>{{$blog->title}}</strong></div>
							<div class="panel-body">
								<div class="col-sm-5 col-xs-12 blog_image">
									<a href=".url('blog/'.$blog->slug)." class="thumbnail"><img src="{{ URL::asset('site_assets/banner/'.$blog->image)}}" onerror="this.onerror=null;this.src='{{ URL::asset('site_assets/images/no-image.jpg') }}';" alt=""></a>
								</div>     
								<p>{!! str_limit($blog->body, $limit = 500, $end = '...
								<a href='.url("blog/".$blog->slug).'>Read More</a>') !!}</p>     
								      
							</div>                  
							<div class="panel-footer">
								<span class="glyphicon glyphicon-user" id="start"></span> <label id="started">By</label> <a href="#" id="startedby">Admin</a> | 
								
							</div>
						</div>
					</div>
					
					<?php $counter=$counter+1;} ?>
					
				  </div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- about us -->


<!-- testamonials -->
<section class="sec-testimonial" id="intro">
	 <div class="container">
		<div class="row">
		<div class="clearfix twitter-img">
			<img src="{{ URL::asset('site_assets/images/twitter_03.png') }}" alt="" class="img-responsive" />
		</div>
		
		<div class="center slider text-center test-slider">
		
		<?php $twitter_posts = DB::table('twitter_posts')->where('active', '1')->get(); 
				//print_r($blogs);
				foreach($twitter_posts as $post)
				{
				?>
				
				
			<div>
				<p>{!!$post->body!!}</p>
			</div>
			
				<?php } ?>
			
		</div>
	
    
		<p class="text-center twitter-id-senf">Follow Us On Twitter: <a href="https://twitter.com/ArkonixMining/with_replies">@ArkonixMining</a></p>
		</div>
	 </div>
</section>
<!-- /testamonials -->



<!-- services -->
<section class="sec-services">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12  About-sec-part1-left">
				<h2 class="text-uppercase">Why <span>Choose us</span></h2>
				<p><i>{{getcong('choose_us_subtitle')}}</i></p>
			</div>
			<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 hidden-xs">
				<img src="{{ URL::asset('site_assets/images/border.png ') }}" class="img-responsive" alt="border" />
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 About-sec-part1-left-right">
				<p>{{getcong('choose_us_discription')}}</p>
			</div>
		</div>
		<div class="row flex-container">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 about-sec3-inn-main">
					<div class="row flex-container">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 about-sec3-inn-left-icon">
							<img src="{{ URL::asset('site_assets/images/006-month-with-increasing-incomes-calendar-page.png') }}" alt="icon" class="img-responsive" />
						</div>
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 about-sec3-inn-right-content">
							<h3>Daily Payouts</h3>
							<p>{{getcong('choose_us_payout')}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 about-sec3-inn-main">
					<div class="row flex-container">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 about-sec3-inn-left-icon">
							<img src="{{ URL::asset('site_assets/images/005-controls.png') }}" alt="icon" class="img-responsive" />
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 about-sec3-inn-right-content">
							<h3>You control the Mining</h3>
							<p>{{getcong('choose_us_control_mining')}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 about-sec3-inn-main">
					<div class="row flex-container">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 about-sec3-inn-left-icon">
							<img src="{{ URL::asset('site_assets/images/004-money.png') }}" alt="icon" class="img-responsive" />
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 about-sec3-inn-right-content">
							<h3>Regular Withdrawals</h3>
							<p>{{getcong('choose_us_regular_with')}}</p>
						</div>
					</div>
				</div>
				
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 about-sec3-inn-main">
					<div class="row flex-container">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 about-sec3-inn-left-icon">
							<img src="{{ URL::asset('site_assets/images/003-quick-selection.png') }}" alt="icon" class="img-responsive" />
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 about-sec3-inn-right-content">
							<h3>Immediate Mining & No Hustle</h3>
							<p>{{getcong('choose_us_immediate')}}</p>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 about-sec3-inn-main">
					<div class="row flex-container">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 about-sec3-inn-left-icon">
							<img src="{{ URL::asset('site_assets/images/002-search-stats.png') }}" alt="icon" class="img-responsive" />
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 about-sec3-inn-right-content">
							<h3>Transparency</h3>
							<p>{{getcong('choose_us_transparency')}}</p>
						</div>
					</div>
				</div>
				
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 about-sec3-inn-main">
					<div class="row flex-container">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 about-sec3-inn-left-icon">
							<img src="{{ URL::asset('site_assets/images/001-money-bag-with-dollar-symbol.png') }}" alt="icon" class="img-responsive" />
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 about-sec3-inn-right-content">
							<h3>Great Bonuses</h3>
							<p>{{getcong('choose_us_bonus')}}</p>
						</div>
					</div>
				</div>
		</div>
	</div>
</section>
<!-- /services -->


<!--  testamonials  -->
<section class="sec-payments">
    <div class="container">
		<div class="clearfix main_title">
		   <h2 class="text-center">Payment Methods</h2>
		</div>
   
		<div class="payment_methods_slider">
                    
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/aragon.png') }}" alt="" />
				<h5 class="text-uppercase">aragon</h5>
			</div>
                   
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/augur.png') }}" alt="" />
				<h5 class="text-uppercase">augur</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/bancor.png') }}" alt="" />
				<h5 class="text-uppercase">bancor</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/basicattentiontoken.png') }}" alt="" />
				<h5 class="text-uppercase">basicattentiontoken</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/bitcoin.png') }}" alt="" />
				<h5 class="text-uppercase">bitcoin</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/bitcoincash.png') }}" alt="" />
				<h5 class="text-uppercase">bitcoincash</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/blackcoin.png') }}" alt="" />
				<h5 class="text-uppercase">blackcoin</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/civic.png') }}" alt="" />
				<h5 class="text-uppercase">civic</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/clams.png') }}" alt="" />
				<h5 class="text-uppercase">clams</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/dash.png') }}" alt="" />
				<h5 class="text-uppercase">dash</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/decred.png') }}" alt="" />
				<h5 class="text-uppercase">decred</h5>
			</div><div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/digibyte.png') }}" alt="" />
				<h5 class="text-uppercase">digibyte</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/district0x.png') }}" alt="" />
				<h5 class="text-uppercase">district0x</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/dogecoin.png') }}" alt="" />
				<h5 class="text-uppercase">dogecoin</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/edgeless.png') }}" alt="" />
				<h5 class="text-uppercase">edgeless</h5>
			</div><div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/eos.png') }}" alt="" />
				<h5 class="text-uppercase">eos</h5>
			</div><div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/ether.png') }}" alt="" />
				<h5 class="text-uppercase">ether</h5>
			</div><div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/etherclassic.png') }}" alt="" />
				<h5 class="text-uppercase">etherclassic</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/firstblood.png') }}" alt="" />
				<h5 class="text-uppercase">firstblood</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/funfair.png') }}" alt="" />
				<h5 class="text-uppercase">funfair</h5>
			</div><div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/game.png') }}" alt="" />
				<h5 class="text-uppercase">game</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/gnosis.png') }}" alt="" />
				<h5 class="text-uppercase">gnosis</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/golem.png') }}" alt="" />
				<h5 class="text-uppercase">golem</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/iexec.png') }}" alt="" />
				<h5 class="text-uppercase">iexec</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/komodo.png') }}" alt="" />
				<h5 class="text-uppercase">komodo</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/lbry.png') }}" alt="" />
				<h5 class="text-uppercase">lbry</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/litecoin.png') }}" alt="" />
				<h5 class="text-uppercase">litecoin</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/matchpool.png') }}" alt="" />
				<h5 class="text-uppercase">matchpool</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/metal.png') }}" alt="" />
				<h5 class="text-uppercase">metal</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/monacoin.png') }}" alt="" />
				<h5 class="text-uppercase">monacoin</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/monero.png') }}" alt="" />
				<h5 class="text-uppercase">monero</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/numeraire.png') }}" alt="" />
				<h5 class="text-uppercase">numeraire</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/omisego.png') }}" alt="" />
				<h5 class="text-uppercase">omisego</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/potcoin.png') }}" alt="" />
				<h5 class="text-uppercase">potcoin</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/reddcoin.png') }}" alt="" />
				<h5 class="text-uppercase">reddcoin</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/ripple.png') }}" alt="" />
				<h5 class="text-uppercase">ripple</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/salt.png') }}" alt="" />
				<h5 class="text-uppercase">salt</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/siacoin.png') }}" alt="" />
				<h5 class="text-uppercase">siacoin</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/singular.png') }}" alt="" />
				<h5 class="text-uppercase">singular</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/startcoin.png') }}" alt="" />
				<h5 class="text-uppercase">startcoin</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/status.png') }}" alt="" />
				<h5 class="text-uppercase">status</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/swarmcity.png') }}" alt="" />
				<h5 class="text-uppercase">swarmcity</h5>
			</div>
                    <div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/swisscoin.png') }}" alt="" />
				<h5 class="text-uppercase">swisscoin</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/vericoin.png') }}" alt="" />
				<h5 class="text-uppercase">vericoin</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/vertcoin.png') }}" alt="" />
				<h5 class="text-uppercase">vertcoin</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/waves.png') }}" alt="" />
				<h5 class="text-uppercase">waves</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/wetrust.png') }}" alt="" />
				<h5 class="text-uppercase">wetrust</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/wings.png') }}" alt="" />
				<h5 class="text-uppercase">wings</h5>
			</div>
			<div class="payment_methods_slide_box">
				<img src="{{ URL::asset('site_assets/images/arkonix-logo/zcash.png') }}" alt="" />
				<h5 class="text-uppercase">zcash</h5>
			</div>
		</div>
	</div>
</section>
<!--  /testamonials  -->



<!-- start mining -->
	<section class="sec-start-mining">
		<div class="container">
			<div class="row text-center">
				<h3>Mine Your Favorite Cryptocurrency!</h3>
				<a href="{{URL('/register')}}" class="btn btn-link">Start Mining Now</a>
			</div>
		</div>
	</section>
<!-- /start mining -->





<!-- fun facts -->
<section class="sec-funfacts">
	 <div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sec-fun-box1-main">
				<div class="sec-fun-box1">
					<img src="{{ URL::asset('site_assets/images/fun-icon1.png') }}" alt="" class="img-responsive" />
					<h4>Total Miners</h4>
					<?php $miners=DB::table('users')->count();
					
					$total_payouts=DB::table('order')->where('payout_issued','approved')->count();
					?>
					<div id="counter">
						<p class="counter-value" data-count="{{$miners*2}}">0</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sec-fun-box1-main">
				<div class="sec-fun-box1">
					<img src="{{ URL::asset('site_assets/images/fun-icon2.png') }}" alt="" class="img-responsive" />
					<h4>Total Mined ($)</h4>
					<div id="counter">
						<p class="counter-value" data-count="{!!getcong('total_mined_doller')!!}">0</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sec-fun-box1-main">
				<div class="sec-fun-box1">
					<img src="{{ URL::asset('site_assets/images/fun-icon3.png') }}" alt="" class="img-responsive" />
					<h4>Mining Since days</h4>
					<div id="counter">
						<p class="counter-value" data-count="{!!getcong('minings_day')!!}">0</p>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 sec-fun-box1-main">
				<div class="sec-fun-box1">
					<img src="{{ URL::asset('site_assets/images/fun-icon4.png') }}" alt="" class="img-responsive" />
					<h4>Total Payouts</h4>
					<div id="counter">
						<p class="counter-value" data-count="{{$total_payouts}}">0</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- /fun facts -->
 @endsection       