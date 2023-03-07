<?php
  include VIEWPATH.'includes/new_header.php';
  ?>
  
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <?php
  include VIEWPATH.'includes/new_top_menu.php';
  include VIEWPATH.'includes/new_menu_principal.php';
  ?>

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php 
    // include 'includes/menu_stock.php';
    ?>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">







        



      



      
      <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Modification réquisition médicament</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form role="form" action="<?=base_url('requisition/Stock/save_update')?>" enctype="multipart/form-data" method="POST">
                  <input type="hidden" name="ID_PRODUIT" value="<?php echo $data['ID_PRODUIT']?>">
                <div class="card-body row">

                  <div class="form-group col-md-6">
                    <label for="PRIX_VENTE">
                          Nom produit <span id="resultat_calcul"></span>
                        </label>
                        
                    <input type="text" class="form-control" value="<?php echo $data['NOM_PRODUIT']?>" readonly>
                  <!-- </div> -->
                        <?php echo form_error('DATE_REQUISITION', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     
                     

                     <div class="form-group col-md-6">
                        <label for="PRIX_VENTE">
                          Prix de vente <span id="resultat_calcul"></span>
                        </label>
                        <input type="number" name="PRIX_VENTE" value="<?php echo $data['PRIX_PRODUIT']?>" class="form-control" id="PRIX_VENTE"
                         step="0.001">
                        <?php echo form_error('PRIX_VENTE', '<div class="text-danger">', '</div>'); ?>
                     </div>

                    

                    
                  
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
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
 include VIEWPATH.'includes/new_copy_footer.php';  
  ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php
  include VIEWPATH.'includes/new_script.php';
  ?>




</body>
</html>




