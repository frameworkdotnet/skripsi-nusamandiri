	<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url().'admin/'; ?>">Admin</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="<?php echo base_url().'admin/pelanggan'; ?>">Pelanggan</a> <span class="divider">/</span>
				</li>
				<li class="active">Review Produk</li>
			</ul>
		</div>
	</div>
	<div class="main-area dashboard">
		<div class="container">
			<?php echo ($this->session->flashdata('msg')) ? $this->session->flashdata('msg') : ''; ?>			
			<div class="row">
				<div class="span12">
					<div class="slate">
						<div class="page-header">
							<h2>Review Produk</h2>
						</div>
						<?php if ($review) : ?>
						<table class="orders-table table">
						<thead>
							<tr>
								<th>Pelanggan</th>
								<th>Nama Produk</th>
								<th>Isi Review</th>
								<th class="actions">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($review as $review) : ?>
							<tr>
								<td>
									<a href="<?php echo base_url().'admin/pelanggan/'.$review['pelanggan_id'].'-'.url_title($review['pelanggan']); ?>"><?php echo $review['pelanggan']; ?></a>
								</td>
								<td>
									<a href="<?php echo base_url().'produk/'.$review['produk_id'].'-'.url_title($review['produk']); ?>"><?php echo $review['produk']; ?></a>
									<?php echo ($review['status'] == TRUE) ? '<span class="label label-success">Aktif</span>' : '<span class="label label-warning">Tidak Aktif</span>'; ?>
								</td>
								<td>
									<?php echo $review['isi']; ?>
								</td>
								<td class="actions">
									<a class="btn btn-small btn-danger btn-hapus" data-toggle="modal" produk_id="<?php echo $review['review_id']; ?>" nama="<?php echo $review['pelanggan']; ?>" href="#removeItem">Hapus</a>
									<a class="btn btn-small btn-info" href="<?php echo base_url().'admin/pelanggan/review-produk/edit/'.$review['review_id']; ?>">Edit</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						</table>
						<?php endif; ?>
					</div>				
				</div>				
				<div class="modal hide fade" id="removeItem">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">x</button>
						<h3>Hapus Review Produk</h3>
					</div>
					<div class="modal-body">
						<p></p>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn" data-dismiss="modal">Close</a>
						<a href="#" class="btn btn-danger">Hapus</a>
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
		$('.btn-hapus').click(function(){
			var nama = $(this).attr('nama');
			var produk_id = $(this).attr('produk_id');
			$('#removeItem .modal-footer .btn-danger').attr('href','<?php echo base_url(); ?>admin/pelanggan/review-produk/hapus/'+produk_id);
			$('#removeItem .modal-body p').text('Apakah Anda yakin ingin menghapus review produk dari "' + nama + '"?');
		});
	});
	</script>