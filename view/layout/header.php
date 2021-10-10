<header class="app-header">

    <a class="app-header__logo" href="index.php">SysSoft Integra</a>
    <!-- Sidebar toggle button-->
    <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <li class="dropdown">
            <a class="app-nav__item" href="puntoventa.php">
                <i class="fa fa fa-shopping-cart fa-lg"></i>
                <span class="app-nav_text">&nbsp Punto de Venta<span>
            </a>
        </li>
        <li class="dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
                <i class="fa fa-bell-o fa-lg"></i>
                <span id="lblNumeroNotificaciones" class="pl-1 pr-1 badge-warning rounded h7 icon-absolute ">0</span>
            </a>
            <ul class="app-notification dropdown-menu dropdown-menu-right">
                <div class="app-notification__content" id="divNotificaciones">
                </div>
                <li class="app-notification__footer" id="lblNotificaciones"><span>Lista de Notificaciones</span></li>
            </ul>
        </li>

        <!-- User Menu-->
        <li class="dropdown">
            <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu">
                <img src="images/usuario.png" class="user-image" alt="Usuario">
            </a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li class="user-header">
                    <img src="images/usuario.png" class="img-circle" alt="Usuario">
                    <p>
                        <span><?php echo $_SESSION["Nombres"] . " " . $_SESSION["Apellidos"] ?></span>
                        <small> <i><?php echo $_SESSION["RolName"] ?> </i> </small>
                    </p>
                </li>
                <li class="user-footer">
                    <div class="pull-left">
                        <a href="perfil.php" class="btn btn-secondary btn-flat">
                            <i class="fa fa-user fa-lg"></i> Perfil Usuario
                        </a>
                    </div>
                    <div class="pull-right">
                        <a href="logout.php" id="btnCloseSesion" class="btn btn-secondary btn-flat">
                            <i class="fa fa-sign-out fa-lg"></i> Cerrar Sesión
                        </a>
                    </div>
                </li>
                <!-- 
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-user fa-lg"></i> 
                            <span class="app-nav_text">Perfil<span>                         
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="logout.php">
                            <i class="fa fa-sign-out fa-lg"></i> Cerrar Sessión
                        </a>
                    </li> 
            -->
            </ul>
        </li>
    </ul>
</header>