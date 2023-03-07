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
    include 'includes/menu_sortie_stock.php';
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Liste sortie stock</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- class="form-inline" -->
                <form action="<?php echo base_url('requisition/Sortie_Stock');?>" id="myForm" method="POST" >
                <div class="row">


                    <div class="form-group col-md-3 col-sm-3 col-xs-3">
                <label for="exampleInputName2">De</label>
                      
                      
                      <input type="date" class="form-control float-right" name="DATE_DEBUT" value="<?php echo $DATE_DEBUTS; ?>" onchange="changelist()" >  
                    </div>

                    <div class="form-group col-md-3 col-sm-3 col-xs-3">
                <label for="exampleInputName2">A</label>
                      
                      
                      <input type="date" class="form-control float-right" name="DATE_FIN" value="<?php echo $DATE_FINS; ?>" onchange="changelist()" >  
                    </div>

                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                      <label for="exampleInputName2">Mode de sortie</label>
                      <select class="form-control select select2-success" data-dropdown-css-class="select2-success" onchange="changelist()" name="MODE" id="MODE" style="width: 100%;">
                                      <option value="0" <?php if ($MODE == 0) { echo "selected";}?> > Tout declassement </option>
                                      <option value="1" <?php if ($MODE == 1) { echo "selected";}?>> Vente </option>
                                      <option value="2" <?php if ($MODE == 2) { echo "selected";}?>> Declass&eacute;</option>
                                    </select>
                    </div>
                   

                  </div>

                
               

                
                </form>
               
                <table id="example1" class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Produit</th>
                <th>Nombre</th>
                <th>Mode Sortie</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
          <?php
          if ($MODE == 1 || $MODE == 0) {
            
            $resultat=$this->Model->getRequete('SELECT NOM_PRODUIT, DATE(DATE_TIME_VENTE) AS DATE_TIME_VENTES, COUNT(vente_detail.ID_PRODUIT) AS NOMBRE FROM `vente_detail` JOIN vente_vente ON vente_vente.ID_VENTE = vente_detail.ID_VENTE JOIN saisie_produit ON saisie_produit.ID_PRODUIT = vente_detail.ID_PRODUIT WHERE 1 '.$conddateun.'  GROUP BY NOM_PRODUIT, DATE(DATE_TIME_VENTE)');
         $tot = 0;
          foreach ($resultat as $key) 
         {
          echo "<tr>
                <td>".$key['DATE_TIME_VENTES']."</td>
                <td>".$key['NOM_PRODUIT']."</td>
                <td>".$key['NOMBRE']."</td>
                <td>Vente</td>";
        
  
         echo '<td>
         <a href="#" class="btn btn-success btn-sm">Details</a>
         </td></tr>';
       }

          }
          
          if ($MODE == 2 || $MODE == 0) {
       $resultatp=$this->Model->getRequete('SELECT NOM_PRODUIT, DATE(DATE_TIME) AS DATE_TIME, COUNT(NOM_PRODUIT) AS NOMBRE FROM `req_stock_endomage` JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_stock_endomage.ID_PRODUIT WHERE 1 '.$conddatedeux.' GROUP BY NOM_PRODUIT, DATE(DATE_TIME)');
         $tot = 0;
          foreach ($resultatp as $key) 
         {
          echo "<tr>
                <td>".$key['DATE_TIME']."</td>
                <td>".$key['NOM_PRODUIT']."</td>
                <td>".$key['NOMBRE']."</td>
                <td>Declass&eacute;</td>";
        
  
         echo '<td>
         <a href="#" class="btn btn-success btn-sm">Details</a>
         </td></tr>';
       }
     }
          ?>
            
            
            
            
        </tbody>
        
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
