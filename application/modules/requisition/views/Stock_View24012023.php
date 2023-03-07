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
    include 'includes/menu_stock.php';
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Liste des produits dans le stock</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- class="form-inline" -->
               



                <table id="example1" class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nom Produit</th>
                <th>Quantite</th>
                <th>PU Vente</th>
                <th>PT Vente</th>
            </tr>
        </thead>
        <tbody>
          <?php

          $resultat=$this->Model->getRequete('SELECT saisie_produit.NOM_PRODUIT, QUANTITE, PRIX_VENTE, (QUANTITE * PRIX_VENTE) AS PRIX_TOTAL FROM `req_stock` JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_stock.ID_PRODUIT WHERE 1 AND req_stock.STATUS = 1');
         $tot = 0;
          foreach ($resultat as $key) 
         {
              
          echo "<tr>
                <td>".$key['NOM_PRODUIT']."</td>
                <td><div class='text-right'>".number_format($key['QUANTITE'], 0,',',' ')."</div></td> 
                <td><div class='text-right'>".number_format($key['PRIX_VENTE'], 0,',',' ')."</div></td> 
                <td><div class='text-right'>".number_format($key['PRIX_TOTAL'], 0,',',' ')."</div></td>
                ";
         echo '</tr>';
         $tot += $key['PRIX_TOTAL'];

       }
          ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Valeurs total du stock</th>
                <th class="text-right"><?php echo number_format($tot, 0,',',' ')?></th>
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
