<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu' ) ?>

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/iCheck/all.css">

<style>
    .btn-info{
        margin-bottom:10px;
    }
    .container-box{
        padding: 0 20px 20px;
    }
    /* Style the tab */
    div.tab {
        float: left;
        width: 20%;
        min-height: 300px;
    }

    /* Style the buttons inside the tab */
    div.tab button {
        display: block;
        background-color: inherit;
        color: black;
        padding: 22px 16px;
        width: 100%;
        border: none;
        outline: none;
        text-align: left;
        cursor: pointer;
        transition: 0.1s;
    }

    /* Change background color of buttons on hover */
    div.tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current "tab button" class */
    div.tab button.active {
        background-color: #bbb;
    }

    /* Style the tab content */
    .tabcontent {
        float: left;
        padding: 0px 12px;
        border: 1px solid #ccc;
        width: 80%;
        min-height: 300px;
    }
    .table>tbody>tr>td{
        vertical-align: middle;
    }
    .control-box{
        padding: 3px;
        background-color: #ddd;
    }
    .control-btn{
        padding: 5px 10px;
        font-size: 0.8em;
    }
    .fb-tab{
        
    }
    .nav-tab-custom{
        width: 190px;
        text-align: center;
    }
    .create-modal-body {
        padding: 0px;
    }
    .nav-tabs-custom>.nav-tabs>li {
        margin-bottom: -2px;
    }
    .nav-tabs-custom>.tab-content {
        background: #ddd;
        padding: 20px;
    }
    .nav-tabs-custom>.nav-tabs>li.active>a {
        background: #ddd;
        font-weight: 600;
    }
    .nav-tabs-custom>.nav-tabs>li.active>a, .nav-tabs-custom>.nav-tabs>li.active:hover>a {
        background: #ddd;
    }
    .register-btn{
        background-color: #3d8dbc;
        color: #ededed;
        border-color: #ddd;
        border-radius: 20px;
    }
    .facebook-btn{
        background-color: #3b5998;
        color: #f7f7f7;
    }
    .facebook-btn:hover , .facebook-btn:focus{
        background-color: #8b9dc3;
        color: #f7f7f7;
    }
    .facebook-btn-icon{
        color: #f7f7f7;
    }
</style>    

<div class="content-wrapper">

    <section class="content">
        <div class="col-lg-10 col-lg-offset-1">
            <div class="box container-box">
                <div class="box-header">    
                    <h1>
                        Profile Management <small> จัดการโปรไฟล์ทั้งหมด</small>
                    </h1>
                </div>
                <!-- /.box-header -->
                <div id="box-body" class="box-body"> 
                    <div class="tab" id="control-tab">
                        <div class="control-box">
                            <div class="btn control-btn" id="create-profile"><i class="fa fa-plus"> สร้าง</i></div>
                            <div class="btn control-btn" id="delete-profile"><i class="fa fa-minus"> ลบ</i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="createModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><span class="fa fa-user-plus"></span> Create Profile</h4>
                </div>
                <div class="modal-body create-modal-body">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active nav-tab-custom"><a href="#tab_2" data-toggle="tab">Create by myself</a></li>
                            <li class="nav-tab-custom"><a href="#tab_1" data-toggle="tab">Connect with Account</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="tab_2">
                                <?php echo validation_errors(); ?>
                                <?php echo form_open('Home_ctrl/createProfile'); ?>
                                    <div class="form-group has-feedback">
                                        <input name="profile_name" class="form-control" placeholder="Profile Name" required>
                                        <span class="fa fa-envelope form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <input name="fb_mypage" class="form-control" placeholder="Owner Page">
                                        <span class="fa fa-envelope form-control-feedback"></span>
                                    </div>
                                    <input name="user_id" hidden value="<?=$_SESSION['login_user_id']?>">
                                    <button class="btn btn-default btn-block register-btn" type="submit">Submit</button>
                                </form>
                            </div>
                            <div class="tab-pane" id="tab_1">
                                <button class="btn btn-default btn-block facebook-btn" type="submit">
                                    <i class="facebook-btn-icon fa  fa-facebook-official"></i> Connect with facebook
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4><span class="fa fa-user-plus"></span> Delete Profile</h4>
                </div>
                <div class="modal-body">
                    <p id="delete-text">ยืนยันที่จะลบ Profile ?</p>
                    <p id="profile_name"></p>
                    <?php echo validation_errors(); ?>
                    <?php echo form_open('Home_ctrl/deleteProfile'); ?>
                        <input id="delete_user_id" name="user_id" hidden value="<?=$_SESSION['login_user_id']?>">
                        <input id="delete_profile_id" name="profile_id" hidden value="">
                        <button class="btn btn-default register-btn" type="submit" id="delete_btn">Submit</button>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery 2.2.3 -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo(base_url());?>assets/admin-lite/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck for checkboxes and radio inputs -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/iCheck/icheck.min.js"></script>

