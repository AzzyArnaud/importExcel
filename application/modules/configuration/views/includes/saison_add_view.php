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
                      <a href="<?= base_url()?>configuration/Season/add" class="btn btn-otline-dark align-items-center active"><i class="mdi mdi-account-plus"></i> Nouveau</a>
                      <a href="<?= base_url()?>configuration/Season/Listing" class="btn btn-otline-dark"><i class="mdi mdi-apps"></i></i> List</a>
                      <!-- <a href="<?= base_url()?>configuration/Season" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a> -->
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
          
                  <div class="card card-success">
              <div class="card-header bg-primary">
                <h3 class="card-title text-light text-center">Insertion d'un Saison</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="FormData" action="<?php echo base_url()?>configuration/Season/add" method="POST" enctype="multipart/form-data">
                <div class="card-body row">
                  <div class="form-group col-lg-6">
                    <label for="YEAR">Annee <spam class="text-danger">*</spam> </label>
                    <input type="text" class="form-control" id="YEAR" name="YEAR" value="<?php echo set_value('YEAR')?>">
                    <!-- <input type="hidden" class="form-control" id="ID" name="ID_USER" value="<?php echo $data['ID']?>"> -->
                    <?php echo form_error('YEAR', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="SEASON_NAME">Nom Saison <spam class="text-danger">*</spam> </label>
                    <select name="SEASON_NAME" id="SEASON_NAME" class="form-select">
                     <option value="" class="text-center">---select--</option>
                     <option value="1" class="text-center">Saison A</option>
                     <option value="2" class="text-center">Saison B</option>
                     <option value="3" class="text-center">Saison C</option>
                    </select>
                    <?php echo form_error('SEASON_NAME', '<div class="text-danger">', '</div>'); ?>
                  </div>

                  <div class="form-group col-lg-6">
                    <label for="SART_MONTH">Commencement Mois<spam class="text-danger">*</spam> </label>
                    <input type="number" class="form-control" id="SART_MONTH" name="SART_MONTH" value="<?php echo set_value('SART_MONTH')?>">
                    <?php echo form_error('SART_MONTH', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="END_MONTH">Fin Mois<spam class="text-danger">*</spam> </label>
                    <input type="number" class="form-control" id="END_MONTH" name="END_MONTH" value="<?php echo set_value('END_MONTH')?>">
                    <?php echo form_error('END_MONTH', '<div class="text-danger">', '</div>'); ?>
                  </div>

                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
                </div>
              </form>
            </div>
        
        
        <!-- /.card-body -->
        <!-- <div class="card-footer">
          Footer
        </div> -->
        <!-- /.card-footer-->
      </div>
           
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
<!-- <footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
        href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
    <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
  </div>
</footer> -->
    
  <?php
  include VIEWPATH.'includes/new_script.php';
  ?>
</body>

</html>