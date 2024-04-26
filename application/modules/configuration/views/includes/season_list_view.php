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
                      <a id="button1" href="<?= base_url()?>configuration/Season/add" class="btn btn-otline-primary "><i class="mdi mdi-account-plus"></i> Nouveau</a>
                      <a id="button2" href="<?= base_url()?>configuration/Season/Listing" class="btn btn-otline-primary active"><i class="mdi mdi-apps"></i> List</a>
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
                    <section class="content mt-3 overflow-auto" style="height: 80%;">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-12">
                          
            <!-- /.card -->

            <?php 
                          if(!empty($this->session->flashdata('message')))
                             echo $this->session->flashdata('message');
            ?>

                <div class="card card-success" >
                  <div class="card-header bg-primary">
                    <h3 class="card-title text-center text-light">Liste des Saisons d&eacute;j&agrave; enregistr&eacute;</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="customer" class="table table-bordered table-striped table-hover">
                      <thead>
                      <tr>
                        <th>Annee</th>
                        <th>Nom Saison</th>
                        <th>Mois Debut</th>
                        <th>Mois Fin</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>

                      <?php
                        foreach ($resultat as $key) 
                        {
                        
                          if ($key['STATUS'] == 1) {
                            $stat = 'Actif';
                            $fx = 'desactiver';
                            $col = 'btn-danger';
                            $titr = 'Désactiver';
                            $stitr = 'voulez-vous désactiver cet produit ';
                            $bigtitr = 'Désactivation de cet produit';
                          }
                          else{
                            $stat = 'Innactif';
                            $fx = 'reactiver';
                            $col = 'btn-success';
                            $titr = 'Réactiver';
                            $stitr = 'voulez-vous réactiver cet  produit';
                            $bigtitr = 'Réactivation de cet  utilisateur';
                          }
                          
                          
                        echo "<tr>
                        <td>".$key['YEAR']."</td>
                        <td>".$key['SEASON_NAME']."</td>
                        <td>".$key['SART_MONTH']."</td>
                        <td>".$key['END_MONTH']."</td>
                        <td>".$stat."</td>
                        <td><div class='modal fade' id='desactcat".$key['ID_SAISON']."' tabindex='-1' role='dialog' aria-labelledby='basicModal' aria-hidden='true'>
                        <div class='modal-dialog'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h4 class='modal-title' id='myModalLabel'>".$bigtitr."</h4>
                              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>
                            <div class='modal-body'>
                              <div ><b>Mr/Mme , </b> ".$stitr." (".$key['SEASON_NAME'].")?</div>
                            </div>
                            <div class='modal-footer'>
                              <button type='button' class='btn btn-default' data-dismiss='modal'>Annuler</button>
                              <a href='".base_url("configuration/Season/".$fx."/".$key['ID_SAISON'])."' class='btn ".$col."'>".$titr."</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                                <div class='dropdown '>
                                          <a class='btn btn-primary btn-sm dropdown-toggle' data-bs-toggle='dropdown'>Actions
                                          <span class='caret'></span></a>
                                          <ul class='dropdown-menu dropdown-menu-right'>
                                          <li><a class='dropdown-item' href='".base_url("configuration/Season/index_update/".$key['ID_SAISON'])."'> Modifier </a> </li>
                                          <li><a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#desactcat".$key['ID_SAISON']."'> ".$titr." </a> </li>
                                          </ul>
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

            </div>
            <!-- /.row -->
            <footer class="footer" style="position:fixed;buttom:0">
<div class="d-sm-flex justify-content-center justify-content-sm-between">
<span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
<span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
</div>
</footer>
          </div>
          <!-- /.container-fluid -->
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