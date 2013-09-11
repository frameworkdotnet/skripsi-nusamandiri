<div id="content" class="category">
	<div id="main" class="wrapper clearfix pro3-wrapper">
		<div class="pagehead">
			<h1><?php echo $produk['nama']; ?></h1>
			<div>
				<a href="<?php echo base_url(); ?>">Beranda</a>	 
				&raquo; <a href="<?php echo base_url(); ?>produk">Produk</a>
				&raquo; <?php echo $produk['nama']; ?>
			</div>
		</div>						
		<aside id="column-right" class="column">
			<div id="banner0" class="banner">
				<div class="bnr-bx">
					<a href="<?php echo base_url(); ?>assets/img/side-banner1-200x280.png" alt="Promo bulan ini" title="Promo bulan ini" /></a>
				</div>
				<div class="bnr-bx">
					<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/side-banner1-200x280.png" alt="" title="" /></a>
				</div>
			</div>
<script>
$(document).ready(function() {
	$('#banner0 div:first-child').css('display', 'block');
});
if($('#content').hasClass('store-home') == false){
	if($('#banner0').find('.bnr-bx').length > 1){
		var banner = function() {
			$('#banner0').cycle({
				before: function(current, next) {
					$(next).parent().height($(next).outerHeight());
				}
			});
		}
		setTimeout(banner, 2000);
	}
}
/* JS FOR STORE HOME BANNERS */
$('.banner').each(function(index, element) {
	if($(this).children('.bnr-bx').length == 1) { $(this).addClass('bnr-bx-col1'); }
	if($(this).children('.bnr-bx').length == 2) { $(this).addClass('bnr-bx-col2'); }
	if($(this).children('.bnr-bx').length == 3) { $(this).addClass('bnr-bx-col3'); }
	if($(this).children('.bnr-bx').length == 4) { $(this).addClass('bnr-bx-col4'); }
	if($(this).children('.bnr-bx').length == 5) { $(this).addClass('bnr-bx-col5'); }
	if($(this).children('.bnr-bx').length == 6) { $(this).addClass('bnr-bx-col6'); }
});
$('.banner').children('.bnr-bx:last').addClass('last');
</script>
		</aside>
		<div id="content-body" class="pro-layout3">
			<div class="product-info clearfix">				
				<div class="left">
					<div class="image">
						<a href="<?php echo base_url(); ?>assets/produk/<?php echo $produk['gambar']; ?>" title="<?php echo $produk['nama']; ?>" class="cloud-zoom" id='zoom1' rel="position: 'inside' , showTitle: false, adjustX:-0, adjustY:-0">
							<img src="<?php echo base_url(); ?>assets/produk/<?php echo $produk['gambar']; ?>" width="346" height="410" title="<?php echo $produk['nama']; ?>" alt="<?php echo $produk['nama']; ?>" id="image" />
						</a>
						<a href="<?php echo base_url(); ?>assets/produk/<?php echo $produk['gambar']; ?>" title="<?php echo $produk['nama']; ?>" class="colorbox" rel="colorbox"></a>
					</div>									
				</div>				
				<div class="right">
					<div class="buying-info">
						<div class="price vm">
							<div>
								<span class="price-new">Rp <?php echo $produk['harga']; ?>,-</span>
							</div>
						</div>
						<div class="info-links">
							<a rel="#tab-description" rev="#tab-description">Deskripsi</a>
						</div>
					</div>					
					<div class="options-wrapper">
						<ul class="item-info">
							<li><span>Nama Produk:</span> <?php echo $produk['nama']; ?></li>
							<li><span>Berat:</span> <?php echo $produk['berat']; ?> kg</li>
							<li><span>Stok:</span> <?php echo $produk['stok']; ?></li>
						</ul>
						<div class="cart">
							<strong>Quantity:</strong>
							<div>
								<span>
									<a onclick="qtyMinus();" class="minus"></a>
										<input type="text" name="jumlah" id="qty" size="2" value="1" />
									<a onclick="qtyPlus();" class="plus"></a>
								</span>
								<input type="hidden" name="produk_id" size="2" value="<?php echo $produk['produk_id']; ?>" />
								<a id="button-cart" class="icon-cart" title="Beli produk">Beli produk</a>
							</div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="info-layout2">
					<div id="tabs" class="htabs clearfix" content-theme="a">
						<a href="#tab-description">Deskripsi</a>
					</div>
					<div id="tab-description" class="tab-content" content-theme="a">
						<div class="scrollPane">
							<?php echo $produk['deskripsi']; ?>
						</div>
						<div>
							<h2 id="product-review">Review (<?php echo $produk['jumlah_review']; ?>)</h2>
							<?php 
							foreach ($produk['review'] as $review)
							{
								echo '<div class="review-list">
										<div class="author"><b>'.$review['pelanggan'].'</b> pada '.$review['tanggal'].' - '.$review['jam'].'</div>
										<div class="text">'. $review['isi'].'</div>
									</div><br>';
							}	
							if ($this->session->userdata('pelanggan_id') != '')
							{
								echo '<form ><ul>
								<li class="comment">
									<label>Isi review:<span class="note"><span style="color: #FF0000;">Note:</span> HTML is not translated!</span></label>
									<div class="fields">
										<textarea name="text" cols="40" rows="8" style="width: 98%;"></textarea>
									</div>
								</li>
								<li>
									<a id="button-review" class="button">Simpan</a>
								</li>
							</ul></form>';
							}
							?>
							<div class="fb-comments" data-href="<?php echo base_url(); ?>produk/<?php echo $produk['produk_id'].'-'.url_title($produk['nama']); ?>" data-width="700" data-num-posts="10"></div>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div><!-- end #main -->
