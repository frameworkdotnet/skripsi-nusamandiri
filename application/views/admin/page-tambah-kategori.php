	<div class="secondary-masthead">	
		<div class="container">		
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url().'admin/'; ?>">Admin</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="<?php echo base_url().'admin/kategori'; ?>">Kategori</a> <span class="divider">/</span>
				</li>
				<li class="active">Tambah</li>
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
							<h2>Tambah Kategori</h2>
						</div>
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
							<fieldset>
								<div class="control-group <?php echo (form_error('nama')) ? 'error' : ''; ?>">
									<label class="control-label" for="nama">Nama kategori</label>
									<div class="controls">
										<input class="input-xlarge focused" name="nama" type="text" value="<?php echo set_value('nama'); ?>">
										<?php echo form_error('nama'); ?>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="aktif">Kategori Aktif</label>
									<div class="controls">
									  <label class="checkbox">
										<input type="checkbox" name="status" value="1" checked>
										Aktif
									  </label>
									</div>
								</div>
							</fieldset>
					</div>
				</div>
				<div class="span6">
					<div class="slate">
						<div class="page-header">
							<h2>Deskripsi</h2>
						</div>
							<fieldset>
								<div class="control-group <?php echo (form_error('deskripsi')) ? 'error' : ''; ?>">
									<div class="controls">
										<textarea rows="8" class="input-xxlarge" name="deskripsi"><?php echo set_value('deskripsi'); ?></textarea>
										<?php echo form_error('deskripsi'); ?>
									</div>
								</div>
							</fieldset>			
					</div>				
				</div>
				<div class="span12 listing-buttons">
					<a class="btn btn-info" href="<?php echo site_url('admin/kategori'); ?>">Kembali</a> <button class="btn btn-info">Simpan</button>
				</div>
			</div>
			</form>		
			<div class="row">
				<div class="span12 footer">
					<p>&copy; Website Name 2012</p>
				</div>
			</div>
		</div>
	</div>