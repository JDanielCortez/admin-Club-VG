<?php include_once "head.php"; ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include_once "menu.php";?>
        <div class="contenido2">
            <div class="row">
                <div class="col-md-12" id="juegos"> </div>
            </div>
        </div>
    </div>



    <?php include_once "footer.php" ?>

    <script>
        var datos;
        $(document).ready(function () {
            $.ajax({
                data: '',
                url: 'pages/model/juego.php?action=read',
                type: 'GET',
                contentType: false,
                processData: false,
                beforeSend: function () {
                },
                success: function (response) {
                    var colS = document.getElementById('juegos');
                    var row = document.createElement('div');
                    row.className = 'row';
                    colS.appendChild(row);
                    var i = 0;
                    datos = JSON.parse(response);


                    for (dato of datos) {
                        var col = document.createElement('div');
                        col.className = 'col-md-2';
                        var img = document.createElement('img');
                        img.setAttribute('src', 'dist/img/juegos_img/' + dato.titulo + '.jpg');
                        img.setAttribute('width', '100%');
                        img.setAttribute('height', '300px');
                        img.className = "rounded ";
                        col.appendChild(img);
                        row.appendChild(col);
                        i++;
                        if (i == 6) {
                            row = document.createElement('div');
                            row.className = 'row';
                            colS.appendChild(row);
                            i = 0;
                        }
                    }
                    //console.log(datos);
                }
            });
        });
    </script>