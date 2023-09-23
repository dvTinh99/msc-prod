<?php
// Add custom Theme Functions here
//Copy từng phần và bỏ vào file functions.php của theme:
include dirname( __FILE__ ) . '/Classes/PHPExcel.php';
require_once dirname( __FILE__ ) . '/inc/api/BuildPC.php';
add_action('rest_api_init', function () {
    $all_terms = new all_terms;
});
//init
require_once dirname( __FILE__ ) . '/inc/init.php';
// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'flatsome_enqueue_scripts_styles' );
function flatsome_enqueue_scripts_styles() {
wp_enqueue_style( 'dashicons' );
wp_enqueue_style( 'flatsome-ionicons', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
}
function devvn_wc_custom_get_price_html( $price, $product ) {
    if ( $product->get_price() == 0 ) {
        if ( $product->is_on_sale() && $product->get_regular_price() ) {
            $regular_price = wc_get_price_to_display( $product, array( 'qty' => 1, 'price' => $product->get_regular_price() ) );
 
            $price = wc_format_price_range( $regular_price, __( 'Free!', 'woocommerce' ) );
        } else {
            $price = '<span class="amount">' . __( 'Giá: liên hệ', 'woocommerce' ) . '</span>';
        }
    }
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'devvn_wc_custom_get_price_html', 10, 2 );
function block(){
	echo do_shortcode('[block id="block-san-pham"]');
}add_action('flatsome_custom_single_product_1', 'block');


 /*-----------------Hiển thị danh mục con trong danh mục cha---------------------*/ 
function list_sub_product_category(){
if( !is_product() ): ;?>
<div class="list_sub_product_category" >
<?php
if (is_product_category())
{

    $term_id = get_queried_object_id();
    $taxonomy = 'product_cat';

    // Get subcategories of the current category
    $terms = get_terms(['taxonomy' => $taxonomy, 'hide_empty' => true, 'parent' => get_queried_object_id() ]);
    $output = ' <ul class="subcategories-list" style=" padding: 15px 0px; width: 100%; margin-bottom: 0;">';

    // Loop through product subcategories WP_Term Objects
    foreach ($terms as $term)
    {
        $term_link = get_term_link($term, $taxonomy);

        $output .= '<li style="list-style: none;margin-left: 0;" class="' . $term->slug . '"><a href="' . $term_link . '"><i class="fa fa-angle-double-right" aria-hidden="true"></i> ' . $term->name . '</a></li>';
    }

    echo $output .'</ul>';
	
	?>
	
	<?php
} ?>
  </div>
<?php
endif;
}
add_shortcode('filter_danh_muc', 'list_sub_product_category');

/*----------------- Tạo mã sản phẩm tự động---------------------*/ 
function create_sku_from_product_id($product_id){
    $sku = '';
    if(strlen($product_id) == 1){
        $sku = 'MSC-00'.$product_id;
    }elseif(strlen($product_id) == 2){
        $sku = 'MSC-0'.$product_id;
    }else{
        $sku = 'MSC-'.$product_id;
    }
    return $sku;
}
function auto_create_sku_after_post_product( $post_id, $post ) {
    if($post->post_type == "product"){
        $sku = create_sku_from_product_id($post_id);
        update_post_meta($post_id,'_sku',$sku);
    }
}
add_action( 'save_post','auto_create_sku_after_post_product', 20, 2 );
function translate_woocommerce($translation, $text, $domain) {
	if ($domain == 'woocommerce') {
		switch ($text) {
		case 'SKU':
		$translation = 'Mã số:';
		break;
		case 'SKU:':
		$translation = 'Mã số:';
		break;
	}
}
return $translation;
}

/*--------------Chuyển hướng 404 về trang chủ----------------*/ 
// add_action('wp', 'redirect_404_to_homepage', 1);
// function redirect_404_to_homepage() {
//     global $wp_query;
//     if ($wp_query->is_404) {
//         wp_redirect(get_bloginfo('url'),301)
//         ;exit;
//     }
// }


/*----------------- Thay đổi văn bản ------------------------------ */
function my_custom_translations( $strings ) {
	$text = array(
		'Đọc tiếp' 		=> '',
		'Lọc'			=> 'Danh mục',
		'Filters'		=> 'Bộ lọc',
// 		'Bộ Danh mục'	=>	'Bộ lọc',
// 		'All'	=>	'Tất cả',
// 		'Reset Tất cả'	=> 'Reset',

	// // 	'Reset all'		=> 	'Đặt lại',
	// 	'Show'			=>	'Hiển thị',
	// 	'Cancel'			=>	'Trở về'
	);
	$strings = str_ireplace( array_keys( $text ), $text, $strings );
	return $strings;
}
add_filter( 'gettext', 'my_custom_translations', 20 );

/*----------Nút add_to_cart Product-small---------------*/
add_shortcode( 'add_btn_cart', 'woocommerce_template_loop_add_to_cart' );

/*----------show trạng thái sản phẩm---------------*/
function show_product_status() {
	echo 'Tình trạng: <span class="status_text">'.get_post_meta( get_the_ID(), '_stock_status', true ).'</span>';
}add_shortcode('show__product__status', 'show_product_status');

/*-----------hiển thị lượt xem sản phẩm---------*/
add_action('wp', function() {

global $post;

$user_ip = $_SERVER['REMOTE_ADDR'];

$meta = get_post_meta( $post->ID, 'views_count', TRUE );

$meta = '' !== $meta ? explode( ',', $meta ) : array();
$meta = array_filter( array_unique( $meta ) );

if( ! in_array( $user_ip, $meta ) ) {

array_push( $meta, $user_ip );
update_post_meta( $post->ID, 'views_count', implode(',', $meta) );
}
});
function add_content_before_addtocart_button_func() {

        global $product;
        $id = $product->id;         
        $meta = get_post_meta( $id, 'views_count', TRUE );
        if(empty($meta))
        {
            $result = 0;
        }
        else
        {        
        $result = count(explode(',',$meta)); 
        }       
        echo "<div class='custom-visitor-count-st' style='font-size: 14px;border: 0;'>";
        echo "<i class='fa fa-eye'></i> ";
        echo "<span class='cv-value'>Lượt xem: ";
        echo $result;
        echo "</span></div>";
}add_shortcode('view_pr' , 'add_content_before_addtocart_button_func');


/*---------- synthetic ---------------*/
function synthetic(){
	?>
	<div class="tong_hop" style="font-size: 14px !important">
		<div class="status_product" style="padding-left: 0 !important;">
			<?php echo do_shortcode('[show__product__status]'); ?>
		</div>
		<div class="tra_gop">
			<a href="/huong-dan-mua-hang-tra-gop/" style="color: red;">Trả góp: 0%</a>
		</div>
		<div class="luot_xem">
			<?php  echo do_shortcode('[view_pr]'); ?>
		</div>
		<div class="like_share" style="border: 0 !important;">
			<iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fmscshop.vn%2F&width=150&layout=button_count&action=like&size=small&share=true&height=46&appId=997178554424717" width="150" height="46" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
		</div>
	</div>
<?php
}add_shortcode('synthetic' , 'synthetic');

/*---------------- LIke - ShAre-------------*/ 
// add_action( 'wp_footer', 'isures_likeshare_reg_script', 9999 );
// function isures_likeshare_reg_script() {
  
//    if ( is_product() ) {
  
//       echo '<div id="fb-root"></div><script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v6.0"></script>';
  
//    }
// }
// function like_share() {
  
//    echo '<div class="isures-btn--like_wrap">';
 
//    echo '<div class="fb-like" data-href="' . get_permalink() . '" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>';
  
//    echo '</div>';
// }	
// add_shortcode( 'like__share', 'like_share' );


/*---------- thông số sản phẩm ---------------*/
function thong__so_ky_thuat(){
	$thongso = get_field('thong_so_ky_thuat');
	if(isset($thongso)) {
	?>
	<div class="thong_so_ky_thuat">
		<div class="title_tskt">
			<h3>Thông số kỹ thuật</h3>
		</div>
		<div class="content_tskt">
		<?php 
			if(($thongso) != "") {
				echo $thongso; 
			}else{
				echo 'Đang cập nhật...';
			}	
		?>
		</div>
	</div>
<?php }else{ 
		?>
		<div class="thong_so_ky_thuat">
			<div class="title_tskt">
				<h3>Thông số kỹ thuật</h3>
			</div>
			<div class="content_tskt">
				Đang cập nhật...
			</div>
		</div>
	<?php
	}
}add_shortcode('thong_so_ky_thuat' , 'thong__so_ky_thuat');
	
/*---------- tóm tắt sản phẩm ---------------*/
function tom_tat(){
	$tomtat = get_field('tom_tat_sp');
	if(isset($tomtat)) {
	?>
<?php if(($tomtat) != "") { ?>
	<div class="tom_tat" style="padding: 10px 0;">
		<div class="title_tt">
			<h4 style="font-size: 14px;">Tóm Tắt Sản Phẩm</h4>
		</div>		
		<div class="content_tt">
			<?php echo $tomtat; ?>
		</div>
	</div>
	<?php } ?>
<?php }
}add_shortcode('tom__tat' , 'tom_tat');

/*-------------Bảo hành product single----------------*/
function baohanh(){
	$baohanh = get_field('bao_hanh');
	if(isset($baohanh)) {
	?>
<?php if(($baohanh) != "") { ?>
	<span class="bao_hanh">Bảo hành: <span class="sku"><?php echo $baohanh; ?></span></span>
	<?php } ?>
<?php }
}add_shortcode('bao_hanh' , 'baohanh');
/*-----------Bảo hành hover info  product ------------*/ 
function baohanhhover(){
	$baohanh = get_field('bao_hanh');
	if(isset($baohanh)) {
	?>
<?php if(($baohanh) != "") { ?>
	<span class="bao_hanh"><span class="sku"><?php echo $baohanh; ?></span></span>
	<?php } ?>
<?php }
}add_shortcode('bao_hanh_hover' , 'baohanhhover');

/*---------- khuyến mãi ---------------*/
function khuyen_mai(){
	$khuyenmai = get_field('khuyen_mai');
	if(isset($khuyenmai)) {
	?>
	<?php if(($khuyenmai) != "") { ?>
	<div class="detail-offer" style="margin: 10px 0;">
	   <div class="title-offer">
		  <span><i class="fa fa-gift"></i> Khuyến mại</span>
	   </div>
	   <div class="content-dt-offer">
		  <span style="white-space: pre-line"><?php echo $khuyenmai; ?></span>
	   </div>
	</div>
	<?php } ?>
<?php }
}add_shortcode('offer' , 'khuyen_mai');

/*---------- format giá ---------------*/
function devvn_price_html($product, $is_variation = false){
    ob_start();
 
    if($product->is_on_sale()):
    ?>
    <?php
    endif;
 
    if($product->is_on_sale() && ($is_variation || $product->is_type('simple') || $product->is_type('external'))) {
        $sale_price = $product->get_sale_price();
        $regular_price = $product->get_regular_price();
        if($regular_price) {
            $sale = round(((floatval($regular_price) - floatval($sale_price)) / floatval($regular_price)) * 100);
            $sale_amout = $regular_price - $sale_price;
            ?>
            <div class="devvn_single_price">
                <div>
                    <span class="label">Giá bán:</span>
                    <span class="devvn_price"><?php echo wc_price($sale_price); ?></span>
                </div>
                <div>
                    <span class="label">Giá niêm yết:</span>
                    <span class="devvn_price"><del><?php echo wc_price($regular_price); ?></del></span>
                </div>
                <div>
                    <span class="label">Tiết kiệm:</span>
                    <span class="devvn_price sale_amount"> <?php echo wc_price($sale_amout); ?> (<?php echo $sale; ?>%)</span>
                </div>
            </div>
            <?php
        }
    }elseif($product->is_on_sale() && $product->is_type('variable')){
        $prices = $product->get_variation_prices( true );
        if ( empty( $prices['price'] ) ) {
            $price = apply_filters( 'woocommerce_variable_empty_price_html', '', $product );
        } else {
            $min_price     = current( $prices['price'] );
            $max_price     = end( $prices['price'] );
            $min_reg_price = current( $prices['regular_price'] );
            $max_reg_price = end( $prices['regular_price'] );
 
            if ( $min_price !== $max_price ) {
                $price = wc_format_price_range( $min_price, $max_price ) . $product->get_price_suffix();
            } elseif ( $product->is_on_sale() && $min_reg_price === $max_reg_price ) {
                $sale = round(((floatval($max_reg_price) - floatval($min_price)) / floatval($max_reg_price)) * 100);
                $sale_amout = $max_reg_price - $min_price;
                ?>
                <div class="devvn_single_price">
                    <div>
                        <span class="label">Giá bán:</span>
                        <span class="devvn_price"><?php echo wc_price($min_price); ?></span>
                    </div>
                    <div>
                        <span class="label">Giá niêm yết:</span>
                        <span class="devvn_price"><del><?php echo wc_price($max_reg_price); ?></del></span>
                    </div>
                    <div>
                        <span class="label">Tiết kiệm:</span>
                        <span class="devvn_price sale_amount"> <?php echo wc_price($sale_amout); ?> (<?php echo $sale; ?>%)</span>
                    </div>
                </div>
                <?php
            } else {
                $price = wc_price( $min_price ) . $product->get_price_suffix();
            }
        }
        echo $price;
 
    }else{ ?>
        <p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) );?>"><?php echo 'Giá bán: '.$product->get_price_html(); ?></p>
    <?php }
    return ob_get_clean();
}
function woocommerce_template_single_price(){
    global $product;
    echo devvn_price_html($product);
}
add_filter('woocommerce_available_variation','devvn_woocommerce_available_variation', 10, 3);
function devvn_woocommerce_available_variation($args, $thisC, $variation){
    $old_price_html = $args['price_html'];
    if($old_price_html){
        $args['price_html'] = devvn_price_html($variation, true);
    }
    return $args;
}


