function inciarSesion() {
    var parametros = new FormData($('#form')[0]);
    $.ajax({
        data: parametros,
        url: 'pages/model/login.php?action=iniciar',
        type: 'POST',
        contentType: false,
        processData: false,
        beforeSend: function () {
        },
        success: function (response) {
            console.log(response);
            if (response != "error") {
                window.location.href = "pages/admin/dashboard.php";
            } else {
                //toastr.error("El cambio no se ha podido realizar.");
            }
        }
    });
}

function cerrarSesion(){
    $.ajax({
        data: '',
        url: '../model/login.php?action',
        type: 'POST',
        contentType: false,
        processData: false,
        beforeSend: function () {
        },
        success: function (response) {
            console.log(response);
            if (response != "error") {
                window.location.href = "../../login.php";
            } else {
                //toastr.error("El cambio no se ha podido realizar.");
            }
        }
    });
}