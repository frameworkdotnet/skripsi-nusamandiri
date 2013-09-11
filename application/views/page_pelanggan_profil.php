<div id="content">
	<div id="main" class="wrapper clearfix">
		<div class="pagehead">
			<h1>Profil Pelanggan</h1>
			<div>
				<a href="<?php echo base_url(); ?>">Home</a>
				&raquo; <a href="<?php echo base_url(); ?>pelanggan">Pelanggan</a>
				&raquo; Profil
			</div>
		</div>		
		<aside id="column-right" class="column">
			<div class="box">
				<div class="box-heading header-3">Dashboard</div>
				<div class="box-content">
					<div class="col-links">
						<ul>
							<li><a href="<?php echo base_url().'pelanggan/'.$this->session->userdata('pelanggan_id').'-'.url_title($this->session->userdata('nama')); ?>">My Profil</a></li>
							<li><a href="<?php echo base_url().'pelanggan/pesanan'; ?>">My Pesanan</a></li>
							<li><a href="<?php echo base_url().'pelanggan/review-produk'; ?>">My Review</a></li>
							<li><a href="<?php echo base_url().'pelanggan/logout'; ?>">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
		</aside>
		<div id="content-body">
			<form action="" method="post">
				<div class="box-form">
					<div class="content">
						<?php echo validation_errors(); ?>
						<table class="form">
							<tr>
								<td>Nama Lengkap</td>
								<td><input type="text" name="nama" value="<?php echo $pelanggan['nama']; ?>" /><input type="hidden" name="pelanggan_id" value="<?php echo $pelanggan['pelanggan_id']; ?>" />
									</td>
							</tr>
							<tr>
								<td>Email</td>
								<td><input type="text" name="email" value="<?php echo $pelanggan['email']; ?>" />
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
								<td><span class="required">*</span> Ganti Password</td>
								<td><input type="text" name="password" value="" />
									</td>
							</tr>
							<tr>
								<td><span class="required">*</span> Ulangi Password</td>
								<td><input type="text" name="password2" value="" />
									</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="buttons">
					<div class="right">Kosongkan kolom password jika tidak akan diupdate.<input type="submit" value="Simpan" class="button" />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
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
					//selected = (json[i]['kota_id'] == <?php echo $pelanggan['kota_id']; ?>) ?  'selected':'';
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
</script>