document.title += " Torneos"
document.getElementById("content-t").textContent = "Torneos";
document.getElementById("bread").textContent = "Dashboard";

var node = document.createElement("LI");
var textnode = document.createTextNode("Torneos");
node.appendChild(textnode);
document.getElementById("bread-line").appendChild(node);
node.className = "breadcrumb-item active";

document.getElementById("menu-torneos").className += " active";

var torneo;
var premios;
var participantes;
var gamers;

var id_torneo = location.search.substr(1).split("&")[0].split("=")[1];

$(document).ready(function () {
    $.ajax({
        data: '',
        url: '../model/ver_torneo.php?action=read&torneo=' + id_torneo,
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function () {
        },
        success: function (response) {
            //$('#datos').html(response);
            torneo = JSON.parse(response);
            document.getElementById('titulo_torneo').innerText = torneo.titulo;
            document.getElementById('descripcion').innerText = torneo.descripcion;
            document.getElementById('juego').innerText = torneo.juego;
            document.getElementById('modalidad').innerText = torneo.nombre_modalidad;
            document.getElementById('jugadores').innerText = torneo.max_jugadores;
            document.getElementById('estado').innerText = torneo.nombre_estatus;
            document.getElementById('fecha').innerText = torneo.fecha;
            document.getElementById('hora').innerText = torneo.hora;
            document.getElementById('img-juego').setAttribute('src', torneo.imagen)
        }
    });
});

$(document).ready(function () {
    $.ajax({
        data: '',
        url: '../model/ver_torneo.php?action=premios&torneo=' + id_torneo,
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function () {
        },
        success: function (response) {
            //$('#datos').html(response);
            premios = JSON.parse(response);
            //console.log(premios);
            actualizarTabla();
            actualizarPremios();
        }
    });
});

$(document).ready(function () {
    $.ajax({
        data: '',
        url: '../model/ver_torneo.php?action=participantes&torneo=' + id_torneo,
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function () {
        },
        success: function (response) {
            //$('#datos').html(response);
            participantes = JSON.parse(response);
            //console.log(participantes);
            actualizaParticipantes();
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
    for (premio of premios) {
        tabla.row.add([
            premio.lugar,
            premio.nombre_premio
        ]).draw(false);
    }
}

function actualizarPremios() {
    if (document.getElementById('premios')) {
        document.getElementById('premios').remove()
    }
    var contenedor = document.getElementById('contenedor');
    var div = document.createElement('div');
    div.setAttribute('id', 'premios');
    div.className = 'col-md-12';
    contenedor.appendChild(div);
    var row = document.createElement('div');
    row.className = "row";
    div.appendChild(row);

    for (premio of premios) {
        var lugar = document.createElement('div');
        lugar.className = "col-md-1";
        var pos = document.createElement('b');

        pos.innerText = premio.lugar + 'º';
        lugar.appendChild(pos);
        row.appendChild(lugar);

        var price = document.createElement('div');
        price.innerText = premio.nombre_premio;
        price.className = "col-md-11";
        row.appendChild(price);
    }
}

function actualizaParticipantes() {
    var tabla = $('#example2').DataTable();
    tabla.clear();
    for (participante of participantes) {
        tabla.row.add([
            participante.nombre_usuario,
            participante.nombre,
            participante.lugar
        ]).draw(false);
    }
}

function prepararPremio() {
    document.getElementById("btn-gamer").onclick = guardarPremio;
    document.getElementById("titulo-premio").innerHTML = "Registrar Premio";

    var myform = document.getElementById('form');
    myform.reset();
}

function prepararGamer() {
    document.getElementById("btn-gamer2").onclick = guardarParticipante;
    document.getElementById("titulo-gamer").innerHTML = "Registrar Participante";

    var myform = document.getElementById('form2');
    myform.reset();
    //alert("Form Preparado");
}

function guardarPremio() {
    if (validarCampos("form", "create")) {
        var parametros = new FormData($('#form')[0]);
        $.ajax({
            data: parametros,
            url: '../model/ver_torneo.php?action=create-premio&torneo=' + id_torneo,
            type: 'POST',
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#modal-lg').modal('hide');
            },
            success: function (response) {
                console.log(response);
                if (response != "error") {
                    var premio = JSON.parse(response);
                    premios.push(premio);
                    actualizarTabla();
                    actualizarPremios();
                    toastr.success("Premio registrado exitosamente.");
                } else {
                    toastr.error("El registro no se ha podido realizar.");
                }
            }
        });
    }
}

function guardarParticipante() {

    var parametros = $('#gamer').select2('data');
    //console.log(parametros);

    $.ajax({
        data: parametros,
        url: '../model/ver_torneo.php?action=create-participante&torneo=' + id_torneo,
        type: 'POST',
        dataType: 'JSON',
        beforeSend: function () {
            $('#modal-lg2').modal('hide');
        },
        success: function (response) {
            console.log(response);
            // if (response != "error") {
            //     var premio = JSON.parse(response);
            //     premios.push(premio);
            //     actualizarTabla();
            //     actualizarPremios();
            //     toastr.success("Torneo registrado exitosamente.");
            // } else {
            //     toastr.error("El registro no se ha podido realizar.");
            // }
        },
        error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);
        }
    });
}