/*---------- thu gọn chi tiết sản phẩm ---------------*/
add_action('wp_footer','devvn_readmore_flatsome');
function devvn_readmore_flatsome(){
    ?>
    <style>
        .single-product .product-section {
            overflow: hidden;
            position: relative;
            padding-bottom: 25px;
        }
        .single-product .product-section.panel:not(.active) {
            height: 0 !important;
        }
        .devvn_readmore_flatsome {
            text-align: center;
            cursor: pointer;
            position: absolute;
            z-index: 10;
            bottom: 0;
            width: 100%;
            background: #fff;
        }
        .devvn_readmore_flatsome:before {
            height: 55px;
            margin-top: -45px;
            content: "";
            background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
            background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 100%);
            background: linear-gradient(to bottom, rgba(255,255,255,0) 0%,rgba(255,255,255,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff00', endColorstr='#ffffff',GradientType=0 );
            display: block;
        }
        .devvn_readmore_flatsome a {
            color: #318A00;
            display: block;
        }
        .devvn_readmore_flatsome a:after {
            content: '';
            width: 0;
            right: 0;
            border-top: 6px solid ;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            display: inline-block;
            vertical-align: middle;
            margin: -2px 0 0 5px;
        }
        .devvn_readmore_flatsome_less a:after {
            border-top: 0;
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 6px solid;
        }
        .devvn_readmore_flatsome_less:before {
            display: none;
        }
    </style>
    <script>
        (function($){
            $(document).ready(function(){
                $(window).on('load', function(){
                    if($('.single-product .product-section').length > 0){
                        var wrap = $('.single-product .product-section');
                        var current_height = wrap.height();
                        var your_height = 300;
                        if(current_height > your_height){
                            wrap.css('height', your_height+'px');
                            wrap.append(function(){
                                return '<div class="devvn_readmore_flatsome devvn_readmore_flatsome_more"><a title="Xem thêm" href="javascript:void(0);">Xem thêm</a></div>';
                            });
                            wrap.append(function(){
                                return '<div class="devvn_readmore_flatsome devvn_readmore_flatsome_less" style="display: none;"><a title="Xem thêm" href="javascript:void(0);">Thu gọn</a></div>';
                            });
                            $('body').on('click','.devvn_readmore_flatsome_more', function(){
                                wrap.removeAttr('style');
                                $('body .devvn_readmore_flatsome_more').hide();
                                $('body .devvn_readmore_flatsome_less').show();
                            });
                            $('body').on('click','.devvn_readmore_flatsome_less', function(){
                                wrap.css('height', your_height+'px');
                                $('body .devvn_readmore_flatsome_less').hide();
                                $('body .devvn_readmore_flatsome_more').show();
                            });
                        }
                    }
                });
            })
        })(jQuery)
    </script>
    <?php
}

/*----------- Sản phẩm đã xem -----------*/
function isures_set_user_visited_product_cookie()
{
    if (!is_singular('product')) {
        return;
    }
 
    global $post;
 
    if (empty($_COOKIE['woocommerce_recently_viewed'])) { 
        $viewed_products = array();
    } else {
        $viewed_products = wp_parse_id_list((array) explode('|', wp_unslash($_COOKIE['woocommerce_recently_viewed']))); 
    }
 
    $keys = array_flip($viewed_products);
 
    if (isset($keys[$post->ID])) {
        unset($viewed_products[$keys[$post->ID]]);
    }
 
    $viewed_products[] = $post->ID;
 
    if (count($viewed_products) > 22) {
        array_shift($viewed_products);
    }
 
    wc_setcookie('woocommerce_recently_viewed', implode('|', $viewed_products));
}
add_action('wp', 'isures_set_user_visited_product_cookie');
function sp_xem()
{
    ob_start();
    $viewed_products = !empty($_COOKIE['woocommerce_recently_viewed']) ? (array) explode('|', wp_unslash($_COOKIE['woocommerce_recently_viewed'])) : array();
    $viewed_products = array_reverse(array_filter(array_map('absint', $viewed_products)));
?>
    <div id="isures-recently--wrap">
        <div class="isures-container">
            <?php
            if (!empty($viewed_products)) {
               echo do_shortcode('[products type="row" limit="6" columns="6" ids="' . implode(',', $viewed_products) . '"]');
            } else {
                echo 'Không có sản phẩm xem gần đây';
            }
 
            ?>
        </div>
    </div>
 
<?php
    return ob_get_clean();
}add_shortcode('sp_da_xem' , 'sp_xem');

/*------------- Thêm trạng thái kho hàng sản phẩm -> Add new stock status options---------------*/ 
// Add new stock status options
function filter_woocommerce_product_stock_status_options($status)
{
    // Add new statuses
    $status['Còn hàng'] = __('Còn hàng', 'woocommerce');
	$status['Hết hàng'] = __('Hết hàng', 'woocommerce');
	$status['Chờ hàng'] = __('Chờ hàng', 'woocommerce');
    $status['Ngừng kinh doanh'] = __('Ngừng kinh doanh', 'woocommerce');
    $status['Liên hệ'] = __('Liên hệ', 'woocommerce');
    return $status;
}
add_filter('woocommerce_product_stock_status_options', 'filter_woocommerce_product_stock_status_options', 10, 1);
// Availability text
function filter_woocommerce_get_availability_text($availability, $product)
{
    // Get stock status
    switch ($product->get_stock_status()) {
        case 'Còn hàng':
            $availability = __('Còn hàng', 'woocommerce');
            break;
		case 'Hết hàng':
            $availability = __('Hết hàng', 'woocommerce');
            break;
		case 'Chờ hàng':
            $availability = __('Chờ hàng', 'woocommerce');
            break;
		case 'Ngừng kinh doanh':
            $availability = __('Ngừng kinh doanh', 'woocommerce');
            break;
        case 'Liên hệ':
            $availability = __('Liên hệ', 'woocommerce');
            break;
    }
    return $availability;
}
add_filter('woocommerce_get_availability_text', 'filter_woocommerce_get_availability_text', 10, 2);

/*-------------Mini cart -> Đếm số lượng trong giỏ hàng ---------------*/ 
add_filter( 'woocommerce_add_to_cart_fragments', 'iconic_cart_count_fragments', 10, 1 );
function iconic_cart_count_fragments( $fragments ) {
    $fragments['div.header-cart-count'] = '<div class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</div>';
    return $fragments;
}
function cout_cart(){
	?>
<div class="header-cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></div>
<?php
}add_shortcode('cout_cart' , 'cout_cart');


/*----------------------- Nút mua hàng ngay ------------------------------*/
add_filter ('woocommerce_add_to_cart_redirect', 'redirect_to_checkout');
function redirect_to_checkout($checkout_url) {
    global $woocommerce;
    if($_GET['quick_buy']) {
        $checkout_url = $woocommerce->cart->get_checkout_url();
    }
    return $checkout_url;
}

/*------- Nút mua ngay + add_to_cart .PC. ----------*/
function muangay(){
	global $product;
	$id = $product->get_id();
	?>
	<style>
		.form_add_cart {
			width: 100%;
			float: left;
			text-align: center;
		}
		a.btn_add.btn_tragop {
			width: 100%;
			background: #fff;
			color: #fa9f2c !important;
			border: solid 1px #fa9f2c;
		}
		a.btn_add.btn_add_to_cart {
			background: #fa9f2c;
			float: right;
		}

		a.btn_add {
			color: #fff !important;
			text-align: center;
			padding: 8px 20px;
			border-radius: 5px;
			margin-bottom: 10px;
			float: left;
			font-size: 17px;
			background: #ed1b24;
			font-weight: 700;
			width: calc(50% - 5px);
		}
		a.btn_add span {
			font-weight: 400;
			font-size: 14px;
		}
	</style>
		<div class="form_add_cart">
			<div class="btnadd">
				<a href="?quick_buy=1&add-to-cart=<?php echo $id ?>" class="btn_add btn_muangay"> ĐẶT MUA NGAY<br><span>Giao hàng tận nơi nhanh chóng</span></a>
			</div>
			<div class="btnadd">
				<a href="?add-to-cart=<?php echo $id ?>" class="btn_add btn_add_to_cart "> THÊM VÀO GIỎ HÀNG<br><span>Thêm vào giỏ hàng để chọn tiếp</span></a>
			</div>
			<div class="btnadd">
				<a href="/huong-dan-mua-hang-tra-gop/" class="btn_add btn_tragop "> MUA TRẢ GÓP<br><span>Online qua cổng Alepay</span></a>
			</div>
		</div>
	
<?php
}add_shortcode('btn_mua_ngay' , 'muangay');

/*------- Nút mua ngay + add_to_cart .Mobile. ----------*/
function n_muangay(){
	global $product;
	$id = $product->get_id();
	?>
	<style>
		.n_form_add_cart {
			width: 100%;
			float: left;
			padding: 5px 0px;
			background: #30b68c;
			position: fixed;
			z-index: 99999999;
			bottom: 0px;
			left: 0px;
		}
		a.n_btn_add.n_btn_tragop {
			border: 0;
		}
		.n_btnadd a {
			width: 33.333%;
			float: left;
			text-align: center;
			border-right: solid 1px #e1e1e1;
				font-size: 12px;
			color: #fff;
		}
	</style>
		<div class="show-for-small n_form_add_cart">
			<div class="n_btnadd">
				<a href="?add-to-cart=<?php echo $id ?>" class="n_btn_add n_btn_add_to_cart "><i class="fa fa-cart-plus" aria-hidden="true"></i><br>Thêm vào giỏ hàng</a>
			</div>
			<div class="n_btnadd">
				<a href="?quick_buy=1&add-to-cart=<?php echo $id ?>" class="n_btn_add n_btn_muangay"><i class="fa-solid fa-money-bill-1"></i><br> Mua ngay</a>
			</div>
			
			<div class="n_btnadd">
				<a href="/huong-dan-mua-hang-tra-gop/" class="n_btn_add n_btn_tragop "><i class="fa fa-usd" aria-hidden="true"></i><br> Trả góp</a>
			</div>
		</div>
	
<?php
}add_action('flatsome_after_product_page' , 'n_muangay');


/*------- Ẩn soạn thảo văn bản mô tả ngắn sản phẩm ----------*/
add_action('admin_head', 'Hide_WooCommerce_Breadcrumb');

function Hide_WooCommerce_Breadcrumb() {
  echo '<style>
    div#postbox-container-2 #postexcerpt {
        display: none;
    }
    </style>';
}

