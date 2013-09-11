	<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url().'admin/'; ?>">Admin</a> <span class="divider">/</span>
				</li>
				<li class="active">Kategori</li>
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
							<div class="btn-group pull-right">
								<a href="<?php echo base_url(); ?>admin/kategori/tambah" class="btn btn-info">Tambah Kategori</a>
							</div>
							<h2>Kategori Produk</h2>
						</div>
						<?php if (count($kategori)) : ?>
						<table class="orders-table table">
						<thead>
							<tr>
								<th>Nama kategori</th>
								<th class="actions">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($kategori as $kategori) : ?>
							<tr>
								<td>
									<a href="<?php echo base_url().'kategori/'.$kategori['kategori_id'].'-'.url_title($kategori['nama']); ?>"><?php echo $kategori['nama']; ?></a>
									<?php echo ($kategori['status'] == TRUE) ? '<span class="label label-success">Aktif</span>' : '<span class="label label-warning">Tidak Aktif</span>'; ?>							
									<br />
								</td>
								<td class="actions">
									<a class="btn btn-small btn-danger btn-hapus" data-toggle="modal" kategori_id="<?php echo $kategori['kategori_id']; ?>" nama="<?php echo $kategori['nama']; ?>" href="#removeItem">Hapus</a>
									<a class="btn btn-small btn-info" href="<?php echo base_url().'admin/kategori/edit/'.$kategori['kategori_id']; ?>">Edit</a>
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
						<h3>Hapus kategori</h3>
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
			var kategori_id = $(this).attr('kategori_id');
			$('#removeItem .modal-footer .btn-danger').attr('href','<?php echo base_url(); ?>admin/kategori/hapus/'+kategori_id);
			$('#removeItem .modal-body p').text('Apakah Anda yakin ingin menghapus kategori "' + nama + '"?');
		});
	});
	</script>