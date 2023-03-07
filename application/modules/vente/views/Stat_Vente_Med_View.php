

<?php
  include VIEWPATH.'includes/new_header.php';
  ?>

<div class="wrapper">
  
  <?php
  include VIEWPATH.'includes/new_top_menu.php';
  include VIEWPATH.'includes/new_menu_principal.php';
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <?php 
    // include 'includes/menu_user.php';
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card card-success" style="margin-top: 15px">
              <div class="card-header">
                <h3 class="card-title"> Rapport Vente</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">

              <form action="<?=base_url('vente/Stat_Vente_Med')?>" method='POST' id="myform">
                  <div class="row">
                    <div class="form-group col-lg-3">
                      <label for="exampleInputEmail1">DU<spam class="text-danger">*</spam> </label>
                      <input type="date" class="form-control" name="DATE" onchange="change();" value="<?=$DATE?>"/>
                      
                    </div>
                    <div class="form-group col-lg-3">
                      <label for="exampleInputEmail1">AU<spam class="text-danger">*</spam> </label>
                      <input type="date" class="form-control" name="DATE1" onchange="change();" value="<?=$DATE1?>"/>
                      
                    </div>
                    <div class="form-group col-lg-2">
                      <label for="exampleInputEmail1">Type</label>
                        <select class="form-control" name="TYPES" onchange="change();">
                          <option value="1" <?php if ($TYPES == 1) {echo 'selected';} ?>>Bon</option>
                          <option value="2" <?php if ($TYPES == 2) {echo 'selected';} ?>>Mauvais</option>
                        </select>
                    </div>
                    <div class="form-group col-lg-2">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="numbers" class="form-control" name="NOMBRE" onblur="change();" value="<?=$NOMBRE?>"/>
                    </div>
                    <div class="form-group col-lg-2">
                      <label for="exampleInputEmail1">Nombre/BIF</label>
                      <select class="form-control" name="BIF_NOMBRE" onchange="change();">
                          <option value="1" <?php if ($BIF_NOMBRE == 1) {echo 'selected';} ?>>Nombre</option>
                          <option value="2" <?php if ($BIF_NOMBRE == 2) {echo 'selected';} ?>>BIF</option>
                        </select>
                    </div>
                  </div>
                </form>

                <div class="row">
                    <div class="col-md-12" style="border: 1px dotted #CCC;">
                        <h5 style='color:red'>Vente par produits</h5>
                        <div id="container0" style="width: 100%;"></div>
                    </div>
                </div>


                <div class="row">
                  
                  <div class="col-md-12" style="border: 1px dotted #CCC;">
                    <h5 style='color:red'>Repartition par selection. La partie bleu represent les selection faites</h5>
                    <div id="container" style="width: 100%;"></div>
                  </div>
                </div>
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


</body>
</html>

<script type="text/javascript">

  Highcharts.chart('container0', {
    chart: {
        type: 'column'
    },
    title: {
        text: ' '
    },
    xAxis: {
        categories: [<?php echo $categories1;?>],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: ''
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} <?php echo $mes;?></b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: '<?php echo $types?>',
        data: [<?php echo $nombres;?>]

    }]
});

</script>


<script type="text/javascript">
  // Data retrieved from https://netmarketshare.com/
// Build the chart
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: ' ',
        align: 'left'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Partie',
        colorByPoint: true,
        data: [{
            name: 'Sélectionné (<?php echo $tot_select?> <?php echo $mes;?>)',
            y: <?php echo $tot_select?>,
            sliced: true,
            selected: true
        }, {
            name: 'Pas Sélectionné (<?php echo $not_select?> <?php echo $mes;?>)',
            y: <?php echo $not_select?>
        }]
    }]
});
              
</script>




<script>


         function change() {
       
       myform.action= myform.action;
        myform.submit();
      } 
  

</script>