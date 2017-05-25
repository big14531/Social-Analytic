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
		width:100px;
	}
	.rank_col{
		width:90px;
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

	function ajaxAnalyticList()
    {
        $.ajax({
            url:  "<?php echo base_url()?>ajaxAnalyticList",   //the url where you want to fetch the data 
            type: 'post', //type of request POST or GET    
            dataType: 'json',
            async: true, 
            success:function(data)
            {
            	console.log( data );
                // var dataset = editData( data );
                // renderTable( dataset );
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
           dataset[key] = 
           [
           	value.is_delete,
            value.page_id,
            value.post_id,
            value.last_update_time,
            value.name,
            value.link,
            value.permalink_url,
            value.is_delete,
            null	
           ];
        }
        return dataset;
     }

    function initializeDatePicker() 
    {
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
    }

    function createTable() 
    {
        $('#dataTable').DataTable( {
            columns: [
                { title: "Post" },
                { title: "Name" },
                { title: "Engagement" },
              	{ title: "Rank 1" ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
                    {
                        $(nTd).addClass("rank_col");
                	}
                },
                { title: "Rank 2" ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
                    {
                        $(nTd).addClass("rank_col");
                	}
                },
                { title: "Rank 3" ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
                    {
                        $(nTd).addClass("rank_col");
                	}
                },
                { title: "Rank 4" ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
                    {
                        $(nTd).addClass("rank_col");
                	}
                },
                { title: "Rank 5" ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) 
                    {
                        $(nTd).addClass("rank_col");
                	}
                },
            ],
			"autoWidth": true,
            'order': [[ 3, "ASC" ]]
        } );
    } 


	$(document).ready(function() 
	{
	    createTable();
	    initializeDatePicker();
	    ajaxAnalyticList(); 
	});

</script>

</body>
</html>
