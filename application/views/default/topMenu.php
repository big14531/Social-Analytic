
<header class="main-header">
    <a href="dashboard" class="logo">
        <span class="logo-lg"><b>Social</b> Analytic</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
        </a>

        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-compass"></i>
        </button>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav" id="nav-tab">
            <li id="facebook-tab"><a href="<?=base_url();?>facebook"><i class="fa fa-facebook"></i> Facebook</a></li>
            <li id="twitter-tab"><a href="<?=base_url();?>twitter"><i class="fa fa-instagram"></i> Twitter</a></li>
            <li id="instagram-tab"><a href="<?=base_url();?>instagram"><i class="fa fa-twitter"></i> Instagram</a></li>
          </ul>
        </div>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><i class="fa fa-user"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <p><?=$_SESSION['login_name']?></p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <p>
                                <b>Last Login : </b>
                                <?=$_SESSION['login_last_login']?>
                            </p>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="<?=base_url();?>logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-cogs"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <ul class="menu">
                            <li>
                                <a href="<?=base_url();?>facebook/editFacebookListUser">
                                <div class="pull-left"><i class="fa fa-facebook"></i></div>
                                จัดการ Facebook ที่ติดตาม
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>instagram/editInstagramListUser">
                                <div class="pull-left"><i class="fa fa-instagram"></i></div>
                                จัดการ Instragram ที่ติดตาม
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>twitter/editTwitterListUser">
                                <div class="pull-left"><i class="fa fa-twitter"></i></div>
                                จัดการ Twitter ที่ติดตาม
                                </a>
                            </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>