<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        
        <title>Administration</title>
        <?php
    meta_tags();
  ?>
        <!-- Ad CSS -->
        <?php
    $active1="";
    $active2="active";
    $active3="";
    $active4="";
    $active5="";
    $active6="";
    $active7="";
    $active8="";
    $active9="";
    $active10="";
    $active11="";

    ?>
        <?php
    
       include VIEWPATH.'includes/header.php';

    ?>
    </head>
    <body>
        
        <!--================Header Menu Area =================-->
        <?php
       include VIEWPATH.'includes/menu_principal.php';
        ?>
    <!-- <div class="container-fluid" style="border-top: 20px solid #B3001B;"> -->
<div id="presentation" class="container-fluid" >
 <!-- <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="container">
                    <div class="banner_content">
                        <h2>Administration  de BIJE</h2>
                        <div class="page_link">
                            <a href="<?=base_url();?>">Accueil</a>
                            <a class="" href="#">Administration</a>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

 <div class="row" style="margin-top: 10px">
           

                        <?php
                        foreach ($noeud as $value) {
                          ?>
                          <!-- AJOUT NOEUD -->

            <div class='modal fade' id='ajouter_noeud<?=$value['ID']?>' tabindex="-1">
                            <div class='modal-dialog  modal-lg'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  
                                  <h3 class="modal-title">Ajout</h3>
                                  <!-- <button class="close" data_dismiss="modal">&times;</button> -->
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>

                                <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
                          height:100%;
                          background-size:10px 10px;}">
                                 <form id="myform" action="<?= base_url('qui_sommes_nous/Administration/add_noeud') ?>" method="POST" enctype="multipart/form-data">
    

                                <div class="container-fluid row" >
                                         <div class="col-md-4 sm-12 xs-12 form-group">
                                           Appellation noeud:
                                        </div>
                                        <div class="col-md-8 sm-12 xs-12 form-group">
                                           
                                    <input type="hidden" name="mere" id="mere" value="<?=$value['ID']?>" class="form-control input-sm" autocomplete="off" required>     
                                    <input type="hidden" name="niveau" id="niveau" value="<?=$value['NIVEAU']+1?>" class="form-control input-sm" autocomplete="off" required>     
                                    <input type="text" name="appelation" id="appelation" class="form-control input-sm" autocomplete="off" required>     
                                        </div>
                                        
                                    </div>
                                  <!-- <div class="container-fluid row" >
                                         <div class="col-md-12 sm-12 xs-12 form-group">
                                            Responsable:
                                        </div>
                                        <div class="col-md-6 sm-12 xs-12 form-group">
                                           
                                    <input type="text" placeholder="Nom" name="nom" id="nom" class="form-control input-sm" autocomplete="off" required>     
                                        </div>
                                      <div class="col-md-6 sm-12 xs-12 form-group">
                                           
                                    <input type="text" placeholder="Prénom" name="prenom" id="prenom" class="form-control input-sm" autocomplete="off" required>     
                                        </div>
                                    
                                        
                                    </div>
                                    <div class="container-fluid row" >
                                         
                                        <div class="col-md-6 sm-12 xs-12 form-group">
                                           
                                    <input type="text" placeholder="Téléphone" name="tel" id="tel" class="form-control input-sm" autocomplete="off" required>     
                                        </div>
                                    
                                        <div class="col-md-6 sm-12 xs-12 form-group">
                                           
                                    <input type="text" placeholder="Email" name="email" id="email" class="form-control input-sm" autocomplete="off" required>     
                                        </div>
                                     
                                        <div class="col-md-1 sm-12 xs-12 form-group">
                                        foto</div>
                                        <div class="col-md-6 sm-12 xs-12 form-group">
                                    <input type="file" placeholder="foto" name="fotos" id="fotos" accept="image/*" class="form-control input-sm" autocomplete="off" required> 
                                       
                                        </div>
                                        
                                    </div> -->
                                    
                                    
                                   
                                    
                                        
                                    <div class="col-md-12 form-group" style="width: 100%">

                                        

                                            <input type="submit" name="submit" id="submit"  class="btn btn-light active form-control" value="Enregistrer" >    
                                        
                                        </div>

                                </form>
                              </div>
                              <div class='modal-footer'>
                                                                        </div>
                            </div>
                          </div>
                        </div>
                        <!-- SUPPRESSION -->
                               <div class='modal fade' id='delete_noeud<?=$value['ID']?>' tabindex="-1">
                            <div class='modal-dialog '>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  
                                  <h3 class="modal-title">Suppression</h3>
                                  <!-- <button class="close" data_dismiss="modal">&times;</button> -->
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>

                                <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
                          height:100%;
                          background-size:10px 10px;}">
                                  <span id="msg"></span>
                                <h5>Voulez-vous variment supprimer?</h5>

                              </div>
                              <div class='modal-footer'>
                                                                            <a class='btn btn-danger btn-md' href='<?= base_url()?>qui_sommes_nous/Administration/delete_noeud/<?=$value['ID']?>'>Supprimer</a>
                                                                            <button class='btn btn-success btn-md' class='close' data-dismiss='modal'>Quitter</button>
                                                                        </div>
                            </div>
                          </div>
                        </div> 


                          <!-- OPDATE NOEUD -->

            <div class='modal fade' id='update_noeud<?=$value['ID']?>' tabindex="-1">
                            <div class='modal-dialog  modal-lg'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  
                                  <h3 class="modal-title">Ajout</h3>
                                  <!-- <button class="close" data_dismiss="modal">&times;</button> -->
                                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>

                                <div class="modal-body" id="dialog" title="Actualité"   style="background-image: linear-gradient(0deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05)), linear-gradient(90deg, rgba(255, 255, 255, .05), rgba(150, 150, 150, .05));
                          height:100%;
                          background-size:10px 10px;}">
                                 <form id="myform" action="<?= base_url('qui_sommes_nous/Administration/update_noeud/') ?><?=$value['ID']?>" method="POST" enctype="multipart/form-data">
    

                                <div class="container-fluid row" >
                                         <div class="col-md-4 sm-12 xs-12 form-group">
                                           Appellation noeud:
                                        </div>
                                        <div class="col-md-8 sm-12 xs-12 form-group">
                                         
                                    <input type="text" name="appelation" id="appelation" class="form-control input-sm" autocomplete="off" value="<?=$value['APPELATION']?>" required>     
                                        </div>
                                        
                                    </div>
                                  <!-- <div class="container-fluid row" >
                                         <div class="col-md-12 sm-12 xs-12 form-group">
                                            Responsable:
                                        </div>
                                        <div class="col-md-6 sm-12 xs-12 form-group">
                                           
                                    <input type="text" placeholder="Nom" name="nom" id="nom"  value="<?=$value['NOM_RESPONSABLE']?>" class="form-control input-sm" autocomplete="off" required>     
                                        </div>
                                      <div class="col-md-6 sm-12 xs-12 form-group">
                                           
                                    <input type="text" placeholder="Prénom" name="prenom" id="prenom" class="form-control input-sm" value="<?=$value['PRENOM_RESPONSABLE']?>" autocomplete="off" required>     
                                        </div>
                                    
                                        
                                    </div>
                                    <div class="container-fluid row" >
                                         
                                        <div class="col-md-6 sm-12 xs-12 form-group">
                                           
                                    <input type="text" placeholder="Téléphone" name="tel" id="tel" class="form-control input-sm" autocomplete="off" value="<?=$value['TELEPHONE']?>" required>     
                                        </div>
                                    
                                        <div class="col-md-6 sm-12 xs-12 form-group">
                                           
                                    <input type="text" placeholder="Email" name="email" id="email" class="form-control input-sm" autocomplete="off" value="<?=$value['EMAIL']?>" required>     
                                        </div>
                                     
                                        <div class="col-md-1 sm-12 xs-12 form-group">
                                        foto</div>
                                        <div class="col-md-6 sm-12 xs-12 form-group">
                                    <input type="file" placeholder="foto" name="fotos" id="fotos" accept="image/*" class="form-control input-sm" autocomplete="off" > 
                                       
                                        </div>
                                        
                                    </div> -->
                                        
                                    <div class="col-md-12 form-group" style="width: 100%">

                                        

                                            <input type="submit" name="submit" id="submit"  class="btn btn-light active form-control" value="Enregistrer" >    
                                        
                                        </div>

                                </form>
                              </div>
                              <div class='modal-footer'>
                                                                        </div>
                            </div>
                          </div>
                        </div>
                          <?php
                        }
                        ?>
          <div class="container"  style="background: white">
            <h3 class="text-center">Organigramme</h3>
            <?= $this->session->flashdata('message_noeud') ?>
            
<div id="chart_div" class="container" style="background: white;  overflow-x: scroll;"></div>
</div>
    </div>
      
     
        
        <!--================ start footer Area  =================-->	
        <?php
        include VIEWPATH.'includes/footer.php';
        ?>
    </body>
</html>
 <script type="text/javascript" src="<?=base_url()?>new_asset/googleChart/googleChart.js"></script>
         <script type="text/javascript">
      google.charts.load('current', {packages:["orgchart"]});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([
          <?=$data_from_to?>
        ]);

        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {'allowHtml':true,'color':'#edf7ff','size':'medium'});
      }
   </script>


