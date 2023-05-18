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
<style type="text/css">
    .loader {
  width: 48px;
  height: 48px;
  border: 3px solid #FFF;
  border-radius: 50%;
  display: inline-block;
  position: relative;
  box-sizing: border-box;
  animation: rotation 1s linear infinite;
}
.loader::after {
  content: '';  
  box-sizing: border-box;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  width: 56px;
  height: 56px;
  border-radius: 50%;
  border: 3px solid;
  border-color: #FF3D00 transparent;
}
   .loader1 {
  width: 48px;
  height: 48px;
  border: 3px solid #FFF;
  border-radius: 50%;
  display: inline-block;
  position: relative;
  box-sizing: border-box;
  animation: rotation 1s linear infinite;
}
.loader1::after {
  content: '';  
  box-sizing: border-box;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  width: 56px;
  height: 56px;
  border-radius: 50%;
  border: 3px solid;
  border-color: #FF3D00 transparent;
}
@keyframes rotation {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
} 
  </style>

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
                 <span id="msg"></span>
<?php 
                          if(!empty($this->session->flashdata('message')))
                             echo $this->session->flashdata('message');
            ?>

            
    <div class="row">
      <div class="col-md-6 row">
      <div class="form-group col-md-12">
        <!-- <form role="form" action="<?=base_url('vente/Vente/save_tempovente')?>" enctype="multipart/form-data" method="POST">   -->
          <input type="hidden" class="form-control" value="<?php echo $CUNIQUE?>" name="CUNIQUE" id="CUNIQUE">  
          <label for="BARCODE">
                          Scan BarCode
                        </label> 
          <input type="text" class="form-control" value="" name="BARCODE" id="BARCODE" autofocus>
                        <?php echo form_error('BARCODE', '<div class="text-danger">', '</div>'); ?>

      <!-- </form> -->
    </div>
<div class="form-group col-md-12"><center><span id="load" class="loader"></span></center></div>
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
          <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_PRODUIT" id="ID_PRODUIT">
                    <option value=""> </option>

                    <?php 
