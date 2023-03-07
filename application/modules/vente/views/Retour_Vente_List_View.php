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
    // include 'includes/menu_requisition.php';
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Liste des vente</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- class="form-inline" -->
                <form action="<?php echo base_url('vente/Retour_Vente');?>" id="myForm" method="POST" >
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
                <th>Date</th>
                <th>Par</th>
                <th>Montant Remise</th>
                <th>Montant Paye</th>
                <th>Montant Total</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
          <?php

         $tot = 0;
         $totr = 0;
         $totp = 0;
          foreach ($vente as $key) 
         {

          $det_medicam = $this->Model->getRequete('SELECT vente_detail.ID_VENTE_DETAIL, NOM_PRODUIT, PRIX_UNITAIRE, BARCODE FROM `vente_detail` LEFT JOIN saisie_produit ON saisie_produit.ID_PRODUIT=vente_detail.ID_PRODUIT LEFT JOIN req_barcode ON req_barcode.ID_BARCODE = vente_detail.ID_BARCODE WHERE `ID_VENTE` = '.$key['ID_VENTE'].'');
          $details = '<table class="table">';
          $details .= '<tr><th colspan="5">Details des medicament vendue</th></tr>';
          $details .= '<tr><td>Produit</td><td>Quantite</td><td>Prix Unitaire</td><td>BARCODE</td><td>Retourner</td></tr>';
          foreach ($det_medicam as $value) {
          $details .= '<tr><td>'.$value['NOM_PRODUIT'].'</td><td>1</td><td>'.$value['PRIX_UNITAIRE'].'</td><td>'.$value['BARCODE'].'</td><td><a class="btn btn-danger btn-sm" href="'.base_url('vente/Retour_Vente/delete_items/'.$value['ID_VENTE_DETAIL'].'').'" role="button"><i class="fa fa-minus-circle" aria-hidden="true"></i> Enlever </a></td></tr>';
          }
          $details .='</table>';


              
          echo "<tr>
                <td>".$key['ID_VENTE']."</td>
                <td>".$key['DATE_TIME_VENTE']."</td>
                <td>".$key['NOM']." ".$key['PRENOM']."</td>
                <td class='text-right'>".number_format($key['MONTANT_REMISE'], 0,',',' ')."</td>
                <td class='text-right'>".number_format($key['MONTANT_PAYE'], 0,',',' ')."</td>
                <td><div class='text-right'>".number_format($key['MONTANT_TOTAL'], 0,',',' ')."</div></td> ";
                $modadcontent='<!-- Button trigger modal -->
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal'.$key['ID_VENTE'].'">
                  Retourner Un a un
                </button>
                
                <!-- Modal -->
                <div class="modal fade" id="myModal'.$key['ID_VENTE'].'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content text-left">
                      <div class="modal-body  text-left">
                          '.$details.'
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>';
          
            
         echo "<td>".$modadcontent."
         </td></tr>";
         $tot += $key['MONTANT_TOTAL'];
         $totr += $key['MONTANT_REMISE'];
         $totp += $key['MONTANT_PAYE'];
       }
          ?>
            
            
            
            
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">TOTAL</th>
                <th class="text-right"><?php echo number_format($totr, 0,',',' ')?></th>
                <th class="text-right"><?php echo number_format($totp, 0,',',' ')?></th>
                <th class="text-right"><?php echo number_format($tot, 0,',',' ')?></th>
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
