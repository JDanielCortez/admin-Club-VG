document.title += " Torneos"
document.getElementById("content-t").textContent = "Torneos";
document.getElementById("bread").textContent = "Dashboard";

var node = document.createElement("LI");
var textnode = document.createTextNode("Torneos");
node.appendChild(textnode);
document.getElementById("bread-line").appendChild(node);
node.className = "breadcrumb-item active";

document.getElementById("menu-torneos").className += " active";

var datos;
var juegos;
var modalidades;
var estatues;

$(document).ready(function () {
    $.ajax({
        data: '',
        url: '../model/torneo.php?action=read',
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function () {
            console.log("cargando datos")
        },
        success: function (response) {
            //$('#datos').html(response);
            datos = JSON.parse(response);
            console.log(datos);
            actualizarTabla();
            //console.log(datos);
        }
    });
});

$(document).ready(function () {
    $.ajax({
        data: '',
        url: '../model/torneo.php?action=read-juegos',
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function () {
            console.log("cargando datos")
        },
        success: function (response) {
            //$('#datos').html(response);
            juegos = JSON.parse(response);

            var select = document.getElementById('juego');

            for (juego of juegos) {
                var opt = document.createElement('option');
                opt.innerHTML = juego.titulo
                opt.setAttribute('value', juego.id_juego);
                select.add(opt);
            }
            //console.log(juegos);
        }
    });
});

$(document).ready(function () {
    $.ajax({
        data: '',
        url: '../model/torneo.php?action=read-modalidades',
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function () {
            console.log("cargando datos")
        },
        success: function (response) {
            //$('#datos').html(response);
            modalidades = JSON.parse(response);

            var select = document.getElementById('modalidad');

            for (modalidad of modalidades) {
                var opt = document.createElement('option');
                opt.innerHTML = modalidad.nombre_modalidad
                opt.setAttribute('value', modalidad.id_modalidad);
                select.add(opt);
            }
            //console.log(juegos);
        }
    });
});

$(document).ready(function () {
    $.ajax({
        data: '',
        url: '../model/torneo.php?action=read-status',
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function () {
            console.log("cargando datos")
        },
        success: function (response) {
            //$('#datos').html(response);
            estatues = JSON.parse(response);

            var select = document.getElementById('estatus');

            for (estatus of estatues) {
                var opt = document.createElement('option');
                opt.innerHTML = estatus.nombre_estatus;
                opt.setAttribute('value', estatus.id_estatus);
                select.add(opt);
            }
            //console.log(juegos);
        }
    });
});

function actualizarTabla() {
    var tabla = $('#example1').DataTable();
    tabla.clear();
    for (dato of datos) {
        $estado = "<span class='badge badge-success'>Activo</span>";
        if (dato.estado == 1) {
            $estado = "<span class='badge badge-success'>Activo</span>";
        } else {
            $estado = "<span class='badge badge-danger'>Inactivo</span>";
        }
        tabla.row.add([
            dato.titulo,
            dato.juego,
            dato.nombre_modalidad,
            dato.nombre_estatus,
            dato.max_jugadores,
            dato.fecha + ' ' + dato.hora,
            $estado,
            "<div class='btn-group'><div class='btn-group'> <button type='button' class='btn btn-info'  onclick='redireccionar(" + dato.id_torneo + ")'><i class='fas fa-eye'></i></button></i></button> </div> <button type='button' class='btn btn-warning'  onclick='prepararActualizacion(" + dato.id_torneo + ")' data-toggle='modal' data-target='#modal-lg'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger' onclick='eliminar(" + dato.id_torneo + ")'><i class='fas fa-trash'></i></button> </div>"

        ]).draw(false);
    }
}

function redireccionar(id_torneo) {
    window.location.href = "torneo.php?torneo=" + id_torneo;
}

function prepararRegistro() {
    document.getElementById("btn-gamer").onclick = guardar;
    document.getElementById("titulo").innerHTML = "Registrar Torneo";

    var myform = document.getElementById('form');
    myform.reset();
    for (var i = 0; i < myform.elements.length; i++) {
        if (myform.elements[i].type != 'select-one') {
            myform.elements[i].className = "form-control";
        }
    }
}

function guardar() {
    if (validarCampos("form", "create")) {
        var parametros = new FormData($('#form')[0]);
        $.ajax({
            data: parametros,
            url: '../model/torneo.php?action=create',
            type: 'POST',
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#modal-lg').modal('hide');
            },
            success: function (response) {
                console.log(response);
                if (response != "error") {
                    var dato = JSON.parse(response);
                    datos.push(dato);
                    actualizarTabla();
                    toastr.success("Torneo registrado exitosamente.");
                } else {
                    toastr.error("El registro no se ha podido realizar.");
                }
            }
        });
    }
}

function eliminar(id_torneo) {
    var estadoLocal = 0;
    var index = datos.findIndex(obj => obj.id_torneo == id_torneo)
    var estado_actual = datos[index].estado;

    if (estado_actual == 0) {
        estadoLocal = 1;
    } else {
        estadoLocal = 0;
    }

    $.ajax({
        data: '',
        url: '../model/torneo.php?action=delete&id_torneo=' + id_torneo + '&estado=' + estadoLocal,
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