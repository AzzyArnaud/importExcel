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
                      <a href="<?= base_url()?>configuration/Customer/add" class="btn btn-otline-dark align-items-center"><i class="mdi mdi-account-plus"></i> Nouveau</a>
                      <a href="<?= base_url()?>configuration/Customer/Listing" class="btn btn-otline-dark"><i class="icon-printer"></i> List</a>
                     
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
                    <h3 class="card-title text-light text-center">Update Client d&eacute;j&agrave; enregistr&eacute;</h3>
                  </div>
                <div class="row ">
                  <div class="col-md-12">
                    <form class="row g-3" action="<?php echo base_url()?>configuration/Customer/update" method="POST" enctype="multipart/form-data">
                        <div class="col-md-4">
                            <label for="CUSTOMER_NAME" class="form-label">Full name</label>
                            <input type="text" class="form-control" id="CUSTOMER_NAME" name="CUSTOMER_NAME" value="<?php echo $data['CUSTOMER_NAME']?>">
                            <input type="hidden" class="form-control" id="CUSTOMER_ID" name="CUSTOMER_ID" value="<?php echo $data['CUSTOMER_ID']?>">
                            <?php echo form_error('NOM', '<div class="text-danger">', '</div>'); ?>
                          </div>
                            <div class="col-md-4">
                              <label for="validationServer02" class="form-label">Identity</label>
                              <input type="text" class="form-control" name="IDENTITY_NUMBER" id="validationServer02" value="<?php echo $data['IDENTITY_NUMBER']?>">
                            
                            <?php echo form_error('IDENTITY_NUMBER', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="validationServerUsername" class="form-label">Colline</label>
                            <input type="text" class="form-control" name="COLLINE" id="validationServerUsername"  value="<?php echo $data['COLLINE']?>">
                            
                            <?php echo form_error('COLLINE', '<div class="text-danger">', '</div>'); ?>
                            
                        </div>
                        <div class="col-md-4">
                            <label for="validationServer03" class="form-label">Commune</label>
                            <input type="text" class="form-control" name="COMMUNE" id="validationServer03"  value="<?php echo $data['COMMUNE']?>">
                            
                            <?php echo form_error('COMMUNE', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="PROVINCE" class="form-label">Province</label>
                            <input type="text" class="form-control " name="PROVINCE" id="PROVINCE" value="<?php echo $data['PROVINCE']?>">
                            
                            <?php echo form_error('PROVINCE', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="BIRTH_DAY" class="form-label">Birth Day</label>
                            <input type="date" class="form-control " name="BIRTH_DAY" id="BIRTH_DAY" value="<?php echo $data['BIRTH_DAY']?>">
                            
                            <?php echo form_error('BIRTH_DAY', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class=" col-md-4">
                                <select name="GENDER" id="GENDER" class="form-select">
                                    <option value="<?php if($data['CUSTOMER_ID'] == $data['CUSTOMER_ID']) echo $data['CUSTOMER_ID']; ?>" class="text-center"><?php if($data['GENDER']== 1){ echo "Male"; }else{echo "Famme";}?></option>
                                    <option value="1" class="text-center">Male</option>
                                    <option value="2" class="text-center">Female</option>
                                </select>
                                <?php echo form_error('GENDER', '<div class="text-danger">', '</div>');?>
                                </div>
                        
                            <div class="col-md-4">
                              <label for="CATEGORY" class="form-label">Category</label>
                                <input type="text" class="form-control" name="CATEGORY" id="CATEGORY" value="<?php echo $data['CATEGORY']?>">
                               
                            <?php echo form_error('CATEGORY', '<div class="text-danger">', '</div>'); ?>
                           </div>
                         <div class="col-md-4">
                            <label for="REPRESENT_BY" class="form-label">Represent By</label>
                            <input type="text" class="form-control " name="REPRESENT_BY" id="REPRESENT_BY" value="<?php echo $data['REPRESENT_BY']?>">
                            
                            <?php echo form_error('REPRESENT_BY', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="MOBILE_NUMBER" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" name="MOBILE_NUMBER" id="MOBILE_NUMBER"  value="<?php echo $data['MOBILE_NUMBER']?>">
                            
                            <?php echo form_error('MOBILE_NUMBER', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="NBRE_MEMBER" class="form-label">Nombre Membre</label>
                            <input type="number" class="form-control " name="NBRE_MEMBER" id="NBRE_MEMBER"  value="<?php echo $data['NBRE_MEMBER']?>">
                            
                            <?php echo form_error('NBRE_MEMBER', '<div class="text-danger">', '</div>'); ?>
                        </div>
                        <div class="col-md-4">
                            <label for="ZONE" class="form-label">Zone</label>
                            <input type="text" class="form-control " name="ZONE" id="ZONE" value="<?php echo $data['ZONE']?>">
                            
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
</body>

</html>