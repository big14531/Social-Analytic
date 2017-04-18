<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>



<style>
	.overview-box{
        background-color: #666666!important;
        border-top : 0px!important;
        color: #b8c7ce!important;
	}
	.full-width{
		width:100%;
	}
	.control-box{
		padding-top: 10px;
		padding-left: 10px;
		padding-right: 10px;
	}
	.color-icon{
		width:30px;
		height:30px;
		float: left;
		margin-right: 5px;
	}
	.legend-box{
		margin-bottom: 5px;
	}
	.modal-dialog{
		padding-top: 15%!important;
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

<!-- Content Here -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Page Dashboard
		</h1>
	</section>

	<section class="content"> 
	<div id='alert' class="alert alert-warning alert-dismissible hidden">
			<h3>Success!!</h3>
			<p>This is a green alert.</p>
		</div>  
		<div class="box gray-box control-box">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<select class="selectpicker form-control" id="datatype-btn">
							<option selected="selected">Posts</option>
							<option >Engagement</option>
							<option >Share</option>
							<option >Comments</option>
							<option >Reaction</option>
							<option >Like</option>
							<option >Love</option>
							<option >Wow</option>
							<option >Smile</option>
							<option >Sad</option>
							<option >Angry</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="input-group full-width">
						<button type="button" class="btn btn-lg btn-default pull-left full-width" id="daterange-btn">
							<span>
								<i class="fa fa-calendar"></i> Date range
							</span>
							<i class="fa fa-caret-down"></i>
						</button>
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<button type="button" class="btn btn-lg btn-info full-width" id="search-btn">
							<span>
								<i class="fa fa-calendar"></i> Search
							</span>
						</button>
					</div>
				</div>
			</div>
		</div>



		<div class="row">
			<div class="col-md-12">
				<div class="box overview-box">
					<div class="box-header with-border">
						<h2 class="box-title">Overview Graph</h2>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-10">
								<div id="overview-chart" style="height: 700px;">
								</div>
							</div>
							<div class="col-md-2">
								<div id="overview" style="height: 300px;">
								</div>
								<div id="legend-container"></div>
							</div>							
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		$count=0;
		foreach( $page_list as $value )
		{   
			if ($count%2==0) {
				echo '<div class="row">';
			}

			echo '<div class="col-md-6">';
			echo '<div class="box gray-box">';

			echo '<div class="box-header with-border">';
			echo '<h2 class="box-title" id="page_name_'.$value->id.'"></h2>';
			echo '<div class="box-tools pull-right">';
			echo '</button>';
			echo '</div>';
			echo '</div>';

			echo '<div class="box-body" id="box_'.$value->id.'">';
			echo '<div id="line-chart'.$value->id.'" style="height: 400px;"></div>';
			echo '</div>';

			echo '</div>';
			echo '</div>';

			if ($count%2==1) {
				echo '</div>';
			}
			$count+=1;
		}
		?>
	</section>
</div>

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



<?php $this->load->view( 'default/bottom' ) ?>

<script>
	var is_first =1;
	var dataset=[];

	function rgbToHex(r, g, b) 
	{
		return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
	}

	function getRandomColor( key , length) 
	{

		var red = 200;
		var green = Math.floor(key*20%255);
		var blue = Math.floor(key+15%255);
		var color = rgbToHex( red , green , blue );
		return color;
	}

	function makeSeriesData( data , data_type="Posts" )
	{
		switch( data_type ){

			case "Posts":
			var data_type="post_count"
			break;

			case "Engagement":
			var data_type="total"
			break;

			case "Share":
			var data_type="shares"
			break;

			case "Comments":
			var data_type="comments"
			break;

			case "Reaction":
			var data_type="reaction"
			break;

			case "Like":
			var data_type="likes"
			break;

			case "Love":
			var data_type="love"
			break;

			case "Wow":
			var data_type="wow"
			break;

			case "Smile":
			var data_type="haha"
			break;

			case "Sad":
			var data_type="sad"
			break;

			case "Angry":
			var data_type="angry"
			break;
		}

		var dataset=[];
		for ( var key in data) 
		{
			var graphID = data[key]['id'];
			var data_series=[];
			var profile_graph =[];
			var page_name = data[key].page_name;
			var post_data = data[key]['post_data'] 

			for( var value in post_data )
			{
				var time = post_data[value].created_time;
				var value = post_data[value][data_type];
				var data_point = [ time , value ];

				data_series.push( data_point );
			}

			profile_graph.push( graphID );
			profile_graph.push( page_name );

			var series = 
			{
				data: data_series,
				label: page_name,  
				extraData: profile_graph ,
				color: getRandomColor( key , data.length)
			};
			dataset.push( series );
		}


		return dataset;
	} 

	function createCheckBox( data, dataset ) 
	{ 
		var choiceContainer = $("#legend-container");

		$.each(data, function(key, val) {
			choiceContainer.append("<div class='row legend-box'><input type='checkbox' name='" + val.page_name +
				"' checked='checked' id='id" + key + "'></input>" +
				" <div class='color-icon' style='background-color:"+dataset[key].color+"'></div> "+
				"<label for='id" + key + "'>"
				+ val.page_name + "</label></div>");
		});

	}

	function ajaxCall( min_date , max_date ,type )
	{
		$('#search-btn').find('span').text('Searching.....');
		$('#search-btn').addClass('disabled');
		$('#search-btn').prop('disabled',true); 
		$('#myModal').modal('show');
		$.ajax({
			url:  "<?php echo base_url()?>/getGrowthPage",   //the url where you want to fetch the data 
			type: 'post', //type of request POST or GET    
			data: {  
				'min_date': min_date,
				'max_date': max_date,
				'type':type 
			}, 
			dataType: 'json',
			success:function(data)
			{
				$('#myModal').modal('hide');
				$('.col-md-6').attr('hidden',false);
				$('#search-btn').prop('disabled',false);
				$('#search-btn').removeClass('disabled');
				$('#search-btn').find('span').html('<i class="fa fa-calendar"></i> Search');

				dataset = makeSeriesData( data , type  );
				if(is_first) createCheckBox( data , dataset );
				
				plotOverviewGraph( dataset );
				plotSubGraph( dataset );
				is_first=0;
			},
		}); 
	}


	function plotGraphbyCheckbox() 
	{
		var data = [];
		var new_dataset =[];
		var type = $('#datatype-btn').val();
		var date_range = $('#daterange-btn').val();
		var date = date_range.split(' to ');

		if( !date_range )
		{
			var min_date = moment().format('YYYY-MM-DD 23:59:59') ;
			var max_date = moment().subtract(6, 'days').format('YYYY-MM-DD 00:00:00');
		}
		else
		{
			var min_date = date[1];
			var max_date = date[0];
		}


		$("#legend-container").find("input:checked").each(function () 
		{
			var name = $(this).attr("name");
			data.push( name );
		});

		for( var key in dataset )
		{
			var series = dataset[key];
			if( data.includes( series.label ) )
			{
				new_dataset.push( series ); 
			}
		}
		plotOverviewGraph( new_dataset );		
	}

	/**
	 * [plotGraph description]
	 * Plot graph function
	 *
	 *  Line graph
	 *
	 *  have 2 line , fan_count and posts
	 * 
	 * @param  {[json]} input [ data from ajax ]
	 * @return {[none]}       [plot graph]
	 */
	 function plotSubGraph( dataset )
	 {
	 	var option =
	 	{   
	 		legend:
	 		{
	 			show:false
	 		},
	 		grid: 
	 		{ 
	 			hoverable: true,
	 			borderColor: "#555555",
	 			borderWidth: 1,
	 			tickColor: "#555555",
	 			margin: 10
	 		}, 
	 		points: 
	 		{
	 			hoverable: true,
	 			show: true,
	 			radius: 5,
	 			symbol: "circle"
	 		},
	 		series: {            
	 			lines: {
	 				show: true,
	 				fill: true,
	 				hoverable: true,
	 			}
	 		},
	 		xaxis:
	 		{
	 			show: true,
	 			mode: "time",
	 			timeformat: "<b>%a</b> <br> %d-%b ",
	 			timezone: "browser",
	 			minTickSize: [1, "day"]
	 		},
	 		yaxis: 
	 		{
	 			show: true,
	 			tickFormatter: function(x) 
	 			{
	 				return x.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
	 			}
	 		},  
	 	};  

	 	for ( var key in dataset ) 
	 	{
	 		var series = dataset[key];
	 		var profile = series.extraData;
	 		var graph_id = profile['0'];
	 		var page_name = profile['1'];

	 		$("#page_name_"+graph_id ).text( page_name );
	 		$.plot($("#line-chart"+graph_id ),[series],option);


	 		$('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
	 			position: "absolute",
	 			display: "none",
	 			opacity: 0.8
	 		}).appendTo("body");


	 		$("#line-chart"+graph_id).bind("plothover", function (event, pos, item) {

	 			if (item) {
	 				var date = new Date(item.datapoint[0]);

					// Seconds part from the timestamp
					var year = "0" + date.getFullYear();
					// Seconds part from the timestamp
					var month = "0" + date.getMonth();
					// Seconds part from the timestamp
					var day = "0" + date.getDate();
					// Will display date in DD/MM/YYYY format
					var formattedDate = day.substr(1) + '-' + month + '-' + year.substr(1);


					var date = "Date : "+formattedDate;
					y = item.datapoint[1].toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");

					$("#line-chart-tooltip").html(  date + "<br> " + " value : " + y)
					.css({top: item.pageY - 90, left: item.pageX - 100})
					.fadeIn(200);
				} else {
					$("#line-chart-tooltip").hide();
				}
			});
	 	}
	 }

	/**
	 * [plotGraph description]
	 * Plot graph function
	 *
	 *  Line graph
	 *
	 *  have 2 line , fan_count and posts
	 * 
	 * @param  {[json]} input [ data from ajax ]
	 * @return {[none]}       [plot graph]
	 */
	 function plotOverviewGraph( dataset )
	 {
	 	var option =
	 	{   
	 		legend:
	 		{
	 			show: false,
	 			backgroundOpacity: 0,
	 		},
	 		grid: 
	 		{ 
	 			hoverable: true,
	 			borderColor: "#555555",
	 			borderWidth: 1,
	 			tickColor: "#555555",
	 			margin: 10
	 		}, 
	 		points: 
	 		{
	 			hoverable: true,
	 			show: true,
	 			radius: 5,
	 			symbol: "circle"
	 		},
	 		series: {            
	 			lines: {
	 				show: true,
					// fill: true,
					hoverable: true,
				}
			},
			xaxis:
			{
				show: true,
				mode: "time",
				timeformat: "<b>%a</b> <br> %d-%b ",
				timezone: "browser",
				minTickSize: [1, "day"],
				autoscaleMargin: 0.002
			},
			yaxis: 
			{
				show: true,
				tickFormatter: function(x) 
				{
					return x.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
				}
			},
			selection: {
				mode: "xy"
			}
		};  

		var preview_option =
		{   
			legend:
			{
				show: false
			},
			points: 
			{
				show: true
			},
			series: {            
				lines: {
					show: true,
				}
			},
			xaxis:
			{
				show: false
			},
			yaxis: 
			{
				show: false
			},  
			selection: {
				mode: "xy"
			}
		};  

		var chart = $.plot("#overview-chart",dataset,option);
		var overview = $.plot("#overview",dataset,preview_option);

		$("#overview").bind("plotselected", function (event, ranges) 
		{
			if (ranges.xaxis.to - ranges.xaxis.from < 0.00001) {ranges.xaxis.to = ranges.xaxis.from + 0.00001;}
			if (ranges.yaxis.to - ranges.yaxis.from < 0.00001) {ranges.yaxis.to = ranges.yaxis.from + 0.00001;}
			plot = $.plot("#overview-chart", dataset,
				$.extend(true, {}, option, {
					xaxis: { min: ranges.xaxis.from, max: ranges.xaxis.to },
					yaxis: { min: ranges.yaxis.from, max: ranges.yaxis.to }
				})
				);
			overview.setSelection(ranges, true);
		});

		$("#overview-chart").bind("plotselected", function (event, ranges) 
		{
			if (ranges.xaxis.to - ranges.xaxis.from < 0.00001) {ranges.xaxis.to = ranges.xaxis.from + 0.00001;}
			if (ranges.yaxis.to - ranges.yaxis.from < 0.00001) {ranges.yaxis.to = ranges.yaxis.from + 0.00001;}
			plot = $.plot("#overview-chart", dataset,
				$.extend(true, {}, option, {
					xaxis: { min: ranges.xaxis.from, max: ranges.xaxis.to },
					yaxis: { min: ranges.yaxis.from, max: ranges.yaxis.to }
				})
				);
			overview.setSelection(ranges, true);
		});

		$('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
			position: "absolute",
			display: "none",
			opacity: 0.8
		}).appendTo("body");

		$("#overview-chart").bind("plothover", function (event, pos, item) 
		{
			if (item) 
			{
				var page_name = item.series.label;
				var date = new Date(item.datapoint[0]);
					// Seconds part from the timestamp
					var year = "0" + date.getFullYear();
					// Seconds part from the timestamp
					var month = "0" + date.getMonth();
					// Seconds part from the timestamp
					var day = "0" + date.getDate();
					// Will display date in DD/MM/YYYY format
					var formattedDate = day.substr(1) + '-' + month + '-' + year.substr(1);

					var date = "Date : "+formattedDate;
					y = item.datapoint[1].toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");

					$("#line-chart-tooltip").html( "<b>"+page_name+"</b>"+"<br>"+date + "<br> " + " value : " + y)
					.css({top: item.pageY - 90, left: item.pageX - 100})
					.fadeIn(200);
				} else {
					$("#line-chart-tooltip").hide();
				}
			});
		
	}

	$('#daterange-btn').daterangepicker(
	{
		ranges: {
			'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			'This Month': [moment().startOf('month'), moment().endOf('month')],
			'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		startDate: moment().subtract(6, 'days'),
		endDate: moment()
	},
	function (start, end) 
	{
		$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		$('#daterange-btn').val(start.format('YYYY-MM-DD 00:00:00') + ' to ' + end.format('YYYY-MM-DD 23:59:59'));
	}
	);


	$('#search-btn').click(function()
	{
		var type = $('#datatype-btn').val();
		var date_range = $('#daterange-btn').val();
		var date = date_range.split(' to ');
		if ( Boolean(date_range) ) 
		{
			ajaxCall( date[0] , date[1] , type );
		}
		else
		{
			$('#alert').removeClass( 'hidden');
			$('#alert').removeClass( 'alert-success');
			$('#alert').removeClass( 'alert-warning');
			$('#alert').addClass( 'alert-warning');
			$('#alert').find('h3').text( "ข้อมูลไม่ครบ!!" );
			$('#alert').find('p').text( 'กรุณาเลือกวันที่ต้องการค้นหา' );
		}
		$("#alert").fadeTo(2000, 500).slideUp(500, function()
		{
			$("#alert").slideUp(500);
		});
	});

	// First time 
	//
	
	$(document).ready(function() 
	{
		var type = $('#datatype-btn').val();
		var min_date = moment().format('YYYY-MM-DD 23:59:59') ;
		var max_date = moment().subtract(6, 'days').format('YYYY-MM-DD 00:00:00');
		ajaxCall( max_date , min_date , type );
		$("#alert").fadeTo(2000, 500).slideUp(500, function()
		{
			$("#alert").slideUp(500);
		});
	});

	$(function() 
	{
		$( "#legend-container" ).delegate( "input", "click", function() {
			plotGraphbyCheckbox();
		});

	});
</script>