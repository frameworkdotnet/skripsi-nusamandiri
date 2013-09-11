<div id="content">
	<div id="main" class="wrapper clearfix">
		<div class="pagehead">
			<h1>Detail Pelanggan</h1>
			<div>
				<a href="<?php echo base_url(); ?>">Home</a>
				&raquo; <a href="<?php echo base_url().'pelanggan'; ?>">Pelanggan</a>
				&raquo; <a href="<?php echo base_url().'pelanggan/pesanan'; ?>">Pesanan</a>
				&raquo; Detail
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
					<div class="content">
						<table class="form">
							<tr>
								<td>Nomor Pesanan</td>
								<td><?php echo $pesanan['pesanan_id']; ?></td>
							</tr>
							<tr>
								<td>Tanggal/Waktu Pesan</td>
								<td><?php echo $pesanan['tgl']; ?> / <?php echo $pesanan['jam']; ?></td>
							</tr>
							<tr>
								<td colspan="2">
								<table class="form produk">
									<tr>
										<td>Produk</td>
										<td>Harga</td>
										<td>Berat</td>
										<td>Jumlah</td>
										<td>Total Harga</td>
										<td>Total Berat</td>
									</tr>
									<?php foreach ($pesanan['produk'] as $produk) : ?>
									<tr>
										<td><a href="<?php echo base_url().'produk/'.$produk['produk_id'].'-'.url_title($produk['nama']); ?>"><img src="<?php echo base_url().'assets/produk/'.$produk['gambar']; ?>" title="<?php echo $produk['nama']; ?>" alt="<?php echo $produk['nama']; ?>" width="100" height="100"></a><br><?php echo $produk['nama']; ?></td>
										<td>Rp <?php echo $produk['harga']; ?>,-</td>
										<td><?php echo $produk['berat']; ?></td>
										<td><?php echo $produk['jumlah']; ?></td>
										<td>Rp <?php echo $produk['total_harga']; ?>,-</td>
										<td><?php echo $produk['total_berat']; ?> kg</td>
									</tr>
									<?php endforeach; ?>
									<tr>
										<td colspan="4">Total</td>
										<td>Rp <?php echo $pesanan['harga_total']; ?>,-</td>
										<td><?php echo $pesanan['berat_total']; ?> kg</td>
									</tr>
								</table>
								</td>
							</tr>							
							<tr>
								<td valign="top">Alamat Pengiriman</td>
								<td><p><?php echo $pesanan['alamat']; ?></br>
									<?php echo $pesanan['kota']; ?></br>								
									<?php echo $pesanan['provinsi']; ?></p>								
								</td>
							</tr>
							<tr>
								<td valign="top">Ongkos Kirim</td>
								<td>Rp <?php echo $pesanan['ongkos_kirim']; ?>,- x <?php echo $pesanan['berat_total']; ?> kg</br>
								<h3>Rp <?php echo $pesanan['ongkir_total']; ?>,-</h3></td>
							</tr>
							<tr>
								<td colspan="2" align="right"><h3>Total Tagihan</h3><h3>Rp <?php echo $pesanan['total']; ?>,-</h3></td>
							</tr>
						</table>
					</div>
					<div class="buttons">
						<div class="right"><a href="<?php echo base_url().'pelanggan/pesanan/konfirmasi/'.$pesanan['pesanan_id']; ?>" class="button" />Konfirmasi Pembayaran</a></div>
					</div>
		</div>
	</div>
</div>