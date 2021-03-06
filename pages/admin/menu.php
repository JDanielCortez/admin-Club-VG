<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION['nivel'];?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link" id="menu-dashboard">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <?php if($_SESSION['nivel'] == 'Admin'){?>
                <li class="nav-item">
                    <a href="gamers.php" class="nav-link" id="menu-gamers">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Gamers
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview" id="p-menu-plataformas">
                    <a href="#" class="nav-link" id="menu-plataformas">
                        <i class="nav-icon fas fa-laptop"></i>
                        <p>
                            Plataformas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="catalogo.php" class="nav-link" id="s-menu-catalogo">
                                <i class="fas fa-book-open"></i>
                                <p>Catalogo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="consolas.php" class="nav-link" id="s-menu-consolas">
                                <i class="fas fa-server"></i>
                                <p>Consolas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="juegos.php" class="nav-link" id="menu-juegos">
                        <i class="nav-icon fas fa-gamepad"></i>
                        <p>
                            Juegos
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview" id="p-menu-accesorios">
                    <a href="#" class="nav-link" id="menu-accesorios">
                        <i class="nav-icon fas fa-puzzle-piece"></i>
                        <p>
                            Accesorios
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="catalogo-a.php" class="nav-link" id="s-menu-catalogo-a">
                                <i class="fas fa-book-open"></i>
                                <p>Catalogo</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="accesorios.php" class="nav-link" id="s-menu-accesorios">
                                <i class="fas fa-keyboard"></i>
                                <p>Accesorios</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <li class="nav-item has-treeview" id="p-monedas">
                    <a href="#" class="nav-link" id="monedas">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                            Monedas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <?php if($_SESSION['nivel'] == 'Admin'){?>
                        <li class="nav-item">
                            <a href="monedas.php" class="nav-link" id="equivalencia">
                                <i class="fas fa-equals"></i>
                                <p>Equivalencias</p>
                            </a>
                        </li>
                    <?php }?>
                        <li class="nav-item has-treeview">
                            <a href="cambios.php" class="nav-link" id="cambios">
                                <i class="fas fa-exchange-alt"></i>
                                <p>Cambios</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="torneos.php" class="nav-link" id="menu-torneos">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>
                            Torneos
                        </p>
                    </a>
                </li>
                <?php if($_SESSION['nivel'] == 'Admin'){?>
                <li class="nav-item">
                    <a href="renta.php" class="nav-link" id="menu-rentas">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Rentas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="ventas.php" class="nav-link" id="menu-ventas">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Venta
                        </p>
                    </a>
                </li>
                <?php }?>
                <li class="nav-item">
                    <a href="mensajes.php" class="nav-link">
                        <i class="nav-icon fas fa-sms" id="p-menu-mensajes"></i>
                        <p>
                            Mensajes
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark" id="content-t"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" id="bread-line">
                        <li class="breadcrumb-item"><a href="dashboard" id="bread"></a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->