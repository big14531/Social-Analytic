
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


<script>

    var message_id = [];

	function addChatText( text ) 
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

    function renderMessage( data ) 
    {
        data.forEach(function(element) {
            addChatText( element.text );
            message_id.push( element.id )
        }, this);
    }

    function ajaxSendChat( text ) 
    {
        $.ajax({
			url:  "<?php echo(base_url());?>ajaxSendChat",   //the url where you want to fetch the data 
			type: 'post', //type of request POST or GET   
			dataType: 'json',
			async: true, 
            data : {
                'text' : text
            },
			success:function(data)	
			{
                console.log(data);
			}
		});
    }

    function ajaxGetChat( text ) 
    {
        $.ajax({
			url:  "<?php echo(base_url());?>ajaxGetChat",   //the url where you want to fetch the data 
			type: 'post', //type of request POST or GET   
			dataType: 'json',
			async: true, 
			success:function(data)	
			{
                data.sort( function(a, b){
                    return a.id-b.id;
                });
                console.log( data );
                renderMessage( data ); 
			}
		});
    }


	$(document).ready( function() 
	{
        $('#message-form').submit(function () {
            var text = $('#input-message-box').val();
            $('#input-message-box').val('');
            ajaxSendChat( text );
			addChatText( text );
            return false;
        });
        ajaxGetChat();
	});

   
</script>