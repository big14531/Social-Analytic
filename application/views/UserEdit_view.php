<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<style>
    .table-icon{
        width:20px;
        margin: 0px;
    }
    .table-img{
        width:50px;
    }
    .full-width{
        width:100%;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Management
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

                    <div class="box-header">
                        <a class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-edit"></i> Create User
                        </a>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="display table table-bordered">
                            
                        </table>
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


    <!-- Modal -->
    <div class="modal modal-success fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create New User</h4>
                </div>

                <form id="addform-modal" class="form-horizontal" action="#">

                <div class="modal-body">

                    <div id="modal_callout" class="callout callout-info" style="margin-bottom: 0!important;">
                        <h4>หน้าต่างสร้างผูใ้ช้ใหม่</h4>
                        <p>กรุณากรอกข้อมุลให้ครบทุกช่องค่ะ</p> 
                    </div>

                    <br>

                    
                    <div class="box-body">

                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">รหัสพนักงงาน</label>

                          <div class="col-sm-10">
                            <input id="employee_id" type="text" class="form-control" id="inputEmail3" placeholder="รหัสพนักงงาน" required>
                          </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                            <input id="email" type="email" class="form-control" id="inputEmail3" placeholder="Email"  required>
                          </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                            <input id="username" type="text" class="form-control" id="inputEmail3" placeholder="Username"  required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                          <div class="col-sm-10">
                            <input id="password" type="password" class="form-control" id="inputPassword3" placeholder="Password"  required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputPassword3" class="col-sm-2 control-label">ชื่อ - นามสกุล</label>
                          <div class="col-sm-10">
                            <input id="name" type="text" class="form-control" id="inputPassword3" placeholder="ชื่อ - นามสกุล"  required>
                          </div>
                        </div>

                        <div class="col-md-4 col-md-offset-4">
                            <div class="form-group" id="check_box">

                              <div class="checkbox">
                                <label>
                                  <input id="autho_user" type="checkbox" class="icheckbox_flat-green" checked disabled>
                                  User
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input id="autho_manager" type="checkbox" class="icheckbox_flat-green">
                                  Manager
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input id="autho_admin" type="checkbox" class="icheckbox_flat-green">
                                  Admin
                                </label>
                              </div>

                            </div>
                        </div>
                    </div>
                  <!-- /.box-body -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn_save" id="btn_add">Save changes</button>
                </div>
                </form>
            </div>   

        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal modal-warning fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                </div>

                <form id="form-modal" class="form-horizontal" action="#">

                <div class="modal-body">

                    <div id="modal_callout" class="callout callout-info" style="margin-bottom: 0!important;">
                        <h4>หน้าต่างแก้ไขข้อมุลผู้ใช้</h4>
                        <p>กรุณากรอกข้อมุลให้ครบทุกช่องค่ะ</p> 
                    </div>

                    <br>

                    
                    <div class="box-body">

                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">รหัสพนักงงาน</label>

                          <div class="col-sm-10">
                            <input id="edit_employee_id" type="text" class="form-control" id="inputEmail3" placeholder="รหัสพนักงงาน" required>
                          </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                            <input id="edit_email" type="email" class="form-control" id="inputEmail3" placeholder="Email"  required>
                          </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                            <input id="edit_username" type="text" class="form-control" id="inputEmail3" placeholder="Username"  required>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputPassword3" class="col-sm-2 control-label">ชื่อ - นามสกุล</label>
                          <div class="col-sm-10">
                            <input id="edit_name" type="text" class="form-control" id="inputPassword3" placeholder="ชื่อ - นามสกุล"  required>
                          </div>
                        </div>

                        <div class="col-md-4 col-md-offset-4">
                            <div class="form-group" id="edit_check_box">

                              <div class="checkbox">
                                <label>
                                  <input id="edit_autho_user" type="checkbox" class="icheckbox_flat-green" checked disabled>
                                  User
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input id="edit_autho_manager" type="checkbox" class="icheckbox_flat-green">
                                  Manager
                                </label>
                              </div>

                              <div class="checkbox">
                                <label>
                                  <input id="edit_autho_admin" type="checkbox" class="icheckbox_flat-green">
                                  Admin
                                </label>
                              </div>

                            </div>
                        </div>

                        <input id="edit_id" type="text" class="hidden">
                    </div>
                  <!-- /.box-body -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn_save" id="btn_edit">Save changes</button>
                </div>
                </form>
            </div>   

        </div>
    </div>

    <!-- Pass Modal -->
    <div class="modal modal-danger fade" id="passModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Change Password</h4>
                </div>

                <form id="passform-modal" class="form-horizontal" action="#">

                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                          <label for="inputEmail3" class="col-sm-2 control-label">New Password</label>

                          <div class="col-sm-10">
                            <input id="new_password" type="text" class="form-control" placeholder="New Password" required>
                          </div>
                        </div>
                        <input id="pass_id" type="text" class="hidden">
                    </div>
                  <!-- /.box-body -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn_save" id="btn_pass">Save changes</button>
                </div>
                </form>
            </div>   

        </div>
    </div>

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

    function ajaxCreateTable()
    {
        $.ajax({
            url:  "<?php echo base_url()?>initialize",   //the url where you want to fetch the data 
            type: 'post', //type of request POST or GET    
            dataType: 'json',
            async: true, 
            success:function(data)
            {
                console.log(data);
                var dataset = editData( data );
                renderTable( dataset );
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
            value.user_id,
            value.employee_code,
            value.username,
            value.user_name_surname,
            value.email,
            value.permission_user+value.permission_manager+value.permission_admin,
            value.user_active,
            0
           ];
        }
        return dataset;
     }

    function createTable( data ) 
    {

        $('#example1').DataTable( {
            "paging":false,
            columns: [

                { title: "ID"  ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                         $(nTd).addClass("id");
                    }
                },
                { title: "รหัสพนักงงาน"  ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                         $(nTd).addClass("employee_id");
                    }
                },
                { title: "Username"  ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                         $(nTd).addClass("username");
                    }
                },
                { title: "Name"  ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                         $(nTd).addClass("name");
                    }
                },
                { title: "Email"  ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).addClass("email");
                    }
                },
                { title: "Authorization"  ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).addClass("authorization");
                        if( sData[0]==1 )
                        {
                         $(nTd).html("<span class='label label-info' id='status'>User</span>");
                        }
                        if( sData[1]==1 )
                        {
                         $(nTd).html("<span class='label label-success' id='status'>Manager</span>");
                        }   
                        if( sData[2]==1 )
                        {
                         $(nTd).html("<span class='label label-danger' id='status'>Admin</span>");
                        }    
                    }
                },
                { title: "Status" ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).addClass("status");

                        if( sData==1 )
                        {
                         $(nTd).html("<span class='label label-success' id='status'>Active</span>");
                        }
                        else
                        {
                        $(nTd).html("<span class='label label-danger' id='status'>Disable</span>");
                        $(nTd).parent().css('background-color','#c0c0c0');
                        }
                    }
                },
                { title: "Command" ,
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        
                         $(nTd).html('<a class="btn btn-xs btn-warning edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i> Edit</a>');
                         $(nTd).append(' <a class="btn btn-xs btn-success changePass" data-toggle="modal" data-target="#passModal"><i class="fa fa-edit"></i> Change Password</a>');

                         if( oData[5][2]==1 )
                         {
                         $(nTd).append('');
                         }
                         else if( oData[6]==1 )
                         {
                         $(nTd).append(' <a class="btn btn-xs btn-danger" href="'+'<?=base_url()?>'+'editActiveUser/'+oData[0]+'/'+oData[6]+'"><i class="fa fa-check"></i> Disable</a>');
                         }
                         else
                         {
                         $(nTd).append(' <a class="btn btn-xs btn-success" href="'+'<?=base_url()?>'+'editActiveUser/'+oData[0]+'/'+oData[6]+'"><i class="fa fa-check"></i> Active</a>');                        
                         }

                    }
                }
           
            ],
            "iDisplayLength": 30,
            'order': [[ 5, "desc" ]]
        } );
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

    ajaxCreateTable();
    createTable();


</script>

</body>
</html>