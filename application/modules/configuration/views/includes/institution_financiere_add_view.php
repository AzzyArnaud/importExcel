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
                      <a id="button1" href="<?= base_url()?>configuration/Institution_financiere/add" class="btn btn-outline-primary active"><i class="mdi mdi-account-plus"></i> Nouveau</a>
                      <a id="button2" href="<?= base_url()?>configuration/Institution_financiere/Listing" class="btn btn-otline-primary"><i class="mdi mdi-apps"></i> List</a>
                     
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
          <h3 class="card-title text-light text-center">Enregistrement d'un Insttution Financieres</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="FormData" action="<?php echo base_url()?>configuration/Institution_financiere/add" method="POST" enctype="multipart/form-data">
          <div class="card-body row">
            <div class="form-group col-lg-6">
              <label for="NOM_INSTITUTION">Institution Financieres<spam class="text-danger">*</spam> </label>
              <input type="text" class="form-control" id="NOM_INSTITUTION" name="NOM_INSTITUTION" placeholder="NOM_INSTITUTION" value="<?=set_value('NOM_INSTITUTION')?>">
              <?php echo form_error('NOM_INSTITUTION', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
          </div>
        </form>
      </div>
        </div>
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