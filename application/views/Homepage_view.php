<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<style>
	.products-list>.item{
		background-color: transparent;
	}
	.box-body{
		padding: 20px;
		padding-top: 10px;
	}
	.icon{
		color: white;
	}
	.page-name{
		color:black!important;
	}
	.white-box{
		padding-left: 20px;
		padding-right: 20px;
		padding-bottom: 20px;
		background-color: white;
	}
	.verify-icon{
		color: #3b5998!important;
	}
	.bg-facebook{
		background-color: #3b5998;
	}
	.text-detail{
		color: black;
		margin-top: 10px;
	}
	.content{
		padding-top: 30px;
		padding-left: 30px;
		padding-right: 30px;
	}
	.info-row{
		margin-top: 50px;
	}
	.page-logo{
		width: 50%;
	}
	.sk-cube-grid {
		width: 50px;
		height: 50px;
		margin: 100px auto;
	}
	.sk-cube-grid .sk-cube {
		width: 33%;
		height: 33%;
		background-color: #FFF;
		float: left;
		-webkit-animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out;
		animation: sk-cubeGridScaleDelay 1.3s infinite ease-in-out; 
	}
	.sk-cube-grid .sk-cube1 
	{
		-webkit-animation-delay: 0.2s;
		animation-delay: 0.2s; 
	}
	.sk-cube-grid .sk-cube2 
	{
		-webkit-animation-delay: 0.3s;
		animation-delay: 0.3s; 
	}
	.sk-cube-grid .sk-cube3 
	{
		-webkit-animation-delay: 0.4s;
		animation-delay: 0.4s; 
	}
	.sk-cube-grid .sk-cube4 
	{
		-webkit-animation-delay: 0.1s;
		animation-delay: 0.1s; 
	}
	.sk-cube-grid .sk-cube5 
	{
		-webkit-animation-delay: 0.2s;
		animation-delay: 0.2s; 
	}
	.sk-cube-grid .sk-cube6 
	{
		-webkit-animation-delay: 0.3s;
		animation-delay: 0.3s; 
	}
	.sk-cube-grid .sk-cube7 
	{
		-webkit-animation-delay: 0s;
		animation-delay: 0s; 
	}
	.sk-cube-grid .sk-cube8 
	{
		-webkit-animation-delay: 0.1s;
		animation-delay: 0.1s; 
	}
	.sk-cube-grid .sk-cube9 
	{
		-webkit-animation-delay: 0.2s;
		animation-delay: 0.2s; 
	}

	@-webkit-keyframes sk-cubeGridScaleDelay 
	{
		0%, 70%, 100% {
			-webkit-transform: scale3D(1, 1, 1);
			transform: scale3D(1, 1, 1);
		} 35% {
			-webkit-transform: scale3D(0, 0, 1);
			transform: scale3D(0, 0, 1); 
		}
	}

	@keyframes sk-cubeGridScaleDelay 
	{
		0%, 70%, 100% {
			-webkit-transform: scale3D(1, 1, 1);
			transform: scale3D(1, 1, 1);
		} 35% {
			-webkit-transform: scale3D(0, 0, 1);
			transform: scale3D(0, 0, 1);
		} 
	}
