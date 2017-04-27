<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<style>
	.full-width{
		width:100%;
	}
	.graph-box{
		padding: 20px;
	}
	.table-img{
		width:30px;
	}
	.box-body {   
		padding-bottom: 0px;
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
			Ranking Page
		</h1>
	</section>

	<section class="content">   

		<div id='alert' class="alert alert-dismissible hidden">
			<h3>Success!!</h3> 
			<p>This is a green alert.</p>
		</div>
		<div class="box gray-box">
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="input-group full-width">
							<button type="button" class="selectpicker btn btn-lg btn-default full-width" id="daterange-btn">
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
				<table id="example1" class="display table table-bordered" width="100%"></table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="box gray-box">
					aaa
				</div>
			</div>
			<div class="col-md-4">
				<div class="box gray-box">
					aaa
				</div>
			</div>
			<div class="col-md-4">
				<div class="box gray-box">
					bbb
				</div>
			</div>
			<div class="col-md-4">
				<div class="box gray-box">
					aaa
				</div>
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


	function ajaxRankPost( min_date , max_date )
	{
		$('#search-btn').find('span').text('Searching.....');
		$('#search-btn').addClass('disabled');
		$('#search-btn').prop('disabled',true);
		$.ajax({
			url:  "<?php echo(base_url());?>ajaxRankPost",   //the url where you want to fetch the data 
			type: 'post', //type of request POST or GET   
			data: { 
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
				}
				$('#search-btn').prop('disabled',false);
				$('#search-btn').removeClass('disabled');
				$('#search-btn').find('span').html('<i class="fa fa-calendar"></i> Search');
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
			var date_range = $('#daterange-btn').val();
		 	var date = date_range.split(' to ');

		 	if ( Boolean(date_range) ) 
		 	{
		 		ajaxRankPost( date[0] , date[1] );
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

	});
</script>


