
  <link rel="stylesheet" href="<?=base_url()?>styles/css.css">
  <?php
  include VIEWPATH.'includes/new_header.php';
  ?>


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
                    <a id="button1" href="<?= base_url()?>configuration/Customer/add" class="btn btn-outline-primary"><i class="mdi mdi-account-plus"></i>Nouveau</a>
                    <a id="button2" href="<?= base_url()?>configuration/Customer/Listing" class="btn btn-outline-primary active"> <i class="mdi mdi-apps"></i>List</a>
                    <a id="button3" href="<?= base_url()?>configuration/Import" class="btn btn-outline-primary  me-0"><i class="icon-download"></i>Import</a>
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
                  <section class="content-header overflow-auto" style="height: 90%;">
                  <div class="container-fluid">
                    <div class="row mb-2">
                    <section class="content mt-3">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-12">
                          
            <!-- /.card -->

            <?php 
                          if(!empty($this->session->flashdata('message')))
                             echo $this->session->flashdata('message');
            ?>

                <div class="card card-success">
                  <div class="card-header bg-primary">
                    <h3 class="card-title text-center text-light">Liste des Clients d&eacute;j&agrave; enregistr&eacute;</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                      <table id="customer" class="table table-bordered table-striped responsive table-hover display nowrap" cellspacing="0" style="height:30vh;">
                   <thead>
                      <tr>
                        <th>Nom Client</th>
                        <th>Identite</th>
                        <th>Colline</th>
                        <th>Commune</th>
                        <th>Province</th>
                        <th>Date de Naissance</th>
                        <th>Genre</th>
                        <th>Categorie</th>
                        <th>Reprsente Par</th>
                        <th>telephone</th>
                        <th>Membres</th>
                        <th>Zone</th>
                        <th>Status</th>
                        <th>Actions</th>
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
                            $stitr = 'voulez-vous désactiver cet utilisateur ';
                            $bigtitr = 'Désactivation de cet utilisateur';
                          }
                          else{
                            $stat = 'Innactif';
                            $fx = 'reactiver';
                            $col = 'btn-success';
                            $titr = 'Réactiver';
                            $stitr = 'voulez-vous réactiver cet  utilisateur';
                            $bigtitr = 'Réactivation de cet  utilisateur';
                          }
                          if ($key['GENDER']==1) {
                            $gender="Male";
                          }elseif (['GENDER']==1) {
														
                            $gender="FEMME";
													}else{
                            $gender=""; 
                          }
                          
                        echo "<tr>
                        <td>".$key['CUSTOMER_NAME']."</td>
                        <td>".$key['IDENTITY_NUMBER']."</td>
                        <td>".$key['COLLINE']."</td>
                        <td>".$key['COMMUNE']."</td>
                        <td>".$key['PROVINCE']."</td>
                        <td>".$key['BIRTH_DAY']."</td>
                        <td>".$gender."</td>
                        <td>".$key['CATEGORY']."</td>
                        <td>".$key['REPRESENT_BY']."</td>
                        <td>".$key['MOBILE_NUMBER']."</td>
                        <td>".$key['NBRE_MEMBER']."</td>
                        <td>".$key['ZONE']."</td>
                        <td>".$stat."</td>
                        <td><div class='modal fade' id='desactcat".$key['CUSTOMER_ID']."' tabindex='-1' role='dialog' aria-labelledby='basicModal' aria-hidden='true'>
                        <div class='modal-dialog'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h4 class='modal-title' id='myModalLabel'>".$bigtitr."</h4>
                              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                              </button>
                            </div>
                            <div class='modal-body'>
                              <div ><b>Mr/Mme , </b> ".$stitr." (".$key['CUSTOMER_NAME'].")?</div>
                            </div>
                            <div class='modal-footer'>
                              <button type='button' class='btn btn-default' data-dismiss='modal'>Annuler</button>
                              <a href='".base_url("configuration/Customer/".$fx."/".$key['CUSTOMER_ID'])."' class='btn ".$col."'>".$titr."</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                                <div class='dropdown '>
                                          <a class='btn btn-primary btn-sm dropdown-toggle' data-bs-toggle='dropdown'>Actions
                                          <span class='caret'></span></a>
                                          <ul class='dropdown-menu dropdown-menu-right'>
                                          <li><a class='dropdown-item' href='".base_url("configuration/Customer/index_update/".$key['CUSTOMER_ID'])."'> Modifier </a> </li>
                                          <li><a class='dropdown-item' href='#' data-bs-toggle='modal' data-bs-target='#desactcat".$key['CUSTOMER_ID']."'> ".$titr." </a> </li>
                                          </ul>
                                        </div></td>
                      </tr>";
                      
                      
                      // $tabledata[]=$chambr;
                    }
                    ?>
              </tfoot>
         </table>
                      </div>
                    </div>
                  </div>
                  <div class="card-body table-responsive">
         
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
href="<?= base_url()?>configuration/Customer" target="_blank">pnseb</a> from Burundi.</span>
<span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 202. All rights reserved.</span>
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
  // $(function () {
  //   $("<?= base_url()?>configuration/Customerexample1").DataTable({
  //     "responsive": true, "lengthChange": false, "autoWidth": false,
  //     "buttons": ["excel", "pdf", "print", "colvis"]
  //   }).buttons().container().appendTo('<?= base_url()?>configuration/Customerexample1_wrapper  .col-md-6:eq(0)');
  //   $(this).removeClass('btn-default').addClass('btn-success btn-dark');
   
  // });
$(document).ready(function() {
    $('#customer').DataTable({
        responsive: true
    });
});
</script>

<?php
  include VIEWPATH.'includes/js_site.php';
  ?>
<script src="<?=base_url()?>styles/script.js"></script>

 
</body>

</html>
