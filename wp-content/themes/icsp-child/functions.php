<?php
// Add custom Theme Functions here

add_filter( 'woocommerce_email_headers', 'add_bcc_to_wc_admin_new_order', 10, 3 );
function add_bcc_to_wc_admin_new_order( $headers, $id, $order ) {

	$orderid = $order->id;

    $order_id = $orderid;

    //$email = get_post_meta( $order_id, '_approver_email', true );

		$order1 = new WC_Order( $order_id );
		$items = $order1->get_items();
		foreach ( $items as $item ) {
		    $product_name = $item['name'];
		    $product_id = $item['product_id'];
		    $product_variation_id = $item['variation_id'];
		}
		$term = get_the_terms( $product_id, 'yith_shop_vendor');
		$meta = get_metadata('term', $term[0]->term_id, 'owner');
		$user = get_user_by( 'id', $meta[0] );

		$email = $user->user_email;

	//$email = 'vamshi.chippa@indikrew.com';
    if ( $id == 'new_order' ) {
        $headers .= "Bcc: ".$email."\r\n"; // replace my_personal@email.com with your email
    }
    return $headers;
}	
// Add custom Theme Functions here
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );

function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}

// Remove update options 

add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );

// remove screen option 
function remove_screen_options_tab()
{
    return false;
}
add_filter('screen_options_show_screen', 'remove_screen_options_tab');

function hide_help() {
    echo '
'; } add_action('admin_head', 'hide_help');

//Change the Footer
function remove_footer_admin () {
    echo "This site is created by -Vivek ";
} 

add_filter('admin_footer_text', 'remove_footer_admin');

//Change the Standard WordPress Greeting

add_action( 'admin_bar_menu', 'wp_admin_bar_my_custom_account_menu', 11 );

function wp_admin_bar_my_custom_account_menu( $wp_admin_bar ) {
$user_id = get_current_user_id();
$current_user = wp_get_current_user();
$profile_url = get_edit_profile_url( $user_id );

if ( 0 != $user_id ) {
/* Add the "My Account" menu */
$avatar = get_avatar( $user_id, 28 );
$howdy = sprintf( __('Welcome, %1$s'), $current_user->display_name );
$class = empty( $avatar ) ? '' : 'with-avatar';

$wp_admin_bar->add_menu( array(
'id' => 'my-account',
'parent' => 'top-secondary',
'title' => $howdy . $avatar,
'href' => $profile_url,
'meta' => array(
'class' => $class,
),
) );

}
}
//Disable Update Reminders

if ( !current_user_can( 'edit_users' ) ) {
  add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
  add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}

//remove help 
add_action('admin_head', 'mytheme_remove_help_tabs');
function mytheme_remove_help_tabs() {
    $screen = get_current_screen();
    $screen->remove_help_tabs();
}

//Order only from 1 shop 
add_filter( 'woocommerce_add_cart_item_data', 'woo_custom_add_to_cart' );
function woo_custom_add_to_cart( $cart_item_data ) {
    global $woocommerce;
    $items = $woocommerce->cart->get_cart(); //getting cart items
    $_product = array();
    foreach($items as $item => $values) {
    $_product[] = $values['data']->post;
    }
    if(isset($_product[0]->ID)){ //getting first item from cart
    $product_in_cart_vendor_id = get_post_field( 'post_author', $_product[0]->ID);
    $prodId = (int) apply_filters( 'woocommerce_add_to_cart_product_id', $_GET['add-to-cart'] );
    $product_added_vendor_id = get_post_field( 'post_author', $prodId );

    if( $product_in_cart_vendor_id !== $product_added_vendor_id ){$woocommerce->cart->empty_cart();wc_add_notice(  __("You can only order items from 1 shop !", "wcvendors"));}
    return $cart_item_data; } 
}