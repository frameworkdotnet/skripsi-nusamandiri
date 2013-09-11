	<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url().'admin/'; ?>">Admin</a> <span class="divider">/</span>
				</li>
				<li class="active">Informasi</li>
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
								<a href="<?php echo base_url(); ?>admin/setting/informasi/tambah" class="btn btn-info">Tambah Informasi</a>
							</div>
							<h2>Halaman Informasi</h2>
						</div>
						<?php if (count($informasi)) : ?>
						<table class="orders-table table">
						<thead>
							<tr>
								<th>Nama Informasi</th>
								<th class="actions">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($informasi as $informasi) : ?>
							<tr>
								<td>
									<a href="<?php echo base_url().'informasi/'.$informasi['informasi_id'].'-'.url_title($informasi['nama']); ?>"><?php echo $informasi['nama']; ?></a>
									<br>
									<span class="meta"><?php echo $informasi['slug']; ?></span>
								</td>
								<td class="actions">
									<a class="btn btn-small btn-danger btn-hapus" data-toggle="modal" informasi_id="<?php echo $informasi['informasi_id']; ?>" nama="<?php echo $informasi['nama']; ?>" href="#removeItem">Hapus</a>
									<a class="btn btn-small btn-info" href="<?php echo base_url().'admin/setting/informasi/edit/'.$informasi['informasi_id']; ?>">Edit</a>
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
						<h3>Hapus informasi</h3>
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
			var informasi_id = $(this).attr('informasi_id');
			$('#removeItem .modal-footer .btn-danger').attr('href','<?php echo base_url(); ?>admin/setting/informasi/hapus/'+informasi_id);
			$('#removeItem .modal-body p').text('Apakah Anda yakin ingin menghapus informasi "' + nama + '"?');
		});
	});
	</script>