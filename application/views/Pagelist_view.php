<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/iCheck/all.css">
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.min.css">


<style>
    .input-box{
        width: 100%;
        margin: 10px 0px;
    }
    .link{
        max-width: 100px;
        overflow: hidden;  
        white-space: nowrap;
        text-overflow: ellipsis;        
    }
    .website{
        max-width: 100px;
        overflow: hidden;  
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Edit Tracking Page List<small> page list</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a class="btn btn-info " data-toggle="modal" data-target="#myModal">
                        <i class="fa fa-edit"></i> Add Tracking page
                    </a>
                    
                    <a class="btn btn-warning " data-toggle="modal" data-target="#createCatModal">
                        <i class="fa fa-edit"></i> Create Category
                    </a>
                </div>

                <?php
                    if( isset( $_SESSION['addPageError'] ) ){

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
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Page Name</th>
                                <th>Category</th>
                                <th>Like</th>
                                <th>To Page</th>
                                <th>Website</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php  

                        foreach( $page_list as $value )
                        {
                            if( $value->is_active ) echo '<tr>';
                            else echo '<tr style="background-color:#c0c0c0;">';

                            echo '<td class="id">'.$value->id.'</td>';

                            if( $value->is_owner )
                            {
                                echo '<td class="name"><span class="label label-warning" id="status">Owner</span>    '.$value->name.'</td>';
                            }
                            else
                            {
                                echo '<td class="name">'.$value->name.'</td>';
                            }
                            echo '<td class="category_list">'. $value->category_list.'</td>';
                            echo '<td>'.number_format( $value->fan_count ).'</td>';
                            echo '<td class="link"><a href="'.$value->link.'" target="blank">'.$value->link.'</a></td>';
                            echo '<td class="website"><a href="'.$value->website.'" target="blank">'.$value->website.'</a></td>';

                            if( $value->is_active )
                            { 
                                echo '<td class="status"><span class="label label-success" id="status">Active</span></th>'; 
                            }
                            else
                            { 
                                echo '<td class="status"><span class="label label-danger" id="status">Disable</span></th>'; 
                            }

                            if( $value->is_active ){
                                echo '<td>
                                            <a class="btn btn-xs btn-warning edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i> Edit</a>
                                            <a class="btn btn-xs btn-danger" href="'.base_url().'editPageList/toggle/'.$value->id.'/'.$value->is_active.'"><i class="fa fa-close"></i> Disable</a>
                                            </td>';
                            }
                            else{
                                echo '<td>
                                            <a class="btn btn-xs btn-warning edit" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i> Edit</a>
                                            <a class="btn btn-xs btn-success" href="'.base_url().'editPageList/toggle/'.$value->id.'/'.$value->is_active.'"><i class="fa fa-check"></i> Active</a>
                                            </td>';
                            }

                            echo '</tr>';
                        }


                        ?>
                    </table>
                </div>
            </div>
        </div>


        </div>
    </section>

</div>


</div>


<!-- Modal -->
<div class="modal modal-success fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                    <div class="input-group input-box">
                        <input type="text" name="pageName" class="form-control" placeholder="ชื่อเพจ...">
                    </div>
                    <div class="input-group input-box">
                        <select class="js-example-basic-single" id="selector-0" name="category" ></select>
                        <!-- <input type="text" name="category" class="form-control" placeholder="category..."> -->
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
<!-- Category Modal -->
<div class="modal modal-warning fade" id="createCatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Create Category : <span id="editModal_name"></span></h4>
            </div>

            <div class="modal-body">
                <form action="<?php echo base_url(); ?>editPageList/addCategory" method="post" id="modal_cat_id">
                    
                    <div class="input-group input-box">
                        <input type="text" class="form-control" name="category_list" placeholder="Category..." />
                    </div>   
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn_save" id="btn_edit_cat">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Modal -->
<div class="modal modal-warning fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                    <div class="input-group input-box">
                        <span class="input-group-addon">Category</span>
                        <select class="js-example-basic-single" id="selector-1" name="category_list"></select>
                    </div>   
                    <div class="input-group input-box">
                        <span class="input-group-addon">Link</span>
                        <input id="editModal_link" type="text" class="form-control input-lg" name="link" placeholder="Link..." />
                    </div>   

                    <div class="input-group input-box">
                        <span class="input-group-addon">Website</span>
                        <input id="editModal_website" type="text" class="form-control input-lg" name="website" placeholder="Website..." />
                    </div>
                    <br>
                    <div class="input-group input-box">
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
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/select2/select2.full.min.js"></script>

<script>
    $.ajax({
        url:  "<?php echo(base_url());?>ajaxGetPageCategory",   //the url where you want to fetch the data 
        type: 'post', //type of request POST or GET   
        dataType: 'json',
        async: false, 
        success:function(data)	
        {
            console.log(data);
            var cat_list=[];
            for (var i = 0; i < data.length; i++) 
            {
                var id = data[i].id;
                var name = data[i].name;
                cat_list.push( { id: id, text: name } );
            }
            $("#selector-0").select2({
                width: '100%',
                placeholder: 'ประเภท Category',
                minimumResultsForSearch: Infinity,
                data:cat_list
            });
            $("#selector-1").select2({
                width: '100%',
                placeholder: 'ประเภท Category',
                minimumResultsForSearch: Infinity,
                data:cat_list
            });
        }
    });

    $('.edit').on('click',function(){
        var this_p = $(this).parents('tr');
        var this_name = this_p.find('.name').text(); 
        var this_link = this_p.find('.link').text(); 
        var this_website = this_p.find('.website').text(); 
        var this_id = this_p.find('.id').text(); 
        var this_category_list = this_p.find('.category_list').text(); 
        var this_is_active = this_p.find('.status span').text(); 
        $("#editModal_id").val( this_id );
        $("#editModal_name").text( this_name );
        $("#editModal_link").val( this_link );
        $("#editModal_website").val(this_website);
        $("#editModal_is_active").val(this_is_active);
        $("#editModal_category_list").val( this_category_list );
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

    $('#btn_edit_cat').click( function(){
        $('#btn_edit_cat').prop('disabled',true);
        $('#modal_cat_id').submit();
    })
    

</script>    
</body>
</html>
