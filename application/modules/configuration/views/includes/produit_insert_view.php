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
                      <a id="button1" href="<?= base_url()?>configuration/Produit/add" class="btn btn-otline-dark active"><i class="mdi mdi-account-plus"></i></i> Nouveau</a>
                      <a id="button2" href="<?= base_url()?>configuration/Produit/Listing" class="btn btn-otline-dark"><i class="mdi mdi-apps"></i> List</a>
                      
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
                <h3 class="card-title text-center text-light ">Enregistrement d'un utilisateur</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="FormData" action="<?php echo base_url()?>configuration/Produit/add" method="POST" enctype="multipart/form-data">
                <div class="card-body row">
                <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">Nom Du Produit <spam class="text-danger">*</spam> </label>
                    <input type="text" class="form-control" id="PRODUCT_NAME" name="PRODUCT_NAME" value="<?=set_value('PRODUCT_NAME')?>">
                    <?php echo form_error('PRODUCT_NAME', '<div class="text-danger">', '</div>'); ?>
                  </div>

                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">Avance<spam class="text-danger">*</spam> </label>
                    <input type="number" class="form-control" id="ORDER_UNIT_PRICE" name="ORDER_UNIT_PRICE" value="<?=set_value('ORDER_UNIT_PRICE')?>">
                    <?php echo form_error('ORDER_UNIT_PRICE', '<div class="text-danger">', '</div>'); ?>
                  </div>

                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">Solde<spam class="text-danger">*</spam> </label>
                    <input type="number" class="form-control" id="PETMENT_UNIT_PRICE" name="PETMENT_UNIT_PRICE"  value="<?=set_value('PETMENT_UNIT_PRICE')?>">
                    <?php echo form_error('PETMENT_UNIT_PRICE', '<div class="text-danger">', '</div>'); ?>
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
  <script src="<?=base_url()?>styles/script.js"></script>
</body>

</html>