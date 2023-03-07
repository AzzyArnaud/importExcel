<?php
  include VIEWPATH.'includes/new_header.php';
  ?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  
  <?php
  include VIEWPATH.'includes/new_top_menu.php';
  include VIEWPATH.'includes/new_menu_principal.php';
  ?>

  <style type="text/css">
    #infos{visibility: hidden;}
  </style>

<script type="text/javascript">
  function printDiv() 
{

  var divToPrint=document.getElementById('infos');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write(
    '<html><link rel="stylesheet" href="<?php echo base_url() ?>dist/css/print.css"><body onload="window.print();">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},2000);

}
</script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <?php  
    // include 'includes/menu_requisition.php';
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Vente</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- class="form-inline" -->
<?php 
                          if(!empty($this->session->flashdata('message')))
                             echo $this->session->flashdata('message');
            ?>

            
    <div class="row">
      <div class="col-md-6 row">
      <div class="form-group col-md-12">
        <form role="form" action="<?=base_url('vente/Vente/save_tempovente')?>" enctype="multipart/form-data" method="POST">  
          <input type="hidden" class="form-control" value="<?php echo $CUNIQUE?>" name="CUNIQUE" id="CUNIQUE">  
          <label for="BARCODE">
                          Scan BarCode
                        </label> 
          <input type="text" class="form-control" value="" name="BARCODE" id="BARCODE" autofocus>
                        <?php echo form_error('BARCODE', '<div class="text-danger">', '</div>'); ?>

      </form>
    </div>

    <!-- <div class="form-group col-md-6">
        <form role="form" action="<?=base_url('vente/Vente/save_tempovente_select')?>" enctype="multipart/form-data" method="POST" id="select_stock">  
          <input type="hidden" class="form-control" value="<?php echo $CUNIQUE?>" name="CUNIQUE" id="CUNIQUE">   
          <label for="ID_PRODUIT">
                          Produit en stock
                        </label>
          

                  <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_PRODUIT" onchange="select_stock()" id="ID_PRODUIT">
                    <option value=""> </option>
                    <?php 

                    foreach ($vente_stock as $key) {
                      if ($key['NOMBRE'] > 0) {
                        echo "<option value=".$key['ID_PRODUIT'].">".$key['NOM_PRODUIT']." </option>";
                      }
                      
                    }

                    ?>
                  </select>
      </form>
    </div> -->
    <div class="form-group col-md-12">
        <form role="form" action="<?=base_url('vente/Vente/save_tempovente_nostock')?>" enctype="multipart/form-data" method="POST" id="save_tempovente_nostock">  
          <input type="hidden" class="form-control" value="<?php echo $CUNIQUE?>" name="CUNIQUE" id="CUNIQUE"> 

          <div class="form-group col-md-12">
          <label for="">
                          Quantite 
                        </label>
          <input type="number" class="form-control" value="1" name="QUANTITE" id="QUANTITE">
                </div>  

          <div class="form-group col-md-12">
          <label for="">
                          Produit 
                        </label>
          <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_PRODUIT" onchange="select_nostock()" id="ID_PRODUIT">
                    <option value=""> </option>
                    <?php 

                    foreach ($vente_no_stock as $key) {
                      // if ($key['NOMBRE'] > 0) {
                        echo "<option value=".$key['ID_PRODUIT'].">".$key['NOM_PRODUIT']." </option>";
                      // }
                      
                    }

                    ?>
                  </select>
                </div>
      </form>
    </div>

      <div class="form-group col-md-12">

            <?php echo $produit;?>
                        
                    
          </div>

      </div>
      <div class="col-md-6 form-group ">
        
        <div class="form-group col-md-12">
          <form role="form" action="<?=base_url('vente/Vente/save_vente')?>" enctype="multipart/form-data" method="POST">  
          <input type="hidden" class="form-control" value="<?php echo $CUNIQUE?>" name="CUNIQUE" id="CUNIQUE"> 
          <div class="row">
            

            <div class="form-group col-md-12">
                        <label for="IS_LIVRAISON">
                          Type de vente
                          <i class="text-danger"> *</i>
                        </label><br>
                          <label class="radio-inline">
                            <input type="radio" name="IS_LIVRAISON" id="inlineRadio1" value="0" checked> Normale
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="IS_LIVRAISON" id="inlineRadio2" value="1"> Livraison
                          </label>
                        <?php echo form_error('IS_LIVRAISON', '<div class="text-danger">', '</div>'); ?>
                     </div>

            <div class="form-group col-md-6">
                        <label for="ID_ASSURANCE">
                          Assurances
                          <i class="text-danger"> *</i>
                        </label>
                  <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_ASSURANCE" id="ID_ASSURANCE" style="width: 100%;" onchange="getassurance(this)">
                    <option value=""> </option>
                    <?php 

                    foreach ($assurance as $assurances) {
                      echo "<option value='".$assurances['ID_ASSURANCE']."'>".$assurances['NOM_ASSURANCE']."</option>";
                    }

                    ?>
                  </select>
                        <?php echo form_error('ID_ASSURANCE', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label for="ID_CLIENT">
                          Client
                          <i class="text-danger"> *</i>
                        </label>
                  <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_CLIENT" id="ID_CLIENT" style="width: 100%;">
                    <option value=""> </option>
                    <?php 

                    foreach ($client as $key) {
                      echo "<option value=".$key['ID_CLIENT'].">".$key['NOM_CLIENT']." ".$key['PRENOM_CLIENT']."</option>";
                    }

                    ?>
                  </select>
                        <?php echo form_error('ID_CLIENT', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label for="ID_TYPE_REMISE_ASS">
                          Couverture Assurance
                          <i class="text-danger"> *</i>
                        </label>
                  <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_TYPE_REMISE_ASS" id="ID_TYPE_REMISE_ASS" style="width: 100%;"  onchange="getremiseassurance()">
                    <option value=""> </option>
                    
                  </select>
                        <?php echo form_error('ID_TYPE_REMISE_ASS', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label for="ID_TYPE_REMISE_CLIENT">
                          Remise
                          <i class="text-danger"> *</i>
                        </label>
                  <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_TYPE_REMISE_CLIENT" id="ID_TYPE_REMISE_CLIENT" style="width: 100%;"  onchange="getremiseclient()">
                    <option value=""> </option>
                    <?php 

                    foreach ($remise as $key) {
                      echo "<option value=".$key['ID_TYPE_REMISE'].">".$key['POURCENTAGE']."</option>";
                    }

                    ?>
                  </select>
                        <?php echo form_error('ID_TYPE_REMISE_CLIENT', '<div class="text-danger">', '</div>'); ?>
                     </div>
                     <div class="form-group col-md-4">
                        <label for="MONTANT_TOTAL">
                          Total
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="text" class="form-control" value="<?php echo $totvente?>" name="MONTANT_TOTAL" id="MONTANT_TOTAL" readonly="readonly">
                        <?php echo form_error('MONTANT_TOTAL', '<div class="text-danger">', '</div>'); ?>
                 
                     </div>
                     <div class="form-group col-md-4">
                        <label for="MONTANT_REMISE">
                          Total Remise
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="text" class="form-control" value="0" name="MONTANT_REMISE" id="MONTANT_REMISE" readonly="readonly">
                        <?php echo form_error('MONTANT_REMISE', '<div class="text-danger">', '</div>'); ?>
                 
                     </div>
                     <div class="form-group col-md-4">
                        <label for="MONTANT_ASSURANCE">
                          Total Assurance
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="text" class="form-control" value="0" name="MONTANT_ASSURANCE" id="MONTANT_ASSURANCE" readonly="readonly">
                        <?php echo form_error('MONTANT_ASSURANCE', '<div class="text-danger">', '</div>'); ?>
                 
                     </div>

                     <div class="form-group col-md-12">
                        <label for="MONTANT_PAYE">
                          Total a paye
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="text" class="form-control" value="<?php echo $totvente?>" name="MONTANT_PAYE" id="MONTANT_PAYE" readonly="readonly">
                        <?php echo form_error('MONTANT_PAYE', '<div class="text-danger">', '</div>'); ?>
                 
                     </div>

                     <div class="form-group col-md-12">
                      <button type="submit" class="btn btn-success btn-block">Enregistrer</button>                 
                     </div>

          </div>  
          

                     

          </form>
        </div>

      </div>
  </div>
      


        
        
      </form>


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

    <div id="infos" class="barcode" style="width: 100%">
      
    </div>
    
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

  function select_stock() {
    // alert('aa');

document.getElementById("select_stock").submit();



  }

  function select_nostock() {

document.getElementById("save_tempovente_nostock").submit();



  }

  

  $('#reservation').daterangepicker({

        locale: {
        format: 'DD/MM/YYYY'
      }
    })
  $('.select').select2();

</script>
<!-- <script>
  $(document).ready(function(){ 
    $('#message').delay(5000).hide('slow');
    });
</script> -->

<script>
     function getassurance(va){

      var ID_ASSURANCE= $(va).val();
      $.post('<?php echo base_url('vente/Vente/getassurance')?>',
          {ID_ASSURANCE:ID_ASSURANCE},
          function(data){
            $('#ID_TYPE_REMISE_ASS').html(data);
          });
     }
</script>

     
     <script>
     function getremiseassurance(){
      var ID_TYPE_REMISE_ASS= $('#ID_TYPE_REMISE_ASS').val();
      var MONTANT_TOTAL=$('#MONTANT_TOTAL').val();
      var MONTANT_REMISE = $('#MONTANT_REMISE').val();
      $.post('<?php echo base_url('vente/Vente/getremiseassurance')?>',
          {ID_TYPE_REMISE_ASS:ID_TYPE_REMISE_ASS},
          function(data){
            // $('#MONTANT_ASSURANCE').html(data*);

            var MONTANT_ASSURANCE = (MONTANT_TOTAL*data)/100;
            // var MONTANT_REMISE
            var MONTANT_PAYE= MONTANT_TOTAL - MONTANT_ASSURANCE - MONTANT_REMISE;
        $('#MONTANT_ASSURANCE').val(MONTANT_ASSURANCE);
        $('#MONTANT_PAYE').val(MONTANT_PAYE);

          });
     }
</script>

<script>
     function getremiseclient(){
      var ID_TYPE_REMISE_CLIENT= $('#ID_TYPE_REMISE_CLIENT').val();
      var MONTANT_TOTAL=$('#MONTANT_TOTAL').val();
      var MONTANT_REMISE = $('#MONTANT_REMISE').val();
      var MONTANT_ASSURANCE= $('#MONTANT_ASSURANCE').val();
      $.post('<?php echo base_url('vente/Vente/getremiseclient')?>',
          {ID_TYPE_REMISE_CLIENT:ID_TYPE_REMISE_CLIENT},
          function(data){
            // $('#MONTANT_ASSURANCE').html(data*);

            var BASE_CALCUL = MONTANT_TOTAL - MONTANT_ASSURANCE;
            var MONTANT_REMISE = (BASE_CALCUL*data)/100;
            var MONTANT_PAYE= MONTANT_TOTAL - MONTANT_ASSURANCE - MONTANT_REMISE;
        $('#MONTANT_REMISE').val(MONTANT_REMISE);
        $('#MONTANT_PAYE').val(MONTANT_PAYE);

          });
     }
</script>


</body>
</html>
<script type="text/javascript">
  $('.facture').click(function(){

    var id=$(this).attr('id').split("-");
          $.ajax({
                  url:"<?php echo base_url() ?>vente/Facture/design_facture",
                  method:"POST",
                  //async:false,
                  data: {id:id[1]},
                                                                       
                  success:function(data)
                                      {  
                                         // alert(data); 

                                          $('#infos').html(''); 
                                          $('#infos').html(data); 

                                      printDiv();                                                  
                                       }
                });
        });
</script>