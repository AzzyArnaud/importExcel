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
    include 'includes/menu_stock_entree_ajustement.php';
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
          <form action="<?=base_url('requisition/Stock_entre_ajustement/save_nouveau')?>" method='POST'>
                  <div class="row">
                    <div class="form-group col-md-2">
                      <label >Date </label>
                      <input required type="date" class="form-control" id="DATE" name="DATE" />
                     
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-3">
                      <label for="">
                          Produit 
                        </label>
                    <select  class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_PRODUIT" id="ID_PRODUIT">
                              <option value="0">-</option>

                              <?php 
                              foreach ($prod as $key) {
                                // if ($key['NOMBRE'] > 0) {
                                  echo "<option value=".$key['ID_PRODUIT'].">".$key['NOM_PRODUIT']." </option>";
                                // }
                                
                              }

                               ?>
                    </select>QUANTITE EN STOCK: <span id="stock" style="color: red"></span>
                    </div>

                    
                    <div class="form-group col-md-3">
                      <label for="exampleInputEmail1">PRIX DE VENTE UNITAIRE</label>
                      <input  type="number"  min="0" class="form-control" id="PRIX_VENTE" name="PRIX_VENTE" />
                     
                    </div>
                    <div class="form-group col-md-2">
                      <label for="exampleInputEmail1">Quantité </label>
                      <input  type="number" min="0" class="form-control" id="QT" name="QT" />
                     
                    </div>
                    <div class="form-group col-md-1">
                        <label for=""> _ </label>
                        <a  class="btn btn-success btn-block" onclick="addElement()">+</a>
                     </div>
                     <div class="form-group col-md-12" id="RESULTAT">
                       
                     </div>
                    <div class="form-group col-md-12">
                      <label for="exampleInputEmail1" style="color: white">. </label>
                      <input  type="submit" class="form-control btn btn-success btn-block" id="submit" name="submit" value="Enregistrer" />
                     
                    </div>
                    
                    

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

<script type="text/javascript">
   $('.select').select2();
</script>
<script type="text/javascript">
  $(document).on('change','#ID_PRODUIT',function(event){


    var ID_PRODUIT=$("#ID_PRODUIT").val();

          
                 $.ajax({
                            url:"<?php echo base_url() ?>configuration/Produit/getProduitPrice1",
                            method:"POST",
                         // async:false,
                            data: {ID_PRODUIT:ID_PRODUIT},
                                                                                  
                            success:function(stutus)
                                                    { 
                                                      // alert(stutus);
                                                      var data=stutus.split("|");
                                                      $("#PRIX_VENTE").val(data[0]);
                                                      $("#stock").html(data[1]);
                                                    }
        
                        });


});
</script>
<script type="text/javascript">
   function addElement(){
    var ID_PRODUIT=$('#ID_PRODUIT').val();
        var PRIX_VENTE=$('#PRIX_VENTE').val();
        var QUANTITE=$('#QT').val();

         
if(ID_PRODUIT&&PRIX_VENTE&&QUANTITE){
        


          $.post('<?php echo base_url();?>requisition/Stock_entre_ajustement/add_cart',
                {
                ID_PRODUIT:ID_PRODUIT,
                PRIX_VENTE:PRIX_VENTE,
                QUANTITE:QUANTITE
                },
                function(data) 
                { 
                    // RESULTAT.innerHTML = data;  
                    $('#RESULTAT').html(data);

                    $('#ID_PRODUIT').val("");
                    $('#PRIX_VENTE').val(null);
                    $('#QT').val(null);   
                }
            ); 

         
}else{
  alert("verifier bien vos champs de saisie");
}
        
}
</script>
<script type="text/javascript">
  
  function remove_medicament(id) {
    var rowid=id;
    // alert(rowid);

    $.post('<?php echo base_url();?>requisition/Stock_entre_ajustement/remove_',
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