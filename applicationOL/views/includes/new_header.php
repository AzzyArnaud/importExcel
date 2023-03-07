<?php
        $url = base_url();
        $elements = explode("/", $url);
      // $nouveau_url = $url ;
       $nouveau_url = null ;
        $indice = sizeof($elements);
        for ($i = 0; $i < ($indice - 2); $i++) {
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
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/dropzone/min/dropzone.min.css">


  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="<?php echo $nouveau_url ?>dist/css/adminlte.min.css"> -->
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>dist/css/adminlte.min.css">
</head>


<?php if($this->router->class == 'Login' ){ echo '<body class="hold-transition login-page">';} else{ echo '<body class="hold-transition sidebar-mini accent-success">';}  ?>







