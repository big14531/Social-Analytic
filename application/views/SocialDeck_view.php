<?php $this->load->view( 'default/header' ) ?>
<?php $this->load->view( 'default/topMenu' ) ?>
<?php $this->load->view( 'default/sideMenu') ?>


<!-- Internal CSS Zone -->
<style>
html,body{ margin:0; padding:0; height:100%; width:100%; }
	.content{
		padding: 0px;
		padding-left: 10px;
		padding-right: 30px;
		margin:0px;
	}	
	.page-logo{
		width: 40px;
		margin-right: 10px; 
	}
	.gray-box{
		margin: 5px;
	}
	.box-header{
		background-color: #222d32;
	}
	.box-body{
		height: 100%;
	}
	.feed-col{
		padding-right: 0px;
		padding-left:5px;
		height: 100%!important;
	}
</style>

<link rel="stylesheet" href="<?php echo(base_url());?>assets/css/feed-style.css?version=3">
<link rel="stylesheet" href="<?php echo(base_url());?>assets/css/jquery.mCustomScrollbar.min.css">

<!-- Content Zone -->
<div class="content-wrapper">

	<section class="content"> 
		<div class="row">

			<div class="col-xs-3 feed-col">
				<div class="box gray-box">
					<div class="box-header">
						<img class="page-logo" src="https://scontent.xx.fbcdn.net/v/t1.0-1/14633025_10154714845219668_8361881400074819233_n.jpg?oh=6ec8035438f289abcc26665bdc3721a3&oe=5983BFC1"><h2 class="box-title">คมชัดลึก</h2>
					</div>
					<div class="box-body">
						<ul class="list-box mCustomScrollbar">
							<?php for($i=1;$i<30;$i++){ ?>
							<li>
								<a href="#" class="user-pic"><img src="images/thaipbs.jpg" alt=""></a>
								<div class="list-right">
									<p class="list-name">Username<span class="list-date">11/11/2017</span></p>
									<div class="list-txt">
										Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
									</div>

									<div class="list-social">
										<div class="like social-icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span>10</span></div>
										<div class="comment social-icon"><i class="fa fa-comment" aria-hidden="true"></i><span>20</span></div>
										<div class="shared social-icon"><i class="fa fa-share" aria-hidden="true"></i><span>100</span></div>
									</div>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-xs-3 feed-col">
				<div class="box gray-box">
					<div class="box-header">
						<img class="page-logo" src="https://scontent.xx.fbcdn.net/v/t1.0-1/14633025_10154714845219668_8361881400074819233_n.jpg?oh=6ec8035438f289abcc26665bdc3721a3&oe=5983BFC1"><h2 class="box-title">คมชัดลึก</h2>
					</div>
					<div class="box-body">
						<ul class="list-box mCustomScrollbar">
							<?php for($i=1;$i<30;$i++){ ?>
							<li>
								<a href="#" class="user-pic"><img src="images/thaipbs.jpg" alt=""></a>
								<div class="list-right">
									<p class="list-name">Username<span class="list-date">11/11/2017</span></p>
									<div class="list-txt">
										Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
									</div>

									<div class="list-social">
										<div class="like social-icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span>10</span></div>
										<div class="comment social-icon"><i class="fa fa-comment" aria-hidden="true"></i><span>20</span></div>
										<div class="shared social-icon"><i class="fa fa-share" aria-hidden="true"></i><span>100</span></div>
									</div>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-xs-3 feed-col">
				<div class="box gray-box">
					<div class="box-header">
						<img class="page-logo" src="https://scontent.xx.fbcdn.net/v/t1.0-1/14633025_10154714845219668_8361881400074819233_n.jpg?oh=6ec8035438f289abcc26665bdc3721a3&oe=5983BFC1"><h2 class="box-title">คมชัดลึก</h2>
					</div>
					<div class="box-body">
						<ul class="list-box mCustomScrollbar">
							<?php for($i=1;$i<30;$i++){ ?>
							<li>
								<a href="#" class="user-pic"><img src="images/thaipbs.jpg" alt=""></a>
								<div class="list-right">
									<p class="list-name">Username<span class="list-date">11/11/2017</span></p>
									<div class="list-txt">
										Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
									</div>

									<div class="list-social">
										<div class="like social-icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span>10</span></div>
										<div class="comment social-icon"><i class="fa fa-comment" aria-hidden="true"></i><span>20</span></div>
										<div class="shared social-icon"><i class="fa fa-share" aria-hidden="true"></i><span>100</span></div>
									</div>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-xs-3 feed-col">
				<div class="box gray-box">
					<div class="box-header">
						<img class="page-logo" src="https://scontent.xx.fbcdn.net/v/t1.0-1/14633025_10154714845219668_8361881400074819233_n.jpg?oh=6ec8035438f289abcc26665bdc3721a3&oe=5983BFC1"><h2 class="box-title">คมชัดลึก</h2>
					</div>
					<div class="box-body">
						<ul class="list-box mCustomScrollbar">
							<?php for($i=1;$i<30;$i++){ ?>
							<li>
								<a href="#" class="user-pic"><img src="images/thaipbs.jpg" alt=""></a>
								<div class="list-right">
									<p class="list-name">Username<span class="list-date">11/11/2017</span></p>
									<div class="list-txt">
										Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
									</div>

									<div class="list-social">
										<div class="like social-icon"><i class="fa fa-thumbs-up" aria-hidden="true"></i><span>10</span></div>
										<div class="comment social-icon"><i class="fa fa-comment" aria-hidden="true"></i><span>20</span></div>
										<div class="shared social-icon"><i class="fa fa-share" aria-hidden="true"></i><span>100</span></div>
									</div>
								</div>
							</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>



<?php $this->load->view( 'default/bottom' ) ?>
<script src="<?php echo(base_url());?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script>

</script>

</body>
</html>