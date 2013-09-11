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
	return true;
}
//-->
</script>
<div id="content">
	<div id="main" class="wrapper clearfix">
		<div class="pagehead">
			<h1>Login Pelanggan</h1>
			<div>
				<a href="<?php echo base_url(); ?>">Home</a>
				 &raquo; <a href="<?php echo base_url(); ?>pelanggan/">Pelanggan</a>
				 &raquo; <a href="<?php echo base_url(); ?>pelanggan/login">Login</a>
			</div>
		</div>		
		<aside id="column-right" class="column">
			<div class="box">
				<div class="box-heading header-3">Pelanggan</div>
				<div class="box-content">
					<div class="col-links">
						<ul>
							<li><a href="<?php echo base_url(); ?>pelanggan/login">Login</a> / <a href="<?php echo base_url(); ?>pelanggan/daftar">Register</a></li>
							<li><a href="<?php echo base_url(); ?>pelanggan/lupa-password">Lupa Password</a></li>
							<li><a href="<?php echo base_url(); ?>pelanggan/">My Account</a></li>
							<li><a href="<?php echo base_url(); ?>pelanggan/pesanan">Pesanan</a></li>
						</ul>
					</div>
				</div>
			</div>
		</aside>
		<div id="content-body">			
			<div class="login-content">
				<div>
					<div class="left box-form">
						<h2 class="header-3">1-Click Login</h2>
						<div class="content">
							<a href="<?php echo base_url(); ?>pelanggan/login-facebook" class="button">Login With Facebook</a>
							<p>Or ...</p> 
							<a href="<?php echo base_url(); ?>pelanggan/daftar" class="button">Register</a>
						</div>
					</div>
					<div class="right box-form">
						<form action="<?php echo base_url().'pelanggan/login/'.$redirect; ?>" method="post" onSubmit="return validation(this)">
							<h2 class="header-3">Mendaftar Menggunakan E-mail</h2>							
							<?php echo validation_errors(); ?>
							<div class="content">
								<label for="email">E-Mail:</label>
								<input type="text" name="email" value="<?php echo set_value('email'); ?>" />
								<label for="password">Password:</label>
								<input type="password" name="password" value="" />
								<a href="<?php echo base_url(); ?>pelanggan/lupa-password">Lupa Password</a><br />
								<input type="submit" value="Login" class="button" />
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>		
	</div>
</div>