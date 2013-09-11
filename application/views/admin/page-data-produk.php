	<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url().'admin/'; ?>">Admin</a> <span class="divider">/</span>
				</li>
				<li class="active">Produk</li>
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
								<a href="<?php echo base_url(); ?>admin/produk/tambah" class="btn btn-info">Tambah Produk</a>
							</div>
							<h2>Katalog Produk</h2>
						</div>
						<?php if (count($produk)) : ?>
						<table class="orders-table table">
						<thead>
							<tr>
								<th>Gambar</th>
								<th>Nama Produk</th>
								<th class="actions">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($produk as $prod) : ?>
							<tr>
								<td>
									<img src="<?php echo base_url().'assets/produk/'.$prod['gambar']; ?>" height="100" width="100"/>
								</td>
								<td>
									<a href="<?php echo base_url().'produk/'.$prod['produk_id'].'-'.url_title($prod['nama']); ?>"><?php echo $prod['nama']; ?></a>
									<?php echo ($prod['status'] == TRUE) ? '<span class="label label-success">Aktif</span>' : '<span class="label label-warning">Tidak Aktif</span>'; ?>							
									<?php echo ($prod['feature'] == TRUE) ? '<span class="label label-info">Feature</span>' : ''; ?>
									<br />
									<span class="meta"><?php echo $prod['kategori']; ?></span>
								</td>
								<td class="actions">
									<a class="btn btn-small btn-danger btn-hapus" data-toggle="modal" produk_id="<?php echo $prod['produk_id']; ?>" nama="<?php echo $prod['nama']; ?>" href="#removeItem">Hapus</a>
									<a class="btn btn-small btn-info" href="<?php echo base_url().'admin/produk/edit/'.$prod['produk_id']; ?>">Edit</a>
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
						<h3>Hapus Produk</h3>
					</div>
					<div class="modal-body">
						<p></p>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn" data-dismiss="modal">Close</a>
						<a href="#" class="btn btn-danger">Hapus</a>
					</div>
				</div>			
				<div class="span6">				
					<?php echo $this->pagination->create_links(); ?>	
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
			$('#removeItem .modal-footer .btn-danger').attr('href','<?php echo base_url(); ?>admin/produk/hapus/'+produk_id);
			$('#removeItem .modal-body p').text('Apakah Anda yakin ingin menghapus produk "' + nama + '"?');
		});
	});
	</script>