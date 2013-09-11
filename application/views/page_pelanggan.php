<div id="content">
	<div id="main" class="wrapper clearfix">
		<div class="pagehead">
			<h1>Dashboard Pelanggan</h1>
			<div>
				<a href="<?php echo base_url(); ?>">Home</a>
				&raquo; Pelanggan
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
			<p>Selamat datang di dashboard pelanggan StarKonveksi.com</p>		
		</div>
	</div>
</div>