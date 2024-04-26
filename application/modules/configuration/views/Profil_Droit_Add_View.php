<?php
  include VIEWPATH.'includes/new_header.php';
  ?>


<body class="with-welcome-text">
  <div class="container-scroller">
<link rel="stylesheet" href="<?=base_url();?>styles/css.css">
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
                      <a href="<?= base_url()?>configuration/Profil_Droit/add" class="btn btn-otline-primary align-items-center active"><i class="mdi mdi-account-plus"></i> Nouveau</a>
                      <a href="<?= base_url()?>configuration/Profil_Droit/Listing" class="btn btn-otline-primary"> <i class="mdi mdi-apps"></i> List</a>
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
               
                  <section class="content">

<!-- Default box -->
<div class="card">

<div class="card card-success">
        <div class="card-header bg-primary">
          <h3 class="card-title text-center text-light">Enregistrement d'un profil et droits</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="FormData" action="<?php echo base_url()?>configuration/Profil_Droit/add" method="POST" enctype="multipart/form-data">
          <div class="card-body row">
            <div class="form-group col-lg-12">
              <label for="exampleInputEmail1">Nom du Profil <spam class="text-danger">*</spam> </label>
              <input type="text" class="form-control" id="DESCRIPTION" name="DESCRIPTION" placeholder="Nom Profil" value="<?=set_value('DESCRIPTION')?>">
              <?php echo form_error('DESCRIPTION', '<div class="text-danger">', '</div>'); ?>
            </div>
            <?php
              foreach ($droits as $value) {
                ?>
            <div class="form-group col-lg-4 custom-control custom-checkbox">
                    <input class="custom-control-input custom-control-input-success custom-control-input-outline" type="checkbox" name="ID_DROIT[]" value="<?php echo $value['ID_DROIT']?>" id="customCheckbox<?php echo $value['ID_DROIT']?>" >
                    <label for="customCheckbox<?php echo $value['ID_DROIT']?>" class="custom-control-label"><?php echo $value['DESCRIPTION']?> </label>
            </div>
                <?php
              }
            ?>
            <?php echo form_error('ID_DROIT', '<div class="text-danger">', '</div>'); ?>
            
            
            
            
            
            
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
<!-- /.card -->

</section>
           
                  </div>
                </div>
              </div>
      </div>
     </div>
   </div>

        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

    
  <?php
  include VIEWPATH.'includes/new_script.php';
  ?>
</body>

</html>