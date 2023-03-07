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
    include 'includes/type_remise_insert.php';
    ?>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">

      <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Miser à Jour Le Type Remise</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  id="FormData" action="<?php echo base_url()?>configuration/Type_Remise/update" method="POST" enctype="multipart/form-data">
               <div class="card-body row">
                    <input type="hidden" name="ID_TYPE_REMISE" class="form-control" value="<?php echo $data['ID_TYPE_REMISE'];?>">
                  
                   <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">ASSURANCE:<spam class="text-danger">*</spam></label>
                    <select class="custom-select" name="ID_ASSURANCE" class="form-control" value="<?php echo $data['ID_ASSURANCE']?>">
                    
                     <option value="">--- Select ---</option>
                          <?php
                          foreach ($categ as $key) {
                           echo"<option value='".$key['ID_ASSURANCE']."'>".$key['NOM_ASSURANCE']."</option>";
                          }
                          ?>
                        </select>
                    </select>
                    <?php echo form_error('ID_ASSURANCE', '<div class="text-danger">', '</div>'); ?>

                  </div>



                  <div class="form-group col-lg-6">
                    <label for="exampleInputPassword1">POURCENTAGE:<spam class="text-danger">*</spam></label>
                    <input type="text" name="POURCENTAGE" class="form-control" value="<?php echo $data['POURCENTAGE']?>">
                    <?php echo form_error('POURCENTAGE', '<div class="text-danger">', '</div>'); ?>
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
