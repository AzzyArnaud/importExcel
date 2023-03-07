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
    include 'includes/menu_requisition.php';
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card card-success">
              <!-- <div class="card-header">
                <h3 class="card-title">Detail de la requisition</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <!-- class="form-inline" -->
                <table class="table">
                  <tr>
                    <td>Requisition par</td>
                    <td><?php echo $unique['RNOM'].' '.$unique['RPRENOM'];?> le <?php echo $unique['DATE_REQUISITION'];?></td>
                  </tr>
                   <tr>
                    <td>Fournisseur</td>
                    <td><?php echo $unique['NOM'];?></td>
                  </tr>
                   <tr>
                    <td>Saisie par</td>
                    <td><?php echo $unique['SNOM'].' '.$unique['SPRENOM'],' Le '.$unique['DATE_SAISIE'];?></td>
                  </tr>
                </table>

               
                <!-- <div class="text-center"><?php echo $title;?></div> -->



                <table id="mytable" class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Produit</th>
                <th>PU</th>
                <th>Quantite</th>
                <th>Quantite restant</th>
                <th>Total</th>
                <th>Peramption</th>
                <th>Facture</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
          <?php
         $tot = 0;
          foreach ($listdetail as $key) 
         {
              // ID_REQUISITION
          if ($key['HAVE_FACTURE'] == 0) {
            $HAVE_FACTURE = 'Non';
          }
          else{
            $HAVE_FACTURE = 'Oui';
          }
          echo "<tr>
                <td>".$key['NOM_PRODUIT']."</td>
                <td>".$key['PRIX_ACHAT_UNITAIRE']."</td>
                <td>".$key['QUANTITE']."</td>
                <td>".$key['QUANTITE_RESTANT']."</td>
                <td>".$key['MONTANT_TOTAL_ACHAT']."</td>
                <td>".$key['DATE_PERAMPTION']."</td>
                <td>".$HAVE_FACTURE."</td>
                <td><a class='btn btn-danger btn-sm' href='". base_url('requisition/Requisition/delete/'.$key['ID_REQUISITION'].'')."' role='button'>Delete</a>
                <a class='btn btn-success btn-sm' href='". base_url('requisition/Requisition/index_update/'.$key['ID_REQUISITION'].'')."' role='button'>Modifier</a></td>
                </tr>";
         $tot += $key['MONTANT_TOTAL_ACHAT'];
       }
          ?>
            
            
            
            
        </tbody>
        <tfoot>
            <tr>
                <th>TOTAL</th>
                <th colspan="4" class="text-right"><?php echo number_format($tot, 2,',',' ')?></th>
                <th class="text-right"> </th>
                <th class="text-right"> </th>
            </tr>
        </tfoot>
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
 
$(document).ready(function () {
    $('#mytable').DataTable();
});
</script>
</body>
</html>
