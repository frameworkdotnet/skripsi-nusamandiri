	<div class="secondary-masthead">	
		<div class="container">		
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url().'admin/'; ?>">Admin</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="<?php echo base_url().'admin/pelanggan'; ?>">Pelanggan</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="<?php echo base_url().'admin/pelanggan/review-produk'; ?>">Review Produk</a> <span class="divider">/</span>
				</li>
				<li class="active">Edit</li>
			</ul>		
		</div>	
	</div>	
	<div class="main-area dashboard">
		<div class="container">	
			<?php echo $this->session->flashdata('message') ? $this->session->flashdata('message') : ''; ?>
			<div class="row">
				<div class="span6">
					<div class="slate">
						<div class="page-header">
							<h2>Edit Review</h2>
						</div>
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
							<fieldset>
								<div class="control-group">
									<label class="control-label" for="aktif">Status</label>
									<div class="controls">
										<label class="checkbox">
											<input type="checkbox" name="status" value="1" <?php echo ($review['status']) ? 'checked' : ''; ?>>
										Aktif
										</label>									  
										<input type="hidden" name="review_id" value="<?php echo $review['review_id']; ?>">
									</div>
								</div>
							</fieldset>
					</div>
				</div>
				<div class="span6">
					<div class="slate">
						<div class="page-header">
							<h2>Isi</h2>
						</div>
							<fieldset>
								<div class="control-group <?php echo (form_error('isi')) ? 'error' : ''; ?>">
									<div class="controls">
										<textarea rows="8" class="input-xxlarge" name="isi"><?php echo ($this->input->post()) ? set_value('isi') : $review['isi']; ?></textarea>
										<?php echo form_error('isi'); ?>
									</div>
								</div>
							</fieldset>			
					</div>				
				</div>
				<div class="span12 listing-buttons">
					<a class="btn btn-info" href="<?php echo site_url('admin/setting/informasi'); ?>">Kembali</a> <button class="btn btn-info">Simpan</button>
				</div>
			</div>
			</form>		
			<div class="row">
				<div class="span12 footer">
					<p>&copy; StarKonveksi.com</p>
				</div>
			</div>
		</div>
	</div>