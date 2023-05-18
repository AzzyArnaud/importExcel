<?php
include VIEWPATH.'includes/new_header.php';
?>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php
    include VIEWPATH.'includes/new_top_menu.php';
    include VIEWPATH.'includes/new_menu_principal.php';
    ?>


    <div class="content-wrapper">
    <?php 
    include 'includes/personne_nontrouve.php';
    ?>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Liste Des Commandes Des Personnes Non Trouvées</h3>
                </div>
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>NOM DU CLIENT</th>
                        <th>TELEPHONE</th>
                        <th>DATETIME</th>
                        <th>PRIX</th>
                        <th>STATUS</th>
                        <th>TRAITE PAR:</th>
                        <th>DETAIL</th>
                      </tr>
                    </thead>
                    <tbody class="tbody">
                      <?php
                      if(sizeof($data) > 0) {
                        foreach($data as $row) {

                          if ($row['STATUT'] == 1) {
                            $fx = 'traite';
                            $change = 'Non Traite';
                            $change1 = 'Personne non trouvée';
                            $col = 'btn-danger';
                            $col1 = 'btn-info';
                            $btn = 'btn-success';
                            $statut=0;
                            $statut1=2;
                            $titr = '&nbsp;&nbsp;&nbsp;&nbsp; Traite &nbsp;&nbsp;&nbsp;&nbsp;';
                            $stitr = 'voulez-vous changer le statut de cette commande de';
                            $bigtitr = 'Traitement';
                          }
                          else if ($row['STATUT'] == 2) {
                            $fx = 'traite';
                            $change = 'Traite';
                            $change1 = 'Non Traité';
                            $col = 'btn-success';
                            $col1 = 'btn-danger';
                            $btn = 'btn-info';
                            $statut=1;
                            $statut1=0;
                            $titr = 'Personne non trouvée';
                            $stitr = 'voulez-vous changer le statut de cette commande de';
                            $bigtitr = 'Traitement';
                          }
                          else{
                            $fx = 'nontraite';
                            $change = 'Traiter';
                            $change1 = 'Personne non trouvée';
                            $col = 'btn-success';
                            $col1 = 'btn-info';
                            $statut=1;
                            $statut1=2;
                            $btn = 'btn-danger';
                            $titr = 'Non Traite';
                           $stitr = 'voulez-vous changer le statut de cette commande de';
                            $bigtitr = 'Traitement';
                          }
                          if ($row['STATUT'] == 0) {
                            $TraiteUser = '<p style="color:red;">Pas Encore Traité</p>';
                          }
                          else{
                            $TraiteUser = $row['NOM']." ".$row['PRENOM'];

                            // $TraiteUser = $this->session->userdata('STRAPH_ID_USER');
                          }

                          echo "<tr>
                          <td>".$row['NOM_USER']."  ".$row['PRENOM_USER']."</td>
                          <td>".$row['TELEPHONE']."</td>
                          <td>".$row['DATETIME']."</td>
                          <td>".$row['PRIX_COMMANDE']."</td>
                          <td><div class='modal fade' id='desactcat".$row['ID_COMMANDE']."' tabindex='-1' role='dialog' aria-labelledby='basicModal' aria-hidden='true'>
                          <div class='modal-dialog modal-lg'>
                          <div class='modal-content'>
                          <div class='modal-header'>
                          <h4 class='modal-title' id='myModalLabel'>".$bigtitr."</h4>
                          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                          <span aria-hidden='true'>&times;</span>
                          </button>
                          </div>
                          <div class='modal-body'>
                          <h6><b>Mr/Mme , </b> ".$stitr." (".$row['NOM_USER']."  ".$row['PRENOM_USER'].")?</h6>
                          </div>
                          <div class='modal-footer'>
                          <button type='button' class='btn btn-default' data-dismiss='modal'>Annuler</button>
                          <a href='".base_url("commandes/Commande/traite/".$statut."/".$row['ID_COMMANDE'])."' class='btn ".$col."'>".$change."</a>
                          <a href='".base_url("commandes/Commande/traite/".$statut1."/".$row['ID_COMMANDE'])."' class='btn ".$col1."'>".$change1."</a>
                          </div>
                          </div>
                          </div>
                          </div>
                          <a class='btn btn-sm ".$btn."' href='#' data-toggle='modal' data-target='#desactcat".$row['ID_COMMANDE']."'> ".$titr." </a>
                          </td>
                          <td>".$TraiteUser."</td>
                          <td><a href='javascript:;'  class='btn btn-success btn-md' onclick='get_details(" . $row['ID_COMMANDE'] . ")'>
                          " . $row['DETAIL'] . "

                          </a></td>
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

<!-------------- Modal Of The List That Show The Details ---------------->
<div class="modal" id="depart" role="dialog">
  <div class="modal-dialog modal-lg ">
    <div class="modal-content">
      <div class="modal-header">
       <h5> Details </h5>
       <div >    
        <i class="close fa fa-remove float-left text-primary" data-dismiss="modal"></i>  
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>

      </div>
    </div>
    <div class="modal-body">
      <div class="table-responsive">
        <table id='mytable3' class="table table-bordered table-striped table-hover table-condensed " style="width: 100%;">
          <thead>
            <tr>
              <th>#</th>
              <th>PRODUIT</th>
              <th>PRIX UNITAIRE</th>
              <th>QUANTITE</th>
              <th>PRIX TOTAL</th>
            </tr>
          </thead>
          <tbody id="table3">

          </tbody>

        </table>

      </div>

    </div>
  </div>
</div>
</div>
<script>
// THIS FUNCTION IS

  function get_details(id)
  {
    // alert(id)
   $("#depart").modal("show");

   var row_count ="1000000";
   table=$("#mytable3").DataTable({
    "processing":true,
    "destroy" : true,
    "serverSide":true,
    "oreder":[[ 0, 'desc' ]],
    "ajax":{
      url:"<?=base_url()?>commandes/Commande/get/"+id,
      type:"POST"
    },
    lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
    pageLength: 10,
    "columnDefs":[{
      "targets":[],
      "orderable":false
    }],
    dom: 'Bfrtlip',
    buttons: ['excel', 'pdf'],  

    language: {
      "sProcessing":     "Traitement en cours...",
      "sSearch":         "Rechercher&nbsp;:",
      "sLengthMenu":     "Afficher MENU &eacute;l&eacute;ments",
      "sInfo":           "Affichage de l'&eacute;l&eacute;ment START &agrave; END sur TOTAL &eacute;l&eacute;ments",
      "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
      "sInfoFiltered":   "(filtr&eacute; de MAX &eacute;l&eacute;ments au total)",
      "sInfoPostFix":    "",
      "sLoadingRecords": "Chargement en cours...",
      "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
      "sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
      "oPaginate": {
        "sFirst":      "Premier",
        "sPrevious":   "Pr&eacute;c&eacute;dent",
        "sNext":       "Suivant",
        "sLast":       "Dernier"
      },
      "oAria": {
        "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
        "sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
      }
    }

  });


 }

</script>