<script>
    function renderButton( data ) 
    {
        data.forEach(function(element) {
            var profile_id = element.id;
            var profile_name = element.profile_name;
            var html = '<button profileID="'+profile_id+'" class="tablinks" onclick="openTab(event, '+"'"+profile_id+"_table'"+')">'+profile_name+'</button>';
            $("#control-tab").append( html );
        }, this);
       
    }

    function renderRow( data , profile_id )
    {
        var myTable = "#"+profile_id+"_table";
        $(myTable).find('table').append( '<tr class="separator-tab fb-tab">'+
                                            '<td colspan="5"><i class="fa fa-facebook"></i></td>'+
                                        '</tr>' );

        data.forEach(function(element) {  
            var html = '<tr>'+
                            '<td><img src="'+element.picture+'"></td>'+
                            '<td>'+element.name+'</td>'+
                            '<td>'+element.fan_count+'</td>'+
                            '<td><i class="fa fa-thumb-up"></i></td>'+
                            '<td>my page</td>'+
                        '</tr>';
            $(myTable).find('table ').append( html );
        }, this);

    }

    function renderTab( data ) 
    {
        data.forEach(function(element) {  
            var profile_id = element.id;  
            var html =  '<div id="'+profile_id+'_table" class="tabcontent">'+
                            '<table class="table">'+
                            '</table>'+
                        '</div>';
            $("#box-body").append( html );
            renderRow( element.page_list , profile_id );
        }, this);
    }
  
    function ajaxPagelist()
	{
        var user_id = <?=$this->session->all_userdata()['login_user_id'];?>;
		$.ajax({
				url:  "<?php echo(base_url());?>ajaxProfileAll",   //the url where you want to fetch the data 
				type: 'post', //type of request POST or GET   
				dataType: 'json',
				async: true, 
				data: { 
					'user_id': user_id
				},
				success:function(data)	
				{
                    console.log( data );
					renderButton(data);
                    renderTab(data);
                    hideTab();
				}
			});
	}

    function openTab(evt, cityName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the link that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    ajaxPagelist();

    function hideTab() {
        $("#box-body").find('.tabcontent').not(":first").attr('hidden',true);
    }
   


    $('#create-profile').on( 'click' , function(){
        $("#createModal").modal()
    });

    $('#delete-profile').on( 'click' , function(){
        $("#deleteModal").modal();
        var profild_id =  $("#control-tab").find('.active').attr('profileid');
        if ( typeof profild_id !==  "undefined" ) {
            var profile_name = $("#control-tab").find('.active').text()
            $('#delete_profile_id').val( profild_id );
            $('#delete-text').text( 'ยืนยันที่จะลบ Profile ?' );
            $('#profile_name').text( profile_name );
            $('#delete_btn').attr('hidden' , false );
        }
        else{
            $('#delete-text').text( 'กรุณาเลือก Profile ที่ต้องการลบ' );
            $('#profile_name').text( '' );
            $('#delete_btn').attr('hidden' , true );
        }
    });

</script>    
</body>
</html>
