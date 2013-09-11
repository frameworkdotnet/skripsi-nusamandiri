<div id="content" class="category">
	<div id="main" class="wrapper clearfix">
		<div class="pagehead">
			<h1>Keranjang Belanja&nbsp;(<?php echo $this->cart->total_items(); ?> item)</h1>
			<div>
				<a href="<?php echo base_url(); ?>">Home</a>
				&raquo; Keranjang Belanja
			</div>
		</div>
		<div id="content-body">
			<?php if($this->cart->total_items() < 1) : ?>
			<div class="warning">
				Keranjang belanja Anda masih kosong, silahkan lanjutkan belanja Anda :)
				<img src="<?php echo base_url(); ?>assets/img/close.png" alt="" class="close" />
			</div>			
			<div class="buttons">
				<a href="<?php echo base_url(); ?>" class="button">Lanjut Belanja</a>
			</div>
			<?php else : ?>
			<form action="<?php echo base_url(); ?>keranjang-belanja" method="post" enctype="multipart/form-data" id="cart-form">
				<div class="cart-info">
					<table class="list">
						<thead>
							<tr>
								<td class="image">Gambar</td>
								<td class="name">Produk</td>
								<td class="quantity">Jumlah</td>
								<td class="price">Harga</td>
								<td class="total">Total</td>
								<td class="berat">Berat</td>
								<td class="weight">Berat</td>
							</tr>
						</thead>
						<tbody>
						<?php $i = 1; ?>
						<?php $berat_total = 0; ?>
						<?php foreach ($this->cart->contents() as $items): ?>
							<tr>
								<td class="image">
									<?php $this->load->helper('form'); ?>
									<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
									<a href="<?php base_url().'produk/'.$items['id'].'-'.url_title($items['name']); ?>"><img src="<?php base_url(); ?>assets/produk/<?php echo $items['picture']; ?>" alt="<?php echo $items['name']; ?>" title="<?php echo $items['name']; ?>" width="100" height="118" /></a>
								</td>
								<td class="name">
									<a href="<?php base_url().'produk/'.$items['id'].'-'.url_title($items['name']); ?>"><?php echo $items['name']; ?></a>
									<span class="stock">***</span>
								</td>
								<td class="quantity">
									<input type="text" name="<?php echo $i."[qty]"; ?>" value="<?php echo $items['qty']; ?>" size="1" />
									<input type="submit" class="sml-button" alt="Update" value="Update" title="Update" />
									<a href="<?php echo base_url().'keranjang-belanja/hapus/'.$items['rowid']; ?>">Remove</a>
								</td>
								<td class="price">Rp <?php echo $items['price']; ?></td>
								<td class="total">RP <?php echo $items['price'] * $items['qty']; ?></td>
								<td class="total"><?php echo $items['berat']; ?> kg</td>
								<td class="total"><?php echo $items['berat'] * $items['qty']; ?> kg</td>
							</tr>
						<?php $i++; ?>
						<?php $berat_total += $items['berat'] * $items['qty']; ?>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</form>				
			<div class="cart-module">
				<div class="content">
					<div class="highlight">
						<input type="radio" name="next" value="shipping" id="shipping_estimate" />
						<label for="shipping_estimate">Cek Ongkos Kirim</label>
					</div>
					<div id="shipping" class="data" style="display: none;">
							Pilih kota tujuan.<br /><br />
						<table class="form">
							<tr>
								<td>Provinsi:</td>
								<td>
									<select name="provinsi_id">
									</select>
								</td>
							</tr>
							<tr>
								<td>Kota/ Kabupaten:</td>
								<td><select name="kota_id"></select></td>
							</tr>
							<tr>
								<td>Ongkos Kirim:</td>
								<td><span class="ongkos_kirim required"></span></td>
							</tr>
						</table>	
					</div>
						
				</div>
			</div>
			<div class="cart-total">
				<table id="total">
					<tr>
						<td class="right">Berat Total:</td>
						<td class="right"><?php echo $berat_total; ?> kg</td>
					</tr>
					<tr>
						<td class="right">Harga Total:</td>
						<td class="right">Rp <?php echo $this->cart->total(); ?>,-</td>
					</tr>
				</table>
			</div>
			<div class="clearfix"></div>
			<div class="buttons">
				<div class="right">
					<a href="<?php echo base_url(); ?>checkout/?ref=cart" class="button dark-bt">Checkout</a>
				</div>
				<a href="<?php echo base_url(); ?>" class="button">Lanjut Belanja</a>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<script type="text/javascript"><!--
$('input[name=\'next\']').bind('change', function() {
	$('.cart-module .data').hide();
	$('#' + this.value).show();
});
$('.quantity .sml-button').click(function(){
	$('#cart-form').submit();
});
//--></script>
<script type="text/javascript"><!--
$(document).ready( function() {
	$.ajax({
		url: 'keranjang-belanja/get-provinsi',
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'provinsi_id\']').after('<span class="wait">&nbsp;<img src="<?php echo base_url(); ?>assets/img/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			html = '<option value=""> --- Please Select --- </option>';
			if (json) {
				for (i = 0; i < json.length; i++) {
        			html += '<option value="' + json[i]['provinsi_id'] + '"';
	    			html += '>' + json[i]['nama']+ '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"> --- None --- </option>';
			}
			
			$('select[name=\'provinsi_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
$('select[name=\'provinsi_id\']').bind('change', function() {
	if (this.value == '') {
		return false;
	}
	$.ajax({
		url: 'keranjang-belanja/get-kota-provinsi/' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'provinsi_id\']').after('<span class="wait">&nbsp;<img src="<?php echo base_url(); ?>assets/img/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			html = '<option value=""> --- Please Select --- </option>';
			if (json) {
				for (i = 0; i < json.length; i++) {
        			html += '<option value="' + json[i]['kota_id'] + '"';
	    			html += '>' + json[i]['nama']+ '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"> --- None --- </option>';
			}
			
			$('select[name=\'kota_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
$('select[name=\'kota_id\']').bind('change', function() {
	if (this.value == '') {
		return false;
	}
	$.ajax({
		url: 'keranjang-belanja/get-kota/' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'provinsi_id\']').after('<span class="wait">&nbsp;<img src="<?php echo base_url(); ?>assets/img/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json) {
				beratTotal = <?php echo isset($berat_total) ? $berat_total : '0'; ?>;
				total = beratTotal * json['ongkos_kirim'];
        		$('.ongkos_kirim').html('Rp ' + json['ongkos_kirim'] + ',- /kg * <?php echo @$berat_total; ?> kg = Rp ' + parseFloat(total,2));
			} else {
				alert('Ongkos kirim belum tersedia');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
//--></script>