<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<style>
	.small-icon{
		width:20px;
		margin-left: 10px;
		color: #4b7998;
	}
	.legent-font{
		color: white;
		padding-left: 10px;
		padding-top: 5px;
	}
	.control-box{
		padding-bottom: 0px!important;
	}
	.full-width{
		width:100%;
	}
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
		
	}
	.page-logo{
		max-height: 200px;
	}
	
</style>
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.min.css">

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			รายละเอียดของเพจ 
		</h1>
	</section>

	<section class="content">
		<div id='alert' class="alert alert-dismissible hidden">
			<h3>Success!!</h3> 
			<p>This is a green alert.</p>
		</div>

		<div class="box gray-box">
			<div class="box-body control-box">
				<div class="row">
					<div class="col-md-5">
						<select id="page-selector" class="form-control" data-placeholder="Select a Page" style="width: 100%;">
						</select>
					</div>
					<div class="col-md-5">
						<div class="input-group full-width">
							<button type="button" class="btn btn-md btn-default pull-left full-width" id="daterange-btn">
								<span>
									<i class="fa fa-calendar"></i> เลือกวันที่
								</span>
								<i class="fa fa-caret-down"></i>
							</button>
						</div>
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
		</div>

		<div class="row">
			<div class="col-md-4 col-xs-12" style="text-align: center;">
				<img id="page-icon" class="page-logo" src="">
			</div>
			<div class="col-md-8 col-xs-12">
				<div class="box white-box">
					<h1 class="page-name" id="page-name"></h1>
					<h3 class="page-name" id="time-range"></h3>
					<p class="text-detail" id="page-about"></p>
					<p class="text-detail" id="page-category"></p>
				</div>	
			</div>
		</div>

		<div class="row info-row">
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="info-box">
					<span class="info-box-icon bg-facebook"><i class="ion ion-person-stalker icon"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">จำนวนแฟนเพจ</span>
						<span class="info-box-number" id="fanpage-box"></span>
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
						<span class="info-box-text">จำนวน Engagement รวม</span>
						<span class="info-box-number" id="engage-box"></span>
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
						<span class="info-box-text">จำนวนโพสต์</span>
						<span class="info-box-number" id="post-box"></span>
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
						<span class="info-box-text">แฟนเพจใหม่</span>
						<span class="info-box-number" id="new-fanpage-box"></span>
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
						<h2 class="box-title">ประเภทของโพสต์</h2>
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
						<h2 class="box-title">จำนวนโพสเฉลี่ย</h2>
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
						<h2 class="box-title">โพสต์ดีที่สุด</h2>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body" >
						<ul class="products-list product-list-in-box" id="best-box">	
						</ul>
					</div>
					<!-- /.box-body-->
				</div>
			</div>

			<div class="col-sm-6 col-xs-12">
				<!-- Donut chart -->
				<div class="box gray-box">
					<div class="box-header">
						<h2 class="box-title">โพสต์แย่ที่สุด</h2>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="box-body">
						<ul class="products-list product-list-in-box" id="worst-box">
						</ul>
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

