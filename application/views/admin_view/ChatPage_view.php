<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu') ?>

<link rel="stylesheet" href="<?php echo(base_url());?>assets/css/feed-style.css?version=<?=time();?>">
<style>
    .user-list{
        background-color: #222d32;
        height: 85vh;
        overflow:auto;
    }
    .message-admin-box{
        background-color: #222d32;
        height: 85vh;
    }
    .message-admin-box>.box{
        height: 100%;
    }
    .message-admin-box>.box>.box-body{
        height: 94%;
    }
    .message-admin-box>.box>.box-body>.direct-chat-messages{
        height: 100%;
    }
    .list-box li {
        border-bottom: 1px solid #656565;
        color: #FFF; 
        padding: 10px 15px;
    }
    .list-box li:hover {
        border-bottom: 1px solid #656565;
        background: #8a8a8a;
    }
    .user-profile-image {
        display: inline-block;
        border-radius: 50%;
        float:left;
    }
    .user-name-box{
        padding: 0px 10px;
        width:80%;
        float:left;
    }
    .recent-message-box{
        color: #999;
        padding: 0px 10px;
        width: 80%;
        float: left;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<!-- Content Zone -->
<div class="content-wrapper">

    <section class="content-header">
		<h1>
			ระบบแก้ปัญหา USER 
		</h1>
	</section>

	<section class="content"> 
        <div class="col-md-3">
            <div class="user-list mCustomScrollbar">
                <ul class="list-box">
                    <?php 
                        for ($i=0; $i <20 ; $i++) { 
                       ?>
                    <li> 
                        <img  class="user-profile-image" src="https://scontent.xx.fbcdn.net/v/t1.0-1/p50x50/22894473_10156018994464668_4314307410210327351_n.jpg?oh=13ca99663c61c639836ae9c940660119&oe=5A9F3832    " alt="">
                        <div class="user-name-box">ADMIN</div>
                        <div class="recent-message-box">hello guy o day is dflsd;fs hello guy o day is dflsd;fs</div>
                    </li> 
                    <?php 
                        }
                       ?>     
                </ul>       
            </div>
        </div>
        <div class="col-md-9">
            <div class="message-admin-box">
                <div class="box admin-message-box">
                    <div class="box-body">
                        <div id="message-admin-zone" class="direct-chat-messages">
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
        </div>
	</section>
</div>

<?php $this->load->view( 'default/bottom' ) ?>


</body>
</html>