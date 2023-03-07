<?php
  include VIEWPATH.'includes/new_header.php';
  ?>

<div class="wrapper">
  
  <?php
  include VIEWPATH.'includes/new_top_menu.php';
  include VIEWPATH.'includes/new_menu_principal.php';
  ?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php 
    include 'includes/produit_insert.php';
    ?>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">

      <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Nouveau Produit</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  id="FormData" action="<?php echo base_url()?>configuration/Produit/insert" method="POST" enctype="multipart/form-data">
                <div class="card-body row">
                    <input type="hidden" name="ID_PRODUIT" class="form-control">
                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">PRODUIT:<spam class="text-danger">*</spam></label>
                    <input type="text" name="NOM_PRODUIT" class="form-control" value="<?=set_value('NOM_PRODUIT')?>">
                    <?php echo form_error('NOM_PRODUIT', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">CATEGORIE PRODUIT:<spam class="text-danger">*</spam></label>
                    <select class="custom-select" name="ID_CATEGORIE_PRODUIT" class="form-control">

                       <option value="">-- Select --</option>
                          <?php
                          foreach ($categ as $key) {
                           echo"<option value='".$key['ID_CATEGORIE_PRODUIT']."'>".$key['NOM']."</option>";
                          }
                          ?>
                        </select>
                    </select>
                    <?php echo form_error('ID_CATEGORIE_PRODUIT', '<div class="text-danger">', '</div>'); ?>
                  </div>

                  <div class="col-12">
                     <input type="submit" name="submit" value="Add" class="btn btn-success float-right">
                  </div>
                   </div>

                <!-- /.card-body -->

              </form>
            </div>
        
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
  include VIEWPATH.'includes/new_script.php';
  ?>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper  .col-md-6:eq(0)');
    $(this).removeClass('btn-default').addClass('btn-success btn-dark');
   
  });
</script>
<script>
  $('#mytable').DataTable();
</script>
</body>
</html>
