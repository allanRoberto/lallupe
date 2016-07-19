<?php 
require_once('includes/menu_class.php');

add_action('storefront_child_cart_header', 'storefront_child_header_cart', 60 );
add_action( 'storefront_child_search_header', 'storefront_product_search', 40 );

remove_action( 'storefront_footer', 'storefront_credit', 50);


if ( ! function_exists( 'storefront_header_cart' ) ) {
	
	function storefront_child_header_cart() {
		if ( is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
		?>
		<li class="cart-header <?php echo esc_attr( $class ); ?>">
			<a class="cart" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="">
				<i class="sprite icon-header-cart"></i> 
			</a>		
				<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			</li>
		<?php
		}
	}
}

add_action( 'widgets_init',  'widgets_custom_init'  );

function widgets_custom_init() {
	register_sidebar( array(
		'name'          => __( 'Search header', 'storefront' ),
		'id'            => 'search-header',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}


function lallupe_scripts() {
	$template_url = get_template_directory_uri()."-child";
	wp_enqueue_style( 'custom-styles', $template_url."/app/styles/styles.css", array(), '1.0' );
	wp_enqueue_script( 'bootstrap', $template_url."/app/scripts/src/bootstrap.min.js", array(), '1.0', true );

	wp_enqueue_script( 'app', $template_url."/app/scripts/app.js", array(), '1.0', true );

	wp_enqueue_script( 'owl-carousel', $template_url."/app/scripts/src/owl.carousel.min.js", array(), '1.0', true );
}

add_action( 'wp_enqueue_scripts', 'lallupe_scripts' );