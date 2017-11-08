<!-- This file is importing javascript file -->


<!--  <div class="wrapper"> -->
</div>

<div class="chat-box">
    <button data-toggle="collapse" data-target="#chat-box" type="button" class="btn btn-primary btn-lg chat-button"><i class="fa fa-commenting" data-toggle='chat-box'></i><span>ติดต่อ</span></button>
    <div id="chat-box" class="box box-primary direct-chat direct-chat-primary collapse ">
        <div class="box-header with-border">
            <h3 class="box-title">ติดต่อ-แจ้งปัญหา</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-target="#chat-box" data-toggle="collapse" ><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div id="message-box" class="direct-chat-messages">
                <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                        <span class="direct-chat-name pull-left">Admin</span>
                    </div>
                    <i class="fa fa-cogs direct-chat-img"></i>
                    <div class="direct-chat-text">
                        สวัสดีครับ หากติดปัญหาเรื่องการใช้งาน หรือมีข้อมุลสอบถาม สามารถถามในช่องแชทได้เลยครับ
                    </div>
                </div>
            </div>
        </div>

        <div class="box-footer">
            
			<form id="message-form" action="#" method="post">
                <div class="input-group">
                <input type="text" name="message" placeholder="Type Message ..." class="form-control" id="input-message-box" autocomplete="off">
                <span class="input-group-btn">
                    <button type="submit" id="send-button" class="btn btn-primary btn-flat">Send</button>
                </span>
                </div>
            </form>
        </div>
        <!-- /.box-footer-->
    </div>
</div>


<!-- Social-Analytic JS -->
<script src="<?php echo(base_url());?>assets/js/social-analytic.js"></script>
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
<!-- DataTables -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/datatables/extensions/FixedColumns/js/dataTables.fixedColumns.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
<!-- FLOT CHARTS -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.pie.min.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.categories.min.js"></script>
<!-- FLOT selection -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.selection.js"></script>
<!-- FLOT TIME CHARTS -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.time.js"></script>
<!-- FLOT STACK CHARTS -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.stack.js"></script>
<!-- FLOT BAR NUMBER -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/flot/jquery.flot.barnumbers.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/datepicker/bootstrap-datepicker.js"></script>




<script>
	function addRightChatText( text ) 
	{
        var html = '<div class="direct-chat-msg right">'+
							'<div class="direct-chat-info clearfix">'+
							'</div>'+
							'<i class="fa fa-user direct-chat-img"></i>'+
							'<div class="direct-chat-text">'+
                                text+
							'</div>'+
						'</div>';
		$('#message-box').append( html );
        $('#message-box').animate({
        scrollTop: $('#message-box')[0].scrollHeight}, 2000);
						
	}
    function addLeftChatText( text ) 
	{
        var html = '<div class="direct-chat-msg">'+
                        '<div class="direct-chat-info clearfix">'+
                        '</div>'+
                        '<img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image">'+
                        '<div class="direct-chat-text">'+
                            text+
                        '</div>'+
                    '</div>';
		$('#message-box').append( html );
		
						
	}
	$(document).ready( function() 
	{
        $('#message-form').submit(function () {
            var text = $('#input-message-box').val();
            $('#input-message-box').val('');
			addRightChatText( text );

            return false;
        });
		
	});
</script>