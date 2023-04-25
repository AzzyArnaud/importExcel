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
    include 'includes/assurance_insert.php';
    ?>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">

      <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Nouveau Assurance</h3>
              </div>

              <?php 
                          // if(!empty($this->session->flashdata('message')))
                             echo $this->session->flashdata('message');
            ?>
              <!-- /.card-header -->
              <!-- form start -->
              <form  id="FormData" action="<?php echo base_url()?>configuration/Assurance/insert" method="POST" enctype="multipart/form-data">
                <div class="card-body row">
                    <input type="hidden" name="ID_ASSURANCE" class="form-control">
                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">ASSURANCE:<spam class="text-danger">*</spam></label>
                    <input type="text" name="NOM_ASSURANCE" class="form-control" value="<?=set_value('NOM_ASSURANCE')?>">
                    <?php echo form_error('NOM_ASSURANCE', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">NIF:<spam class="text-danger">*</spam></label>
                    <input type="text" name="NIF_ASSURANCE" class="form-control" value="<?=set_value('NIF_ASSURANCE')?>">
                    <?php echo form_error('NIF_ASSURANCE', '<div class="text-danger">', '</div>'); ?>
                  </div>

                  <div class="form-group col-lg-6">
                    <label for="exampleInputFile">RC:<spam class="text-danger">*</spam></label>
                    <input type="text" name="RC_ASSURANCE" class="form-control" value="<?=set_value('RC_ASSURANCE')?>">
                    <?php echo form_error('RC_ASSURANCE', '<div class="text-danger">', '</div>'); ?>
                  </div>

                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">TEL:<spam class="text-danger">*</spam></label>
                    <input type="number" name="TEL_ASSURANCE" class="form-control" value="<?=set_value('TEL_ASSURANCE')?>">
                    <?php echo form_error('TEL_ASSURANCE', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">EMAIL:<spam class="text-danger">*</spam></label>
                    <input type="email" name="EMAIL_ASSURANCE" class="form-control" value="<?=set_value('EMAIL_ASSURANCE')?>">
                    <?php echo form_error('EMAIL_ASSURANCE', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">ADRESSE:<spam class="text-danger">*</spam></label>
                    <input type="text" name="ADRESSE_ASSURANCE" class="form-control" value="<?=set_value('ADRESSE_ASSURANCE')?>">
                    <?php echo form_error('ADRESSE_ASSURANCE', '<div class="text-danger">', '</div>'); ?>
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
