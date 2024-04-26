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
    include 'includes/menu_facture.php';
    ?>

    <section class="content">

      <div class="card">
      <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Enregistrement Facture</h3>
              </div>
       <form role="form" id="formvente" enctype="multipart/form-data" method="POST">
        <!-- <form  method="POST" class="form-horizontal" accept-charset="utf-8" enctype="multipart/form-data"> -->
                <div class="card-body">
                  <div class="row">
                   <div class="form-group col-md-3">
                        <label for="DATE_FACTURE">
                          Date de facture 
                          <i class="text-danger"> *</i>
                        </label>
                    <input type="date" class="form-control" value="<?php echo date('Y-m-d')?>" name="DATE_FACTURE" id="DATE_FACTURE" value="<?=$info['DATE_FACTURE']?>">
                        <?php echo form_error('DATE_FACTURE', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-3">
                        <label for="ID_CLIENT">
                          Client
                          <i class="text-danger"> *</i>
                        </label>
                  <select class="form-control select select2-primary" data-dropdown-css-class="select2-primary" name="ID_CLIENT" id="ID_CLIENT" style="width: 100%;">
                    <option value=""> </option>
                    <?php
                          foreach ($categ as $key) {
                            ?>
                           <option value='<?=$key['ID_CLIENT']?>' <?php if($info['NUMERO_FACTURE']==$key['ID_CLIENT'])echo 'selected';?>><?=$key['RAISON']?></option>;
                           <?php
                          }
                          ?>
                  </select>
                        <font id="erID_CLIENT" color="red"></font>
                     </div>

                     <div class="form-group col-md-3">
                        <label for="NUMERO_FACTURE">
                          Nr de Facture
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="text" name="NUMERO_FACTURE" class="form-control" value="<?=$info['NUMERO_FACTURE']?>" id="NUMERO_FACTURE">
                        <font id="erNUMERO_FACTURE" color="red"></font>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="ID_CLIENT">
                          Envoie Automatique
                          <i class="text-danger"> *</i>
                        </label>
                  <select class="form-control select select2-primary" data-dropdown-css-class="select2-primary" name="AUTO_SEND" id="AUTO_SEND" style="width: 100%;">
                    <option value="0">NON </option>
                    <option value="1" selected>OUI </option>
                    
                  </select>
                        
                     </div>
                  </div>



                  <div class="row">

                  <div class="form-group col-md-2">
                    <label for="SELECT_OPTION">
                      Choisir l'option:
                      <i class="text-danger"> *</i>
                    </label>
                  <select class="form-control select select2-primary" data-dropdown-css-class="select2-primary" name="SELECT_OPTION" id="SELECT_OPTION_ID" style="width: 100%;">
                  <option value=""></option>
                  <option value="1">Vente Produit</option>
                  <option value="2">Service</option>
                  </select>
                  </div>

                    <div class="form-group col-md-2" id="PRODUIT_ID">
                      <label for="ID_PRODUIT">
                        Produit
                       <i class="text-danger"> *</i>
                      </label>
                    <select class="form-control select select2-primary" data-dropdown-css-class="select2-primary" name="ID_PRODUIT" id="ID_PRODUIT" style="width: 100%;">
                    <option value=""> </option>
                      <?php
                       foreach ($prods as $key) {
                        ?>
                    <option value='<?=$key['ID_PRODUIT']?>'><?=$key['NOM_PRODUIT']?></option>;
                      <?php
                       }
                      ?>
                    </select>
                      <?php echo form_error('ID_PRODUIT', '<div class="text-danger">', '</div>'); ?>
                    </div>
                 
                     <div class="col-md-3" id="DESIGNATION_ID">

                      <label for="DESIGNATION">Designation</label> 
                        <textarea name="DESIGNATION" id="DESIGNATION" class="form-control "></textarea>
                        
                        <?php echo form_error('DESIGNATION', '<div class="text-danger">', '</div>'); ?>
                     </div> 

                     <div class="form-group col-md-2">
                        <label for="PU">
                          Prix Unitaire
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="number" name="PU" value="" class="form-control" id="PU" step="0.001" >
                        <?php echo form_error('PU', '<div class="text-danger">', '</div>'); ?>
                     </div>

                     <div class="form-group col-md-2">
                        <label for="QT">
                          Quantite
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="number" name="QT" value="" class="form-control" id="QT" step="0.001">
                        <?php echo form_error('QT', '<div class="text-danger">', '</div>'); ?>
                     </div>
                     


                     <div class="form-group col-md-2">
                        <label for="PT">
                          Prix Total 
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="number" name="PT" value="" class="form-control" id="PT" step="0.001" readonly>
                        <?php echo form_error('PT', '<div class="text-danger">', '</div>'); ?>
                     </div>
                     <div class="form-group col-md-1">
                        <label for="" style="color:white;"> . </label>
                        <a  class="btn btn-primary btn-block" id="plus">+</a>
                     </div>
                    <div class="row col-md-12" style="margin-top:20px">
                      <div id="table_items" class="col-md-12">
                        <?php
                          $table="<table class='table table-bordered table-striped' style='width:100%'>
                                <tr>
                                        <th>DESIGNATION</th>
                                        <th>PRIX UNITAIRE</th>
                                        <th>QUANTITE</th>
                                        <th>PRIX TOTAL</th>
                                        <th></th>
                                      </tr>";

                                foreach ($this->cart->contents() as $infos){
                                if($infos['ID_PRODUIT']>0){
                                     $produit=$this->Model->getOne("saisie_produit",array('ID_PRODUIT'=>$infos['ID_PRODUIT']));
                                      $DESIGNATION=$produit['NOM_PRODUIT'];
                                  } else $DESIGNATION=$infos['design'];
                          $table.="<tr><td>".$DESIGNATION."</td><td>".$infos['price']."</td><td>".$infos['qty']."</td><td>".$infos['tot']."</td><td><a class='btn btn-danger delete' id='".$infos['rowid']."'   role='button'><i class='fa fa-minus-circle' aria-hidden='true'></i> Enlever </a></td'</tr>";

                                }

                                $table.="<tr><td colspan='3'>MONTANT HTVA</td><td>".$this->cart->total()."</td><td></td'</tr>";
                                $tva=round($this->cart->total()*18/100);
                                $tvac=$this->cart->total()+$tva;

                                $table.="<tr><td colspan='3'>TVA</td><td>".$tva."</td><td></td'</tr>";
                                $table.="<tr><td colspan='3'>MONATANT TVAC</td><td>".$tvac."</td><td></td'</tr>";

                                $table.="</table>";

                                echo $table;
                        ?>
                      </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="PU">
                          MONTANT EN LETTRE
                          <i class="text-danger"> *</i>
                        </label>
                        <textarea id="MONTANT_LETTRE" name="MONTANT_LETTRE" class="form-control"><?=$info['MONTANT_LETTRE']?></textarea>
                        <?php echo form_error('MONTANT_LETTRE', '<div class="text-danger">', '</div>'); ?>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="QT">
                          QUI SIGNE?
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="text" name="QUI_SIGNE" value="" class="form-control" id="QUI_SIGNE" step="0.001" value="<?=$info['QUI_SIGNE']?>">
                         <font id="erQUI_SIGNE" color="red"></font>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="QT">
                          SON TITRE?
                          <i class="text-danger"> *</i>
                        </label>
                        <input type="text" name="SON_TITRE" value="" class="form-control" id="SON_TITRE" step="0.001" value="<?=$info['SON_TITRE']?>">
                        <font id="erSON_TITRE" color="red"></font>
                     </div>
                    <div class="card-footer col-md-12">
                      <button type="button" onclick="submitformula()" class="btn btn-primary btn-block">Enregistrer</button>
                    </div>

               <!--  <div class="card-footer col-md-12">
                  <span id="load1" class="loader1"></span>
                  <button type="button" id="submit_vente" class="btn btn-primary btn-block" onclick="submitvente()">Enregistrer</button>
                </div> -->
                </div>
              </div>
            </form>
                
<?php
 include VIEWPATH.'includes/new_copy_footer.php';  
  ?>
</body>
 
  <?php
  include VIEWPATH.'includes/new_script.php';
  ?>
</html>
<script src="<?php echo base_url() ?>assets/js/index.js"></script>
<script type="text/javascript">
  var number_to_lett=NumberToLetter(<?=$tvac?>);
  $("#MONTANT_LETTRE").html('Nous disons '+number_to_lett);
                                          
</script>
<script>
  $("#PRODUIT_ID").hide();
  $("#DESIGNATION_ID").hide();

  $("#SELECT_OPTION_ID").on('change',function(){
    var SELECT_OPTION = $('#SELECT_OPTION_ID').val();
    var ID_PRODUIT = $('#ID_PRODUIT').val();
    var DESIGNATION = $('#DESIGNATION').val();

    // alert(ID_PRODUIT);

  if(SELECT_OPTION == 0){
    $("#PRODUIT_ID").hide();
    $("#DESIGNATION_ID").hide();
  }
  if(SELECT_OPTION == 1){
    $("#PRODUIT_ID").show();
    $("#DESIGNATION_ID").hide();
  }
  if(SELECT_OPTION == 2){
    $("#PRODUIT_ID").hide();
    $("#DESIGNATION_ID").show();
  }

})
</script>
<script>
    function submitformula(){
 
    var DATE_FACTURE= $('#DATE_FACTURE').val();
    var ID_CLIENT= $('#ID_CLIENT').val();
    var NUMERO_FACTURE= $('#NUMERO_FACTURE').val();
    var AUTO_SEND= $("#AUTO_SEND").val();
    var MONTANT_LETTRE= $("#MONTANT_LETTRE").val();
    var QUI_SIGNE= $("#QUI_SIGNE").val();
    var SON_TITRE= $("#SON_TITRE").val();
    var i=0;

     $('#erID_CLIENT').html('');
     $('#erNUMERO_FACTURE').html('');
     $('#erQUI_SIGNE').html('');
     $('#erSON_TITRE').html('');
     if (QUI_SIGNE == '') {
      $('#erQUI_SIGNE').html('Le champ est obligatoire');
      i=1;
    } 
    if (SON_TITRE == '') {
      $('#erSON_TITRE').html('Le champ est obligatoire');
      i=1;
    } 
    if (ID_CLIENT == '') {
      $('#erID_CLIENT').html('Le champ est obligatoire');
      i=1;
    } 
    if (NUMERO_FACTURE == '') {
      $('#erNUMERO_FACTURE').html('Le champ est obligatoire');
      i=1;
    }
    if(i==0) {
      $.post('<?php echo base_url('facturer/Facture/save_facture')?>',
      {
        DATE_FACTURE:DATE_FACTURE,
        ID_CLIENT:ID_CLIENT,
        NUMERO_FACTURE:NUMERO_FACTURE,
        AUTO_SEND:AUTO_SEND,
        MONTANT_LETTRE:MONTANT_LETTRE,
        QUI_SIGNE:QUI_SIGNE,
        SON_TITRE:SON_TITRE,
      },

      function(data){
        $('#ID_PRODUIT').val('');
        $('#DESIGNATION').val('');
        $('#PU').val('');
        $('#QT').val('');
        $('#PT').val('');
        $('#QUI_SIGNE').val('');
        $('#SON_TITRE').val('');
        
        window.location.replace("<?=base_url()?>facturer/Facture/viewing");
      });
      
      

    }
}
</script>
<script type="text/javascript">

  $(document).on('keyup','#PU',function(event){
    // alert();
    var PU=$("#PU").val();
    var QT=$("#QT").val();

    var tot=PU*QT;
    $("#PT").val(tot);

  })
  $(document).on('keyup','#QT',function(event){
    var PU=$("#PU").val();
    var QT=$("#QT").val();

    var tot=PU*QT;
    $("#PT").val(tot);

  })
</script>

<script type="text/javascript">
  $('#reservation').daterangepicker({

  locale: {
    format: 'DD/MM/YYYY'
  }
})
$('.select').select2();
</script>
<script type="text/javascript">
  $(document).on('click','#plus',function(event){
var ID_CLIENT=$("#ID_CLIENT").val();
var DESIGNATION=$("#DESIGNATION").val();
var ID_PRODUIT=$("#ID_PRODUIT").val();
var PU=$("#PU").val();
var QT=$("#QT").val();
var PT=$("#PT").val();
var SELECT_OPTION=$("#SELECT_OPTION_ID").val();
var i=0;

// console.log(ID_CLIENT);

if(SELECT_OPTION == 0){

if(!ID_CLIENT){
  alert("VEULLEZ ENTRER LE CLIENT");
  $("#ID_CLIENT").focus();
  return;
  i=1;
}
if(!SELECT_OPTION){
  alert("VEULLEZ SELECTIONER L'OPTION D'ABORD");
  $("#SELECT_OPTION_ID").focus();
  return;
  i=1;
}
if(!PU){
  alert("VEULLEZ ENTRER LE PRIX UNITAIRE");
   $("#PU").focus();
  return;
  i=1;
}
if(!QT){
  alert("VEULLEZ ENTRER LA QUANTITE");
   $("#QT").focus();
  return;
  i=1;
}
}


if(SELECT_OPTION == 1){

if(!ID_CLIENT){
  alert("VEULLEZ ENTRER LE CLIENT");
  $("#ID_CLIENT").focus();
  return;
  i=1;
}
if(!ID_PRODUIT){
  alert("VEULLEZ ENTRER LE PRODUIT");
  $("#ID_PRODUIT").focus();
  return;
  i=1;
}
if(!PU){
  alert("VEULLEZ ENTRER LE PRIX UNITAIRE");
   $("#PU").focus();
  return;
  i=1;
}
if(!QT){
  alert("VEULLEZ ENTRER LA QUANTITE");
   $("#QT").focus();
  return;
  i=1;
}
}


if(SELECT_OPTION == 2){

if(!ID_CLIENT){
  alert("VEULLEZ ENTRER LE CLIENT");
  $("#ID_CLIENT").focus();
  return;
  i=1;
}
if(!DESIGNATION){
  alert("VEULLEZ ENTRER LA DESIGNATION");
  $("#DESIGNATION").focus();
  return;
  i=1;
}
if(!PU){
  alert("VEULLEZ ENTRER LE PRIX UNITAIRE");
   $("#PU").focus();
  return;
  i=1;
}
if(!QT){
  alert("VEULLEZ ENTRER LA QUANTITE");
   $("#QT").focus();
  return;
  i=1;
}
} 


if(i==0){

      $.ajax({
              url:"<?php echo base_url() ?>facturer/Facture_cart/insert_cart",
              method:"POST",
           // async:false,
              data: {ID_PRODUIT:ID_PRODUIT,DESIGN:DESIGNATION,PRICE:PU,QTY:QT,TOT:PT},
                                                                   
              success:function(stutus)
                                      { 
                                        $("#load").hide();
                                        var prod ="<option value=''></option>";
                                        var descr ="";
                                        var donne=stutus.split("||");
                                        $("#table_items").html(donne[0]);

                                        var total=parseInt(donne[1]);
                                        // alert(stutus); 

                                        if(donne[0]!="<div class='alert alert-danger'>ECHEC! VERIFIER BIEN LES QUATITES ET LES MONTANTS</div>"){
                                          
                                          $("#ID_PRODUIT").val('');
                                          $("#DESIGNATION").val('');
                                          $("#PU").val('');
                                          $("#QT").val('');
                                          $("#PT").val('');
                                          var number_to_lett=NumberToLetter(total);
                                          $("#MONTANT_LETTRE").html('Nous disons '+number_to_lett);
                                          

                                        }
                                          
                                        
                                      }

      });}
});
</script>
<script type="text/javascript">
  $(document).on('click','.delete',function(event){
var id=$(this).attr("id");

$.ajax({
              url:"<?php echo base_url() ?>facturer/Facture_cart/delete_item",
              method:"POST",
           // async:false,
              data: {ID_CLIENT:id},
                                                                   
              success:function(stutus)
                                      { 
                                       
                                        $("#load").hide();
                                        var donne=stutus.split("||");
                                        $("#table_items").html(donne[0]);

                                        var total=parseInt(donne[1]);
                                        // alert(stutus); 

                                        if(donne[0]!="<div class='alert alert-danger'>ECHEC! VERIFIER BIEN LES QUATITES ET LES MONTANTS</div>"){
                                          
                                          $("#ID_PRODUIT").val('');
                                          $("#DESIGNATION").val('');
                                          $("#PU").val('');
                                          $("#QT").val('');
                                          $("#PT").val('');
                                          var number_to_lett=NumberToLetter(total);
                                          $("#MONTANT_LETTRE").html('Nous disons '+number_to_lett);
                                          
                                      }
                                      }

      });
  })
</script>












<!-- 
<script type="text/javascript">
  function submitvente()getElementById {
    document.("submit_vente").disabled=true;
    $("#load1").show();
    var DATE_FACTURE= $('#DATE_FACTURE').val();
    var ID= $('#ID').val();

    var NUMERO_FACTURE= $('#NUMERO_FACTURE').val();
    var DESIGNATION= $('#DESIGNATION').val();
    var PU= $('#PU').val();
    var QT= $('#QT').val();
    var PT= $('#PT').val();
      
  $.ajax({

                            url:"<?php echo base_url() ?>facturer/Facture_cart/save_vente",
                            method:"POST",
                            data: {DATE_FACTURE:DATE_FACTURE,ID:ID,NUMERO_FACTURE:NUMERO_FACTURE,DESIGNATION:DESIGNATION,PU:PU,QT:QT,PT:PT},
                                                                                 
                            success:function(stutus)
                                                    { 
                                                     
  $("#load1").hide();
                                                      var resp=stutus.split("|");

                                                      $("#DESIGNATION").val(0);
                                                      $("#PU").val(0);
                                                      $("#QT").val(0);
                                                      $("#PT").val(0);
                                                    }
        
                        });
     
  }
</script>
 -->

<script>
   $(document).on('change','#ID_PRODUIT',function(event){
    var ID_PRODUIT=$("#ID_PRODUIT").val();

    $.ajax({
      url:"<?php echo base_url() ?>facturer/Facture/getProduit_Price",
      method:"POST",
         // async:false,
      data: {ID_PRODUIT:ID_PRODUIT},

      success:function(stutus)
      { 
        var data=stutus.split("|");
        $("#PU").val(data[0]);
      }

    });


  });
</script>