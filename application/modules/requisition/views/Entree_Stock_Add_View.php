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
                <h3 class="card-title">Liste des requisitions non mis dans le stock</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- class="form-inline" -->
               



                <table id="example1" class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nom Produit</th>
                <th>Quantite</th>
                <th>Dans le stock</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
          <?php

          $resultat=$this->Model->getRequete('SELECT ID_REQUISITION,DATE_REQUISITION, saisie_produit.NOM_PRODUIT,req_requisition.ID_PRODUIT, PRIX_ACHAT_UNITAIRE,QUANTITE,QUANTITE_RESTANT, MONTANT_TOTAL_ACHAT, ID_USER_SAISIE, DATE_PERAMPTION FROM `req_requisition` JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_requisition.ID_PRODUIT WHERE 1');
         $tot = 0;
          foreach ($resultat as $key) 
         {
          $stock=$this->Model->getRequeteOne('SELECT COUNT(*) AS NUMBER FROM req_barcode WHERE 1 AND ID_REQUISITION = '.$key['ID_REQUISITION'].' AND req_barcode.ID_PRODUIT = '.$key['ID_PRODUIT'].'');
          $reste = $key['QUANTITE'] - $stock['NUMBER'];
 if ($reste > 0) {
  // $stat = 'incorect';
  //              }
  //              else{
             $stat = 'correct';
         
          echo "<tr>
                <td>".$key['NOM_PRODUIT']."</td>
                <td>".$key['QUANTITE']."</td>
                <td>".$stock['NUMBER']."</td>
                <td>".$key['DATE_REQUISITION']."</td>
                <td>".$stat."</td>
                <td><div class='text-right'>".number_format($key['MONTANT_TOTAL_ACHAT'], 2,',',' ')."</div></td> ";
        
  
         echo '<td>
         <a href="' . base_url('requisition/Entree_Stock/scan/'.$key['ID_REQUISITION'].'/'.$key['ID_PRODUIT']) . '" class="btn btn-success btn-sm">Proceder au scan <i class="fa fa-barcode" aria-hidden="true"></i></a>
         <a class="btn btn-success btn-sm" href="'. base_url('requisition/Requisition/index_update/'.$key['ID_REQUISITION'].'').'" role="button">Modifier</a>
         <a class="btn btn-danger btn-sm" href="'. base_url('requisition/Requisition/delete/'.$key['ID_REQUISITION'].'').'" role="button">Delete</a>
         </td></tr>';
         $tot += $key['MONTANT_TOTAL_ACHAT'];
       }
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
function exportlist() {
            document.getElementById("myForm").action = '<?php echo base_url();?>stock/Exports/export_carburant_ravi';
            document.getElementById("myForm").submit();
            document.getElementById("myForm").action = "<?php echo base_url('requisition/Requisition/listing');?>";
}
</script>
</body>
</html>
