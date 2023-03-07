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
    include 'includes/fournisseur_insert.php';
    ?>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">

      <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Nouveau Fournisseur</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  id="FormData" action="<?php echo base_url()?>configuration/Fournisseur/insert" method="POST" enctype="multipart/form-data">
                <div class="card-body row">
                    <input type="hidden" name="ID_FOURNISSEUR" class="form-control" required>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">NOM:<spam class="text-danger">*</spam></label>
                    <input type="text" name="NOM" class="form-control" placeholder="NOM" value="<?=set_value('NOM')?>">
                    <?php echo form_error('NOM', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="col-12">
                     <input type="submit" name="submit" value="Add" class="btn btn-success float-right">
                  </div>
                   </div>

              </form>
            </div>
        
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
