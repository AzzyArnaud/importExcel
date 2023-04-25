<?php
  include VIEWPATH.'includes/new_header.php';
  ?>
  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo base_url() ?>plugins/fullcalendar/main.css">

  
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <?php
  include VIEWPATH.'includes/new_top_menu.php';
  include VIEWPATH.'includes/new_menu_principal.php';
  ?>

  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    </section>
    <!-- Main content -->
    <section class="content">
      
      <!-- Default box -->
      <div class="card card-success">
        <div class="card-header">
                <h3 class="card-title">Rapport</h3>
              </div>
        <div class="card-body">

          <form action="<?=base_url('configuration/Barcode')?>" method='POST'>
                  <div class="row">
                    <div class="form-group col-lg-3">
                      <label for="exampleInputEmail1">TYPE DE PRODUIT </label>
                      <!-- <input type="date" class="form-control" id="DATE" onchange="change(event);" value="<?=$dt?>"/> -->
                      <select  class="form-control" id="type" onchange="change(event);">
                        <!-- <option value="0">TOUT</option> -->
                        <option value="1" <?php if($typ==1)echo 'selected'; ?>>Pharmaceutique</option>
                        <option value="2" <?php if($typ==2)echo 'selected'; ?>>PARA-Pharmaceutique</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-4">
                      <label for="exampleInputEmail1">PRODUIT </label>
                      <!-- <input type="date" class="form-control" id="DATE" onchange="change(event);" value="<?=$dt?>"/> -->
                      <select  class="form-control" id="produit" onchange="change(event);">
                        <option value="0">TOUT</option>
                        <option value="1" <?php if($p==1)echo 'selected'; ?>>PRODUITS VENDUS</option>
                        <option value="2" <?php if($p==2)echo 'selected'; ?>>PRODUITS NON VENDUS</option>
                      </select>
                    </div>
                    

                    <div class="form-group col-lg-2">
                      <label for="exampleInputEmail1">DATE DEBUT </label>
                      <input type="date" class="form-control" id="DATE" onchange="change(event);" value="<?=$dt?>"/>
                     
                    </div>
                    <div class="form-group col-lg-2">
                      <label for="exampleInputEmail1">DATE FIN</label>
                      <input type="date" class="form-control" id="DATE2" onchange="change(event);" value="<?=$dt1?>"/>
                      
                    </div>

                    <div class="form-group col-lg-1">
                      <label for="exampleInputEmail1" style="color:white">.</label>
                      <!-- <button type="submit" class="btn btn-success">G&eacute;nr&eacute;rer</button> -->
                    </div>
                  </div>
                </form>

          <?php 

            echo $this->table->generate($points);

            ?>
        </div>
        <!-- /.card-body -->
        <!-- <div class="card-footer">
          Footer
        </div> -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
 include VIEWPATH.'includes/new_copy_footer.php';  
  ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php
  include VIEWPATH.'includes/new_script.php';
  ?>

<!-- jQuery UI -->
<script src="<?php echo base_url() ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->

<!-- fullCalendar 2.2.5 -->

<script src="<?php echo base_url() ?>plugins/fullcalendar/main.js"></script>
<script src='<?php echo base_url() ?>plugins/fullcalendar/locales/fr.js'></script>


<script src="<?php echo base_url() ?>higthchart/code/highcharts.js"></script>
<script src="<?php echo base_url() ?>higthchart/code/modules/sankey.js"></script>
<script src="<?php echo base_url() ?>higthchart/code/modules/organization.js"></script>
<script src="<?php echo base_url() ?>higthchart/code/modules/exporting.js"></script>
<script src="<?php echo base_url() ?>higthchart/code/modules/accessibility.js"></script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="../dist/js/demo.js"></script> -->

<!--  -->
  <script>
  
</script>




</body>
</html>
<script>
        $(document).ready(function () {
            $("#d_table").DataTable({

        dom: 'Bfrtlip',
         buttons: [
             // {extend: 'print', title: ' <?=$titl?>'},
                {extend: 'excel', title: '<?=$titl?>'},
                {extend: 'pdf', title: ' <?=$titl?>',exportOptions: {
   columns: ':visible:not(:eq(9))' 
},
            blengthChange: false,
            responsive: true,
            // Declare the use of the extension in the dom parameter
            dom: 'lBfrtip',
            aLengthMenu: [
              [10,25, 50, 100, 200, -1],
              [10,25, 50, 100, 200, "All"]
          ],
          iDisplayLength: -1,
  }
        ],
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

           $('.change').change(function(){
      // var point=$('#POINT').val();
      // if (point) {
        // window.location.replace("<?=base_url()?>produit/Requisition/index/"+point);
        // window.location.href = "http://stackoverflow.com";
      // }
      // myform.submit();
     });


               function change(date){
// alert(date.vqli);
if(!$('#produit').val())$('#produit').val(0);
window.location.replace("<?=base_url()?>vente/Rapport_vente_text/index/"+$('#type').val()+"/"+$('#produit').val()+"/"+$('#DATE').val()+"/"+$('#DATE2').val());

    }
    </script>

