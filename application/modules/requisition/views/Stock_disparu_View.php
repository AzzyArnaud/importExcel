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
    <?php 
    include 'includes/menu_stock_disparu.php';
    ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    </section>
    <!-- Main content -->
    <section class="content">
      
      <!-- Default box -->
      <div class="card card-success">
        <div class="card-header">
                <h3 class="card-title"> <?=$stitle?></h3>
              </div>
        <div class="card-body">
           <?php 
                          // if(!empty($this->session->flashdata('message')))
                             echo $this->session->flashdata('message');
            ?>
          <form action="<?=base_url('configuration/Barcode')?>" method='POST'>
                  <div class="row">
                    

                    <div class="form-group col-lg-3">
                      <label for="exampleInputEmail1">DE </label>
                      <input type="date" class="form-control" id="DATE" onchange="change(event);" value="<?=$dt?>"/>
                     
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="exampleInputEmail1">AU </label>
                      <input type="date" class="form-control" id="DATE1" onchange="change(event);" value="<?=$dt1?>"/>
                     
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

                        function change(date){

if($('#DATE').val()&&$('#DATE1').val()){
window.location.replace("<?=base_url()?>requisition/Stock_disparu/<?=$this->router->method?>/"+$('#DATE').val()+"/"+$('#DATE1').val());
}

    }
    </script>

