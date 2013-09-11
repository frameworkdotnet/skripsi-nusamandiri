<div id="content" class="store-home small-slideshow">
	<div id="main" class="wrapper clearfix">
		<div id="content-body">		
			<div class="box latest-prd" id="latest-prd0">
				<div class="box-heading header-1">Kategori Produk - <?php echo $kategori_detail['nama']; ?></div>
				<p class="box">
				<?php echo $kategori_detail['deskripsi']; ?>
				</p>
				<div class="box-content latest">
					<div class="box-product clearfix">
						<?php if ($produk_kategori) : ?>
							<?php foreach ($produk_kategori as $produk) : ?>
							<div class="prd-block">
								<div class="image">
									<a href="<?php echo base_url(); ?>">
										<img src="<?php echo base_url(); ?>assets/produk/<?php echo $produk['gambar']; ?>" alt="<?php echo $produk['nama']; ?>" width="218" height="258" />
									</a>
									<div class="info" onclick="location.href='<?php echo base_url(); ?>'">
											<a href="<?php echo base_url(); ?>" class="name"><?php echo $produk['nama']; ?></a>						
																		
											<div class="description"><?php echo character_limiter($produk['deskripsi'],20); ?></div>
									</div>
								</div>
								<div class="price">
									<span class="price-block">Rp <?php echo $produk['harga']; ?></span>
								</div>
								<ul>
									<li>
										<a class="icon-cart" title="Beli produk" onclick="addToCart('<?php echo $produk['produk_id']; ?>');">Beli produk</a>
									</li>
									<li class="last">
										<a class="icon-more" href="<?php echo base_url(); ?>produk/<?php echo $produk['produk_id'].'-'.url_title($produk['nama']); ?>" title="Detail produk">Detail produk</a>
									</li>
								</ul>
							</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div><!-- end .clearfix -->
				</div>
			</div>
			<div class="box featured-prd" id="featured-prd0">
				<div class="box-heading header-1">Produk Unggulan</div>
				<div class="box-content featured">
					<div class="box-product clearfix">
						<?php if ($produk_feature) : ?>
							<?php foreach( $produk_feature as $produk) : ?>
							<div class="prd-block hover-on">
								<div class="image">
									<span class="offer-tag"></span>
									<a href="<?php echo base_url(); ?>produk/<?php echo $produk['produk_id'].'-'.url_title($produk['nama']); ?>">
										<img src="<?php echo base_url(); ?>assets/produk/<?php echo $produk['gambar']; ?>" alt="<?php echo $produk['nama']; ?>" width="218" height="258" />
									</a>
									<div class="info" onclick="location.href='<?php echo base_url(); ?>produk/<?php echo $produk['produk_id'].'-'.url_title($produk['nama']); ?>'">
										<a href="<?php echo base_url(); ?>produk/<?php echo $produk['produk_id'].'-'.url_title($produk['nama']); ?>" class="name"><?php echo $produk['nama']; ?></a>
										<div class="description"><?php echo character_limiter($produk['deskripsi'],400); ?></div>
									</div>
								</div>
								<div class="price">
									<span class="price-block">Rp <?php echo $produk['harga']; ?></span>
								</div>
								<ul>
									<li>
										<a class="icon-cart" title="Beli produk" onclick="addToCart('<?php echo $produk['produk_id']; ?>');">Beli produk</a>
									</li>
									<li class="last"><a class="icon-more" href="<?php echo base_url(); ?>produk/<?php echo $produk['produk_id'].'-'.url_title($produk['nama']); ?>" title="Detail produk">Detail produk</a>
									</li>
								</ul>
							</div><!-- end .prd-block hover-on -->
							<?php endforeach; ?>
						<?php endif; ?>
					</div><!-- end .box-product -->
				</div><!-- end .box-conten	-->
			</div><!-- end #featured-0 -->			
