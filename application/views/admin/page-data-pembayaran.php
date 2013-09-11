<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url().'admin/'; ?>">Admin</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="<?php echo base_url().'admin/pesanan'; ?>">Pesanan</a> <span class="divider">/</span>
				</li>
				<li class="active">Konfirmasi Pembayaran</li>
			</ul>
		</div>
	</div>
	<div class="main-area dashboard">
		<div class="container">
			<?php echo ($this->session->flashdata('msg')) ? $this->session->flashdata('msg') : ''; ?>
			<div class="row">
				<div class="span12">
					<div class="slate">					
						<table class="orders-table table">
						<thead>
							<tr>
								<th>No. Pesanan</th>
								<th>Nama Pemegang Rekening</th>
								<th>Metode Pembayaran</th>
								<th class="actions">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($konfirmasi as $konfirmasi) : ?>
								<tr class="<?php echo ($konfirmasi['cek']) ? 'info' : 'warning'; ?>">
									<td>
										<?php echo $konfirmasi['pesanan_id']; ?></a>
									</td>
									<td>
										<?php echo $konfirmasi['pesanan_id'].'- '.$konfirmasi['nama']; ?></a>
									</td>
									<td>
										<?php echo $konfirmasi['metode_pembayaran']; ?>
									</td>
									<td class="actions actions-large">
										<a href="<?php echo base_url().'admin/pesanan/konfirmasi/'.$konfirmasi['pesanan_id']; ?>" class="btn btn-small <?php echo ($konfirmasi['cek']) ? 'btn-danger' : 'btn-primary'; ?>">Lihat Detail</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
						</table>
					</div>
				</div>
				<div class="modal hide fade" id="removeItem">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">x</button>
						<h3>Nonaktifkan Admin</h3>
					</div>
					<div class="modal-body">
						<p></p>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn" data-dismiss="modal">Cancel</a>
						<a href="" class="btn btn-danger">Nonaktifkan</a>
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
	<script>
	$(document).ready(function() {
		$('.btn-nonaktif').click(function(){
			var nama = $(this).attr('nama');
			var user_id = $(this).attr('user_id');
			var toDo = $(this).attr('to_do');
			$('#removeItem .modal-footer .btn-danger').attr('href','<?php echo base_url(); ?>admin/'+toDo+'/'+user_id);
			$('#removeItem .modal-body p').text('Apakah Anda yakin ingin menonaktifkan user ' + nama + '?');
		});
	});
	</script>