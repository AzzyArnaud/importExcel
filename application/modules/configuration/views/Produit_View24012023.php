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
    include 'includes/menu_produit.php';
    ?>
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <!-- /.card -->

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Liste Des Produits</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>PRODUIT</th>
        <th>CATEGORIE PRODUIT</th>
        <!-- <th>STATUT</th> -->
        <!-- <th>ENVOIE</th> -->
        <!-- <th>SOCIETE</th> -->
        <th>STATUS</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody class="tbody">
        <?php
          if(sizeof($data) > 0) {
          foreach($data as $row) {

            $cat=$this->Model->getOne("saisie_categorie_produit",array("ID_CATEGORIE_PRODUIT"=>$row['ID_CATEGORIE_PRODUIT']));
            $soc=$this->Model->getOne("config_societe",array("ID_SOCIETE"=>$row['ID_SOCIETE']));

                      if ($row['STATUS'] == 1) {
                        $stat = 'Actif';
                        $fx = 'desactiver';
                        $col = 'btn-danger';
                        $titr = 'Désactiver';
                        $stitr = 'voulez-vous désactiver cet utilisateur ';
                        $bigtitr = 'Désactivation de cet utilisateur';
                      }
                      else{
                        $stat = 'Innactif';
                        $fx = 'reactiver';
                        $col = 'btn-success';
                        $titr = 'Réactiver';
                        $stitr = 'voulez-vous réactiver cet  utilisateur';
                        $bigtitr = 'Réactivation de cet  utilisateur';
                      }
           
                     echo "<tr>
                     <td>".$row['NOM_PRODUIT']."</td>
                     <td>".$cat['NOM']."</td>
                     <td>".$stat."</td>
                     <td><div class='modal fade' id='desactcat".$row['ID_PRODUIT']."' tabindex='-1' role='dialog' aria-labelledby='basicModal' aria-hidden='true'>
                     <div class='modal-dialog modal-sm'>
                       <div class='modal-content'>
                         <div class='modal-header'>
                           <h4 class='modal-title' id='myModalLabel'>".$bigtitr."</h4>
                           <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                             <span aria-hidden='true'>&times;</span>
                           </button>
                         </div>
                         <div class='modal-body'>
                           <h6><b>Mr/Mme , </b> ".$stitr." (".$row['NOM_PRODUIT']." ".$row['ID_CATEGORIE_PRODUIT'].")?</h6>
                         </div>
                         <div class='modal-footer'>
                           <button type='button' class='btn btn-default' data-dismiss='modal'>Annuler</button>
                           <a href='".base_url("configuration/Produit/".$fx."/".$row['ID_PRODUIT'])."' class='btn ".$col."'>".$titr."</a>
                         </div>
                       </div>
                     </div>
                   </div>
                             <div class='dropdown '>
                                       <a class='btn btn-success btn-sm dropdown-toggle' data-toggle='dropdown'>Actions
                                       <span class='caret'></span></a>
                                       <ul class='dropdown-menu dropdown-menu-right'>
                                       <li><a class='dropdown-item' href='".base_url("configuration/Produit/updating/".$row['ID_PRODUIT'])."'> Modifier </a> </li>
                                       <li><a class='dropdown-item' href='#' data-toggle='modal' data-target='#desactcat".$row['ID_PRODUIT']."'> ".$titr." </a> </li>
                                       </ul>
                                     </div></td>
                   </tr>";
           
                  // $tabledata[]=$chambr;
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
    $(this).removeClass('btn-default').addClass('btn-success btn-dark');
   
  });
</script>
<script>
  $('#mytable').DataTable();
</script>
</body>
</html>
