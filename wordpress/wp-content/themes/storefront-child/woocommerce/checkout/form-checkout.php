<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if(!is_user_logged_in()) { ?>	
	<div class="login-access">	
		<div class="row">
		    <div class="col-md-12">
				<?php woocommerce_breadcrumb(); ?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<h1 class="title-primary">Já é cliente ? </h1>
			</div>	
		</div>
		
		<div class="row">
			<div class="col-md-10 col-md-offset-2">
				<?php echo do_shortcode('[lwa registration=0]');?>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<h1 class="title-primary">Primeira compra ?</h1>
			</div>	
			<div class="col-md-10 col-md-offset-2">
				<?php echo do_shortcode('[lwa registration=1]');?>
			</div>
		</div>
	</div>
<?} else {	?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data"> ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php woocommerce_breadcrumb(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h1 class="title-primary">Finalizar Pedido</h1>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="total-order-box">
					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
						<div id="order_review" class="woocommerce-checkout-review-order">
							<?php do_action( 'woocommerce_checkout_order_review' ); ?>
						</div>
					<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

				</div>
				<div class="billing-fields">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
				</div>
			</div>
			<div class="col-md-4">
				<div class="billing-fields shipping-fields-checkout">
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
			</div>
			<div class="col-md-4">
				<?php do_action( 'woocommerce_checkout_order_review_custom' ); ?>
			</div>
		</div>
	</div>


<?php
//wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	//echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
	return;
}

?>



	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				
			</div>

			<div class="col-2">
				<?php //do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>




</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); } ?>