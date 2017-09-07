<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Social Analytic | Log in</title>
    <link rel="shortcut icon" href="<?php echo(base_url());?>assets/images/logo.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo(base_url());?>assets/admin-lite/plugins/iCheck/square/blue.css">
    
    <style>
        body{
            height: auto;
        }
        @-webkit-keyframes displace {
            from {
                background-position: 0 0;
            }
            to {
                background-position: 100% 0;
            }
        }
        @keyframes displace {
            from {
                background-position: 0 0;
            }
            to {
                background-position: 100% 0;
            }
        }
        .login-page{
            background: url(http://social.biggy.co/assets/images/bg3.jpg) repeat-x center;
            background-size: auto 100%;
            -webkit-animation: displace 20s linear infinite;
            animation: displace 20s linear infinite;
        }
        .login-box{
            height:400px;
        }
        .login-box, .register-box {
            width: 60%;
        }
        .login-box-body, .register-box-body {
            background: rgb( 227 , 155, 72 );
            padding: 20px;
            border-top: 0;
            color: #666;
            height: 100%;
            padding-top: 70px;
            border-radius: 0 20px 20px 0 ; 
            text-align: center;
        }
        .login-box-body>form{
            padding: 20px 0;
        }
        .logo-form{
            padding: 5%;
            background: #fff;
            height: 100%;
            text-align: center;
            border-radius: 20px 0 0 20px;
        }
        .login-form{
            height: 100%;
            padding: 0;
        }
        .fb-btn{
            background: #3b5998;
            color:#fff;
        }
        .fb-btn:hover{
            background: #8b9dc3;
            color:#fff;
        }
        .fb-btn>i{
            margin-right:10px; 
        }
        .has-feedback .form-control {
            border-radius: 10px;
            height: 50px;
        }
        .btn {
            border-radius: 65px;
        }
        .logo-img{
            width: 40%;
        }
        .form-control-feedback {
            top: 10px;  
            right: 10px;
        }
        .login-box-text{
            font-size: 20px;
            font-weight: 500;
        }
        .small-font{
            font-size: 15px;
        }
        .white{
            color: #fff;
        } 
        .login-logo{
            font-size: 2em;
        }
        .mobile{
            display:none;
        }

        @media only screen and (max-width: 500px) {
            .desktop {
                display: none;
            }
            .mobile{
                display:block;
            }
            .login-box, .register-box {
                width: 90%;
            }
            .login-box-body, .register-box-body {
                background: none;
                padding: 10px;
                border-top: 0;
                color: #666;
                height: 100%;
                border-radius: 20px;
                text-align: center;
            }
        }
        @media only screen and (max-width: 736px) and (orientation:landscape) {
            .desktop {
                display: none;
            }
            .mobile{
                display:block;
            }
            .login-box, .register-box {
                width: 90%;
            }
            .login-box-body, .register-box-body {
                background: none;
                padding: 10px;
                border-top: 0;
                color: #666;
                height: 100%;
                border-radius: 20px;
                text-align: center;
            }
        }
        
        @media all and (device-width: 768px) and (device-height: 1024px) and (orientation:portrait) {
            .desktop {
                display: none;
            }
            .mobile{
                display:block;
            }
            .login-box{
                padding-top: 35%;
            }
            .login-box, .register-box {
                width: 60%;
            }
            .login-box-body, .register-box-body {
                background: rgb( 227 , 155, 72 );
                padding: 30px;
                border-top: 0;
                color: #666;
                height: auto;
                border-radius: 20px;
                text-align: center;
            } 
        }

    </style>
</head>
<body class="login-page">
    <div class="login-box desktop">
        <div class="col-xs-6 logo-form">
            <img class="logo-img" src="<?php echo(base_url());?>assets/images/logo.png" alt="">
            <div class="login-logo" style="color: #aaa;">
                <b>Social</b>analytic
                <p class="login-box-text">lemme serve help your social jobs</p>
                <p class="login-box-text small-font">don't have account?</p>
                <button class="btn btn-primary btn-block">Sign Up !</button>
            </div>
        </div>
        <div class="col-xs-6 login-box-body">
            <p class="login-box-text white">already have account ?</p>
            <?php echo validation_errors(); ?>
            <?php echo form_open('validation_ctrl/verifylogin'); ?>
            <div class="form-group has-feedback">
                <input name="username" type="text" class="form-control" placeholder="Username" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input name="password" type="password" class="form-control" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-8 col-xs-offset-2">
                    <button type="submit" class="btn btn-block">Login</button>
                    <div class="btn btn-block fb-btn"><i class="fa fa-facebook"></i>Login via facebook</div>
                </div>
                <!-- /.col -->
            </div>
            </form>
        </div>
    </div>
    <div class="login-box mobile">
            <div class="col-md-6 login-box-body">
                <p class="login-box-text white">Social Analytic</p>
                <?php echo validation_errors(); ?>
                <?php echo form_open('validation_ctrl/verifylogin'); ?>
                <div class="form-group has-feedback">
                    <input name="username" type="text" class="form-control" placeholder="Username" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input name="password" type="password" class="form-control" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-8 col-xs-offset-2">
                        <button type="submit" class="btn btn-block">Login</button>
                        <div class="btn btn-block fb-btn"><i class="fa fa-facebook"></i>Login via facebook</div>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
    </div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo(base_url());?>assets/admin-lite/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo(base_url());?>assets/admin-lite/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
