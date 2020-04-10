document.title += " Consolas"
document.getElementById("content-t").textContent = "Consolas";
document.getElementById("bread").textContent = "Dashboard";

var node = document.createElement("LI");                 
var textnode = document.createTextNode("Consolas");         
node.appendChild(textnode);                              
document.getElementById("bread-line").appendChild(node);
node.className = "breadcrumb-item active";


document.getElementById("p-menu-plataformas").className += " menu-open";
document.getElementById("menu-plataformas").className += " active";
document.getElementById("s-menu-consolas").className += " active";

var datos;

$(document).ready(function(){
  $.ajax({
      data: '',
      url: '../model/consola.php?action=read',
      type: 'GET',
      contentType: false,
      processData: false,
      beforeSend: function(){
      },
      success: function(response){
        //$('#datos').html(response);
        datos = JSON.parse(response);
        console.log(datos);
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
            dato.id_consola,
            dato.nombre_plataforma,
            dato.serial,
            '$'+dato.costo_hora,
            $estado,
            "<div class='btn-group'> <button type='button' class='btn btn-warning'  onclick='prepararActualizacion(" + dato.id_consola + ")' data-toggle='modal' data-target='#modal-lg'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger' onclick='eliminar(" + dato.id_consola + ")'><i class='fas fa-trash'></i></button> </div>"
          ]).draw(false);
        }
        //console.log(datos);
      }
    });
});

function prepararRegistro(){
  document.getElementById("btn-gamer").onclick = guardar;
  document.getElementById("titulo").innerHTML = "Registrar Consola";

  var myform = document.getElementById('form');
  myform.reset();
  for(var i=0; i < myform.elements.length; i++){
    myform.elements[i].className = "form-control";
  }
}

function guardar(){
  if(validarCampos("form","create")){
    var parametros = new FormData($('#form')[0]);
    $.ajax({
      data: parametros,
      url: '../model/consola.php?action=create',
      type: 'POST',
      contentType: false,
      processData: false,
      beforeSend: function(){
        //$('#modal-sm').modal('show');
        $('#modal-lg').modal('hide');
      },
      success: function(response){
        console.log(response);
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
            dato.id_consola,
            dato.nombre_plataforma,
            dato.serial,
            '$'+dato.costo_hora,
            $estado,
            "<div class='btn-group'> <button type='button' class='btn btn-warning'  onclick='prepararActualizacion(" + dato.id_consola + ")' data-toggle='modal' data-target='#modal-lg'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger' onclick='eliminar(" + dato.id_consola + ")'><i class='fas fa-trash'></i></button> </div>"
          ]).draw(false);
          toastr.success("Consola registrado exitosamente.");
        }else{
          toastr.error("El registro no se ha podido realizar.");
        }
      }
    });
  }
}

function prepararActualizacion(id_consola){

  var myform = document.getElementById('form');
  document.getElementById("btn-gamer").onclick = actualizar;
  document.getElementById("titulo").innerHTML = "Modificar consola";

  myform.reset();
  for(var i=0; i < myform.elements.length; i++){
    myform.elements[i].className = "form-control";
  }
  //console.log("modificando gamer");

  var index = datos.findIndex(obj => obj.id_consola==id_consola);
  document.getElementById("plataforma").value = datos[index].id_plataforma;
  document.getElementById("costo").value = datos[index].costo_hora;
  document.getElementById("serial").value = datos[index].serial;
  document.getElementById("id_consola").value = datos[index].id_consola;
  
  for(var i=0; i < myform.elements.length; i++){
    vacio(myform.elements[i].id);
  }
}

function actualizar(){
  if(validarCampos('form', 'update')){
    var parametros = new FormData($('#form')[0]);
    $.ajax({
      data: parametros,
      url: '../model/consola.php?action=update',
      type : 'POST',
      contentType : false,
      processData : false,
      beforeSend : function(){
        $('#modal-lg').modal('hide');
      },
      success : function(response){
        if(response != 'error'){
          var index = datos.findIndex(obj => obj.id_consola== document.getElementById('id_consola').value);
          var temp = JSON.parse(JSON.stringify($('#example1').DataTable().rows().data()));
          var indexT;
          for(var i = 0; i < temp.length; i++){
            if(temp[i][0] == datos[index].id_consola){
              //console.log(temp[i]);
              indexT = i;
              break;
            }
          }
          datos[index].nombre_plataforma = document.getElementById('plataforma').value;
          datos[index].costo_hora = document.getElementById('costo').value;
          datos[index].serial = document.getElementById('serial').value;
          
          $('#example1').DataTable().row(indexT).data([
            datos[index].id_consola,
            datos[index].nombre_plataforma,
            datos[index].serial,
            '$'+datos[index].costo_hora,
            $('#example1').DataTable().row(indexT).data()[4],
            "<div class='btn-group'> <button type='button' class='btn btn-warning'  onclick='prepararActualizacion(" + datos[index].id_consola + ")' data-toggle='modal' data-target='#modal-lg'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger' onclick='eliminar(" + datos[index].id_consola + ")'><i class='fas fa-trash'></i></button> </div>"
          ]).draw();
          toastr.success("Consola actualizado exitosamente.");
        }else{
          console.log(response);
          toastr.error("No se ha actualizado.");
        }
      }
    });
  }else{
    //console.log("COSMO ERES UN IDIOTA");
  }
}

function eliminar(id_consola){
  var estadoLocal = 0;
  var index = datos.findIndex(obj => obj.id_consola==id_consola);
  var temp = JSON.parse(JSON.stringify($('#example1').DataTable().rows().data()));
  var indexT;
  //console.log(temp)
  for(var i = 0; i < temp.length; i++){
    if(temp[i][0] == datos[index].id_consola){
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
      "<span class='badge badge-success'>Activo</span>",
      $('#example1').DataTable().row(indexT).data()[5]
    ]).draw();
    
  }else{
    estadoLocal = 0;
    $('#example1').DataTable().row(indexT).data([
      $('#example1').DataTable().row(indexT).data()[0],
      $('#example1').DataTable().row(indexT).data()[1],
      $('#example1').DataTable().row(indexT).data()[2],
      $('#example1').DataTable().row(indexT).data()[3],
      "<span class='badge badge-danger'>Inactivo</span>",
      $('#example1').DataTable().row(indexT).data()[5]
    ]).draw();
  }
  
  //console.log( $('#example1').DataTable().row(indexT).data());
  //console.log(id_usuario, estado_actual);
 $.ajax({
  data: '',
  url: '../model/consola.php?action=delete&id_consola='+id_consola+'&estado='+estadoLocal,
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