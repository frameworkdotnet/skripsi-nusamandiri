<div id="content" class="category">
	<div id="main" class="wrapper clearfix">
		<div class="pagehead">
			<h1>Checkout</h1>
			<div>
				<a href="<?php echo base_url(); ?>">Home</a>
				&raquo; Checkout
			</div>
		</div>		
		<div id="content-body">		
			<div class="checkout">
				<div id="shipping-address">
					<div class="checkout-heading">Langkah 1: Alamat Pengiriman</div>
					<div class="checkout-content">
						<form action="" method="post">
							<div class="box-form">
								<div class="content">
									<table class="form" id="payment-address">
										<tr>
											<td>Nama Lengkap</td>
											<td><input type="text" name="nama" value="<?php echo $pelanggan['nama']; ?>" /><input type="hidden" name="pelanggan_id" value="<?php echo $pelanggan['pelanggan_id']; ?>" />
												</td>
										</tr>
										<tr>
											<td>Email</td>
											<td><input type="text" name="email" value="<?php echo $pelanggan['email']; ?>" readonly />
												</td>
										</tr>
										<tr>
											<td>Alamat</td>
											<td><textarea name="alamat" cols="40" rows="5"><?php echo $pelanggan['alamat']; ?></textarea></td>
										</tr>
										<tr>
											<td>Provinsi</td>
											<td><select name="provinsi_id">
												<option value="">-- Pilih Provinsi --</option>
												<?php
												if ($provinsi)
												{
													foreach($provinsi as $provinsi)
													{
														$selected = ($provinsi['provinsi_id'] == $pelanggan['provinsi_id']) ?  'selected':'';
														echo '<option value="'.$provinsi['provinsi_id'].'" '.$selected.'>'.$provinsi['nama'].'</option>';
													}
												}								
												?>
												</select>
											</td>
										</tr>
										<tr>
											<td>Kota</td>
											<td><select name="kota_id">
												<option value="">-- Pilih Kota --</option>
												<?php
												if ($kota)
												{
													foreach($kota as $kota)
													{
														$selected = ($kota['kota_id'] == $pelanggan['kota_id']) ?  'selected':'';
														echo '<option value="'.$kota['kota_id'].'" '.$selected.'>'.$kota['nama'].'</option>';
													}
												}								
												?>
												</select>
											</td>
										</tr>
										
										<tr>
											<td>Kode Pos</td>
											<td>
												<input name="kode_pos" type="text"  style="width:10%;">
											</td>
										</tr>
										<tr>
											<td><span class="required">Ongkos Kirim</span></td>
											<td><input type="text" name="ongkos_kirim" value="<?php echo $pelanggan['ongkos_kirim']; ?> " size="10" style="width:10%;"/> /kg</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="buttons">
								<div class="right"><input type="submit" value="Simpan" class="button" id="button-alamat"/>
								</div>
							</div>
						</form>					
					</div>
				</div>
				<div id="confirm">
					<div class="checkout-heading">Langkah 2: Konfirmasi Pesanan</div>
					<div class="checkout-content"></div>
				</div>
			</div>
		</div>		
	</div>
</div>
<script type="text/javascript"><!--
$('select[name=\'provinsi_id\']').bind('change', function() {
	$.ajax({
		url: 'pelanggan/get-daftar-kota/' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'provinsi_id\']').after('<span class="wait">&nbsp;<img src="<?php echo base_url(); ?>assets/img/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			html = '<option value=""> --- Pilih Kota --- </option>';
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
        		$('input[name=\'ongkos_kirim\']').val(json['ongkos_kirim']);
			} else {
				alert('Ongkos kirim belum tersedia');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
// Alamat pengiriman
$('#button-alamat').click( function(event) {
	event.preventDefault();
	$.ajax({
		url: 'checkout/alamat-pengiriman',
		type: 'post',
		data: $('#payment-address input[type=\'text\'], #payment-address textarea, #payment-address input[type=\'checkbox\']:checked, #payment-address input[type=\'radio\']:checked, #payment-address input[type=\'hidden\'], #payment-address select'),
		dataType: 'json',
		beforeSend: function() {
			$('#button-alamat').attr('disabled', true);
			$('#button-alamat').after('<span class="wait">&nbsp;<img src="<?php echo base_url(); ?>assets/img/loading.gif" alt="" /></span>');
		},	
		complete: function() {
			$('#button-alamat').attr('disabled', false);
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['error']) {
				//location = json['redirect'];
				alert(json['error']);
			} else {
				$.ajax({
					url: 'checkout/konfirmasi-pesanan',
					dataType: 'html',
					success: function(html) {
						$('#confirm .checkout-content').html(html);
						$('#shipping-address .checkout-content').slideUp('slow');
						$('#confirm .checkout-content').slideDown('slow');
						$('.edit-address').remove();
						$('#shipping-address .checkout-heading').append('<a class="edit-address">Edit &raquo;</a>');	
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
					}
				});			
			}	  
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});
$('.edit-address').live('click', function() {
	$('#shipping-address .checkout-content').slideDown('slow');
	$('#confirm .checkout-content').slideUp('slow');
});
$('#button-confirm').live('click', function() {
	$.ajax({
		url: 'checkout/simpan-pesanan',
		type: 'post',
		dataType: 'json',
		beforeSend: function() {
			$('#button-confirm').attr('disabled', true);
			$('#button-confirm').after('<span class="wait">&nbsp;<img src="<?php echo base_url(); ?>assets/img/loading.gif" alt="" /></span>');
		},	
		complete: function() {
			$('#button-confirm').attr('disabled', false);
			$('.wait').remove();
		},			
		success: function(json) {
			if(json['success']){
				location = 'checkout/terimakasih';	
			} else {
				alert('Sorry our system has crSHED, TRY AGAIN LATER');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});
//--></script> 