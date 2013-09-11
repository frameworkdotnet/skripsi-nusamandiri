<div id="content">
	<div id="main" class="wrapper clearfix">
		<div class="pagehead">
			<h1>Dashboard Pelanggan</h1>
			<div>
				<a href="<?php echo base_url(); ?>">Home</a>
				&raquo; Pelanggan
			</div>
		</div>		
		<aside id="column-right" class="column">
			<div class="box">
				<div class="box-heading header-3">Dashboard</div>
				<div class="box-content">
					<div class="col-links">
						<ul>
							<li><a href="<?php echo base_url().'pelanggan/'.$this->session->userdata('pelanggan_id').'-'.url_title($this->session->userdata('nama')); ?>">My Profil</a></li>
							<li><a href="<?php echo base_url().'pelanggan/pesanan'; ?>">My Pesanan</a></li>
							<li><a href="<?php echo base_url().'pelanggan/review-produk'; ?>">My Review</a></li>
							<li><a href="<?php echo base_url().'pelanggan/logout'; ?>">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
		</aside>
		<div id="content-body">
			<p>This gift certificate will be emailed to the recipient after your order has been paid for.</p>
			<form action="http://rgenesis.com/themeforest/Cupid-RGen-OpenCart-Store-Template/demo3/index.php?route=account/voucher" method="post" enctype="multipart/form-data">
				<div class="box-form">
					<div class="content">
						<table class="form">
							<tr>
								<td><span class="required">*</span> Recipient's Name:</td>
								<td><input type="text" name="to_name" value="" />
									</td>
							</tr>
							<tr>
								<td><span class="required">*</span> Recipient's Email:</td>
								<td><input type="text" name="to_email" value="" />
									</td>
							</tr>
							<tr>
								<td><span class="required">*</span> Your Name:</td>
								<td><input type="text" name="from_name" value="" />
									</td>
							</tr>
							<tr>
								<td><span class="required">*</span> Your Email:</td>
								<td><input type="text" name="from_email" value="" />
									</td>
							</tr>
							<tr>
								<td><span class="required">*</span> Gift Certificate Theme:</td>
								<td>																		<input type="radio" name="voucher_theme_id" value="7" id="voucher-7" />
									<label for="voucher-7">Birthday</label>
																		<br />
																											<input type="radio" name="voucher_theme_id" value="6" id="voucher-6" />
									<label for="voucher-6">Christmas</label>
																		<br />
																											<input type="radio" name="voucher_theme_id" value="8" id="voucher-8" />
									<label for="voucher-8">General</label>
																		<br />
																		</td>
							</tr>
							<tr>
								<td>Message:<br /><span class="help">(Optional)</span></td>
								<td><textarea name="message" cols="40" rows="5"></textarea></td>
							</tr>
							<tr>
								<td><span class="required">*</span> Amount:<br /><span class="help">(Value must be between $1.00 and $1,000.00)</span></td>
								<td><input type="text" name="amount" value="25.00" size="5" />
									</td>
							</tr>
						</table>
					</div>
				</div>
				
				
				<div class="buttons">
					<div class="right">I understand that gift certificates are non-refundable.												<input type="checkbox" name="agree" value="1" />
												<input type="submit" value="Continue" class="button" />
					</div>
				</div>
			</form>
			
					</div>
		
	</div>
</div>