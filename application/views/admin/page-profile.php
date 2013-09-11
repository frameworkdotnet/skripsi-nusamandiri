	<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="#">Dashboard</a> <span class="divider">/</span>
				</li>
				<li class="active"><?php echo $this->session->userdata('nama'); ?></li>
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
								<h2>Profil</h2>
							</div>
							<?php echo validation_errors(); ?>
							<form action="" method="post"  class="form-horizontal">
								<div class="control-group">
									<label class="control-label" for="inputNama">Nama</label>
									<div class="controls">
										<input type="text" id="inputNama" name="nama" value="<?php echo $admin['nama']; ?>" <?php echo $disabled; ?>>
										<input type="hidden" id="inputNama" name="user_id" value="<?php echo $admin['user_id']; ?>">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="inputEmail">Email</label>
									<div class="controls">
										<input type="text" id="inputEmail" name="email" value="<?php echo $admin['email']; ?>" <?php echo $disabled; ?>>
									</div>
								</div>
								<?php if ($disabled == '') : ?>
								<div class="control-group">
									<label class="control-label" for="inputPassword">Password</label>
									<div class="controls">
										<input type="password" id="inputPassword" name="password" placeholder="Password" <?php echo $disabled; ?>>
										<input type="password" id="inputPassword2" name="password2" placeholder="Retype Password" <?php echo $disabled; ?>>
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<label class="checkbox">Kosongkan password jika tidak diupdate.</label>
										<button type="submit" class="btn">Update</button>
									</div>
								</div>
								<?php endif; ?>
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