/*------- Đổi tên tab product single ----------*/
add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 20 );
function woo_rename_tabs( $tabs ) {
	
	$tabs['description']['title'] = __( 'Giới thiệu sản phẩm');
	$tabs['reviews']['title'] = __( 'Đánh giá nhận xét');
	return $tabs;
}

/*------------ Đường dẫn -----------------*/
function hps_breadcrumbs() {
    /* === OPTIONS === */
    $text['home']     = 'Trang chủ'; // text for the 'Home' link
    $text['category'] = '%s'; // text for a category page
    $text['search']   = 'Kết quả tìm kiếm %s'; // text for a search results page
    $text['tag']      = 'Từ khóa %s'; // text for a tag page
    $text['author']   = '%s'; // text for an author page
    $text['404']      = 'Lỗi 404'; // text for the 404 page
    $text['page']     = '%s'; // text 'Page N'
    $text['cpage']    = '%s'; // text 'Comment Page N'
    $wrap_before    = '
 
 
<div class="hps__breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList"><div class="row row-small"><div class="col medium-12 small-12 large-12" style="padding: 20px 9.8px 20px"><div class="col-inner">'; // the opening wrapper tag
	
    $wrap_after     = '</div></div></div></div>
 
 
 
<!-- .breadcrumbs -->'; // the closing wrapper tag
    $sep            = ' / '; // separator between crumbs
    $sep_before     = '<span class="sep">'; // tag before separator
    $sep_after      = '</span>'; // tag after separator
    $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
    $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $show_current   = 1; // 1 - show current page title, 0 - don't show
    $before         = '<span class="current hps_breadcrumbs">'; // tag before the current crumb
    $after          = '</span>'; // tag after the current crumb
    /* === END OF OPTIONS === */
    global $post;
    $home_url       = home_url('/');
    $link_before    = '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">';
    $link_after     = '</span>';
    $link_attr      = ' itemprop="item"';
    $link_in_before = '<span itemprop="name" class="hps_breadcrumbs">';
    $link_in_after  = '</span>';
    $link           = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
    $frontpage_id   = get_option('page_on_front');
    $parent_id      = ($post) ? $post->post_parent : '';
    $sep            = ' ' . $sep_before . $sep . $sep_after . ' ';
    $home_link      = $link_before . '<a href="' . $home_url . '"' . $link_attr . ' class="home">' . $link_in_before . $text['home'] . $link_in_after . '</a>' . $link_after;
    if (is_home() || is_front_page()) {
        if ($show_on_home) echo $wrap_before . $home_link . $wrap_after;
    } else {
        echo $wrap_before;
        if ($show_home_link) echo $home_link;
        if ( is_category() ) {
            $cat = get_category(get_query_var('cat'), false);
            if ($cat->parent != 0) {
                $cats = get_category_parents($cat->parent, TRUE, $sep);
                $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
                $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
                if ($show_home_link) echo $sep;
                echo $cats;
            }
            if ( get_query_var('paged') ) {
                $cat = $cat->cat_ID;
                echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_current) echo $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
            }
        } elseif ( is_search() ) {
            if (have_posts()) {
                if ($show_home_link && $show_current) echo $sep;
                if ($show_current) echo $before . sprintf($text['search'], get_search_query()) . $after;
            } else {
                if ($show_home_link) echo $sep;
                echo $before . sprintf($text['search'], get_search_query()) . $after;
            }
        } elseif ( is_day() ) {
            if ($show_home_link) echo $sep;
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
            echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
            if ($show_current) echo $sep . $before . get_the_time('d') . $after;
        } elseif ( is_month() ) {
            if ($show_home_link) echo $sep;
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
            if ($show_current) echo $sep . $before . get_the_time('F') . $after;
        } elseif ( is_year() ) {
            if ($show_home_link && $show_current) echo $sep;
            if ($show_current) echo $before . get_the_time('Y') . $after;
        } elseif ( is_single() && !is_attachment() ) {
            if ($show_home_link) echo $sep;
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $home_url . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($show_current) echo $sep . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $sep);
                if (!$show_current || get_query_var('cpage')) $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
                $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
                echo $cats;
                if ( get_query_var('cpage') ) {
                    echo $sep . sprintf($link, get_permalink(), get_the_title()) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
                } else {
                    if ($show_current) echo $before . get_the_title() . $after;
                }
            }
        // custom post type
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            if ( get_query_var('paged') ) {
                echo $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_current) echo $sep . $before . $post_type->label . $after;
            }
        } elseif ( is_attachment() ) {
            if ($show_home_link) echo $sep;
            $parent = get_post($parent_id);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            if ($cat) {
                $cats = get_category_parents($cat, TRUE, $sep);
                $cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);
                echo $cats;
            }
            printf($link, get_permalink($parent), $parent->post_title);
            if ($show_current) echo $sep . $before . get_the_title() . $after;
        } elseif ( is_page() && !$parent_id ) {
            if ($show_current) echo $sep . $before . get_the_title() . $after;
        } elseif ( is_page() && $parent_id ) {
            if ($show_home_link) echo $sep;
            if ($parent_id != $frontpage_id) {
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    if ($parent_id != $frontpage_id) {
                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                    }
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) { echo $breadcrumbs[$i]; if ($i != count($breadcrumbs)-1) echo $sep; } } if ($show_current) echo $sep . $before . get_the_title() . $after; } elseif ( is_tag() ) { if ( get_query_var('paged') ) { $tag_id = get_queried_object_id(); $tag = get_tag($tag_id); echo $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_current) echo $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
            }
        } elseif ( is_author() ) {
            global $author;
            $author = get_userdata($author);
            if ( get_query_var('paged') ) {
                if ($show_home_link) echo $sep;
                echo sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_home_link && $show_current) echo $sep;
                if ($show_current) echo $before . sprintf($text['author'], $author->display_name) . $after;
            }
        } elseif ( is_404() ) {
            if ($show_home_link && $show_current) echo $sep;
            if ($show_current) echo $before . $text['404'] . $after;
        } elseif ( has_post_format() && !is_singular() ) {
            if ($show_home_link) echo $sep;
            echo get_post_format_string( get_post_format() );
        }
        echo $wrap_after;
    }
}add_shortcode('hps__breadcrumbs' , 'hps_breadcrumbs');
add_action('flatsome_before_page', 'hps_breadcrumbs');

