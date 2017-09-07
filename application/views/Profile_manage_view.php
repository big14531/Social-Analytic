<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/iCheck/all.css">

<style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
        vertical-align: middle!important;
    }
    .btn-info{
        margin-bottom:10px;
    }
    .container-box{
        padding: 0 20px 20px;
    }
</style>    

<div class="content-wrapper">

    <section class="content">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="box container-box">
                <div class="box-header">    
                    <h1>
                        Profile Management<small>เพิ่ม/ลบ โปรไฟล์ทั้งหมด</small>
                    </h1>
                    

                </div>

                <?php
                if (isset( $_SESSION['addPageError'] )) {
                    echo '<div class="box-body">';
                    echo '<div class="alert alert-danger alert-dismissible">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    echo '<h4><i class="icon fa fa-ban"></i> Alert!</h4>';
                    echo '<b>'.$_SESSION["addPageError"].'</b>';
                    echo '<br>ข้อมูลไม่ถูกต้อง กรุณากรอกชื่อเพจใหม่ ';
                    echo '</div>';
                    echo '</div>';

                    unset(  $_SESSION['addPageError'] );
                }

                ?>
                <!-- /.box-header -->
                <div class="box-body"> 
                    <a class="btn btn-info" data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-edit"></i> Create Profile
                    </a>
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Facebook</th>
                                <th>Twitter</th>
                                <th>Last Active</th>
                                <th></th>
                            </tr>
                        </thead>

                        <?php
                        foreach ($profile_list as $value) {
                            
                            echo '<td class="name">'.$value->name.'</td>';
                            
                            echo '<td></td>';
                            echo '<td></td>';
                            echo '<td></td>';

                            echo '<td>
                                <a class="btn btn-xs btn-warning edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i> Edit</a>
                                </td>';

                            echo '</tr>';
                        }
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </section>

</div>


</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Tracking Page</h4>
            </div>

            <div class="modal-body">
                <h2> ใส่ชื่อของ Page</h2>
                <div class="callout callout-info" style="margin-bottom: 0!important;">
                    <h4><i class="fa fa-info"></i> Note:</h4>
                    <span> 
                        ชื่อต้องมาจาก url ของหน้า Page นั้นๆ เช่น  <br>

                        https://www.facebook.com/<b>komchadluek</b>/?ref=ts&fref=ts <br><br>ชื่อที่ต้องใส่คือ<h4> <b>komchadluek</b></h4>
                    </span> 
                </div>

                <br>

                <form action="<?php echo base_url(); ?>editPageList/save" method="post" id="modal_add_id">
                    <div class="input-group">
                        <input type="text" name="pageName" class="form-control input-lg" placeholder="Page Name...">

                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn_save" id="btn_add">Save changes</button>
                </div>
                </form>
            </div>   

        </div>
    </div>
</div>



<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Page : <span id="editModal_name"></span></h4>
            </div>

            <div class="modal-body">

                <form action="<?php echo base_url(); ?>editPageList/edit" method="post" id="modal_edit_id">
                    <input id="editModal_is_active" name="is_active" hidden />
                <input id="editModal_id" name="page_id" hidden />
            <div class="input-group">
                <span class="input-group-addon">Link</span>
                <input id="editModal_link" type="text" class="form-control input-lg" name="link" placeholder="Link..." />
            </div>   

            <div class="input-group">
                <span class="input-group-addon">Website</span>
                <input id="editModal_website" type="text" class="form-control input-lg" name="website" placeholder="Website..." />
            </div>
            <br>
            <div class="input-group">
                <input type="checkbox" class="icheckbox_flat-green" name="is_owner" id="editModal_is_owner">
                <span>Owner</span>
            </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary btn_save" id="btn_edit">Save changes</button>
        </div>
        </form>
        </div>
</div>
</div>
</div>




<!-- jQuery 2.2.3 -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo(base_url());?>assets/admin-lite/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo(base_url());?>assets/admin-lite/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo(base_url());?>assets/admin-lite/dist/js/demo.js"></script>
<!-- iCheck for checkboxes and radio inputs -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/iCheck/icheck.min.js"></script>


<script>

    $('.edit').on('click',function(){
        var this_p = $(this).parents('tr');
        var this_name = this_p.find('.name').text(); 
        var this_link = this_p.find('.link').text(); 
        var this_website = this_p.find('.website').text(); 
        var this_id = this_p.find('.id').text(); 
        var this_is_active = this_p.find('.status span').text(); 

        $("#editModal_id").val( this_id );
        $("#editModal_name").text( this_name );
        $("#editModal_link").val( this_link );
        $("#editModal_website").val(this_website);
        $("#editModal_is_active").val(this_is_active);

        if( this_name.search('Owner')==0)
        { 
            $('#editModal_is_owner').iCheck('check'); 
        }
        else { 
            $('#editModal_is_owner').iCheck('uncheck');  
        }
    });

    $('#btn_edit').click( function(){
        $('#btn_edit').prop('disabled',true);
        $('#modal_edit_id').submit();
    })

    $('#btn_add').click( function(){
        $('#btn_add').prop('disabled',true);
        $('#modal_add_id').submit();
    })

</script>    
</body>
</html>
