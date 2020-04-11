<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>

<script>
    var mensajeVacios = "";
    $(function() {
        $("#example1").DataTable({
            "ordering": false,
            "autoWidth": false,
        });
        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": true,
        });

        //Initialize Select2 Elements
        $('.select2').select2()
    });

    $(document).ready(function() {
        bsCustomFileInput.init();
    });

    function vacio(id) {
        if (document.getElementById(id).value == '') {
            document.getElementById(id).className = "form-control is-invalid";
        } else {
            document.getElementById(id).className = "form-control is-valid";
        }
    }

    function validarCorreo(id) {
        console.log(document.getElementById(id).value);
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById(id).value)) {
            document.getElementById(id).className = "form-control is-valid";
            return true;
        } else {
            document.getElementById(id).className = "form-control is-invalid";
            return false;
        }
    }

    function isLetterKey(evt) {
        var charCode = (evt.which) ? evt.which : window.event.keyCode;

        if (charCode <= 13) {
            return true;
        } else {
            var keyChar = String.fromCharCode(charCode);
            var re = /^[a-zA-Z ]+$/
            return re.test(keyChar);
        }
    }

    function isNumberKey(evt) {
        var e = evt || window.event;
        var charCode = e.which || e.keyCode;
        if (charCode > 31 && (charCode < 47 || charCode > 57)) {
            return false;
        }
        if (e.shiftKey) {
            return false;
        }
        return true;
    }

    function validarCampos(form, action) {
        var myform = document.getElementById(form);
        //console.log(myform.elements)
        for (var i = 0; i < myform.elements.length; i++) {
            if (action == 'update' && myform.elements[i].type == 'file') {

            } else if (myform.elements[i].value == '') {
                mensajeVacios += "El campo " + myform.elements[i].name + " es requerido. \n";
                toastr.error("El campo " + myform.elements[i].name + " es requerido.");
            } else if (myform.elements[i].type == "email") {
                if (!validarCorreo(myform.elements[i].id)) {
                    mensajeVacios += "Direccion de correo electronico no valida \n";
                    toastr.error("Direccion de correo electronico no valida.");
                }
            }
        }

        ///alert(mensajeVacios);

        if (mensajeVacios == "") {
            mensajeVacios = "";
            return true;
        } else {
            mensajeVacios = "";
            return false;
        }
    }
</script>