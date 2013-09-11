<div id="content">
	<div id="main" class="wrapper clearfix">
		<div class="pagehead">
			<h1><?php echo $informasi['nama']; ?></h1>
			<div>
				<a href="<?php echo base_url(); ?>">Beranda</a>
							 &raquo; <a href=""><?php echo $informasi['nama']; ?></a>
			</div>
		</div>		
		<div id="content-body" class="information-pages">
			<div class="content-box">
				<?php echo $informasi['isi']; ?>
			</div>
			<div class="buttons">
				<div class="right">
					<a href="<?php echo base_url(); ?>" class="button">Lanjut Belanja</a>
				</div>
			</div>
			
		</div>		
	</div>
</div>