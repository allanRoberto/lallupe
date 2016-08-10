<?php 
  $template_url = get_template_directory_uri()."-child";
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.7&appId=324655211256701";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

		<header class="main-header">
		   	<div class="top-header hidden-xs">
		   	    <div class="container">
			   	    <div class="row">
			   	        <div class="col-md-4">
							<div class="info-header" itemscope itemtype="http://schema.org/LocalBusiness">

								<span  class="email-header">
									<i class="sprite icon-header-email"></i>
									<a href="mailto:atendimento@lallupe.com.br" title="Envie um e-mail">atendimento@lallupe.com.br</a>
								</span>
							</div>
						</div>
						<div class="col-md-4 col-md-offset-4">
							<?php
			 					wp_nav_menu(
									array(
										'theme_location'	=> 'secondary',
										'container_class'	=> 'secondary-navigation',
										'container'         => 'nav',
										)
								);
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="middle-header hidden-xs">
			    <div class="container">
				    <div class="row row-centered">
				        <div class="col-md-2">
							<a class="logo-header" href="<?php echo site_url(); ?>" title="Lallupe">
								<img src="<?php echo $template_url; ?>/app/images/header-logo.png" />
							</a>
						</div>
						<div class="col-md-2 col-md-offset-8">
							<ul class="shop-header">
								<?php do_action('storefront_child_cart_header'); ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="bottom-header container">
				<div class="row row-centered">
					<div class="col-md-8 col-xs-2 line-right-mobile">
						<div class="navbar navbar-default">
					    	<div class="navbar-header">
							    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu-primary" aria-expanded="false">
							        <span class="sr-only">Toggle navigation</span>
							        <span class="icon-bar icon-top"></span>
							        <span class="icon-bar icon-hide"></span>
							        <span class="icon-bar icon-bottom"></span>
							    </button>
						    </div>  
					        <div class="collapse navbar-collapse" id="menu-primary">
								<?php wp_nav_menu(array(
					                'container'       => false,
					                'items_wrap'      => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
					                'walker'          => new twitter_bootstrap_nav_walker,
					                'theme_location'	=> 'primary',
					            ));?>
					        </div>													
					    </div>														
					</div>
					<div class="col-xs-6 line-right-mobile visible-xs-block">
						<a class="logo-header" href="<?php echo site_url(); ?>" title="Lallupe">
							<img src="<?php echo $template_url; ?>/app/images/header-logo.png" class="logo-mobile"/>
						</a>
					</div>
					<div class="col-xs-2 line-right-mobile menu-container-mobile visible-xs-block">
						<a href="#" class="icon-search-mobile-header">
							<i class="fa fa-search fa-2x" aria-hidden="true"></i>
						</a>
					</div>
					<div class="col-xs-2  visible-xs-block">
						<a href="#" class="icon-cart-mobile-header">
							<i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
						</a>
					</div>
					<div class="col-md-3 hidden-xs ">	
						<div class="search-header">
							<?php dynamic_sidebar( 'search-header' ); ?>
						</div>
					</div>
					<div class="col-md-1 hidden-xs">
						<ul class="social-header">
							<li class="item-social-header">
								<a class="twitter-header" href="https://twitter.com/lallupeoficial" title="Twitter" target="_BLANK">
									<i class="sprite icon-header-twitter"></i>
								</a>
							</li>
							<li class="item-social-header">
								<a class="facebook-header" href="https://www.facebook.com/lallupe/" title="Facebook" target="_BLANK">
									<i class="sprite icon-header-facebook"></i>
								</a>
							</li>
							<li class="item-social-header">
								<a class="instagran-header" href="https://www.instagram.com/lallupeoficial/" title="Twitter" target="_BLANK">
									<i class="sprite icon-header-instagran"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		<hr class="divider-header"/>	
		</header>
