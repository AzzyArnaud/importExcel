

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

              <form action="<?=base_url('configuration/Barcode')?>" method='POST'>
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="exampleInputEmail1">DATE<spam class="text-danger">*</spam> </label>
                      <input type="date" class="form-control" id="DATE" onchange="change(event);" value="<?=$date1?>"/>
                      <!-- <div class="input-group date" id="DATE" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#DATE" onchange="alert();"/>
                        <div class="input-group-append" data-target="#DATE" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div> -->
                    </div>
                    <div class="form-group col-lg-1">
                      <label for="exampleInputEmail1" style="color:white">.</label>
                      <!-- <button type="submit" class="btn btn-success">G&eacute;nr&eacute;rer</button> -->
                    </div>
                  </div>
                </form>


                <div class="row">
                  <div class="col-md-12" style="border: 1px dotted #CCC;">
                    <h5 style='color:red'>Vente par utilisateur</h5>
                    <div id="container0" style="width: 100%;"></div>
                  </div>
                  <div class="col-md-6" style="border: 1px dotted #CCC;">
                    <h5 style='color:red'>Rapport Vente</h5>
                    <div id="container" style="width: 100%; height: <?=$nombre?>px"></div>
                  </div>
                  <div class="col-md-6" style="border: 1px dotted #CCC;">
                    <h5 style="color:red">Rapport Assurences</h5>
                    <div id="container1" style="width: 100%; height: <?=$num_pro?>px"></div>
                    
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
        align: 'left',
        text: ''
    },
    subtitle: {
        align: 'left',
        text: ''
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Montant'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f} '
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} pce(s)</b><br/>'
    },
credits: {
        enabled: false
    },
    series: [
        {
            name: "Produit",
            colorByPoint: true,
            data: [
            <?=$infos?>
            ]
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: [
            
        ]
    }
});
              




</script>
<script type="text/javascript">

  Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: '<br>Quantité Total :<b><?=number_format($qt_t, 0, '', ' ')?> pces</b><br>Montant utilisé :<b><?=number_format($montant_t, 0, '', ' ')?> BIF</b>'
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
            text: 'Quantité (pièces)',
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
    //     {
    //     name: 'Requisition Montant',
    //     data: [<?=$requisition_m?>]
    // }, 
    {
        name: 'Requisition Quantité',
        data: [<?=$requisition_q?>]
    }, {
        name: 'Quantité entrée en stock',
        data: [<?=$q_entre?>]
    }, {
        name: 'Quantité non-entrée',
        data: [<?=$q_n_entre?>]
    }]
});

</script>


<script type="text/javascript">
  Highcharts.chart('container1', {
    chart: {
        type: 'bar'
    },
    title: {
        align: 'left',
        text: ''
    },
    subtitle: {
        align: 'left',
        text: ''
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Quantité'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f} pce(s)'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} pce(s)</b><br/>'
    },
credits: {
        enabled: false
    },
    series: [
        {
            name: "Produit",
            colorByPoint: true,
            data: [
            <?=$infos?>
            ]
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: [
            
        ]
    }
});
              




</script>
<script>
    
// $('#DATE').datetimepicker({
//         format: 'DD/MM/YYYY'
//     });


    function change(date){
// alert(date.vqli);
// console.log($('#DATE').val());
window.location.replace("<?=base_url()?>requisition/Rapport_requisition/index/"+$('#DATE').val());

    }

</script>