<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<style>
	.avg-table{
		width: 100%;
	}
	.avg-table>tbody>tr>td {
		padding: 10px;
	}
	.avg-box
	{
		background-color: #FFF;
		border-radius: 4px;
		color: #000;
		text-align:center;
		padding-bottom:10px
	}
	.avg-engage{
		background-color: #00a65a;
	}
	.avg-click{
		background-color: #ec971f;
	}
	.session-name {
		border-color: #1ab394;
		color: #FFFFFF;
		border-top-left-radius: 4px;
		border-top-right-radius: 4px;
		margin-right: 5px;
		width: 100%;
		overflow: hidden;
		text-overflow: ellipsis;
		padding:10px;
		text-align: center;
		margin-bottom:10px;
	}
	.info-hover{
		color: #00c0ef ;
	}
	#btn_session{
		margin-top:10px
	}
	.select2-container {
		width: 100%!important;
	}
	.btn{
		color:#FFF!important;
	}
	#tooltip {
		 z-index: 9999; 
	}
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
		height: 250px;
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
	.page-logo{
		margin-bottom: 10px;
		max-height: 170px;
	}
	.tooltiptext {
		max-width:400px;
		visibility: hidden;
		background-color: #fff;
		color: black;
		line-height: 20px;;
		border-radius: 3px;
		padding: 10px;
		position: absolute;
		z-index: 999;
		font-size:13px;
	}
