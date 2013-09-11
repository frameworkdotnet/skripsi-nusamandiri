<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="#">Admin</a> <span class="divider">/</span>
				</li>
				<li class="active">Data Admin</li>
			</ul>
		</div>
	</div>
	<div class="main-area dashboard">
		<div class="container">
			<?php echo ($this->session->flashdata('msg')) ? $this->session->flashdata('msg') : ''; ?>
			<div class="row">
				<div class="span12 listing-buttons">
					<a href="<?php echo base_url().'admin/tambah'; ?>" class="btn btn-primary">Tambah Admin</a>
				</div>
				<div class="span12">
					<div class="slate">					
						<table class="orders-table table">
						<thead>
							<tr>
								<th>Data Admin</th>
								<th class="actions">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($admin as $admin) : ?>
								<?php 
								if ($admin['status'] == TRUE)
								{
									$label = 'label-info';
									$status = 'Aktif';
									$to_do = 'nonaktif';
								}
								else
								{
									$label = 'label-warning';
									$status = 'Tidak Aktif';
									$to_do = 'aktif';
								}
								?>
								<tr>
									<td><?php echo $admin['nama']; ?> <span class="label <?php echo $label; ?>"><?php echo $status; ?></span></td>
									<td class="actions">
										<a class="btn btn-small btn-danger btn-nonaktif" data-toggle="modal" nama="<?php echo $admin['nama']; ?>" user_id="<?php echo $admin['user_id']; ?>"  to_do="<?php echo $to_do; ?>" href="#removeItem"><?php echo $to_do; ?></a>
										<a class="btn btn-small btn-primary" href="<?php echo base_url().'admin/'.$admin['user_id'].'-'.url_title($admin['nama']); ?>">Lihat</a>
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
			//alert('tes');
		});
	});
	</script>