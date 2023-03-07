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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modification du mot de passe</h1>
          </div>





        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Modification du mot de passe</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            <form role="form" action="<?=base_url('Change_Pwd/changer')?>" enctype="multipart/form-data" method="POST">

                <div class="card-body">
                  <div class="form-group">
                    <label for="">Ancien mot de passe</label>
                   <input type="password" class="form-control" name="ACTUEL_PASSWORD" value="<?=set_value('ACTUEL_PASSWORD')?>" autofocus>
                             <div style="color: red">   <?php echo form_error('ACTUEL_PASSWORD');
                             echo $msg;

                              ?> </div>
                  </div>


                 <div class="form-group">
                    <label for="">Nouveau mot de passe</label>
              <input type="password" class="form-control" name="NEW_PASSWORD" value="<?=set_value('NEW_PASSWORD')?>" autofocus>
                             <div style="color: red">   <?php echo form_error('NEW_PASSWORD'); ?> </div>
                  </div>


                         <div class="form-group">
                    <label for="">Confirmer le nouveau mot de passe</label>
                <input type="password" class="form-control" name="PASSWORDCONFIRM" value="<?=set_value('PASSWORDCONFIRM')?>" autofocus>
                             <div style="color: red">   <?php echo form_error('PASSWORDCONFIRM'); ?> </div>
                  </div>

  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Modifier</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


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