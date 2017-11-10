<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<ul class="sidebar-menu">
			<?php 
				$url = explode	( '/', $_SERVER['REQUEST_URI'] ); 
				if( $url[2] === 'facebook' ){
				
			?>
			<!-- FACEBOOK MENU   -->
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
			<!-- END FACEBOOK MENU   -->
			<?php
				}
				if( $url[2] === 'twitter' ){
			?>
			<!-- TWITTER MENU   -->
			<li class="header">เมนูหลัก</li>

			<li class="treeview">
				<a href="<?php echo base_url(); ?>twitter/tweetList">
					<i class="fa fa-table "></i> <span>ทวิตทั้งหมด</span>
					<span class="pull-right-container">
					</span>
				</a>
			</li>
			
			<!-- END TWITTER MENU   -->
			<?php 
				}
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

		echo '<li class="treeview"><a href="'.base_url().'chatPage"><i class="fa fa-comment"></i> <span>ระบบแจ้งปัญหา</span><span class="pull-right-container"></span></a></li>';

	}

	?>

</ul>
</section>
<!-- /.sidebar -->
</aside>
