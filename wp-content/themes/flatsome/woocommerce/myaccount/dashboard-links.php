<ul class="dashboard-links">


<li class="woocommerce-MyAccount-navigation-link woocommerce-MyAccount-navigation-link--subscriptions">
      <a href="<?php echo site_url('vendor-dashboard')?>">Vendor Dashboard</a>
</li>

<?php if ( has_nav_menu( 'my_account' ) ) { ?>
  <?php  
    wp_nav_menu(array(
      'theme_location' => 'my_account',
      'container'      => false,
      'items_wrap' => '%3$s',
      'depth' => 1
    ));
  ?>
<?php } else if(!function_exists('wc_get_account_menu_items')) { ?>
    <li>Define your My Account dropdown menu in <b>Appearance > Menus</b></li>
<?php } ?>

<?php if(function_exists('wc_get_account_menu_items') && flatsome_option('wc_account_links')){ ?>
  <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
    <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
      <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
    </li>
  <?php endforeach; ?>
  <?php do_action('flatsome_account_links'); ?>
<?php } ?>

</ul>