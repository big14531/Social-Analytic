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
						<span class="info-box-number" id="post-number-box"></span>
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
						<span class="info-box-number" id="click-box"></span>
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
<!-- Select2 -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.full.min.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>

	function showTooltip(x, y, color, contents) 
	{
		$('<div id="tooltip">' + contents + '</div>').css({
			position: 'absolute',
			display: 'none',
			top: y - 50,
			left: x - 100,
			border: '2px solid ' + color,
			padding: '3px',
				'font-size': '15px',
				'border-radius': '5px',
				'background-color': '#fff',
				'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
			opacity: 0.9
		}).appendTo("body").fadeIn(200);
	}

	function averageValueByDay( data ) 
	{
		var result = [];
		var value_array =[[],[],[],[],[],[],[]];
		var day_of_week =[];
		for (var key in data) 
		{
			var row = data[key];
			var day_name = row[0];
			var value = row[1];
			var index = day_of_week.indexOf( day_name );
			if( index == -1 )
			{
				day_of_week.push( day_name );
				index = day_of_week.indexOf( day_name );
				value_array[index].push( value );
			}
			else
			{
				index = day_of_week.indexOf( day_name );
				value_array[index].push( value );
			}
			
		}
		for (var key2 in day_of_week) 
		{
			var day_value = value_array[key2];
			let sum = day_value.reduce((x,y) => parseInt(x)+parseInt(y) );
			sum = sum/day_value.length;
			var data_array = [ day_of_week[key2] , Math.floor(sum) ];
			result.push( data_array );
		}
		return result;
	}

	function createDetailBox( data ) 
	{
		var sum_engage = 0;
		var sum_post = 0;
		for (var index = 0; index < data.length; index++) 
		{
			var element = data[index];
			var engage =  parseInt(element.total);
			var post =  parseInt(element.post_count);
			sum_engage = sum_engage + engage;
			sum_post = sum_post + post;
		}
		$('#post-number-box').html( sum_post.toLocaleString('en-US') );
		$('#engage-box').html( sum_engage.toLocaleString('en-US') );
		$('#click-box').html();
	}

	function createRankBarChart( data )
	{
		var result=[];
		var engage_data =[];
		var click_data =[];
		for( var key in data )
		{
			var row 			= data[key];
			var engage_value 	= row.engage_rank;
			var click_value 	= row.click_rank;
			var rank 			= row.rank;

			engage_data.unshift( [rank , engage_value ] );
			click_data.unshift( [rank , click_value ] );
		}


		var engage_series = {
			data: engage_data,
			color: "#00a65a"
		};

		var click_series = {
			data: click_data,
			color: "#f39c12"
		};
	
		var option = {
			grid: {
				borderWidth: 0,
				hoverable: true,
            	clickable: true,
				mouseActiveRadius: 30
			},
			series: {
				bars: {
					show: true,
					barWidth: 0.8,
					align: "center",
					numbers : {
            			show : true,
						font : { size: 30 ,color:'#FFF'},
					}
				}
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			},
			yaxis:{
				ticks: [] 
			}
		};

		$.plot("#rank-bar-chart1", [engage_series], option);

		$.plot("#rank-bar-chart2", [click_series], option);

	}

	function createBarChart( data )
	{
		var result=[];

		for( var key in data )
		{
			var row = data[key]
			var raw_time = row.created_time_out;
			var dt = moment(raw_time);
			var day_name = dt.format('ddd');
			var value = row.post_count;
			var data_array = [ day_name , value ];
			result.push( data_array );
		}

		result = averageValueByDay( result );

		var bar_data = {
			data: result,
			color: "#00c0ef"
		};

		$.plot("#bar-chart", [bar_data], {
			grid: {
				borderWidth: 0,
				hoverable: true,
            	clickable: true,
				mouseActiveRadius: 30
			},
			series: {
				bars: {
					show: true,
					barWidth: 0.8,
					align: "center",
					numbers : {
            			show : true,
						font : { size: 30 ,color:'#FFF'},
					}
				}
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			},
			yaxis:{
				ticks: []
			}
		});
		var previousPoint = null,
    		previousLabel = null;

		$("#bar-chart").on("plothover", function (event, pos, item) {
			if (item) {
				if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) 
				{
					previousPoint = item.dataIndex;
					previousLabel = item.series.label;
					$("#tooltip").remove();

					var x = item.datapoint[0];
					var y = item.datapoint[1];

					var color = item.series.color;

					//console.log(item.series.xaxis.ticks[x].label);               

					showTooltip(item.pageX,
					item.pageY,
					color,
						item.series.xaxis.ticks[x].label + " : <strong>" + y + "</strong>");
				}
			} 
			else 
			{
				$("#tooltip").remove();
				previousPoint = null;
				
			}
		});
	}

	function ajaxDashboard( page_id , min_date , max_date , session ) 
	{
		$.ajax({
			url:  "<?php echo(base_url());?>ajaxSessionDashboard",
			type: 'post', 
			data: { 
				'page_id': page_id, 
				'min_date': min_date,
				'max_date': max_date,
				'session' : session
			}, 
			dataType: 'json',
			async: true, 
			success:function(data)
			{
				console.log( data );
				createBarChart( data[1] );
				createRankBarChart( data[0] );
				createDetailBox( data[1] );
				$('#myModal').modal('hide');
			}
		});
	}

	function pageCallback( min_date , max_date ) 
	{
		var session = '<?=$session?>';
		var page_id = '208428464667';
		ajaxDashboard( page_id , min_date , max_date , session );
	}

	$(document).ready(function() 
	{
		construct_min_date = moment().subtract(1, 'weeks').startOf('isoWeek').format("YYYY-MM-DD HH:mm:ss");
		construct_max_date = moment().subtract(1, 'weeks').endOf('isoWeek').format("YYYY-MM-DD HH:mm:ss");

		$('#myModal').modal('show');

		$('#toggle-rank').change(function() {
			if ($(this).prop('checked') )
			{
				$('#engage-body').show();
				$('#click-body').hide();
			}
			else
			{
				$('#engage-body').hide();
				$('#click-body').show();
			}
		})
		
		pageCallback( construct_min_date , construct_max_date );
		
	});
</script>

</body>
</html>

