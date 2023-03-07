

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
            
            

            <div class="card card-success" style="margin-top: 15px">
              <div class="card-header">
                <h3 class="card-title"> Rapport Vente</h3>
              </div>

              
              <div class="card-body">

              <form action="<?=base_url('configuration/Barcode')?>" method='POST'>
                  <div class="row">
                    <div class="form-group col-md-2">
                        <label for="">
                          Année 
                        </label>
                      <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ANNEE" id="ANNEE" onchange="change()">
                                <option value=""> </option>

                                <?php 
                                $an=date("Y")+1;
                                for ($i=2023; $i < $an; $i++) { 
                                    ?>
                                    <option value="<?=$i?>" <?php if($i==$annee) echo 'selected';?>><?=$i?> </option>

                                    <?php
                                }

                                ?>
                      </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="">
                          Mois 
                        </label>
                      <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="MOIS" id="MOIS" onchange="change()">
                                <option value="0"> </option>

                                <?php 
                                
                                for ($i=1; $i < 13; $i++) { 
                                    $m=$i;
                                    if($i<10)$m='0'.$i;
                                    ?>
                                    <option value="<?=$m?>" <?php if($m==$mois) echo 'selected';?>><?=$m?> </option>

                                    <?php
                                }

                                ?>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="">
                          Produit 
                        </label>
                      <select class="form-control select select2-success" data-dropdown-css-class="select2-success" name="ID_PRODUIT" id="ID_PRODUIT" onchange="change()">
                                <option value=""> </option>

                                <?php 
                                foreach ($prod as $key) {
                                    ?>
                                  <option value="<?=$key['ID_PRODUIT']?>" <?php if($key['ID_PRODUIT']==$pro) echo 'selected'; ?>><?=$key['NOM_PRODUIT']?> </option>";
                                 

                                 <?php
                                }

                                ?>
                      </select>
                    </div>
                  </div>
                </form>


                <div class="row">
                  <div class="col-md-12" style="border: 1px dotted #CCC;">
                    <h5 style='color:red'>Quantité vente dans le temps</h5>
                    <div id="container0" style="width: 100%;"></div>
                  </div>
                  
                  <div class="col-md-12" style="border: 1px dotted #CCC;">
                    <h5 style='color:red'>Montant vente dans le temps</h5>
                    <div id="container1" style="width: 100%;"></div>
                  </div>
                  <!-- <div class="col-md-6" style="border: 1px dotted #CCC;">
                    <h5 style='color:red'>Rapport Assurances</h5>
                    <div id="container" style="width: 100%; height: <?=$num_pro?>px"></div>
                  </div>
                  <div class="col-md-6" style="border: 1px dotted #CCC;">
                    <h5 style="color:red">Rapport Reductions</h5>
                    <div id="container1" style="width: 100%; height: <?=$num_pro?>px"></div>
                    
                  </div> -->
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
        text: '<span style="text-align:right">Quantité Totale :<b><?=number_format($qt_t, 0, '', ' ')?> </b></span>',
        align: 'right',
        y: 40, 
    x: -20,
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [<?=$products?>],
        title: {
            text: null
        }
    },
    yAxis: {

        min: 0,
        title: {
            text: 'Quantité',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ''
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        },
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                // rotation: -90,
                format: '{point.y:,.0f}'
            }
        }
    },
    legend: {
        align: 'center',
        verticalAlign: 'top',
        x: 0,
        y: 0
    },
    credits: {
        enabled: false
    },
    series: [
        {
        name: 'Quantité Total',
        data: [<?=$requisition_q?>]
    }]
});

</script>

<script type="text/javascript">

  Highcharts.chart('container1', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<span style="text-align:right">Montant Total :<b><?=number_format($montant_t, 0, '', ' ')?> BIF</b></span>',
        align: 'right',
        y: 40, 
    x: -20,
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [<?=$products?>],
        title: {
            text: null
        }
    },
    yAxis: {

        min: 0,
        title: {
            text: 'Montant',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ''
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        },
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                // rotation: -90,
                format: '{point.y:,.0f}'
            }
        }
    },
    legend: {
        align: 'center',
        verticalAlign: 'top',
        x: 0,
        y: 0
    },
    credits: {
        enabled: false
    },
    series: [
        {
        name: 'Montant Total',
        data: [<?=$requisition_m?>]
    }]
});

</script>


<script>
     $('.select').select2();
    
// $('#DATE').datetimepicker({
//         format: 'DD/MM/YYYY'
//     });


    function change(){

window.location.replace("<?=base_url()?>rapport/RAPPORT_PRODUIT_VENTE/index/"+$('#ANNEE').val()+"/"+$('#MOIS').val()+"/"+$('#ID_PRODUIT').val());

    }

</script>