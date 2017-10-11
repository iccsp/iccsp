<?php

// - standalone json feed -

header('Content-Type:application/json');

// - grab wp load, wherever it's hiding -
if(file_exists('../../../../wp-load.php')) :
    include '../../../../wp-load.php';
else:
    include '../../../../../wp-load.php';
endif;

global $wpdb;

// - grab date barrier -
$oneyear = strtotime('-1 year') + ( get_option( 'gmt_offset' ) * 3600 );
// - grab date barrier -
//$today6am = strtotime('today 6:00') + ( get_option( 'gmt_offset' ) * 3600 );
 
// - query -
global $wpdb;
$current_user = wp_get_current_user();
//echo 'User ID: ' . $current_user->ID . '<br />';

$querystr = "SELECT * FROM $wpdb->posts wposts WHERE wposts.post_type = 'shop_order' AND wposts.post_status = 'wc-processing' AND wposts.post_author = ".$current_user->ID;
 
$events = $wpdb->get_results($querystr, OBJECT);

//print_r($events);exit();
$jsonevents = array();
 
// - loop -
if ($events):
global $post;
foreach ($events as $post):
setup_postdata($post);
 
// - custom post type variables -
//$custom = get_post_custom(2081);

//print_r($post);

$sd = $post->post_date;
$ed = $post->post_date;
//echo $sd;
//exit();
 
// - grab gmt for start -
$gmts = date('Y-m-d H:i:s', $sd);
$gmts = get_gmt_from_date($gmts); // this function requires Y-m-d H:i:s
$gmts = strtotime($gmts);
 
// - grab gmt for end -
$gmte = date('Y-m-d H:i:s', $ed);
$gmte = get_gmt_from_date($gmte); // this function requires Y-m-d H:i:s
$gmte = strtotime($gmte);
 
// - set to ISO 8601 date format -
$stime = date('c', $gmts);
$etime = date('c', $gmte);

$order = new WC_Order( $post->ID );
$items = $order->get_items();
foreach ( $items as $item ) {
$product_name = $item['name'];
$product_id = $item['product_id'];
$product_variation_id = $item['variation_id'];
}
# get email and name from this object
$name = $order->billing_first_name .' '. $order->billing_last_name;
$location = $order->billing_address_2;
//echo $order->billing_first_name;
//print_r($order);exit;
 
// - json items -
$jsonevents[]= array(
    'title' => $post->ID,
    'allDay' => false, //  $stime,
    'start' => $sd,
    'end' => $ed,
    'url' => get_site_url().'/wp-admin/post.php?post='.$post->ID.'&action=edit',
    'name' => $name,
    'location' => $location,
    'product_name' => $product_name
    );

//echo json_encode($jsonevents);


endforeach;
else :
endif;
 
// - fire away -
echo json_encode($jsonevents);

?>