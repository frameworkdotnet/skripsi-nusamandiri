	<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url().'admin'; ?> ">Admin</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="<?php echo base_url().'admin/pesanan'; ?>">Pesanan</a> <span class="divider">/</span>					
				</li>
				<li class="active">Detail Pesanan</li>
			</ul>
		</div>
	</div>
	<div class="main-area dashboard">
		<div class="container">
			<div class="row">
				<div class="span4 profileicon">
					<p><strong>Nama Pelanggan:</strong> <?php echo $pesanan['pelanggan']; ?></p>
					<p>
						<strong>Status pesanan:</strong> 
						<?php
							if ($pesanan['status'] == 'Baru') echo '<span class="label label-important">Baru</span>'; 
							else if ($pesanan['status'] == 'Lunas') echo '<span class="label label-warning">Lunas</span>'; 
							else if ($pesanan['status'] == 'Dikirim') echo '<span class="label label-success">Dikirim</span>';
							else if ($pesanan['status'] == 'Ditutup') echo '<span class="label label-info">Ditutup</span>';  
						?>
					</p>
					<p><a href="<?php echo base_url().'admin/pesanan/konfirmasi/'.$pesanan['pesanan_id']; ?>" class="btn btn-success">Cek Pembayaran</a></p>
					<h2>Alamat Pengiriman</h2>
					<p><?php echo $pesanan['alamat']; ?></p>
					<p><?php echo $pesanan['kota']; ?></p>
					<p>Provinsi <?php echo $pesanan['provinsi']; ?> <?php echo $pesanan['kode_pos']; ?></p>
				</div>
				<div class="span8">
					<div class="row">
					<div class="span8">
						<div class="slate">
							<table class="orders-table table">
							<thead>
								<th>Nama</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Total</th>							
								<th>Berat</th>							
								<th>Berat</th>							
							</thead>
							<tbody>
								<?php if ($pesanan['produk']) : ?>
									<?php foreach ($pesanan['produk'] as $produk) : ?>
									<tr>
										<td>
											<img src="<?php echo base_url().'assets/produk/'.$produk['gambar']; ?>" height="80" width="100"/></br>
											<a href="<?php echo base_url().'produk/'.$produk['produk_id'].'-'.url_title($produk['nama']); ?>"><?php echo $produk['nama']; ?></a>
										</td>
										<td style="text-align:right;">
											Rp <?php echo $produk['harga'] ; ?>,-
										</td>
										<td style="text-align:center;">
											<?php echo $produk['jumlah'] ; ?>
										</td>
										<td style="text-align:right;">
											Rp <?php echo $produk['total_harga']; ?>,-
										</td>
										<td style="text-align:center;">
											<?php echo $produk['berat'] ; ?>
										</td>
										<td style="text-align:right;">
											<?php echo $produk['total_berat']; ?> kg
										</td>
									</tr>
									<?php endforeach; ?>
								<?php endif; ?>
								<tr>									
									<td colspan="2">Total Harga</td>
									<td colspan="2" style="text-align:right;">Rp <?php echo $pesanan['harga_total']; ?>,-</td>							
									<td>Total Berat</td>							
									<td style="text-align:right;"><?php echo $pesanan['berat_total']; ?> kg</td>
								</tr>
								<tr>									
									<td colspan="2">Ongkos Kirim</td>
									<td colspan="2" style="text-align:right;">Rp <?php echo $pesanan['ongkir_total']; ?>,-</td>							
									<td colspan="2" style="text-align:right;">Rp <?php echo $pesanan['ongkos_kirim']; ?>,- * <?php echo $pesanan['berat_total']; ?> kg</td>
								</tr>
							</tbody>
							<tfoot>
								<tr>									
									<th colspan="2">Total Tagihan</th>
									<th colspan="2" style="text-align:right;">Rp <?php echo $pesanan['total']; ?>,-</th>
								</tr>
							</tfoot>
							</table>
						</div>
					
					</div>
					
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span12 footer">
					<p>&copy; StarKonveksi.com 2013</p>
				</div>
			</div>
		</div>
	</div>