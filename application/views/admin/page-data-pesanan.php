<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="#">Admin</a> <span class="divider">/</span>
				</li>
				<li class="active">Pesanan</li>
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
								<th>Data Pesanan</th>
								<th class="actions">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($pesanan as $pesanan) : ?>
								<tr>
									<td><?php echo $pesanan['nama']; ?> 
										<?php
											if ($pesanan['status'] == 'Baru') echo '<span class="label label-important">Baru</span>'; 
											else if ($pesanan['status'] == 'Lunas') echo '<span class="label label-warning">Lunas</span>'; 
											else if ($pesanan['status'] == 'Dikirim') echo '<span class="label label-success">Dikirim</span>'; 
											else if ($pesanan['status'] == 'Ditutup') echo '<span class="label label-info">Ditutup</span>'; 
										?>
									</td>
									<td class="actions actions-large">
										<?php if ($pesanan['status'] !== 'Baru') : ?>
											<a class="btn btn-small btn-danger btn-update" data-toggle="modal" pesanan_id="<?php echo $pesanan['pesanan_id']; ?>" href="#removeItem">Update Status</a>
										<?php endif; ?>
										<a class="btn btn-small btn-primary" href="<?php echo base_url().'admin/pesanan/konfirmasi/'.$pesanan['pesanan_id']; ?>">Cek Pembayaran</a>
										<a class="btn btn-small btn-primary" href="<?php echo base_url().'admin/pesanan/'.$pesanan['pesanan_id']; ?>">Detail</a>
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
						<h3>Update Status Pesanan</h3>
					</div>
					<div class="modal-body">
						<p>
						<select name="status">
							<option value="0">Baru</option>
							<option value="1">Lunas</option>
							<option value="2">Dikirim</option>
							<option value="3">Ditutup</option>
						</select>
						</p>
					</div>
					<div class="modal-footer">
						<a href="#" class="btn" data-dismiss="modal">Cancel</a>
						<a href="" class="btn btn-danger">Update</a>
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
		$('.btn-update').click(function() {	
			alert('Clicked');
			var pesanan_id = $(this).attr('pesanan_id');
			$('#removeItem .modal-footer .btn-danger').attr('href','<?php echo base_url(); ?>admin/pesanan/update/'+pesanan_id);
		});
		$('select[name=status]').change(function(){
			var status = $(this).val();
			var url = $('#removeItem .modal-footer .btn-danger').attr('href') + '/' + status;
			$('#removeItem .modal-footer .btn-danger').attr('href',url);
		});
	});
	</script>