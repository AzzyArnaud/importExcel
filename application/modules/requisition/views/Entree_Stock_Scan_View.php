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
    include 'includes/menu_entree_stock.php';
    ?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <!-- /.card -->

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Liste des produits a scanner</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- class="form-inline" -->
              <span id="msg"></span>
                <!-- <?php 
                          if(!empty($this->session->flashdata('message')))
                             echo $this->session->flashdata('message');
            ?> -->
                

<table class="table">
  <tr>
    <td>Produit</td>
    <td><?php echo $unique['NOM_PRODUIT'];?></td>
  </tr>
  <tr>
    <td>Achete le</td>
    <td><?php echo $unique['DATE_REQUISITION'];?></td>
  </tr>
   <tr>
    <td>Quantite Total</td>
    <td><?php echo $unique['QUANTITE']?></td>
  </tr>
  <tr>
    <td>Deja scann&eacute;</td>
    <td id="deja"><?php echo $deja_in_qr['NUMBER']?></td>
  </tr>
</table>

<?php 
$reste = $unique['QUANTITE'] - $deja_in_qr['NUMBER'];
if ($reste > 0) {
  // code...

?>


                <!-- <div class='modal fade' id='process' tabindex='-1' role='dialog' aria-labelledby='basicModal' aria-hidden='true'>
                     <div class='modal-dialog modal-sm'>
                       <div class='modal-content'>
                         
                         <div class='modal-body'>
                           <span class="loader"></span>
                           
                         </div>
                         
                       </div>
                     </div>
                   </div> -->

      <!-- <form  action="<?=base_url('requisition/Entree_Stock/save_scan')?>" enctype="multipart/form-data" > -->
        
        <input type="hidden" class="form-control" value="<?php echo $unique['ID_REQUISITION']?>" name="ID_REQUISITION" id="ID_REQUISITION">
        <input type="hidden" class="form-control" value="<?php echo $unique['ID_PRODUIT']?>" name="ID_PRODUIT" id="ID_PRODUIT">
        <input type="hidden" class="form-control" value="<?php echo $unique['PRIX_VENTE_UNITAIRE']?>" name="PRIX_VENTE" id="PRIX_VENTE">


        
        <div class="card-body row">
          <div class="form-group col-md-12" id="INPUT">
                        <label for="BARCODE">
                          Num BarCode
                          <i class="text-danger"> *</i><span id="load" class="loader"></span>
                        </label>
                    <input type="text" class="form-control" value="" name="BARCODE" id="BARCODE" autofocus>
                        <?php echo form_error('BARCODE', '<div class="text-danger">', '</div>'); ?>
                    
          </div>
        </div>
      <!-- </form> -->
      <?php
}
?>              </div>
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

  $('#reservation').daterangepicker({

        locale: {
        format: 'DD/MM/YYYY'
      }
    })
  $('.select').select2();

</script>



    <script>
      $(document).ready(function(){
  $("#load").hide();
      }
      );
         $(document).on('keyup','#BARCODE',function(event){
    // alert();

          // console.log(event.keyCode);

if (event.keyCode===13) {

  $("#load").show();

var BARCODE=$("#BARCODE").val();
    var ID_REQUISITION=$("#ID_REQUISITION").val();
    var ID_PRODUIT=$("#ID_PRODUIT").val();
    var PRIX_VENTE=$("#PRIX_VENTE").val();

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
                            url:"<?php echo base_url() ?>requisition/Entree_Stock_new/save_scan",
                            method:"POST",
                         // async:false,
                            data: {BARCODE:BARCODE,ID_REQUISITION:ID_REQUISITION,ID_PRODUIT:ID_PRODUIT,PRIX_VENTE:PRIX_VENTE},
                                                                                 
                            success:function(stutus)
                                                    { 
                                                     
  $("#load").hide();

                                                      $("#BARCODE").val('');
                                                      
  document.getElementById("BARCODE").focus();
                                                      var resp=stutus.split("|");

                                                      
                                                      $("#msg").html(resp[2]);
                                                      $("#deja").html(resp[0]);

                                                      if(resp[1]=='non'){
                                                          $("#INPUT").hide();
                                                      }else $("#INPUT").show();

                                                      // console.log(stutus);//
                                                      // alert(stutus);
                                                    }
        
                        });
                    

}else {
  $("#msg").html("<div class='alert alert-danger' role='alert'>CE BARCODE NE RESPECTE PAS NOTRE FORMAT</div>");
  $("#BARCODE").val('');
   $("#load").hide();
 document.getElementById("BARCODE").focus();
}

}

});
          
    </script>
</body>
</html>
