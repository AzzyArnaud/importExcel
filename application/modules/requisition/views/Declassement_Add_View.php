<?php
  include VIEWPATH.'includes/new_header.php';
  ?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  
  <?php
  include VIEWPATH.'includes/new_top_menu.php';
  include VIEWPATH.'includes/new_menu_principal.php';
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <?php 
    include 'includes/menu_declassement.php';
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Scanner le produit a declasser</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- class="form-inline" -->
                <?php 
                          if(!empty($this->session->flashdata('message')))
                             echo $this->session->flashdata('message');
            ?>
                

<!-- <table class="table">
  <tr>
    <td>Produit</td>
    <td><?php echo $unique['NOM_PRODUIT'];?></td>
  </tr>
  <tr>
    <td>Achete le</td>
    <td><?php echo $unique['DATE_REQUISITION'];?></td>
  </tr>
   <tr>
    <td>Quantite Total</td>
    <td><?php echo $unique['QUANTITE']?></td>
  </tr>
  <tr>
    <td>Deja scann&eacute;</td>
    <td><?php echo $deja_in_qr['NUMBER']?></td>
  </tr>
</table> -->

<?php 
// $reste = $unique['QUANTITE'] - $deja_in_qr['NUMBER'];
// if ($reste > 0) {
  // code...

?>

      <form role="form" action="<?=base_url('requisition/Declassement/save_scan')?>" enctype="multipart/form-data" method="POST">
        
        <!-- <input type="hidden" class="form-control" value="<?php echo $unique['ID_REQUISITION']?>" name="ID_REQUISITION" id="ID_REQUISITION">
        <input type="hidden" class="form-control" value="<?php echo $unique['ID_PRODUIT']?>" name="ID_PRODUIT" id="ID_PRODUIT">
        <input type="hidden" class="form-control" value="<?php echo $unique['PRIX_VENTE_UNITAIRE']?>" name="PRIX_VENTE" id="PRIX_VENTE"> -->


        
        <div class="card-body row">
          <div class="form-group col-md-12">
                        <label for="BARCODE">
                          Num BarCode
                          <i class="text-danger"> *</i>
                        </label>
                    <input type="text" class="form-control" value="" name="BARCODE" id="BARCODE" <?php if ($BARCODE!= NULL) { echo " readonly='readonly'"; }?> autofocus >
                        <?php echo form_error('BARCODE', '<div class="text-danger">', '</div>'); ?>
          </div>
        </div>
      </form>


      <form role="form" action="<?=base_url('requisition/Declassement/save_declassement')?>" enctype="multipart/form-data" method="POST">
        
        <input type="hidden" class="form-control" value="<?php echo $ID_PRODUIT?>" name="ID_PRODUIT" id="ID_PRODUIT">
        <input type="hidden" class="form-control" value="<?php echo $ID_BARCODE?>" name="ID_BARCODE" id="ID_BARCODE">
        <input type="hidden" class="form-control" value="<?php echo $BARCODE?>" name="BARCODE" id="BARCODE">
        


        
        <div class="card-body row">
          <div class="form-group col-md-12">
                        <label for="PRODUIT">
                          Produit
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="text" class="form-control" value="<?php echo $PRODUIT?>" readonly="readonly">

                        <?php echo form_error('PRODUIT', '<div class="text-danger">', '</div>'); ?>
          </div>
          <div class="form-group col-md-12">
                        <label for="BARCODE">
                          Commentaire
                          <i class="text-danger"> *</i>
                        </label>
                        <textarea class="form-control" rows="3" name="COMMENTAIRE" id="COMMENTAIRE"></textarea>

                        <?php echo form_error('COMMENTAIRE', '<div class="text-danger">', '</div>'); ?>
          </div>

          
          <div class="form-group col-md-12">
                        <button type="submit" name="saveentreecaiss" class="btn btn-success btn-block">Enregistrer</button>
          </div>
        </div>
      </form>
      <?php
// }
?>              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
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
   
  });
</script>

<script type="text/javascript">
  function changelist() {
    // alert('aa');

document.getElementById("myForm").submit();



  }

  $('#reservation').daterangepicker({

        locale: {
        format: 'DD/MM/YYYY'
      }
    })
  $('.select').select2();

</script>
</body>
</html>
