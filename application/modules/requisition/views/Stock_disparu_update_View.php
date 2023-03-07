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
          <form action="<?=base_url('requisition/Stock_disparu/save_modifier/'.$disp['ID_STOCK_DISPARU'])?>" method='POST'>
                  <div class="row">
                    <div class="form-group col-md-3">
          <label for="">
                          Produit 
                        </label>
                    <select required class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_PRODUIT" id="ID_PRODUIT">
                              <option value=""> </option>

                              <?php 
                              foreach ($prod as $key) {
                                // if ($key['NOMBRE'] > 0) {
                                ?>
                                  <option value="<?=$key['ID_PRODUIT']?> " <?php if($disp['ID_PRODUIT']==$key['ID_PRODUIT']) echo'selected';?> ><?=$key['NOM_PRODUIT']?> </option>";
                               <?php  // }
                                
                              }

                              ?>
                    </select>
                </div>

                    <div class="form-group col-md-3">
                      <label for="exampleInputEmail1">Quantité </label>
                      <input required type="number" class="form-control" id="QT" name="QT" value="<?=$disp['QUANTITE']?>" />
                     
                    </div>
                    <div class="form-group col-md-3">
                      <label for="exampleInputEmail1">PRIX DE VENTE UNITAIRE</label>
                      <input required type="number" class="form-control" id="PRIX_VENTE" name="PRIX_VENTE" value="<?=$disp['PRIX_VENTE']?>"/>
                     
                    </div>
                    <div class="form-group col-md-3">
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
