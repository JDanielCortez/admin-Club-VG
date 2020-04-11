document.title += " Monedas"
document.getElementById("content-t").textContent = "Cambios";
document.getElementById("bread").textContent = "Dashboard";

var node = document.createElement("LI");
var textnode = document.createTextNode("Monedas");
node.appendChild(textnode);
document.getElementById("bread-line").appendChild(node);
node.className = "breadcrumb-item active";

document.getElementById("p-monedas").className += " menu-open";
document.getElementById("monedas").className += " active";
document.getElementById("cambios").className += " active";

var datos;
var gamers;

$(document).ready(function () {
    $.ajax({
        data: '',
        url: '../model/cambio.php?action=read',
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
        url: '../model/cambio.php?action',
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function () {
        },
        success: function (response) {
            gamers = JSON.parse(response);
            var select = document.getElementById('gamer');

            for (gamer of gamers) {
                var opt = document.createElement('option');
                opt.innerHTML = gamer.nombre_usuario
                opt.setAttribute('value', gamer.id_usuario);
                select.add(opt);
            }
        }
    });
});

function actualizarTabla() {
    var tabla = $('#example1').DataTable();
    tabla.clear();
    for (dato of datos) {
        tabla.row.add([
            dato.nombre_usuario,
            dato.cantidad_usada,
            dato.motivo,
            dato.cantidad_restante,
            dato.fecha,
            dato.hora,
        ]).draw(false);
    }
}

function prepararRegistro() {
    var myform = document.getElementById('form');
    myform.reset();
    document.getElementById("btn-gamer").onclick = asignar;
    document.getElementById("titulo").innerHTML = "Asignar monedas";
    document.getElementById('aumento').className = "form-control";
    if (document.getElementById('motivo')) {
        document.getElementById('motivo').remove();
    }
}

function datosGamer() {
    var id_gamer = document.getElementById('gamer').value;

    if (id_gamer != 0) {
        var index = gamers.findIndex(obj => obj.id_usuario == id_gamer);

        document.getElementById('nombre').value = gamers[index].nombre;
        document.getElementById('moneda').value = gamers[index].monedas;
    } else {
        document.getElementById('nombre').value = "";
        document.getElementById('moneda').value = "";
    }
}

function asignar() {
    if (validarCampos("form", "update")) {
        var parametros = new FormData($('#form')[0]);
        $.ajax({
            data: parametros,
            url: '../model/cambio.php?action=update&m=' + document.getElementById('moneda').value,
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
                    var id = document.getElementById('gamer').value;
                    var index = gamers.findIndex(obj => obj.id_usuario == id);

                    gamers[index].monedas = parseInt(document.getElementById('aumento').value) + parseInt(gamers[index].monedas);
                    toastr.success("Monedas asignadas exitosamente.");
                } else {
                    toastr.error("La asignacion no se ha podido realizar.");
                }
            }
        });
    }
}

function prepararCambio() {
    var myform = document.getElementById('form');
    myform.reset();
    document.getElementById("btn-gamer").onclick = cambiar;
    document.getElementById("titulo").innerHTML = "Cambiar monedas";
    document.getElementById('aumento').className = "form-control";

    if (document.getElementById('motivo')) {
        document.getElementById('motivo').remove();
    }

    var input = document.createElement('textArea');
    input.className = "form-control";
    input.id = 'motivo';
    input.name = "Motivo";
    input.placeholder = "Ingrese motivo de cambio de monedas";

    myform.appendChild(input);
}

function cambiar() {
    if (validarCampos("form", "create")) {
        var parametros = new FormData($('#form')[0]);
        $.ajax({
            data: parametros,
            url: '../model/cambio.php?action=create&m='+ document.getElementById('moneda').value,
            type: 'POST',
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#modal-lg').modal('hide');
            },
            success: function (response) {
                //console.log(response);
                if (response != "error") {
                    var dato = JSON.parse(response);
                    datos.push(dato);
                    actualizarTabla();
                    var id_gamer = document.getElementById('gamer').value;
                    var index = gamers.findIndex(obj => obj.id_usuario == id_gamer);
                    gamers[index].monedas = parseInt(gamers[index].monedas) - parseInt(document.getElementById('aumento').value);
                    toastr.success("Cambio registrado exitosamente.");
                } else {
                    toastr.error("El cambio no se ha podido realizar.");
                }
            }
        });
    }
}