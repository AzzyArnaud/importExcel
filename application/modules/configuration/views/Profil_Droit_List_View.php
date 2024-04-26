<?php
  include VIEWPATH.'includes/new_header.php';
  ?>


<link rel="stylesheet" href="<?=base_url()?>styles/css.css">
<body class="with-welcome-text">
  <div class="container-scroller">

  <?php
    include VIEWPATH.'includes/header.php';
  ?>

    <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    
    <?php
      include VIEWPATH.'includes/setting_color.php';
    ?>
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->


    <?php
      include VIEWPATH.'includes/new_menu_principal.php';
    ?>
     <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <div></div>
                  <div>
                    <div class="btn-wrapper">
                      <a id="button1" href="<?= base_url()?>configuration/Profil_Droit/add" class="btn btn-otline-primary "><i class="mdi mdi-account-plus"></i> Nouveau</a>
                      <a id="button2" href="<?= base_url()?>configuration/Profil_Droit/Listing" class="btn btn-otline-primary active"> <i class="mdi mdi-apps"></i> List</a>
                    </div>
                  </div>
                </div>
                
             </div>
              </div>
            </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="row">
                  <div class="col-md-12">
                  <section class="content-header">
                  <div class="container-fluid">
                    <div class="row mb-2">
 
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                            <div class="col-12">
                                <div class="card card-success">
                                <div class="card-header bg-primary">
                                <h3 class="card-title text-light text-center">Liste des profils et droits d&eacute;j&agrave; enregistr&eacute;</h3>
                                </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="customer" class="table table-bordered table-striped table-hover overflow-auto" style="height: 300px;">
                                <thead>
                                                <tr>
                                    <th>Description</th>
                                    <th>Droit</th>
                                    <th>Options</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                    foreach ($resultat as $key) 
                                    {
                                    
                                    
                                    $droits = $this->Model->getRequete('SELECT config_droits.DESCRIPTION AS DROIT FROM `config_profil` JOIN config_profil_droit ON config_profil_droit.PROFIL_ID = config_profil.PROFIL_ID JOIN config_droits ON config_droits.ID_DROIT = config_profil_droit.ID_DROIT WHERE config_profil_droit.PROFIL_ID = '.$key['PROFIL_ID'].' ');
                                    $resdroit ="<table class='table'>";
                                    foreach ($droits as $value) {
                                        $resdroit.="<tr><td>".$value['DROIT']."</td></tr>";
                                    }
                                    $resdroit.="</table>";
                                    
                                    echo "<tr>
                                    <td>".$key['DESCRIPTION']."</td>
                                    <td><a class='btn btn-primary btn-xs' href='#' data-toggle='modal' data-target='#rendreeff".$key['PROFIL_ID']."'> ".$key['NUMBER']." </a></td>
                                    <td>
                                <div class='modal fade' id='rendreeff".$key['PROFIL_ID']."' tabindex='-1' role='dialog' aria-labelledby='basicModal' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                        <h4 class='modal-title' id='myModalLabel'>".$key['DESCRIPTION']."</h4>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                        </div>
                                        <div class='modal-body'>
                                        ".$resdroit."
                                        </div>
                                        <div class='modal-footer'>
                                        <button type='button' class='btn btn-default' data-dismiss='modal'>Fermer</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                                <div class='dropdown'>
                                        <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton1'
                                        data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='true'>
                                        Action
                                        </button>
                                        <div class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>
                                        <span class='caret'></span></a>
                                    
                                        <a class='dropdown-item' href='".base_url("configuration/Profil_Droit/index_update/".$key['PROFIL_ID'])."'> Modifier </a>
                                        
                                    
                                        </div>
                                    </div></td>
                                </tr>";
                        
                                    
                                                    
                                // $tabledata[]=$chambr;
                                }
                                ?>
                                
                                </tfoot>
                                </table>
                            </div>
                                            <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        </section>


                  </div>
                </div>
              </div>
            </div>
          


    
  <?php
  include VIEWPATH.'includes/new_script.php';
  ?>
  <script>
  $(document).ready(function() {
    $('#customer').DataTable({
        responsive: true
    });
});
</script>

  <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper  .col-md-6:eq(0)');
    $(this).removeClass('btn-default').addClass('btn-success btn-dark');
   
  });
</script>
<script src="<?=base_url()?>styles/script.js"></script>

</body>

</html>