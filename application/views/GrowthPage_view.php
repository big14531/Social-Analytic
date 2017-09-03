<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>



<!-- Internal CSS Zone -->
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
	.form-group{
		margin-bottom: 0px;
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
	.select2-container--default .select2-selection--multiple .select2-selection__choice
	{
		color:#000;
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

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.min.css">

<!-- Content Zone -->
<div class="content-wrapper">

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			กราฟภาพรวม
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
						<button type="button" class="btn btn-md btn-default pull-left full-width" id="daterange-btn">
							<span>
								<i class="fa fa-calendar"></i> เลือกวันที่
							</span>
							<i class="fa fa-caret-down"></i>
						</button>
					</div>
				</div>
	
				<div class="col-md-4">
					<select id="page-selector" class="form-control select2 selector" multiple="multiple" data-placeholder="เลือกเพจ" style="width: 100%;">
					</select>
				</div>

				<div class="col-md-2">
					<div class="form-group">
						<button type="button" class="btn btn-md btn-info full-width" id="search-btn">
							<span>
								<i class="fa fa-calendar"></i> ค้นหา
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
						<h2 class="box-title">กราฟรวมทุกเพจ</h2>

						<div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="เลือกประเภทแสดงผล">
							<div class="btn-group" data-toggle="btn-toggle" id="graph-style">
								<button type="button" class="graph-style btn btn-default btn-sm active" value="day"> วัน </i></button>
								<button type="button" class="graph-style btn btn-default btn-sm" value="week"> สัปดาห์ </i></button>
								<button type="button" class="graph-style btn btn-default btn-sm" value="month"> เดือน </i></button>
							</div>
						</div>
						<!-- <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div> -->
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<div id="overview-chart" style="height: 700px;">
								</div>
							</div>			
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<?php

			/**
			 * PHP Create sub-graph from active page
			 * 
			 */
		
			$count=0;
			$total = count( $page_list );
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
				echo '</div>';
				echo '</div>';

				echo '<div class="box-body" id="box_'.$value->id.'">';
				echo '<div id="line-chart'.$value->id.'" style="height: 400px;"></div>';
				echo '</div>';

				echo '</div>';
				echo '</div>';

				if ($count%2==1 || $total==$count+1 ) {
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
<!-- Select2 -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.full.min.js"></script>

<script>

	var is_first =1;
	var dataset=[];
	var global_data=[];
	var time_type=[];
	/**
	 * [rgbToHex description]
	 *
	 * 		Convert RGB color format to hexcode color
	 * 
	 * @param  {[int]} r [ red color ]
	 * @param  {[int]} g [ green color ]
	 * @param  {[int]} b [blue color ]
	 * @return {[string]} [ #FFFFFF ]
	 */
	function rgbToHex(r, g, b) 
	{
		return "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
	}

	/**
	 * [getRandomColor description]
	 *
	 *		Random color of series line
	 *
	 * 		Choose color by length of each data
	 * 
	 * @param  {[type]} key    
	 * @param  {[type]} length 
	 * @return {[type]}	[#FFFFFF]
	 */
	function getRandomColor( key , length) 
	{
		var red = 200;
		var green = Math.floor(key*20%255);
		var blue = Math.floor(key+15%255);
		var color = rgbToHex( red , green , blue );

		return color;
	}


	/**
	 * [makeSeriesData description]
	 *
	 *		Get RAW data from ajax and extract data to array. For flotchart to readable
	 * 
	 * @param  {[object]} data		[ data from ajax ]
	 * @param  {String} data_type 	[ data type ]
	 * @return {[type]}	dataset		[array]
	 */
	function makeSeriesData( data , data_type="Posts" , time_type ="day" )
	{
		
		// Check data type and set key, for get result from Raw data by key
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

			if( time_type=="day" )
			{
				for( var value in post_data )
				{
					var time = post_data[value].created_time;
					var value = post_data[value][data_type];
					var data_point = [ time , value ];

					data_series.push( data_point );
				}
			}
			else if( time_type=="week" ){
				var sum_value=0;
				for( var value in post_data )
				{
					var time = post_data[value].created_time;
					var fine_time =  moment(time);
					var min_time =  moment(time).startOf('week');
					
					if( moment(fine_time).isAfter(min_time) ){
						inner_value = parseInt( post_data[value][data_type] );
						sum_value += inner_value;
						
					}
					else{
						var data_point = [ min_time.unix()*1000 , sum_value ];
						data_series.push( data_point );
						sum_value=0;
					}
				}
			}
			else if( time_type=="month" ){
				var sum_value=0;
				for( var value in post_data )
				{
					var time = post_data[value].created_time;
					var fine_time =  moment(time);
					var min_time =  moment(time).startOf('month');
					
					if( moment(fine_time).isAfter(min_time) ){
						inner_value = parseInt( post_data[value][data_type] );
						sum_value += inner_value;
						
					}
					else{
						var data_point = [ min_time.unix()*1000 , sum_value ];
						data_series.push( data_point );
						sum_value=0;
					}
				}
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

	/**
	 * [createCheckBox description]
	 *
	 *		Create Check box
	 * 
	 * @param  {[type]} data   
	 * @param  {[type]} dataset
	 * @return {[type]}        
	 */
	function createCheckBox( data, dataset ) 
	{ 
		// var choiceContainer = $("#legend-container");
		var page_selector = $("#page-selector");


		$.each(data, function(key, val) {
			page_selector.append("<option>"+val.page_name + "</option>");
		});
	}

	/**
	 * [ajaxCall description]
	 *
	 *		Ajax call data from controller
	 * 
	 * @param  {[type]} min_date 
	 * @param  {[type]} max_date 
	 * @param  {[type]} type     
	 */
	function ajaxCall( min_date , max_date ,type )
	{
		$('#search-btn').find('span').text('กำลังค้นหา.....');
		$('#search-btn').addClass('disabled');
		$('#search-btn').prop('disabled',true); 
		$('#myModal').modal('show');
		$.ajax({
			url:  "<?php echo base_url()?>/ajaxGrowthPage",   //the url where you want to fetch the data 
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
				$('#search-btn').find('span').html('<i class="fa fa-calendar"></i> ค้นหา');
				time_type = $( "#graph-style" ).find( ".active" ).attr("value");
				global_data = data;
				dataset = makeSeriesData( data , type , time_type  );
				if(is_first) createCheckBox( data , dataset );
				plotOverviewGraph( dataset );
				plotSubGraph( dataset );
				plotGraphbySelector()
				is_first=0;
			},
		}); 
	}

	/**
	 * [plotGraphbyCheckbox description]
	 *
	 *		Redraw graph by checkbox
	 * 
	 */
	function plotGraphbySelector() 
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


		var selected_page = $('#page-selector').val();

		for( var key in dataset )
		{
			var series = dataset[key];
			if( selected_page.includes( series.label ) )
			{
				new_dataset.push( series ); 
			}
		}

		var time_tick = getTimeTypeforGraph( time_type );
		console.log( time_tick );
		plotOverviewGraph( new_dataset , time_tick);		
	}


	/**
	 * [plotGraphbyOption description]
	 *
	 *		Redraw graph by option
	 * 
	 */
	function plotGraphbyOption() 
	{
		var time_tick =[];
		time_type = $( "#graph-style" ).find( ".active" ).attr("value");

		var time_tick = getTimeTypeforGraph( time_type );
		let data_type = $('#datatype-btn').val();
		let dataset = makeSeriesData( global_data , data_type , time_type );
		plotOverviewGraph( dataset , time_tick );

		
	}
  
	/**
		Helper function ti return time array for graph
	*/
	function getTimeTypeforGraph( time_type ){
		if (time_type ==="day") {
			return [ 1,"day" ];
		}
		else if(time_type ==="week"){
			return [ 6,"day" ];
		}
		else if(time_type ==="month"){
			return [ 1,"month" ];
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

					var weekday = new Array(7);
					weekday[0] = "Sun";
					weekday[1] = "Mon";
					weekday[2] = "Tue";
					weekday[3] = "Wed";
					weekday[4] = "Thu";
					weekday[5] = "Fri";
					weekday[6] = "Sat";

					var day_name = weekday[date.getDay()];

					var date = day_name+" "+formattedDate;
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
	function plotOverviewGraph( dataset , time_type=[ 1 , "day"] )
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
	 			radius: 3,
	 			symbol: "circle"
	 		},
	 		series: {            
	 			lines: {
	 				show: true,
	 				lineWidth: 5,
	 				hoverable: true,
	 			}
	 		},
	 		xaxis:
	 		{
	 			show: true,
	 			mode: "time",
	 			timeformat: "<b>%a</b> <br> %d-%b ",
	 			timezone: "browser",
	 			minTickSize: time_type,
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

	

	 	var chart = $.plot("#overview-chart",dataset,option);

	 	

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

					var weekday = new Array(7);
					weekday[0] = "Sun";
					weekday[1] = "Mon";
					weekday[2] = "Tue";
					weekday[3] = "Wed";
					weekday[4] = "Thu";
					weekday[5] = "Fri";
					weekday[6] = "Sat";

					var day_name = weekday[date.getDay()];

					var date = day_name+" "+formattedDate;
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
	 		'7 วันที่ผ่านมา': [moment().subtract(6, 'days'), moment()],
	 		'30 วันที่ผ่านมา': [moment().subtract(29, 'days'), moment()],
	 		'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
	 		'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	 	},
	 	startDate: moment().subtract(29, 'days'), 
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
  
	/**
	* [description]
	* 
	* 	Call Ajax first time when open window
	* 
	*/
	$(document).ready(function() 
	{

		$(".select2").select2();
		$('#page-selector').change(function(){
			plotGraphbySelector();
		});
		var type = $('#datatype-btn').val();
		var min_date = moment().format('YYYY-MM-DD 23:59:59') ;
		var max_date = moment().subtract(6, 'days').format('YYYY-MM-DD 00:00:00');
		ajaxCall( max_date , min_date , type );
		$("#alert").fadeTo(2000, 500).slideUp(500, function()
		{
			$("#alert").slideUp(500);
		});

		$(".graph-style").click( function(){ plotGraphbyOption('test'); } );
	});

	/**
	* [description]
	*
	*	Set callback for Checkbox
	* 
	*/
	// $(function() 
	// {
	// 	$( "#legend-container" ).delegate( "input", "click", function() {
	// 		plotGraphbyCheckbox();
	// 	});

	// });
</script>

</body>
</html>