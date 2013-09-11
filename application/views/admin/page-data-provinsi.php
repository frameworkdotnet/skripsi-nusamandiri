	<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url().'admin/'; ?>">Admin</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="<?php echo base_url().'admin/setting'; ?>">Setting</a> <span class="divider">/</span>
				</li>
				<li class="active">Provinsi</li>
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
								<a href="<?php echo base_url(); ?>admin/setting/provinsi/tambah" class="btn btn-info">Tambah Provinsi</a>
							</div>
							<h2>Daftar Provinsi</h2>
						</div>
						<?php if (count($provinsi)) : ?>
						<table class="orders-table table">
						<thead>
							<tr>
								<th>Nama Provinsi</th>
								<th class="actions">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($provinsi as $provinsi) : ?>
							<tr>
								<td>
									<a href="<?php echo base_url().'provinsi/'.$provinsi['provinsi_id'].'-'.url_title($provinsi['nama']); ?>"><?php echo $provinsi['nama']; ?></a>
								</td>
								<td class="actions">
									<a class="btn btn-small btn-danger btn-hapus" data-toggle="modal" provinsi_id="<?php echo $provinsi['provinsi_id']; ?>" nama="<?php echo $provinsi['nama']; ?>" href="#removeItem">Hapus</a>
									<a class="btn btn-small btn-info" href="<?php echo base_url().'admin/setting/provinsi/edit/'.$provinsi['provinsi_id']; ?>">Edit</a>
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
						<h3>Hapus provinsi</h3>
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
			var provinsi_id = $(this).attr('provinsi_id');
			$('#removeItem .modal-footer .btn-danger').attr('href','<?php echo base_url(); ?>admin/setting/provinsi/hapus/'+provinsi_id);
			$('#removeItem .modal-body p').text('Apakah Anda yakin ingin menghapus provinsi "' + nama + '"?');
		});
	});
	</script>