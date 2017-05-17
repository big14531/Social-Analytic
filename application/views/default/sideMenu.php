<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            
            <!-- Main menu -->
            <li class="header">เมนูหลัก</li>


            <li class="treeview">
                <a href="<?php echo base_url(); ?>socialDeck">
                    <i class="fa fa-facebook"></i> <span>ฟีด เฟสบุ๊ค</span>
                    <span class="pull-right-container">
                        <!-- <small class="label pull-right bg-green">16</small> -->
                    </span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo base_url(); ?>dashboard">
                    <i class="fa fa-dashboard"></i> <span>รายละเอียดเพจ</span>
                    <span class="pull-right-container">
                        <!-- <small class="label pull-right bg-green">16</small> -->
                    </span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo base_url(); ?>growthPage">
                    <i class="fa fa-line-chart"></i> <span>กราฟภาพรวม</span>
                    <span class="pull-right-container">
                        <!-- <small class="label pull-right bg-green">16</small> -->
                    </span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo base_url(); ?>rankPosts">
                    <i class="fa fa-trophy"></i> <span>จัดอันดับโพสต์</span>
                    <span class="pull-right-container">
                        <!-- <small class="label pull-right bg-green">16</small> -->
                    </span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo base_url(); ?>summaryTable">
                    <i class="fa fa-calendar"></i> <span>ตารางข้อมูลต่อเวลา</span>
                    <span class="pull-right-container">
                        <!-- <small class="label pull-right bg-green">16</small> -->
                    </span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo base_url(); ?>postGraph">
                    <i class="fa fa-dot-circle-o "></i> <span>กราฟเวลาโพสต์</span>
                    <span class="pull-right-container">
                        <!-- <small class="label pull-right bg-green">16</small> -->
                    </span>
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url(); ?>postList">
                    <i class="fa fa-list-ul"></i> <span>โพสต์ทั้งหมด</span>
                    <span class="pull-right-container">
                        <!-- <small class="label pull-right bg-green">16</small> -->
                    </span>
                </a>
            </li>
            
            <li class="treeview">
                <a href="<?php echo base_url(); ?>showPageTable">
                    <i class="fa fa-table"></i> <span>เพจทั้งหมด</span>
                    <span class="pull-right-container">
                        <!-- <small class="label pull-right bg-green">16</small> -->
                    </span>
                </a>
            </li>
 
            
            <!-- Action menu -->
            <li class="header">แอดมิน</li>

            <?php 
            // echo $_SESSION['permission_admin'];
            if ($_SESSION['permission_manager']) 
            {
                echo '<li class="treeview">
                    <a href="'.base_url().'editPageList">
                        <i class="fa fa-edit"></i> <span>จัดการเพจ</span>
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