/*--------------img login fb + GG----------------*/
function login_fb_gg(){
	if ( is_user_logged_in() ) {
		echo '<ul class="info" style="list-style: none;">';
		echo '<p class="name_user" style="margin-bottom: 5px;"><i class="fa fa-user" aria-hidden="true"></i> 
 Bạn đã đăng nhập với tên nick <b style="color: #30b68c"> ' . wp_get_current_user()->display_name.'</b></p>';
		echo '<li style="margin-left: 0;margin-bottom: 0;"><a href="/tai-khoan/edit-account/"><i class="fa fa-check-square" aria-hidden="true"></i> Thông tin tài khoản</a></li>';
		echo '<li style="margin-left: 0;margin-bottom: 0;"><a href="/tai-khoan/orders/"><i class="fa fa-th-list" aria-hidden="true"></i> Tất cả đơn hàng</a></li>';
		echo '<li style="margin-left: 0;margin-bottom: 0;"><a href="'. wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) .'"><i class="fa fa-sign-out" aria-hidden="true"></i>
 Đăng xuất</a></li>';
		echo '</ul>';
	} else {
		?>
		<div class="login_fb_gg" style="display: flex;align-items: center;flex-direction: column; ">
			<a href="#" class="login_gg"><img src="/wp-content/uploads/2022/07/log-in-with-google.jpg" width="157" height="30"/></a>
			<a href="#" class="login_fb"><img src="/wp-content/uploads/2022/07/log-in-with-facebook.jpg" width="157" height="30"/></a>
			<?php
			if ( empty(is_user_logged_in()) ) {
				echo '<a href="/tai-khoan/" style="font-size: 16px; font-weight: 600; color: #008080; padding: 10px ;">Đăng nhập tài khoản.</a>';
			}
			?>
		</div>
	<?php
	}
}
add_action('login_fb_gg' , 'login_fb_gg');

