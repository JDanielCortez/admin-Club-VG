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
              "<div class='btn-group'> <button type='button' class='btn btn-warning'  onclick='modificarGamer(" + dato.id_usuario + ")' data-toggle='modal' data-target='#modal-lg'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger' onclick='eliminarGamer(" + dato.id_usuario + ")'><i class='fas fa-trash'></i></button> </div>"
            ]).draw(false);
          }
          //console.log(datos);
        }
      });
  });
  
  function getImg(id){
    archivo = document.getElementById(id).files;
    if (archivo && archivo[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#user-img').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(archivo[0]); // convert to base64 string
    }
  }

  function validarFoto(id){
    var archivo = document.getElementById(id).value;
    var ext = archivo.substring(archivo.lastIndexOf('.')+1);

    if(ext == 'png' || ext == 'jpg' || ext == 'jpeg'){
      getImg(id);
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
      toastr.error("Las contraseñas con coinciden.");
      return false;
    }else{
      document.getElementById('contraseña-v').className = "form-control is-valid";
      return true;
    }
  }

  function registrarGamer(){
    document.getElementById("btn-gamer").onclick = guardarGamer;
    document.getElementById("titulo").innerHTML = "Registrar Gamer";
    document.getElementById("user-img").setAttribute("src", "../../dist/img/avatar.png");

    var myform = document.getElementById('gamer-form');
    myform.reset();
    for(var i=0; i < myform.elements.length; i++){
      myform.elements[i].className = "form-control";
    }
  }

  function guardarGamer(){
    if(validarCampos("gamer-form","create") && validarContrasena()){
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
              "<div class='btn-group'> <button type='button' class='btn btn-warning' onclick='modificarGamer(" + dato.id_usuario + ")' data-toggle='modal' data-target='#modal-lg'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger' onclick='eliminarGamer(" + dato.id_usuario + ")'><i class='fas fa-trash'></i></button> </div>"
            ]).draw(false);
            toastr.success("Gamer registrado exitosamente.");
          }else{
            toastr.error("El registro no se ha podido realizar.");
          }
        }
      });
    }
  }

  function modificarGamer(id_usuario){

    var myform = document.getElementById('gamer-form');
    document.getElementById("btn-gamer").onclick = actualizarGamer;
    document.getElementById("titulo").innerHTML = "Modificar Gamer";

    myform.reset();
    for(var i=0; i < myform.elements.length; i++){
      myform.elements[i].className = "form-control";
    }
    //console.log("modificando gamer");

    var index = datos.findIndex(obj => obj.id_usuario==id_usuario);
    document.getElementById("id_usuario").value = datos[index].id_usuario;
    document.getElementById("nombre").value = datos[index].nombre;
    document.getElementById("paterno").value = datos[index].paterno;
    document.getElementById("materno").value = datos[index].materno;
    document.getElementById("telefono").value = datos[index].telefono;
    document.getElementById("usuario").value = datos[index].nombre_usuario;
    document.getElementById("nacimiento").value = datos[index].fecha_nacimiento;
    document.getElementById("genero").value = datos[index].genero;
    document.getElementById("contraseña").value = datos[index].contrasena;
    document.getElementById("contraseña-v").value = datos[index].contrasena;
    //document.getElementById("imagen").value = datos[index].foto;
    document.getElementById("correo").value = datos[index].correo;

    document.getElementById("user-img").setAttribute("src", datos[index].foto);
    
    for(var i=0; i < myform.elements.length; i++){
      vacio(myform.elements[i].id);
    }
  }

  function actualizarGamer(){
    if(validarCampos('gamer-form', 'update') && validarContrasena()){
      var parametros = new FormData($('#gamer-form')[0]);
      $.ajax({
        data: parametros,
        url: '../model/gamer.php?action=update',
        type : 'POST',
        contentType : false,
        processData : false,
        beforeSend : function(){
          $('#modal-lg').modal('hide');
        },
        success : function(response){
          if(response != 'error'){
            console.log(parametros);
            var index = datos.findIndex(obj => obj.id_usuario== document.getElementById('id_usuario').value);
            var temp = JSON.parse(JSON.stringify($('#example1').DataTable().rows().data()));
            var indexT;
            for(var i = 0; i < temp.length; i++){
              if(temp[i][0] == datos[index].nombre_usuario){
                //console.log(temp[i]);
                indexT = i;
                break;
              }
            }
            datos[index].nombre_usuario = document.getElementById('usuario').value;
            datos[index].nombre = document.getElementById('nombre').value;
            datos[index].paterno = document.getElementById('paterno').value;
            datos[index].materno = document.getElementById('materno').value;
            datos[index].fecha_nacimiento = document.getElementById('nacimiento').value;
            datos[index].genero = document.getElementById('genero').value;
            datos[index].telefono = document.getElementById('telefono').value;
            datos[index].correo = document.getElementById('correo').value;
            
            $('#example1').DataTable().row(indexT).data([
              datos[index].nombre_usuario,
              datos[index].nombre+' '+datos[index].paterno+' '+datos[index].paterno,
              datos[index].fecha_nacimiento,
              datos[index].telefono,
              datos[index].correo,
              $('#example1').DataTable().row(indexT).data()[5],
              "<div class='btn-group'> <button type='button' class='btn btn-warning' onclick='modificarGamer(" + datos[index].id_usuario + ")' data-toggle='modal' data-target='#modal-lg'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger' onclick='eliminarGamer(" + datos[index].id_usuario + ")'><i class='fas fa-trash'></i></button> </div>"
            ]).draw();
            toastr.success("Gamer actualizado exitosamente.");
          }
        }
      });
    }else{
      //console.log("COSMO ERES UN IDIOTA");
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