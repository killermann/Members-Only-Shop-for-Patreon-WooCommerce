<?php
/*
Plugin Name: Members-Only Shop for Patreon + WooCommerce
Plugin URI: https://github.com/killermann/members-only-patreon-woocommerce
Description: Offer exclusive products in a WooCommerce Shop to your Patreon patrons.
Version:0.1
Author: Sam Killermann
Author URI: https://samuelkillermann.com
License URI: http://www.wtfpl.net/
*/

// Limit Members Only WooCommerce Category to Patreon Patrons

if (function_exists('getUserPatronage')) {

	function restrict_members_only_products_to_patrons() {

	    // set the slug of the category for which we disallow checkout
		$category = 'members-only';

	    // get the product category
		$product_cat = get_term_by( 'slug', $category, 'product_cat' );

	    // sanity check to prevent fatals if the term doesn't exist
		if ( is_wp_error( $product_cat ) ) {
			return;
		}

		// check if this category is the only thing in the cart
		if ( check_if_user_is_not_patron() ) {

	        if ( is_category_in_cart( $category ) ) {

	    		// render a notice to explain why checkout is blocked
	    		wc_add_notice( sprintf( 'Hi there! Looks like your cart contains something that is only for members. You can sign up to be a member right now on <a href="https://patreon.com/killermann" title="Become a member on Patreon">Patreon</a> and we will be all set, otherwise you will need to remove that item from your cart to check out.'), 'error' );
	        }
		}
	}

	function check_if_user_is_not_patron() {

	    $user_patronage = Patreon_Wordpress::getUserPatronage();

	    if ( $user_patronage >= 1 ) {

			return false;
		}

	    return true;
	}

	function is_category_in_cart($category) {
	    // check each cart item for our category
	    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

	        // if a product is not in our category, bail out since we know the category is not alone
	        if ( has_term( $category, 'product_cat', $cart_item['data']->id ) ) {
	            return true;
	        }
	    }
	}

	add_action( 'woocommerce_check_cart_items', 'restrict_members_only_products_to_patrons' );

	add_filter( 'body_class','add_patron_body_class' );

	function add_patron_body_class() {
		if ( ! check_if_user_is_not_patron()){
			$classes[] = 'patron';
		} else {
			$classes[] = 'not-patron';
		}
		return $classes;
	}

	add_action( 'woocommerce_check_cart_items', 'restrict_members_only_products_to_patrons' );
}
