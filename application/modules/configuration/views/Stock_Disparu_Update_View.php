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
    include 'includes/stock_disparu_insert.php';
    ?>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">

      <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Miser à Jour Le Stock Disparu</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  id="FormData" action="<?php echo base_url()?>configuration/Stock_Disparu/update" method="POST" enctype="multipart/form-data">
               <div class="card-body row">
                    <input type="hidden" name="ID_STOCK_DISPARU" class="form-control" value="<?php echo $data['ID_STOCK_DISPARU'];?>">

                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">PRODUIT:<spam class="text-danger">*</spam></label>
                    <select class="custom-select" name="ID_PRODUIT" class="form-control" value="<?php echo $data['ID_PRODUIT']?>">
                    
                     <option value="">--- Select ---</option>
                          <?php
                          foreach ($categ as $key) {
                           echo"<option value='".$key['ID_PRODUIT']."'>".$key['NOM_PRODUIT']."</option>";
                          }
                          ?>
                        </select>
                    </select>
                    <?php echo form_error('ID_PRODUIT', '<div class="text-danger">', '</div>'); ?>

                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">QUANTITE:<spam class="text-danger">*</spam></label>
                    <input type="text" name="QUANTITE" class="form-control" placeholder="DESCRIPTION" value="<?php echo $data['QUANTITE']?>">
                    <?php echo form_error('QUANTITE', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">PRIX_VENTE:<spam class="text-danger">*</spam></label>
                    <input type="text" name="PRIX_VENTE" class="form-control" placeholder="PRIX_VENTE" value="<?php echo $data['PRIX_VENTE']?>">
                    <?php echo form_error('PRIX_VENTE', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="col-12">
                    <input type="submit" name="update" value="Update" class="btn btn-success float-right">
                  </div>
                  
                </div>
                <!-- /.card-body -->
              </form>
            </div>
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- ./wrapper -->
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
