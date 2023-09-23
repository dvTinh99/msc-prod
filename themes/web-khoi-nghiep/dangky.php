<?php /* Template Name: Đăng Ký */ ?>
<?php
/**
 * The template for displaying all pages.
 *
 * @package flatsome
 */


if(flatsome_option('pages_template') != 'default') {
	
	// Get default template from theme options.
	get_template_part('page', flatsome_option('pages_template'));
	return;

} else {

get_header();
do_action( 'flatsome_before_page' ); ?>
<div id="content" class="content-area page-wrapper" role="main">
	<div class="row row-large row-dashed" style="justify-content: center;">
		<div class="col small-12 large-12">
		   <div class="col-inner">
			<h2>Chào mừng bạn đến với MSCShop!</h2>
	   </div>
	</div>
		<div class="large-6 col">
			<div class="col-inner">
				
				<?php if(get_theme_mod('default_title', 0)){ ?>
				<header class="entry-header">
					<h1 class="entry-title mb uppercase"><?php the_title(); ?></h1>
				</header>
				<?php } ?>

				<?php if(is_user_logged_in()) { $user_id = get_current_user_id();$current_user = wp_get_current_user();$profile_url = get_author_posts_url($user_id);$edit_profile_url = get_edit_profile_url($user_id); ?>
<div style="margin-top: 20px;">
	<?php echo do_shortcode('[block id="banner-tai-khoan"]'); ?>
				</div>
				
<?php } else { ?>
<!--display error/success message-->
<ul class="woocommerce-error message-wrapper" role="alert" style="padding: 0 !important; padding-top: 0.75em !important; ">
   <li style="margin-left: 0;">
		 <?php $err = ''; $success = ''; global $wpdb, $PasswordHash, $current_user, $user_ID; if(isset($_POST['task']) && $_POST['task'] == 'register' ) { $pwd1 = $wpdb->escape(trim($_POST['pwd1']));
        $pwd2 = $wpdb->escape(trim($_POST['pwd2']));
        $email = $wpdb->escape(trim($_POST['email']));
        $username = $wpdb->escape(trim($_POST['username']));
 		$hoten = $wpdb->escape(trim($_POST['hoten']));
        if( $email == "" || $pwd1 == "" || $pwd2 == "" || $username == "") {
            $err = 'Vui lòng không bỏ trống những thông tin bắt buộc!';
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $err = 'Địa chỉ Email không hợp lệ!.';
        } else if(email_exists($email) ) {
            $err = 'Địa chỉ Email đã tồn tại!.';
        } else if($pwd1 <> $pwd2 ){
            $err = '2 Password không giống nhau!.';
        } else {
            $user_id = wp_insert_user( array ('user_pass' => apply_filters('pre_user_user_pass', $pwd1), 'user_login' => apply_filters('pre_user_user_login', $username), 'display_name' => apply_filters('pre_user_display_name', $hoten), 'user_email' => apply_filters('pre_user_user_email', $email), 'role' => 'subscriber' ) );
            if( is_wp_error($user_id) ) {
                $err = 'Error on user creation.';
            } else {
                do_action('user_register', $user_id);
                $success = 'Bạn đã đăng ký thành công!';
            }
        }
    }
    ?>

		<div id="message" >
			<?php
				if(! empty($err) ) :
					echo '<div class="alert-color">'.$err.'</div>';
				endif;
			?>
			<?php
				if(! empty($success) ) :
					$login_page  = home_url( '/tai-khoan' );
					echo '<div class="success-color" >'.$success. '<a href='.$login_page.'> Đăng nhập</a>'.'</div>';
				endif;
			?>
    	</div>
	</li>
</ul>
<div class="dangkytaikhoan">
	<h3 class="uppercase">Đăng ký</h3>
    <form class="form-horizontal" method="post" role="form">
<div class="form-group">
    <div class="col-sm-9">
    <input type="text" class="form-control" name="username" id="username" placeholder="Tên Đăng nhập *">
    </div>
</div>
<div class="form-group">
    <div class="col-sm-9">
        <input type="email" class="form-control" name="email" id="email" placeholder="Email *">
    </div>
</div>
		<div class="form-group">
    <div class="col-sm-9">
        <input type="text" class="form-control" name="hoten" id="hoten" placeholder="Họ và tên *">
    </div>
</div>
<div class="form-group">
    <div class="col-sm-9">
        <input type="password" class="form-control" name="pwd1" id="pwd1" placeholder="Mật khẩu *">
    </div>
</div>
<div class="form-group">
    <div class="col-sm-9">
        <input type="password" class="form-control" name="pwd2" id="pwd2" placeholder="Nhập lại mật khẩu *">
    </div>
</div>
<?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9" style=" text-align: center; ">
    <button type="submit" class="btn button btn-primary" style="color: #fff">Đăng ký</button>
    <input type="hidden" name="task" value="register" />
    </div>
</div>
</form>
</div>
<div class="thongbaologin">
    <?php
        $login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
        if ( $login === "failed" ) {
                echo '<strong>ERROR:</strong> Sai username hoặc mật khẩu.!';
        } elseif ( $login === "empty" ) {
                echo '<strong>ERROR:</strong> Username và mật khẩu không thể bỏ trống.';
        } elseif ( $login === "false" ) {
                echo '<strong>ERROR:</strong> Bạn đã thoát ra.';
        }
    ?>
</div>
 
<?php } ?>
			</div>
		</div>
		<div class="large-6 col">
			<div class="col-inner dang_kyyy">
				 <div class="text woocommerce dang_ky" >
					 <style>
					 	.dang_kyyy .login_fb_gg a {
							margin: 10px 0;
						}

						.dang_kyyy .login_fb_gg {
							display: flex;
							flex-direction: column;
						}
					 </style>
					<?php do_action( 'login_fb_gg' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
do_action( 'flatsome_after_page' );
get_footer();

}

?>