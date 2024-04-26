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
                      <a href="<?= base_url()?>configuration/User/add" class="btn btn-otline-dark align-items-center active"><i class="mdi mdi-account-plus"></i> Nouveau</a>
                      <a href="<?= base_url()?>configuration/User/Listing" class="btn btn-otline-dark"><i class="icon-printer"></i> List</a>
                      <a href="<?= base_url()?>configuration/User" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                    </div>
                  </div>
                </div>
                
             </div>
              </div>
            </div>s
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="row">
                  <div class="col-md-12">
          
                  <div class="card card-success">
              <div class="card-header bg-primary">
                <h3 class="card-title">Modificaion d'un utilisateur</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="FormData" action="<?php echo base_url()?>configuration/User/update" method="POST" enctype="multipart/form-data">
                <div class="card-body row">
                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">Nom <spam class="text-danger">*</spam> </label>
                    <input type="text" class="form-control" id="NOM" name="NOM" value="<?php echo $data['NOM']?>">
                    <input type="hidden" class="form-control" id="ID_USER" name="ID_USER" value="<?php echo $data['ID_USER']?>">
                    <?php echo form_error('NOM', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">Pr&eacute;nom <spam class="text-danger">*</spam> </label>
                    <input type="text" class="form-control" id="PRENOM" name="PRENOM"  value="<?php echo $data['PRENOM']?>">
                    <?php echo form_error('PRENOM', '<div class="text-danger">', '</div>'); ?>
                  </div>

                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">Username<spam class="text-danger">*</spam> </label>
                    <input type="mail" class="form-control" id="USERNAME" name="USERNAME" value="<?php echo $data['USERNAME']?>">
                    <?php echo form_error('USERNAME', '<div class="text-danger">', '</div>'); ?>
                  </div>

                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">Password<spam class="text-danger">*</spam> </label><br>
                    Le mot de passe doit etre change par l'utilisateur
                    <?php echo form_error('PASSWORD', '<div class="text-danger">', '</div>'); ?>
                  </div>

                  
                  <div class="form-group col-lg-12">
                    <label for="exampleInputEmail1">Profile <spam class="text-danger">*</spam> </label>
                    <select class="custom-select" name="PROFIL_ID" id="PROFIL_ID">
                          <option>-- Select --</option>
                          <?php
                          foreach ($profil as $profils) {
                            if ($profils['PROFIL_ID'] == $data['PROFIL_ID']) {
                              echo"<option value='".$profils['PROFIL_ID']."' selected>".$profils['DESCRIPTION']."</option>";
                            }
                            else{
                              echo"<option value='".$profils['PROFIL_ID']."'>".$profils['DESCRIPTION']."</option>";
                            }
                           
                          }
                          ?>
                        </select>
                    
                    <?php echo form_error('PROFIL_ID', '<div class="text-danger">', '</div>'); ?>
                  </div> 
                  
                  
                  
                  
                  
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
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