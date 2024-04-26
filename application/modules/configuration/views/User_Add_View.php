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
                      <a id="button1" href="<?= base_url()?>configuration/User/add" class="btn btn-outline-primary active"><i class="mdi mdi-account-plus"></i> Nouveau</a>
                      <a id="button2" href="<?= base_url()?>configuration/User/Listing" class="btn btn-otline-primary"> <i class="mdi mdi-apps"></i> List</a>
                     
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
          <h3 class="card-title text-center text-light">Enregistrement d'un utilisateur</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form id="FormData" action="<?php echo base_url()?>configuration/User/add" method="POST" enctype="multipart/form-data">
          <div class="card-body row">
            <div class="form-group col-lg-6">
              <label for="exampleInputEmail1">Nom <spam class="text-danger">*</spam> </label>
              <input type="text" class="form-control" id="NOM" name="NOM" placeholder="Nom" value="<?=set_value('NOM')?>">
              <?php echo form_error('NOM', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="form-group col-lg-6">
              <label for="exampleInputEmail1">Pr&eacute;nom <spam class="text-danger">*</spam> </label>
              <input type="text" class="form-control" id="PRENOM" name="PRENOM" placeholder="Pr&eacute;nom" value="<?=set_value('PRENOM')?>">
              <?php echo form_error('PRENOM', '<div class="text-danger">', '</div>'); ?>
            </div>

            <div class="form-group col-lg-6">
              <label for="exampleInputEmail1">Username<spam class="text-danger">*</spam> </label>
              <input type="mail" class="form-control" id="USERNAME" name="USERNAME" placeholder="username@bancobu.bi" value="<?=set_value('USERNAME')?>">
              <?php echo form_error('USERNAME', '<div class="text-danger">', '</div>'); ?>
            </div>

            <div class="form-group col-lg-6">
              <label for="exampleInputEmail1">Password<spam class="text-danger">*</spam> </label>
              <input type="password" class="form-control" id="PASSWORD" name="PASSWORD" value="<?=set_value('PASSWORD')?>">
              <?php echo form_error('PASSWORD', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="form-group col-md-4">
              <label for="exampleInputEmail1">Profile <spam class="text-danger">*</spam> </label>
              <select class="form-select text-center" name="PROFIL_ID" id="PROFIL_ID">
                    <option>-- Select --</option>
                    <?php
                    foreach ($profil as $profils) {
                     echo"<option value='".$profils['PROFIL_ID']."'>".$profils['DESCRIPTION']."</option>";
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