<script>

	function createSelector( data ) 	
	{
		// Create Card in Row
		var selector = $("#page-selector");

		for (var i = 0; i < data.length; i++) 
		{
			var page_data = data[i];
			var page_name = page_data.name;
			var page_id = page_data.page_id;
			selector.append('<option id="'+page_id+'">'+page_name+'</option>');
		}
	}

	function addContent( box , data ) 
	{
		for( var key in data )
		{
			var value = data[key];
			value.type
			if ( value.type=='video' ) 
			{
				var btn = 'success';
			}
			else if( value.type=='link' )
			{
				var btn = 'warning';
			}
			else if( value.type=='photo' )
			{
				var btn = 'danger';
			}
			var html = 	'<li class="item">'
			+'<div class="product-img">'
			+'<a href="'+value.permalink_url+'" target="_blank" class="product-title">'
			+'<img src="'+value.picture+'" alt="Product Image">'
			+'</a>'
			+'</div>'
			+'<div class="product-info">'
			+value.name
			+'<span class="label label-'+btn+' pull-right">'+value.type+'</span>'
			+'<span class="product-description" style="color:white;">'
			+value.description
			+'</span>'
			+'<span class="product-description" style="color:white;">'
			+"<img class='small-icon' src='<?php echo(base_url());?>assets/images/like.png'>: "
			+parseInt(value.engage).toLocaleString('en-US')
			+"<i class='fa fa-comment small-icon'></i>: "
			+parseInt(value.comments).toLocaleString('en-US')
			+"<i class='fa fa-share small-icon'></i>: "
			+parseInt(value.shares).toLocaleString('en-US')

			+'</span>'
			+'</div>'
			+'</li>';

			box.append( html );
		}
	}

	function editBestandWorstBox( data ) 
	{
		var best_box = $("#best-box");
		var worst_box = $("#worst-box");
		best_box.empty();
		worst_box.empty();
		addContent( best_box , data[0] );
		addContent( worst_box , data[1] );		
	}

	function ajaxDashboardRankPost( page_id , min_date , max_date )
	{
		$.ajax({
			url:  "<?php echo(base_url());?>ajaxDashboardRankPost",   //the url where you want to fetch the data 
			type: 'post', //type of request POST or GET   
			data: { 
				'page_id': page_id,
				'min_date': min_date, 
				'max_date': max_date
			},
			dataType: 'json',
			async: true, 
			success:function(data)
			{
				editBestandWorstBox( data );
			}   
		});
	}

	function ajaxCreatePageCard()
	{		
		$.ajax({
			url:  "<?php echo(base_url());?>facebook/ajaxGetActivePage",   //the url where you want to fetch the data 
			type: 'post', //type of request POST or GET   
			dataType: 'json',
			async: false, 
			success:function(data)
			{
				createSelector(data);	
				
			}
		});
	}

	function ajaxDashboard( page_id , min_date , max_date )
	{		
		$.ajax({
			url:  "<?php echo(base_url());?>ajaxDashboard",   //the url where you want to fetch the data 
			type: 'post', //type of request POST or GET   
			data: { 
				'page_id': page_id, 
				'min_date': min_date,
				'max_date': max_date 
			}, 
			dataType: 'json',
			async: true, 
			success:function(data)
			{
				console.log( data );
				createBarChart( data[0] );
				createPieChart( data[0] );
				createDetailBox( data )
				$('#myModal').modal('hide');
			}
		});
	}

	function createDetailBox( data ) 
	{
		var page_detail = data[1];

		if ( page_detail.is_verified)
		{
			var name = page_detail.name+' <i class="ion ion-checkmark-circled verify-icon" id="verify-icon"></i>';
		}
		else
		{
			var name = page_detail.name;
		}

		var picture = page_detail.picture.data.url;
		var about = "About : "+page_detail.about;category
		var category = "Category : "+page_detail.category;
		var fanpage = page_detail.fan_count;
		var engage = page_detail.talking_about_count;


		var post = sumPost( data[0] );
		var new_fanpage = page_detail.new_fanpage;

		$("#page-icon").attr( 'src' , picture );
		$("#page-name").html( name );
		$("#page-about").html( about );
		$("#page-category").html( category );
		$("#fanpage-box").html( parseInt(fanpage).toLocaleString('en-US') );
		$("#engage-box").html( parseInt(engage).toLocaleString('en-US') );
		$("#post-box").html( parseInt(post).toLocaleString('en-US') );
		$("#new-fanpage-box").html( parseInt(new_fanpage).toLocaleString('en-US') );
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

		console.log(day_of_week);
		console.log(value_array);
		
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
				borderWidth: 1,
				borderColor: "#444444",
				tickColor: "#444444"
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
			}
		});

	}

	function createPieChart( data ) 
	{
		var sum_link = 0;
		var sum_video = 0;
		var sum_photo = 0;
		for( var key in data )
		{
			var row = data[key]
			sum_link += parseInt( row.link );
			sum_video += parseInt(  row.video );
			sum_photo += parseInt(  row.photo );
		}
		var donutData = [
		{label: "Link", data: sum_link, color: "#3c8dbc"},
		{label: "Video", data: sum_video, color: "#ff0e4e"},
		{label: "Photo", data: sum_photo, color: "#509e2f"}
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
				show: true,
				labelFormatter: legendFormatter,
				backgroundOpacity: 0
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

	function sumPost( data ) 
	{
		var value = 0;
		for( var key in data )
		{
			var row = data[key];
			value += parseInt(row.post_count);
		}
		return value;
	}

	function searchBtnCallback( min_date=0 , max_date=0 ) 
	{
		$('#myModal').modal('show');
		var page_id = $('#page-selector').find(':selected').attr('id');

		var date_range = $('#daterange-btn').val();
		if ( date_range.length!=0 ) 
		{
			var date = date_range.split(' to ');
			min_date = date[0];
			max_date = date[1];
		}
		

		if ( Boolean(page_id) && Boolean(min_date)  && Boolean(max_date) ) 
		{
			text_min = min_date.substr(0,10);
			text_max = max_date.substr(0,10);

			min_date = min_date;
			max_date = max_date;

			ajaxDashboard( page_id , min_date , max_date );
			ajaxDashboardRankPost(  page_id , min_date , max_date );
			$("#time-range").html( 'ข้อมูลระหว่างวันที่ '+text_min+' ถึง '+text_max );
		}
		else
		{
			$('#alert').removeClass( 'alert-info');
			$('#alert').removeClass( 'hidden');
			$('#alert').removeClass( 'alert-success');
			$('#alert').removeClass( 'alert-warning');
			$('#alert').addClass( 'alert-warning');
			$('#alert').find('h3').text( "Please and page name" );
			$('#alert').find('p').text( '' );
		}
		$("#alert").fadeTo(2000, 500).slideUp(500, function()
		{
			$("#alert").slideUp(500);
		});
	}

	function createDatePicker() 
	{
		$('#daterange-btn').daterangepicker
		(
		{
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(7, 'days'), moment().subtract(1, 'days')],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			},
			startDate: moment().subtract(29, 'days'),
			endDate: moment()
		},
		function (start, end) {
			$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			$('#daterange-btn').val(start.format('YYYY-MM-DD 00:00:00') + ' to ' + end.format('YYYY-MM-DD 23:59:59'));
		}
		);
	}

	$(document).ready(function() 
	{

		construct_min_date = moment().subtract(1, 'weeks').startOf('isoWeek').format("YYYY-MM-DD HH:mm:ss");
		construct_max_date = moment().subtract(1, 'weeks').endOf('isoWeek').format("YYYY-MM-DD HH:mm:ss");

		$('#myModal').modal('show');
		createDatePicker();
		updateFloatWidget();
		ajaxCreatePageCard();
		searchBtnCallback( construct_min_date , construct_max_date );



		$('#search-btn').click(function()
		{
			searchBtnCallback();
		});
	});

	function legendFormatter(label , series) 
	{
		return "<div class='legent-font'>"+label+" "+Math.round(series.percent)+"%</div>";
	}

	function labelFormatter(label, series) 
	{
		return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
		+ label
		+ "</div>";
	}
</script>

</body>
</html>

