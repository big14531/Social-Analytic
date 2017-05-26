<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<style>
	li{
		color: black!important;
	}
	.full-width{
		width:100%;
	}
	.table-icon{
		width:20px;
		margin: 0px;
	}
	.table-img{
		width:100%;
	}
	.page-img{
		width: 50px;
	}
	.pic_col{
		width:50px;
	}
	.self_col{ 
		background-color: #3c8dbc;
	}
	.rank_col{
		width:0px;
		text-align: center;
		vertical-align: middle;
	}
	.name_txt{
		text-overflow: ellipsis;
	}
	.reaction_col{
		width:80px;
		height: 100%;
		text-align: center;
		vertical-align: middle;
	}
	.engage_col{
		width:80px;
		height: 100%;
		text-align: center;
		vertical-align: middle;
	}
	.reddot:before {
		margin-left: 15px;
		position: absolute;
		content: '';
		background-color:#FF0000;
		border-radius:50%;
		opacity:1;
		width: 20px;
		height: 20px;
		pointer-events: none;
	}

	.div-pic {
		padding:10px;
	}
	.mini-engage{
		font-size: 0.8em;
	}
</style>

<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.min.css">

<!-- Content Here -->

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			ตารางเปรียบเทียบโพสต์ ( Reports )
		</h1>

	</section>

	<section class="content">   

		<div id='alert' class="alert alert-warning alert-dismissible hidden">
			<h3>Success!!</h3>
			<p>This is a green alert.</p>
		</div>

		<div class="box">
			<div class="box-body">
				<div class="row">
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
						<button type="button" class="btn btn-md btn-info full-width" id="search-btn">
							<span>
								<i class="fa fa-calendar"></i> ค้นหา
							</span>
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="box">
			<div class="box-body">
				<table id="dataTable" class="display table table-bordered" width="100%"></table>
			</div>
		</div>

	</section>
</div>

<?php $this->load->view( 'default/bottom' ) ?>

<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Select2 -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.full.min.js"></script>

