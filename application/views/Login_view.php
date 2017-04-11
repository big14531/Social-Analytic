<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Social Analytic | Log in</title>
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
  .login-page{
    background: linear-gradient(182deg, #222222, #393939, #737373, #989898, #7e7e7e);
  background-size: 1000% 1000%;

  -webkit-animation: AnimationName 15s ease infinite;
  -moz-animation: AnimationName 15s ease infinite;
  animation: AnimationName 15s ease infinite;
  }
  @-webkit-keyframes AnimationName {
      0%{background-position:52% 0%}
      50%{background-position:49% 100%}
      100%{background-position:52% 0%}
  }
  @-moz-keyframes AnimationName {
      0%{background-position:52% 0%}
      50%{background-position:49% 100%}
      100%{background-position:52% 0%}
  }
  @keyframes AnimationName { 
      0%{background-position:52% 0%}
      50%{background-position:49% 100%}
      100%{background-position:52% 0%}
  }
</style>

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo" style="color: white;"">
    <b>Social</b>analytic <span style="font-size: 0.33em;">by nationgroup</span>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php
    if( isset( $_GET['fail'] ) )
    {
      echo "<div id='callout' class='callout callout-danger'>
        <h4>Username หรือ Password ผิด!!</h4>
        <p>กรุณากรอกใหม่</p>
      </div>";       
    }
 
    ?>
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
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
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