</style>
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.min.css">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			ข้อมูล Insight คมชัดลึก
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-md-3 col-xs-12" style="text-align: center;">
				<div class="row">
					<img id="page-icon" class="page-logo" src="">
					<div class="selector-box">
						<select class="js-example-basic-single" id="session-selector"></select>
					</div>
					<button type="button" class="btn btn-primary btn-sm" id="btn_session">ไปที่ Session แดชบอร์ด</button>	
				</div>
			</div>
			<div class="col-md-9 col-xs-12">
				<div class="box white-box">
					<h1 class="page-name" id="page-name"></h1>
					<h3 class="page-name" id="time-range"></h3>
					<p class="text-detail" id="page-about"></p>
					<p class="text-detail" id="page-category"></p>
				</div>	
			</div>
		</div>

		<div class="row info-row">
			<div class="col-md-4 col-sm-6 col-xs-6">
				<div class="info-box">
					<span class="info-box-icon bg-facebook"><i class="ion ion-person-stalker icon"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">จำนวนแฟนเพจ</span>
						<span class="info-box-number" id="fanpage-box"></span>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-sm-6 col-xs-6">
				<div class="info-box">
					<span class="info-box-icon bg-facebook"><i class="ion ion-speedometer icon"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">จำนวน Engagement รวม</span>
						<span class="info-box-number" id="engage-box"></span>
					</div>
				</div>
			</div>

			<div class="clearfix visible-sm-block"></div>

			<div class="col-md-4 col-sm-6 col-xs-6">
				<div class="info-box">
					<span class="info-box-icon bg-facebook"><i class="ion ion-chatbubbles icon"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">จำนวนโพสต์</span>
						<span class="info-box-number" id="post-box"></span>
					</div>
				</div>
			</div>
			
		</div>

		<div class="row chart-row">
			<div class="col-sm-12">
				<div class="box gray-box">
					<div class="box-header">
						<h2 class="box-title" id="engage-click-title"> Engagement รวม แบ่งตามประเภทข่าว</h2>
						<i class="info-hover fa fa-info-circle" aria-hidden="true">
							<span class="tooltiptext"><i class="fa fa-info-circle"></i> กราฟแสดงการกดไลค์และคลิกของโพสต์ แยกตามประเภทของข่าว</span>
						</i>
						<div class="box-tools pull-right">
							<input id="toggle-bar-engage" type="checkbox" data-size="small" checked data-toggle="toggle" data-on="Engage" data-off="Click" data-onstyle="success" data-offstyle="warning">
						</div>
					</div>
					<div class="box-body" id="engage-box-body">
						<div id="engage-bar-chart" style="width: 100%;height: 300px;"></div>
					</div>
					<div class="box-body" id="click-box-body" >
						<div id="click-bar-chart" style="width: 100%;height: 300px;" ></div>
					</div>
				</div>
			</div>

			<div class="col-sm-12">
				<div class="box gray-box">
					<div class="box-header">
						<h2 class="box-title">จำนวนข่าวแยกตามประเภท</h2>
						
						<i class="info-hover fa fa-info-circle" aria-hidden="true">
							<span class="tooltiptext"><i class="fa fa-info-circle"></i> กราฟแสดงจำนวนของข่าว แยกตามประเภทของข่าว สามารถเลือกดดูเฉพาะข่าวในกลุ่มคะแนนเดียวกันได้ โดยเลือกจากปุ่มทางมุมบนขวาของกราฟ</span>
						</i>

						<div class="box-tools pull-right">
							<select class="js-example-basic-single"  id="rank-selector">
							</select>
						</div>
					</div>
					<div class="box-body">
						<div id="session-bar-chart" style="height: 300px;"></div>
					</div>
				</div>
			</div>

			<div class="col-sm-12">
				<div class="box gray-box">
					<div class="box-header">
						<h2 class="box-title" id="avg-title">ค่าเฉลี่ย Engagement ของข่าวหนึ่งต่อโพส</h2>
						
						<i class="info-hover fa fa-info-circle" aria-hidden="true">
							<span class="tooltiptext"><i class="fa fa-info-circle"></i> ตารางแสดงค่ากดไลค์/คลิก เฉลี่ยของแต่ละประเภทข่าว โดยจะเป็นค่าเฉลี่ยนต่อ 1 โพส</span>
						</i>

						<div class="box-tools pull-right">
							<input id="toggle-bar-avg" type="checkbox" data-size="small" checked data-toggle="toggle" data-on="Engage" data-off="Click" data-onstyle="success" data-offstyle="warning">
						</div>
					</div>
					<div class="box-body" id="avg-engage-body">
						<table class="avg-table" id="engage-table">
						</table>
					</div>
					<div class="box-body" id="avg-click-body">
						<table class="avg-table" id="click-table">
						</table>
					</div>
				</div>
			</div>

		</div>

		<div class="row chart-row">

			<div class="col-sm-4 col-xs-12">	
				<!-- Donut chart -->
				<div class="box gray-box">
					<div class="box-header">
						<h2 class="box-title">ประเภทของโพสต์</h2>
						<i class="info-hover fa fa-info-circle" aria-hidden="true">
							<span class="tooltiptext"><i class="fa fa-info-circle"></i> กราฟแสดงประเภทของโพสทั้งหมด ตัวอย่างเช่น โพสต์รูป โพสต์วีดีโอ Live</span>
						</i>
					</div>
					<div class="box-body">
						<div id="donut-chart" style="height: 300px;"></div>
					</div>
					<!-- /.box-body-->
				</div>
			</div>

			<div class="col-sm-4 col-xs-12">
				<!-- Donut chart -->
				<div class="box gray-box">
					<div class="box-header">
						<h2 class="box-title">จำนวนโพสต์ตาม Rank</h2>
						<i class="info-hover fa fa-info-circle" aria-hidden="true">
							<span class="tooltiptext"><i class="fa fa-info-circle"></i> กราฟแสดงจำนวนของโพสต์ แยกตามคะแนนของโพสต์</span>
						</i>
						<div class="box-tools pull-right">
							<input id="toggle-rank" type="checkbox" data-size="small" checked data-toggle="toggle" data-on="Engage" data-off="Click" data-onstyle="success" data-offstyle="warning">
						</div>
					</div>
					<div class="box-body" id="engage-body">
						<div id="rank-bar-chart1" style="width: 100%;height: 300px;"></div>
					</div>
					<div class="box-body" id="click-body">
						<div id="rank-bar-chart2" style="width: 100%;height: 300px;"></div>
					</div>

					<!-- /.box-body-->
				</div>
			</div>

			<div class="col-sm-4 col-xs-12">
				<!-- Donut chart -->
				<div class="box gray-box">
					<div class="box-header">
						<h2 class="box-title">จำนวนโพสต์รายวัน</h2>
						<i class="info-hover fa fa-info-circle" aria-hidden="true">
							<span class="tooltiptext"><i class="fa fa-info-circle"></i> กราฟแสดงจำนวนเฉลี่ยของโพสต์รายวัน</span>
						</i>
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
						<i class="info-hover fa fa-info-circle" aria-hidden="true">
							<span class="tooltiptext"><i class="fa fa-info-circle"></i> แสดง 5 โพสต์ที่มีคนกดไลค์/แชร์/คอมเม้น มากที่สุด</span>
						</i>
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
						<i class="info-hover fa fa-info-circle" aria-hidden="true">
							<span class="tooltiptext"><i class="fa fa-info-circle"></i> แสดง 5 โพสต์ที่มีคนกดไลค์/แชร์/คอมเม้น น้อยที่สุด</span>
						</i>
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
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>

	var global_data = [];

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
		$("#avg-engage-box").html( 'Null' );
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

    function createEngageClickChart( data ) 
    {

        var engage_data=[];
		var click_data=[];

		for( var key in data )
		{
			var row = data[key]
			var session = row.session;
			var engage = row.engage;
			var click = row.click;
			engage_data.push( [ session , engage ] );
			click_data.push( [ session , click ] );
		}

		var engage_series = {
			data: engage_data,
			color: "#00a65a"
		};
		var click_series = {
			data: click_data,
			color: "#f39c12"
		};

		plotSessionGraph(engage_series , "#engage-bar-chart"); 
		plotSessionGraph(click_series , "#click-bar-chart"); 
		$('#click-box-body').hide();
    }

	function createAvgBox( data ) 
	{
		
		var engage_table = $('#engage-table');
		var click_table = $('#click-table');

		for (var index = 0; index < data.length; index++) 
		{
			
			if (index%5==0) 
			{
				console.log( "create" );
				engage_table.append( "<tr></tr>" );
				click_table.append( "<tr></tr>" );
			}
			var session_data = data[index];
			console.log( session_data );
			var engage_last_tr = engage_table.find( 'tr:last' );
			var click_last_tr = click_table.find( 'tr:last' );

			

			var engage_html = 	"<td>"
									+"<div class='avg-box'>"
										+"<div class='avg-engage session-name'>"+session_data.session+"</div>"
										+"<span>"+Math.round(session_data.engage_avg).toLocaleString('en-US')+"</span>"
									+"</div>"
								+"</td>";

			var click_html = 	"<td>"
									+"<div class='avg-box'>"
										+"<div class='avg-click session-name'>"+session_data.session+"</div>"
										+"<span>"+Math.round(session_data.click_avg).toLocaleString('en-US')+"</span>"
									+"</div>"
								+"</td>";
			engage_last_tr.append(engage_html);
			click_last_tr.append(click_html);

		}
	}

    function createSessionChart( data ) 
    {

        var result=[];

		for( var key in data )
		{
			var row = data[key]
			var session = row.session;
			var count = row.count;
			result.push( [ session , count ] );
		}


		var multi_series = {
			data: result,
			color: "#237cb7"
		};
		plotSessionGraph(multi_series , "#session-bar-chart"); 
		
    }
	
	function plotSessionGraph(series , target) 
	{
		
		var stack = 0,
			bars = true,
			lines = false,
			steps = false;

		$.plot(target, [series], {
			grid: {
				borderWidth: 0,
				hoverable: true,
            	clickable: true,
				mouseActiveRadius: 30
			},
			series: {
				stack : stack,
				bars: {
					show: true,
					barWidth: 0.8,
					align: "center",
					hoverable: true,
					numbers : {
            			show : true,
						font : { size: 14 ,color:'#FFF'},
					}
				}
			},
			xaxis: {
				mode: "categories",
				tickLength: 0
			},
			legend:{
				show:false
			}
		});

		var previousPoint = null,
			previousIndex = null,
    		previousLabel = null;

		$(target).on("plothover", function (event, pos, item) {
			if (item) {
				if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex) || (previousIndex != item.seriesIndex) ) 
				{
					previousIndex = item.seriesIndex;
					previousPoint = item.dataIndex;
					previousValue = item.datapoint[1];
					previousLabel = item.series.label;
					$("#tooltip").remove();
					
					var x = item.datapoint[0];
					var y = parseInt(item.datapoint[1]-item.datapoint[2]).toLocaleString('en-US');
					
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

	function editSessionChart( selector ) 
	{
		var data = global_data[3];
		var rank =  selector.data;
		switch (rank) {
				case 'All':
					var color = "#237cb7"
					var obj_array = [];
					for( var key in global_data[4] )
					{
						var row = global_data[4][key];
						var session = row.session;
						var count = row.count;
						obj_array.push( [ session , count ] );
					}
					break;
				case 'A':
					var color = "#0098d2"
					var obj_array = data[5].click_rank;
					break;
				case 'B':
					var color = "#56caf6"
					var obj_array = data[4].click_rank;
					break;
				case 'C':
					var color = "#adf0ff"
					var obj_array = data[3].click_rank;
					break;
				case 'D':
					var color = "#ff6d52"
					var obj_array = data[2].click_rank;
					break;
				case 'E':
					var color = "#ff9b82"
					var obj_array = data[1].click_rank;
					break;
				case 'F':
					var color = "#ac1616"
					var obj_array = data[0].click_rank;
					break;
				default:
					break;
		}
		var series = {
			data: obj_array,
			color: color,
			label: rank
		};
		plotSessionGraph(series);
	}

	function createRankBarChart( data )
	{
		var result=[];
		var engage_data =[];
		var click_data =[];
		for( var key in data )
		{
			var row 			= data[key];
			var engage_array 	= row.engage_rank;
			var click_array 	= row.click_rank;
			var engage_sum		= 0;
			var click_sum 		= 0;
			var rank 			= row.rank;

			for (var index = 0; index < click_array.length; index++) 
			{
				var engage_obj = engage_array[index];
				var click_obj = click_array[index];
				engage_sum +=  parseInt(engage_obj[1]);
				click_sum += parseInt(click_obj[1]);
			}
			engage_data.unshift( [rank , engage_sum ] );
			click_data.unshift( [rank , click_sum ] );
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

		$('#click-body').hide();
	}

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

	function createSelector( data ) 
	{
		var rank_result=[ 
			{ id: 0, text: 'ทั้งหมด' , data: 'All' } ,
			{ id: 1, text: 'ระดับ A' , data: 'A' } , 
			{ id: 2, text: 'ระดับ B' , data: 'B' } , 
			{ id: 3, text: 'ระดับ C' , data: 'C' } , 
			{ id: 4, text: 'ระดับ D' , data: 'D' } ,
			{ id: 5, text: 'ระดับ E' , data: 'E' } ,
			{ id: 6, text: 'ระดับ F' , data: 'F' } 
		];
		var session_result=[];
		
		for (var index = 0; index < data.length; index++) {
			var element = data[index];
			session_result.push( {id:index , text :element.session} );
		}

		$("#rank-selector").select2({
			data: rank_result
		});	

		$("#session-selector").select2({
			data: session_result
		});	
	}

    function ajaxDashboard( page_id , min_date , max_date )
	{		
		$.ajax({
			url:  "<?php echo(base_url());?>ajaxOwnerDashboard",   //the url where you want to fetch the data 
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
				global_data = data;
				createBarChart( data[0] );
				createPieChart( data[0] );
				createSessionChart( data[4] );
				createEngageClickChart( data[4] );
				createRankBarChart( data[3] );
				createDetailBox( data );
                editBestandWorstBox( data[2] );
				createSelector( data[4] );
				createAvgBox( data[4] );
				$('#myModal').modal('hide');
			}
		});
	}

	function searchCallback( min_date=0 , max_date=0 ) 
	{
		$('#myModal').modal('show');
		var page_id = '208428464667';

		if ( Boolean(page_id) && Boolean(min_date)  && Boolean(max_date) ) 
		{
			text_min = min_date.substr(0,10);
			text_max = max_date.substr(0,10);

			ajaxDashboard( page_id , min_date , max_date );
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

	function createCallbackElement() 
	{
		$("#rank-selector").on("select2:select", function (e) { editSessionChart(e.params.data); });

		$('#btn_session').on('click', function(event) {
			var link = "<?php echo base_url() ?>"+"sessionDashboard/"+$("#session-selector").select2('data')[0].text
			console.log( link );
			window.open( link , '_blank' );
		});

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
		});

		$('#toggle-bar-engage').change(function() {
			if ($(this).prop('checked') )
			{
				$("#engage-click-title").html( "Engagement รวม แบ่งตามประเภทข่าว" );
				$('#engage-box-body').show();
				$('#click-box-body').hide();
			}
			else
			{
				$("#engage-click-title").html( "Click รวม แบ่งตามประเภทข่าว" );
				$('#engage-box-body').hide();
				$('#click-box-body').show();
			}
		});


		$('#avg-click-body').hide();
		$('#toggle-bar-avg').change(function() {
			if ($(this).prop('checked') )
			{
				$("#avg-title").html( "ค่าเฉลี่ย Engagement ต่อโพสแบ่งตามประเภทข่าว" );
				$('#avg-engage-body').show();
				$('#avg-click-body').hide();
			}
			else
			{
				$("#avg-title").html( "ค่าเฉลี่ย Click ต่อโพสแบ่งตามประเภทข่าว" );
				$('#avg-engage-body').hide();
				$('#avg-click-body').show();
			}
		});

		$('.info-hover').hover( 
			function() { $(this).find(".tooltiptext").css( 'visibility' , 'visible' ); } ,
			function() { $(this).find(".tooltiptext").css( 'visibility' , 'hidden' ); } )
	}

	$(document).ready(function() 
	{
		construct_min_date = moment().subtract(1, 'weeks').startOf('isoWeek').format("YYYY-MM-DD HH:mm:ss");
		construct_max_date = moment().subtract(1, 'weeks').endOf('isoWeek').format("YYYY-MM-DD HH:mm:ss");

		$('#myModal').modal('show');

		
		

		createCallbackElement();
		searchCallback( construct_min_date , construct_max_date );
		
	});

</script>

</body>
</html>

