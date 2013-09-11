	<div class="secondary-masthead">	
		<div class="container">		
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url().'admin/'; ?>">Admin</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="<?php echo base_url().'admin/produk'; ?>">Produk</a> <span class="divider">/</span>
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
							<h2>Edit Produk</h2>
						</div>
						<form class="form-horizontal" method="post" enctype="multipart/form-data">
							<fieldset>
								<div class="control-group <?php echo (form_error('nama')) ? 'error' : ''; ?>">
									<label class="control-label" for="nama">Nama Produk</label>
									<div class="controls">
										<input class="input-xlarge focused" name="nama" type="text" value="<?php echo (set_value('nama')) ? set_value('nama') : $produk['nama']; ?>">
										<input name="produk_id" type="hidden" value="<?php echo $produk['produk_id']; ?>">
										<?php echo form_error('nama'); ?>
									</div>
								</div>								
								<div class="control-group">
									<label class="control-label" for="kategori">Kategori</label>
									<div class="controls">
										<select name="kategori_id">
											<?php
											foreach ($kategori as $kategori) :
												$selected = ($kategori['kategori_id'] == $produk['kategori_id']) ? 'selected' : '';
												echo '<option value="'.$kategori['kategori_id'].'" '.$selected.' >'.$kategori['nama'].'</option>';
											endforeach; 
											?>
										</select>
									</div>
								</div>
								<div class="control-group <?php echo (form_error('harga')) ? 'error' : ''; ?>">
									<label class="control-label" for="harga">Harga (Rp)</label>
									<div class="controls">
										<input class="input-medium" name="harga" type="text" value="<?php echo (set_value('harga')) ? set_value('harga') : $produk['harga']; ?>">
										<?php echo form_error('harga'); ?>
									</div>
								</div>
								<div class="control-group <?php echo (form_error('stok')) ? 'error' : ''; ?>">
									<label class="control-label" for="stok">Stok</label>
									<div class="controls">
										<input class="input-mini" name="stok" type="text" value="<?php echo (set_value('stok')) ? set_value('stok') : $produk['stok']; ?>"> pcs								
										<?php echo form_error('stok'); ?>
									</div>
								</div>
								<div class="control-group <?php echo (form_error('berat')) ? 'error' : ''; ?>">
									<label class="control-label" for="berat">Berat<br>*pecahan gunakan titik</label>
									<div class="controls">
										<input class="input-mini" name="berat" type="text" value="<?php echo (set_value('berat')) ? set_value('berat') : $produk['berat']; ?>"> kg
										<?php echo form_error('berat'); ?>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="aktif">Produk Aktif</label>
									<div class="controls">
									  <label class="checkbox">
										<input type="checkbox" name="status" value="1" <?php echo ($produk['status']) ? 'checked' : ''; ?>>
										Aktif
									  </label>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="feature">Produk Feature</label>
									<div class="controls">
									  <label class="checkbox">
										<input type="checkbox" name="feature" value="1" <?php echo ($produk['feature']) ? 'checked' : ''; ?>>
										Ya
									  </label>
									</div>
								</div>
							</fieldset>
					</div>
				</div>
				<div class="span6">
					<div class="slate">
						<div class="page-header">
							<h2>Gambar Produk</h2>
						</div>
							<fieldset>
								<div class="control-group <?php echo (form_error('gambar')) ? 'error' : ''; ?>">
									<div class="controls">
										<img src="<?php echo base_url().'assets/produk/'.$produk['gambar']; ?>" width="120" height="120"></br>
										<input class="input-file" name="gambar" type="file">					
										<?php echo form_error('gambar'); ?>
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
										<textarea rows="8" class="input-xxlarge" name="deskripsi">
										<?php echo (set_value('deskripsi')) ? set_value('deskripsi') : $produk['deskripsi']; ?>
										</textarea>
										<?php echo form_error('deskripsi'); ?>
									</div>
								</div>
							</fieldset>			
					</div>				
				</div>
				<div class="span12 listing-buttons">
					<a class="btn btn-info" href="<?php echo site_url('admin/produk'); ?>">Kembali</a> <button class="btn btn-info">Update</button>
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