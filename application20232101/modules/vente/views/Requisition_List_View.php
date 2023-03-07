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
              <div class="card-header">
                <h3 class="card-title">Liste des requisitions d&eacute;j&agrave; enregistr&eacute;</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- class="form-inline" -->
                <form action="<?php echo base_url('requisition/Requisition/listing');?>" id="myForm" method="post" >
                <div class="row">

                    <div class="form-group col-md-3 col-sm-3 col-xs-3">
                <label for="exampleInputName2">Periode:</label>
                      
                      <input type="text" class="form-control float-right" name="PERIODE" value="<?php echo $selectdate; ?>" id="reservation">  
                    </div>

                    <div class="form-group col-md-3 col-sm-3 col-xs-3">
                        <label for="exampleInputName2">Fournisseur:</label>
                        <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_FOURNISSEUR" id="ID_FOURNISSEUR" style="width: 100%;">
                        <option value=""> </option>
                        <?php 
                        $ID_FOURNISSEUR=$this->Model->getList('saisie_fournisseur',array());
                        foreach ($ID_FOURNISSEUR as $key) {
                          if ($ID_FOURNISSEURS == $key['ID_FOURNISSEUR'] ) {
                            echo "<option value=".$key['ID_FOURNISSEUR']." selected>".$key['NOM']."</option>";
                          }
                          else{
                            echo "<option value=".$key['ID_FOURNISSEUR'].">".$key['NOM']."</option>";
                          } 
                        }
                        ?>
                      </select>
                  </div>

                    <div class="form-group col-md-3 col-sm-3 col-xs-3">
                      <label for="exampleInputName2">Fait par:</label>
                      <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_USER" id="ID_USER" style="width: 100%;">
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
                    <div class="col-md-3 col-sm-3 col-xs-3">
                      <br>
                      <!-- <br> -->
                      <a class="btn btn-success btn-xs" href="#" onclick="changelist()" role="button"><i class="fa fa-search" aria-hidden="true"></i> Recherche </a> &nbsp;

                  <a class="btn btn-success btn-xs" href="<?php echo base_url('requisition/Requisition/listing');?>" role="button"> <i class="fa fa-undo" aria-hidden="true"></i> Réinitialiser </a> &nbsp;
                  <a class="btn btn-success btn-xs" href="#" onclick="exportlist()" role="button"><i class="fa fa-download" aria-hidden="true"></i> Excel </a>
                    </div>

                  </div>

                
               

                
                </form>
                <div class="text-center"><?php echo $title;?></div>



                <table id="mytable" class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Date</th>
                <th>Par</th>
                <th>Fournisseur</th>
                <th>Total</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
          <?php

          $resultat=$this->Model->getRequete('SELECT DATE_REQUISITION, ID_USER_REQUISITION, config_user.NOM, config_user.PRENOM, req_requisition.ID_FOURNISSEUR, saisie_fournisseur.NOM AS FOURNISSEUR, SUM(MONTANT_TOTAL_ACHAT) AS MONTANT_TOTAL_ACHAT FROM `req_requisition` JOIN config_user ON config_user.ID_USER = req_requisition.ID_USER_REQUISITION JOIN saisie_fournisseur ON saisie_fournisseur.ID_FOURNISSEUR = req_requisition.ID_FOURNISSEUR WHERE req_requisition.ID_SOCIETE = '.$this->session->userdata('STRAPH_ID_SOCIETE').' GROUP BY DATE_REQUISITION , ID_USER_REQUISITION, ID_FOURNISSEUR, config_user.NOM, PRENOM ,saisie_fournisseur.NOM');
         $tot = 0;
          foreach ($resultat as $key) 
         {
              
          echo "<tr>
                <td>".$key['DATE_REQUISITION']."</td>
                <td>".$key['NOM']." ".$key['PRENOM']."</td>
                <td>".$key['FOURNISSEUR']."</td>
                <td><div class='text-right'>".number_format($key['MONTANT_TOTAL_ACHAT'], 2,',',' ')."</div></td> ";
          $modadcontent ='<ul class="navbar-nav ml-auto text-center">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
         Detail <i class="fas fa-cog"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">';
            $modadcontent.='<div class="dropdown-divider"></div>
          <a href="' . base_url('requisition/Requisition/detail/'.$key['DATE_REQUISITION'].'/'.$key['ID_USER_REQUISITION'].'/'.$key['ID_FOURNISSEUR']) . '" class="dropdown-item">jjjj</a>';
         
          $modadcontent.='<div class="dropdown-divider"></div>
          
        </div>
      </li>
      
    </ul>
  </nav>';
  
         echo "<td>".$modadcontent."</td></tr>";
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
