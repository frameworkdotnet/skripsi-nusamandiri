	<div class="secondary-masthead">
		<div class="container">
			<ul class="breadcrumb">
				<li>
					<a href="<?php echo base_url(); ?>admin/">Admin</a> <span class="divider">/</span>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>admin/laporan">Laporan</a> <span class="divider">/</span>
				</li>
				<li class="active">Laporan Penjualan</li>
			</ul>
		</div>
	</div>
	<div class="main-area dashboard">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="slate">
						<form class="form-inline form-filter" method="post">
							Tahun
							<select name="tahun">
								<option value="2013" selected>2013</option>
								<option value="2012">2012</option>
							</select>
							Bulan
							<select name="bulan">
								<option value="01" selected>Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select>
							Status Pesanan
							<select name="status">
								<option value="All" selected> All </option>
								<option value="Baru"> Baru </option>
								<option value="Lunas"> Lunas </option>
								<option value="Dikirim"> Dikirim </option>
								<option value="Ditutup"> Ditutup </option>
							</select>
							<button type="submit" class="btn btn-primary btn-submit">Filter Laporan</button>
							<a href="<?php echo base_url().'admin/laporan/penjualan-pdf/'.date('Y-m'); ?>" class="btn btn-primary">Download PDF</a>
						</form>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span1 offset5 loader">
					<img src="<?php echo base_url(); ?>assets/img/loader.gif" width="50" height="50"/>
				</div>
				<div class="span12">
					<div class="slate">
						<div class="page-header">
							<h2><i class="icon-signal pull-right"></i>Laporan Penjualan <span class="title">Bulan Ini</span></h2>
						</div>
						<div id="placeholder" style="height: 400px;"></div>
					</div>
				</div>
			</div>
    <script type="text/javascript">
	$(function () {
		$('.btn-submit').click(function(e) {
			$('.loader').show();
			e.preventDefault();
			$.ajax({
				url: '<?php echo base_url(); ?>admin/laporan/penjualan-custom',
				data: $('.form-filter').serialize(),
				type:'post',
				dataType: 'json',
				success: function(retData) {
					if (retData == '') {
						$('.loader').slideUp('slow');
						alert('Data tidak tersedia, silahkan pilih range data lainnya.');
						return;
					}
					var title = $('select[name=status]').val() + ' ' +$('select[name=tahun]').val() + '/' + $('select[name=bulan]').val();
					$('.title').text(title)
					renderGraph(retData);					
					$('.loader').slideUp('slow');
				}
			});
		});		
		$.ajax({
			url: '<?php echo base_url(); ?>admin/laporan/penjualan-bulan-ini',
			dataType: 'json',
			success: function(retData) {
				renderGraph(retData);
				$('.loader').slideUp('slow');
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
				console.log(d1);
			$.plot($("#placeholder"), [ d1 ], { grid: { backgroundColor: 'white', color: '#999', borderWidth: 1, borderColor: '#DDD' }, colors: ["#f89406"], series: { lines: { show: true, fill: true, fillColor: "rgba(248, 148, 6, 0.5)" } } });
		}
	});
	</script>			
			<div class="row">			
				<div class="span12 footer">
					<p>&copy; StarKonveksi.com 2013</p>
				</div>
			</div>
		</div>
	</div>