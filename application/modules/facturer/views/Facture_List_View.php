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
    include 'includes/menu_facture.php';
    ?>
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Facture</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- class="form-inline" -->
                <form action="<?php echo base_url('facturer/Facture/listing');?>" id="myForm" method="post" >
                <div class="row">

                  <!-- <div class="form-group col-md-2 col-sm-2 col-xs-2">
                <label for="exampleInputName2">De</label>
                      
                      
                      <input type="date" class="form-control float-right" name="DATE_DEBUT" value="<?php echo $DATE_DEBUTS; ?>" onchange="changelist()" >  
                    </div>

                    <div class="form-group col-md-2 col-sm-2 col-xs-2">
                <label for="exampleInputName2">A</label>
                      
                      
                      <input type="date" class="form-control float-right" name="DATE_FIN" value="<?php echo $DATE_FINS; ?>" onchange="changelist()" >  
                    </div> -->
                    <div class="form-group col-md-3 col-sm-3 col-xs-3">
                        <label for="exampleInputName2">Client:</label>
                        <select class="form-control select select2-primary" data-dropdown-css-class="select2-primary" onchange="changelist()" name="ID_CLIENT" id="ID_CLIENT" style="width: 100%;">
                        <option value=""> </option>
                        <?php 
                        $ID_CLIENT=$this->Model->getList('client',array());
                        foreach ($ID_CLIENT as $key) {
                          if ($ID_CLIENT == $key['ID_CLIENT'] ) {
                            echo "<option value=".$key['ID_CLIENT']." selected>".$key['RAISON']."</option>";
                          }
                          else{
                            echo "<option value=".$key['ID_CLIENT'].">".$key['RAISON']."</option>";
                          } 
                        }
                        ?>
                      </select>
                  </div>

                    <div class="form-group col-md-2 col-sm-2 col-xs-2">
                      <label for="exampleInputName2">Fait par:</label>
                      <select class="form-control select select2-primary" data-dropdown-css-class="select2-primary" onchange="changelist()" name="ID_USER" id="ID_USER" style="width: 100%;">
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

                    <div class="form-group col-md-3 col-sm-3 col-xs-3">
                      <label for="exampleInputName2">Saisi par:</label>
                      <select class="form-control select select2-primary" data-dropdown-css-class="select2-primary" onchange="changelist()" name="ID_USER_SAISIE" id="ID_USER_SAISIE" style="width: 100%;">
                                      <option value=""> </option>
                                      <?php 
                                      $ID_USER_SAISIE=$this->Model->getList('config_user',array());
                                        foreach ($ID_USER_SAISIE as $key) {
                                        if ($ID_USER_SAISIES == $key['ID_USER'] ) {
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
                <!-- <div class="text-center"><?php echo $title;?></div> -->



                <table id="mytable" class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Par</th>
                <th>Saisie</th>
                <th>Cleint</th>
                <th>Total</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
          <?php

          $resultat=$this->Model->getRequete('SELECT DATE_FACTURE,  ID_FACTURE, saisie.NOM AS NOMS, saisie.PRENOM AS PRENOMS, config_user.NOM, config_user.PRENOM, facture.ID_CLIENT, client.RAISON AS CLIENT, SUM(MONTANT_TVAC) AS MONTANT_TVAC FROM `facture` JOIN config_user ON config_user.ID_USER = facture.ID_SOCIETE JOIN client ON client.ID_CLIENT = facture.ID_CLIENT JOIN config_user as saisie ON saisie.ID_USER = facture.ID_FACTURE WHERE facture.ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE1').' '.$condfournisseur.' '.$conduser.' '.$condusersa.'  '.$conddatedebut.' GROUP BY DATE_FACTURE , ID_CLIENT, config_user.NOM, PRENOM ,client.RAISON,ID_USER_SAISIE, saisie.NOM ,  saisie.PRENOM ');
         $tot = 0;
          foreach ($resultat as $key) 
         {

          // $stock=$this->Model->getRequeteOne('SELECT ID_REQUISITION  FROM `req_barcode` WHERE ID_REQUISITION = '.$key['ID_REQUISITION'].'');
          //     if (empty($stock)) {
          //       $del = "<a class='btn btn-danger btn-sm' href='". base_url('requisition/Requisition/delete/'.$key['ID_REQUISITION'].'')."' role='button'>Delete</a>";
          //     }
          //     else{
          //       $del = '';
          //     }
          echo "<tr>
                <td>".$key['DATE_REQUISITION']."</td>
                <td>".$key['NOM']." ".$key['PRENOM']."</td>
                <td>".$key['NOMS']." ".$key['PRENOMS']."</td>
                <td>".$key['FOURNISSEUR']."</td>
                <td><div class='text-right'>".number_format($key['MONTANT_TOTAL_ACHAT'], 2,',',' ')."</div></td> ";
          
  
         echo "<td>
         <a class='btn btn-primary btn-sm' href='". base_url('facturer/Facture/detail/'.$key['DATE_FACTURE'].'/'.$key['NUMERO_FACTURE'].'/'.$key['ID_CLIENT'].'/'.$key['ID_USER_SAISIE'])."' role='button'>Details</a> 
         </td></tr>";
         $tot += $key['MONTANT_TOTAL_ACHAT'];
       }
          ?>
            
            
            
            
        </tbody>
        <tfoot>
            <tr>
                <th>TOTAL</th>
                <th colspan="3" class="text-right"><?php echo number_format($tot, 2,',',' ')?></th>
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
    $(this).removeClass('btn-default').addClass('btn-primary btn-dark');
   
  });
</script>
<script>
  $('#mytable').DataTable();
</script>
</body>
</html>
