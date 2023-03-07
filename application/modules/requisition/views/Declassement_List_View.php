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
                <h3 class="card-title">Liste produit declass&eacute;</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- class="form-inline" -->
                <form action="<?php echo base_url('requisition/Declassement/listing');?>" id="myForm" method="POST" >
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
                      <label for="exampleInputName2">Fait par:</label>
                      <select class="form-control select select2-success" data-dropdown-css-class="select2-success" onchange="changelist()" name="ID_USER" id="ID_USER" style="width: 100%;">
                                      <option value=""> </option>
                                      <?php 
                                      $ID_USER=$this->Model->getList('config_user',array());
                                        foreach ($ID_USER as $key) {
                                        if ($ID_USERS == $key['ID_USER'] ) {
                                          echo "<option value=".$key['ID_USER']." selected>".$key['NOM']." ".$key['PRENOM']."</option>";
                                        }
                                        else{
                                          echo "<option value=".$key['ID_USER'].">".$key['NOM']." ".$key['PRENOM']."</option>";
                                        }
                                        }
                                      ?>
                                    </select>
                    </div>
                   

                  </div>

                
               

                
                </form>

                <table id="example1" class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Produit</th>
                <th>Par</th>
                <th>BarCode</th>
                <th>Date</th>
                <th>Commentaire</th>
                <th>Prix V</th>
            </tr>
        </thead>
        <tbody>
          <?php
          
          $decla = $this->Model->getRequete('SELECT ID_STOCK_ENDOMAGE, NOM_PRODUIT, PRIX_VENTE, BARCODE, req_stock_endomage.DATE_TIME, COMMENTAIRE, NOM, PRENOM FROM `req_stock_endomage` JOIN saisie_produit ON saisie_produit.ID_PRODUIT=req_stock_endomage.ID_PRODUIT JOIN config_user ON config_user.ID_USER=req_stock_endomage.ID_USER WHERE 1 '.$conddatedebut.' '.$conduser.' ');
         $tot = 0;
         $totr = 0;
         $totp = 0;
          foreach ($decla as $key) 
         {
              
          echo "<tr>
                <td>".$key['ID_STOCK_ENDOMAGE']."</td>
                <td>".$key['NOM_PRODUIT']."</td>
                <td>".$key['NOM']." ".$key['PRENOM']."</td>
                <td>".$key['BARCODE']."</td>
                <td>".$key['DATE_TIME']."</td>
                <td>".$key['COMMENTAIRE']."</td>
                <td class='text-right'>".number_format($key['PRIX_VENTE'], 0,',',' ')."</td>";
          
            
         echo "</tr>";
         $tot += $key['PRIX_VENTE'];
         // $totr += $key['MONTANT_REMISE'];
         // $totp += $key['MONTANT_PAYE'];
       }
          ?>
            
            
            
            
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6">TOTAL</th>
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
<script>
  function changelist() {
    // alert('aa');
document.getElementById("myForm").submit();
  }
  </script>
<script type="text/javascript">

  $('#reservation').daterangepicker({

        locale: {
        format: 'DD/MM/YYYY'
      }
    })
  $('.select').select2();
</script>
</body>
</html>
