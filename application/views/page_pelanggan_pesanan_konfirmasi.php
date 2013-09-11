<div id="content">
	<div id="main" class="wrapper clearfix">
		<div class="pagehead">
			<h1>Konfirmasi Pesanan</h1>
			<div>
				<a href="<?php echo base_url(); ?>">Home</a>
				&raquo; <a href="<?php echo base_url(); ?>pelanggan">Pelanggan</a>
				&raquo; <a href="<?php echo base_url(); ?>pelanggan/pesanan">Pesanan</a>
				&raquo; Konfirmasi
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
						<table class="form">
							<tr>
								<td valign="top">Nomor Tagihan</td>
								<td>
									<?php echo $pesanan['pesanan_id']; ?>
									<input type="hidden" name="pesanan_id" value="<?php echo $pesanan['pesanan_id']; ?>" />
									<?php echo form_error('pesanan_id'); ?>
								</td>
							</tr>
							<tr>
								<td valign="top">Metode Pembayaran</td>
								<td>
									<select name="metode_pembayaran">
										<option value="Transfer ATM" <?php echo set_select('metode_pembayaran', 'Transfer ATM'); ?> >Transfer ATM</option>
										<option value="Transfer e-Banking" <?php echo set_select('metode_pembayaran', 'Transfer e-Banking'); ?> >Transfer e-Banking</option>
										<option value="Setor Tunai" <?php echo set_select('metode_pembayaran', 'Setor Tunai'); ?> >Setor Tunai</option>
									</select>
									<?php echo form_error('metode_pembayaran'); ?>
								</td>
							</tr>
							<tr>
								<td valign="top">Nomor Rekening Pengirim</td>
								<td>
									<input type="text" name="no_rekening" value="<?php echo set_value('no_rekening'); ?>" />
									<?php echo form_error('no_rekening'); ?>
								</td>
							</tr>
							<tr valign="top">
								<td>Nama Pemilik Rekening</td>
								<td>
									<input type="text" name="nama" value="<?php echo set_value('nama'); ?>" />
									<?php echo form_error('nama'); ?>
								</td>
							</tr>
							<tr valign="top">
								<td>Jumlah Pembayaran</td>
								<td>
									<input type="text" name="jumlah" value="<?php echo set_value('jumlah'); ?>" />
									<?php echo form_error('jumlah'); ?>
								</td>
							</tr>
							<tr valign="top">
								<td>Tanggal Bayar</td>
								<td>
									<input type="text" name="tanggal" class="date" value="<?php echo set_value('tanggal'); ?>" />
									<?php echo form_error('tanggal'); ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="buttons">
					<div class="right"><input type="submit" value="Kirim" class="button" /></div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	if ($.browser.msie && $.browser.version == 6) {
		$('.date, .datetime, .time').bgIframe();
	}
	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
	$('.datetime').datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'h:m'
	});
	$('.time').timepicker({timeFormat: 'h:m'});
});
//--></script>