<?php
  include VIEWPATH.'includes/new_header.php';
  ?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  
  <?php
  include VIEWPATH.'includes/new_top_menu.php';
  include VIEWPATH.'includes/new_menu_principal.php';
  ?>

 


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
                <h3 class="card-title">Bar code & Stock</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- class="form-inline" -->
<?php 
                          if(!empty($this->session->flashdata('message')))
                             echo $this->session->flashdata('message');
            ?>

            
    <div class="row">
      <div class="col-md-12 row">
      <div class="form-group col-md-12">
        <form role="form" action="<?=base_url('View_Stock')?>" enctype="multipart/form-data" method="POST">  
          <label for="BARCODE">
                          Scan BarCode
                        </label> 
          <input type="text" class="form-control" value="" name="BARCODE" id="BARCODE" autofocus>
                        <?php echo form_error('BARCODE', '<div class="text-danger">', '</div>'); ?>

      </form>
    </div>

    <div class="form-group col-md-12">
        <?php echo $resultat?>
    </div>



      </div>
      <div class="col-md-12 form-group ">

        <table id="example1" class="table table-bordered table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nom Produit</th>
                <th>Quantite</th>
                <th>PU Vente</th>
                <th>PT Vente</th>
            </tr>
        </thead>
        <tbody>
          <?php

          $resultat=$this->Model->getRequete('SELECT saisie_produit.NOM_PRODUIT, QUANTITE, PRIX_VENTE, (QUANTITE * PRIX_VENTE) AS PRIX_TOTAL FROM `req_stock` JOIN saisie_produit ON saisie_produit.ID_PRODUIT = req_stock.ID_PRODUIT WHERE 1 AND req_stock.STATUS = 1');
         $tot = 0;
          foreach ($resultat as $key) 
         {
              
          echo "<tr>
                <td>".$key['NOM_PRODUIT']."</td>
                <td><div class='text-right'>".number_format($key['QUANTITE'], 0,',',' ')."</div></td> 
                <td><div class='text-right'>".number_format($key['PRIX_VENTE'], 0,',',' ')."</div></td> 
                <td><div class='text-right'>".number_format($key['PRIX_TOTAL'], 0,',',' ')."</div></td>
                ";
         echo '</tr>';
         $tot += $key['PRIX_TOTAL'];

       }
          ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Valeurs total du stock</th>
                <th class="text-right"><?php echo number_format($tot, 0,',',' ')?></th>
            </tr>
        </tfoot>
    </table>
        
       

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
    // alert('aa');

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