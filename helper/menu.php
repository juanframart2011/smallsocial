<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <a href="index.php"><img class="img-responsive" src="http://i.imgur.com/sLOErqz.png" alt="Logo"></a>
            </div>
            <div class="menu-down">
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6"><a class="menu" href="#">Sobre Nosotros</a></div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6"><a class="menu" href="#">Ayuda</a></div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6"><a class="menu" href="#">Contacto</a></div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6"><a class="menu <?= ( isset( $register_menu )? 'active' : '' ) ?>" href="register.php">Registro</a></div>
            </div>
        </div>
    </div>
</nav>