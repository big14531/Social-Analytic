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
	.table-icon{
		width:20px;
		margin: 0px;
	}
	.table-img{
		width:70px;
	}
	.select2-search__field{
		color: #000!important;
	}
	.select2-selection__choice{
		color: #000!important;
	}
	.table-img-page{
		width:40px;
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
			โพสต์ทั้งหมด
		</h1>

	</section>

	<section class="content">   

		<div id='alert' class="alert alert-warning alert-dismissible hidden">
			<h3>Success!!</h3>
			<p>This is a green alert.</p>
		</div>

		<div class="box">
			<div class="box-header">


			</div>
			<!-- /.box-header -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<div class="input-group full-width">
							<button type="button" class="btn btn-lg btn-default pull-left full-width" id="daterange-btn">
								<span>
									<i class="fa fa-calendar"></i> เลือกวันที่
								</span>
								<i class="fa fa-caret-down"></i>
							</button>
						</div>
					</div>

					<!-- <div class="col-md-3">
						<div class="form-group">
							<select class="btn btn-lg btn-default" id="page-selector" style="width: 100%;">
								<option selected="selected">เลือกเพจ</option>
								<?php 
								foreach ($page_list as $value) 
								{
									echo "<option id='".$value->page_id."'>".$value->name."</option>";
								}
								?>
							</select>
						</div>
						
					</div> -->

					<div class="col-md-3">
						<select id="page-selector" class="form-control select2 selector" multiple="multiple" data-placeholder="เลือกเพจ" style="width: 100%;">
						</select>
					</div>

					<div class="col-md-4">
						<div class="form-group">
							<button type="button" class="btn btn-lg btn-info full-width" id="search-btn">
								<span>
									<i class="fa fa-calendar"></i> ค้นหา
								</span>
							</button>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<button type="button" class="btn btn-lg btn-warning full-width" id="toggle-vis-btn">
								<span>
									<img class='table-icon' src='<?php echo(base_url());?>assets/images/like.png'>เปิด/ปิด
								</span>
							</button>
						</div>
					</div>

				</div>

				<table id="example1" class="display table table-bordered" width="100%"></table>

			</div>
			<!-- /.box-body -->
		</div>

		<!-- Edit Modal -->
		<div class="modal modal-info fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Post Analytic Keyword <span id="editModal_name"></span></h4>
					</div>

					<div class="modal-body">
						
						<select id="tags" multiple="multiple" class="selector"  style="width: 100%;color:#FFF;">
						</select>
						<span id="analytic-link"></span>
					</div>	
					
					<div class="modal-footer">
						<button type="button" class="btn btn-primary btn_save" id="btn_submit">ตกลง</button>	
						<button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
					</div>

				</div>
			</div>
		</div>


	</section>
</div>

<?php $this->load->view( 'default/bottom' ) ?>

<!-- FLOT CHARTS -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.pie.min.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.categories.min.js"></script>
<!-- FLOT TIME CHARTS -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.time.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Select2 -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.full.min.js"></script>
<script>

	$(function () 
	{
		$(document).ready(function() 
		{
			$(".select2").select2();
			ajaxCreatePageCard()
			$('#tags').select2({
				tags: true,
				tokenSeparators: [','], 
				placeholder: "พิมพ์คำที่ต้องการเทียบ"
			});

			$('#example1').DataTable( 
			{
				columns: 
				[
				{ title: "เพจ" ,
				"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
				{
					$(nTd).html("<image class='table-img-page' src='"+sData+"' />");
				}
				},
				{ title: "ภาพ" ,
				"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
				{
					$(nTd).html("<image class='table-img' src='"+sData+"' />");
				}
				},
				{ title: "วันที" },
				{ title: "เวลาอัพเดท" },
				{ title: "ข้อความ" },
				{ title: "Engagement" },
				{ title: "Rank" },
				{ title: "Share" },
				{ title: "Comments" },
				{ title: "Reaction" },
				{ title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/like.png'>" },
				{ title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/love.png'>" },
				{ title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/wow.png'>" },
				{ title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/smile.png'>" },
				{ title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/sad.png'>" },
				{ title: "<img class='table-icon' src='<?php echo(base_url());?>assets/images/angry.png'>" },
				{ title: "<i class='fa fa-globe' aria-hidden='true'>" ,
					"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
					{
						$(nTd).html("<a href='"+sData+"' target='_blank'><i class='fa fa-link' aria-hidden='true'></a>");
					}
				},
				{ title: "<i class='fa fa-facebook-official' aria-hidden='true'>" ,
				"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
				{
					$(nTd).html("<a href='"+sData+"' target='_blank'><i class='fa fa-link' aria-hidden='true'></a>");
				}
				},
				{ title: "<i class='fa fa-line-chart' aria-hidden='true'>" ,
				"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
				{
					$(nTd).html("<a class='open-modal' data-toggle='modal' data-target='#editModal' id='"+sData+"' ><i class='fa fa-line-chart' aria-hidden='true'></a>");
				}
				},
			],
			"iDisplayLength": 100,
			'order': [[ 4, "ASC" ]]
			});



			// ajaxCall()
			// SET HIDE REACTIOn FIRST TIME
			toggleColumnReaction();


			
			var max_date = moment().format("YYYY-MM-DD 23:59:59");
			var min_date = moment().format("YYYY-MM-DD 00:00:00");
			ajaxCall( 208428464667 , min_date , max_date );

		});
		
		$('#daterange-btn').daterangepicker
		(
		{
			ranges: {
				'วันนี้': [moment(), moment()],
				'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'7 วันที่ผ่านมา': [moment().subtract(7, 'days'), moment().subtract(1, 'days')],
				'30 วันที่ผ่านมา': [moment().subtract(29, 'days'), moment()],
				'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
				'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			},
			startDate: moment().subtract(29, 'days'),
			endDate: moment()
		},
		function (start, end) {
			$('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			$('#daterange-btn').val(start.format('YYYY-MM-DD 00:00:00') + ' to ' + end.format('YYYY-MM-DD 23:59:59'));
		}
		);

		function createSelector( data ) 	
		{
			// Create Card in Row
			var selector = $("#page-selector");
			var page_list = [];
			for (var i = 0; i < data.length; i++) 
			{
				var page_data = data[i];
				var page_name = page_data.name;
				var page_id = page_data.page_id;
				page_list.push( { id: page_id, text: page_name} );
			}
			$(selector).select2({
				data: page_list
			});
		}

		function ajaxCreatePageCard()
		{		
			$.ajax({
				url:  "<?php echo(base_url());?>ajaxGetActivePage",   //the url where you want to fetch the data 
				type: 'post', //type of request POST or GET   
				dataType: 'json',
				async: true, 
				success:function(data)
				{
					createSelector(data);
				}
			});
		}


		function renderTable(data)
		{
			datatable = $('#example1').DataTable();

			datatable.clear().draw();
			datatable.rows.add( data ); // Add new data
			datatable.columns.adjust().draw(); // Redraw the DataTable
		}

		function convertTime( data )
		{ 
			var temp_date = data.substr(0,10);
			var date = temp_date.split("-");
			var time = data.substr(11);
			var result = date[2]+"-"+date[1]+"-"+date[0]+" "+time;
			return result;
		}

		function editData(data)
		{
			console.log( data );

			var dataset=[];
			for ( var key in data )
			{
				var value = data[key];
				var engagement =  parseInt (value.comments)+
				parseInt (value.likes )+ 
				parseInt (value.love )+ 
				parseInt (value.wow )+ 
				parseInt (value.haha )+ 
				parseInt (value.sad )+  
				parseInt (value.angry )+ 
				parseInt (value.shares );

				var reaction =     parseInt (value.likes )+ 
				parseInt (value.love )+ 
				parseInt (value.wow )+ 
				parseInt (value.haha )+ 
				parseInt (value.sad )+  
				parseInt (value.angry );

				var analytic_link = "<?php echo base_url() ?>"+"postAnalytic/"+value.page_id+"/"+value.post_id;

				var created_time = convertTime( value.created_time );
				var last_update_time = convertTime( value.last_update_time );
				dataset[key] = 
				[
				value.page_logo,
				value.picture,
				created_time,
				last_update_time,
				value.name,
				engagement.toLocaleString('en-US'),
				value.engage_rank,
				parseInt ( value.shares ).toLocaleString('en-US'),
				parseInt ( value.comments ).toLocaleString('en-US'),
				reaction.toLocaleString('en-US'),
				parseInt ( value.likes ).toLocaleString('en-US'),
				parseInt ( value.love ).toLocaleString('en-US'),
				parseInt ( value.wow ).toLocaleString('en-US'),
				parseInt ( value.haha ).toLocaleString('en-US'),
				parseInt ( value.sad ).toLocaleString('en-US'),
				parseInt ( value.angry ).toLocaleString('en-US'),
				value.link,
				value.permalink_url ,
				analytic_link
				];

			}
			return dataset;
		}

		function toggleColumnReaction()
		{
			// Get the column API object
			var table = $('#example1').DataTable();

			var column_likes = table.column( 10 ).visible();
			var column_love = table.column( 11 ).visible();
			var column_wow = table.column( 12 ).visible();
			var column_haha = table.column( 13 ).visible();
			var column_sad = table.column( 14 ).visible();
			var column_angry = table.column( 15 ).visible();

			// Hide a column
			table.column( 10 ).visible( !column_likes );
			table.column( 11 ).visible( !column_love );
			table.column( 12 ).visible( !column_wow );
			table.column( 13 ).visible( !column_haha );
			table.column( 14 ).visible( !column_sad );
			table.column( 15 ).visible( !column_angry );		
		}

		function ajaxCall( page_id , min_date , max_date )
		{
			$('#search-btn').find('span').text('กำลังค้นหา.....');
			$('#search-btn').addClass('disabled');
			$('#search-btn').prop('disabled',true);
			$.ajax(
			{
					url:  "<?php echo(base_url());?>ajaxPostList",   //the url where you want to fetch the data 
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
						var page_name = $('#page-selector').find(':selected').text();
						if (data.length == 0) 
						{
							$('#alert').removeClass( 'hidden');
							$('#alert').removeClass( 'alert-success');
							$('#alert').addClass( 'alert-warning');
							$('#alert').find('h3').text( "ไม่มีข้อมูลในช่วงเวลานี้ - "+page_name );
							$('#alert').find('p').text(  "Post from "+min_date+" - "+max_date+" " );
						}
						else
						{
							$('#alert').removeClass( 'hidden');
							$('#alert').removeClass( 'alert-warning');
							$('#alert').addClass( 'alert-success');
							$('#alert').find('h3').text( "ค้นหาสำเร็จ!!" );
							$('#alert').find('p').text('');
							data = editData(data);
							renderTable(data);
						}
						$('#search-btn').prop('disabled',false);
						$('#search-btn').removeClass('disabled');
						$('#search-btn').find('span').html('<i class="fa fa-calendar"></i> ค้นหา');
						$("#alert").fadeTo(2000, 500).slideUp(500, function()
						{
							$("#alert").slideUp(500);
						});
					},
					error:function(xhr, textStatus, errorThrown) 
					{
						$('#search-btn').prop('disabled',false);
						$('#alert').removeClass( 'hidden');
						$('#alert').removeClass( 'alert-success');
						$('#alert').addClass( 'alert-danger');
						$('#alert').find('h3').text( "Error!!" );
						$('#alert').find('p').text( textStatus+" "+errorThrown+" "+xhr );
					}   
				}
				);
		}

		$('#search-btn').click(function()
		{
			var selected_page = $('#page-selector').val();
			var date_range = $('#daterange-btn').val();
			var date = date_range.split(' to ');
			if ( Boolean(selected_page) && Boolean(date_range) ) 
			{
				
				ajaxCall(  selected_page , date[0] , date[1] );
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

		$('#toggle-vis-btn').click( function()
		{
			toggleColumnReaction();
		});

		$(document).on("click", ".open-modal", function () {
			$("#analytic-link").text ( $(this).attr('id') );
		});

		$('#btn_submit').click(function()
		{
			var link = $("#analytic-link").text()+"/";
			var object = $("#tags");
			if( object.val() !== null)
			{
				var keyword = object.val();
				for (var i = 0; i < keyword.length; i++) 
				{
					link += keyword[i]+"%20";
				}
				window.open( link , '_blank' );
			}
			else
			{
				window.open( link+"-" , '_blank' );
			}
		});

		

	});


</script>

</body>
</html>
