<?php
/**
 * Flatsome functions and definitions
 *
 * @package flatsome
 */

require get_template_directory() . '/inc/init.php';

/**
 * Note: It's not recommended to add any custom code here. Please use a child theme so that your customizations aren't lost during updates.
 * Learn more here: http://codex.wordpress.org/Child_Themes
 */
/*------------Trình soạn thảo văn bản danh mục sản phẩm*/
?>
<?php add_action( 'init', 'hps_product_cat_register_meta' );
function hps_product_cat_register_meta() {

    register_meta( 'term', 'details', 'hps_sanitize_details' );

}
function hps_sanitize_details( $details ) {

    return wp_kses_post( $details );

}
add_action( 'product_cat_add_form_fields', 'hps_product_cat_add_details_meta' );
function hps_product_cat_add_details_meta() {

    wp_nonce_field( basename( __FILE__ ), 'hps_product_cat_details_nonce' );

    ?>
    <div class="form-field">
        <label for="hps-product-cat-details"><?php esc_html_e( 'Banner danh mục', 'hps' ); ?></label>
        <textarea name="hps-product-cat-details" id="hps-product-cat-details" rows="5" cols="40"></textarea>
        <p class="description"><?php esc_html_e( 'Thông tin nhập ở đây sẽ hiển thị ở trang danh mục sản phẩm', 'hps' ); ?></p>
    </div>
    <?php

}
add_action( 'product_cat_edit_form_fields', 'hps_product_cat_edit_details_meta' );
function hps_product_cat_edit_details_meta( $term ) {

    $product_cat_details = get_term_meta( $term->term_id, 'details', true );

    if ( ! $product_cat_details ) {
        $product_cat_details = '';
    }

    $settings = array( 'textarea_name' => 'hps-product-cat-details' );
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="hps-product-cat-details"><?php esc_html_e( 'Banner danh mục', 'hps' ); ?></label></th>
        <td>
            <?php wp_nonce_field( basename( __FILE__ ), 'hps_product_cat_details_nonce' ); ?>
            <?php wp_editor( hps_sanitize_details( $product_cat_details ), 'product_cat_details', $settings ); ?>
            <p class="description"><?php esc_html_e( 'Thông tin nhập ở đây sẽ hiển thị ở trang danh mục sản phẩm','hps' ); ?></p>
        </td>
    </tr>
    <?php

}
?>
<?php add_action( 'create_product_cat', 'hps_product_cat_details_meta_save' );
add_action( 'edit_product_cat', 'hps_product_cat_details_meta_save' );
function hps_product_cat_details_meta_save( $term_id ) {

    if ( ! isset( $_POST['hps_product_cat_details_nonce'] ) || ! wp_verify_nonce( $_POST['hps_product_cat_details_nonce'], basename( __FILE__ ) ) ) {
        return;
    }
    $old_details = get_term_meta( $term_id, 'details', true );
    $new_details = isset( $_POST['hps-product-cat-details'] ) ? $_POST['hps-product-cat-details'] : '';

    if ( $old_details && '' === $new_details ) {
        delete_term_meta( $term_id, 'details' );
    } else if ( $old_details !== $new_details ) {
        update_term_meta(
            $term_id,
            'details',
            hps_sanitize_details( $new_details )
        );
    }
}
add_action( 'woocommerce_before_main_content', 'hps_product_cat_display_details_meta' );
function hps_product_cat_display_details_meta() {

    if ( ! is_tax( 'product_cat' ) ) {
        return;
    }

    $t_id = get_queried_object()->term_id;
    $details = get_term_meta( $t_id, 'details', true );

    if ( '' !== $details ) {
        ?>
        <div class="product-cat-details">
            <?php echo apply_filters( 'the_content', wp_kses_post( $details ) ); ?>
        </div>
        <?php
    }

}
// 
// 