<script type="text/javascript"><!--
$(document).ready(function(e) {
	$(".image-additional a").click(function(){
		$('.colorbox').attr('href',$(this).attr('href'));
	});
	
	$('.info-links a:last').addClass('last');
	
	$('.image-additional a').click(function(){
		$('.image-additional a').removeClass('current');
		$(this).addClass('current');
	}).first().click();
	
	});
//--></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/info-layout2.js"></script>
<script type="text/javascript"><!--
$(document).ready(function(e) {
	$('.colorbox').colorbox({
		overlayClose: true,
		opacity: 0.5
	});
});
$('#button-cart').bind('click', function() {
	$.ajax({
		url: 'keranjang-belanja/tambah',
		type: 'post',
		data: $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\']'),
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, information, .error').remove();
			$('#ajaxnotification').show();
			if (json['error']) {
				var message = '<div class="warning" style="display: none;">' + json['error'] + '<img src="<?php echo base_url(); ?>assets/img/close.png" alt="" class="close" /></div>';
			} 
			if (json['success']) {
				var message = '<div class="success" style="display: none;">' + json['success'] + '<img src="<?php echo base_url(); ?>assets/img/close.png" alt="" class="close" /></div>';
				$('#cart-total').html(json['total']);
			}
			$('#ajaxnotification').html(message);
			$('.warning, .success').fadeIn('slow');
			$('html, body').animate({ scrollTop: 0 }, 'slow'); 
		}
	});
});
//--></script>
<script type="text/javascript"><!--
$('#review .pagination a').live('click', function() {
	$('#review').fadeOut('slow');
	$('#review').load(this.href);
	$('#review').fadeIn('slow');
	return false;
});			
$('#review').load('<?php echo base_url(); ?>produk/get-review/<?php echo $produk['produk_id']; ?>');
$('#button-review').bind('click', function() {
	$.ajax({
		url: '<?php echo base_url(); ?>produk/review/tambah/<?php echo $produk['produk_id']; ?>',
		type: 'post',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-review').attr('disabled', true);
			$('.message').prepend('<div class="attention"><img src="<?php echo base_url(); ?>assets/img/loading.gif" alt="" /> Please Wait!</div>');
		},
		complete: function() {
			$('#button-review').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(data) {
			if (data['error']) {
				$('.message').prepend('<div class="warning">' + data['error'] + '</div>');
			}
			if (data.success) {
				$('.message').prepend('<div class="success">' + data['success'] + '</div>');
								
				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').attr('checked', '');
				$('input[name=\'captcha\']').val('');
			}
		}
	});
});
//--></script>