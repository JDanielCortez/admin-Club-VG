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
                  <!-- <div class="col-md-2">
                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-lg" onclick="registrarGamer()"><span class="fas fa-plus"></span> Plataforma</button>
                  </div> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Plataforma</th>
                      <!-- <th>Acciones</th> -->
                    </tr>
                  </thead>
                  <tbody id="datos">
                    
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Plataforma</th>
                      <!-- <th>Acciones</th> -->
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


<script src="../controller/catalogo.js" type="text/javascript"></script>

</body>

</html>
