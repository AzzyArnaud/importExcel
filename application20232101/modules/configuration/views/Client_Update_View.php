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
    include 'includes/client_insert.php';
    ?>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">

      <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Miser à Jour Le Client</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  id="FormData" action="<?php echo base_url()?>configuration/Client/update" method="POST" enctype="multipart/form-data">
                <div class="card-body row">
                    <input type="hidden" name="ID_CLIENT" class="form-control" value="<?php echo $data['ID_CLIENT'];?>">
                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">NOM:<spam class="text-danger">*</spam></label>
                    <input type="number" name="NOM_CLIENT" class="form-control" placeholder="NOM_CLIENT" value="<?php echo $data['NOM_CLIENT']?>">
                    <?php echo form_error('NOM_CLIENT', '<div class="text-danger">', '</div>'); ?>
                  </div>

                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">PRENOM:<spam class="text-danger">*</spam></label>
                    <input type="text" name="PRENOM_CLIENT" class="form-control" placeholder="PRENOM_CLIENT" value="<?php echo $data['PRENOM_CLIENT']?>">
                    <?php echo form_error('PRENOM_CLIENT', '<div class="text-danger">', '</div>'); ?>
                  </div>

                  <div class="form-group col-lg-6">
                    <label for="exampleInputFile">NIF:<spam class="text-danger">*</spam></label>
                    <input type="text" name="NIF_CLIENT" class="form-control" placeholder="NIF_CLIENT" value="<?php echo $data['NIF_CLIENT']?>">
                    <?php echo form_error('NIF_CLIENT', '<div class="text-danger">', '</div>'); ?>
                    
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">RC:<spam class="text-danger">*</spam></label>
                    <input type="text" name="RC_CLIENT" class="form-control" placeholder="RC_CLIENT" value="<?php echo $data['RC_CLIENT']?>">
                    <?php echo form_error('RC_CLIENT', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">TEL:<spam class="text-danger">*</spam></label>
                    <input type="number" name="TEL_CLIENT" class="form-control" placeholder="TEL_CLIENT" value="<?php echo $data['TEL_CLIENT']?>">
                    <?php echo form_error('TEL_CLIENT', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">ADRESSE:<spam class="text-danger">*</spam></label>
                    <input type="text" name="EMAIL_CLIENT" class="form-control" placeholder="EMAIL_CLIENT" value="<?php echo $data['EMAIL_CLIENT']?>">
                    <?php echo form_error('EMAIL_CLIENT', '<div class="text-danger">', '</div>'); ?>
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

   <?php
 include VIEWPATH.'includes/new_copy_footer.php';  
  ?>
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

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
