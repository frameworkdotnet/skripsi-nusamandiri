	<div class="secondary-masthead">	
		<div class="container">		
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url().'admin/'; ?>">Admin</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="<?php echo base_url().'admin/setting'; ?>">Setting</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="<?php echo base_url().'admin/setting/informasi'; ?>">Informasi</a> <span class="divider">/</span>
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
							<h2>Edit informasi</h2>
						</div>
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
							<fieldset>
								<div class="control-group <?php echo (form_error('nama')) ? 'error' : ''; ?>">
									<label class="control-label" for="nama">Nama informasi</label>
									<div class="controls">
										<input class="input-xlarge focused" name="nama" type="text" value="<?php echo ($this->input->post()) ? set_value('nama') : $informasi['nama']; ?>">
										<input class="input-xlarge focused" name="informasi_id" type="hidden" value="<?php echo $informasi['informasi_id']; ?>">
										<?php echo form_error('nama'); ?>
									</div>
								</div>
								<div class="control-group <?php echo (form_error('slug')) ? 'error' : ''; ?>">
									<label class="control-label" for="nama">Slug</label>
									<div class="controls">
										<input class="input-xlarge focused" name="slug" type="text" value="<?php echo ($this->input->post()) ? set_value('slug') : $informasi['slug']; ?>">
										<?php echo form_error('slug'); ?>
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
										<textarea rows="8" class="input-xxlarge" name="isi"><?php echo ($this->input->post()) ? set_value('isi') : $informasi['isi']; ?></textarea>
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