<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
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
   

    function ajaxCreateUser( employee_id , email , username , password , is_active , name , autho_user , autho_manager , autho_admin )
    {
        $.ajax({
            url:  "<?php echo base_url()?>createUser",   //the url where you want to fetch the data 
            type: 'post', //type of request POST or GET    
            data: {  
                    'employee_code': employee_id,
                    'email': email,
                    'username': username,
                    'password': password,
                    'user_active': is_active,
                    'user_name_surname': name,
                    'autho_user': autho_user,
                    'autho_manager': autho_manager ,
                    'autho_admin': autho_admin
                }, 
            dataType: 'json',
            async: true, 
            success:function()
            {
                $('#addform-modal')[0].reset();
                $('#myModal').modal('toggle');

                $('#callout').removeClass( 'hidden');
                $('#callout').removeClass( 'callout-success');
                $('#callout').removeClass( 'callout-warning');
                $('#callout').addClass( 'callout-success');
                $('#callout').find('h4').text( "สำเร็จ!!" );
                $('#callout').find('p').text( "Username : "+username+" ถูกสร้างสำเร็จแล้ว" );
                ajaxCreateTable();
            }
        }); 
    }

    function ajaxEditUser( id , employee_id , email , username ,  name , autho_user , autho_manager , autho_admin )
    {
        $.ajax({
            url:  "<?php echo base_url()?>editUser",   //the url where you want to fetch the data 
            type: 'post', //type of request POST or GET    
            data: {  
                    'id' : id,
                    'employee_code': employee_id,
                    'email': email,
                    'username': username,
                    'user_name_surname': name,
                    'autho_user': autho_user,
                    'autho_manager': autho_manager ,
                    'autho_admin': autho_admin
                }, 
            dataType: 'json',
            async: true, 
            success:function(data)
            {
                console.log(data);
                $('#editModal').modal('toggle');

                $('#callout').removeClass( 'hidden');
                $('#callout').removeClass( 'callout-success');
                $('#callout').removeClass( 'callout-warning');
                $('#callout').addClass( 'callout-success');
                $('#callout').find('h4').text( "สำเร็จ!!" );
                $('#callout').find('p').text( "Username : "+username+" แก้ไขสำเร็จ" );
                ajaxCreateTable();
            }
        }); 
    }

    function ajaxChangePassword( id , password )
    {
        $.ajax(
            {
                url:  "<?php echo base_url()?>changePassword",   //the url where you want to fetch the data 
                type: 'post', //type of request POST or GET    
                data: { 
                        'id' : id,
                        'password': password
                    }, 
                dataType: 'json',
                async: true, 
                success:function(data)
                {
                    console.log(data);
                    $('#passModal').modal('toggle');
                    
                    $('#passform-modal')[0].reset();
                    $('#callout').removeClass( 'hidden');
                    $('#callout').removeClass( 'callout-success');
                    $('#callout').removeClass( 'callout-warning');
                    $('#callout').addClass( 'callout-success');
                    $('#callout').find('h4').text( "สำเร็จ!!" );
                    $('#callout').find('p').text( "แก้ไขรหัสผ่านสำเร็จ" );
                    ajaxCreateTable();
                }
            }
            ); 
    }

 

    $('#check_box').click(function () 
    {
        if( $('#autho_manager').is(":checked") )
        {
            $('#autho_user').iCheck('check'); 
        }
        else if ( $('#autho_admin').is(":checked") ) 
        {
            $('#autho_user').iCheck('check'); 
            $('#autho_manager').iCheck('check'); 
        }
    });

    $('#edit_check_box').click(function () 
    {
        if( $('#edit_autho_manager').is(":checked") )
        {
            $('#edit_autho_user').iCheck('check'); 
        }
        else if ( $('#edit_autho_admin').is(":checked") ) 
        {
            $('#edit_autho_user').iCheck('check'); 
            $('#edit_autho_manager').iCheck('check'); 
        }
    });

    $('#btn_add').click(function()
    {
        var employee_id = $('#employee_id').val();
        var email = $('#email').val();
        var username = $('#username').val();
        var password = $('#password').val();
        var name = $('#name').val();
        var is_active = 1;
        var autho_user = $('#autho_user').is(":checked")? 1:0;
        var autho_manager = $('#autho_manager').is(":checked")? 1:0;
        var autho_admin = $('#autho_admin').is(":checked")? 1:0;
        if (  $('#addform-modal')[0].checkValidity() ) 
        {
          ajaxCreateUser( employee_id , email , username , password , is_active , name , autho_user , autho_manager , autho_admin )
        }
        else
        {
            $('#modal_callout').removeClass( 'hidden');
            $('#modal_callout').removeClass( 'callout-info');
            $('#modal_callout').removeClass( 'callout-warning');
            $('#modal_callout').addClass( 'callout-warning');
            $('#modal_callout').find('h4').text( "ข้อมูลไม่ครบ!!" );
            $('#modal_callout').find('p').text( 'กรุณากรอกข้อมูลให้ถูกต้อง' );
        }  
    });

    $('#btn_edit').click(function()
    {
        var id = $('#edit_id').val();
        var employee_id = $('#edit_employee_id').val();
        var email = $('#edit_email').val();
        var username = $('#edit_username').val();
        var name = $('#edit_name').val();
        var autho_user = $('#edit_autho_user').is(":checked")? 1:0;
        var autho_manager = $('#edit_autho_manager').is(":checked")? 1:0;
        var autho_admin = $('#edit_autho_admin').is(":checked")? 1:0;

        ajaxEditUser( id , employee_id , email , username , name , autho_user , autho_manager , autho_admin );
    });

    $('#btn_pass').click(function()
    {
        var id = $('#pass_id').val();
        var new_password = $('#new_password').val();
        ajaxChangePassword( id , new_password );
    });

     $( "#example1" ).delegate( ".changePass", "click", function() {
        var this_p = $(this).parents('tr');
        var this_id = this_p.find('.id').text();
        $('#pass_id').val(this_id);
    });

    $( "#example1" ).delegate( ".edit", "click", function() {
        var this_p = $(this).parents('tr');
        var this_username = this_p.find('.username').text(); 
        var this_name = this_p.find('.name').text(); 
        var this_email = this_p.find('.email').text(); 
        var this_autho = this_p.find('.authorization').text(); 
        var this_status = this_p.find('.status').text(); 
        var this_employee_id = this_p.find('.employee_id').text();
        var this_id = this_p.find('.id').text();

        $('#edit_username').val(this_username);
        $('#edit_name').val(this_name);
        $('#edit_email').val(this_email);
        $('#edit_employee_id').val(this_employee_id);
        $('#edit_id').val(this_id);

        if( this_autho=='User' )
        {
            $('#edit_autho_user').iCheck('check');
            $('#edit_autho_manager').iCheck('uncheck');
            $('#edit_autho_admin').iCheck('uncheck');
        }
        else if ( this_autho=='Manager' ) 
        {
            $('#edit_autho_user').iCheck('check'); 
            $('#edit_autho_manager').iCheck('check');
            $('#edit_autho_admin').iCheck('uncheck'); 
        }
        else if ( this_autho=='Admin' ) 
        {
            $('#edit_autho_user').iCheck('check'); 
            $('#edit_autho_manager').iCheck('check'); 
            $('#edit_autho_admin').iCheck('check'); 
        }
    });

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
                    'page_id': page_id ,
                    'post_id': post_id
                },     
            dataType: 'json',
            async: true, 
            success:function(data)
            {
				ajaxManageList();
				console.log(data);
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
                        else
                        {
                        $(nTd).html("<span class='label label-danger' id='status'>Disable</span>");
                        }
                    }
                },
                { title: "Command" ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                         $(nTd).append(' <a class="btn btn-xs btn-success" onclick=ajaxSetActivePost('+oData[0]+','+oData[1]+'); ><i class="fa fa-check"></i>Set Active</a>');                                                
                    }
                }
           
            ],
			"autoWidth": true,
            'order': [[ 2, "desc" ]]
        } );
    } 


    ajaxManageList(); 
    createTable();


</script>

