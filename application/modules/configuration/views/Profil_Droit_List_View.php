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
    <!-- Content Header (Page header) -->
    
    <?php 
    include 'includes/menu_profil_droit.php';
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Liste des profils et droits d&eacute;j&agrave; enregistr&eacute;</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th>Description</th>
                    <th>Droit</th>
                    <th>Options</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                    foreach ($resultat as $key) 
                    {
                    
                      
                      $droits = $this->Model->getRequete('SELECT config_droits.DESCRIPTION AS DROIT FROM `config_profil` JOIN config_profil_droit ON config_profil_droit.PROFIL_ID = config_profil.PROFIL_ID JOIN config_droits ON config_droits.ID_DROIT = config_profil_droit.ID_DROIT WHERE config_profil_droit.PROFIL_ID = '.$key['PROFIL_ID'].' ');
                      $resdroit ="<table class='table'>";
                      foreach ($droits as $value) {
                        $resdroit.="<tr><td>".$value['DROIT']."</td></tr>";
                      }
                      $resdroit.="</table>";
                      
                     echo "<tr>
                     <td>".$key['DESCRIPTION']."</td>
                     <td><a class='btn btn-success btn-xs' href='#' data-toggle='modal' data-target='#rendreeff".$key['PROFIL_ID']."'> ".$key['NUMBER']." </a></td>
                     <td>
                   <div class='modal fade' id='rendreeff".$key['PROFIL_ID']."' tabindex='-1' role='dialog' aria-labelledby='basicModal' aria-hidden='true'>
                     <div class='modal-dialog'>
                       <div class='modal-content'>
                         <div class='modal-header'>
                           <h4 class='modal-title' id='myModalLabel'>".$key['DESCRIPTION']."</h4>
                           <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                             <span aria-hidden='true'>&times;</span>
                           </button>
                         </div>
                         <div class='modal-body'>
                         ".$resdroit."
                         </div>
                         <div class='modal-footer'>
                           <button type='button' class='btn btn-default' data-dismiss='modal'>Fermer</button>
                         </div>
                       </div>
                     </div>
                   </div>
                   
                             <div class='dropdown '>
                                       <a class='btn btn-success btn-sm dropdown-toggle' data-toggle='dropdown'>Actions
                                       <span class='caret'></span></a>
                                       <ul class='dropdown-menu dropdown-menu-right'>
                                       <li><a class='dropdown-item' href='".base_url("configuration/Profil_Droit/index_update/".$key['PROFIL_ID'])."'> Modifier </a> </li>
                                       
                                       </ul>
                                     </div></td>
                   </tr>";
           
                     
                                     
                  // $tabledata[]=$chambr;
                }
                  ?>
                  
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
    $(this).removeClass('btn-default').addClass('btn-success btn-dark');
   
  });
</script>
</body>
</html>
