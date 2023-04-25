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
    <section class="content">
      <div class="container-fluid" style="padding-top: 20px">
        <div class="row">
          <div class="col-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Liste</h3>
              </div>
              <div class="card-body">

                <form action="<?php echo base_url('assc_liste/Assc_Controller/');?>" id="myForm" method="POST" >
                  <div class="row">

                    <div class="form-group col-md-3 col-sm-3 col-xs-3">
                      <label for="exampleInputName2">DU</label>
                      <input type="date" class="form-control float-right" name="DATE_DEBUT" value="<?php echo $DATE_DEBUTS; ?>" onchange="changelist()" >  
                    </div>

                    <div class="form-group col-md-3 col-sm-3 col-xs-3">
                      <label for="exampleInputName2">AU</label>
                      <input type="date" class="form-control float-right" name="DATE_FIN" value="<?php echo $DATE_FINS; ?>" onchange="changelist()" >  
                    </div>
                    <div class="form-group col-md-3 col-sm-3 col-xs-3">
                      <label for="exampleInputName2">ASSURANCE</label>
                      <select class="form-control select select2-success" data-dropdown-css-class="select2-success" onchange="changelist()" name="ID_ASSURANCE" id="ID_ASSURANCE" style="width: 100%;">
                        <option value=""> </option>
                        <?php 
                        $ID_ASSURANCE=$this->Model->getList('saisie_assurance',array());
                        foreach ($ID_ASSURANCE as $key) {
                          if ($ID_ASSURANCES == $key['ID_ASSURANCE'] ) {
                            echo "<option value=".$key['ID_ASSURANCE']." selected>".$key['NOM_ASSURANCE']."</option>";
                          }
                          else{
                            echo "<option value=".$key['ID_ASSURANCE'].">".$key['NOM_ASSURANCE']."</option>";
                          } 
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </form>


                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>ASSURANCE</th>
                      <th>CLIENT</th>
                      <th>POURCENTAGE</th>
                      <th>MONTANT</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php
                   foreach ($vente as $key) 
                   {

                    echo "<tr>
                    <td>".$key['NOM_ASSURANCE']."</td>
                    <td>".$key['NOM_CLIENT']." ".$key['PRENOM_CLIENT']."</td>
                    <td>".$key['POURCENTAGE_REMISE'].'%'."</td>

                    <td><div class='text-right'>".number_format($key['MONTANT_TOTAL'], 0,',',' ')."</div></td> ";


                  }
                  ?>


                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php
include VIEWPATH.'includes/new_copy_footer.php';  
?>

<aside class="control-sidebar control-sidebar-dark"></aside>

</div>

<?php
include VIEWPATH.'includes/new_script.php';
?>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel", "pdf"]
    }).buttons().container().appendTo('#example1_wrapper  .col-md-6:eq(0)');
    $(this).removeClass('btn-default').addClass('btn-success btn-dark');

  });
</script>

<script>
 $(document).ready(function(){
        // $('#DATE').datetimepicker({format: 'd-m-Y'});

  var row_count ="1000000";
     // alert(row_count);

  $("#example1").DataTable({
    dom: 'Bfrtlip',
    buttons: [

      {extend: 'excel', title: 'Envoi OBR',exportOptions: {
       columns: ':visible:not(:eq(7))' 
     },
     blengthChange: false,
     responsive: true,
            // Declare the use of the extension in the dom parameter
     dom: 'lBfrtip',
     paging: false
   },
   {extend: 'pdf', title: 'Envoi OBR',exportOptions: {
     columns: ':visible:not(:eq(7))' 
   },
   blengthChange: false,
   responsive: true,
            // Declare the use of the extension in the dom parameter
   dom: 'lBfrtip',
   paging: false
 }
 ],
    "processing":true,
    responsive: true,
    searching: false,
    "bSort" : false,
    "serverSide":true,
    "oreder":[],
    "ajax":{
      url:"<?=base_url()?>assc_liste/Assc_Controller/",
      type:"POST",
      data:{DT1:"<?=$dt?>",DT2:"<?=$date2?>"}
    },
    "drawCallback": function (settings) { 
        // Here the response
      var response = settings.json;
        // console.log(response.general);
      $("#INTERVAL").val(response.general+"~"+response.envoi)
    },
    lengthMenu: [[10,50, 100, row_count], [10,50, 100, "All"]],
    pageLength: 10,
    "columnDefs":[{
      "targets":[],
      "orderable":false
    }],
    language: {
      "sProcessing":     "Traitement en cours...",
      "sSearch":         "Rechercher&nbsp;:",
      "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
      "sInfo":           "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
      "sInfoEmpty":      "Affichage de l'&eacute;l&eacute;ment 0 &agrave; 0 sur 0 &eacute;l&eacute;ment",
      "sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
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