/*--------------img login fb + GG ++----------------*/
function login_fb_gg_(){
	if ( is_user_logged_in() ) {
		echo '<ul class="info" style="list-style: none;">';
		echo '<p class="name_user" style="margin-bottom: 5px;"><i class="fa fa-user" aria-hidden="true"></i> 
 Bạn đã đăng nhập với tên nick <b style="color: #30b68c"> ' . wp_get_current_user()->display_name.'</b></p>';
		echo '<li style="margin-left: 0;margin-bottom: 0;"><a href="/tai-khoan/edit-account/"><i class="fa fa-check-square" aria-hidden="true"></i> Thông tin tài khoản</a></li>';
		echo '<li style="margin-left: 0;margin-bottom: 0;"><a href="/tai-khoan/orders/"><i class="fa fa-th-list" aria-hidden="true"></i> Tất cả đơn hàng</a></li>';
		echo '<li style="margin-left: 0;margin-bottom: 0;"><a href="'. wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) .'"><i class="fa fa-sign-out" aria-hidden="true"></i>
 Đăng xuất</a></li>';
		echo '</ul>';
	} else {
		?>
		<div class="login_fb_gg" style="display: flex;align-items: center;flex-direction: column; ">
			<a href="#" class="login_gg"><img src="/wp-content/uploads/2022/07/log-in-with-google.jpg" width="157" height="30"/></a>
			<a href="#" class="login_fb"><img src="/wp-content/uploads/2022/07/log-in-with-facebook.jpg" width="157" height="30"/></a>
		</div>
	<?php
	}
}add_action('woocommerce_login_form_end' , 'login_fb_gg_');


