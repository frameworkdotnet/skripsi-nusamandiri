<div id="content">
	<div id="main" class="wrapper clearfix">
		<div class="pagehead">
			<h1>Dashboard Pelanggan</h1>
			<div>
				<a href="<?php echo base_url(); ?>">Home</a>
				&raquo; <a href="<?php echo base_url().'pelanggan'; ?>">Pelanggan</a>
				&raquo; Pesanan
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
			<?php if (!$pesanan) : ?>
				<p>Anda belum melakukan pemesanan, silahkan lanjutkan belanja.</p>
			<?php else : ?>
				<table class="form">
					<tr>
						<th>No.</th>
						<th>Id Pesanan</th>
						<th>Tanggal</th>
						<th>Jam</th>
						<th>Status Pesanan</th>
						<th>Aksi</th>
					</tr>
					<?php $no = 1; ?>
					<?php foreach ($pesanan as $data) :?>
						<tr>							
							<th><?php echo $no; ?></th>
							<td align="center"><?php echo $data['pesanan_id']; ?></td>
							<td align="center"><?php echo $data['tgl']; ?></td>
							<td align="center"><?php echo $data['jam']; ?></td>
							<td align="center"><?php echo $data['status']; ?></td>
							<td align="center"><a href="<?php echo base_url().'pelanggan/pesanan/konfirmasi/'.$data['pesanan_id']; ?>">Konfirmasi Pembayaran</a> | <a href="<?php echo base_url().'pelanggan/pesanan/detail/'.$data['pesanan_id']; ?>">Lihat Detail</a></td>
						</tr>
						<?php $no++; ?>
					<?php endforeach; ?>
				</table>
			<?php endif; ?>
		</div>
	</div>
</div>