<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            
            <!-- Main menu -->
            <li class="header">MAIN MENU</li>

            <li class="treeview">
                <a href="<?php echo base_url(); ?>growthPage">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <!-- <small class="label pull-right bg-green">16</small> -->
                    </span>
                </a>
            </li>

            <li class="treeview">
                <a href="<?php echo base_url(); ?>postGraph">
                    <i class="fa fa-line-chart"></i> <span>Post Graph</span>
                    <span class="pull-right-container">
                        <!-- <small class="label pull-right bg-green">16</small> -->
                    </span>
                </a>
            </li>
            <li class="treeview">
                <a href="<?php echo base_url(); ?>postList">
                    <i class="fa fa-table"></i> <span>Post Table</span>
                    <span class="pull-right-container">
                        <!-- <small class="label pull-right bg-green">16</small> -->
                    </span>
                </a>
            </li>
            
            <li class="treeview">
                <a href="<?php echo base_url(); ?>showPageTable">
                    <i class="fa fa-table"></i> <span>Page Table</span>
                    <span class="pull-right-container">
                        <!-- <small class="label pull-right bg-green">16</small> -->
                    </span>
                </a>
            </li>
 
            
            <!-- Action menu -->
            <li class="header">Action</li>

            <?php 
            // echo $_SESSION['permission_admin'];
            if ($_SESSION['permission_manager']) 
            {
                echo '<li class="treeview">
                    <a href="'.base_url().'editPageList">
                        <i class="fa fa-edit"></i> <span>Edit Page</span>
                        <span class="pull-right-container">
                            <!-- <small class="label pull-right bg-green">16</small> -->
                        </span>
                    </a>
                </li>';

                 echo '<li class="treeview">
                    <a href="'.base_url().'postManageList">
                        <i class="fa fa-tasks"></i> <span>Posts Management</span>
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
                echo '<li class="treeview"><a href="userPage"><i class="fa fa-user"></i> <span>User Management</span><span class="pull-right-container"></a></li>';

            }
            
            ?>
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
