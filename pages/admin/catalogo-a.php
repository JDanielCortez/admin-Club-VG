<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <?php
    include_once "head.php";
    ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php
      include_once "navbar.php";
  ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php
    include_once "menu.php"
  ?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php
    include_once "footer.php"
  ?>
</div>
<!-- ./wrapper -->

<script src="../../dist/js/adminlte.min.js"></script>

<script>
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
</script>

</body>

</html>
