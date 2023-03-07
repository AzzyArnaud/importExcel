<?php
        $url = config_item('base_url');
        $elements = explode("/", $url);
        $nouveau_url = null ;
        $indice = sizeof($elements);
        for ($i = 0; $i < ($indice - 1); $i++) {
            $nouveau_url .=$elements[$i] . '/';
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pharmacie St Raphael</title>
  <link rel="icon" type="image/x-icon" href="<?php echo $nouveau_url ?>dist/straphael_favicon.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini accent-success">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">     
      
    </ul>
  </nav>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

      <li class="nav-item">
            <a href="#" onclick="history.back()" class="nav-link">
              <i class="nav-icon fa fa-arrow-left"></i>
              <p>
                Retours
              </p>
            </a>
          </li>
        </ul>
      </nav>

      
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Page non trouv&eacute;</h1>
          </div>
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-success"> 404</h2>

        <div class="error-content">
          <h3><i class="fas fa-exclamation-triangle text-success"></i>404 Oups! Quelque chose s'est mal passé.</h3>

          <p>
            Nous allons travailler à corriger cela tout de suite.
            En attendant, vous pouvez <a href="#" onclick="history.back()" class="text-success"> revenir en arrière.</a> 
          </p>

          
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
   
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo $nouveau_url ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo $nouveau_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $nouveau_url ?>dist/js/adminlte.min.js"></script>
</body>
</html>