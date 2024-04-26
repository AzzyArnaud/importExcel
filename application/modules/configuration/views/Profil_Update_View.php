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
    include 'includes/profil_insert.php';
    ?>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">

      <div class="card card-success">
              <div class="card-header bg-primary">
                <h3 class="card-title">Miser à Jour Le Profil</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  id="FormData" action="<?php echo base_url()?>configuration/Profil/update" method="POST" enctype="multipart/form-data">
               <div class="card-body row">
                    <input type="hidden" name="PROFIL_ID" class="form-control" value="<?php echo $data['PROFIL_ID'];?>">
                  <div class="form-group col-lg-6">
                    <label for="exampleInputEmail1">DESCRIPTION:<spam class="text-danger">*</spam></label>
                    <input type="text" name="DESCRIPTION" class="form-control" placeholder="DESCRIPTION" value="<?php echo $data['DESCRIPTION']?>">
                    <?php echo form_error('DESCRIPTION', '<div class="text-danger">', '</div>'); ?>
                  </div>
                  
                  <div class="col-12">
                    <input type="submit" name="update" value="Update" class="btn btn-success float-right">
                  </div>
                  
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
