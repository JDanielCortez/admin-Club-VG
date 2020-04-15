<?php include_once "head.php"; ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <?php include_once "menu.php"; ?>
        <div class="contenido2" id="torneos">
        </div>
    </div>



    <?php include_once "footer.php" ?>

    <script>
        var datos;
        var premios;
        $(document).ready(function() {
            $.ajax({
                data: '',
                url: 'pages/model/torneo.php?action=read',
                type: 'GET',
                contentType: false,
                processData: false,
                beforeSend: function() {},
                success: function(response) {
                    //console.log(response);
                    datos = JSON.parse(response);
                    premios();
                    listar();
                }
            });
        });

        function premios() {
            var i = 0;
            for (dato of datos) {
                $.ajax({
                    data: '',
                    url: 'pages/model/ver_torneo.php?action=premios&torneo=' + dato.id_torneo,
                    type: 'GET',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {},
                    success: function(response) {
                        premios[i++] = JSON.parse(response);
                    }
                });
            }
        }

        function listar() {
            var section = document.getElementById('torneos');
            for (dato of datos) {
                var row = document.createElement('div');
                row.className= 'row';
                var col1 = document.createElement('div');
                col1.className = 'col-md-2';
                var img = document.createElement('img');
                img.setAttribute('src', 'dist/img/juegos_img/'+dato.juego+'.jpg');
                img.setAttribute('width', '100%');
                var col2 = document.createElement('div');
                col2.className = 'col-md-5';
                row2 = document.createElement('div');
                row2.className = 'row';
                col1.appendChild(img);
                row.appendChild(col1);
                row.appendChild(col2);
                col2.appendChild(row2);
                col2.innerHTML = '<h1>'+dato.titulo+'</h1><b>'+dato.descripcion+'</b><br>'+'<b>Juego: </b>'+dato.juego+'<br>'+'<b>Modalidad: </b>'+dato.nombre_modalidad+'<br><b>Fecha: </b>'+dato.fecha+'<br><b>Hora: </b>'+dato.hora+'<br><b>Estado: </b>'+dato.nombre_estatus+'<br><b>Cantidad de jugadores: </b>'+dato.max_jugadores
                section.appendChild(row);
            }
        }
    </script>