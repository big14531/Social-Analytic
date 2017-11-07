
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
                <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-cogs"></i>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <ul class="menu">
                      <li>
                        <a href="<?=base_url();?>facebook/editFacebookListUser">
                          <div class="pull-left"><i class="fa fa-facebook"></i></div>
                          <h4>จัดการ Facebook ที่ติดตาม</h4>
                        </a>
                      </li>
                      <li>
                        <a href="<?=base_url();?>instagram/editInstagramListUser">
                          <div class="pull-left"><i class="fa fa-instagram"></i></div>
                          <h4>จัดการ Instragram ที่ติดตาม</h4>
                        </a>
                      </li>
                      <li>
                        <a href="<?=base_url();?>twitter/editTwitterListUser">
                          <div class="pull-left"><i class="fa fa-twitter"></i></div>
                          <h4>จัดการ Twitter ที่ติดตาม</h4>
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