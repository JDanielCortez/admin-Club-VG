<!-- <!DOCTYPE html> -->
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
                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-lg" onclick="registrarGamer()"><span class="fas fa-plus"></span> Gamer</button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Usuario</th>
                      <th>Nombre</th>
                      <th>F. Nacimiento</th>
                      <th>Teléfono</th>
                      <th>Correo</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="datos">

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Usuario</th>
                      <th>Nombre</th>
                      <th>F. Nacimiento</th>
                      <th>Teléfono</th>
                      <th>Correo</th>
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
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="titulo"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" name="gamer-form" id="gamer-form" enctype="multipart/form-data" method="post" onsubmit="guardarGamer()">
            <div class="row">

              <input type="hidden" id="id_usuario" name="id_usuario" value="0">

              <div class="col-md-2">
                <img src="" id="user-img" class="img-fluid img-thumbnail" height="auto" width="100%">
              </div>

              <div class="col-md-10">
                <div class="row">

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Nombre" name="Nombre" id="nombre" onblur="vacio('nombre')" onkeypress="return isLetterKey(event)">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Appelido Paterno" name="Apellido paterno" id="paterno" onblur="vacio('paterno')" onkeypress="return isLetterKey(event)">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Appelido Materno" name="Apellido materno" id="materno" onblur="vacio('materno')" onkeypress="return isLetterKey(event)">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                      </div>
                      <input type="date" class="form-control" placeholder="Nacimiento" name="Nacimiento" id="nacimiento" onblur="vacio('nacimiento')">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                      </div>
                      <select class="form-control" id="genero" name="Genero">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Teléfono" name="Telefono" id="telefono" onblur="vacio('telefono')" onkeypress="return isNumberKey(event)">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user-astronaut"></i></span>
                      </div>
                      <input type="text" class="form-control" placeholder="Nombre de usuario" name="Nombre de usuario" id="usuario" onblur="vacio('usuario')">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                      </div>
                      <input type="password" class="form-control" placeholder="Contraseña" name="Contraseña" id="contraseña" onblur="vacio('contraseña')">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                      </div>
                      <input type="password" class="form-control" placeholder="Confirmar contraseña" name="Verificar contraseña" id="contraseña-v" onblur="validarContrasena()">
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                      </div>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="Foto de perfil" id="imagen" accept="image/png, image/jpeg" onchange="return validarFoto('imagen')">
                        <label class="custom-file-label" for="imagen">Escoja foto de perfil</label>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                      <input type="email" class="form-control" placeholder="Correo Electronico" name="Correo electronico" id="correo" onblur="validarCorreo('correo')">
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
  <!-- /.modal -->

  <?php
  include_once "carga.php"
  ?>
  <script src="../controller/gamers.js" type="text/javascript"></script>


</body>

</html>