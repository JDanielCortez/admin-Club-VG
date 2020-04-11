document.title += " Monedas"
document.getElementById("content-t").textContent = "Monedas";
document.getElementById("bread").textContent = "Dashboard";

var node = document.createElement("LI");
var textnode = document.createTextNode("Monedas");
node.appendChild(textnode);
document.getElementById("bread-line").appendChild(node);
node.className = "breadcrumb-item active";

document.getElementById("p-monedas").className += " menu-open";
document.getElementById("monedas").className += " active";
document.getElementById("equivalencia").className += " active";

var datos;

$(document).ready(function () {
    $.ajax({
        data: '',
        url: '../model/moneda.php?action=read',
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function () {
        },
        success: function (response) {
            datos = JSON.parse(response);
            actualizarTabla();
        }
    });
});

function actualizarTabla() {
    var tabla = $('#example1').DataTable();
    tabla.clear();
    for (dato of datos) {
        tabla.row.add([
            dato.descripcion,
            dato.moneda,
            "<div class='btn-group'> <button type='button' class='btn btn-warning'  onclick='prepararActualizacion(" + dato.id_moneda + ")' data-toggle='modal' data-target='#modal-lg'><i class='fas fa-edit'></i></button></div>"
        ]).draw(false);
    }
}

function prepararActualizacion(id_moneda) {
    var myform = document.getElementById('form');
    document.getElementById("btn-gamer").onclick = actualizar;
    document.getElementById("titulo").innerHTML = "Cambiar equivalencia";

    myform.reset();
    //console.log("modificando gamer");

    var index = datos.findIndex(obj => obj.id_moneda == id_moneda);

    document.getElementById("id_moneda").value = datos[index].id_moneda;
    document.getElementById("moneda").value = datos[index].moneda;
    //console.log(datos[index].moneda);


    for (var i = 0; i < myform.elements.length; i++) {
        vacio(myform.elements[i].id);
    }
}

function actualizar() {
    if (validarCampos('form', 'update')) {
        var parametros = new FormData($('#form')[0]);
        $.ajax({
            data: parametros,
            url: '../model/moneda.php?action=update',
            type: 'POST',
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#modal-lg').modal('hide');
            },
            success: function (response) {
                if (response != 'error') {
                    var index = datos.findIndex(obj => obj.id_moneda == document.getElementById('id_moneda').value);
                    //console.log(response);
                    datos[index] = {};
                    datos[index] = JSON.parse(response);
                    //console.log(datos[index]);
                    actualizarTabla();
                    toastr.success("Moneda actualizada exitosamente.");
                } else {
                    console.log(response);
                    toastr.error("No se ha actualizado.");
                }
            }
        });
    }
}