<script type="text/javascript"><!--
$(document).ready(function(){
			
		var obj = $('#featured-prd0');
		var Prd = obj.find('.prd-block').length*(25+obj.find('.prd-block').outerWidth());
		var posChk = obj.parent().hasClass('column');
		var chkW = $('#content-body').width();
		var chkHome = $('.featured-prd').hasClass('slidshow-prd');
		
		obj.find('.prd-block:last').addClass('last');
		
		if(posChk == false){
			obj.find('.box-content').addClass('scrollPane');
			obj.css({borderBottom:'none', paddingBottom:0});
			obj.find('.scrollPane').jScrollPane({ horizontalDragMinWidth: 40, horizontalDragMaxWidth: 40, hideFocus:true, maintainPosition: false });
			
			obj.find('.jspPane').css({width:'auto'})
			var api = obj.find('.scrollPane').data('jsp');
			var throttleTimeout;
			
			$(window).bind('resize', function(){
				if ($.browser.msie) {
					// FOR IE
					if (!throttleTimeout) {throttleTimeout = setTimeout(function() {api.reinitialise();throttleTimeout = null;}, 50);}
				} else {
					api.reinitialise();
				}
				if(obj.find('.jspTrack').length > 0){ obj.addClass('b-space');}else {obj.removeClass('b-space');}
				if(obj.find('.prd-block').length <= 4){obj.find('.jspPane').css({left:0});}
				obj.find('.jspPane').css({width:'auto'})
			});
			if(obj.find('.jspTrack').length > 0){ obj.addClass('b-space');}else {obj.removeClass('b-space');}
		}
				
		// CHECK FOR COLUMN PRODUCTS
		if(posChk == true) {
			obj.find('.prd-block').removeClass('hover-on');
			obj.find('.prd-block').addClass('col-prd').removeClass('prd-block');
		}
	});
//--></script>
<script type="text/javascript"><!--
$(window).load(function() {
  var slider = $('#slideshow0 .flexslider').flexslider({
    animation: "",
			smoothHeight: true,
	pauseOnHover: true,
	start:function(){
		$('.slideshowMod').animate({ opacity:1, top:'40px' }, 800);
	}
  });
});
--></script>
<script type="text/javascript"><!--
$(document).ready(function(){
			
		var obj = $('#latest-prd0');
		var Prd = obj.find('.prd-block').length*(25+obj.find('.prd-block').outerWidth());
		var posChk = obj.parent().hasClass('column');
		var chkW = $('#content-body').width();
		var chkHome = $('.latest-prd').hasClass('slidshow-prd');
		
		obj.find('.prd-block:last').addClass('last');
		
				if(posChk == false){
			obj.find('.box-content').addClass('scrollPane');
			obj.css({borderBottom:'none', paddingBottom:0});
			obj.find('.scrollPane').jScrollPane({ horizontalDragMinWidth: 40, horizontalDragMaxWidth: 40, hideFocus:true, maintainPosition: false });
			
			obj.find('.jspPane').css({width:'auto'})
			var api = obj.find('.scrollPane').data('jsp');
			var throttleTimeout;
			
			$(window).bind('resize', function(){
				if ($.browser.msie) {
					// FOR IE
					if (!throttleTimeout) {throttleTimeout = setTimeout(function() {api.reinitialise();throttleTimeout = null;}, 50);}
				} else {
					api.reinitialise();
				}
				if(obj.find('.jspTrack').length > 0){ obj.addClass('b-space');}else {obj.removeClass('b-space');}
				if(obj.find('.prd-block').length <= 4){obj.find('.jspPane').css({left:0});}
				obj.find('.jspPane').css({width:'auto'})
			});
			if(obj.find('.jspTrack').length > 0){ obj.addClass('b-space');}else {obj.removeClass('b-space');}
		}
				
		// CHECK FOR COLUMN PRODUCTS
		if(posChk == true) {
			obj.find('.prd-block').removeClass('hover-on');
			obj.find('.prd-block').addClass('col-prd').removeClass('prd-block');
		}
		
	});

//--></script>
<script type="text/javascript">
<!--
$('#carousel0 ul').jcarousel({
	vertical: false,
	visible: 5,
	scroll: 3});
//-->
</script>		
		</div>
	</div><!-- end #main -->
</div><!-- end #content -->