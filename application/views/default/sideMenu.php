<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<div class="chat-box">
			<button data-toggle="collapse" data-target="#chat-box" type="button" class="btn btn-primary btn-lg chat-button"><i class="fa fa-commenting" data-toggle='chat-box'></i><span>ติดต่อ</span></button>
			<div id="chat-box" class="box box-primary direct-chat direct-chat-primary collapse ">
				<div class="box-header with-border">
					<h3 class="box-title">ติดต่อ-แจ้งปัญหา</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-target="#chat-box" data-toggle="collapse" ><i class="fa fa-times"></i></button>
					</div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
				<!-- Conversations are loaded here -->
				<div class="direct-chat-messages">
					<!-- Message. Default to the left -->
					<div class="direct-chat-msg">
						<div class="direct-chat-info clearfix">
							<span class="direct-chat-name pull-left">Alexander Pierce</span>
							<span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
						</div>
						<!-- /.direct-chat-info -->
						<img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
						<div class="direct-chat-text">
							Is this template really for free? That's unbelievable!
						</div>
					<!-- /.direct-chat-text -->
					</div>
					<!-- /.direct-chat-msg -->

					<!-- Message to the right -->
					<div class="direct-chat-msg right">
					<div class="direct-chat-info clearfix">
						<span class="direct-chat-name pull-right">Sarah Bullock</span>
						<span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
					</div>
					<!-- /.direct-chat-info -->
					<img class="direct-chat-img" src="../dist/img/user3-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
					<div class="direct-chat-text">
						You better believe it!
					</div>
					<!-- /.direct-chat-text -->
					</div>
					<!-- /.direct-chat-msg -->
				</div>
				<!--/.direct-chat-messages-->

				<!-- Contacts are loaded here -->
				<div class="direct-chat-contacts">
					<ul class="contacts-list">
					<li>
						<a href="#">
						<img class="contacts-list-img" src="../dist/img/user1-128x128.jpg" alt="User Image">

						<div class="contacts-list-info">
								<span class="contacts-list-name">
								Count Dracula
								<small class="contacts-list-date pull-right">2/28/2015</small>
								</span>
							<span class="contacts-list-msg">How have you been? I was...</span>
						</div>
						<!-- /.contacts-list-info -->
						</a>
					</li>
					<!-- End Contact Item -->
					</ul>
					<!-- /.contatcts-list -->
				</div>
				<!-- /.direct-chat-pane -->
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
				<form action="#" method="post">
					<div class="input-group">
					<input type="text" name="message" placeholder="Type Message ..." class="form-control">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-primary btn-flat">Send</button>
						</span>
					</div>
				</form>
				</div>
				<!-- /.box-footer-->
			</div>
		</div>

		<ul class="sidebar-menu">
			
			<!-- Main menu -->
			<li class="header">เมนูหลัก</li>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-desktop"></i> <span>ระบบเรียลไทม์</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="treeview">
						<a href="<?php echo base_url(); ?>facebook/socialDeck">
							<i class="fa fa-feed"></i> <span>ติดตาม 4 เพจ</span>
							<span class="pull-right-container">
								<!-- <small class="label pull-right bg-green">16</small> -->
							</span>
						</a>
					</li>
				
					<li class="treeview">
						<a href="<?php echo base_url(); ?>facebook/allFeed">
							<i class="fa fa-eye"></i> <span>ติดตามรวม</span>
							<span class="pull-right-container">
								<!-- <small class="label pull-right bg-green">16</small> -->
							</span>
						</a>
					</li>
					<li class="treeview">
						<a href="<?php echo base_url(); ?>facebook/rankPosts">
							<i class="fa fa-trophy"></i> <span>จัดอันดับโพสต์</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>
					<li class="treeview">
						<a href="<?php echo base_url(); ?>facebook/trends">
							<i class="fa fa-heartbeat"></i> <span>Trends ต่อวัน</span>
							<span class="pull-right-container">
							</span>
						</a>
					</li>
				</ul>
				
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-table"></i> <span>ตารางทั้งหมด</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">

					<li class="treeview">
						<a href="<?php echo base_url(); ?>facebook/postList">
							<i class="fa fa-comments"></i> 
							<span>โพสต์ทั้งหมด</span>
							<span class="pull-right-container">
								<!-- <small class="label pull-right bg-green">16</small> -->
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="<?php echo base_url(); ?>facebook/showPageTable">
							<i class="fa fa-flag"></i> <span>เพจทั้งหมด</span>
							<span class="pull-right-container">
								<!-- <small class="label pull-right bg-green">16</small> -->
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="<?php echo base_url(); ?>facebook/analyticList">
							<i class="fa fa-object-ungroup"></i> <span>ตารางเปรียบเทียบโพสต์</span>
							<span class="pull-right-container">
								<!-- <small class="label pull-right bg-green">16</small> -->
							</span>
						</a>
					</li>

					<li class="treeview">
						<a href="<?php echo base_url(); ?>facebook/summaryTable">
							<i class="fa fa-calendar"></i> <span>ตารางข้อมูลต่อเวลา</span>
							<span class="pull-right-container">
								<!-- <small class="label pull-right bg-green">16</small> -->
							</span>
						</a>
					</li>
				</ul>
			</li>

			<li class="treeview">
				<a href="<?php echo base_url(); ?>facebook/ownerDashboard">
					<i class="fa fa-home" aria-hidden="true"></i> <span>แดชบอร์ด คมชัดลึก</span>
					<span class="pull-right-container">
						<!-- <small class="label pull-right bg-green">16</small> -->
					</span>
				</a>
			</li>

			<li class="treeview">
				<a href="<?php echo base_url(); ?>facebook/dashboard">
					<i class="fa fa-dashboard"></i> <span>แดชบอร์ด อื่นๆ</span>
					<span class="pull-right-container">
						<!-- <small class="label pull-right bg-green">16</small> -->
					</span>
				</a>
			</li>

			<li class="treeview">
				<a href="<?php echo base_url(); ?>facebook/growthPage">
					<i class="fa fa-line-chart"></i> <span>กราฟภาพรวม</span>
					<span class="pull-right-container">
						<!-- <small class="label pull-right bg-green">16</small> -->
					</span>
				</a>
			</li>


			<li class="treeview">
				<a href="<?php echo base_url(); ?>facebook/postGraph">
					<i class="fa fa-dot-circle-o "></i> <span>กราฟเวลาโพสต์</span>
					<span class="pull-right-container">
						<!-- <small class="label pull-right bg-green">16</small> -->
					</span>
				</a>
			</li>

			<?php 
			// echo $_SESSION['permission_admin'];
			if ($_SESSION['permission_manager']) 
			{
				echo '
				<li class="header">แอดมิน</li>
				<li class="treeview">
				<a href="'.base_url().'editPageList">
					<i class="fa fa-edit"></i> <span>จัดการเพจทั้งหมด</span>
					<span class="pull-right-container">
						<!-- <small class="label pull-right bg-green">16</small> -->
					</span>
				</a>
			</li>';

			echo '<li class="treeview">
			<a href="'.base_url().'postManageList">
				<i class="fa fa-tasks"></i> <span>จัดการโพสต์</span>
				<span class="pull-right-container">
					<!-- <small class="label pull-right bg-green">16</small> -->
				</span>
			</a>
		</li>';
	}
	?>


	<?php 
			// echo $_SESSION['permission_admin'];
	if ($_SESSION['permission_admin']) {
		echo '<li class="treeview"><a href="userPage"><i class="fa fa-user"></i> <span>จัดการผู้ใช้งาน</span><span class="pull-right-container"></span></a></li>';

	}

	?>

</ul>
</section>
<!-- /.sidebar -->
</aside>

<script>
	$(document).ready(function() 
	{
		
	});
</script>