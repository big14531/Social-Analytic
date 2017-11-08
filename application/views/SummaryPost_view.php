<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<style>
	.graph_tab.active a{
		background-color:#3c8dbc!important;
	}
	.graph_tab.active{
		border-top:0px!important;
	}
	.full-width{
		width:100%;
	}
	.graph-box{
		padding: 20px;
	}
	.table-img{
		width:30px;
	}
	th { 
		text-align: center; 
	}
	td { 
		font-size: 15px; 
		text-align: center;
	}
	.DTFC_LeftHeadWrapper table thead tr {
		background-color: #222d32!important;
	}
	#example1{
		background-color: #222d32;
	}
	.even{
		background-color: #222d32!important;
	}
	.odd{
		background-color: #222d32!important;
	}
</style>


<!-- daterange picker -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/daterangepicker/daterangepicker.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/datepicker/datepicker3.css">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.5.4/bootstrap-select.min.css">

<!-- Content Here -->

<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			ตารางข้อมูลต่อเวลา
		</h1>
	</section>

	<section class="content">   

		<div id='alert' class="alert alert-dismissible hidden">
			<h3>Success!!</h3> 
			<p>This is a green alert.</p>
		</div>

		<div class="box gray-box">
			<div class="box-header">
			</div>

			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<div class="input-group full-width">
							<button type="button" class="selectpicker btn btn-lg btn-default full-width" id="daterange-btn">
								<span>
									<i class="fa fa-calendar"></i> เลือกวันที่
								</span>
								<i class="fa fa-caret-down"></i>
							</button>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<select class="btn btn-lg btn-default" id="data-type" style="width: 100%;">
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

					<div class="col-md-6">
						<div class="form-group">
							<button type="button" class="btn btn-lg btn-info full-width" id="search-btn">
								<span>
									<i class="fa fa-calendar"></i> ค้นหา
								</span>
							</button>
						</div>
					</div>
				</div>
				<table id="example1" class="display table table-bordered" width="100%"></table>
				
			</div>
		</div>

	</section>
</div>

<?php $this->load->view( 'default/bottom' ) ?>

<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/datepicker/bootstrap-datepicker.js"></script>

<script>

	function createTable()
	{
		$('#example1').DataTable( 
		{
        	scrollX:        true,
	        scrollCollapse: true,
	        fixedColumns:
	        {
	        	leftColumns: 1
			},
			paging	: 		false,
			searching: 		false,
			aoColumnDefs: [
			{ "bSortable": false, "aTargets": [ "_all" ] }
			],
			columns: 
			[
				{ title: "Page" ,
					"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
					{
						$(nTd).html("<image class='table-img' src='"+sData+"' />");
					}
				},
				{ title: "00:00" },
				{ title: "01:00" },
				{ title: "02:00" },
				{ title: "03:00" },
				{ title: "04:00" },
				{ title: "05:00" },
				{ title: "06:00" },
				{ title: "07:00" },
				{ title: "08:00" },
				{ title: "09:00" },
				{ title: "10:00" },
				{ title: "11:00" },
				{ title: "12:00" },
				{ title: "13:00" },
				{ title: "14:00" },
				{ title: "15:00" },
				{ title: "16:00" },
				{ title: "17:00" },
				{ title: "18:00" },
				{ title: "19:00" },
				{ title: "20:00" },
				{ title: "21:00" },
				{ title: "22:00" },
				{ title: "23:00" },
			]
		});
	};


	function ajaxCall( type , min_date , max_date )
	{
		$('#search-btn').find('span').text('กำลังค้นหา.....');
		$('#search-btn').addClass('disabled');
		$('#search-btn').prop('disabled',true);
		$.ajax({
			url:  "<?php echo(base_url());?>facebook/ajaxSummaryPost",   //the url where you want to fetch the data 
			type: 'post', //type of request POST or GET   
			data: { 
				'type': type, 
				'min_date': min_date, 
				'max_date': max_date
			},
			dataType: 'json',
			async: true, 
			success:function(data)
			{
				if (data.length != 0) 
				{
					$('#alert').removeClass( 'alert-warning');
					$('#alert').addClass( 'alert-success');
					$('#alert').find('h3').text( "ค้นหาสำเร็จ!!" );
					$('#alert').find('p').text('');
					$('#alert').removeClass( 'hidden');
					console.log(data);
					var data = editData(data , type);
					
					renderTable(data);
				}
				$('#search-btn').prop('disabled',false);
				$('#search-btn').removeClass('disabled');
				$('#search-btn').find('span').html('<i class="fa fa-calendar"></i> ค้นหา');
			},
			error:function(xhr, textStatus, errorThrown) 
			{
				$('#search-btn').prop('disabled',false);
				$('#alert').removeClass( 'alert-info');
				$('#alert').removeClass( 'alert-success');
				$('#alert').addClass( 'alert-danger');
				$('#alert').find('h3').text( "Error!!" );
				$('#alert').find('p').text( textStatus+" "+errorThrown+" "+xhr );
			}   
		});
	}
	
	function editData(data , type)
	{
		switch( type )
		{
			case "Posts":
			var data_type="posts"
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

		var dataset=[]

		for ( var key in data )
		{
			var tmp_hours =0;
			var result =[];
			var page_data = data[key][0];
			var post_list = data[key][1];
			result.push( page_data.picture );

			// Set time to array
			for( var post_key in post_list )
			{
				var time_obj = post_list[post_key];
				var time = parseInt( time_obj.created_time_out );
				var inner_data = parseInt( time_obj[data_type] );
				result[time+1] = inner_data.toLocaleString('en-US');
				tmp_hours+=1;
			}

			// Fill empty key with 0
			for (var i = 1; i < 25; i++) 
			{
				if ( result[i]==null ) 	
				{
					result[i] = 0;
				}
			}
			dataset.push(result);
		}
		console.log(dataset);
		return dataset;
	}

	function renderTable(data)
	{
		datatable = $('#example1').DataTable();

		datatable.clear().draw();
		datatable.rows.add( data ); // Add new data
		datatable.columns.adjust().draw(); // Redraw the DataTable
	}

	$(document).ready(function() 
	{
		$('#daterange-btn').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true
		}, 
		function(start, end) {
			$('#daterange-btn span').html(start.format('MMMM D, YYYY'));
			$('#daterange-btn').val(start.format('YYYY-MM-DD 00:00:00') + ' to ' + end.format('YYYY-MM-DD 23:59:59'));
		});

		$('#search-btn').click(function()
		{
			var type = $('#data-type').find(':selected').val();
			var date_range = $('#daterange-btn').val();
		 	var date = date_range.split(' to ');

		 	if ( Boolean(date_range) && Boolean(type)) 
		 	{
		 		ajaxCall( type , date[0] , date[1] );
		 	}
			else
			{
				$('#alert').removeClass( 'alert-info');
				$('#alert').removeClass( 'hidden');
				$('#alert').removeClass( 'alert-success');
				$('#alert').removeClass( 'alert-warning');
				$('#alert').addClass( 'alert-warning');
				$('#alert').find('h3').text( "กรุณากรอกวันที่และประเภทข้อมุล" );
				$('#alert').find('p').text( '' );
			}
			$("#alert").fadeTo(2000, 500).slideUp(500, function()
			{
				$("#alert").slideUp(500);
			});
		});

		createTable();

	});
</script>

</body>
</html>