/*---------------đếm sản phẩm trong danh mục----------------*/
function products_counter( $atts ) {
	echo 'Tìm thấy ... sản phẩm';

	?>
	
<?php
}
add_shortcode( 'product_count', 'products_counter' );

/*----------------Get user--------------*/
function get_current_users_id() {
    if ( is_user_logged_in() ) {
		echo '<ul class="info" style="list-style: none;">';
		echo '<p class="name_user" style="margin-bottom: 5px;"><i class="fa fa-user" aria-hidden="true"></i> 
 Bạn đã đăng nhập với tên nick <b style="color: #30b68c"> ' . wp_get_current_user()->display_name.'</b></p>';
		echo '<li style="margin-left: 0;margin-bottom: 0;"><a href="/tai-khoan/edit-account/"><i class="fa fa-check-square" aria-hidden="true"></i> Thông tin tài khoản</a></li>';
		echo '<li style="margin-left: 0;margin-bottom: 0;"><a href="/tai-khoan/orders/"><i class="fa fa-th-list" aria-hidden="true"></i> Tất cả đơn hàng</a></li>';
		echo '<li style="margin-left: 0;margin-bottom: 0;"><a href="'. wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) ) .'"><i class="fa fa-sign-out" aria-hidden="true"></i>
 Đăng xuất</a></li>';
		echo '</ul>';

	} else {
		?>
		<p>Bạn chưa là thành viên</p>
		<p>Đăng ký để hưởng nhiều lợi ích &amp; đặt mua hàng dễ dàng hơn.</p>
		<p><span style="color: #30b68c;"><strong><a style="color: #008080;" href="/dang-ky/">Đăng ký tài khoản</a></strong></span></p>
	<?php
	}
}add_shortcode('get_user' , 'get_current_users_id');



/*----------------Menu tin tức---------------*/
function register_my_menu() {
    register_nav_menu('tin-tuc-menu',__( 'Menu tin tức' ));
}
add_action( 'init', 'register_my_menu' );
function menutintuc(){
	?>
<?php wp_nav_menu( 
  array( 
      'theme_location' => 'tin-tuc-menu', 
      'container' => 'false', 
      'menu_id' => 'tin-tuc-menu', 
      'menu_class' => 'menu_tin_tuc'
   ) 
); ?>
<?php
}add_shortcode('menu_tin_tuc','menutintuc');

/*---------------------Bài viết xem nhiều-----------------*/
// 
