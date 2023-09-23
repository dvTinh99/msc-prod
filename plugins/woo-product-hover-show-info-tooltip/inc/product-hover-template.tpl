<a class="cdc_shop_loop_box" href="<?php echo the_permalink(); ?>">
	<div class="cdc_thetip" >
		<strong class="cdc_thetitle"><?php the_title();?></strong>
		<div class="cdc_thecontent">
			<!-- short description -->
      <div class="gia"><?php echo woocommerce_template_single_price(); ?></div>
      <div class="trang_thai"><?php echo do_shortcode('[show__product__status]'); ?></div>
      <div class="bao_hanh">Bảo hành: <?php echo do_shortcode('[bao_hanh_hover]'); ?></div>
      <div class="contt">
          <?php 
            $tomtat = get_field('tom_tat_sp');
            $khuyenmai = get_field('khuyen_mai');

              ?>
              <?php if (isset($tomtat)) { ?>
                <?php if(($tomtat) != "") { ?>
                <div class="title-contt-spec">
                   <div class="title-ct"><i class="fa fa-file-text" aria-hidden="true"></i><span class="txt">Thông số sản phẩm</span></div>
                </div>
                <div class="contt-ct">
                    <?php echo $tomtat; ?>
                </div>
              <?php } } ?>
              <?php if (isset($khuyenmai)) { ?>
                <?php if(($khuyenmai) != "") { ?>
                <div class="title-contt-offer">
                   <div class="title-ct"><i class="fa fa-gift" aria-hidden="true"></i><span class="txt">Chương trình khuyến mại</span></div>
                </div>
                <div class="contt-offer-ct"><?php echo $khuyenmai; ?></div>
              <?php } } ?>
              <?php  ?>
      </div>
            
      <!-- end short description -->
		</div>
	</div>
</a>