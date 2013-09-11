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
					<a href="<?php echo base_url().'admin/setting/povinsi'; ?>">Provinsi</a> <span class="divider">/</span>
				</li>
				<li class="active">Tambah</li>
			</ul>		
		</div>	
	</div>	
	<div class="main-area dashboard">
		<div class="container">
			<div class="row">
				<div class="span6">
					<div class="slate">
						<div class="page-header">
							<h2>Tambah Provinsi</h2>
						</div>
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
							<fieldset>
								<div class="control-group <?php echo (form_error('nama')) ? 'error' : ''; ?>">
									<label class="control-label" for="nama">Nama Provinsi</label>
									<div class="controls">
										<input class="input-xlarge focused" name="nama" type="text" value="<?php echo set_value('nama'); ?>">
										<?php echo form_error('nama'); ?>
									</div>
								</div>
							</fieldset>
					</div>
				</div>
				<div class="span12 listing-buttons">
					<a class="btn btn-info" href="<?php echo site_url('admin/setting/provinsi'); ?>">Kembali</a> <button class="btn btn-info">Simpan</button>
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