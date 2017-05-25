<?php 
require_once 'administrator/ss-functions.php';
checklogin();
if (isset($_POST['email'])){
   recoverypass($_POST['email']);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Olvide Mi Contraseña | MeeTeam</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="index.php">MeeTeam</a>
  </div>

  <div class="register-box-body">

    <form id="loginfrm" action="" method="POST">
      <div class="form-group has-feedback">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <input type="email" class="form-control" placeholder="Email " name="email">
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-success btn-block btn-flat">Recuperar Contraseña</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <p></p>
    <a href="register.php" class="text-center link-block">¿Aun no tienes cuenta? Registrate!</a>
    <p></p>
    <a href="index.php" class="text-center link-block">Iniciar Sesion</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- AdminLTE -->
    <script src="js/AdminLTE.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <!-- SS Normal -->
    <script src="js/ss-normal.js"></script>    
</body>
</html>
