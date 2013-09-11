	<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url().'admin/'; ?>">Admin</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="<?php echo base_url().'admin/setting'; ?>">Setting</a> <span class="divider">/</span>
				</li>
				<li class="active">Kota</li>
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
								<a href="<?php echo base_url(); ?>admin/setting/kota/tambah" class="btn btn-info">Tambah Kota</a>
							</div>
							<h2>Daftar Kota</h2>
						</div>
						<?php if (count($kota)) : ?>
						<table class="orders-table table">
						<thead>
							<tr>
								<th>Nama Kota</th>
								<th class="actions">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($kota as $kota) : ?>
							<tr>
								<td>
									<a href="<?php echo base_url().'kota/'.$kota['kota_id'].'-'.url_title($kota['nama']); ?>"><?php echo $kota['nama']; ?></a>&nbsp;&nbsp;<?php echo '<span class="label label-success">Rp '.$kota['ongkos_kirim'].',-</span>'; ?>	
									<br>
									<span class="meta"><?php echo $kota['provinsi']; ?></span>
								</td>
								<td class="actions">
									<a class="btn btn-small btn-danger btn-hapus" data-toggle="modal" kota_id="<?php echo $kota['kota_id']; ?>" nama="<?php echo $kota['nama']; ?>" href="#removeItem">Hapus</a>
									<a class="btn btn-small btn-info" href="<?php echo base_url().'admin/setting/kota/edit/'.$kota['kota_id']; ?>">Edit</a>
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
						<h3>Hapus kota</h3>
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
			var kota_id = $(this).attr('kota_id');
			$('#removeItem .modal-footer .btn-danger').attr('href','<?php echo base_url(); ?>admin/setting/kota/hapus/'+kota_id);
			$('#removeItem .modal-body p').text('Apakah Anda yakin ingin menghapus kota "' + nama + '"?');
		});
	});
	</script>