<script>

	function ajaxAnalyticList( min_date , max_date )
	{
		$('#search-btn').find('span').text('กำลังค้นหา.....');
		$('#search-btn').addClass('disabled');
		$('#search-btn').prop('disabled',true);
		$.ajax({
            url:  "<?php echo base_url()?>ajaxAnalyticList",   //the url where you want to fetch the data 
            type: 'post', //type of request POST or GET    
            dataType: 'json',
            data: { 
            	'min_date': min_date,
            	'max_date': max_date 
            },
            async: true, 
            success:function(data)
            {
            	console.log( data );
            	var dataset = editData( data );
            	renderTable( dataset );
				$('#search-btn').prop('disabled',false);
				$('#search-btn').removeClass('disabled');
				$('#search-btn').find('span').html('<i class="fa fa-calendar"></i> ค้นหา');
            }
        }); 
	}

	function renderTable(data)
	{
		datatable = $('#dataTable').DataTable();
		datatable.clear().draw();
        datatable.rows.add( data ); // Add new data
        datatable.columns.adjust().draw(); // Redraw the DataTable
    }

    function editData(data)
    {
    	var dataset=[];
    	for ( var key in data )
    	{
    		var value = data[key];
    		var relate_post = value.related_post;
    		dataset[key] = 
    		[
	    		[ value.picture , value.permalink_url ],	
	    		value.name,
	    		[ value.engage_rank , parseInt(value.engage).toLocaleString('en-US') ] ,
	    		[ value.click_rank , parseInt(value.link_clicks).toLocaleString('en-US') ] ,
	    		relate_post[0]==null ? '-':relate_post[0],
	    		relate_post[1]==null ? '-':relate_post[1],
	    		relate_post[2]==null ? '-':relate_post[2],
	    		relate_post[3]==null ? '-':relate_post[3],
	    		relate_post[4]==null ? '-':relate_post[4]
    		];
    	}
    	return dataset;
    }

    function createRankCell( nTd , sData , oData ) 
    {
    	if(sData=='-')return;
    	

    	if( sData.permalink_url==oData[0][1] )
    	{

    		$(nTd).addClass("reddot");
    	}
    	$(nTd).addClass("rank_col");
    	$(nTd).html("<div class='div-pic'><a href='"+sData.permalink_url+"' target='_blank'><image class='page-img' src='"+sData.page_picture+"' /></a><span class='mini-engage'>"+parseInt(sData.engage).toLocaleString('en-US')+"</span></div>");
    }

    function createTable() 
    {
    	$('#dataTable').DataTable( {
    		columns: [
	    		{ title: "Post" ,
	    		"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
	    		{
	    			$(nTd).addClass("pic_col");
	    			$(nTd).html("<a href='"+sData[1]+"' target='_blank'><image class='table-img' src='"+sData[0]+"' /></a>");
	    		}
		    	},
		    	{ title: "Name"  ,
		    	"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
		    	{
		    		$(nTd).addClass("name_txt");
		    	}
			    },
			    { title: "Reaction" ,
			    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
			    {
			    	$(nTd).addClass("reaction_col");
			    	$(nTd).html(sData[0]+" ( "+sData[1]+" )");
			    }
				},
				{ title: "Click" ,
				"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
				{
					$(nTd).addClass("engage_col");
					$(nTd).html(sData[0]+" ( "+sData[1]+" )");
				}
				},
				{ title: "Rank 1" ,
				"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
				{
					createRankCell( nTd, sData , oData );
				}
				},
				{ title: "Rank 2" ,
				"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
				{
					createRankCell( nTd, sData , oData );
				}
				},
				{ title: "Rank 3" ,
				"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
				{
					createRankCell( nTd, sData , oData );
				}
				},
				{ title: "Rank 4" ,
				"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
				{
					createRankCell( nTd, sData , oData );
				}
				},
				{ title: "Rank 5" ,
				"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
				{

					createRankCell( nTd, sData , oData );
				}
				},
			],
			"iDisplayLength": 100,
			"autoWidth": true,
			'order': [[ 3, "ASC" ]]
			} );
    } 

    function initializeDatePicker() 
    {
    	// $('#daterange-btn').daterangepicker
    	// (
    	// {
    	// 	ranges: {
    	// 		'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    	// 		'7 วันที่ผ่านมา': [moment().subtract(7, 'days'), moment().subtract(1, 'days')],
    	// 		'30 วันที่ผ่านมา': [moment().subtract(29, 'days'), moment()],
    	// 		'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
    	// 		'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    	// 	},
    	// 	startDate: moment().subtract(29, 'days'),
    	// 	endDate: moment()
    	// },
    	// function (start, end) {
    	// 	$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    	// 	$('#daterange-btn').val(start.format('YYYY-MM-DD 00:00:00') + ' to ' + end.format('YYYY-MM-DD 23:59:59'));
    	// }
    	// );

    	$('#daterange-btn').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true
		}, 
		function(start, end) {
			$('#daterange-btn span').html(start.format('MMMM D, YYYY'));
			$('#daterange-btn').val(start.format('YYYY-MM-DD 00:00:00') + ' to ' + end.format('YYYY-MM-DD 23:59:59'));
		});
    }



    $(document).ready(function() 
    {
    	var min_date = moment().subtract(1, 'days').format('YYYY-MM-DD 00:00:00');
    	var max_date = moment().subtract(1, 'days').format('YYYY-MM-DD 23:59:59');
    	createTable();
    	initializeDatePicker();
    	ajaxAnalyticList( min_date , max_date ); 

    	$('#search-btn').click(function()
    	{
    		var date_range = $('#daterange-btn').val();
    		var date = date_range.split(' to ');
    		if ( Boolean(date_range) ) 
    		{
    			ajaxAnalyticList( date[0] , date[1] );
    		}
    		else
    		{
    			$('#alert').removeClass( 'hidden');
    			$('#alert').removeClass( 'alert-success');
    			$('#alert').removeClass( 'alert-warning');
    			$('#alert').addClass( 'alert-warning');
    			$('#alert').find('h3').text( "กรุณาเลือกวันที่และชื่อเพจที่ต้องการ" );
    			$('#alert').find('p').text( '' );
    		}
    	});

    });

</script>

</body>
</html>
