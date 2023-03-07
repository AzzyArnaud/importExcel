<?php
  include VIEWPATH.'includes/new_header.php';
  ?>
  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo $nouveau_url ?>plugins/fullcalendar/main.css">

  
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
            <h1>Acceuil</h1>
          </div>
          <div class="col-sm-6">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      
      <!-- Default box -->
      <div class="card">
        
        <div class="card-body">
          
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
<script src="<?php echo $nouveau_url ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->

<!-- fullCalendar 2.2.5 -->

<script src="<?php echo $nouveau_url ?>plugins/fullcalendar/main.js"></script>
<script src='<?php echo $nouveau_url ?>plugins/fullcalendar/locales/fr.js'></script>


<script src="<?php echo $nouveau_url ?>higthchart/code/highcharts.js"></script>
<script src="<?php echo $nouveau_url ?>higthchart/code/modules/sankey.js"></script>
<script src="<?php echo $nouveau_url ?>higthchart/code/modules/organization.js"></script>
<script src="<?php echo $nouveau_url ?>higthchart/code/modules/exporting.js"></script>
<script src="<?php echo $nouveau_url ?>higthchart/code/modules/accessibility.js"></script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="../dist/js/demo.js"></script> -->

<!--  -->
  <script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');


    var calendar = new Calendar(calendarEl, {
      headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
  
      },
      themeSystem: 'bootstrap',
      locale: 'fr',
      default: 1,
      //Random default events
      events: [
      <?php 
        foreach ($conge_non_ponctuelle as $non_ponctuelle) {
          $TNON_PONCTUEL = str_replace("'","\'",$non_ponctuelle['NOM_JOURS_FERIER']);
          $YNON_PONCTUEL = date("Y", strtotime($non_ponctuelle['DATE_FERIER']));
          $MNON_PONCTUEL = date("m", strtotime($non_ponctuelle['DATE_FERIER']));
          $MNON_PONCTUEL = $MNON_PONCTUEL -1;
          $DNON_PONCTUEL = date("d", strtotime($non_ponctuelle['DATE_FERIER']));
          echo "
          {
          title          : '".$TNON_PONCTUEL."',
          start          : new Date(".$YNON_PONCTUEL.", ".$MNON_PONCTUEL.", ".$DNON_PONCTUEL."),
          backgroundColor: '#00c0ef', //info
          borderColor    : '#00c0ef', //info
          allDay         : true
        },
          ";
        }
      ?>


      <?php 
        foreach ($conge_ponctuelle as $ponctuelle) {
          $T_PONCTUEL = str_replace("'","\'",$ponctuelle['NOM_JOURS_FERIER']);
          $Y_PONCTUEL = date("Y", strtotime($ponctuelle['DATE_FERIER']));
          $M_PONCTUEL = date("m", strtotime($ponctuelle['DATE_FERIER']));
          $M_PONCTUEL = $M_PONCTUEL -1;
          $D_PONCTUEL = date("d", strtotime($ponctuelle['DATE_FERIER']));
          echo "
          {
          title          : '".$T_PONCTUEL."',
          start          : new Date(".$Y_PONCTUEL.", ".$M_PONCTUEL.", ".$D_PONCTUEL."),
          backgroundColor: '#0073b7', //Blue
          borderColor    : '#0073b7', //Blue
          allDay         : true
        },
          ";
        }
      ?>
      
      
       <?php 
        foreach ($my_conge as $mconge) {
          $TM_PONCTUEL = str_replace("'","\'",$mconge['NOM_CONGE']);
          $SYM_PONCTUEL = date("Y", strtotime($mconge['DATE_DEBUT_CONGE_ACCORDE']));
          $SMM_PONCTUEL = date("m", strtotime($mconge['DATE_DEBUT_CONGE_ACCORDE']));
          $SMM_PONCTUEL = $SMM_PONCTUEL -1;
          $SDM_PONCTUEL = date("d", strtotime($mconge['DATE_DEBUT_CONGE_ACCORDE']));
          // $SDM_PONCTUEL = $SDM_PONCTUEL +1;

          $EYM_PONCTUEL = date("Y", strtotime($mconge['DATE_FIN_CONGE_ACCORDE']));
          $EMM_PONCTUEL = date("m", strtotime($mconge['DATE_FIN_CONGE_ACCORDE']));
          $EMM_PONCTUEL = $EMM_PONCTUEL-1;
          $EDM_PONCTUEL = date("d", strtotime($mconge['DATE_FIN_CONGE_ACCORDE']));
          $EDM_PONCTUEL = $EDM_PONCTUEL +1;
          echo "
          {
          title          : '".$TM_PONCTUEL."',
          start          : new Date(".$SYM_PONCTUEL.", ".$SMM_PONCTUEL.", ".$SDM_PONCTUEL."),
          end          : new Date(".$EYM_PONCTUEL.", ".$EMM_PONCTUEL.", ".$EDM_PONCTUEL."),
          backgroundColor: '#00a65a', //Success (green)
          borderColor    : '#00a65a', //Success (green)
          allDay         : true
        },
          ";
        }
      ?>
      // { 
      //   title : 'Congé de repos annuel', 
      //   start : new Date(2022, 5, 6), 
      //   end : new Date(2022, 5, 11), 
      //   backgroundColor: '#00a65a', //Success (green) 
      //   borderColor : '#00a65a', //Success (green) 
      //   allDay : true 
      // },

      ],

    });

    calendar.render();
   

  })
</script>
<script type="text/javascript">
  Highcharts.chart('container1', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'Evolution des demandes dans cet exercice '
    },
    // subtitle: {
    //     text: '12 derniers mois'
    // },
    xAxis: {
        categories: [<?php echo $base?>]
    },
    yAxis: {
        title: {
            text: ' '
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Nb demandes',
        data: [<?php echo $nb_demande?>]
    }, {
        name: 'Nb jours',
        data: [<?php echo $nb_jours?>]
    }]
});
</script>

<script type="text/javascript">
  Highcharts.chart('container2', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Jours Prise VS Jours Non Prise'
    },
    xAxis: {
        categories: [<?php echo $basedeux;?>]
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total fruit consumption'
        }
    },
    tooltip: {
        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
        shared: true
    },
    plotOptions: {
        column: {
            stacking: 'percent'
        }
    },
    series: [{
        name: 'Jours Prise',
        data: [<?php echo $nb_jours_prise; ?>]
    }, {
        name: 'Jours non prise',
        data: [<?php echo $nb_jours_n_prise; ?>]
    }]
});
</script>

<script type="text/javascript">
  // Make monochrome colors
var pieColors = (function () {
    var colors = [],
        base = Highcharts.getOptions().colors[0],
        i;

    for (i = 0; i < 10; i += 1) {
        // Start out with a darkened base color (negative brighten), and end
        // up with a much brighter color
        colors.push(Highcharts.color(base).brighten((i - 3) / 7).get());
    }
    return colors;
}());

// Build the chart
Highcharts.chart('container3', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Type de conge'
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
            colors: pieColors,
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
                distance: -50,
                filter: {
                    property: 'percentage',
                    operator: '>',
                    value: 4
                }
            }
        }
    },
    series: [{
        name: '',
        data: [<?php echo $basetrois; ?>
            
        ]
    }]
});
</script>
</body>
</html>
