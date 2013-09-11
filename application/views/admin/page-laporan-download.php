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
							<th>No. Pesanan</th>
							<th>Tanggal</th>
							<th>Nama Pelanggan</th>
							<th>Status</th>
							<th>Total</th>
						</tr>
					<?php
					foreach ($laporan as $row) 
					{
						echo '<tr><th>'.$row['pesanan_id'].'</th>
						<th>'.$row['tgl'].'</th>
						<th>'.$row['pelanggan'].'</th>
						<th>'.$row['status'].'</th>
						<th style="align: right;">'.$row['total'].'</th></tr>';
					}
					?>
					</table>
				</div>
			</div>
		</div>
	</div>