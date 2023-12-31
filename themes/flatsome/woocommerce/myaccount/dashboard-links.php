<ul class="dashboard-links">
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
  	<?php echo do_shortcode('[block id="banner-tai-khoan"]'); ?>
  <?php do_action('flatsome_account_links'); ?>
<?php } ?>
</ul>