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
            console.log(premios);

            for(premio of premios){
                var div = document.getElementById('premios');
                var lugar = document.createElement('div');
                lugar.className = "col-md-1";
                var pos = document.createElement('b');

                pos.innerText = premio.lugar+'º';
                lugar.appendChild(pos);
                div.appendChild(lugar);

                var price = document.createElement('div');
                price.innerText = premio.nombre_premio;
                price.className = "col-md-11";
                div.appendChild(price);
            }
        }
    });
});