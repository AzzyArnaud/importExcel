<?php
  include VIEWPATH.'includes/new_header.php';
  ?>

<div class="wrapper">
  
  <?php
  include VIEWPATH.'includes/new_top_menu.php';
  include VIEWPATH.'includes/new_menu_principal.php';
  ?>
<style type="text/css">
  
</style>
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
                <h3 class="card-title">Factures</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover ">
    <thead>

      <tr>
        <th>#</th>
        <th>DATE</th>
        <th>NUMERO FACTURE</th>
        <th>CLIENT</th>
        <th>MONTANT HTVA</th>
        <th>TVA</th>
        <th>MONTANT TVAC</th>
        <!-- <th>SIGNATURE ELECTRONIQUE</th> -->
        <th>OPTIONS</th>
      </tr>
    </thead>
    <tbody class="tbody">
        <?php
        $i=1;
          if(sizeof($data) > 0) {
          foreach($data as $row) {

            if(empty($row['SIGNATURE_FACTURE'])){
              $envoi="<li><a class='dropdown-item' href='#' data-toggle='modal' data-target='#envoi".$row['ID_FACTURE']."' style='color:green'> Envoyer OBR </a> </li>";
              $annuler="";

            }else{
              $envoi="";
              $annuler="<li><a class='dropdown-item' href='#' data-toggle='modal' data-target='#desactcat".$row['ID_FACTURE']."' style='color:red'> Annuler OBR</a> </li>";
            }

                if ($row['IS_CANCEL']) {
                        $cond="style='color:red'";
                      } else $cond="";    
                     echo "<tr ".$cond.">
                     <td>".$i."</td>
                     <td>".$row['DATE_FACTURE']."</td>
                     <td>".$row['NUMERO_FACTURE']."</td>
                     <td>".$row['RAISON']."</td>
                     <td>".$row['MONTANT_HTVA']."</td>
                     <td>".$row['TVA']."</td>
                     <td>".$row['MONTANT_TVAC']."</td>
                     <td><div class='modal fade' id='desactcat".$row['ID_FACTURE']."' tabindex='-1' role='dialog' aria-labelledby='basicModal' aria-hidden='true'>
                     <div class='modal-dialog modal-sm'>
                       <div class='modal-content'>
                         <div class='modal-header'>
                           <h4 class='modal-title' id='myModalLabel'Annuler cette Facture?</h4>
                           <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                             <span aria-hidden='true'>&times;</span>
                           </button>
                         </div>
                         <div class='modal-body'>
                           <h6>Voulez vous vraiment annuler cette facture chez OBR?</h6>
                         </div>
                         <div class='modal-footer'>
                           <button type='button' class='btn btn-default' data-dismiss='modal'>retour</button>
                           <a href='".base_url("OBR/cancelInvoice/".$row['ID_FACTURE'])."' class='btn btn-danger'>Annuler facture</a>
                         </div>
                       </div>
                     </div>
                   </div>
                   <div class='modal fade' id='envoi".$row['ID_FACTURE']."' tabindex='-1' role='dialog' aria-labelledby='basicModal' aria-hidden='true'>
                     <div class='modal-dialog modal-sm'>
                       <div class='modal-content'>
                         <div class='modal-header'>
                           <h4 class='modal-title' id='myModalLabel'Annuler cette Facture?</h4>
                           <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                             <span aria-hidden='true'>&times;</span>
                           </button>
                         </div>
                         <div class='modal-body'>
                           <h6>Voulez vous vraiment Envoyer cette facture chez OBR?</h6>
                         </div>
                         <div class='modal-footer'>
                           <button type='button' class='btn btn-default' data-dismiss='modal'>retour</button>
                           <a href='".base_url("OBR/addInvoice/".$row['ID_FACTURE'])."' class='btn btn-success'>Envoyer facture</a>
                         </div>
                       </div>
                     </div>
                   </div>
                             <div class='dropdown '>
                                       <a class='btn btn-primary btn-sm dropdown-toggle' data-toggle='dropdown'>Actions
                                       <span class='caret'></span></a>
                                       <ul class='dropdown-menu dropdown-menu-right'>
                                       <li><a class='dropdown-item' href='".base_url("facturer/Facture/updating/".$row['ID_FACTURE'])."'> Modifier </a> </li>
                                       <li><a target='_blank' class='dropdown-item' href='".base_url("facturer/Facture/print_invoice/".$row['ID_FACTURE'])."'> Imprimer </a> </li>
                                       "
                                       .$envoi.$annuler.
                                       "
                                       
                                       </ul>
                                     </div></td>
                   </tr>";
           
           $i++;
                }
              ?>

        <?php 
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
    $(this).removeClass('btn-default').addClass('btn-primary btn-dark');
   
  });
</script>
<script>
  $('#mytable').DataTable();
</script>

</body>
</html>
