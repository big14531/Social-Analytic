<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<style>
	.bg-facebook{
		background-color: #3b5998;
	}
	.icon{
		color: white;
	}
	.btn{
		color:#FFF!important;
	}
</style>
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.min.css">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			ข้อมูล Session - <?=$session?>
		</h1>
	</section>

	<section class="content">   
		<div class="row info-row">
			<div class="col-md-4 ">
				<div class="info-box">
					<span class="info-box-icon bg-facebook"><i class="ion ion-person-stalker icon"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">จำนวนข่าว</span>
						<span class="info-box-number" id="fanpage-box"></span>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="info-box">
					<span class="info-box-icon bg-facebook"><i class="ion ion-speedometer icon"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Engagement รวม</span>
						<span class="info-box-number" id="engage-box"></span>
					</div>
				</div>
			</div>
			<div class="clearfix visible-sm-block"></div>

			<div class="col-md-4">
				<div class="info-box">
					<span class="info-box-icon bg-facebook"><i class="ion ion-chatbubbles icon"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Click รวม</span>
						<span class="info-box-number" id="post-box"></span>
					</div>
				</div>
			</div>
		</div>

		<div class="row chart-row">
			<div class="col-sm-6 col-xs-12">
				<!-- Donut chart -->
				<div class="box gray-box">
					<div class="box-header">
						<h2 class="box-title">อันดับ Rank ภาพรวม</h2>
						<div class="box-tools pull-right">
							<input id="toggle-rank" type="checkbox" data-size="small" checked data-toggle="toggle" data-on="Engage" data-off="Click" data-onstyle="success" data-offstyle="warning">
						</div>
					</div>
					<div class="box-body" id="engage-body">
						<div id="rank-bar-chart1" style="width: 100%;height: 300px;"></div>
					</div>
					<div class="box-body" id="click-body" hidden>
						<div id="rank-bar-chart2" style="width: 100%;height: 300px;"></div>
					</div>

					<!-- /.box-body-->
				</div>
			</div>

			<div class="col-sm-6 col-xs-12">
				<!-- Donut chart -->
				<div class="box gray-box">
					<div class="box-header">
						<h2 class="box-title">จำนวนโพสเฉลี่ย</h2>
					</div>
					<div class="box-body">
						<div id="bar-chart" style="height: 300px;"></div>
					</div>
					<!-- /.box-body-->
				</div>
			</div>
		</div>
	</section>

</div>
<?php $this->load->view( 'default/bottom' ) ?>
<!-- Select2 -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.full.min.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
</script>

</body>
</html>

