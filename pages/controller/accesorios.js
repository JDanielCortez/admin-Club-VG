document.title += " Accesorios"
document.getElementById("content-t").textContent = "Accesorios";
document.getElementById("bread").textContent = "Dashboard";

var node = document.createElement("LI");
var textnode = document.createTextNode("Accesorios");
node.appendChild(textnode);
document.getElementById("bread-line").appendChild(node);
node.className = "breadcrumb-item active";


document.getElementById("p-menu-accesorios").className += " menu-open";
document.getElementById("menu-accesorios").className += " active";
document.getElementById("s-menu-accesorios").className += " active";

var datos;
var tipos;

$(document).ready(function () {
    $.ajax({
        data: '',
        url: '../model/accesorio.php?action=read',
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
        url: '../model/accesorio.php?action',
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function () {
        },
        success: function (response) {
            //$('#datos').html(response);
            tipos = JSON.parse(response);
            var select = document.getElementById('accesorio');

            for (tipo of tipos) {
                var opt = document.createElement('option');
                opt.innerHTML = tipo.id_tipo_accesorio + ' - ' + tipo.tipo_accesorio
                opt.setAttribute('value', tipo.id_tipo_accesorio);
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
            dato.id_accesorio,
            dato.tipo_accesorio,
            '$' + dato.costo,
            $estado,
            "<div class='btn-group'> <button type='button' class='btn btn-warning'  onclick='prepararActualizacion(" + dato.id_accesorio + ")' data-toggle='modal' data-target='#modal-lg'><i class='fas fa-edit'></i></button> <button type='button' class='btn btn-danger' onclick='eliminar(" + dato.id_accesorio + ")'><i class='fas fa-trash'></i></button> </div>"
        ]).draw(false);
    }
}

function prepararRegistro() {
    document.getElementById("btn-gamer").onclick = guardar;
    document.getElementById("titulo").innerHTML = "Registrar accesorio";

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
            url: '../model/accesorio.php?action=create',
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
                    datos.push(dato);
                    actualizarTabla();
                    toastr.success("Accesorio registrado exitosamente.");
                } else {
                    toastr.error("El registro no se ha podido realizar.");
                }
            }
        });
    }
}

function prepararActualizacion(id_accesorio) {

    var myform = document.getElementById('form');
    document.getElementById("btn-gamer").onclick = actualizar;
    document.getElementById("titulo").innerHTML = "Modificar accesorio";

    myform.reset();

    var index = datos.findIndex(obj => obj.id_accesorio == id_accesorio);

    document.getElementById("id_accesorio").value = datos[index].id_accesorio;
    document.getElementById("accesorio").value = datos[index].id_tipo_accesorio;
    document.getElementById("costo").value = datos[index].costo;


    for (var i = 0; i < myform.elements.length; i++) {
        vacio(myform.elements[i].id);
    }
}

function actualizar() {
    if (validarCampos('form', 'update')) {
        var parametros = new FormData($('#form')[0]);
        $.ajax({
            data: parametros,
            url: '../model/accesorio.php?action=update',
            type: 'POST',
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#modal-lg').modal('hide');
            },
            success: function (response) {
                //console.log(response);
                if (response != 'error') {
                    var index = datos.findIndex(obj => obj.id_accesorio == document.getElementById('id_accesorio').value);

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

function eliminar(id_accesorio) {
    var estadoLocal = 0;
    var index = datos.findIndex(obj => obj.id_accesorio == id_accesorio)
    var estado_actual = datos[index].estado;

    if (estado_actual == 0) {
        estadoLocal = 1;
    } else {
        estadoLocal = 0;
    }

    $.ajax({
        data: '',
        url: '../model/accesorio.php?action=delete&id_accesorio=' + id_accesorio + '&estado=' + estadoLocal,
        type: 'GET',
        contentType: false,
        processData: false,
        beforeSend: function () {
        },
        success: function (response) {
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
