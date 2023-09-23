<?php
/**
 * Plugin Name: Liên Hệ - THV
 * Plugin URI: https://haphuocson.com
 * Description: Nút: Messenger - Zalo - Hotline ....
 * Version: 1.0.1 
 * Author: Hà Phước Sơn
 * Author URI: https://www.facebook.com/STllYoung
 * License: GPLv2 
 */
  function add_cd_option()
{
    add_submenu_page(
            'options-general.php',
            'Liên Hệ - THV',
            'Liên Hệ - THV',
            'manage_options',
            'lien_he_thv',
            'cd_menu_option'
    );
}add_action('admin_menu', 'add_cd_option');
function cd_menu_option()
{
	
    if (!empty($_POST['save']))
    {
        $zalo = $_POST['zalo-ring'];
        $messenger = $_POST['mess-ring'];
        $hotline = $_POST['hotline-ring'];
		
		//color_bg_ic_hotline
		$color_bg_ic_hotline = $_POST['color_bg_ic_hotline'];
		$color_bg_ic_zalo = $_POST['color_bg_ic_zalo'];
		$color_bg_ic_mess = $_POST['color_bg_ic_mess'];
       
		//color_bg_Overlay_hotline
		$color_bg_Overlay_hotline = $_POST['color_bg_Overlay_hotline'];
		$color_bg_Overlay_zalo = $_POST['color_bg_Overlay_zalo'];
		$color_bg_Overlay_mess = $_POST['color_bg_Overlay_mess'];
		
		//radio_left_right
		if(isset($_POST['radio_left_right'])){
				$radio_left_right = $_POST['radio_left_right'];
			}  else {
				$radio_left_right = false;
			}
        //disable_enabled_mess
        if(isset($_POST['disable_enabled_mess'])){
                $disable_enabled_mess = $_POST['disable_enabled_mess'];
            }  else {
                $disable_enabled_mess = false;
            }
        //disable_enabled_zalo
        if(isset($_POST['disable_enabled_zalo'])){
                $disable_enabled_zalo = $_POST['disable_enabled_zalo'];
            }  else {
                $disable_enabled_zalo = false;
            }
        //disable_enabled_hotline
        if(isset($_POST['disable_enabled_hotline'])){
                $disable_enabled_hotline = $_POST['disable_enabled_hotline'];
            }  else {
                $disable_enabled_hotline = false;
            }
		
		// text_indent
		$text_indent = $_POST['text_indent'];

        // bottom_mar
        $bottom_mar = $_POST['bottom_mar'];
		
	
        update_option('zalo', $zalo);
        update_option('messenger', $messenger);
        update_option('hotline', $hotline);
		
		//update color_bg_ic_hotline
		update_option('color_bg_ic_hotline', $color_bg_ic_hotline);
		update_option('color_bg_ic_zalo', $color_bg_ic_zalo);
		update_option('color_bg_ic_mess', $color_bg_ic_mess);
		
		//update color_bg_Overlay_hotline
		update_option('color_bg_Overlay_hotline', $color_bg_Overlay_hotline);
		update_option('color_bg_Overlay_zalo', $color_bg_Overlay_zalo);
		update_option('color_bg_Overlay_mess', $color_bg_Overlay_mess);
		
		//update radio_left_right
		update_option('radio_left_right', $radio_left_right);
        //update disable_enabled_mess
        update_option('disable_enabled_mess', $disable_enabled_mess);
        //update disable_enabled_zalo
        update_option('disable_enabled_zalo', $disable_enabled_zalo);
        //update disable_enabled_hotline
        update_option('disable_enabled_hotline', $disable_enabled_hotline);
		
		//update text_indent
		update_option('text_indent', $text_indent);

        //update bottom_mar
        update_option('bottom_mar', $bottom_mar);
    }
    // Get thông tin
    $zalo = get_option('zalo');
    $messenger = get_option('messenger');
    $hotline = get_option('hotline');
	
	//Get thông tin color_bg_ic_hotline
	$color_bg_ic_hotline = get_option('color_bg_ic_hotline');
	$color_bg_ic_zalo = get_option('color_bg_ic_zalo');
	$color_bg_ic_mess = get_option('color_bg_ic_mess');
	
	//Get thông tin color_bg_Overlay_hotline
	$color_bg_Overlay_hotline = get_option('color_bg_Overlay_hotline');
	$color_bg_Overlay_zalo = get_option('color_bg_Overlay_zalo');
	$color_bg_Overlay_mess = get_option('color_bg_Overlay_mess');
   
	//Get thông tin radio_left_right
	$radio_left_right = get_option('radio_left_right');
    //Get thông tin disable_enabled_mess
    $disable_enabled_mess = get_option('disable_enabled_mess');
    //Get thông tin disable_enabled_zalo
    $disable_enabled_zalo = get_option('disable_enabled_zalo');
    //Get thông tin disable_enabled_hotline
    $disable_enabled_hotline = get_option('disable_enabled_hotline');
	
	//Get thông tin text_indent
	$text_indent = get_option('text_indent');

    //Get thông tin bottom_mar
    $bottom_mar = get_option('bottom_mar');
	
    require('cai-dat-lien-he.php');
}
function hien_thi(){
	?> 

<!-- Star   -->
<div class="ring-wrap" >
<!-- 	Star Mess      -->
<div class="mess-ring" style="display: <?php echo get_option('disable_enabled_mess'); ?> !important;">
    <div class="mess-ring-img-circle">
        <a href="<?php echo get_option('messenger'); ?>" target="_blank" class="pps-btn-img">
        <img src="<?php echo plugins_url('images/mess.png', __FILE__); ?>" alt="" width="50" />
        </a>
    </div>
</div>
<!--  End Mess	 -->
<!-- 	Star hotline   -->
<div class="hotline-phone-ring ring-ring hide-for-medium" style="display: <?php echo get_option('disable_enabled_hotline'); ?> ;bottom: 10px;">
    <div class="hotline-phone-ring-img-circle ring-ring-img">
        <a href="tel:<?php echo get_option('hotline'); ?>" class="pps-btn-img">
        <img src="<?php echo plugins_url('images/phone.png', __FILE__); ?>" alt="" width="50" style="transform: <?php $img_right = get_option('radio_left_right'); if($img_right !='right'){echo 'initial';}else{echo "scaleX(-1)";} ?>"/>
        </a>
    </div>
</div>

<!--  End hotline   -->
<!--     -->
<div class="fb-ring ring-ring ">
    <div class="fb-ring-img-circle ring-ring-img">
        <a href="https://www.facebook.com/mscshop.vn/" target="_blank" class="pps-btn-img">
        <i class="fa-brands fa-facebook-f"></i>
        </a>
    </div>
</div>
<!--  	 -->
<div class="ytb-ring ring-ring ">
    <div class="ytb-ring-img-circle ring-ring-img" style="background-color: #ff0000;">
        <a href="https://youtube.com/channel/UCE0Jp4qWhb4PCMCoGLEmCKw" target="_blank" class="pps-btn-img">
        <i class="fa-brands fa-youtube"></i>
        </a>
    </div>
</div>
<!--  	 -->
<!--  	 -->
<div class="email-ring ring-ring hide-for-medium">
    <div class="email-ring-img-circle ring-ring-img" style="background-color: #4267b2;">
        <a href="mailto: minhsangcomputer2022@gmail.com" target="_blank" class="pps-btn-img">
        <i class="fa-solid fa-envelope"></i>
        </a>
    </div>
</div>
<!--  	 -->
<!--  	 -->
<div class="build-ring ring-ring hide-for-medium">
    <div class="build-ring-img-circle ring-ring-img" style="background-color: #4267b2;">
        <a href="https://mscshop.vn/xay-dung-cau-hinh-pc/" target="_blank" class="pps-btn-img">
        <i class="fa-solid fa-wrench"></i>
        </a>
    </div>
</div>
<!--  	 -->
<!-- 	Star zalo   -->
<div class="zalo-ring ring-ring" style="display: <?php echo get_option('disable_enabled_zalo'); ?> !important;">
    <div class="zalo-ring-img-circle ring-ring-img">
        <a href="https://zalo.me/<?php echo get_option('zalo'); ?>" target="_blank" class="pps-btn-img">
        <img src="<?php echo plugins_url('images/zalo-img.png', __FILE__); ?>" alt="" width="50" />
        </a>
    </div>
</div>
<!--  End Zalo	 -->

</div>
<!--  End  -->
<div class="all_contact show-for-small">
	<div class="phone_contact" style="background: #0090fe;width: 50%; float: left; text-align: center; color: fff;">
		<a href="tel:088.68.86.339"><i class="fas fa-phone"></i> GỌI MUA HÀNG</a>
	</div>
	<div class="address_contact" style="background: #ff0000;width: 50%; float: left; text-align: center; color: fff;">
		<a href="https://goo.gl/maps/LSK59dz3nkcX4nA46"><i class="fas fa-map-marker-alt"></i> SHOWROOM</a>
	</div>
</div>
<style>
	.ring-ring {
		position: relative;
		visibility: visible;
		background-color: transparent !important;
		width: 50px !important;
		height: 50px !important;
		cursor: pointer;
		z-index: 11;
		-webkit-backface-visibility: hidden;
		-webkit-transform: translateZ(0);
		transition: visibility .5s;
		left: -8px;
		bottom: 10px;
		display: block;
		border-radius: 99px;
		line-height: 65px;
		text-align: center;
	}
	.ring-ring-img {
		background-color: #4267b2;
		width: 40px !important;
		height: 40px !important;
		top: 37px;
		left: 37px;
		position: absolute;
		background-size: 20px;
		border-radius: 100%;
		border: 2px solid transparent;
		-webkit-animation: phonering-alo-circle-img-anim 1s infinite ease-in-out;
		animation: phonering-alo-circle-img-anim 1s infinite ease-in-out;
		-webkit-transform-origin: 50% 50%;
		-ms-transform-origin: 50% 50%;
		transform-origin: 50% 50%;
		display: -webkit-box;
		display: -webkit-flex;
		display: -ms-flexbox;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.ring-ring-img i {
		color: #fff;
	}
	.all_contact{
		position: fixed;
		bottom: 0;
		width: 100%;
		z-index: 99999;
	}
	.all_contact div a {
		color: #fff;
	}
	.all_contact div {
		padding: 10px 0;
	}
/* wrap */

.ring-wrap {
    position: fixed;
    bottom: 19%;
    <?php echo get_option('radio_left_right'); ?>: 0;
    z-index: 999999;
}


/* Mess */

.mess-ring {
    position: relative;
    visibility: visible;
    background-color: transparent;
    width: 110px;
    height: 65px;
    cursor: pointer;
    z-index: 11;
    -webkit-backface-visibility: hidden;
    -webkit-transform: translateZ(0);
    transition: visibility .5s;
    left: -10px;
    bottom: 15px;
    display: block;
}

.mess-ring-circle {
    width: 90px;
    height: 90px;
    top: 17px;
    left: 17px;
    position: absolute;
    background-color: transparent;
    border-radius: 100%;
    border: 2px solid <?php echo get_option('color_bg_Overlay_mess'); ?>;
    -webkit-animation: phonering-alo-circle-anim 1.2s infinite ease-in-out;
    animation: phonering-alo-circle-anim 1.2s infinite ease-in-out;
    transition: all .5s;
    -webkit-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
    opacity: 0.5;
}

.mess-ring-circle-fill {
    width: 70px;
    height: 70px;
    top: 27px;
    left: 27px;
    position: absolute;
    background-color: <?php echo get_option('color_bg_Overlay_mess'); ?>;
    border-radius: 100%;
    border: 2px solid transparent;
    -webkit-animation: phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;
    animation: phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;
    transition: all .5s;
    -webkit-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
}

.mess-ring-img-circle {
    background-color: <?php echo get_option('color_bg_ic_mess'); ?>;
    width: 50px;
    height: 50px;
    top: 37px;
    left: 37px;
    position: absolute;
    background-size: 20px;
    border-radius: 100%;
    border: 2px solid transparent;
    -webkit-animation: phonering-alo-circle-img-anim 1s infinite ease-in-out;
    animation: phonering-alo-circle-img-anim 1s infinite ease-in-out;
    -webkit-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    align-items: center;
    justify-content: center;
}

.mess-ring-img-circle .pps-btn-img {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
}

.mess-ring-img-circle .pps-btn-img img {
    width: 45px;
    height: 45px;
}


/* zalo	 */

.zalo-ring {
    position: relative;
    visibility: visible;
    background-color: transparent;
    width: 110px;
    height: 65px;
    cursor: pointer;
    z-index: 11;
    -webkit-backface-visibility: hidden;
    -webkit-transform: translateZ(0);
    transition: visibility .5s;
    left: -10px;
    bottom: 10px;
    display: block;
}

.zalo-ring-circle {
    width: 90px;
    height: 90px;
    top: 17px;
    left: 17px;
    position: absolute;
    background-color: transparent;
    border-radius: 100%;
    border: 2px solid <?php echo get_option('color_bg_Overlay_zalo'); ?>;
    -webkit-animation: phonering-alo-circle-anim 1.2s infinite ease-in-out;
    animation: phonering-alo-circle-anim 1.2s infinite ease-in-out;
    transition: all .5s;
    -webkit-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
    opacity: 0.5;
}

.zalo-ring-circle-fill {
    width: 70px;
    height: 70px;
    top: 27px;
    left: 27px;
    position: absolute;
    background-color: <?php echo get_option('color_bg_Overlay_zalo'); ?>;
    border-radius: 100%;
    border: 2px solid transparent;
    -webkit-animation: phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;
    animation: phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;
    transition: all .5s;
    -webkit-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
}

.zalo-ring-img-circle {
    background-color: <?php echo get_option('color_bg_ic_zalo'); ?>;
    width: 50px;
    height: 50px;
    top: 37px;
    left: 37px;
    position: absolute;
    background-size: 20px;
    border-radius: 100%;
    border: 2px solid transparent;
    -webkit-animation: phonering-alo-circle-img-anim 1s infinite ease-in-out;
    animation: phonering-alo-circle-img-anim 1s infinite ease-in-out;
    -webkit-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    align-items: center;
    justify-content: center;
}

.zalo-ring-img-circle .pps-btn-img {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
}




/* Hotline	 */

.hotline-phone-ring {
    position: relative;
    visibility: visible;
    background-color: transparent;
    width: 110px;
    height: 110px;
    cursor: pointer;
    z-index: 11;
    -webkit-backface-visibility: hidden;
    -webkit-transform: translateZ(0);
    transition: visibility .5s;
    left: -8px;
    bottom: 0;
    display: block;
}

.hotline-phone-ring-circle {
    width: 90px;
    height: 90px;
    top: 17px;
    left: 17px;
    position: absolute;
    background-color: transparent;
    border-radius: 100%;
    border: 2px solid <?php echo get_option('color_bg_Overlay_hotline'); ?>;
    -webkit-animation: phonering-alo-circle-anim 1.2s infinite ease-in-out;
    animation: phonering-alo-circle-anim 1.2s infinite ease-in-out;
    transition: all .5s;
    -webkit-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
    opacity: 0.5;
}

.hotline-phone-ring-circle-fill {
    width: 70px;
    height: 70px;
    top: 27px;
    left: 27px;
    position: absolute;
    background-color: <?php echo get_option('color_bg_Overlay_hotline'); ?>;
    border-radius: 100%;
    border: 2px solid transparent;
    -webkit-animation: phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;
    animation: phonering-alo-circle-fill-anim 2.3s infinite ease-in-out;
    transition: all .5s;
    -webkit-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
}

.hotline-phone-ring-img-circle {
    background-color: <?php echo get_option('color_bg_ic_hotline'); ?>;
    width: 50px;
    height: 50px;
    top: 37px;
    left: 37px;
    position: absolute;
    background-size: 20px;
    border-radius: 100%;
    border: 2px solid transparent;
    -webkit-animation: phonering-alo-circle-img-anim 1s infinite ease-in-out;
    animation: phonering-alo-circle-img-anim 1s infinite ease-in-out;
    -webkit-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    align-items: center;
    justify-content: center;
}

.hotline-phone-ring-img-circle .pps-btn-img {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
}

.hotline-phone-ring-img-circle .pps-btn-img img {
    width: 30px;
    height: 30px;
}

.hotline-bar {
    position: absolute;
    background: <?php echo get_option('color_bg_Overlay_hotline'); ?>;
    height: 37px;
    width: 220px;
    line-height: 40px;
    border-radius: 3px;
    padding: 0 10px;
    background-size: 100%;
    cursor: pointer;
    transition: all 0.8s;
    -webkit-transition: all 0.8s;
    z-index: 9;
    box-shadow: 0 14px 28px rgb(0 0 0 / 25%), 0 10px 10px rgb(0 0 0 / 10%);
    border-radius: 50px !important;
    /* width: 175px !important; */
    <?php echo get_option('radio_left_right'); ?>: 30px;
    bottom: 30px;
}

.hotline-bar>a {
	color: #fff;
    text-decoration: none;
    font-size: 20px;
    font-weight: bold;
    text-indent: <?php echo get_option('text_indent'); ?>px;
    display: block;
    letter-spacing: 1px;
    line-height: 38px;
    font-family: Arial;
}

.hotline-bar>a:hover,
.hotline-bar>a:active {
    color: #fff;
}

@-webkit-keyframes phonering-alo-circle-anim {
    0% {
        -webkit-transform: rotate(0) scale(0.5) skew(1deg);
        -webkit-opacity: 0.1;
    }
    30% {
        -webkit-transform: rotate(0) scale(0.7) skew(1deg);
        -webkit-opacity: 0.5;
    }
    100% {
        -webkit-transform: rotate(0) scale(1) skew(1deg);
        -webkit-opacity: 0.1;
    }
}

@-webkit-keyframes phonering-alo-circle-fill-anim {
    0% {
        -webkit-transform: rotate(0) scale(0.7) skew(1deg);
        opacity: 0.6;
    }
    50% {
        -webkit-transform: rotate(0) scale(1) skew(1deg);
        opacity: 0.6;
    }
    100% {
        -webkit-transform: rotate(0) scale(0.7) skew(1deg);
        opacity: 0.6;
    }
}

@-webkit-keyframes phonering-alo-circle-img-anim {
    0% {
        -webkit-transform: rotate(0) scale(1) skew(1deg);
    }
    10% {
        -webkit-transform: rotate(-25deg) scale(1) skew(1deg);
    }
    20% {
        -webkit-transform: rotate(25deg) scale(1) skew(1deg);
    }
    30% {
        -webkit-transform: rotate(-25deg) scale(1) skew(1deg);
    }
    40% {
        -webkit-transform: rotate(25deg) scale(1) skew(1deg);
    }
    50% {
        -webkit-transform: rotate(0) scale(1) skew(1deg);
    }
    100% {
        -webkit-transform: rotate(0) scale(1) skew(1deg);
    }
}

@media (max-width: 768px) {
	.ring-wrap {
		z-index: 99;
		bottom: 19% !important;
	}
    /*  hotline  */
    .hotline-bar {
        display: none !important;
    }
    .hotline-phone-ring {
        left: -8px;
    }
    /* 	mess */
	.mess-ring{
		bottom: 0px;
	}
    .mess-ring-circle {
		width: 85px;
		height: 85px;
		top: 11px;
		left: 11px;
    }
    .mess-ring-circle-fill {
        width: 55px;
		height: 55px;
		top: 26px;
		left: 26px;
    }
    .mess-ring-img-circle {
        width: 40px;
        height: 40px;
        top: 34px;
        left: 34px;
    }
    .mess-ring-img-circle .pps-btn-img img {
        width: 30px;
        height: 30px;
    }
    /* 	zalo */
	.zalo-ring{
		bottom: 0px;
	}
    .zalo-ring-circle {
        width: 85px;
        height: 85px;
        top: 11px;
        left: 11px;
    }
    .zalo-ring-circle-fill {
        width: 55px;
		height: 55px;
		top: 26px;
		left: 26px;
    }
    .zalo-ring-img-circle {
        width: 40px;
        height: 40px;
        top: 34px;
        left: 34px;
    }
    .zalo-ring-img-circle .pps-btn-img img {
        width: 30px;
        height: 30px;
    }
    /* 	hotline */
    .hotline-phone-ring-circle {
        width: 85px;
        height: 85px;
        top: 11px;
        left: 11px;
    }
    .hotline-phone-ring-circle-fill {
        width: 55px;
		height: 55px;
		top: 26px;
		left: 26px;
    }
    .hotline-phone-ring-img-circle {
        width: 40px;
        height: 40px;
        top: 34px;
        left: 34px;
    }
    .hotline-phone-ring-img-circle .pps-btn-img img {
        width: 30px;
        height: 30px;
    }
}

</style>
<?php
	}add_action( 'wp_head', 'hien_thi' );
		function add_cd_scripts(){
	}add_action( 'wp_footer', 'add_cd_scripts' );