$pro="<option value=''> </option>";
                    foreach ($prod as $key) {
                      // if ($key['NOMBRE'] > 0) {
                        echo "<option value=".$key['ID_PRODUIT'].">".$key['NOM_PRODUIT']." </option>";
                        $pro.="<option value=".$key['ID_PRODUIT'].">".$key['NOM_PRODUIT']." </option>";
                      // }
                      
                    }

                    ?>
          </select>QUANTITE EN STOCK: <span id="stock" style="color: red"></span>
                </div>
      </form>
    </div>

      <div class="form-group col-md-12" id="produits">

            <?php echo $produit;?>
                        
                    
          </div>

      </div>
      <div class="col-md-6 form-group ">

        <div class="modal fade" id="addclients" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>
      <div class="modal-body">

            <form   id="formulaireclient" method="POST" class="form-horizontal" accept-charset="utf-8" enctype="multipart/form-data">
                  
                <div class="card-body row">                     
                       <div class="form-group col-md-12">
                        <label for="TYPE_PERSONNE">
                          Type de Personne
                          <i class="text-danger"> *</i>
                        </label><br>
                          <label class="radio-inline">
                            <input type="radio" name="TYPE_PERSONNE" id="persoRadio1" value="1" checked> Physique
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="TYPE_PERSONNE" id="persoRadio2" value="2"> Morale
                          </label>
                        
                     </div>
                     <div class="form-group col-md-6">
                        <label for="NOM_CLIENT">
                          Nom
                        </label>
                        <input type="text" name="NOM_CLIENT" value="" class="form-control" id="NOM_CLIENT"
                         step="0.001">
                        <?php echo form_error('NOM_CLIENT', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label for="PRENOM_CLIENT">
                          Prenom
                        </label>
                        <input type="text" name="PRENOM_CLIENT" value="" class="form-control" id="PRENOM_CLIENT"
                         step="0.001">
                        <?php echo form_error('PRENOM_CLIENT', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label for="TEL_CLIENT">
                          Telephone
                        </label>
                        <input type="text" name="TEL_CLIENT" value="" class="form-control" id="TEL_CLIENT"
                         step="0.001">
                        <?php echo form_error('TEL_CLIENT', '<div class="text-danger">', '</div>'); ?>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="EMAIL_CLIENT">
                          Mail
                        </label>
                        <input type="text" name="EMAIL_CLIENT" value="" class="form-control" id="EMAIL_CLIENT"
                         step="0.001">
                        <?php echo form_error('EMAIL_CLIENT', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label for="NIF_CLIENT">
                          NIF
                        </label>
                        <input type="text" name="NIF_CLIENT" value="" class="form-control" id="NIF_CLIENT"
                         step="0.001">
                        <?php echo form_error('NIF_CLIENT', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label for="RC_CLIENT">
                          RC
                        </label>
                        <input type="text" name="RC_CLIENT" value="" class="form-control" id="RC_CLIENT"
                         step="0.001">
                        <?php echo form_error('RC_CLIENT', '<div class="text-danger">', '</div>'); ?>
                     </div>

                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a onclick="submitformulaire()" class="btn btn-success btn-block">Enregistrer</a>

                </div>
                
              </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        
      </div>
    </div>
  </div>
</div>
        
        <div class="form-group col-md-12">
          <form role="form" id="formvente" action="<?=base_url('vente/Vente/save_vente')?>" enctype="multipart/form-data" method="POST">  
          <input type="hidden" class="form-control" value="<?php echo $CUNIQUE?>" name="CUNIQUE" id="CUNIQUE"> 
          <div class="row">
            

            <div class="form-group col-md-6">
                        <label for="IS_LIVRAISON">
                          Type de vente
                          <i class="text-danger"> *</i>
                        </label><br>
                          <label class="radio-inline">
                            <input type="radio" name="IS_LIVRAISON" id="LivRadio1" value="0" checked> Normale
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="IS_LIVRAISON" id="LivRadio2" value="1"> Livraison
                          </label>
                        <?php echo form_error('IS_LIVRAISON', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label for="IS_DETTE">
                          Paiement
                          <i class="text-danger"> *</i>
                        </label><br>
                          <label class="radio-inline">
                            <input type="radio" name="IS_DETTE" id="DetteRadio1" value="0" checked> Normale
                          </label>
                          <label class="radio-inline">
                            <input type="radio" name="IS_DETTE" id="DetteRadio2" value="1"> Dette
                          </label>
                        <?php echo form_error('IS_DETTE', '<div class="text-danger">', '</div>'); ?>
                     </div>

            <div class="form-group col-md-6">
                        <label for="ID_ASSURANCE">
                          Assurances
                          <i class="text-danger"> *</i>
                        </label>
                  <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_ASSURANCE" id="ID_ASSURANCE" style="width: 100%;" onchange="getassurance(this)">
                    <option value="0"> </option>
                    <?php 
$ass="<option value=''> </option>";
                    foreach ($assurance as $assurances) {
                      echo "<option value='".$assurances['ID_ASSURANCE']."'>".$assurances['NOM_ASSURANCE']."</option>";
                      $ass.="<option value=".$assurances['ID_ASSURANCE'].">".$assurances['NOM_ASSURANCE']."</option>";
                    }

                    ?>
                  </select>
                        <?php echo form_error('ID_ASSURANCE', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label for="ID_CLIENT">
                          Client <a href="#" data-toggle="modal" data-target="#addclients" data-backdrop="static">Nouveaux Client </a>
                          <i class="text-danger"> *</i>
                        </label>
                       
                  <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_CLIENT" id="ID_CLIENT" style="width: 100%;">
                    <option value=""></option>
                    <?php 
                    $cl="<option value=''></option>";
                    foreach ($client as $key) {
                       $cl.="<option value='".$key['ID_CLIENT']."'>".$key['NOM_CLIENT']." ".$key['PRENOM_CLIENT']."(".$key['TEL_CLIENT'].")</option>";
                      echo "<option value=".$key['ID_CLIENT'].">".$key['NOM_CLIENT']." ".$key['PRENOM_CLIENT']."(".$key['TEL_CLIENT'].")</option>";
                     
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
                  <select class="form-control" data-dropdown-css-class="select2-success" name="ID_TYPE_REMISE_ASS" id="ID_TYPE_REMISE_ASS" style="width: 100%;"  onchange="getremiseassurance()">
                    <option value="0"> </option>
                    
                  </select>
                        <?php echo form_error('ID_TYPE_REMISE_ASS', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-6">
                        <label for="ID_TYPE_REMISE_CLIENT">
                          Reduction en %
                          <i class="text-danger"> *</i>
                        </label>
                  <select class="form-control " data-dropdown-css-class="select2-success" name="ID_TYPE_REMISE_CLIENT" id="ID_TYPE_REMISE_CLIENT" style="width: 100%;"  onchange="getremiseclient()">
                    <option value=""> </option>
                    <?php 

                    foreach ($remise as $key) {
                      if($key['POURCENTAGE']<=25)
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
                      <!-- <button type="submit" >Enregistrer</button> -->
                      <!-- <a class="btn btn-success btn-block" onclick="submitvente()" role="button">Enregistrer</a>          
                              -->
                              <span id="load1" class="loader1"></span></center>
                      <button type="button" id="submit_vente" class="btn btn-success btn-block" onclick="submitvente()" disabled>Enregistrer</button>                 
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

// document.getElementById("save_tempovente_nostock").submit();



  }

  function submitformulaire() {
    // document.getElementById("formulaireclient").submit(); 
    var NOM_CLIENT= $('#NOM_CLIENT').val();
    var PRENOM_CLIENT= $('#PRENOM_CLIENT').val();
    var NIF_CLIENT= $('#NIF_CLIENT').val();
    var RC_CLIENT= $('#RC_CLIENT').val();
    var EMAIL_CLIENT= $('#EMAIL_CLIENT').val();
    var TEL_CLIENT= $('#TEL_CLIENT').val();
    var TYPE_PERSONNE= $("input[name=TYPE_PERSONNE]:checked").val();





$.post('<?php echo base_url('vente/Vente/save_client')?>',
          {
            NOM_CLIENT:NOM_CLIENT,
            PRENOM_CLIENT:PRENOM_CLIENT,
            NIF_CLIENT:NIF_CLIENT,
            RC_CLIENT:RC_CLIENT,
            EMAIL_CLIENT:EMAIL_CLIENT,
            TEL_CLIENT:TEL_CLIENT,
            TYPE_PERSONNE:TYPE_PERSONNE
          },
          function(data){
            // alert(data);
            $('#ID_CLIENT').html(data); 
            $('#ID_CLIENT').selectpicker('refresh');
          });

 $('#NOM_CLIENT').val('');
 $('#PRENOM_CLIENT').val('');
 $('#NIF_CLIENT').val('');
 $('#RC_CLIENT').val('');
 $('#EMAIL_CLIENT').val('');
 $('#TEL_CLIENT').val('');
 $("input[name=TYPE_PERSONNE]:checked").val(0);
 $("#persoRadio1").prop("checked", true);

$('#addclients').modal('hide');
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
      if(ID_ASSURANCE){
      $.post('<?php echo base_url('vente/Vente/getassurance')?>',
          {ID_ASSURANCE:ID_ASSURANCE},
          function(data){
            $('#ID_TYPE_REMISE_ASS').html(data);
          });
    }else{
      $('#ID_TYPE_REMISE_ASS').html("<option value=''></option>");
       // var MONTANT_ASSURANCE = (MONTANT_TOTAL*data)/100;
            // var MONTANT_REMISE
            
            var MONTANT_TOTAL=$('#MONTANT_TOTAL').val();
            var MONTANT_REMISE = $('#MONTANT_REMISE').val();
            var MONTANT_PAYE= MONTANT_TOTAL - 0 - MONTANT_REMISE;
        $('#MONTANT_ASSURANCE').val(0);
        $('#MONTANT_PAYE').val(MONTANT_PAYE);
     }
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
alert();
    var id=$(this).attr('id').split("-");
          $.ajax({
                  url:"<?php echo base_url() ?>vente/Facture/design_facture",
                  method:"POST",
                  //async:false,
                  data: {id:id[1]},
                                                                       
                  success:function(data)
                                      {  
                                         // alert(data);

                                         var inform= data.split("|");

                                          $('#infos').html(''); 
                                          $('#infos').html(inform[0]); 

                                      if(inform[1]==0){
                                        printDiv();  
                                      }else{
                                        alert("ECHEC D'IMPRESSION FACTURE")
                                      }
                                                                                      
                                       }
                });
        });
</script>
<script type="text/javascript">
   function print_facture(id){

   
          $.ajax({
                  url:"<?php echo base_url() ?>vente/Facture/design_facture",
                  method:"POST",
                  //async:false,
                  data: {id:id},
                                                                       
                  success:function(data)
                                       {  
                                         // alert(data);

                                         var inform= data.split("|");

                                          $('#infos').html(''); 
                                          $('#infos').html(inform[0]); 

                                      if(inform[1]==0){
                                        printDiv();  
                                      }else{
                                        alert("ECHEC D'IMPRESSION FACTURE")
                                      }
                                                                                      
                                       }
                });
 }
</script>
<script type="text/javascript">
  function submitvente() {
    // getElementById("submit_vente").disabled=true;
    document.getElementById("submit_vente").disabled=true;
    $("#load1").show();
    var ID_ASSURANCE= $('#ID_ASSURANCE').val();
    var ID_TYPE_REMISE_ASS= $('#ID_TYPE_REMISE_ASS').val();

    var ID_CLIENT= $('#ID_CLIENT').val();
    var ID_TYPE_REMISE_CLIENT= $('#ID_TYPE_REMISE_CLIENT').val();
    // alert(ID_CLIENT);
    if (ID_TYPE_REMISE_ASS&&!ID_CLIENT) {
      $("#load1").hide();
      alert('Veillez chosir un client comme vous avez choisi une assurance ');
      $('#ID_CLIENT').focus();
      document.getElementById("submit_vente").disabled=false;
      return;
      }
     if (ID_TYPE_REMISE_CLIENT&&!ID_CLIENT) {
      $("#load1").hide();
      alert('Veillez chosir un client comme vous avez choisi une réduction ');
      $('#ID_CLIENT').focus();
      document.getElementById("submit_vente").disabled=false;
      return;
      }      

        var CUNIQUE=$("#CUNIQUE").val();
        var ID_ASSURANCE=$("#ID_ASSURANCE").val();
        var ID_CLIENT=$("#ID_CLIENT").val();
        var ID_TYPE_REMISE_ASS=$("#ID_TYPE_REMISE_ASS").val();
        var ID_TYPE_REMISE_CLIENT=$("#ID_TYPE_REMISE_CLIENT").val();
        var MONTANT_TOTAL=$("#MONTANT_TOTAL").val();
        var MONTANT_REMISE=$("#MONTANT_REMISE").val();
        var MONTANT_ASSURANCE=$("#MONTANT_ASSURANCE").val();
        var MONTANT_PAYE=$("#MONTANT_PAYE").val();
        var IS_LIVRAISON=$("input[name=IS_LIVRAISON]:checked").val();
        var IS_DETTE=$("input[name=IS_DETTE]:checked").val();
      // alert('OK');
        // document.getElementById("formvente").submit();
  $.ajax({


                            url:"<?php echo base_url() ?>vente/Vente_new/save_vente",
                            method:"POST",
                         // async:false,
                            data: {ID_ASSURANCE:ID_ASSURANCE,CUNIQUE:CUNIQUE,ID_CLIENT:ID_CLIENT,ID_TYPE_REMISE_ASS:ID_TYPE_REMISE_ASS,ID_TYPE_REMISE_CLIENT:ID_TYPE_REMISE_CLIENT,MONTANT_TOTAL:MONTANT_TOTAL,MONTANT_REMISE:MONTANT_REMISE,MONTANT_ASSURANCE:MONTANT_ASSURANCE,MONTANT_PAYE:MONTANT_PAYE,IS_LIVRAISON:IS_LIVRAISON,IS_DETTE:IS_DETTE},
                                                                                 
                            success:function(stutus)
                                                    { 
                                                     
  $("#load1").hide();

                                                      $("#BARCODE").val('');
                                                      
  document.getElementById("BARCODE").focus();
                                                      var resp=stutus.split("|");

                                                      
                                                      $("#msg").html(resp[2]);
                                                      $("#produits").html("");
                                                      $("#CUNIQUE").val(resp[0]);
                                                      $("#QUANTITE").val(1)
                                                      // console.log(stutus);//
                                                      // alert(resp[1]);
                                                      
   
                                                      $("#MONTANT_PAYE").val(0);
                                                      $("#MONTANT_TOTAL").val(0);
                                                      $("input[name=IS_LIVRAISON]:checked").val(0);
                                                      $("input[name=IS_LIVRAISON]:checked").val(0);
                                                      $("#LivRadio1").prop("checked", true);
                                                      $("#DetteRadio1").prop("checked", true);
                                                      // $("#LivRadio1").val(0);
                                                      // $("#ID_ASSURANCE").html('<?=$ass?>');
                                                      $("#ID_ASSURANCE").html("<?=$ass?>");
                                                      $("#ID_CLIENT").html("<?=$cl?>");
                                                      $("#ID_TYPE_REMISE_ASS").val("");
                                                      $("#ID_TYPE_REMISE_CLIENT").val("");
                                                      $("#MONTANT_TOTAL").val(0);
                                                      $("#MONTANT_TOTAL").val(0);
                                                      $("#MONTANT_REMISE").val(0);
                                                      $("#MONTANT_ASSURANCE").val(0);
                                                      
                                                      $("#ID_PRODUIT").val('');
                                                      $("#ID_PRODUIT").html("<?=$pro?>");

                                                      // print_facture(resp[1]);
                                                      // getElementById("submit_vente").disabled=false;
                                                      // document.getElementById("submit_vente").disabled=false;

                                                    }

        
                        });


      
    
     
  }
</script>

    <script>
      $(document).ready(function(){
 $("#load").hide();
 $("#load1").hide();
      }
      );
         $(document).on('keyup','#BARCODE',function(event){
    // alert();

          // console.log(event.keyCode);

if (event.keyCode===13) {

  $("#load").show();

var BARCODE=$("#BARCODE").val();
    var CUNIQUE=$("#CUNIQUE").val();

            let isnum =/^\d+\-?\d*$/.test(BARCODE);
//            /^\d+$/.test(barcode);
 var reg = new RegExp('^[0-9]+-[0-9]{1,10}$');
 let isnum1 =reg.test(BARCODE);

 if (isnum1) {


    $("#msg").val('');
    // $("#process").modal();

 // $('#process').modal("hide"); 
 // $('#process').modal("toggle"); 
    
 $("#BARCODE").focus();
          
                 $.ajax({
                            url:"<?php echo base_url() ?>vente/Vente_new/save_tempovente",
                            method:"POST",
                         // async:false,
                            data: {BARCODE:BARCODE,CUNIQUE:CUNIQUE},
                                                                                 
                            success:function(stutus)
                                                    { 
                                                     
  $("#load").hide();

                                                      $("#BARCODE").val('');
                                                      
  document.getElementById("BARCODE").focus();
                                                      var resp=stutus.split("|");

                                                      
                                                      $("#msg").html(resp[0]);
                                                      $("#produits").html(resp[1]);

                                                      $("#MONTANT_PAYE").val(resp[2]);
                                                      $("#MONTANT_TOTAL").val(resp[2]);
                                                      $("#ID_TYPE_REMISE_CLIENT").val("");
                                                      $("#ID_CLIENT").html("<?=$cl?>");
                                                      //
                                                     // $("#ID_CLIENT").html("<?=$cl?>");
                                                      
                                                      
                                                      $("#ID_TYPE_REMISE_ASS").val("");
                                                      $("#ID_ASSURANCE").html("<?=$ass?>");
                                                      if(resp[2]==0){
                                                      document.getElementById("submit_vente").disabled=true;
                                                      }else
                                                      document.getElementById("submit_vente").disabled=false;
                                                      // console.log(stutus);//
                                                      // alert(stutus);
                                                    }
        
                        });
                    

}else {
  $("#msg").html("<div class='alert alert-danger' role='alert'>CE BARCODE NE RESPECTE PAS NOTRE FORMAT</div>");
  $("#BARCODE").val('');
 document.getElementById("BARCODE").focus();
 $("#load").hide();
}

}

});
          
    </script>

      <script>
      
         $(document).on('change','#ID_PRODUIT',function(event){
    // alert();




    var ID_PRODUIT=$("#ID_PRODUIT").val();
    var CUNIQUE=$("#CUNIQUE").val();
    var QUANTITE=$("#QUANTITE").val();

if(ID_PRODUIT){
if(QUANTITE){

  $("#load").show();
    $("#msg").val('');
    // $("#process").modal();

 // $('#process').modal("hide"); 
 // $('#process').modal("toggle"); 
    
 $("#BARCODE").focus();
          
                 $.ajax({
                            url:"<?php echo base_url() ?>vente/Vente_new/save_tempovente_nostock",
                            method:"POST",
                         // async:false,
                            data: {ID_PRODUIT:ID_PRODUIT,CUNIQUE:CUNIQUE,QUANTITE:QUANTITE},
                                                                                  
                            success:function(stutus)
                                                    { 
                                                     
  $("#load").hide();

                                                      $("#BARCODE").val('');
                                                      
  document.getElementById("BARCODE").focus();
                                                      var resp=stutus.split("|");

                                                      
                                                      $("#msg").html(resp[0]);
                                                      $("#produits").html(resp[1]);

                                                      // console.log(stutus);//
                                                      // alert(stutus);
                                                      // $("#ID_ASSURANCE").html("<?=$ass?>");
   
                                                      $("#MONTANT_PAYE").val(resp[2]);
                                                      $("#MONTANT_TOTAL").val(resp[2]);
                                                      $("#stock").html(resp[3]);
                                                      $("#ID_TYPE_REMISE_CLIENT").val("");
                                                      $("#ID_CLIENT").html("<?=$cl?>");
                                                      $("#ID_TYPE_REMISE_ASS").val("");
                                                      $("#ID_ASSURANCE").html("<?=$ass?>");
                                                      console.log(resp[2]);//
                                                      if(resp[2]==0){
                                                      document.getElementById("submit_vente").disabled=true;
                                                      }else
                                                      document.getElementById("submit_vente").disabled=false;
                                                    }
        
                        });

}else alert("veuillez mettre la quantité");
}else {alert("veuillez choisir le produit");
// $("#ID_PRODUIT").val("");

}
});
          
    </script>

<script>
     $(document).on('dblclick',".change",function(){
        // alert();
        var id=$(this).attr("id");
        var id1=id.split("//");
        $("#input"+id1[0]).show();
        $("#input"+id1[0]).focus(); 

        



        $("#input"+id1[0]).focusout(function(){
          $("#load").show();
          if(!$("#input"+id1[0]).val())$("#input"+id1[0]).val(id1[1]);

               $("#input"+id1[0]).hide();
// console.log(id1[0],$("#input"+id1[0]).val());
                        $.ajax({
                            url:"<?php echo base_url() ?>vente/Vente_new/save_modif",
                            method:"POST",
                         // async:false,
                            data: {ID_PRODUIT:id1[0],CUNIQUE:id1[1],QUANTITE:$("#input"+id1[0]).val()},
                                                                                 
                            success:function(stutus)
                                                    { 
                                                     
  $("#load").hide();

                                                      $("#BARCODE").val('');
                                                      
  document.getElementById("BARCODE").focus();
                                                      var resp=stutus.split("|");

                                                      
                                                      $("#msg").html(resp[0]);
                                                      $("#produits").html(resp[1]);

                                                      // console.log(stutus);//
                                                      // alert(stutus);
                                                      
   
                                                      $("#MONTANT_PAYE").val(resp[2]);
                                                      $("#MONTANT_TOTAL").val(resp[2]);
                                                      $("#MONTANT_ASSURANCE").val(0);
                                                      $("#MONTANT_REMISE").val(0);
                                                      $("#ID_TYPE_REMISE_CLIENT").val("");
                                                      $("#ID_CLIENT").html("<?=$cl?>");
                                                      $("#ID_TYPE_REMISE_ASS").val("");
                                                      $("#ID_ASSURANCE").html("<?=$ass?>");
                                                      // console.log(stutus);//
                                                      if(resp[2]==0){
                                                      document.getElementById("submit_vente").disabled=true;
                                                      }else
                                                      document.getElementById("submit_vente").disabled=false;
                                                    }
        
  //                       });
           });

  });
  });

</script>

<script>
     $(document).on('click',".delete",function(){
        // alert();
        var id=$(this).attr("id");
        var id1=id.split("//");
            
            if (confirm("Voulez-vous vraiment suprimer") == true) {
              $("#load").show();

                 $.ajax({
                            url:"<?php echo base_url() ?>vente/Vente_new/delete_items",
                            method:"POST",
                         // async:false,
                            data: {ID_PRODUIT:id1[0],CUNIQUE:$("#CUNIQUE").val()},
                                                                                 
                            success:function(stutus)
                                                    { 
                                                     
  $("#load").hide();

                                                      $("#BARCODE").val('');
                                                      
  document.getElementById("BARCODE").focus();
                                                      var resp=stutus.split("|");

                                                      
                                                      $("#msg").html(resp[0]);
                                                      $("#produits").html(resp[1]);

                                                      // console.log(stutus);//
                                                      // alert(stutus);
                                                      
   
                                                      $("#MONTANT_PAYE").val(resp[2]);
                                                      $("#MONTANT_TOTAL").val(resp[2]);
                                                      $("#ID_TYPE_REMISE_CLIENT").val("");
                                                      $("#ID_CLIENT").html("<?=$cl?>");
                                                      $("#ID_TYPE_REMISE_ASS").val("");
                                                      $("#ID_ASSURANCE").html("<?=$ass?>");
                                                      // console.log(stutus);//
                                                      if(resp[2]==0){
                                                      document.getElementById("submit_vente").disabled=true;
                                                      }else
                                                      document.getElementById("submit_vente").disabled=false;

                                                    }
        
  //                       });
           });

            } 

     
      });

</script>

<script>
     $(document).on('dblclick',".change_pu",function(){
        // alert();
        var id=$(this).attr("id");
        var id1=id.split("//");
        $("#pu"+id1[1]).show();
        $("#inppuut"+id1[1]).focus(); 

        



        $("#pu"+id1[1]).focusout(function(){
          $("#load").show();
          if(!$("#pu"+id1[1]).val())$("#pu"+id1[1]).val(id1[2]);

               $("#pu"+id1[1]).hide();
// console.log(id1[0],$("#input"+id1[0]).val());
                        $.ajax({
                            url:"<?php echo base_url() ?>vente/Vente_new/save_modif_pu",
                            method:"POST",
                         // async:false,
                            data: {ID_PRODUIT:id1[1],CUNIQUE:id1[2],PRIX:$("#pu"+id1[1]).val()},
                                                                                 
                            success:function(stutus)
                                                    { 
                                                     
  $("#load").hide();

                                                      $("#BARCODE").val('');
                                                      
  document.getElementById("BARCODE").focus();
                                                      var resp=stutus.split("|");

                                                      
                                                      $("#msg").html(resp[0]);
                                                      $("#produits").html(resp[1]);

                                                      // console.log(stutus);//
                                                      // alert(stutus);
                                                      
   
                                                      $("#MONTANT_PAYE").val(resp[2]);
                                                      $("#MONTANT_TOTAL").val(resp[2]);
                                                      $("#ID_TYPE_REMISE_CLIENT").val("");
                                                      $("#ID_CLIENT").html("<?=$cl?>");
                                                      $("#ID_TYPE_REMISE_ASS").val("");
                                                      $("#ID_ASSURANCE").html("<?=$ass?>");
                                                      // console.log(stutus);//
                                                      if(resp[2]==0){
                                                      document.getElementById("submit_vente").disabled=true;
                                                      }else
                                                      document.getElementById("submit_vente").disabled=false;
                                                    }
        
  //                       });
           });

  });
  });

</script>