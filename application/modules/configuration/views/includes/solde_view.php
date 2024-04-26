
<link rel="stylesheet" href="<?=base_url()?>styles/css.css">
  <?php
  include VIEWPATH.'includes/new_header.php';
  ?>


<body class="with-welcome-text">
  <div class="container-scroller">

  <?php
    include VIEWPATH.'includes/header.php';
  ?>

    <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    
    <?php
      include VIEWPATH.'includes/setting_color.php';
    ?>
        <!-- partial -->
        <!-- partial:partials/_sidebar.html -->


    <?php
      include VIEWPATH.'includes/new_menu_principal.php';
    ?>
     <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <div></div>
                  <div>
                    <div class="btn-wrapper">
                    <!-- <a id="button1" href="<?= base_url()?>configuration/Customer/add" class="btn btn-outline-primary"><i class="mdi mdi-account-plus"></i>Nouveau</a> -->
                    <a id="button2" href="<?= base_url()?>configuration/Solde/Listing" class="btn btn-outline-primary active"> <i class="mdi mdi-apps"></i>List</a>
                    <a id="button3" href="<?= base_url()?>configuration/Solde/index" class="btn btn-outline-primary  me-0"><i class="icon-download"></i>Import</a>
                   </div>
                  </div>
                </div>
                
             </div>
              </div>
            </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="row">
                  <div class="col-md-12">
                  <section class="content-header overflow-auto" style="height: 90%;">
                  <div class="container-fluid">
                    <div class="row mb-2">
                    <section class="content mt-3">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-12">
                          
            <!-- /.card -->

            <?php 
                          if(!empty($this->session->flashdata('message')))
                             echo $this->session->flashdata('message');
            ?>

                <div class="card card-success">
                  <div class="card-header bg-primary">
                    <h3 class="card-title text-center text-light">Liste des Clients Qui ont d&eacute;j&agrave; Payer Solde</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                      <table id="customer" class="table table-bordered table-striped responsive table-hover display nowrap" cellspacing="0" style="height:30vh;">
                   <thead>
                      <tr>
                        <th>Nom & Prenom</th>
                        <th>Province</th>
                        <th>Commune</th>
                        <th>Zone</th>
                        <th>Colline</th>
                        <th>Institution</th>
                        <th>UREE</th>
                        <th>DAP</th>
                        <th>KCL</th>
                        <th>DOLOMI</th>
                        <th>Solde</th>
                      </tr>
                      </thead>
                      <tbody>

                      <?php
                        foreach ($resultat as $key) 

                        {
													$detail = $this->Model->getList("collecte_detail",array(
														"COLLECTE_ID"=>$key["COLLECTE_ID"]
													));
												
                          
                        echo "<tr>
                        <td>".$key['CUSTOMER_NAME']."</td>
                        <td>".$key['PROVINCE']."</td>
                        <td>".$key['COMMUNE']."</td>
                        <td>".$key['ZONE']."</td>
                        <td>".$key['COLLINE']."</td>
                        <td>".$key['INSTITUTION']."</td>
                        
                        ";
												$key_UREE = array_search('1', array_column($detail, 'ID_PRODUCT'));
												$key_DAP = array_search('2', array_column($detail, 'ID_PRODUCT'));
												$key_KCL = array_search('3', array_column($detail, 'ID_PRODUCT'));
												$key_DOLOMI = array_search('4', array_column($detail, 'ID_PRODUCT'));
												// print_r(	$detail);
												// echo "<br>";
												// print_r(	$detail);
												
												// echo strlen($key_UREE);
											if(strlen($key_UREE)>0)
                      echo "<td>".$detail[$key_UREE]['QUANTITE']."</td>";
											else
                      echo "<td></td>";
											if(strlen($key_DAP)>0)
                      echo "<td>".$detail[$key_DAP]['QUANTITE']."</td>";
											else
                      echo "<td></td>";
											if(strlen($key_KCL)>0)
                      echo "<td>".$detail[$key_KCL]['QUANTITE']."</td>";
											else
                      echo "<td></td>";
											if(strlen($key_DOLOMI)>0)
                      echo "<td>".$detail[$key_DOLOMI]['QUANTITE']."</td>";
											else
                      echo "<td></td>";

                      echo "<td>".$key['MONTANT']."</td>";
                      
                      // $tabledata[]=$chambr;
                    }
                    ?>
              </tfoot>
         </table>
                      </div>
                    </div>
                  </div>
                  <div class="card-body table-responsive">
         
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>

            </div>
            <!-- /.row -->
            <footer class="footer" style="position:fixed;buttom:0">
<div class="d-sm-flex justify-content-center justify-content-sm-between">
<span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a
href="<?= base_url()?>configuration/Customer" target="_blank">pnseb</a> from Burundi.</span>
<span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 202. All rights reserved.</span>
</div>
</footer>
          </div>
          <!-- /.container-fluid -->
        </div>
 
        </section>
                  </div>
                </div>
              </div>
            </div>
          


    
  <?php
  include VIEWPATH.'includes/new_script.php';
  ?>
  <script>
 
$(document).ready(function() {
    $('#customer').DataTable({
        responsive: true
    });
});
</script>

<?php
  include VIEWPATH.'includes/js_site.php';
  ?>
<script src="<?=base_url()?>styles/script.js"></script>

 
</body>

</html>
