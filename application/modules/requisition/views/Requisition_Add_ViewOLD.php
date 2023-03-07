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







        



      



      
      <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Enregistrement réquisition médicament</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form role="form" action="<?=base_url('requisition/Requisition/save_requisition')?>" enctype="multipart/form-data" method="POST">
                  <!-- <input type="hidden" name="NUM_GENERATED" value="<?=$approv['NUM_GENERATED']?>"> -->
                <div class="card-body row">

                  <div class="form-group col-md-4">
                        <label for="DATE_REQUISITION">
                          Date de requisition
                          <i class="text-danger"> *</i>
                        </label>
                        <!-- <div class="input-group"> -->
                    <!-- <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div> -->
                    <input type="date" class="form-control" max='<?php echo date('Y-m-d')?>' value="<?php echo date('Y-m-d')?>" name="DATE_REQUISITION" id="DATE_REQUISITION">
                  <!-- </div> -->
                        <?php echo form_error('DATE_REQUISITION', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-4">
                        <label for="ID_FOURNISSEUR">
                          Fournisseur
                          <i class="text-danger"> *</i>
                        </label>
                  <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_FOURNISSEUR" id="ID_FOURNISSEUR" style="width: 100%;">
                    <option value=""> </option>
                    <?php 

                    foreach ($approv['ID_FOURNISSEUR'] as $key) {
                      echo "<option value=".$key['ID_FOURNISSEUR'].">".$key['NOM']."</option>";
                    }

                    ?>
                  </select>
                        <?php echo form_error('ID_FOURNISSEUR', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-3">
                        <label for="ID_USER_REQUISITION">
                          Employe Requisitioner
                          <i class="text-danger"> *</i>
                        </label>
                        
                        <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_USER_REQUISITION" id="ID_USER_REQUISITION">
                    <option value=""> </option>
                    <?php 

                    foreach ($approv['ID_USER_REQUISITION'] as $key) {
                      echo "<option value='".$key['ID_USER']."'>".$key['NOM']." ".$key['PRENOM']."</option>";
                    }

                    ?>
                  </select>
                        <?php echo form_error('ID_USER_REQUISITION', '<div class="text-danger">', '</div>'); ?>
                     </div>
                     <div class="form-group col-md-1">
                        <label for="POURCENTAGE">
                          Formule
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="number" name="POURCENTAGE" value="1.4" class="form-control" id="POURCENTAGE" step="0.001">
                        <?php echo form_error('POURCENTAGE', '<div class="text-danger">', '</div>'); ?>
                     </div>
                     <div class="form-group col-md-12">
                            <h3 class="card-title"><br>Différents médicaments achetés</h3>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="ID_PRODUIT">
                          Produits 
                          <i class="text-danger"> *</i>
                        </label>
                        <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_PRODUIT" id="ID_PRODUIT">
                    <option value=""> </option>
                    <?php 

                    foreach ($approv['ID_PRODUIT'] as $key) {
                      echo "<option value=".$key['ID_PRODUIT'].">".$key['NOM_PRODUIT']."</option>";
                    }

                    ?>
                  </select>
                        <?php echo form_error('ID_PRODUIT', '<div class="text-danger">', '</div>'); ?>
                     </div> 

                     <div class="form-group col-md-2">
                        <label for="PRIX_ACHAT_UNITAIRE">
                          Prix Unitaire
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="number" name="PRIX_ACHAT_UNITAIRE" value="" class="form-control" id="PRIX_ACHAT_UNITAIRE" step="0.001" onkeyup="getpv(this)">
                        <?php echo form_error('PRIX_ACHAT_UNITAIRE', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-2">
                        <label for="QUANTITE">
                          Quantite 
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="number" name="QUANTITE" value="" class="form-control" id="QUANTITE" step="0.001">
                        <?php echo form_error('QUANTITE', '<div class="text-danger">', '</div>'); ?>
                     </div>
                     

                     <div class="form-group col-md-2">
                        <label for="DATE_PERAMPTION">
                          Date péremption 
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="date" name="DATE_PERAMPTION"  min='<?php echo date('Y-m-d')?>' value="" class="form-control" id="DATE_PERAMPTION">
                        <?php echo form_error('DATE_PERAMPTION', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-2">
                        <label for="PRIX_VENTE_UNITAIRE">
                          Prix de vente <span id="resultat_calcul"></span>
                          <!-- <i class="text-danger"> *</i> -->
                        </label>
                        <input type="number" name="PRIX_VENTE_UNITAIRE" value="" class="form-control" id="PRIX_VENTE_UNITAIRE"
                         step="0.001">
                        <?php echo form_error('PRIX_VENTE_UNITAIRE', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-1">
                        <label for=""> _ </label>
                        <a  class="btn btn-success btn-block" onclick="addElement()">+</a>
                     </div>

                     <div class="form-group col-md-12" id="RESULTAT">
                       
                     </div>

                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success btn-block">Enregistrer</button>
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
<script type="text/javascript">
  function getprice(val) {
    var v= $(val).val();
    $('#PRIX_UNITAIRE').val(v);
    document.getElementById("QUANTITE_RECU").readOnly = false;
  }
</script>
<!-- <script type="text/javascript">
  function getall(val) {
    var QUANTITE_RECU= $('#QUANTITE_RECU').val();
    var PRIX_UNITAIRE= $('#PRIX_UNITAIRE').val();
    var MONTANT_CONSOMATION = QUANTITE_RECU * PRIX_UNITAIRE;
    $('#MONTANT_CONSOMATION').val(MONTANT_CONSOMATION);
  }
</script> -->


</body>
</html>
<script type="text/javascript">
   function addElement(){
         

        var ID_PRODUIT=$('#ID_PRODUIT').val();
        var PRIX_ACHAT_UNITAIRE=$('#PRIX_ACHAT_UNITAIRE').val();
        var QUANTITE=$('#QUANTITE').val();
        var DATE_PERAMPTION=$('#DATE_PERAMPTION').val();
        var PRIX_VENTE_UNITAIRE=$('#PRIX_VENTE_UNITAIRE').val();

        if (ID_PRODUIT == "") {
          alert('Produit non selectionne');
             $("#ID_PRODUIT").focus();
         }
        else if (PRIX_ACHAT_UNITAIRE == "") {
          alert('Prix achat non saisie');
             $("#PRIX_ACHAT_UNITAIRE").focus();
         }
        else if (QUANTITE == "") {
          alert('Quantite non saisie');
             $("#QUANTITE").focus();
         }
        else if (DATE_PERAMPTION == "") {
          alert('Date de peramtion non saisie');
             $("#DATE_PERAMPTION").focus();
         }
         else{

          $.post('<?php echo base_url();?>requisition/Requisition/add_cart_medicament',
                {
                ID_PRODUIT:ID_PRODUIT,
                PRIX_ACHAT_UNITAIRE:PRIX_ACHAT_UNITAIRE,
                QUANTITE:QUANTITE,
                DATE_PERAMPTION:DATE_PERAMPTION,
                PRIX_VENTE_UNITAIRE:PRIX_VENTE_UNITAIRE
                },
                function(data) 
                { 
                    RESULTAT.innerHTML = data;  
                    $('#RESULTAT').html(data);

                     $('#PRIX_ACHAT_UNITAIRE').val(null);
    $('#QUANTITE').val(null);
    $('#DATE_PERAMPTION').val(null);
    $('#PRIX_VENTE_UNITAIRE').val(null);

                    
                }
            ); 

         }

        
}
</script>
<script type="text/javascript">
  
  function remove_medicament(id) {
    var rowid=id;
    // alert(rowid);

    $.post('<?php echo base_url();?>requisition/Requisition/remove_medicament',
  {
    rowid:rowid   
    },
    function(data) 
    { 
    RESULTAT.innerHTML = data;  
    $('#RESULTAT').html(data);

    $('#PRIX_ACHAT_UNITAIRE').val(null);
    $('#QUANTITE').val(null);
    $('#DATE_PERAMPTION').val(null);
    $('#PRIX_VENTE_UNITAIRE').val(null);
    }); 
  }
</script>
<script type="text/javascript">
   function getpv(){
         

        var PRIX_ACHAT_UNITAIRE=$('#PRIX_ACHAT_UNITAIRE').val();
        var POURCENTAGE=$('#POURCENTAGE').val();
        
        var PRIX_VENTE_UNITAIRETEMPO =PRIX_ACHAT_UNITAIRE*POURCENTAGE;
        var PRIX_VENTE_UNITAIRE =Math.ceil(PRIX_VENTE_UNITAIRETEMPO/100)*100;
        // var let x = Math.round(PRIX_VENTE_UNITAIRETEMPO);

        $('#resultat_calcul').html('('+Math.round(PRIX_VENTE_UNITAIRETEMPO)+')');
        $('#PRIX_VENTE_UNITAIRE').val(PRIX_VENTE_UNITAIRE);
}
</script>