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
                      <a id="button1" href="<?= base_url()?>configuration/Customer/add" class="btn btn-otline-primary active"><i class="mdi mdi-account-plus"></i> Nouveau</a>
                      <a id="button2" href="<?= base_url()?>configuration/Customer/Listing" class="btn btn-otline-primary "> <i class="mdi mdi-apps"></i></i> List</a>

                    </div>
                  </div>
                </div>
                
             </div>
              </div>
            </div>
          <div class="row">
          
            <div class="col-12 grid-margin stretch-card">
              <div class="card px-5 py-5">
              <div class="card-header bg-primary">
                    <h3 class="card-title text-center text-light">Insertion d'un Client d&eacute;j&agrave; enregistr&eacute;</h3>
                  </div>
                <div class="row ">
                
                  <div class="col-md-12">
                    <form class="row g-3" action="<?php echo base_url()?>configuration/Customer/add" method="POST" enctype="multipart/form-data">
                        <div class="col-md-4">
                            <label for="CUSTOMER_NAME" class="form-label">Full name</label>
                              <input type="text" class="form-control" name="CUSTOMER_NAME" id="CUSTOMER_NAME" value="<?=set_value('CUSTOMER_NAME')?>">
                            <?php echo form_error('CUSTOMER_NAME', '<div class="text-danger">', '</div>'); ?>
                          </div>
                            <div class="col-md-4">
                              <label for="validationServer02" class="form-label">Identity</label>
                              <input type="text" class="form-control" name="IDENTITY_NUMBER" id="validationServer02" value="<?=set_value('IDENTITY_NUMBER')?>">
                            
                            <?php echo form_error('IDENTITY_NUMBER', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="validationServerUsername" class="form-label">Colline</label>
                            <input type="text" class="form-control" name="COLLINE" id="validationServerUsername" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" value="<?=set_value('COLLINE')?>">
                            
                            <?php echo form_error('COLLINE', '<div class="text-danger">', '</div>'); ?>
                            
                        </div>
                        <div class="col-md-4">
                            <label for="validationServer03" class="form-label">Commune</label>
                            <input type="text" class="form-control" name="COMMUNE" id="validationServer03"  value="<?=set_value('COMMUNE')?>">
                            
                            <?php echo form_error('COMMUNE', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="PROVINCE" class="form-label">Province</label>
                            <input type="text" class="form-control " name="PROVINCE" id="PROVINCE" value="<?=set_value('PROVINCE')?>">
                            
                            <?php echo form_error('PROVINCE', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="BIRTH_DAY" class="form-label">Birth Day</label>
                            <input type="date" class="form-control " name="BIRTH_DAY" id="BIRTH_DAY" value="<?=set_value('BIRTH_DAY')?>">
                            
                            <?php echo form_error('BIRTH_DAY', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class=" col-md-4">
                                <select name="GENDER" id="GENDER" class="form-select">
                                    <option value="" class="text-center">--select--</option>
                                    <option value="1" class="text-center">Male</option>
                                    <option value="2" class="text-center">Female</option>
                                </select>
                                <?php echo form_error('GENDER', '<div class="text-danger">', '</div>');?>
                                </div>
                        
                            <div class="col-md-4">
                              <label for="CATEGORY" class="form-label">Category</label>
                                <input type="text" class="form-control" name="CATEGORY" id="CATEGORY" value="<?=set_value('CATEGORY')?>">
                               
                            <?php echo form_error('CATEGORY', '<div class="text-danger">', '</div>'); ?>
                           </div>
                         <div class="col-md-4">
                            <label for="REPRESENT_BY" class="form-label">Represent By</label>
                            <input type="text" class="form-control " name="REPRESENT_BY" id="REPRESENT_BY" value="<?=set_value('REPRESENT_BY')?>">
                            
                            <?php echo form_error('REPRESENT_BY', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="MOBILE_NUMBER" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" name="MOBILE_NUMBER" id="MOBILE_NUMBER"  value="<?=set_value('MOBILE_NUMBER')?>">
                            
                            <?php echo form_error('MOBILE_NUMBER', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="NBRE_MEMBER" class="form-label">Nombre Membre</label>
                            <input type="number" class="form-control " name="NBRE_MEMBER" id="NBRE_MEMBER"  value="<?=set_value('NBRE_MEMBER')?>">
                            
                            <?php echo form_error('NBRE_MEMBER', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="ZONE" class="form-label">Zone</label>
                            <input type="text" class="form-control " name="ZONE" id="BIRTH_DAY" value="<?=set_value('ZONE')?>">
                            
                            <?php echo form_error('ZONE', '<div class="text-danger">', '</div>'); ?>
                        </div>        
                        <div class="col-md-12">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                
           
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
  <script src="<?=base_url()?>styles/script.js"></script>
</body>

</html>