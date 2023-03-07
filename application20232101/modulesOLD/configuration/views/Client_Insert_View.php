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
                <h3 class="card-title">Nouveau Client</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  id="FormData" action="<?php echo base_url()?>configuration/Client/insert" method="POST" enctype="multipart/form-data">
                <div class="card-body row">
                    <input type="hidden" name="ID_CLIENT" class="form-control" required>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">NOM:<spam class="text-danger">*</spam></label>
                    <input type="number" name="NOM_CLIENT" class="form-control" placeholder="NOM_CLIENT" value="<?=set_value('NOM_CLIENT')?>">
                    <?php echo form_error('NOM_CLIENT', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">PRENOM:<spam class="text-danger">*</spam></label>
                    <input type="text" name="PRENOM_CLIENT" class="form-control" placeholder="PRENOM_CLIENT" value="<?=set_value('PRENOM_CLIENT')?>">
                    <?php echo form_error('PRENOM_CLIENT', '<div class="text-danger">', '</div>'); ?>
                  </div>

                  <div class="form-group col-lg-6">
                    <label for="exampleInputFile">NIF:<spam class="text-danger">*</spam></label>
                    <input type="number" name="NIF_CLIENT" class="form-control" placeholder="NIF_CLIENT" value="<?=set_value('NIF_CLIENT')?>">
                    <?php echo form_error('NIF_CLIENT', '<div class="text-danger">', '</div>'); ?>
                    
                  </div>

                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">RC:<spam class="text-danger">*</spam></label>
                    <input type="text" name="RC_CLIENT" class="form-control" placeholder="RC_CLIENT" value="<?=set_value('RC_CLIENT')?>">
                    <?php echo form_error('RC_CLIENT', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">TEL:<spam class="text-danger">*</spam></label>
                    <input type="number" name="TEL_CLIENT" class="form-control" placeholder="TEL_CLIENT" value="<?=set_value('TEL_CLIENT')?>">
                    <?php echo form_error('TEL_CLIENT', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">EMAIL:<spam class="text-danger">*</spam></label>
                    <input type="email" name="EMAIL_CLIENT" class="form-control" placeholder="EMAIL_CLIENT" value="<?=set_value('EMAIL_CLIENT')?>">
                    <?php echo form_error('EMAIL_CLIENT', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="col-12">
                      <input type="submit" name="submit" value="Add" class="btn btn-success float-right">
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
