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
                                    <div class="row" id="contenedor">
                                        <div class="col-md-12">
                                            <h3>Premios</h3>
                                        </div>
                                        <div id="premios">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-7">
                                        <h3>Premios</h3>
                                    </div>
                                    <div class="col-md-5">
                                        <button type="button" class="btn btn-block btn-primary" data-toggle="modal"
                                            data-target="#modal-lg" onclick="prepararPremio()"><span
                                                class="fas fa-plus"></span> Premio</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Posicion</th>
                                            <th>Premio</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Posicion</th>
                                            <th>Premio</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-7">
                                        <h3>Participantes</h3>
                                    </div>
                                    <div class="col-md-5">
                                        <button type="button" class="btn btn-block btn-primary" data-toggle="modal"
                                            data-target="#modal-lg2" onclick="prepararGamer()"><span
                                                class="fas fa-plus"></span> Gamer</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Gamer Tag</th>
                                            <th>Nombre</th>
                                            <th>Lugar</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Game Tagr</th>
                                            <th>Nombre</th>
                                            <th>Lugar</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
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

    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titulo-premio"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" name="form" id="form" method="post">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-trophy"></i></span>
                                            </div>
                                            <input type="number" class="form-control" placeholder="Posicion"
                                                name="Lugar" id="lugar" onblur="vacio('lugar')">
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-trophy"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Premio" name="Premio"
                                                id="premio" onblur="vacio('premio')">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn-gamer">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-lg2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="titulo-gamer"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" name="form2" id="form2" method="post">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <select class="form-control select2" id="gamer" name="Gamer"
                                            multiple="multiple" style="width: 90%;" data-placeholder="Selecciona gamer(s)">
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btn-gamer2">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script src="../controller/ver_torneo.js" type="text/Javascript"></script>

</body>

</html>