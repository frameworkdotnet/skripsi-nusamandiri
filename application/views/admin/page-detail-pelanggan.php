	<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url().'admin'; ?> ">Admin</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="<?php echo base_url().'admin/pelanggan'; ?>">Pelanggan</a> <span class="divider">/</span>					
				</li>
				<li class="active"><?php echo $pelanggan['nama']; ?></li>
			</ul>
		</div>
	</div>
	<div class="main-area dashboard">
		<div class="container">
			<div class="row">
				<div class="span4 profileicon">
					<i class="icon icon-user"></i>
					<p><strong>Status pelanggan:</strong> <?php echo ($pelanggan['status']==1) ? '<span class="label label-success">Aktif</span>' : '<span class="label label-important">Nonaktif</span>'; ?></p>
					<p><strong>Email:</strong> <a mailto="<?php echo $pelanggan['email']; ?>"><?php echo $pelanggan['email']; ?></a></p>
				</div>
				<div class="span8">
					<div class="row">
					<div class="span3">
						<div class="slate">
							<div class="page-header">
								<h2>Alamat</h2>
							</div>
							<p><?php echo $pelanggan['alamat']; ?></p>
							<p><?php echo $pelanggan['kota']; ?></p>
							<p>Provinsi <?php echo $pelanggan['provinsi']; ?></p>
						</div>
					</div>
					<div class="span5">
						<div class="slate">
							<div class="page-header">
								<h2>Pesanan</h2>
							</div>
							<table class="orders-table table">
							<tbody>
								<?php if ($pesanan) : ?>
									<?php foreach ($pesanan as $pesanan) : ?>
									<tr>
										<td>
											<a href="<?php echo base_url().'admin/pesanan/'.$pesanan['pesanan_id']; ?>"><?php echo $pesanan['pesanan_id'].' - '.$pesanan['nama']; ?></a>
										</td>
										<td style="text-align:center;">
											<?php
											if ($pesanan['status'] == 'Baru') echo '<span class="label label-important">Baru</span>'; 
											else if ($pesanan['status'] == 'Lunas') echo '<span class="label label-warning">Lunas</span>'; 
											else if ($pesanan['status'] == 'Dikirim') echo '<span class="label label-success">Dikirim</span>'; 
											?>
										</td>
										<td style="text-align:right;">Rp <?php echo $pesanan['total']; ?>,-</td>
									</tr>
									<?php endforeach; ?>
								<?php else : ?>
									<tr>
										<td><p>Pelanggan belum melakukan pesanan</p></td>
									</tr>
								<?php endif; ?>
							</tbody>
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