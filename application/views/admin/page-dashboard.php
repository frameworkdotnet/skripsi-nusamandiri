	<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="#">Admin</a> <span class="divider">/</span>
				</li>
				<li class="active">Dashboard</li>
			</ul>
		</div>
	</div>
	<div class="main-area dashboard">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="slate clearfix">
						<a class="stat-column" href="#">
							<span class="number"><?php echo $jumlah_pesanan; ?></span>
							<span>Total Pesanan</span>
						</a>
						<a class="stat-column" href="#">
							<span class="number">Rp <?php echo $jumlah_omset; ?></span>
							<span>Total Omset</span>
						</a>
						<a class="stat-column" href="#">
							<span class="number"><?php echo $jumlah_pelanggan; ?></span>
							<span>Pelanggan</span>
						</a>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span6">
					<div class="slate">
						<div class="page-header">
							<h2><i class="icon-signal pull-right"></i>Penjualan Bulan Ini</h2>
						</div>
						<div id="placeholder" style="height: 297px;"></div>
					</div>
				</div>
				<div class="span6">
					<div class="slate">
						<div class="page-header">
							<h2><i class="icon-shopping-cart pull-right"></i>Pesanan Masuk</h2>
						</div>
						<table class="orders-table table">
						<tbody>
							<?php foreach ($pesanan as $pesanan) : ?>
							<tr>
								<td>
									<a href="<?php echo base_url().'admin/pesanan/'.$pesanan['pesanan_id']; ?>"><?php echo $pesanan['pesanan_id'].' - '.$pesanan['nama']; ?></a>
								</td>
								<td style="text-align:center;">
									<?php
									if ($pesanan['status'] == 'Baru') echo '<span class="label label-important">Baru</span>'; 
									else if ($pesanan['status'] == 'Lunas') echo '<span class="label label-warning">Lunas</span>'; 
									else if ($pesanan['status'] == 'Dikirim') echo '<span class="label label-info">Dikirim</span>'; 
									else if ($pesanan['status'] == 'Ditutup') echo '<span class="label label-success">Ditutup</span>'; 
									?>
								</td>
								<td style="text-align:right;">Rp <?php echo $pesanan['total']; ?>,-</td>
							</tr>
							<?php endforeach; ?>
							<tr>
								<td colspan="2"><a href="<?php echo base_url().'admin/pesanan'; ?>">Lihat semua pesanan</a></td>
							</tr>
						</tbody>
						</table>
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
    <script type="text/javascript">
	$(function () {
		$.ajax({
			url: '<?php echo base_url(); ?>admin/laporan/penjualan-bulan-ini',
			dataType: 'json',
			success: function(retData) {
				renderGraph(retData);
			}
		});
		function renderGraph(datasets) {
			var d1 = [];
			for (var i=1;i<datasets[0];i++) {
				var obj = datasets[i];
				if (obj!=undefined) {	
					var tgl = parseInt(obj.tgl);
					d1.push([tgl, obj.total]);
				} else {
					d1.push([i, 0]);
				}	
			}
			//console.log(d1);
			$.plot($("#placeholder"), [ d1 ], { grid: { backgroundColor: 'white', color: '#999', borderWidth: 1, borderColor: '#DDD' }, colors: ["#f89406"], series: { lines: { show: true, fill: true, fillColor: "rgba(248, 148, 6, 0.5)" } } });
		}
	});
	</script>