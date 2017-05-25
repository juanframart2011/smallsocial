<?php 
require_once 'administrator/ss-functions.php';
checklogin();
if (isset($_POST['email'])){
   theloginmemeber($_POST['email'],$_POST['password']);
}
$title = 'Home';
?>
<!DOCTYPE html>
<html>
    
    <? include( 'helper/head.php' ) ?>
    
    <body>
        
        <? include( 'helper/menu.php' ) ?>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                    <img src="images/home.png" alt="">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
                    <div class="register-box">
                        <h1 style="font-weight: bold;">Hola,</h1><br>
                        <h3>bienvenido a tu sitio deportivo, social eficaz</h3>
                        <div class="register-logo">
                            <a href="index.php">MeeTeam</a>
                        </div>
                        <div align="center"> Sport Is Life </div>
                        <div class="register-box-body">
                            <?php
                                if (isset($_GET['active'])) {
                                 echo '
                                 <div class="alert alert-success text-center animated flash" role="alert">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i> Tu Cuenta se ha activado correctamente!!
                                 </div>';
                                }
                                ?>
                            <form id="loginfrm" action="" method="POST">
                                <div class="form-group has-feedback">
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    <input type="email" class="form-control" placeholder="Email " name="email">
                                </div>
                                <div class="form-group has-feedback">
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                </div>
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn btn-success btn-block btn-flat">Entrar</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                            <p></p>
                            <a href="register.php" class="text-center link-block">¿Aun no tienes cuenta? Registrate!</a>
                            <p></p>
                            <a href="recovery.php" class="text-center link-block">Olvide Mi Contraseña</a>
                        </div>
                        <!-- /.form-box -->
                        <p><small class="text-center col-md-12" style="color:#FFF;">Deportiva, Eficaz, Social.</small></p>
                    </div>
                </div>
            </div>
        </div>

        <? include( 'helper/footer.php' ) ?>
    </body>
</html>