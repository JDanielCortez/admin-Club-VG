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

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

<script>
    document.title += " Rentas"
    document.getElementById("content-t").textContent = "Rentas";
    document.getElementById("bread").textContent = "Dashboard";
    
    var node = document.createElement("LI");                 
    var textnode = document.createTextNode("Rentas");         
    node.appendChild(textnode);                              
    document.getElementById("bread-line").appendChild(node);
    node.className = "breadcrumb-item active";
    
    document.getElementById("menu-rentas").className += " active";
</script>

</body>

</html>
