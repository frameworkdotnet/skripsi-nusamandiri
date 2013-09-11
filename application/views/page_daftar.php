<script type="text/javascript"><!--
function validation(me) {
	if(me.email.value==''){
		alert('Email harus diisi!');
		me.email.focus();
		return false;
	}
	if(me.password.value==''){
		alert('Password harus diisi!');
		me.password.focus();
		return false;
	}
	if(me.password2.value==''){
		alert('Konfirmasi password harus diisi!');
		me.password2.focus();
		return false;
	}
	return true;
}
//-->
</script>
<div id="content">
	<div id="main" class="wrapper clearfix">
		<div class="pagehead">
			<h1>Mendaftar Pelanggan</h1>
			<div>
				<a href="<?php echo base_url(); ?>">Home</a>
				 &raquo; <a href="<?php echo base_url(); ?>pelanggan/">Pelanggan</a>
				 &raquo; Daftar
			</div>
		</div>		
		<aside id="column-right" class="column">
			<div class="box">
				<div class="box-heading header-3">Menu Pelanggan</div>
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
			<div class="login-content">
				<div>
					<div class="left box-form">
						<h2 class="header-3">Pengunjung Baru ?</h2>
						<div class="content">
							<p>Daftar menggunakan akun Facebook Anda.</p>
							<a href="<?php echo base_url(); ?>pelanggan/login-facebook" class="button">Login With Facebook</a>
							<p>Dengan menjadi pelanggan, Anda bisa mengetahui history transaksi Anda, mengisi review produk, dan juga mendapatkan penawaran khusus untuk pelanggan.</p>
							<p>Silahkan silahkan isi email dan password Anda disamping ini.</p>
						</div>
					</div>
					<div class="right box-form">
						<form action="" method="post" onSubmit="return validation(this)">
							<h2 class="header-3">Jadi Pelanggan</h2>
							<?php echo validation_errors(); ?>
							<div class="content">
								<label for="email">Nama:</label>
								<input type="text" name="nama" value="<?php echo set_value('nama'); ?>" />
								<label for="email">E-Mail:</label>
								<input type="text" name="email" value="<?php echo set_value('email'); ?>" />
								<label for="password">Password:</label>
								<input type="password" name="password" value="" />
								<label for="password">Konfirmasi Password:</label>
								<input type="password" name="password2" value="" />
								<a href="<?php echo base_url(); ?>pelanggan/lupa-password">Lupa Password</a><br />
								<input type="submit" value="Daftar" class="button" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>