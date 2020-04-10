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
                      onclick="prepararRegistro()"><span class="fas fa-plus"></span> Accesorio</button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>No. Accesorio</th>
                      <th>Tipo Accesorio</th>
                      <th>Costo/Hora</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="datos">

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No. Accesorio</th>
                      <th>Tipo Accesorio</th>
                      <th>Costo/Hora</th>
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
    <div class="modal-dialog">
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

              <input type="hidden" id="id_accesorio" name="id_accesorio" value="0">

              <div class="row">

                <div class="col-md-8">
                  <div class="input-group mb-12">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                    </div>
                    <select class="form-control" id="accesorio" name="Accesorio" onchange="vacio('accesorio')">
                      <option value="0">Selecciona tipo de accesorio ...</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    </div>
                    <input type="number" class="form-control" placeholder="Costo por hora" name="Costo" id="costo"
                      onblur="vacio('costo')">
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
  <!-- /.modal -->

  <script src="../controller/accesorios.js" type="text/javascript"></script>

</body>

</html>