<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
    <title><?php echo $meta_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
	<!--<link href="http://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet" type="text/css">-->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/admin.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
	    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/excanvas.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.flot.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.flot.resize.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/common-admin.js"></script>
	<script type="text/javascript">
	function cekKonfirmasi() {
			$.get('<?php echo base_url().'admin/pesanan/cek-konfirmasi'; ?>', function(data){				
				$('.badge-info').text(data);
				$('.badge-info').show('slow');
			});
	}
	cekKonfirmasi();
	setInterval( cekKonfirmasi, 30000 );
	</script>
</head>    
<body>
	<div class="masthead">
		<div class="container">
			<div class="masthead-top clearfix">
				<ul class="nav nav-pills pull-right">
					<li>
						<a href="<?php echo base_url(); ?>" target="_blank"><i class="icon-globe"></i> View Website</a>
					</li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-user"></i> <?php echo $this->session->userdata('nama'); ?> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url(); ?>admin/<?php echo $this->session->userdata('user_id').'-'.url_title($this->session->userdata('nama')); ?>">Profil Saya</a></li>
							<li><a href="<?php echo base_url(); ?>admin/data-admin">Data Admin</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo base_url(); ?>admin/logout">Logout</a></li>
						</ul>
					</li>
				</ul>
				<h1><i class="icon-bookmark icon-large"></i> Administrator StarKonveksi.com</h1>
			</div>
			<div class="navbar navbar-inverse">
				<div class="navbar-inner">
					<div class="container">
						<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
						<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
						<div class="nav-collapse">
							<ul class="nav">
								<li class="dashboard">
									<a href="<?php echo base_url(); ?>admin/"><i class="icon-home"></i> Dashboard</a>
								</li>
								<li class="dropdown katalog">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#">
										<i class="icon-shopping-cart"></i> Katalog Toko <b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<li><a href="<?php echo base_url(); ?>admin/produk">Produk</a></li>
										<li><a href="<?php echo base_url(); ?>admin/kategori">Kategori</a></li>
									</ul>
								</li>
								<li class="dropdown transaksi">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#">
										<i class="icon-sitemap"></i> Transaksi <b class="caret"></b>
									</a>
									<ul class="dropdown-menu">
										<li><a href="<?php echo base_url(); ?>admin/pelanggan">Pelanggan</a></li>
										<li><a href="<?php echo base_url(); ?>admin/pelanggan/review-produk">Review Produk</a></li>
										<li><a href="<?php echo base_url(); ?>admin/pesanan">Pesanan</a></li>
									</ul>
								</li>
								<li class="dropdown laporan">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-signal"></i> Laporan <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="<?php echo base_url(); ?>admin/laporan/penjualan">Laporan Penjualan</a></li>
										<li><a href="<?php echo base_url(); ?>admin/laporan/produk">Laporan Produk</a></li>
									</ul>
								</li>
								<li class="dropdown setting">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-cogs"></i> Settings <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="<?php echo base_url(); ?>admin/setting/informasi">Informasi</a></li>
										<li><a href="<?php echo base_url(); ?>admin/setting/kota">Kota</a></li>
										<li><a href="<?php echo base_url(); ?>admin/setting/provinsi">Provinsi</a></li>
									</ul>
								</li>
							</ul>
							<ul class="nav pull-right">
								<li>
									<a href="<?php echo base_url(); ?>admin/pesanan/konfirmasi"><i class="icon-bullhorn"></i> Konfirmasi <span class="badge badge-info" style="display:none;"></span>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url(); ?>admin/help">
										<i class="icon-info-sign"></i> Help
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
	<?php $this->load->view($page); ?>
</body>
</html>