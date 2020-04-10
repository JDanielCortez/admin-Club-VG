document.title += " Catalogo"
document.getElementById("content-t").textContent = "Catalogo de accesorios";
document.getElementById("bread").textContent = "Dashboard";

var node = document.createElement("LI");
var textnode = document.createTextNode("Catalogo");
node.appendChild(textnode);
document.getElementById("bread-line").appendChild(node);
node.className = "breadcrumb-item active";


document.getElementById("p-menu-accesorios").className += " menu-open";
document.getElementById("menu-accesorios").className += " active";
document.getElementById("s-menu-catalogo-a").className += " active";

var datos;
$(document).ready(function () {
    $.ajax({
        data: '',
        url: '../model/catalogo-a.php?action=read',
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
            dato.tipo_accesorio
        ]).draw(false);
    }
}