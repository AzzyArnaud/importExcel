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
    // include 'includes/menu_client.php';
    ?>
    <!-- Content Header (Page header) -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="padding-top: 20px">
        <div class="row">
          <div class="col-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Liste Des Client</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="<?=base_url('configuration/Barcode')?>" method='POST'>
                  <div class="row">
                    <div class="form-group col-sm-4">
                      <label for="exampleInputEmail1">DU<spam class="text-danger">*</spam> </label>
                      <input type="date" class="form-control" id="DATE" onchange="change();" value="<?=$dt?>"/>
                      
                    </div>
                    <div class="form-group col-sm-4">
                      <label for="exampleInputEmail1">AU<spam class="text-danger">*</spam> </label>
                      <input type="date" class="form-control" id="DATE1" onchange="change();" value="<?=$date2?>"/>
                      
                    </div>
                    <div class="form-group col-lg-1">
                      <label for="exampleInputEmail1" style="color:white">.</label>
                      <!-- <button type="submit" class="btn btn-success">G&eacute;nr&eacute;rer</button> -->
                    </div>
                  </div>
                </form>


                <table id="example1" class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>NUMERO</th>
        <th>DATE FACTURE</th>
        <th>DATE ENVOIE OBR</th>
        <th>CLIENT</th>
        <th>PRODUITS</th>
        <th>MONTANT</th>
        <th>ACTION</th>
      </tr>
    </thead>
    <tbody class="tbody">
     
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
            url:"<?=base_url()?>OBR/get_info/",
            type:"POST",
            data:{DT1:"<?=$dt?>",DT2:"<?=$date2?>"}
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


           function change(){
// alert(date.vqli);
// console.log($('#DATE').val());
if($('#DATE').val()&&$('#DATE1').val())
window.location.replace("<?=base_url()?>OBR/list_OBR/"+$('#DATE').val()+"/"+$('#DATE1').val());

    }
</script>

</body>
</html>
