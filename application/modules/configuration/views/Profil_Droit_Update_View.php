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
                      <a href="<?= base_url()?>configuration/Profil_Droit/add" class="btn btn-otline-dark align-items-center"><i class="mdi mdi-account-plus"></i> Nouveau</a>
                      <a href="<?= base_url()?>configuration/Profil_Droit/Listing" class="btn btn-otline-dark"><i class="icon-printer"></i> List</a>
                      <a href="<?= base_url()?>configuration/Profil_Droit" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
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
                <h3 class="card-title">Modification d'un profil et droits</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="FormData" action="<?php echo base_url()?>configuration/Profil_Droit/update" method="POST" enctype="multipart/form-data">
                <div class="card-body row">
                  <div class="form-group col-lg-12">
                    <label for="exampleInputEmail1">Nom du Profil <spam class="text-danger">*</spam> </label>
                    <input type="text" class="form-control" id="DESCRIPTION" name="DESCRIPTION" value="<?php echo $data['DESCRIPTION']?>">
                    <input type="hidden" id="PROFIL_ID" name="PROFIL_ID" value="<?php echo $data['PROFIL_ID']?>">
                    <?php echo form_error('DESCRIPTION', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <?php
                    foreach ($droits as $value) {
                      
                      $verif = $this->Model->getRequeteOne('SELECT * FROM `config_profil_droit` WHERE `PROFIL_ID` = '.$data['PROFIL_ID'].' AND `ID_DROIT` = '.$value['ID_DROIT'].'');
                      ?>
                  <div class="form-group col-lg-4 custom-control custom-checkbox">
                          <input class="custom-control-input custom-control-input-success custom-control-input-outline" type="checkbox" name="ID_DROIT[]" value="<?php echo $value['ID_DROIT']?>" id="customCheckbox<?php echo $value['ID_DROIT']?>" <?php if (!empty($verif)) {  echo 'checked';  }?> >
                          <label for="customCheckbox<?php echo $value['ID_DROIT']?>" class="custom-control-label"><?php echo $value['DESCRIPTION']?> </label>
                  </div>
                      <?php
                    }
                  ?>
                  <?php echo form_error('ID_DROIT', '<div class="text-danger">', '</div>'); ?>
                  
                  
                  
                  
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success btn-block">Enregistrer</button>
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