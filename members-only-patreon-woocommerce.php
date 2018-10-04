<?php
/*
Plugin Name: Members-Only Shop for Patreon + WooCommerce
Plugin URI: https://github.com/killermann/Members-Only-Shop-for-Patreon-WooCommerce
Description: Offer exclusive products in a WooCommerce Shop to your Patreon patrons.
Version:0.2
Author: Sam Killermann
Author URI: https://samuelkillermann.com
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/


// Register the options page

class Members_Only_Shop_for_Patreon_WooCommerce {
    public function __construct() {
    	// Hook into the admin menu
    	add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
        // Add Settings and Fields
    	add_action( 'admin_init', array( $this, 'setup_sections' ) );
    	add_action( 'admin_init', array( $this, 'setup_fields' ) );
    }
    public function create_plugin_settings_page() {
    	// Add the menu item and page
    	$page_title = 'Members-Only Shop for Patreon + WooCommerce';
    	$menu_title = 'Members-Only Shop';
    	$capability = 'manage_options';
    	$slug = 'members-only-shop';
    	$callback = array( $this, 'plugin_settings_page_content' );
    	$icon = 'dashicons-admin-network';
    	$position = 100;
    	add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
    }
    public function plugin_settings_page_content() {?>
    	<div class="wrap">
    		<h1>Members-Only Shop for Patreon + WooCommerce</h1><?php
            if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] ){
                  $this->admin_notice();
            } ?>
    		<form method="POST" action="options.php">
                <?php
                    settings_fields( 'members-only-shop' );
                    do_settings_sections( 'members-only-shop' );
                    submit_button();
                ?>
    		</form>
    	</div> <?php
    }

    public function admin_notice() { ?>
        <div class="notice notice-success is-dismissible">
            <p>Your settings have been updated!</p>
        </div><?php
    }
    public function setup_sections() {
		add_settings_section( 'getting_started', 'Getting Started', array( $this, 'section_callback' ), 'members-only-shop' );
        add_settings_section( 'basic_settings', 'Basic Settings', array( $this, 'section_callback' ), 'members-only-shop' );
    }
    public function section_callback( $arguments ) {
    	switch( $arguments['id'] ){
			case 'getting_started':
				echo 'First, <strong>you need to have the Patreon and WooCommerce plugins installed and configured, and you must be using the WooCommerce checkout</strong>. By default, if you add a product to the product category "Members Only", it will only be purchasable by active patrons. You can customize the category and other settings below.';
				break;
    		case 'basic_settings':
    			echo 'Customize these for the best experience for your customers.';
    			break;
    	}
    }
    public function setup_fields() {
        $fields = array(
        	array(
        		'uid' => 'mospw_patreon_link',
        		'label' => 'Patreon Link',
        		'section' => 'basic_settings',
        		'type' => 'text',
        		'placeholder' => 'http://patreon.com/yourprofile',
        		'helper' => 'Make sure it is a valid URL',
        		'supplemental' => 'This link will be used in messages that encourage non-patrons to become your patron. It does not HAVE to be directly to your Patreon profile. You could, for example, link them to a members page on your store instead.',
        	),
			array(
        		'uid' => 'mospw_cat_slug',
        		'label' => 'Product Category Slug',
        		'section' => 'basic_settings',
        		'type' => 'text',
        		'placeholder' => 'members-only',
        		'helper' => 'Default category is "Members Only"',
        		'supplemental' => 'If you want to customize the product category for your members-only items, do so here. Just make sure it is the slug of the PRODUCT CATEGORY you are using.',
        	),

        );
    	foreach( $fields as $field ){
        	add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'members-only-shop', $field['section'], $field );
            register_setting( 'members-only-shop', $field['uid'] );
    	}
    }
    public function field_callback( $arguments ) {
        $value = get_option( $arguments['uid'] );
        if( ! $value ) {
            $value = $arguments['default'];
        }
        switch( $arguments['type'] ){
            case 'text':
            case 'password':
            case 'number':
                printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
                break;
            case 'textarea':
                printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value );
                break;
            case 'select':
            case 'multiselect':
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $attributes = '';
                    $options_markup = '';
                    foreach( $arguments['options'] as $key => $label ){
                        $options_markup .= sprintf( '<option value="%s" %s>%s</option>', $key, selected( $value[ array_search( $key, $value, true ) ], $key, false ), $label );
                    }
                    if( $arguments['type'] === 'multiselect' ){
                        $attributes = ' multiple="multiple" ';
                    }
                    printf( '<select name="%1$s[]" id="%1$s" %2$s>%3$s</select>', $arguments['uid'], $attributes, $options_markup );
                }
                break;
            case 'radio':
            case 'checkbox':
                if( ! empty ( $arguments['options'] ) && is_array( $arguments['options'] ) ){
                    $options_markup = '';
                    $iterator = 0;
                    foreach( $arguments['options'] as $key => $label ){
                        $iterator++;
                        $options_markup .= sprintf( '<label for="%1$s_%6$s"><input id="%1$s_%6$s" name="%1$s[]" type="%2$s" value="%3$s" %4$s /> %5$s</label><br/>', $arguments['uid'], $arguments['type'], $key, checked( $value[ array_search( $key, $value, true ) ], $key, false ), $label, $iterator );
                    }
                    printf( '<fieldset>%s</fieldset>', $options_markup );
                }
                break;
        }
        if( $helper = $arguments['helper'] ){
            printf( '<span class="helper"> %s</span>', $helper );
        }
        if( $supplemental = $arguments['supplemental'] ){
            printf( '<p class="description">%s</p>', $supplemental );
        }
    }
}
new Members_Only_Shop_for_Patreon_WooCommerce();

// Limit Members Only WooCommerce Category to Patreon Patrons

function restrict_members_only_products_to_patrons() {

	$patreon_link = get_option('mospw_patreon_link');

	$mospw_cat_slug = get_option('mospw_cat_slug');

	if ( empty($mospw_cat_slug) ) {
        $category = 'members-only';

    } else {
    	$category = get_option('mospw_cat_slug');
    }


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
    		wc_add_notice( sprintf( 'Hi there! Looks like your cart contains something that is only for members. You can sign up to be a member right now on <a href="%s" title="Become a member on Patreon">Patreon</a> and we will be all set, otherwise you will need to remove that item from your cart to check out.', $patreon_link), 'error' );
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

/**
 * Add plugin action links.
 *
 * Add a link to the settings page on the plugins.php page.
 *
 * @since 0.2
 *
 * @param  array  $links List of existing plugin action links.
 * @return array         List of modified plugin action links.
 */
function mospw_action_links( $mospwActionLinks ) {
	$mospwActionLinks = array_merge( array(
		'<a href="' . esc_url( admin_url( 'admin.php?page=members-only-shop' ) ) . '">' . __( 'Settings', 'textdomain' ) . '</a>'
	), $mospwActionLinks );
	return $mospwActionLinks;
}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'mospw_action_links' );

// add_filter( 'body_class','add_patron_body_class' );
//
// function add_patron_body_class() {
// 	if ( ! check_if_user_is_not_patron()){
// 		$classes[] = 'patron';
// 	} else {
// 		$classes[] = 'not-patron';
// 	}
// 	return $classes;
// }