</style>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Dashboard - <small> facebook post analytic</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-md-4 col-xs-12" style="text-align: center;">
				<img class="page-logo" src="https://scontent.xx.fbcdn.net/v/t1.0-1/14633025_10154714845219668_8361881400074819233_n.jpg?oh=6ec8035438f289abcc26665bdc3721a3&oe=5983BFC1">
			</div>
			<div class="col-md-8 col-xs-12">
				<div class="box white-box">
					<h1 class="page-name">Khaosod - ข่าวสด	<i class="ion ion-checkmark-circled verify-icon"></i></h1>
					<p class="text-detail">About: “Official Khaosod newspaper Fanpage Site. แฟนเพจอย่างเป็นทางการของ นสพ.ข่าวสด”</p>
					<p class="text-detail">Category: News & Media > News </p>
				</div>	
			</div>
		</div>

		<div class="row info-row">
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="info-box">
					<span class="info-box-icon bg-facebook"><i class="ion ion-person-stalker icon"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Fanpage</span>
						<span class="info-box-number">6,120,056</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="info-box">
					<span class="info-box-icon bg-facebook"><i class="ion ion-speedometer icon"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Engagement</span>
						<span class="info-box-number">41,410</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->

			<!-- fix for small devices only -->
			<div class="clearfix visible-sm-block"></div>

			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="info-box">
					<span class="info-box-icon bg-facebook"><i class="ion ion-chatbubbles icon"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Posts</span>
						<span class="info-box-number">760</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="info-box">
					<span class="info-box-icon bg-facebook"><i class="ion ion-person-add icon"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">New Fanpage</span>
						<span class="info-box-number">2,000</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			<!-- /.col -->
		</div>

		<div class="row chart-row">
			<div class="col-sm-6 col-xs-12">
				<!-- Donut chart -->
				<div class="box gray-box">
					<div class="box-header">
						<h2 class="box-title">Type of Posts</h2>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<div id="donut-chart" style="height: 300px;"></div>
					</div>
					<!-- /.box-body-->
				</div>
			</div>

			<div class="col-sm-6 col-xs-12">
				<!-- Donut chart -->
				<div class="box gray-box">
					<div class="box-header">
						<h2 class="box-title">Posts per Days</h2>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<div id="bar-chart" style="height: 300px;"></div>
					</div>
					<!-- /.box-body-->
				</div>
			</div>

			<div class="col-sm-6 col-xs-12">
				<!-- Donut chart -->
				<div class="box gray-box">
					<div class="box-header">
						<h2 class="box-title">Best of Week</h2>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<ul class="products-list product-list-in-box">

							<li class="item">
								<div class="product-img">
									<img src="dist/img/default-50x50.gif" alt="Product Image">
								</div>
								<div class="product-info">
									<a href="javascript:void(0)" class="product-title">Samsung TV
										<span class="label label-success pull-right">Link</span>
									</a>
									<span class="product-description">
										Samsung 32" 1080p 60Hz LED Smart HDTV.
									</span>
								</div>
							</li>

							<li class="item">
								<div class="product-img">
									<img src="dist/img/default-50x50.gif" alt="Product Image">
								</div>
								<div class="product-info">
									<a href="javascript:void(0)" class="product-title">Samsung TV
										<span class="label label-danger pull-right">Live</span>
									</a>
									<span class="product-description">
										Samsung 32" 1080p 60Hz LED Smart HDTV.
									</span>
								</div>
							</li>

							<li class="item">
								<div class="product-img">
									<img src="dist/img/default-50x50.gif" alt="Product Image">
								</div>
								<div class="product-info">
									<a href="javascript:void(0)" class="product-title">Samsung TV
										<span class="label label-danger pull-right">Live</span>
									</a>
									<span class="product-description">
										Samsung 32" 1080p 60Hz LED Smart HDTV.
									</span>
								</div>
							</li>

							<li class="item">
								<div class="product-img">
									<img src="dist/img/default-50x50.gif" alt="Product Image">
								</div>
								<div class="product-info">
									<a href="javascript:void(0)" class="product-title">Samsung TV
										<span class="label label-danger pull-right">Live</span>
									</a>
									<span class="product-description">
										Samsung 32" 1080p 60Hz LED Smart HDTV.
									</span>
								</div>
							</li>

							<li class="item">
								<div class="product-img">
									<img src="dist/img/default-50x50.gif" alt="Product Image">
								</div>
								<div class="product-info">
									<a href="javascript:void(0)" class="product-title">Samsung TV
										<span class="label label-danger pull-right">Live</span>
									</a>
									<span class="product-description">
										Samsung 32" 1080p 60Hz LED Smart HDTV.
									</span>
								</div>
							</li>

						</ul>
					</div>
					<!-- /.box-body-->
				</div>
			</div>

			<div class="col-sm-6 col-xs-12">
				<!-- Donut chart -->
				<div class="box gray-box">
					<div class="box-header">
						<h2 class="box-title">Worst of Week</h2>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<div id="bar-chart" style="height: 300px;"></div>
					</div>
					<!-- /.box-body-->
				</div>
			</div>

		</div>
	</section>

	<div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
		<div class="modal-dialog" role="document" style="text-align: center;">
			<div class="sk-cube-grid">
				<div class="sk-cube sk-cube1"></div>
				<div class="sk-cube sk-cube2"></div>
				<div class="sk-cube sk-cube3"></div>
				<div class="sk-cube sk-cube4"></div>
				<div class="sk-cube sk-cube5"></div>
				<div class="sk-cube sk-cube6"></div>
				<div class="sk-cube sk-cube7"></div>
				<div class="sk-cube sk-cube8"></div>
				<div class="sk-cube sk-cube9"></div>
			</div>

			<h3 style="color: #FFF">Loading....</h3>
		</div>
	</div>


</div>

<?php $this->load->view( 'default/bottom' ) ?>

<script>
	$('#myModal').modal('show');
	setTimeout(function(){
		$('#myModal').modal('hide');
	}, 2000);


	function createBarChart()
	{
		var bar_data = {
			data: [["January", 10], ["February", 8], ["March", 4], ["April", 13], ["May", 17], ["June", 9]],
			color: "#3b5998"
		};
		$.plot("#bar-chart", [bar_data], {
			grid: {
				borderWidth: 0,
				borderColor: "#f3f3f3",
				tickColor: "#f3f3f3",
				borderWidth:0,
				labelMargin:0, 
				axisMargin:0, 
				minBorderMargin:0
			},
			series: {
				bars: {
					show: true,
					barWidth: 0.5,
					align: "center"
				}
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			},
			yaxis: {
				show: false,
			}
		});
	}

	function createPieChart() 
	{
		var donutData = [
		{label: "Series2", data: 30, color: "#3c8dbc"},
		{label: "Series3", data: 20, color: "#0073b7"},
		{label: "Series4", data: 50, color: "#00c0ef"}
		];
		$.plot("#donut-chart", donutData, {
			series: {
				pie: {
					show: true,
					radius: 1,
					innerRadius: 0.5,
					label: {
						show: true,
						radius: 2 / 3,
						formatter: labelFormatter,
						threshold: 0.1
					}

				}
			},
			legend: {
				show: false
			}
		});
	}

	function updateFloatWidget()
	{
		$(".chart-row > div").each(function(i){

			if(i%2<=0){
				$(this).removeClass('pull-right');
				$(this).addClass('pull-left');
			}else{
				$(this).removeClass('pull-left');
				$(this).addClass('pull-right');
			}
		});

	}

	$(document).ready(function() 
	{
		createBarChart();
		createPieChart();
		updateFloatWidget();
	});

	function labelFormatter(label, series) 
	{
		return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
		+ label
		+ "<br>"
		+ Math.round(series.percent) + "%</div>";
	}
</script>

</body>
</html>

