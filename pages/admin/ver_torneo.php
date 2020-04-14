<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <?php
    include_once "head.php";
    ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <?php
        include_once "navbar.php";
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include_once "menu.php"
        ?>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-12">
                        <div class="card-header">
                            <h3 id="titulo_torneo"></h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="" id="img-juego" width="100%" height="auto">
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12" id="descripcion"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b>Juego:</b></div>
                                        <div class="col-md-9" id="juego"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b>Modalidad:</b></div>
                                        <div class="col-md-9" id="modalidad"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b>Fecha:</b></div>
                                        <div class="col-md-9" id="fecha"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b>Hora:</b></div>
                                        <div class="col-md-9" id="hora"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b>Estado:</b></div>
                                        <div class="col-md-9" id="estado"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b>Cantidad de jugadores:</b></div>
                                        <div class="col-md-9" id="jugadores"></div>
                                    </div>
                                    <br>
                                    <div class="row" id="premios">
                                        <div class="col-md-12"><h3>Premios</h3></div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <?php
    include_once "footer.php"
    ?>
    </div>
    <!-- ./wrapper -->


    <script src="../controller/ver_torneo.js" type="text/Javascript"></script>

</body>

</html>