	<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="#">Admin</a> <span class="divider">/</span>
				</li>
				<li class="active">Tambah Admin</li>
			</ul>
		</div>
	</div>
	<div class="main-area dashboard">
		<div class="container">
			<?php echo ($this->session->flashdata('msg')) ? $this->session->flashdata('msg') : ''; ?>		
			<div class="row">
				<div class="span8">
					<div class="row">
					<div class="span6">
						<div class="slate">
							<div class="page-header">
								<h2>Tambah Admin</h2>
							</div>
							<?php echo validation_errors(); ?>
							<form action="" method="post"  class="form-horizontal">
								<div class="control-group">
									<label class="control-label" for="inputNama">Nama</label>
									<div class="controls">
										<input type="text" id="inputNama" name="nama" value="<?php echo set_value('nama'); ?>">
										<input type="hidden" id="inputNama" name="tambah" value="true">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputEmail">Email</label>
									<div class="controls">
										<input type="text" id="inputEmail" name="email" value="<?php echo set_value('email'); ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputPassword">Password</label>
									<div class="controls">
										<input type="password" id="inputPassword" name="password" placeholder="Password">
										<input type="password" id="inputPassword2" name="password2" placeholder="Retype Password">
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<button type="submit" class="btn">Simpan</button>
									</div>
								</div>
							</form>
						</div>
					</div>					
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