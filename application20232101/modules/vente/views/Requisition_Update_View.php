<?php
  include VIEWPATH.'includes/new_header.php';
  ?>
  
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
    <?php 
    include 'includes/menu_requisition.php';
    ?>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">







        



      



      
      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Enregistrement des ravitaillement en Carburant</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="<?=base_url('requisition/Requisition/update_mettre_carburant')?>" enctype="multipart/form-data" method="POST">
                  <input type="hidden" name="NUM_GENERATED" value="<?=$approv['NUM_GENERATED']?>">
                  <input type="hidden" name="CONSOMATION_ID" value="<?=$approv['CONSOMATION_ID']?>">
                  <input type="hidden" name="USERSAVER" value="<?=$approv['USERSAVER']?>">

                <div class="card-body row">

                  <div class="form-group col-md-2">
                        <label for="VEHICULE_ID">
                          Voiture
                          <i class="text-danger"> *</i>
                        </label>
                  <select class="form-control select" name="VEHICULE_ID" id="VEHICULE_ID" style="width: 100%;">
                    <option value=""> </option>
                    <?php 

                    foreach ($approv['VEHICULE_ID'] as $key) {
                      if ($approv['VEHICULE_IDSELECTED'] == $key['VEHICULE_ID']) {
                        echo "<option value=".$key['VEHICULE_ID']." selected>".$key['PLAQUE_VEHICULE']."</option>";
                      }
                      else{
                        echo "<option value=".$key['VEHICULE_ID'].">".$key['PLAQUE_VEHICULE']."</option>";
                      }
                      
                    }

                    ?>
                  </select>
                        <?php echo form_error('VEHICULE_ID', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-4">
                        <label for="CHAUFFEUR_ID">
                          Chauffeurs
                          <i class="text-danger"> *</i>
                        </label>
                  <select class="form-control select" name="CHAUFFEUR_ID" id="CHAUFFEUR_ID" style="width: 100%;">
                    <option value=""> </option>
                    <?php 

                    foreach ($approv['CHAUFFEUR_ID'] as $key) {
                      if ($approv['CHAUFFEUR_IDSELECTED'] == $key['ID_EMPLOYE']) {
                        echo "<option value=".$key['ID_EMPLOYE']." selected>".$key['NOM']." ".$key['PRENOM']."</option>";
                      }
                      else{
                        echo "<option value=".$key['ID_EMPLOYE'].">".$key['NOM']." ".$key['PRENOM']."</option>";
                      }
                    }

                    ?>
                  </select>
                        <?php echo form_error('ID_EMPLOYE', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label for="STATION_ID">
                          Station
                          <i class="text-danger"> *</i>
                        </label>
                        
                        <select class="form-control select" name="STATION_ID" id="STATION_ID" style="width: 100%; height: 100%!important;">
                    <option value=""> </option>
                    <?php 

                    foreach ($approv['STATION_ID'] as $key) {

                      if ($key['STATION_ID'] == $approv['STATION_IDSELECTED']) {
                      echo "<option value=".$key['STATION_ID']." selected>".$key['STATION_NOM']."</option>";
                      }
                      else{
                      echo "<option value=".$key['STATION_ID'].">".$key['STATION_NOM']."</option>"; 
                      }
                      
                    }

                    ?>
                  </select>
                        <?php echo form_error('STATION_ID', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label for="QUANTITE_RECU">
                          Quantite (Nb littre) 
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="number" name="QUANTITE_RECU" value="<?=$approv['QUANTITE_RECU']?>" class="form-control" id="QUANTITE_RECU" placeholder="Nb littres" step="0.001">
                        <?php echo form_error('QUANTITE_RECU', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     

                     <div class="form-group col-md-3">
                        <label for="MONTANT_CONSOMATION">
                          Montant Total de la facture
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="number" name="MONTANT_CONSOMATION" value="<?=$approv['MONTANT_CONSOMATION']?>" class="form-control" id="MONTANT_CONSOMATION" placeholder="Montant Total" step="0.001">
                        <?php echo form_error('MONTANT_CONSOMATION', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-3">
                        <label for="PRIX_UNITAIRE">
                          Prix unitaire a la pompe
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="number" name="PRIX_UNITAIRE" value="<?=$approv['PRIX_UNITAIRE']?>" class="form-control" id="PRIX_UNITAIRE" placeholder="Prix unitaire" step="0.001">
                        <?php echo form_error('PRIX_UNITAIRE', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-3">
                        <label for="CONSOMATION_DATE">
                          Date de consomation
                          <i class="text-danger"> *</i>
                        </label>
                        <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" name="CONSOMATION_DATE" id="CONSOMATION_DATE" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask value="<?=$approv['CONSOMATION_DATE']?>">
                  </div>
                        <?php echo form_error('CONSOMATION_DATE', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-3">
                        <label for="KM_A_APROVISIONNEMENT">
                          KM au consomation
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="number" name="KM_A_APROVISIONNEMENT" value="<?=$approv['KM_A_APROVISIONNEMENT']?>" class="form-control" id="KM_A_APROVISIONNEMENT" placeholder="Quantité achetée" step="0.001">
                        <?php echo form_error('KM_A_APROVISIONNEMENT', '<div class="text-danger">', '</div>'); ?>
                     </div>




















































                     


                     

                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
                </div>
              </form>
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

  <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>



</body>
</html>
