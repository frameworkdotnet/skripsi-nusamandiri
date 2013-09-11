	<div class="main-area dashboard">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="slate">
						<div class="page-header">
							<h1>StarKonveksi.com</h1>
							<h2><i class="icon-signal pull-right"></i><?php echo $page_title; ?></h2>
						</div>
					</div>
				</div>
			</div>		
			<div class="row">			
				<div class="span12">
					<table width="100%" border="">
						<tr style="border-bottom: 2px solid black;">
							<th>Produk Id</th>
							<th>Nama</th>
							<th>Kategori</th>
							<th>Harga</th>
							<th>Stok</th>
						</tr>
					<?php
					foreach ($produk as $row) 
					{
						echo '<tr><th>'.$row['produk_id'].'</th>
						<th>'.$row['nama'].'</th>
						<th>'.$row['kategori'].'</th>
						<th>'.$row['harga'].'</th>
						<th style="align: right;">'.$row['stok'].'</th></tr>';
					}
					?>
					</table>
				</div>
			</div>
		</div>
	</div>