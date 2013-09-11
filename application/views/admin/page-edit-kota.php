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
					<a href="<?php echo base_url().'admin/setting/kota'; ?>">Kota</a> <span class="divider">/</span>
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
							<h2>Edit Kota</h2>
						</div>
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
							<fieldset>
								<div class="control-group <?php echo (form_error('provinsi_id')) ? 'error' : ''; ?>">
									<label class="control-label" for="nama">Provinsi</label>
									<div class="controls">
										<select name="provinsi_id">
											<?php
											foreach ($provinsi as $provinsi) :
												$selected = ($kota['provinsi_id'] == $provinsi['provinsi_id']) ? 'selected' : '';
												echo '<option value="'.$provinsi['provinsi_id'].'" '.$selected.'>'.$provinsi['nama'].'</option>';
											endforeach; 
											?>
										</select>
										<?php echo form_error('provinsi_id'); ?>
									</div>
								</div>
								<div class="control-group <?php echo (form_error('nama')) ? 'error' : ''; ?>">
									<label class="control-label" for="nama">Nama Kota</label>
									<div class="controls">
										<input class="input-xlarge focused" name="nama" type="text" value="<?php echo ($this->input->post()) ? set_value('nama') : $kota['nama']; ?>">
										<input class="input-xlarge focused" name="kota_id" type="hidden" value="<?php echo $kota['kota_id']; ?>">
										<?php echo form_error('nama'); ?>
									</div>
								</div>
							</fieldset>
					</div>
				</div>
				<div class="span6">
					<div class="slate">
						<div class="page-header">
							<h2>Ongkos Kirim</h2>
						</div>
							<fieldset>
								<div class="control-group <?php echo (form_error('ongkos_kirim')) ? 'error' : ''; ?>">
									<div class="controls">
										<input class="input-large focused" name="ongkos_kirim" type="text" value="<?php echo ($this->input->post()) ? set_value('ongkos_kirim') : $kota['ongkos_kirim']; ?>">
										<?php echo form_error('ongkos_kirim'); ?>
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