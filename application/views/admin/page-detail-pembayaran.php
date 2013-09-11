	<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url().'admin'; ?> ">Admin</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="<?php echo base_url().'admin/pesanan'; ?>">Pesanan</a> <span class="divider">/</span>					
				</li>
				<li>
					<a href="<?php echo base_url().'admin/pesanan/konfirmasi'; ?>">Konfirmasi</a> <span class="divider">/</span>					
				</li>
				<li class="active">Detail Pembayaran</li>
			</ul>
		</div>
	</div>
	<div class="main-area dashboard">
		<div class="container">
			<div class="row">
				<?php if (isset($konfirmasi)) : ?>
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
					<p>
						<?php if ($konfirmasi && $pesanan['status'] == 'Baru') : ?>
							<a class="btn btn-small btn-danger" data-toggle="modal" nama="<?php echo $konfirmasi['nama']; ?>" pesanan_id="<?php echo $konfirmasi['pesanan_id']; ?>"href="#removeItem">Update Status</a>
						<?php endif; ?>
					</p>
					<h2>Alamat Pengiriman</h2>
					<p><?php echo $pesanan['alamat']; ?></p>
					<p><?php echo $pesanan['kota']; ?></p>
					<p>Provinsi <?php echo $pesanan['provinsi']; ?> <?php echo $pesanan['kode_pos']; ?></p>
				</div>
				<div class="span8">
					<div class="row">
					<div class="span5">
						<div class="slate">
							<div class="page-header">
								<h2>Detail Pembayaran</h2>
							</div>
							<?php if ($konfirmasi) : ?>
							<table class="orders-table table">
							<tbody>
								<tr>
									<td>
										Metode Pembayaran
									</td>
									<td>
										<?php echo $konfirmasi['metode_pembayaran']; ?>
									</td>
								</tr>
								<tr>
									<td>
										Tanggal dan Waktu Pembayaran
									</td>
									<td>
										<?php echo $konfirmasi['tanggal']; ?>
									</td>
								</tr>
								<tr>
									<td>
										Rekening Pembayaran
									</td>
									<td>
										<?php echo $konfirmasi['no_rekening']; ?>
									</td>
								</tr>
								<tr>
									<td>
										Nama Pemegang Rekeing 
									</td>
									<td>
										<?php echo $konfirmasi['nama']; ?>
									</td>
								</tr>
								<tr>
									<td>
										Jumlah Pembayaran
									</td>
									<td>
										Rp <?php echo $konfirmasi['jumlah_bayar']; ?>,-
									</td>
								</tr>
							</tbody>
							</table>
							<?php else : ?>
								<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Pesanan belum dibayar</div>
							<?php endif; ?>
						</div>
					</div>
					</div>
				</div>
				<?php else : ?>
				<h3>Pesanan ini belum di bayar</h3>
				<?php endif; ?>
			</div>
			<div class="row">
				<div class="span12 footer">
					<p>&copy; StarKonveksi.com 2013</p>
				</div>
			</div>
		</div>
	</div>
				<div class="modal hide fade" id="removeItem">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">x</button>
						<h3>Update Status Pesanan</h3>
					</div>
					<div class="modal-body">
						<p>Pembayaran pesanan ini sudah lunas?</p>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn" data-dismiss="modal">Cancel</a>
						<a href="<?php echo base_url().'admin/pesanan/update/'.$pesanan['pesanan_id'].'/1'; ?>" class="btn btn-success">Ya</a>
					</div>
				</div>