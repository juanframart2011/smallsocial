<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="home.php" class="navbar-brand">MeeTeam</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <form class="navbar-form navbar-left" role="search" method="GET" action="find.php">
                    <div class="form-group">
                        <input type="text" class="form-control" name="search" id="navbar-search-input" placeholder="Buscar Usuarios...">
                    </div>
                </form>
            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!-- inner menu: contains the messages -->
                                <div class="slimScrollDiv" style="position: relative; overflow: auto; width: auto; height: auto;">
                                    <ul class="menu" style="overflow: auto; width: 100%; height: auto;">
                                        <?php conversationlst(); ?>
                                        <!-- end message -->
                                    </ul>
                                    <div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div>
                                    <div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div>
                                </div>
                                <!-- /.menu -->
                            </li>
                            <li class="footer"><a href="myinbox.php">Ver todos los mensajes</a></li>
                        </ul>
                    </li>
                    <!-- /.messages-menu -->
                    <!-- Notifications Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <div class="slimScrollDiv" style="position: relative; overflow: auto; width: auto; height: auto;">
                                    <ul class="menu" style="overflow: auto; width: 100%; height: auto;">
                                        <?php checknotifications(); ?>
                                        <!-- end notification -->
                                    </ul>
                                    <div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; background: rgb(0, 0, 0);"></div>
                                    <div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div>
                                </div>
                            </li>
                            <li class="footer"><a href="mynotifications.php">Ver todas las notificaciones</a></li>
                        </ul>
                    </li>
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><i class="fa fa-cog"></i></span>
                        </a>
                        <ul class="dropdown-menu" style="padding:5px;">
                            <!-- Menu Footer-->
                            <li><a href="myconfiguration.php" class="btn btn-default btn-flat"><i class="fa fa-cog"></i> Configuración</a></li>
                            <li><a href="logout.php" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Cerrar Sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>