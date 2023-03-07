

<?php
  include VIEWPATH.'includes/new_header.php';
  ?>
<script type="text/javascript">
  function printDiv() 
{

  var divToPrint=document.getElementById('barcode');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write(
    '<html><link rel="stylesheet" href="<?php echo base_url() ?>dist/css/print.css"><body onload="window.print();">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();
 location.reload();
},5000);
  
 


}
</script>
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
                <h3 class="card-title"> G&eacute;nr&eacute;rer les codes bar</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <form action="<?=base_url('configuration/Barcode')?>" method='POST'>
                  <div class="row">
                    <div class="form-group col-lg-4">
                      <label for="exampleInputEmail1">Nombre<spam class="text-danger">*</spam> </label>
                      <input type="number" class="form-control" id="NOMBRE" name="NOMBRE" placeholder="NOMBRE" value="<?=$nombre?>">
                    </div>
                    <div class="form-group col-lg-1">
                      <label for="exampleInputEmail1"  style="color:white">.</label>
                      <button type="submit" class="btn btn-success">G&eacute;nr&eacute;rer</button>
                    </div>
                  </div>
                </form>
                <?php 
                if($nombre){ 
                 ?>
                
                      <div id="barcode" class="barcode" style="width: 100%;">
                        <center>
                        <!-- <div class=" " style=""> -->
                          <?php 
                          for ($i=0; $i < $nombre; $i++) {
                            if($i==0){
                              ?>
                          <div class="divp float-left" style="padding: 0px;margin: 0px">
                            <?php
                            }else{
                           ?>
                          <div class="divp float-left">
                            <?php
                            }
                           ?>
                            <span class="" style="width: 100%"> PHARMACIE St RAPHAEL</span>
                            <span class=""><img src="<?=base_url('barCode/').$principal.'-'.$i?>.png" alt="barcode" class="bcimg" /></span>
                            
                            <div class="space" style="text-align: left;">
                            <!-- <p style="margin-top: 0.1em; margin-bottom: 0em;"> -->
                            .<p style="margin-top: 0.2em; margin-bottom: 0em;">.
                            </div>
                            <!-- <div style="text-align: left;">
                            .
                            </div> -->
                            
                          </div>
                           
                          <!-- <div style="break-before:page"></div> -->
                          <!-- <br>
                          <br> -->
                          <?php 
                            }
                          ?>
                        <!-- </div> -->
                        </center>
                      </div>
                      <button onclick="printDiv();;" class="btn btn-success  btn-block"><i class="icon fa fa-print"></i> Imprimer</button>
                

                <?php 
                }
                 ?>

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
