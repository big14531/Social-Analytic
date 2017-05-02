<?php $this->load->view( 'default/header' ) ?> <?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<style>
    .full-width{
        width:100%;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Posts Management
        </h1>

    </section>

   

    <!-- Main content -->
    <section class="content">

        <div id='callout' class="callout hidden">
            <h4>Success!!</h4>
            <p>This is a green callout.</p>
        </div>  

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="display table table-bordered" width="100%"></table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>


<?php $this->load->view( 'default/bottom' ) ?>

<!-- iCheck for checkboxes and radio inputs -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/iCheck/icheck.min.js"></script>

<script>
   
    function ajaxManageList()
    {
        $.ajax({
            url:  "<?php echo base_url()?>ajaxManageList",   //the url where you want to fetch the data 
            type: 'post', //type of request POST or GET    
            dataType: 'json',
            async: true, 
            success:function(data)
            {
                var dataset = editData( data );
                renderTable( dataset );
            }
        }); 
    }

    function ajaxSetActivePost( page_id , post_id )
    {
        $.ajax({
            url:  "<?php echo base_url()?>ajaxSetActivePost",   //the url where you want to fetch the data 
            type: 'post', //type of request POST or GET
			data: {  
                    'page_id': page_id,
                    'post_id': post_id
                },     
            dataType: 'json',
            async: true, 
            success:function(data)
            {
                console.log(data);
				ajaxManageList();
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

    function createTable( data ) 
    {
        $('#example1').DataTable( {
            columns: [
            	{ title: "Error time" },
                { title: "Page ID" },
                { title: "Post ID" },
                { title: "Deleted time" },
                { title: "Name" },
                { title: "<i class='fa fa-globe' aria-hidden='true'>"   ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<a href='"+sData+"' target='_blank'><i class='fa fa-link' aria-hidden='true'></a>");
                    }
                },
				{ title: "<i class='fa fa-facebook-official' aria-hidden='true'>" ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).html("<a href='"+sData+"' target='_blank'><i class='fa fa-link' aria-hidden='true'></a>");
                    }
                },
                { title: "Status" ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        if( sData==0 )
                        {
                        	 $(nTd).html("<span class='label label-success' id='status'>Active</span>");
                        }
                        if( sData<=4 )
                        {
                        $(nTd).html("<span class='label label-warning' id='status'>Not update</span>");
                        }
                        else
                        {
                        $(nTd).html("<span class='label label-danger' id='status'>Deleted</span>");   
                        }
                    }
                },
                { title: "Command" ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                         $(nTd).append(' <a class="btn btn-xs btn-success" onclick=ajaxSetActivePost('+oData[1]+','+oData[2]+'); ><i class="fa fa-check"></i>Set Active</a>');                                                
                    }
                }
           
            ],
			"autoWidth": true,
            'order': [[ 3, "ASC" ]]
        } );
    } 


    ajaxManageList(); 
    createTable();


</script>

