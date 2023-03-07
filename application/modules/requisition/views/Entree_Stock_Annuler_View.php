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
    include 'includes/menu_entree_stock.php';
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Liste des produits ayant ete scanner pour annulation</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- class="form-inline" -->
                <?php 
                          if(!empty($this->session->flashdata('message')))
                             echo $this->session->flashdata('message');
            ?>
                

<table class="table">
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
</table>

<table class="table">
  <tr>
    <td>BarCode Number</td>
    <td></td>
  </tr>
  <?php
  foreach ($listepro as $key) {
    echo "<tr>
    <td>".$key['BARCODE']."</td>
    <td> <a class='btn btn-danger btn-sm' href='". base_url('requisition/Entree_Stock/annuler_action/'.$key['ID_BARCODE'])."' role='button'>Annuler</a> </td>
  </tr>";
  }
  ?>
  
  
</table>



               </div>
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
