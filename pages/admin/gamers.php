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
                    <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-lg"><span class="fas fa-plus"></span> Gamer</button>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Registrar Gamer</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" name="gamer-form" id="gamer-form" enctype="multipart/form-data" method="post" onsubmit="guardarGamer()">
          <div class="row">
            
            <div class="col-md-4">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control" placeholder="Nombre" name="Nombre" id="nombre" onblur="vacio('nombre')"  onkeypress="return isLetterKey(event)">
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
                  <option value="F">Femenino</option>
                  <option value="M">Masculino</option>
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


          </div>

          <div class="row">
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

         

        </form>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="guardarGamer()">Guardar</button>
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
<script>
  document.title += " Gamers"
  document.getElementById("content-t").textContent = "Gamers";
  document.getElementById("bread").textContent = "Dashboard";

  var datos;
  var node = document.createElement("LI");                 
  var textnode = document.createTextNode("Gamers");         
  node.appendChild(textnode);                              
  document.getElementById("bread-line").appendChild(node);
  node.className = "breadcrumb-item active";
  
  document.getElementById("menu-gamers").className += " active";

  $(document).ready(function(){
    $.ajax({
        data: '',
        url: '../model/gamer.php?action=read',
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function(){
        },
        success: function(response){
          //$('#datos').html(response);
          datos = JSON.parse(response);
          var tabla = $('#example1').DataTable();

          for(dato of datos){
            //console.log(dato)
            $estado = "<span class='badge badge-success'>Activo</span>";
            if(dato.estado == 1){
              $estado = "<span class='badge badge-success'>Activo</span>";
            }else{
              $estado = "<span class='badge badge-danger'>Inactivo</span>";
            }
            tabla.row.add([
              dato.nombre_usuario,
              dato.nombre + " " + dato.paterno + " " + dato.materno,
              dato.fecha_nacimiento,
              dato.telefono,
              dato.correo,
              $estado,
              "<div class='btn-group'> <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#modal-lg'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger' onclick='eliminarGamer(" + dato.id_usuario + ", "+  dato.estado +")'><i class='fas fa-trash'></i></button> </div>"
            ]).draw(false);
          }
          //console.log(datos);
        }
      });
  });
  

  function validarFoto(id){
    var archivo = document.getElementById(id).value;
    var ext = archivo.substring(archivo.lastIndexOf('.')+1);

    if(ext == 'png' || ext == 'jpg' || ext == 'jpeg'){
      return true;
    }else{
      return false;
    }
  }

  function validarContrasena(){
    var contrasena = document.getElementById("contraseña").value;
    var contrasenaV = document.getElementById("contraseña-v").value;
    vacio('contraseña');
    if(contrasena != contrasenaV){
      document.getElementById('contraseña-v').className = "form-control is-invalid";
    }else{
      document.getElementById('contraseña-v').className = "form-control is-valid";
    }
  }

  function guardarGamer(){
    if(validarCampos("gamer-form")){
      var parametros = new FormData($('#gamer-form')[0]);
      $.ajax({
        data: parametros,
        url: '../model/gamer.php?action=create',
        type: 'POST',
        contentType: false,
        processData: false,
        beforeSend: function(){
          //$('#modal-sm').modal('show');
          $('#modal-lg').modal('hide');
        },
        success: function(response){
          //alert(response);
          if(response != "error"){
            var dato = JSON.parse(response);
            var tabla = $('#example1').DataTable();
            datos.push(dato);
            console.log(dato);
            console.log(dato.nombre_usuario);
            $estado = "<span class='badge badge-success'>Activo</span>";
            if(dato.estado == 1){
              $estado = "<span class='badge badge-success'>Activo</span>";
            }else{
              $estado = "<span class='badge badge-danger'>Inactivo</span>";
            }
            tabla.row.add([
              dato.nombre_usuario,
              dato.nombre + " " + dato.paterno + " " + dato.materno,
              dato.fecha_nacimiento,
              dato.telefono,
              dato.correo,
              $estado,
              "<div class='btn-group'> <button type='button' class='btn btn-warning' data-toggle='modal' data-target='#modal-lg'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger' onclick='eliminarGamer(" + dato.id_usuario + ")'><i class='fas fa-trash'></i></button> </div>"
            ]).draw(false);
            toastr.success("Gamer registrado exitosamente.");
          }else{
            toastr.error("El registro no se ha podido realizar.");
          }
        }
      });
    }
  }

  function eliminarGamer(id_usuario){
    var estadoLocal = 0;
    var index = datos.findIndex(obj => obj.id_usuario==id_usuario);
    var temp = JSON.parse(JSON.stringify($('#example1').DataTable().rows().data()));
    var indexT;
    //console.log(temp)
    for(var i = 0; i < temp.length; i++){
      if(temp[i][0] == datos[index].nombre_usuario){
        //console.log(temp[i]);
        indexT = i;
        break;
      }
    }
    var estado_actual = datos[index].estado;
    if(estado_actual == 0){
      estadoLocal = 1;
      $('#example1').DataTable().row(indexT).data([
        $('#example1').DataTable().row(indexT).data()[0],
        $('#example1').DataTable().row(indexT).data()[1],
        $('#example1').DataTable().row(indexT).data()[2],
        $('#example1').DataTable().row(indexT).data()[3],
        $('#example1').DataTable().row(indexT).data()[4],
        "<span class='badge badge-success'>Activo</span>",
        $('#example1').DataTable().row(indexT).data()[6]
      ]).draw();
      
    }else{
      estadoLocal = 0;
      $('#example1').DataTable().row(indexT).data([
        $('#example1').DataTable().row(indexT).data()[0],
        $('#example1').DataTable().row(indexT).data()[1],
        $('#example1').DataTable().row(indexT).data()[2],
        $('#example1').DataTable().row(indexT).data()[3],
        $('#example1').DataTable().row(indexT).data()[4],
        "<span class='badge badge-danger'>Inactivo</span>",
        $('#example1').DataTable().row(indexT).data()[6]
      ]).draw();
    }
    
    //console.log( $('#example1').DataTable().row(indexT).data());
    //console.log(id_usuario, estado_actual);
   $.ajax({
    data: '',
    url: '../model/gamer.php?action=delete&id_usuario='+id_usuario+'&estado='+estadoLocal,
    type : 'GET',
    contentType : false,
    processData : false,
    beforeSend: function(){
     // $('#modal-sm').modal('toggle');
    },
    success: function(response){
     // $('#modal-sm').modal("toggle");
      if(response == "success"){
        toastr.success("Estado actualizado exitosamente.");
        datos[index].estado = estadoLocal;
        //$('#example1').DataTable().ajax.reload();
      }else{
        toastr.error("No ha sido posible actualizar el estado.");
      }
      
    }
   });
  }
</script>


</body>

</html>
