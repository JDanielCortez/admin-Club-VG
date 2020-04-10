document.title += " Catalogo"
document.getElementById("content-t").textContent = "Catalogo de plataformas";
document.getElementById("bread").textContent = "Dashboard";

var node = document.createElement("LI");                 
var textnode = document.createTextNode("Catalogo");         
node.appendChild(textnode);                              
document.getElementById("bread-line").appendChild(node);
node.className = "breadcrumb-item active";


document.getElementById("p-menu-plataformas").className += " menu-open";
document.getElementById("menu-plataformas").className += " active";
document.getElementById("s-menu-catalogo").className += " active";

var datos;
$(document).ready(function(){
    $.ajax({
        data: '',
        url: '../model/catalogo.php?action=read',
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function(){
        },
        success: function(response){

          datos = JSON.parse(response);
          var tabla = $('#example1').DataTable();

          for(dato of datos){
            tabla.row.add([
              dato.nombre_plataforma,
            //   "<div class='btn-group'> <button type='button' class='btn btn-warning'  onclick='modificarGamer(" + dato.id_usuario + ")' data-toggle='modal' data-target='#modal-lg'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger' onclick='eliminarGamer(" + dato.id_plataforma + ")'><i class='fas fa-trash'></i></button> </div>"
            ]).draw(false);
          }
          //console.log(datos);
         }
      });
  });