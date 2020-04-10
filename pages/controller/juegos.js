document.title += " Juegos"
document.getElementById("content-t").textContent = "Juegos";
document.getElementById("bread").textContent = "Dashboard";

var node = document.createElement("LI");
var textnode = document.createTextNode("Juegos");
node.appendChild(textnode);
document.getElementById("bread-line").appendChild(node);
node.className = "breadcrumb-item active";

document.getElementById("menu-juegos").className += " active";

var datos;
var consolas;

$(document).ready(function () {
    $.ajax({
        data: '',
        url: '../model/juego.php?action=read',
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function () {
        },
        success: function (response) {
            //$('#datos').html(response);
            datos = JSON.parse(response);
            //console.log(datos);
            actualizarTabla();
            //console.log(datos);
        }
    });
});

$(document).ready(function () {
    $.ajax({
        data: '',
        url: '../model/juego.php?action',
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function () {
        },
        success: function (response) {
            //$('#datos').html(response);
            consolas = JSON.parse(response);
            var select = document.getElementById('consola');

            for (consola of consolas) {
                var opt = document.createElement('option');
                opt.innerHTML = consola.id_consola + ' - ' + consola.nombre_plataforma
                opt.setAttribute('value', consola.id_consola);
                select.add(opt);
            }
            //console.log(datos);
        }
    });
});

function actualizarTabla() {
    var tabla = $('#example1').DataTable();
    tabla.clear();
    for (dato of datos) {
        //console.log(dato)
        $estado = "<span class='badge badge-success'>Activo</span>";
        if (dato.estado == 1) {
            $estado = "<span class='badge badge-success'>Activo</span>";
        } else {
            $estado = "<span class='badge badge-danger'>Inactivo</span>";
        }
        tabla.row.add([
            dato.titulo,
            dato.nombre_plataforma,
            dato.id_consola,
            $estado,
            "<div class='btn-group'> <button type='button' class='btn btn-warning'  onclick='prepararActualizacion(" + dato.id_juego + ")' data-toggle='modal' data-target='#modal-lg'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger' onclick='eliminar(" + dato.id_juego + ")'><i class='fas fa-trash'></i></button> </div>"
        ]).draw(false);
    }
}

function getImg(id) {
    archivo = document.getElementById(id).files;
    if (archivo && archivo[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#juego-img').attr('src', e.target.result);
        }

        reader.readAsDataURL(archivo[0]); // convert to base64 string
    }
}

function validarFoto(id) {
    var archivo = document.getElementById(id).value;
    var ext = archivo.substring(archivo.lastIndexOf('.') + 1);

    if (ext == 'png' || ext == 'jpg' || ext == 'jpeg') {
        getImg(id);
        return true;
    } else {
        return false;
    }
}

function prepararRegistro() {
    document.getElementById("btn-gamer").onclick = guardar;
    document.getElementById("titulo").innerHTML = "Registrar juego";

    var myform = document.getElementById('form');
    myform.reset();
    for (var i = 0; i < myform.elements.length; i++) {
        myform.elements[i].className = "form-control";
    }
}

function guardar() {
    if (validarCampos("form", "create")) {
        var parametros = new FormData($('#form')[0]);
        $.ajax({
            data: parametros,
            url: '../model/juego.php?action=create',
            type: 'POST',
            contentType: false,
            processData: false,
            beforeSend: function () {
                //$('#modal-sm').modal('show');
                $('#modal-lg').modal('hide');
            },
            success: function (response) {
                console.log(response);
                if (response != "error") {
                    var dato = JSON.parse(response);
                    var tabla = $('#example1').DataTable();
                    datos.push(dato);
                    actualizarTabla();
                    toastr.success("Juego registrado exitosamente.");
                } else {
                    toastr.error("El registro no se ha podido realizar.");
                }
            }
        });
    }
}

function prepararActualizacion(id_juego) {

    var myform = document.getElementById('form');
    document.getElementById("btn-gamer").onclick = actualizar;
    document.getElementById("titulo").innerHTML = "Modificar juego";

    myform.reset();
    //console.log("modificando gamer");

    var index = datos.findIndex(obj => obj.id_juego == id_juego);

    document.getElementById("juego-img").setAttribute("src", datos[index].imagen);

    document.getElementById("id_juego").value = datos[index].id_juego;
    document.getElementById("titulo_juego").value = datos[index].titulo;
    document.getElementById("consola").value = datos[index].id_consola;


    for (var i = 0; i < myform.elements.length; i++) {
        vacio(myform.elements[i].id);
    }
}

function actualizar() {
    if (validarCampos('form', 'update')) {
        var parametros = new FormData($('#form')[0]);
        $.ajax({
            data: parametros,
            url: '../model/juego.php?action=update',
            type: 'POST',
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#modal-lg').modal('hide');
            },
            success: function (response) {
                //console.log(response);
                if (response != 'error') {
                    //console.log(response);
                    var index = datos.findIndex(obj => obj.id_juego == document.getElementById('id_juego').value);

                    datos[index] = {};
                    datos[index] = JSON.parse(response);
                    actualizarTabla();

                    toastr.success("Consola actualizado exitosamente.");
                } else {
                    console.log(response);
                    toastr.error("No se ha actualizado.");
                }
            }
        });
    }
}

function eliminar(id_juego) {
    var estadoLocal = 0;
    var index = datos.findIndex(obj => obj.id_juego == id_juego)
    var estado_actual = datos[index].estado;

    if (estado_actual == 0) {
        estadoLocal = 1;
    } else {
        estadoLocal = 0;
    }

    $.ajax({
        data: '',
        url: '../model/juego.php?action=delete&id_juego=' + id_juego + '&estado=' + estadoLocal,
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function () {
            // $('#modal-sm').modal('toggle');
        },
        success: function (response) {
            // $('#modal-sm').modal("toggle");
            if (response == "success") {
                toastr.success("Estado actualizado exitosamente.");
                datos[index].estado = estadoLocal;
                actualizarTabla();
            } else {
                toastr.error("No ha sido posible actualizar el estado.");
            }

        }
    });
}