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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-10">
                    <h3>Listado</h3>
                  </div>
                  <div class="col-md-2">
                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-lg"
                      onclick="prepararRegistro()"><span class="fas fa-plus"></span> Torneo</button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Titulo</th>
                      <th>Juego</th>
                      <th>Modalidad</th>
                      <th>Estatus</th>
                      <th>Max. Jug.</th>
                      <th>Fecha</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="datos">

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Titulo</th>
                      <th>Juego</th>
                      <th>Modalidad</th>
                      <th>Estatus</th>
                      <th>Max. Jug.</th>
                      <th>Fecha</th>
                      <th>Estado</th>
                      <th>Acciones</th>
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
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="titulo"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" name="form" id="form" enctype="multipart/form-data" method="post">
            <div class="row">

              <div class="col-md-12">
                <div class="row">

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-trophy"></i></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Titulo del torneo" name="Titulo"
                        id="titulo_torneo" onblur="vacio('titulo_torneo')">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-gamepad"></i></span>
                      </div>
                      <select class="form-control select2" id="juego" name="Juego" onchange=""
                        style="width: 81%;">
                        <option value="0">Selecciona juego ...</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                      </div>
                      <select class="form-control select2" id="modalidad" name="Modalidad" onchange=""
                        style="width: 82%;">
                        <option value="0">Selecciona modalidad ...</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-spinner"></i></span>
                      </div>
                      <select class="form-control select2" id="estatus" name="Estatus" onchange=""
                        style="width: 82%;">
                        <option value="0">Selecciona estatus ...</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                      </div>
                      <input type="date" class="form-control" placeholder="Fecha" name="Fecha" id="fecha"
                        onblur="vacio('fecha')">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                      </div>
                      <input type="time" class="form-control" placeholder="Hora" name="Hora" id="hora"
                        onblur="vacio('hora')">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                      </div>
                      <input type="number" class="form-control" placeholder="Cantidad de jugadores" name="Jugadores"
                        id="jugadores" onblur="vacio('jugadores')">
                    </div>
                  </div>
                  

                  <div class="col-sm-8">
                    <div class="form-group">
                      <textarea class="form-control" rows="1" placeholder="Ingrese descripción del torneo ..." id="descripcion" name="Descripcion"></textarea>
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

  <script src="../controller/torneos.js" type="text/javascript"></script>

</body>

</html>